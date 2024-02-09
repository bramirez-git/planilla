@extends('Layouts.menuPanel')

@section('page-content')
    <form class="mt-lg-3" id="frm_subcategorias" name="frm_subcategorias" autocomplete="off" method="POST" action="{{route('configuracionAccionPersonal.update',['5'])}}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            @foreach($resultado as $datos)
            <div class="col-lg-4 col-sm-6 mt-3 mt-sm-0 cards-container mb-5" id="card-container-12">
                <div class="card bgc-primary-d3 h-100" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                           {{ $datos->nombre }}
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">
                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            {!! $datos->introduccion !!}
                        </div>

                        <div class="p-3">
                            {!! $datos->descripcion1 !!}
                            @if($datos->pedir_porcentaje1==="si" && $datos->nombre!="Permiso con goce salarial")
                                <p>
                                <div class="input-group">
                                    <input type="hidden" id="frm_fecha_registro" name="frm_subcategoria[{{$datos->id_subcategoria}}][id_subcategoria]" value="{{$datos->id_subcategoria}}"/>
                                    <input type="hidden" id="frm_fecha_registro" name="frm_subcategoria[{{$datos->id_subcategoria}}][nombre]" value="{{$datos->nombre}}"/>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input limited-to-100" id="frm_subcategoria[{{$datos->id_subcategoria}}][porcentaje1]" name="frm_subcategoria[{{$datos->id_subcategoria}}][porcentaje1]" value="{{$datos->porcentaje1}}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                </p>
                            @endif
                            @if(isset($datos->descripcion2))
                                {!! $datos->descripcion2 !!}
                            @endif
                            @if($datos->pedir_porcentaje2==="si")
                                <p class="mb-0">
                                <div class="input-group">
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input limited-to-100" id="frm_subcategoria[{{$datos->id_subcategoria}}][porcentaje2]" name="frm_subcategoria[{{$datos->id_subcategoria}}][porcentaje2]" value="{{$datos->porcentaje2}}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                </p>
                            @endif
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            @endforeach
        </div>
        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Cancelar
                </a>
                @if($existe_porcentaje)
                    <button type="button" id="registrar" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                        Modificar
                    </button>
                @endif
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
                        ¿Desea modificar el registro de incapacidades?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary" id="guardar">
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('componentes.modalCargando')
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function(){
            $('#guardar').on('click', function (evt)
            {
                $('#confirmModal').modal('hide');
                $('#cargando').modal('show');
            });
            // Crear un array para almacenar los nombres de los campos de entrada
            var inputNames=[];
            // Seleccionar todos los elementos de entrada dentro del formulario con el ID 'frm-incapacidades'
            $('#frm_subcategorias .form-group input').each(function(){
                var name=$(this).attr('name');
                if(name){
                    inputNames.push(name);
                }
            });

            if (inputNames.length === 0) {
                console.log('test');
                // El array está vacío
                $('#registrar').attr('hidden', true);
            }


            $('#frm_subcategorias').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: generateRules(),
                messages: generateMessages(),
                errorPlacement: function (error, element) {
                    if (element.hasClass("form-control")) {
                        error.insertAfter(element.closest('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

        });

            $("#registrar").on('click', function (evt)
            {
                if($('#frm_subcategorias').valid())
                {
                    $('#confirmModal').modal('show');
                }
                else{
                    return false;
                }
            });
        function generateRules() {
            var rules = {};
            $('#frm_subcategorias .input-group input').each(function() {
                var name=$(this).attr('name');
                rules[name] = {
                    required: true
                };
            });
            return rules;
        }

        function generateMessages() {
            var messages = {};
            $('#frm_subcategorias .input-group input').each(function() {
                var name=$(this).attr('name');
                messages[name] = {
                    required: "Este campo es requerido."
                };
            });
            return messages;
        }
    </script>
@endpush
