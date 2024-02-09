@extends('Layouts.menu')

@section('page-content')
    <form class="mt-lg-3" autocomplete="off" id="frm-create-noticia" method="POST" action="{{route('noticias.update',[Crypt::encrypt($resultado->id_noticia)])}}">
        @csrf
        @method('PUT')
        <input type="hidden" id="imagenesEliminadas" name="imagenesEliminadas">
        <input type="hidden" id="estadoNoticia" name="estadoNoticia" value="publicado">
        <div class="form-group row mt-4">

            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Título de la noticia') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="tituloNoticia" value="{{$resultado->titulo}}" name="tituloNoticia"  required="true"/>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Fecha actual para publicar ahora">
                        <i class="fa-solid fa-circle-info blue"></i> </span>{{ __('Fecha de publicación') }}</label>
                <div class="input-group input-daterange"readonly>
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control input-group text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaPublicacion" name="fechaPublicacion" style="pointer-events: none;" readonly/>
                </div>
            </div>
        </div>

        <div class="form-group row mt-12">

            <div class="col-md-12 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción de la noticia') }}</label>
                <div class="card bcard border-1 brc-dark-l1">
                    <div class="card-body p-0">
                        <textarea id="editor" name="contenido"></textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12">
                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Cancelar
                </a>
                <button type="button" id="agendar" data-toggle="modal" data-target="#confirmarAgenda" class="btn btn-outline-purple btn-text-dark btn-h-purple btn-a-purple btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-purple h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-calendar-day mr-1 text-white text-120 mt-3px"></i>
						</span>
                    guardar como borrador
                </button>
                <button id="edit" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                    publicar ahora
                </button>
            </div>
        </div>
    </form>
@endsection
<script type="module">
    $(document).ready(function () {
        var campoImagenesEliminadas = $('#imagenesEliminadas');
        let imagenesEliminadas = [];
        let imagenesInsertadas = [];// Mover la variable al ámbito global
        const editor = ClassicEditor
        .create(document.querySelector('#editor'), {
            simpleUpload: {
                uploadUrl: '{{ route('upload.store') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            },
        })
        .then(editor => {
            editor.setData('{!! $resultado->descripcion !!}');
            var contenidoAnterior = editor.getData();


            editor.model.document.on('change:data', () => {
                const contenidoActual = editor.getData();
                const imagenesEliminadasTemp = encontrarImagenesEliminadas(contenidoAnterior, contenidoActual);
                imagenesEliminadas = imagenesEliminadas.concat(imagenesEliminadasTemp);

                const imagenesAgregadasTemp = encontrarImagenesAgregadas(contenidoAnterior, contenidoActual);
                const imagenesNuevas = imagenesAgregadasTemp.filter(img => !imagenesInsertadas.includes(img));
                imagenesInsertadas = imagenesInsertadas.concat(imagenesNuevas);



                // Procesar imágenes eliminadas
                if (imagenesEliminadas.length > 0) {
                    $.each(imagenesEliminadas, function(index, value) {
                        if (value !== '' && value !== undefined) {
                            // console.log('Imagen eliminada:', value);
                            campoImagenesEliminadas.val(function(_, currentValue) {
                                // Agrega el nuevo valor y una coma si ya hay valores presentes
                                return (currentValue ? currentValue + ',' : '') + value;
                            });
                        }
                    });
                }

                if (imagenesNuevas.length > 0) {
                    $.each(imagenesNuevas, function(index, value) {
                        if (value !== '' && value !== undefined) {
                            // console.log('Nueva imagen agregada:', value);
                            // // Crea un elemento temporal con el HTML actua
                        }
                    });
                }


                // Actualizar el contenido anterior con el contenido actual
                contenidoAnterior = contenidoActual;
            });


            editor.plugins.get('FileRepository').createUploadAdapter = loader => {
                return new SimpleUploadAdapter(loader, editor);
            };

        })
        .catch(error => {
            console.error(error);
        });

        class SimpleUploadAdapter {
            constructor(loader, editor) {
                this.loader = loader;
                this.editor = editor;
            }

            upload() {
                return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const data = new FormData();
                    data.append('upload', file);

                    $.ajax({
                        url: this.editor.config.get('simpleUpload.uploadUrl'),
                        method: 'POST',
                        headers: this.editor.config.get('simpleUpload.headers'),
                        data: data,
                        processData: false,
                        contentType: false,
                        global:false,
                        success: (response) => {
                            if(response.error){
                                reject();
                                mensaje_swal('error',response.messages,
                                    function(){
                                    }, false, null, 'Continuar');
                            }
                            const urlDeLaImagen = response.link;
                            resolve({ default: urlDeLaImagen });

                        },
                        error: (error) => {
                            reject(error);
                        }
                    });
                }));
            }
        }

    });

    function encontrarImagenesAgregadas(contenidoAnterior, contenidoActual) {
        const parser = new DOMParser();

        const docAnterior = parser.parseFromString(contenidoAnterior, 'text/html');
        const docActual = parser.parseFromString(contenidoActual, 'text/html');

        const imagenesAnterior = Array.from(docAnterior.querySelectorAll('img')).map(img => img.src);
        const imagenesActual = Array.from(docActual.querySelectorAll('img')).map(img => img.src);

        // Encontrar imágenes agregadas comparando las URLs
        return imagenesActual.filter(imgActual => !imagenesAnterior.includes(imgActual));
    }

    function encontrarImagenesEliminadas(contenidoAnterior, contenidoActual) {
        const parser = new DOMParser();

        const docAnterior = parser.parseFromString(contenidoAnterior, 'text/html');
        const docActual = parser.parseFromString(contenidoActual, 'text/html');

        const imagenesAnterior = Array.from(docAnterior.querySelectorAll('img')).map(img => img.src);
        const imagenesActual = Array.from(docActual.querySelectorAll('img')).map(img => img.src);

        // Encontrar imágenes eliminadas comparando las URLs
        return imagenesAnterior.filter(imgAnterior => !imagenesActual.includes(imgAnterior));
    }
</script>
