@extends('Layouts.blankLayout')

@section('page-content')
    <div class="card h-100" style="position: relative; display: inline-block; vertical-align: middle; margin: 0 auto; text-align: left; width: 70%; z-index: 1045;">
        <div class="card-header">
            <span class="card-title text-125 font-bold">
                Resumen de c&aacute;lculo de planilla -
                @php
                    $nombre_completo = "";
                    if($resultadoDetalle->primer_nombre != ""){
                        $nombre_completo.= $resultadoDetalle->primer_nombre;
                    }
                    if($resultadoDetalle->segundo_nombre != ""){
                        $nombre_completo.= sprintf(" %s", $resultadoDetalle->segundo_nombre);
                    }
                    if($resultadoDetalle->primer_apellido != ""){
                        $nombre_completo.= sprintf(" %s", $resultadoDetalle->primer_apellido);
                    }
                    if($resultadoDetalle->segundo_apellido != ""){
                        $nombre_completo.= sprintf(" %s", $resultadoDetalle->segundo_apellido);
                    }
                    echo $nombre_completo;
                @endphp
            </span>
        </div>
        <div class="card-body">
            <div class="card bcard">
                <ul class="nav nav-tabs nav-tabs-simple nav-tabs-scroll border-b-1 brc-dark-l3 mx-0 mx-md-0 px-3 px-md-1 pt-2px" role="tablist">
                    <li class="nav-item mr-1">
                        <a class="nav-link p-3 bgc-h-primary-l4 radius-0 active" id="resumenTab1-tab-btn" data-toggle="tab" href="#resumenTab1" role="tab" aria-controls="resumenTab1" aria-selected="true">
                            <i class="fa fa-circle-info text-primary mr-3px"></i>
                            <span class="text-primary-d1">
                                Resumen
                            </span>
                        </a>
                    </li>

                    <li class="nav-item mr-1">
                        <a class="nav-link brc-primary-m1 d-style p-3 bgc-h-primary-l4 radius-0" id="resumenTab2-tab-btn" data-toggle="tab" href="#resumenTab2" role="tab" aria-controls="resumenTab2" aria-selected="false">
                            <i class="fa fa-calculator text-primary mr-3px"></i>
                            <span class="text-primary-d1">
                                Salario Bruto
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-3 bgc-h-primary-l4 radius-0" id="resumenTab3-tab-btn" data-toggle="tab" href="#resumenTab3" role="tab" aria-controls="resumenTab3" aria-selected="false">
                            <i class="fa fa-calculator text-blue mr-3px"></i>
                            <span class="text-primary-d1">
                                Salario Neto
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-3 bgc-h-primary-l4 radius-0" id="resumenTab4-tab-btn" data-toggle="tab" href="#resumenTab4" role="tab" aria-controls="resumenTab4" aria-selected="false">
                            <i class="fa fa-calculator text-blue mr-3px"></i>
                            <span class="text-primary-d1">
                                Otros
                            </span>
                        </a>
                    </li>
                </ul>

                @php
                    $signo_moneda = "&cent;";
                    if($resultadoPlanilla->moneda == "dolares"){
                        $signo_moneda = "&dollar;";
                    }
                @endphp

                <div class="card-body px-0 py-2 text-left">
                    <div class="tab-content tab-sliding border-0 px-0">
                        <!-- TAB 1: RESUMEN -->
                        <div class="tab-pane show text-95 px-25 active" id="resumenTab1" role="tabpanel" aria-labelledby="resumenTab1-tab-btn">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0	table-striped-secondary text-dark-m1 mb-0">
                                            <tbody>
                                            <tr>
                                                <td class="bgc-info text-white brc-black-tp10 text-left small"><strong>SALARIO BASE</strong></td>
                                                <td class="text-center small">
                                                    <strong>{!! $signo_moneda !!} {{ number_format($resultadoDetalle->salario_base, 2, ".", " ") }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>+ INCREMENTOS SALARIO BRUTO</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->total_incrementos_bruto, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- DEDUCCIONES SALARIO BRUTO</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->total_deducciones_bruto, 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="bgc-info text-white brc-black-tp10 text-left small"> <strong> SALARIO BRUTO</strong></td>
                                                <td class="text-center small"><strong>{!! $signo_moneda !!} {{ number_format($resultadoDetalle->salario_bruto, 2, ".", " ") }}</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- CARGAS SOCIALES</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format(($resultadoDetalle->monto_ccss_sem + $resultadoDetalle->monto_ccss_ivm + $resultadoDetalle->monto_banco_popular), 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- IMPUESTO RENTA</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_renta, 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- CONYUGE + HIJOS</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_conyuge_hijos, 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="bgc-info text-white brc-black-tp10 text-left small"> <strong>SALARIO NETO</strong></td>
                                                <td class="text-center small"><strong>{!! $signo_moneda !!} {{ number_format($resultadoDetalle->salario_neto, 2, ".", " ") }}</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- PENSIONES</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_pensiones, 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- EMBARGOS</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_embargos, 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- PRESTAMOS</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_prestamos, 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>+ OTROS INCREMENTOS</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->total_otros_incrementos, 2, ".", " ") }}</td>
                                            </tr>

                                            <tr>
                                                <td class="brc-black-tp10 text-left small text-grey"> <strong>- OTRAS DEDUCCIONES</strong></td>
                                                <td class="text-center small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->total_otras_deducciones, 2, ".", " ") }}</td>
                                            </tr>
                                            @if($resultadoPlanilla->adelanto_salario == "si")
                                                <div class="alert alert-warning">
                                                    No se encuentran registros
                                                </div>
                                                <tr>
                                                    <td class="bgc-success-d1 text-white brc-black-tp10 text-left small">
                                                        <strong>ADELANTO:</strong>
                                                    </td>
                                                    <td class="text-center small">
                                                        {!! $signo_moneda !!} {{ number_format($resultadoDetalle->salario_adelanto , 2, ".", " ") }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="bgc-success-d1 text-white brc-black-tp10 text-left small">
                                                        <strong>SALDO:</strong>
                                                    </td>
                                                    <td class="text-center small">
                                                        {!! $signo_moneda !!} {{ number_format($resultadoDetalle->salario_devengado , 2, ".", " ") }}
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td class="bgc-info text-white brc-black-tp10 text-left small"> <strong>SALARIO DEVENGADO</strong></td>
                                                <td class="text-center small">
                                                    <strong>
                                                        {!! $signo_moneda !!}
                                                        @if($resultadoPlanilla->adelanto_salario == "si")
                                                            {{ number_format(($resultadoDetalle->salario_adelanto + $resultadoDetalle->salario_devengado), 2, ".", " ") }}
                                                        @else
                                                            {{ number_format($resultadoDetalle->salario_devengado, 2, ".", " ") }}
                                                        @endif
                                                    </strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: SALARIO BRUTO -->
                        <div class="tab-pane text-95 px-25" id="resumenTab2" role="tabpanel" aria-labelledby="resumenTab2-tab-btn">
                            <div class="form-group row mt-3">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0	table-striped-secondary text-dark-m1 mb-0">
                                            <thead>
                                            <tr>
                                                <th class="bgc-info text-white text-left small"><strong>INCREMENTOS</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>CANTIDAD</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>MONTO</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>HORAS NORMAL</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->horas_normal }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_horas_normal, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>HORAS EXTRA</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->horas_extra }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_horas_extra, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>HORAS DOBLE</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->horas_doble }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_horas_doble, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>DIAS FERIADOS A PAGAR</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->dias_feriados }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_dias_feriados, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>DIAS FERIADOS PAGO NO OBLIGATORIO</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->dias_feriados_no_obligatorios }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_dias_feriados_no_obligatorios, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>DIAS VACACIONES PAGAR</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->dias_vacaciones }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_dias_vacaciones, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bgc-info text-white text-center small" colspan="2"><strong>TOTAL</strong></td>
                                                <td class="bgc-info text-white text-center small">
                                                    <strong>
                                                        {!! $signo_moneda !!}
                                                        {{ number_format(($resultadoDetalle->monto_horas_normal + $resultadoDetalle->monto_horas_extra +
                                                        $resultadoDetalle->monto_horas_doble + $resultadoDetalle->monto_dias_feriados +
                                                        $resultadoDetalle->monto_dias_feriados_no_obligatorios + $resultadoDetalle->monto_dias_vacaciones), 2, ".", " ") }}
                                                    </strong>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0	table-striped-secondary text-dark-m1 mb-0">
                                            <thead>
                                            <tr>
                                                <th class="bgc-info text-white text-left small"><strong>DEDUCCIONES</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>CANTIDAD</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>MONTO</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>DIAS INCAPACIDAD</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->monto_dias_incapacidad }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_dias_incapacidad, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>AUSENCIAS</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->ausencias }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_ausencias, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>PERMISOS</strong></td>
                                                <td class="text-grey text-center small">{{ $resultadoDetalle->permisos }}</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_permisos, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bgc-info text-white text-center small" colspan="2"><strong>TOTAL</strong></td>
                                                <td class="bgc-info text-white text-center small">
                                                    <strong>
                                                        {!! $signo_moneda !!}
                                                        {{ number_format(($resultadoDetalle->monto_dias_incapacidad + $resultadoDetalle->monto_ausencias + $resultadoDetalle->monto_permisos), 2, ".", " ") }}
                                                    </strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: SALARIO NETO -->
                        <div class="tab-pane text-95 px-25" id="resumenTab3" role="tabpanel" aria-labelledby="resumenTab3-tab-btn">
                            <div class="form-group row mt-3">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0	table-striped-secondary text-dark-m1 mb-0">
                                            <thead>
                                            <tr>
                                                <th class="bgc-info text-white text-left small"><strong>DEDUCCIONES</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>DETALLE</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>MONTO</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>+ CCSS S.E.M.</strong></td>
                                                <td class="text-grey text-center small">{{ number_format($resultadoDetalle->porcentaje_ccss_sem, 2, ".", " ") }} %</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_ccss_sem, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>+ CCSS I.V.M.</strong></td>
                                                <td class="text-grey text-center small">{{ number_format($resultadoDetalle->porcentaje_ccss_ivm, 2, ".", " ") }} %</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_ccss_ivm, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>+ BANCO POPULAR</strong></td>
                                                <td class="text-grey text-center small">{{ number_format($resultadoDetalle->porcentaje_banco_popular, 2, ".", " ") }} %</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_banco_popular, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>+ IMPUESTO RENTA</strong></td>
                                                <td class="text-grey text-center small"></td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_renta, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey brc-black-tp10 text-left small"><strong>- CONYUGE / HIJOS *</strong></td>
                                                <td class="text-grey text-center small">
                                                    @php
                                                        $leyenda_conyuge_hijos = "";
                                                        if($resultadoDetalle->conyuge == "si"){
                                                            $leyenda_conyuge_hijos.= "C&oacute;nyuge";
                                                        }
                                                        if($resultadoDetalle->total_hijos > 0){
                                                            if($resultadoDetalle->conyuge == "si"){
                                                                $leyenda_conyuge_hijos.= " y ";
                                                            }
                                                            if($resultadoDetalle->total_hijos == 1){
                                                                $leyenda_conyuge_hijos.= "1 hijo";
                                                            }else{
                                                                $leyenda_conyuge_hijos.= sprintf("%s hijos", $resultadoDetalle->total_hijos);
                                                            }
                                                        }
                                                        echo $leyenda_conyuge_hijos;
                                                    @endphp
                                                </td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_conyuge_hijos, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bgc-info text-white text-center small" colspan="2"><strong>TOTAL</strong></td>
                                                <td class="bgc-info text-white text-center small">
                                                    <strong>
                                                        {!! $signo_moneda !!} {{ number_format($resultadoDetalle->total_cargas_renta, 2, ".", " ") }}
                                                    </strong>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <small>
                                            * El monto mensual por c&oacute;nyuge es de &cent; {{ number_format($resultadoDetalle->monto_conyuge, 2, ".", " ") }}
                                            y por cada hijo de &cent; {{ number_format($resultadoDetalle->monto_hijo, 2, ".", " ") }}.
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0	table-striped-secondary text-dark-m1 mb-0">
                                            <thead>
                                            <tr>
                                                <th class="bgc-info text-white text-center small" colspan="4"><strong>DETALLE IMPUESTO RENTA</strong></th>
                                            </tr>
                                            <tr>
                                                <th class="bgc-info text-white text-center small"><strong>RANGO INICIO</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>RANGO FINAL</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>PORCENTAJE</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>MONTO</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-grey text-center small">&cent; {{ number_format($resultadoDetalle->tramo1_inicio, 2, ".", " ") }}</td>
                                                <td class="text-grey text-center small">&cent; {{ number_format($resultadoDetalle->tramo1_final, 2, ".", " ") }}</td>
                                                <td class="text-grey text-center small">{{ number_format($resultadoDetalle->tarifa1, 2, ".", " ") }} %</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->calculo_renta1, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey text-center small">&cent; {{ number_format($resultadoDetalle->tramo2_inicio, 2, ".", " ") }}</td>
                                                <td class="text-grey text-center small">&cent; {{ number_format($resultadoDetalle->tramo2_final, 2, ".", " ") }}</td>
                                                <td class="text-grey text-center small">{{ number_format($resultadoDetalle->tarifa2, 2, ".", " ") }} %</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->calculo_renta2, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey text-center small">&cent; {{ number_format($resultadoDetalle->tramo3_inicio, 2, ".", " ") }}</td>
                                                <td class="text-grey text-center small">&cent; {{ number_format($resultadoDetalle->tramo3_final, 2, ".", " ") }}</td>
                                                <td class="text-grey text-center small">{{ number_format($resultadoDetalle->tarifa3, 2, ".", " ") }} %</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->calculo_renta3, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-grey text-center small" colspan="2">>= &cent; {{ number_format($resultadoDetalle->tramo4, 2, ".", " ") }}</td>
                                                <td class="text-grey text-center small">{{ number_format($resultadoDetalle->tarifa4, 2, ".", " ") }} %</td>
                                                <td class="text-center text-grey small">{!! $signo_moneda !!} {{ number_format($resultadoDetalle->calculo_renta4, 2, ".", " ") }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bgc-info text-white text-center small" colspan="3"><strong>TOTAL</strong></td>
                                                <td class="bgc-info text-white text-center small">
                                                    <strong>{!! $signo_moneda !!} {{ number_format($resultadoDetalle->monto_renta, 2, ".", " ") }}</strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: OTROS -->
                        <div class="tab-pane text-95 px-25" id="resumenTab4" role="tabpanel" aria-labelledby="resumenTab4-tab-btn">
                            <div class="form-group row mt-3">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0	table-striped-secondary text-dark-m1 mb-0">
                                            <thead>
                                            <tr>
                                                <th class="bgc-info text-white text-left small"><strong>INCREMENTOS</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>MONTO</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($resultadoOtros) > 0)
                                                @foreach($resultadoOtros as $info_ajuste)
                                                    @if($info_ajuste->tipo == "incremento")
                                                        <tr>
                                                            <td class="text-grey brc-black-tp10 text-left small">
                                                                {{ $info_ajuste->concepto }}
                                                            </td>
                                                            <td class="text-center text-grey small">
                                                                {!! $signo_moneda !!} {{ number_format($info_ajuste->monto, 2, ".", " ") }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-center text-grey small" colspan="2">
                                                        No hay datos registrados
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="bgc-info text-white text-center small"><strong>TOTAL</strong></td>
                                                <td class="bgc-info text-white text-center small"><strong>{!! $signo_moneda !!} {{ number_format($resultadoDetalle->total_otros_incrementos, 2, ".", " ") }}</strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0	table-striped-secondary text-dark-m1 mb-0">
                                            <thead>
                                            <tr>
                                                <th class="bgc-info text-white text-left small"><strong>DEDUCCIONES</strong></th>
                                                <th class="bgc-info text-white text-center small"><strong>MONTO</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($resultadoOtros) > 0)
                                                @foreach($resultadoOtros as $info_ajuste)
                                                    @if($info_ajuste->tipo == "deduccion")
                                                        <tr>
                                                            <td class="text-grey brc-black-tp10 text-left small">
                                                                {{ $info_ajuste->concepto }}
                                                            </td>
                                                            <td class="text-center text-grey small">
                                                                {!! $signo_moneda !!} {{ number_format($info_ajuste->monto, 2, ".", " ") }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-center text-grey small" colspan="2">
                                                        No hay datos registrados
                                                    </td>
                                                </tr
                                            @endif
                                            <tr>
                                                <td class="bgc-info text-white text-center small"><strong>TOTAL</strong></td>
                                                <td class="bgc-info text-white text-center small"><strong>{!! $signo_moneda !!} {{ number_format($resultadoDetalle->total_otras_deducciones, 2, ".", " ") }}</strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <button type="button" class="btn btn-secondary" onclick="closeMagnificPopup();">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeMagnificPopup() {
            $('.mfp-close').trigger('click');
        }
    </script>
@endsection
