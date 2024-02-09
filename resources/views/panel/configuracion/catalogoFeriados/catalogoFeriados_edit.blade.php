@extends('Layouts.menuPanel')

@section('page-content')
    <form class="mt-lg-3" id="frm-feriados" name="frm-feriados" autocomplete="off" method="POST" action="{{route('configuracionCatalogoFeriados.update',[Crypt::encrypt($resultado->id_feriado)])}}">
        @csrf
        @method('PUT')
        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Celebración') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="celebracion" value="{{$resultado->nombre}}" name="celebracion"  />
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha celebración') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" value="{{ date("d/m/Y",strtotime($resultado->fecha)) }}" id="fechaFeriado" name="fechaFeriado" />
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de traslado') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" value="{{ date("d/m/Y",strtotime($resultado->fecha_traslado)) }}" id="fechaTraslado" name="fechaTraslado" />
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Pago obligatorio') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="pagoObligatorio" name="pagoObligatorio" >
                    <option value="si" @if($resultado->pago_obligatorio=="si") selected @endif>Si</option>
                    <option value="no" @if($resultado->pago_obligatorio=="no") selected @endif>No</option>
                </select>
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
                <button type="button" id="registrar" data-toggle="modal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Modificar
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
                        ¿Desea modificar el registro de la celebración?
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
        $(document).ready(function() {
            $(".btn-modal-cargando").on("click", function () {
                $('#cargando').modal('show');
            });

            // Adjunta un escuchador de eventos de clic a todos los botones con data-dismiss="modal"
            $('[data-dismiss="modal"]').on('click', function () {
                const modals = $('.modal');
                // Cierra todos los modales usando la función modal('hide')
                modals.modal('hide');
            });

            $('#guardar').on('click', function (evt)
            {
                $('#confirmModal').modal('hide');
                $('#cargando').modal('show');
            });

            $('#frm-feriados').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    celebracion: {
                        required: true
                    },
                    fechaFeriado: {
                        required: true
                    },
                    fechaTraslado: {
                        required: true
                    },
                    pagoObligatorio: {
                        required: true
                    }
                },

                messages: {
                    celebracion: {
                        required: "Este campo es requerido."
                    },
                    fechaFeriado: {
                        required: "Este campo es requerido."
                    },
                    fechaTraslado: {
                        required: "Este campo es requerido."
                    },
                    pagoObligatorio: {
                        required: "Este campo es requerido."
                    }
                },
                errorElement : 'span'
            });

            $("#registrar").on('click', function (evt)
            {
                if($('#frm-feriados').valid())
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

