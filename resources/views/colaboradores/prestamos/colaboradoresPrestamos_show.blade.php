@extends('Layouts.menu')

@section('page-content')
    <h5 class="page-title text-dark-m2 text-140 text-success-l1">
        {{ __("Resumen") }}
    </h5>
    <div class="form-group row mt-4">
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __("Concepto del préstamo") }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" value="{{ $prestamo->concepto }}" readonly/>
        </div>
        <div class="col-md-6">
            <div class="mt-4 float-right">
                <a id="descargar" class="btn btn-outline-red btn-text-dark btn-h-red btn-a-red btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-red h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-file-pdf mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    {{ __("Descargar") }}
                </a>
            </div>
        </div>
    </div>

    <div class="form-group row mt-4">
        <div class="col-md-6 col-sm-12">
            <div class="table-responsive">
                <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                    <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>
                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                {{ __("Detalle") }}
                            </th>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                {{ __("Valores") }}
                            </th>
                        </tr>
                    </thead>

                    <tbody class="mt-1">
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Importe del préstamo") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    @if($prestamo->nombre_moneda == "colones")
                                        &cent;
                                    @else
                                        &dollar;
                                    @endif
                                    {{ number_format($prestamo->monto, 2, ".", " ") }}
                                </span>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Tasa de interés anual") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    {{ $prestamo->tasa_interes }}%
                                </span>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Período del préstamo en años") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    @if(($prestamo->cantidad_cuotas/12) == 1)
                                        {{ $prestamo->cantidad_cuotas/12 }} {{ __("año") }}
                                    @else
                                        {{ $prestamo->cantidad_cuotas/12 }} {{ __("años") }}
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Fecha de inicio del préstamo") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    {{ date("d/m/Y", strtotime($prestamo->fecha_inicio)) }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="table-responsive">
                <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                    <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>
                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                {{ __("Detalle") }}
                            </th>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                {{ __("Valores") }}
                            </th>
                        </tr>
                    </thead>

                    <tbody class="mt-1">
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Pago Mensual") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    @if($prestamo->nombre_moneda == "colones")
                                        &cent;
                                    @else
                                        &dollar;
                                    @endif
                                    {{ number_format($prestamo->monto_cuota, 2, ".", " ") }}
                                </span>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Número de pagos") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    {{ $total_pagos_realizados }}
                                </span>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Importe total de los intereses") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    @if($prestamo->nombre_moneda == "colones")
                                        &cent;
                                    @else
                                        &dollar;
                                    @endif
                                    {{ number_format($total_intereses_pagados, 2, ".", " ") }}
                                </span>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center small'>
                                {{ __("Total Préstamo") }}
                            </td>

                            <td data-label="Valores:" class='text-grey-d1 text-right text-md-center'>
                                <span class="badge badge-primary badge-lg mb-2">
                                    @if($prestamo->nombre_moneda == "colones")
                                        &cent;
                                    @else
                                        &dollar;
                                    @endif
                                    {{ number_format(($prestamo->monto_cuota * $prestamo->cantidad_cuotas), 2, ".", " ") }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-5 bcard">
        <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
            <li class="nav-item mr-2px">
                <a id="pagosRealizados-tab" class="d-style active btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#pagosRealizados" role="tab" aria-controls="pagosRealizados" aria-selected="false">
                    <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                    Pagos Realizados
                </a>
            </li>

            <li class="nav-item mr-2px">
                <a id="amortizacion-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#amortizacion" role="tab" aria-controls="amortizacion" aria-selected="true">
                    <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                    Amortización Proyectada
                </a>
            </li>

            @if($prestamo->estado == "pendiente")
                <li class="nav-item mr-2px">
                    <a id="abonosExtra-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#abonosExtra" role="tab" aria-controls="pagosRealizados" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        Abonos Extra
                    </a>
                </li>
            @endif
        </ul>

        <div class="tab-content bgc-white p-35 border-0">
            <div class="tab-pane fade show active text-95" id="pagosRealizados" role="tabpanel" aria-labelledby="pagos-tab-btn">
                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Número de Pago") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Detalle") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Fecha de pago") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Inicio de saldo") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Pago") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Principal") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Interés") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("Fin Saldo") }}
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        {{ __("# Comprobante") }}
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="mt-1">
                                @if(count($pagos) > 0)
                                    @foreach($pagos as $info_pago)
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td data-label="Número de Pago:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                {{ $info_pago->numero_cuota }}
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>

                                            <td data-label="Detalle:" class='text-grey-d1 text-left text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif

                                                @if($info_pago->abono_extra == 0)
                                                    Pago cuota
                                                @else
                                                    Abono extra
                                                @endif
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>

                                            <td data-label="Fecha de pago:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                {{ date("d/m/Y", strtotime($info_pago->fecha_pago)) }}
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>

                                            <td data-label="Inicio de saldo:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                @if($info_pago->nombre_moneda == "colones")
                                                    &cent;
                                                @else
                                                    &dollar;
                                                @endif
                                                {{ number_format($info_pago->saldo_anterior, 2, ".", " ") }}
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>

                                            <td data-label="Pago:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                @if($info_pago->nombre_moneda == "colones")
                                                    &cent;
                                                @else
                                                    &dollar;
                                                @endif
                                                {{ number_format($info_pago->monto_pago, 2, ".", " ") }}
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>

                                            <td data-label="Principal:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                @if($info_pago->nombre_moneda == "colones")
                                                    &cent;
                                                @else
                                                    &dollar;
                                                @endif
                                                {{ number_format($info_pago->monto_amortizacion, 2, ".", " ") }}
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>

                                            <td data-label="Interés:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                @if($info_pago->nombre_moneda == "colones")
                                                    &cent;
                                                @else
                                                    &dollar;
                                                @endif
                                                {{ number_format($info_pago->monto_interes, 2, ".", " ") }}
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>

                                            <td data-label="Fin Saldo:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                @if($info_pago->nombre_moneda == "colones")
                                                    &cent;
                                                @else
                                                    &dollar;
                                                @endif
                                                {{ number_format($info_pago->saldo_actual, 2, ".", " ") }}
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>
                                            <td data-label="# Comprobante:" class='text-grey-d1 text-right text-md-center small'>
                                                @if($info_pago->cancelado == 1)
                                                    <del class="text-orange">
                                                @endif
                                                <p>{{ $info_pago->numero_comprobante }}</p>
                                                @if($info_pago->cancelado == 1)
                                                    </del>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td colspan="9" class='text-grey-d1 text-center text-md-center small'>
                                            No hay pagos registrados
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade text-95" id="amortizacion" role="tabpanel" aria-labelledby="amortizacion-tab-btn">
                <div class="align-items-end">
                    <div class="text-nowrap align-self-end pl-md-2">
                        <div class="ml-sm-0 pb-4">
                            <div class="d-flex flex-row-reverse">
                                <div class="px-1">
                                    <a id="excel_tabla_proyeccion" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                        <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                            <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                                        </span>
                                        Exportar excel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                        <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                # Pago
                            </th>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                Inicial
                            </th>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                Cuota Mensual
                            </th>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                Interés
                            </th>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                Amortización
                            </th>

                            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                Saldo Final
                            </th>
                        </tr>
                        </thead>

                        <tbody class="mt-1">
                        @if(count($pagos_proyeccion) > 0)
                            @foreach($pagos_proyeccion as $info_pago_proyeccion)
                                <tr class="bgc-h-blue-l4 d-style">
                                    <td data-label="# Pago:" class="text-grey-d1 text-right text-md-center small">
                                        {{  $info_pago_proyeccion->periodo }}
                                    </td>

                                    <td data-label="Inicial:" class="text-grey-d1 text-right text-md-center small">
                                        @if($prestamo->nombre_moneda == "colones")
                                            &cent;
                                        @else
                                            &dollar;
                                        @endif
                                        {{  number_format((float)$info_pago_proyeccion->saldo, 2, ".", " ") }}
                                    </td>

                                    <td data-label="Cuota Mensual:" class="text-grey-d1 text-right text-md-center small">
                                        @if($prestamo->nombre_moneda == "colones")
                                            &cent;
                                        @else
                                            &dollar;
                                        @endif
                                        {{  number_format((float)$info_pago_proyeccion->cuota, 2, ".", " ") }}
                                    </td>

                                    <td data-label="Interés:" class="text-grey-d1 text-right text-md-center small">
                                        @if($prestamo->nombre_moneda == "colones")
                                            &cent;
                                        @else
                                            &dollar;
                                        @endif
                                        {{  number_format((float)$info_pago_proyeccion->interes, 2, ".", " ") }}
                                    </td>

                                    <td data-label="Amortización:" class="text-grey-d1 text-right text-md-center small">
                                        @if($prestamo->nombre_moneda == "colones")
                                            &cent;
                                        @else
                                            &dollar;
                                        @endif
                                        {{  number_format((float)$info_pago_proyeccion->amortizacion, 2, ".", " ") }}
                                    </td>

                                    <td data-label="Saldo Final:" class="text-grey-d1 text-right text-md-center small">
                                        @if($prestamo->nombre_moneda == "colones")
                                            &cent;
                                        @else
                                            &dollar;
                                        @endif
                                        {{  number_format((float)$info_pago_proyeccion->saldo_final, 2, ".", " ") }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade text-95" id="abonosExtra" role="tabpanel" aria-labelledby="abonos-tab-btn">
                <form class="mt-lg-3" id="frm-abonos" name="frm-abonos" autocomplete="off" method="POST" action="{{route('aplicarAbonoExtraPrestamo')}}">
                    @csrf
                    <div class="form-group row mt-4 align-items-end">
                        <div class="col-md-3 col-sm-12">
                            <label for="" class="mb-0 text-blue-m1">Monto Pago</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="spanSignoMoneda input-group-text">
                                        @if($prestamo->nombre_moneda == "colones")
                                            &cent;
                                        @else
                                            &dollar;
                                        @endif
                                    </span>
                                </div>
                                <input type="text" min="0" lang="es" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="montoAbono" name="montoAbono"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label for="" class="mb-0 text-blue-m1">Fecha Pago</label>
                            <div class="input-group input-daterange">
                                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaAbono" name="fechaAbono" />
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label for="" class="mb-0 text-blue-m1">N&uacute;mero Comprobante</label>
                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numComprobante" name="numComprobante">
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <button type="submit" id="guardar" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                </span>
                                Registrar
                            </button>
                        </div>
                    </div>

                    <input type="hidden" id="id_colaborador" name="id_colaborador" value="{{ $idColaborador }}">
                    <input type="hidden" id="id_prestamo" name="id_prestamo" value="{{ $idPrestamo }}">
                </form>
            </div>
        </div>
    </div>

    <div class="brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap"></div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $("#guardar").on("click", function (evt){
            $("#confirmModal").modal("hide");

            if($("#frm-abonos").valid()) {
                $("#cargando").modal("show");
            }
        });

        $("#frm-abonos").validate({
            ignore: ".ignore",
            errorElement: "div",
            errorClass: "help-block",
            focusInvalid: false,
            rules: {
                montoAbono: {
                    required: true,
                    validaMontoAbono: true
                },
                fechaAbono: {
                    required: true
                },
                numComprobante: {
                    required: true
                }
            },
            messages: {
                montoAbono: {
                    required: "Este campo es requerido.",
                    validaMontoAbono: "Monto de pago mayor al saldo pendiente"
                },
                fechaAbono: {
                    required: "Este campo es requerido."
                },
                numComprobante: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : "span"
        });

        $.validator.addMethod("validaMontoAbono", function(value, element) {
            var monto_cuota = $("#montoAbono").val();
            var saldo_pendiente = '{{  $saldo_pendiente }}';
            var validacion_abono = true;
            if(parseFloat(monto_cuota) > parseFloat(saldo_pendiente)){
                validacion_abono = false;
            }
            return validacion_abono;
        });

        $("#descargar").on("click", function (evt){
            $.ajax({
                type: "POST",
                headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                url: "{{ route('descargarPdfPrestamo') }}",
                data: {
                    "id_colaborador": '{{  $idColaborador }}',
                    "id_prestamo": '{{  $idPrestamo }}'
                },
                beforeSend: function() {
                    $("#cargando").modal("show");
                },
                success: function(url_pdf){
                    if(url_pdf != ""){
                        window.open(url_pdf, "_blank");
                        return false;
                    }
                },
                complete: function(response) {
                    $("#cargando").modal("hide");
                },
                error: function (response) {
                    alert(response.responseJSON.message);
                }
            });
        });

        $("#excel_tabla_proyeccion").on("click", function (evt){
            $.ajax({
                type: "POST",
                headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                url: "{{ route('descargarExcelTablaAmortizacionProyectada') }}",
                data: {
                    "monto": '{{  $prestamo->monto }}',
                    "interes_anual": '{{  $prestamo->tasa_interes }}',
                    "total_cuotas": '{{  $prestamo->cantidad_cuotas }}'
                },
                beforeSend: function() {
                    $("#cargando").modal("show");
                },
                success: function(url_excel){
                    if(url_excel != ""){
                        window.open(url_excel, "_self");
                        return false;
                    }
                },
                complete: function(response) {
                    $("#cargando").modal("hide");
                },
                error: function (response) {
                    alert(response.responseJSON.message);
                }
            });
        });
    </script>
@endpush
