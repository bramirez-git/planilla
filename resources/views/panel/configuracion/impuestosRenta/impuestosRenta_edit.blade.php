@extends('Layouts.menuPanel')

@section('page-content')
    <form class="mt-lg-3" id="frm_impuestos_renta" autocomplete="off" method="POST" action="{{route('configuracionImpuestosRenta.update',[Crypt::encrypt($resultado->id_impuesto_renta)])}}">
        @csrf
        @method('PUT')
        <div class="row mb-475">
            <div class="col-12">
                <div class="table-responsive border-t-3 brc-blue-m2">
                    <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                        <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>
                            <th class="text-center text-secondary-d2 text-95 text-600">
                                Tramo
                            </th>

                            <th class='text-center text-secondary-d2 text-95 text-600'>
                                Tarifa
                            </th>
                        </tr>
                        </thead>

                        <tbody class="mt-1">
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <div class="input-group-prepend">
                                        <span class="mr-1 mt-2">Sobre el exceso de </span>
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" lang="en" name="tramo1_inicio" value="{{number_format($resultado->tramo1_inicio, 2) }}" class="form-control number-input text-right col-sm-4 col-md-3 col-lg-2 mr-1"/>
                                    <span class="mr-1 mt-2">(aproximadamente US$1 340) y hasta </span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" lang="en" name="tramo1_final" value="{{number_format($resultado->tramo1_final, 2) }}" class="form-control number-input text-right col-sm-4 col-md-3 col-lg-2 mr-1"/>
                                    <span class="mt-2">(aproximadamente US$1 960) </span>
                                </div>
                            </td>
                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{number_format($resultado->tarifa1, 2) }}" min="0.00" lang="en" class="form-control brc-on-focus brc-blue-m1 col-md-5 col-sm-12 number-input text-right limited-to-100" id="primerExceso" name="tarifa1"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <span class="mr-1 mt-2">Sobre el exceso de </span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" lang="en" name="tramo2_inicio" value="{{number_format($resultado->tramo2_inicio, 2) }}" class="form-control number-input text-right col-sm-4 col-md-3 col-lg-2 mr-1"/>
                                    <span class="mr-1 mt-2">(aproximadamente US$1 960) y hasta </span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" lang="en" name="tramo2_final" value="{{number_format($resultado->tramo2_final, 2) }}" class="form-control number-input text-right col-sm-4 col-md-3 col-lg-2 mr-1"/>
                                    <span class="mt-2">(aproximadamente US$3 430) </span>
                                </div>
                            </td>
                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{number_format($resultado->tarifa2, 2) }}" lang="en" class="form-control brc-on-focus brc-blue-m1 col-md-5 col-sm-12 number-input text-right limited-to-100" id="segundoExceso" name="tarifa2"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <span class="mr-1 mt-2">Sobre el exceso de </span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" lang="en" name="tramo3_inicio" value="{{number_format($resultado->tramo3_inicio, 2) }}" class="form-control number-input text-right col-sm-4 col-md-3 col-lg-2 mr-1"/>
                                    <span class="mr-1 mt-2"> (aproximadamente US$3 430) y hasta </span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" lang="en" name="tramo3_final" value="{{number_format($resultado->tramo3_final, 2) }}" class="form-control number-input text-right col-sm-4 col-md-3 col-lg-2 mr-1"/>
                                    <span class="mt-2">(aproximadamente US$6 860) </span>
                                </div>
                            </td>
                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{number_format($resultado->tarifa3, 2) }}" lang="en" class="form-control brc-on-focus brc-blue-m1 col-md-5 col-sm-12 number-input text-right" id="tercerExceso" name="tarifa3"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <span class="mr-1 mt-2">Sobre el exceso de </span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" lang="en" name="tramo4" value="{{number_format($resultado->tramo4, 2) }}" class="form-control number-input text-right col-sm-4 col-md-3 col-lg-2 mr-1"/>
                                    <span class="mt-2">(aproximadamente US$6 860) </span>
                                </div>
                            </td>

                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{number_format($resultado->tarifa4, 2) }}" lang="en" class="form-control brc-on-focus brc-blue-m1 col-md-5 col-sm-12 number-input text-right limited-to-100" id="cuartoExceso" name="tarifa4"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url('panelAdministracion/configuracion')  }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    Cancelar
                </a>
                <button type="button" id="btn_guardar" data-target="#confirmModalRenta" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    Guardar
                </button>
            </div>
        </div>
    </form>
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script type="module">

        $(document).ready(function(){
            $("#btn_guardar").on('click', function (evt)
            {
                if($('#frm_impuestos_renta').valid())
                {
                    $('#cargando').modal('show');
                    $('#frm_impuestos_renta').submit();
                }
                else{
                    return false;
                }
            });
            $('#frm_impuestos_renta').validate({
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
            $('.limited-to-100').on('input', function() {
                // Obtenemos el valor ingresado y lo convertimos a un número
                var valor = parseFloat($(this).val());

                // Verificamos si el valor es mayor a 100
                if (valor > 100) {
                    // Si es mayor a 100, ajustamos el valor a 100
                    $(this).val(100);
                }
            });
            $("#simple-table tr").each(function() {
                // Obtener el valor del atributo "id" de la fila actual
                var id = $(this).attr("id");

                // Verificar si la fila tiene un atributo "id"
                if (id) {
                    $(this).trigger("click");
                }
            });

            function generateRules() {
                var rules = {};
                $('#frm_impuestos_renta .input-group input').each(function() {
                    var name=$(this).attr('name');
                    rules[name] = {
                        required: true
                    };
                });
                return rules;
            }

            function generateMessages() {
                var messages = {};
                $('#frm_impuestos_renta .input-group input').each(function() {
                    var name=$(this).attr('name');
                    messages[name] = {
                        required: "Este campo es requerido."
                    };
                });
                return messages;
            }
        });
    </script>
@endpush

