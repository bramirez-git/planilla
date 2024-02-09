@extends('Layouts.menuPanel')

@section('page-content')
    <form id="guardarExcel" action="{{ route('configuracionCatalogoCCSS.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h5 class="card-title text-110 text-success pt-1">
            Cargando catálogo de ocupaciones CCSS
        </h5>
        <div class="mt-4">
            <input type="file" class="ace-file-input" id="ace-file-input2" name="archivo_excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" />
        </div>

        <!--vista previa-->
        <div class="modal fade " id="prevista" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title text-blue-d2">
                            Vista previa
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body ace-scrollbar">

                        {{--aqui se carga el excel--}}
                        <div class="table-responsive" id="excel_data">

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div id="error" style="display: none;">
        </div>
        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25" id="acciones" style="display: none;">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <button  type="button" data-toggle="modal" data-target="#prevista" class="btn btn-outline-success btn-text-dark btn-h-success btn-a-success btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                            <span class="bgc-success h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-eye mr-1 text-white text-120 mt-3px"></i>
                            </span>
                    Vista Previa
                </button>
                <button type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                            </span>
                    Registrar
                </button>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                            Mensaje
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Los datos actuales serán reemplazados.

                        ¿Desea guardar el nuevo documento?
                        <br><br>

                        <label class="d-inline-block mt-3 mb-0 text-secondary-d2">
                            <input type="checkbox" name="incluye_titulo" class="mr-1" id="id-agree" />
                            <span class="text-dark-m3">El archivo incluye encabezados.</span>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary" >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" data-backdrop-bg="bgc-white" id="mensajeExito" tabindex="-1" role="dialog" aria-labelledby="primaryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bgc-transparent brc-primary-m2 shadow">
                <div class="modal-header py-2 bgc-primary-tp1 border-0  radius-t-1">
                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="primaryModalLabel">
                        Mensaje
                    </h5>
                </div>

                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                    <div class="d-flex align-items-top mr-2 mr-md-5">
                        <div class="text-secondary-d2 text-105 ml-3">
                            <i class="fas fa-info-circle mr-1 mb-1 text-primary"></i>
                            Se han registrado las ocupaciones CCSS, con éxito.
                        </div>
                    </div>
                </div>

                <div class="modal-footer bgc-white-tp2 border-0">
                    <button type="button" class="btn px-4 btn-primary" id="id-danger-yes-btn" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('componentes.modalCargando')
@endsection

@push('scripts')
    <script type="module">

        const excel_file = document.getElementById('ace-file-input2');

        excel_file.addEventListener('change', (event) => {

            if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))
            {
                document.getElementById('error').innerHTML = '<div class="alert alert-danger">Solo los archivos .xlsx o .xls son permitidos.</div>';
                $("#error").show();
                $("#acciones").hide();
                excel_file.value = '';

                return false;
            }

            $("#error").hide();

            var reader = new FileReader();

            reader.readAsArrayBuffer(event.target.files[0]);

            reader.onload = function(event){

                var data = new Uint8Array(reader.result);

                var work_book = XLSX.read(data, {type:'array'});

                var sheet_name = work_book.SheetNames;

                var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});

                if(sheet_data.length > 0)
                {
                    var table_output = '<table class="table table-striped table-bordered">';

                    for(var row = 0; row < sheet_data.length; row++)
                    {

                        table_output += '<tr>';

                        for(var cell = 0; cell < sheet_data[row].length; cell++)
                        {

                            if(row == 0)
                            {

                                table_output += '<th>'+sheet_data[row][cell]+'</th>';

                            }
                            else
                            {

                                table_output += '<td>'+sheet_data[row][cell]+'</td>';

                            }

                        }

                        table_output += '</tr>';

                    }

                    table_output += '</table>';

                    document.getElementById('excel_data').innerHTML = table_output;
                    $("#acciones").show();
                }

            }

        });

    </script>

    <script type="module">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#guardarExcel').submit(function(e) {
            $('#cargando').modal('show');
            $('#confirmModal').modal('hide');
            e.preventDefault();
            let formData = new FormData(this);
            //$('#file-input-error').text('');

            $.ajax({
                type:'POST',
                url: "{{ route('configuracionCatalogoCCSS.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        $('#cargando').modal('hide');
                        $('#mensajeExito').modal('show');
                    }
                },
                error: function(response){
                    alert(response.responseJSON.message);
                    $('#cargando').modal('hide');
                }
            });
        });


    </script>
@endpush
