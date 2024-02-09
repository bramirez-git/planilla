@extends('Layouts.menu')

@section('page-content')
    <form class="mt-lg-3" id="frm-amonestacion" autocomplete="off" method="POST" action="{{route('colaboradoresAmonestaciones.store')}}">
        @csrf
        <input type="text" name="id_colaborador" value="{{Crypt::encrypt($id_colaborador)}}" hidden>
        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de la amonestación') }}</label>
                <input type="text" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre" name="nombre"/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Amonestación') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fecha" name="fecha"/>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Clasificación') }}</label>
                <div class="input-group">
                    <select class="form-control input-group" id="clasificacion" name="clasificacion">
                        <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                        <option value="leve">Leve</option>
                        <option value="grave">Grave</option>
                        <option value="muy_grave">Muy Grave</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo') }} </label>
                <select class="form-control input-group" id="tipo" name="tipo">
                    <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                    <option value="verbal">Verbal</option>
                    <option value="escrita">Escrita</option>
                </select>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12 input-group" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcion" name="descripcion" ></textarea>
            </div>
            <div id="div-doc" class="col-md-3 col-sm-12 invisible">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">{{ __('Documento asociado') }}</label>
                <div class="input-group">
                    <input type="file" name="documento" id="documento" accept=".pdf, .png, .jpg" class="form-control">
                    <!-- Puedes usar el atributo 'accept' para limitar los tipos de archivos que se pueden cargar -->
                    <div id="cropMessage"></div>
                </div>
            </div>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Cancelar
                </a>
                <button id="registrar" type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
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
                        ¿Desea guardar la amonestación?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button class="btn btn-primary" >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {

            // Detectar cambios en el select
            $('#tipo').on('change', function() {
                if ($(this).val() === 'verbal') { // Si la opción seleccionada es "Escrita"
                    if (!$("#div-doc").hasClass("invisible")) {
                        $("#div-doc").addClass("invisible");
                    }
                } else {
                    if ($("#div-doc").hasClass("invisible")) {
                        $("#div-doc").removeClass("invisible");
                    }
                }
            });

            $('#frm-amonestacion').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    nombre: {
                        required: true
                    },
                    fecha: {
                        required: true
                    },
                    clasificacion: {
                        required: true
                    },
                    tipo: {
                        required: true
                    },
                    descripcion: {
                        required: true
                    }
                },
                messages: {
                    nombre: {
                        required: "Este campo es requerido."
                    },
                    fecha: {
                        required: "Este campo es requerido."
                    },
                    clasificacion: {
                        required: "Por favor, seleccione una opción."
                    },
                    tipo: {
                        required: "Por favor, seleccione una opción."
                    },
                    descripcion: {
                        required: "Este campo es requerido."
                    }
                },
                errorPlacement: function (error, element) {
                    if (element.hasClass("form-control")) {
                        error.insertAfter(element.closest('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $("#registrar").on('click', function (evt)
            {
                if($('#frm-amonestacion').valid())
                {
                    $('#confirmModal').modal('show');
                }
                else{
                    return false;
                }
            });

        });
    </script>
@endpush
