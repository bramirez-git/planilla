@extends('Layouts.menu')

@section('page-content')
    <div class="card h-100">
        <div class="card-header">
            <h5 class="card-title alert bgc-secondary-l3 text-dark-m1 border-none border-l-4 brc-blue radius-0 py-3 text-115">
                Aquí puedes obtener más detalles relacionados al desglose del salario que ingreses en los diferentes apartados.
            </h5>
        </div>

        <div class="card-body">
            <form id="frm_cal_salarial" action="{{ route('calculadoraPlanilla.show',['1']) }}" method="GET">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-12 col-lg-3 mb-2">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> <span class="tooltip-info"
                                                                                                    data-rel="tooltip" data-placement="bottom" title="" data-original-title="Info"> <i
                                            class="fa-solid fa-circle-info blue"></i> </span>Salario Mensual </label>
                                <div class="input-group mt-1">
                                    <div class="input-group-prepend"> <span class="input-group-text">₡</span> </div>
                                    <input name="data[salario]" value="{{ $resultado['salario_base'] ?? ''}}" min="0" type="text" class="form-control brc-on-focus brc-blue-m1 number-input" id="frm_salario">
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-3 mb-2">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> <span class="tooltip-info"
                                                                                                    data-rel="tooltip" data-placement="bottom" title="" data-original-title="Info"> <i
                                            class="fa-solid fa-circle-info blue"></i> </span>Porcentaje Salario </label>
                                <div class="input-group mt-1">
                                    <div class="input-group-prepend"> <span class="input-group-text">%</span> </div>
                                    <input name="data[porcentaje_salario]" value="100" readonly type="text" class="form-control brc-on-focus brc-blue-m1" id="" inputmode="text">
                                </div>
                            </div>


                            <div class="form-group col-12 col-lg-3 mb-2">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">Hijos</label>
                                <input type="number" class="form-control brc-on-focus brc-blue-m1 number-input mt-1 col-md-5 col-sm-12 text" id=""
                                       name="data[hijos]" value="{{ (!isset($resultado['hijos'])||$resultado['hijos']==0)?'':$resultado['hijos'] }}" min="0" lang="en">
{{--                                <input type="text" value="" lang="en" class="form-control brc-on-focus brc-blue-m1 col-md-5 col-sm-12 number-input text-right limited-to-100" id="cuartoExceso" name="tarifa4"/>--}}
                            </div>
                            <div class="form-group col-12 col-lg-1 mb-2" id="conyuge">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">Cónyuge</label>
                                <input type="checkbox" @if(isset($resultado['conyuge'])&&$resultado['conyuge']==1) checked  @endif class="form-control ace-switch conyugue bgc-purple-d1 text-grey-m2 mt-1" name="data[conyuge]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex flex-column flex-md-row mt-3">
                                <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                                    <div class="text-nowrap align-self-start pl-md-2">
                                        <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                                            <div class="d-flex flex-row-reverse">
                                                <div class="px-1">
                                                    <a id="enviarBtn" class="btn btn-outline-green btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                                <i class="fas fa-calculator mr-1 text-white text-120 mt-3px"></i>
                                                            </span>
                                                        CALCULAR SALARIO
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    <a href="{{route('calculadoraPlanilla.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                                                        <i class="nav-icon fa fa-retweet"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="alert bgc-purple brc-purple text-white" role="alert">MONTOS DE CARGAS SOCIALES</div>
                                <div class="table-responsive">
                                    <table
                                        class="mb-0 table table-hover table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="col"><strong> TOTAL CARGAS SOCIALES</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['total_cargos_sociales'] ?? 0.00,2) }} </td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong> MONTO CONYUGE</strong></td>
                                            <td class="small" value="">₡ {{ number_format($resultado['monto_conyuge'] ?? 0.00,2) }} </td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong> MONTO HIJOS</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['monto_hijos'] ?? 0.00,2) }} </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="alert bgc-purple brc-purple text-white" role="alert">MONTOS DE JORNADA LABORAL</div>
                                <div class="table-responsive">
                                    <table
                                        class="mb-0 table table-hover table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="col"><strong> SALARIO DIARIO</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['salario_diario'] ?? 0.00,2) }} </td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>SALARIO POR HORA</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['salario_hora'] ?? 0.00,2) }} </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert bgc-purple brc-purple text-white" role="alert">TRAMOS DEL IMPUESTOS SOBRE LA RENTA AL SALARIO</div>

                                    <div class="table-responsive">
                                        <table id="simple-table"
                                               class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                            <thead class=" border-b-1 brc-default-l3 ">
                                            <tr>
                                                <td class="text-center  small align-middle"> <strong> RENTA MIN</strong> </td>
                                                <td class="text-center  small align-middle"> <strong> RENTA MAX</strong> </td>
                                                <td class="text-center  small align-middle"> <strong> PORCENTAJE</strong> </td>
                                                <td class="text-center  small align-middle"> <strong> TOTAL</strong> </td>
                                            </tr>
                                            </thead>
                                            @foreach($resultado['impuestos_renta'] ?? [] as $datos)
                                                @if(floatval($datos['calculo_renta'])>0)
                                                <tbody class="mt-1">
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td data-label="RENTA MIN:" class="text-grey-d1 text-right text-md-center small">₡ {{ number_format($datos['renta_tramo_inicio'] ?? 0.00,2) }}</td>
                                                    <td data-label="RENTA MAX:" class="text-grey-d1 text-right text-md-center small">₡ {{ number_format($datos['renta_tramo_final'] ?? 0.00,2) }} </td>
                                                    <td data-label="PORCENTAJE:" class="text-grey-d1 text-right text-md-center small"> {{number_format($datos['renta_tarifa'] ?? 0.00,2) }} %</td>
                                                    <td data-label="TOTAL:" class="text-grey-d1 text-right text-md-center small">₡ {{ number_format($datos['calculo_renta'] ?? 0.00,2)}} </td>
                                                </tr>
                                                </tbody>
                                                @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">INCREMENTOS AL SALARIO BRUTO</div>

                                <div class="table-responsive">
                                    <table
                                        class="mb-0 table table-hover table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="col"><div class="mt-2 font-bold">HORAS NORMAL</div></td>
                                            <td>
                                                <input type="number" id="horas_normal" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" min="0" name="data[horas_normal]" value="{{ $resultado['horas_normal'] ?? 0}}">
                                            </td>
                                            <td class="small"><div class="mt-2">₡ {{ number_format($resultado['monto_horas_normal'] ?? 0.00,2) }}</div></td>
                                        </tr>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="col"><div class="mt-2 font-bold">HORAS EXTRA</div></td>
                                            <td>
                                                <input type="number" id="horas_extra" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" min="0" name="data[horas_extra]" value="{{ $resultado['horas_extra'] ?? 0}}">
                                            </td>
                                            <td class="small mt-2"><div class="mt-2">₡ {{ number_format($resultado['monto_horas_extra'] ?? 0.00,2)}}</div></td>
                                        </tr>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">HORAS DOBLE</div></td>
                                            <td>
                                                <input type="number" id="horas_doble" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" min="0" name="data[horas_doble]" value="{{ $resultado['horas_doble'] ?? 0}}">
                                            </td>
                                            <td class="small"><div class="mt-2"><div class="mt-2">₡ {{ number_format($resultado['monto_horas_doble'] ?? 0,2)}} </div></td>
                                        </tr>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">FERIADOS</div></td>
                                            <td>
                                                <input type="number" id="dias_feriados" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" min="0" name="data[dias_feriados]" value="{{ $resultado['dias_feriados'] ?? 0}}">
                                            </td>
                                            <td class="small"><div class="mt-2">₡ {{ number_format($resultado['monto_dias_feriados'] ?? 0,2)}}</div></td>
                                        </tr>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">VACACIONES</div></td>
                                            <td>
                                                <input type="number" id="dias_vacaciones" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" min="0" name="data[dias_vacaciones]" value="{{ $resultado['dias_vacaciones'] ?? 0}}">
                                            </td>
                                            <td class="small"><div class="mt-2">₡ {{ number_format($resultado['monto_dias_vacaciones'] ?? 0,2)}}</div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">DEDUCCIONES AL SALARIO BRUTO</div>
                                <div class="table-responsive">
                                    <table
                                        class="mb-0 table table-hover table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="col"><div class="mt-2 font-bold">AUSENCIAS</div></td>
                                            <td>
                                                <input type="number" id="ausencias" min="0" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" name="data[ausencias]" value="{{ $resultado['ausencias'] ?? 0}}">
                                            </td>
                                            <td class="small"><div class="mt-2">₡ {{ number_format($resultado['monto_ausencias'] ?? 0,2)}}</div></td>
                                        </tr>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">PERMISO S/GOC</div></td>
                                            <td>
                                                <input type="number" id="permisos" min="0" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" name="data[permisos]" value="{{ $resultado['permisos'] ?? 0}}">
                                            </td>
                                            <td class="small"><div class="mt-2">₡ {{ number_format($resultado['monto_permisos'] ?? 0,2)}}</div></td>
                                        </tr>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">DIAS DE INCAPACIDAD</div></td>
                                            <td>
                                                <input type="number" id="dias_incapacidad" min="0" class="form-control brc-on-focus brc-blue-m1 col-md-3 col-sm-12 number-input" name="data[dias_incapacidad]" value="{{ $resultado['dias_incapacidad'] ?? 0}}">
                                            </td>
                                            <td class="small"><div class="mt-2">₡ {{ number_format($resultado['monto_dias_incapacidad'] ?? 0,2)}}</div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">INCREMENTOS AL SALARIO NETO</div>

                                <div class="table-responsive">
                                    <table
                                        class="mb-0 table table-hover table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">OTROS INCREMENTOS</div></td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="spanSignoMoneda input-group-text">
                                                            ₡
                                                        </span>
                                                    </div>
                                                    <input type="text" id="total_otros_incrementos" class="form-control brc-on-focus brc-blue-m1 col-md-4 col-sm-12 number-input" name="data[total_otros_incrementos]" value="{{ number_format($resultado['total_otros_incrementos'] ?? 0,2)}}">
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-95 font-bold text-danger py-2"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">DEDUCCIONES AL SALARIO NETO</div>
                                <div class="table-responsive">
                                    <table
                                        class="mb-0 table table-hover table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">PRESTAMOS</div></td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="spanSignoMoneda input-group-text">
                                                            ₡
                                                        </span>
                                                    </div>
                                                    <input type="text" id="monto_prestamos" class="form-control brc-on-focus brc-blue-m1 col-md-4 col-sm-12 number-input" name="data[monto_prestamos]" value="{{ number_format($resultado['monto_prestamos'] ?? 0,2)}}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">EMBARGOS</div></td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="spanSignoMoneda input-group-text">
                                                            ₡
                                                        </span>
                                                    </div>
                                                    <input type="text" id="monto_embargos" class="form-control brc-on-focus brc-blue-m1 col-md-4 col-sm-12 number-input" name="data[monto_embargos]" value="{{ number_format($resultado['monto_embargos'] ?? 0,2)}}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">PENSIONES</div></td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="spanSignoMoneda input-group-text">
                                                            ₡
                                                        </span>
                                                    </div>
                                                    <input type="text" id="monto_pensiones" class="form-control brc-on-focus brc-blue-m1 col-md-4 col-sm-12 number-input" name="data[monto_pensiones]" value="{{ number_format($resultado['monto_pensiones'] ?? 0,2)}}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"><div class="mt-2 font-bold">OTRAS DEDUCCIONES</div></td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="spanSignoMoneda input-group-text">
                                                            ₡
                                                        </span>
                                                    </div>
                                                    <input type="text" id="total_otras_deducciones" class="form-control brc-on-focus brc-blue-m1 col-md-4 col-sm-12 number-input" name="data[total_otras_deducciones]" value="{{ number_format($resultado['total_otras_deducciones'] ?? 0,2)}}">
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-95 font-bold text-danger py-2"></p>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="alert bgc-purple brc-purple text-white" role="alert">PLANILLA DEL MES COMPLETO</div>
                                <div class="table-responsive">
                                    <table
                                        class="mb-0 table table-hover table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-grey-d1 text-left small" scope="col"><strong>SALARIO BASE</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['salario_base'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>INCREMENTO SALARIO BRUTO</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['total_incrementos_bruto'] ?? 0.00,2)}} </td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong> DEDUCCION SALARIO BRUTO</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['total_deducciones_bruto'] ?? 0.00,2)}} </td>
                                        </tr>

                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong> SALARIO BRUTO</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['salario_bruto'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>MONTO CCSS SEM </strong>{{ isset($resultado['porcentaje_ccss_sem'])?'('.$resultado['porcentaje_ccss_sem'].' %)':''}}</td>
                                            <td class="small">₡ {{ number_format($resultado['monto_ccss_sem'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>MONTO CCSS IVM </strong>{{ isset($resultado['porcentaje_ccss_ivm'])?'('.$resultado['porcentaje_ccss_ivm'].' %)':''}}</td>
                                            <td class="small">₡ {{ number_format($resultado['monto_ccss_ivm'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>MONTO BANCO POPULAR </strong>{{ isset($resultado['porcentaje_banco_popular'])?'('.$resultado['porcentaje_banco_popular'].' %)':''}}</td>
                                            <td class="small">₡ {{ number_format($resultado['monto_banco_popular'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>MONTO RENTA</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['monto_renta'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>TOTAL DEDUCCIONES</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['total_deducciones'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>CONYUGE + HIJOS</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['monto_conyuge_hijos'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>SALARIO NETO</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['salario_neto'] ?? 0.00,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-grey-d1 text-left small" scope="row"> <strong>SALARIO DEVENGADO</strong></td>
                                            <td class="small">₡ {{ number_format($resultado['salario_devengado'] ?? 0.00,2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p class="text-95 font-bold text-danger py-2"></p>
                            </div>
                        </div>



                    </div>
                </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="text-nowrap align-self-start mb-sm-0 pb-4"></div>
                        <div class="text-nowrap align-self-start pl-md-2">
                            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                                <div class="d-flex flex-row-reverse">
                                    <div class="px-1">
                                        <a id="enviarBtnDos" class="btn btn-outline-green btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                                <i class="fas fa-calculator mr-1 text-white text-120 mt-3px"></i>
                                                            </span>
                                            CALCULAR SALARIO
                                        </a>
                                    </div>
                                    <div class="px-1">
                                        <a href="{{route('calculadoraPlanilla.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                                            <i class="nav-icon fa fa-retweet"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


            </form>
        </div>
    </div>
@endsection
