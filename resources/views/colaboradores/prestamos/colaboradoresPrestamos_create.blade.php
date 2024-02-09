@extends('Layouts.menu')

@section('page-content')
    <form class="mt-lg-3" id="frm-prestamos" name="frm-prestamos" autocomplete="off" method="POST" action="{{route('colaboradoresPrestamos.store')}}">
        @csrf
        <div class="form-group row mt-4">
            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Concepto del préstamo') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="conceptoPrestamo" name="conceptoPrestamo" />
            </div>

            <div class="col-md-2 col-sm-12">
                <label for="monedaPrestamo" class="mb-0 text-blue-m1"> {{ __('Moneda del préstamo') }}</label>
                <select class="chosen-select form-control" id="monedaPrestamo" name="monedaPrestamo" >
                    <option value="{{ $idMoneda }}">{{ $nombreMoneda }}</option>
                </select>
            </div>

            <div class="col-md-2 col-sm-12">
                <label for="montoPrestamo" class="mb-0 text-blue-m1"> {{ __('Monto del préstamo') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="spanSignoMoneda input-group-text">
                            @if($nombreMoneda == "colones")
                                &cent;
                            @else
                                &dollar;
                            @endif
                        </span>
                    </div>
                    <input type="text" min="0" lang="es" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="montoPrestamo" name="montoPrestamo" />
                </div>
            </div>

            <div class="col-md-2 col-sm-12">
                <label for="tasaInteres" class="mb-0 text-blue-m1"> {{ __('Tasa de interés anual') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">%</span>
                    </div>
                    <input type="text" min="0" lang="es" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="tasaInteres" name="tasaInteres" />
                </div>
            </div>

            <div class="col-md-2 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cantidad de cuotas (meses)') }}</label>
                <input type="text" min="0" lang="es" step="1" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="cantidadCuotas" name="cantidadCuotas" />
            </div>

        </div>

        <div class="form-group row mt-4">
            <div class="col-md-2 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Inicio') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicio" name="fechaInicio" />
                </div>
            </div>

            <div class="col-md-2 col-sm-12">
                <label for="cuotaMensual" class="mb-0 text-blue-m1"> {{ __('Cuota mensual') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="spanSignoMoneda input-group-text">
                            @if($nombreMoneda == "colones")
                                &cent;
                            @else
                                &dollar;
                            @endif
                        </span>
                    </div>
                    <input type="text" min="0" lang="es" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="cuotaMensual" name="cuotaMensual" readonly/>
                </div>
            </div>

            <div class="col-md-2 col-sm-12 mt-2 text-center">
                <button type="button" id="calcular" class="btn px-4 btn-primary mb-1 mt-3">
                    {{ __("Calcular cuota") }}
                </button>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-sm-12">
                <label for="descripcionPrestamo" class="mb-0 text-blue-m1"> {{ __('Descripción (Notas privadas)') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcionPrestamo" name="descripcionPrestamo"  ></textarea>
            </div>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    {{ __("Cancelar") }}
                </a>
                <button type="button" id="registrar" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    {{ __("Registrar") }}
                </button>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                            {{ __("Mensaje") }}
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        {{ __("¿Desea guardar el nuevo préstamo?") }}
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            {{ __("Cancelar") }}
                        </button>

                        <button type="submit" class="btn btn-primary" id="guardar">
                            {{ __("Guardar") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="id_colaborador" name="id_colaborador" value="{{ $idColaborador }}"/>
    </form>
    @include('componentes.modalCargando')
@endsection

@push('scripts')
    <script type="module">
        $('#monedaPrestamo').on('change', function (evt){
            if(this.value == "1"){
                $(".spanSignoMoneda").html("₡");
            }else{
                $(".spanSignoMoneda").html("$");
            }
        });

        $('#calcular').on('click', function (evt){
            //Validar campos
            $("#conceptoPrestamo").addClass("ignore");
            $("#fechaInicio").addClass("ignore");
            $("#descripcionPrestamo").addClass("ignore");

            if($("#frm-prestamos").valid()){
                $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('calcularCuotaMensualPrestamo') }}",
                    data: {
                        "monto": $("#montoPrestamo").val(),
                        "cuotas": $("#cantidadCuotas").val(),
                        "tasa_interes": $("#tasaInteres").val(),
                    },
                    beforeSend: function() {
                        $("#cargando").modal("show");
                    },
                    success: function(response) {
                        $("#cuotaMensual").val(response);
                    },
                    complete: function(response) {
                        $("#cargando").modal("hide");
                    },
                    error: function (response) {
                        alert(response.responseJSON.message);
                    }
                });
            }
        });

        $("#registrar").on('click', function (evt){
            //Validar campos
            $("#conceptoPrestamo").removeClass("ignore");
            $("#fechaInicio").removeClass("ignore");
            $("#descripcionPrestamo").removeClass("ignore");

            $('#confirmModal').modal('show');
            if($('#prestamos').valid()){
                return true;
            }else{
                return false;
            }
        });

        $('#guardar').on('click', function (evt){
            $('#confirmModal').modal('hide');

            if($("#frm-prestamos").valid()) {
                $('#cargando').modal('show');
            }
        });

        $('#frm-prestamos').validate({
            ignore: ".ignore",
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                conceptoPrestamo: {
                    required: true
                },
                montoPrestamo: {
                    required: true
                },
                tasaInteres: {
                    required: true,
                    minTasaInteres: true
                },
                cantidadCuotas: {
                    required: true,
                    maxCantidadCuotas: true
                },
                fechaInicio: {
                    required: true
                },
                descripcionPrestamo: {
                    required: true
                }
            },
            messages: {
                conceptoPrestamo: {
                    required: "Este campo es requerido."
                },
                montoPrestamo: {
                    required: "Este campo es requerido."
                },
                tasaInteres: {
                    required: "Este campo es requerido.",
                    minTasaInteres: "Tasa de interés menor a la configurada por la empresa"
                },
                cantidadCuotas: {
                    required: "Este campo es requerido.",
                    maxCantidadCuotas: "Cantidad de cuotas mayor a la configurada por la empresa"
                },
                fechaInicio: {
                    required: "Este campo es requerido."
                },
                descripcionPrestamo: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $.validator.addMethod("minTasaInteres", function(value, element) {
            var min_tasa_interes = '{{  $min_tasa_prestamos }}';
            var validacion_tasa_interes = true;
            if(parseFloat(value) < parseFloat(min_tasa_interes)){
                validacion_tasa_interes = false;
            }
            return validacion_tasa_interes;
        });

        $.validator.addMethod("maxCantidadCuotas", function(value, element) {
            var max_cantidad_cuotas = '{{  $max_cuotas_prestamos }}';
            var validacion_cuotas = true;
            if(parseFloat(value) > parseFloat(max_cantidad_cuotas)){
                validacion_cuotas = false;
            }
            return validacion_cuotas;
        });
    </script>
@endpush
