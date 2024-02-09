@extends('Layouts.menu')

@section('page-content')

    <h5 class="page-title text-dark-m2 text-140 text-success-l1">
        Estado de cuenta
    </h5><br>

    <div class="row align-items-center">
        <div class="col-md-8 col-sm-12">
            <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                <strong>Saldo disponible: $ {{ number_format($infoEmpresa["monto_saldo"], 2, ".", ",") }}</strong>
            </div>
        </div>
        <div class="text-nowrap col-md-4 col-sm-12 text-md-right ">
            <a href="{{ route('facturacion.edit', [Crypt::encrypt(session()->get('id_cliente'))]) }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mr-3 mb-3">
                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                </span>
                Realizar recarga
            </a>
        </div>
    </div>

    <div class="pb-3"><hr>
        <h1 class="card-title text-125">
            Estado de cuenta <strong>{{ $infoEmpresa["nombre"] }}</strong>
            @if(($fechaInicio != "") && ($fechaFinal != ""))
                del <strong>{{ date("d/m/Y", strtotime($fechaInicio)) }}</strong> al <strong>{{ date("d/m/Y", strtotime($fechaFinal)) }}</strong>
            @endif
        </h1><br>

        <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{ route('facturacion.index') }}">
            @csrf

            <div class="form-group row mt-1">
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha Inicial') }}</label>
                    <div class="input-group input-daterange">
                        <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12 mb-3" id="fechaInicial" name="fechaInicial" required="true" value="
                        @if($fechaInicio != "")
                            {{ date("d/m/Y", strtotime($fechaInicio)) }}
                        @endif
                        "/>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha Final') }}</label>
                    <div class="input-group input-daterange">
                        <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12 mb-3" id="fechaFinal" name="fechaFinal" required="true" value="
                        @if($fechaFinal != "")
                            {{ date("d/m/Y", strtotime($fechaFinal)) }}
                        @endif
                        "/>
                    </div>
                </div>
                <div class="text-nowrap col-md-3 col-sm-12 align-self-end">
                    <button type="submit" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-3">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                            <i class="fa fa-magnifying-glass mr-1 text-white text-120 mt-3px"></i>
                        </span>
                        Buscar
                    </button>

                    <a href="{{ route('facturacion.index') }}" class="btn btn-outline-primary btn-h-blue radius-1 ml-3 mb-3 align-items-center btn-outline-blue h-5">
                        <i class="fa fa-sync text-120 mt-3px"></i>
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive mb-5">
            <h3 class="card-title text-125">
                Detalle

                <div class="float-right text-75 mr-1">
                    <i class="fa fa-square text-primary"></i> Créditos
                    <span class="mr-3"></span>
                    <i class="fa fa-square text-pink"></i> Débitos
                </div>
            </h3>
            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">

                <tr>
                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        Fecha
                    </th>

                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        Concepto
                    </th>

                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        Monto
                    </th>

                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        Saldo
                    </th>

                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        # Factura
                    </th>

                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        Monto Factura
                    </th>

                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        Estado Factura
                    </th>

                    <th scope="col" class="text-left text-md-center small align-middle font-weight-bold">
                        Descargar
                    </th>
                </tr>
                </thead>

                <tbody class="mt-1">
                    @if((isset($infoEstadoCuenta)) && ($infoEstadoCuenta != null))
                        @foreach($infoEstadoCuenta as $info)
                            @php
                                $clase_texto = "text-primary";
                                $clase_cuadro = "btn-primary";
                                if($info["tipo"] == "rebaja"){
                                    $clase_texto = "text-pink";
                                    $clase_cuadro = "btn-pink";
                                }
                            @endphp

                            <tr class="bgc-h-blue-l4 d-style">
                                <td data-label="Fecha:" class="{{ $clase_texto }} text-right text-md-center small">
                                    {{ date("d/m/Y", strtotime($info["fecha"])) }}
                                </td>

                                <td data-label="Concepto:" class="{{ $clase_texto }} text-right text-md-center small">
                                    {{ $info["concepto"] }}
                                </td>

                                <td data-label="Monto Recarga:" class="{{ $clase_texto }} text-right text-md-center">
                                    <span class="badge {{ $clase_cuadro }} badge-md mb-2">
                                        $ {{ number_format($info["monto_dolares"], 2, ".", "") }}
                                    </span>
                                </td>

                                <td data-label="Saldo:" class="text-grey-d1 text-right text-md-center">
                                    <span class="badge badge-secondary badge-md mb-2">
                                        $ {{ number_format($info["monto_saldo"], 2, ".", "") }}
                                    </span>
                                </td>

                                <td data-label="#Factura:" class="{{ $clase_texto }} text-right text-md-center">
                                    @if(($info["tipo"] == "recarga") && ($info["num_factura"] != ""))
                                        <span class="badge {{ $clase_cuadro }} badge-md mb-2">
                                            {{ $info["num_factura"] }}
                                        </span>
                                    @else
                                        <span class="text-90 text-grey">
                                            No aplica
                                        </span>
                                    @endif
                                </td>

                                <td data-label="Monto Factura:" class="{{ $clase_texto }} text-right text-md-center">
                                    @if(($info["tipo"] == "recarga") && ($info["num_factura"] != ""))
                                        <span class="badge {{ $clase_cuadro }} badge-md mb-2">
                                            $ {{ number_format($info["total_dolares"], 2, ".", "") }}
                                        </span>
                                    @else
                                        <span class="text-90 text-grey">
                                            No aplica
                                        </span>
                                    @endif
                                </td>

                                <td data-label="Estado:" class="text-right text-md-center">
                                    @if(($info["tipo"] == "recarga") && ($info["num_factura"] != ""))
                                        @if($info["estado_factura"] == "cancelada")
                                            <span class="badge btn-primary badge-md mb-2">cancelada</span>
                                        @elseif($info["estado_factura"] == "pendiente")
                                            <span class="badge btn-pink badge-md mb-2">pendiente</span>
                                        @elseif($info["estado_factura"] == "pagoParcial")
                                            <span class="badge btn-warning badge-md mb-2">pagoParcial</span>
                                        @elseif($info["estado_factura"] == "anulada")
                                            <span class="badge badge-secondary badge-md mb-2">anulada</span>
                                        @endif
                                    @else
                                        <span class="text-90 text-grey">
                                            No aplica
                                        </span>
                                    @endif
                                </td>

                                <td data-label="Descargar:">
                                    <div class="d-flex justify-content-center">
                                        @if(($info["tipo"] == "recarga") && ($info["num_factura"] != ""))
                                            <div class="float-left w-5">
                                                <div class="d-none d-lg-flex justify-content-center">
                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="PDF">
                                                        <a onClick="descargarPdfFactura('{{ $info["id"] }}');" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                            <i class="fa fa-file-pdf"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="float-left w-5">
                                                <div class="d-none d-lg-flex justify-content-center">
                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="XML">
                                                        <a onClick="descargarXmlFactura('{{ $info["id"] }}');" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                            <i class="fa fa-file-excel"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="float-left w-5">
                                                <div class="d-none d-lg-flex justify-content-center">
                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="XML Hacienda">
                                                        <a onClick="descargarXmlMHFactura('{{ $info["id"] }}');" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                            <i class="fa fa-file-excel"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            @if($info["estado_factura"] == "pendiente")
                                                <div class="float-right w-5">
                                                    <div class="d-none d-lg-flex justify-content-center">
                                                        <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Pago Tarjeta">
                                                            <a onclick="pagarFacturaPendiente('{{ Crypt::encrypt($info["id"]) }}', '{{ $info["num_factura"] }}');" class="ajax-popup-link mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                                <i class="fa fa-credit-card"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="float-right w-5">
                                                    <div class="d-none d-lg-flex justify-content-center">
                                                        <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Pago Sinpe Móvil">
                                                            <a onclick="pagarFacturaSinpeMovil('{{ Crypt::encrypt($info["id"]) }}', '{{ $info["num_factura"] }}');" class="ajax-popup-link mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                                <i class="fa fa-mobile-screen"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-90 text-grey">
                                                No aplica
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            @include('componentes.paginacion')
        </div>
    </div>
@endsection
