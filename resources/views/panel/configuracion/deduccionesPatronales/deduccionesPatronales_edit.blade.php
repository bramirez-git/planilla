@extends('Layouts.menuPanel')

@section('page-content')
    <form id="frm_deducciones" class="mt-lg-3" autocomplete="off" method="POST" action="{{route('configuracionDeduccionPatronal.update',[Crypt::encrypt($resultado->id_deduccion_patronal)])}}">
        @csrf
        @method('PUT')
        <div class="row mb-475">
            <div class="col-12">
                <div class="table-responsive border-t-3 brc-blue-m2">
                    <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                        <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>
                            <th class="text-center" rowspan="2" style="vertical-align : middle;text-align:center;">
                                Deducciones patronales
                            </th>
                            <th class="text-center" >
                                Contribuciones
                            </th>
                        </tr>
                        </thead>

                        <tbody class="mt-1">
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1 align-middle">
                                Base mínima de cotización vigente
                            </td>

                            <td class='text-grey-d1'>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('ccss_sem', $data_update??[])?"ccss_sem":"" }}">
                            <td class="text-grey-d1 align-middle">
                                CCSS S.E.M
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->ccss_sem, 2) }}" min="0.00" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="ccssSEM" name="ccssSEM"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('ivm_patronal', $data_update??[])?"ivm_patronal":"" }}">
                            <td class="text-grey-d1 align-middle">
                                IVM patronal
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->ivm_patronal, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="IVMPatronal" name="IVMPatronal"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('asfa', $data_update??[])?"asfa":"" }}">
                            <td class="text-grey-d1 align-middle">
                                A.S.F.A
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->asfa, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="ASFA" name="ASFA"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('cuota_patronal', $data_update??[])?"cuota_patronal":"" }}">
                            <td class="text-grey-d1 align-middle">
                                Cuota patronal banco popular
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->cuota_patronal, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="CuotaBP" name="CuotaBP"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('imas', $data_update??[])?"imas":"" }}">
                            <td class="text-grey-d1 align-middle">
                                I.M.A.S.
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->imas, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="IMAS" name="IMAS"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('ina', $data_update??[])?"ina":"" }}">
                            <td class="text-grey-d1 align-middle">
                                I.N.A.
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->ina, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="INA" name="INA"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('lpt_patrono', $data_update??[])?"lpt_patrono":"" }}">
                            <td class="text-grey-d1 align-middle">
                                LPT banco popular patrono
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->lpt_patrono, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="LPTBPPatrono" name="LPTBPPatrono"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('lpt_obrero', $data_update??[])?"lpt_obrero":"" }}">
                            <td class="text-grey-d1 align-middle">
                                LPT banco popular obrero
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->lpt_obrero, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="LPTBPObrero" name="LPTBPObrero"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('lpt_ins', $data_update??[])?"lpt_ins":"" }}">
                            <td class="text-grey-d1 align-middle">
                                LPT INS
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->lpt_ins, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="LPTINS" name="LPTINS"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('fcl', $data_update??[])?"fcl":"" }}">
                            <td class="text-grey-d1 align-middle">
                                FCL
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->fcl, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="FCL" name="FCL"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('pension', $data_update??[])?"pension":"" }}">
                            <td class="text-grey-d1 align-middle">
                                Pensión complementaria obligatoria
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->pension, 2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="pensionComplementaria" name="pensionComplementaria"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style table-primary">
                            <td class="text-grey-d1 font-bolder align-middle">
                                Total empresa
                            </td>

                            <td class='text-grey-d1 text-center font-bolder'>
                                <label id="Patrono" name="Patrono">
                                   {{ number_format($resultado->total_patrono, 2) }}
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mb-475">
            <div class="col-12">
                <div class="table-responsive border-t-3 brc-blue-m2">
                    <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                        <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>
                            <th class="text-center" rowspan="2" style="vertical-align : middle;text-align:center;">
                                Deducciones a colaboradores
                            </th>
                            <th class="text-center" >
                                Contribuciones
                            </th>
                        </tr>
                        </thead>

                        <tbody class="mt-1">
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('empleado_ccss_sem', $data_update??[])?"empleado_ccss_sem":"" }}">
                            <td class="text-grey-d1 align-middle">
                                CCSS S.E.M
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->empleado_ccss_sem,2) }}" min="0.00" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="ccssSEMColaborador" name="ccssSEMColaborador"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('empleado_ivm', $data_update??[])?"empleado_ivm":"" }}">
                            <td class="text-grey-d1 align-middle">
                                CCSS IVM
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{ number_format($resultado->empleado_ivm,2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="CCSSIVM" name="CCSSIVM"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style" id="{{ in_array('empleado_banco', $data_update??[])?"empleado_banco":"" }}">
                            <td class="text-grey-d1 align-middle">
                                Banco popular
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <input type="text" value="{{  number_format($resultado->empleado_banco,2) }}" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right limited-to-100" id="bancoPopular" name="bancoPopular"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style table-primary">
                            <td class="text-grey-d1 font-bolder align-middle">
                                Total colaborador
                            </td>

                            <td class='text-grey-d1 text-center font-bolder'>
                                <label id="Colaborador" name="Colaborador">
                                    {{ number_format( $resultado->total_obrero, 2) }}
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="alert alert-info font-bolder" >
            Total general: <label id="TotalGeneral" name="TotalGeneral">
            {{  number_format($resultado->total_patrono+$resultado->total_obrero, 2) }}
            </label>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url('panelAdministracion/configuracion') }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    Cancelar
                </a>
                <button id="btn_guardar" type="button" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
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
                if($('#frm_deducciones').valid())
                {
                    $('#cargando').modal('show');
                    $('#frm_deducciones').submit();
                }
                else{
                    return false;
                }
            });

            $('#frm_deducciones').validate({
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
        });
        //Funciones para patronos
        function sumaPatrono()
        {
            let suma = parseFloat($('#ccssSEM').val())+
                parseFloat($('#IVMPatronal').val())+
                parseFloat($('#ASFA').val())+
                parseFloat($('#CuotaBP').val())+
                parseFloat($('#IMAS').val())+
                parseFloat($('#INA').val())+
                parseFloat($('#LPTBPPatrono').val())+
                parseFloat($('#LPTBPObrero').val())+
                parseFloat($('#LPTINS').val())+
                parseFloat($('#FCL').val())+
                parseFloat($('#pensionComplementaria').val());

            return suma.toFixed(2);
        }

        $('#ccssSEM').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#ASFA').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#IVMPatronal').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#CuotaBP').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#IMAS').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#INA').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#LPTBPPatrono').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#LPTBPObrero').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#LPTINS').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#FCL').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#pensionComplementaria').on('keyup', function (evt)
        {
            $('#Patrono').text(sumaPatrono()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        //Funciones para Asalariados
        function sumaAsalariado()
        {
            let suma = parseFloat($('#ccssSEMColaborador').val())+
                parseFloat($('#CCSSIVM').val())+
                parseFloat($('#bancoPopular').val());

            return suma.toFixed(2);
        }

        $('#ccssSEMColaborador').on('keyup', function (evt)
        {
            $('#Colaborador').text(sumaAsalariado()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#CCSSIVM').on('keyup', function (evt)
        {
            $('#Colaborador').text(sumaAsalariado()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        $('#bancoPopular').on('keyup', function (evt)
        {
            $('#Colaborador').text(sumaAsalariado()+"%");
            $('#TotalGeneral').text(sumaGeneral()+"%");
        });

        function sumaGeneral()
        {
            let suma = parseFloat(sumaPatrono())+parseFloat(sumaAsalariado());

            return suma.toFixed(2);
        }

        function generateRules() {
            var rules = {};
            $('#frm_deducciones .input-group input').each(function() {
                var name=$(this).attr('name');
                rules[name] = {
                    required: true
                };
            });
            return rules;
        }

        function generateMessages() {
            var messages = {};
            $('#frm_deducciones .input-group input').each(function() {
                var name=$(this).attr('name');
                messages[name] = {
                    required: "Este campo es requerido."
                };
            });
            return messages;
        }

    </script>
@endpush
