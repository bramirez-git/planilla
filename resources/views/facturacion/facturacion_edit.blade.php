@extends('Layouts.menu')

@section('page-content')

    <h5 class="page-title text-dark-m2 text-140 text-success-l1">
        Recarga de Saldo - Datos para la recarga
    </h5><br>

    <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
        <strong>Saldo disponible: $ {{ number_format($infoEmpresa["monto_saldo"], 2, ".", ",") }}</strong>
        <a href="{{ route('facturacion.index', [Crypt::encrypt(session()->get('id_cliente'))]) }}" class="alert-link text-primary-d1 ml-2">
            [Ver estado de cuenta]
        </a>
    </div>

    <div>
        @if($totalFacturasPendientes > 0)
            <div class="alert d-flex bgc-red-l3 brc-success-m4 border-0 p-0" role="alert">
                <div class="bgc-red px-3 py-1 text-center radius-l-1">
                    <span class="fa-2x text-white">
                        <i class="fa fa-warning"></i>
                  </span>
                </div>

                <span class="ml-3 align-self-center text-dark-tp3 text-110">
                    En éste momento no puede realizar recargas, para realizar una recarga debe cancelar primero la factura o facturas que tenga pendientes de pago.
                </span>
            </div>
        @else
            <form id="formRecarga" autocomplete="off" method="POST" onsubmit="return validarFormularioPago();" action="javascript: pagoEnLinea();">
                @csrf
                @method('POST')

                <p class="input-group">
                    <label for="correoFactura" class="mt-1 mr-2">
                        La factura será enviada al siguiente correo, si desea adicionar un contacto puede escribir el correo electrónico separado por coma.
                        <!--<a href="{{ route('miCuenta.edit', [Crypt::encrypt(session()->get("id_usuario"))]) }}" class="alert-link text-primary-d1">
                            Mi cuenta.
                        </a>--><br>

                        @php
                            $correoFactura = "";
                            if((isset($infoComunicacion["correo_pagos"])) && ($infoComunicacion["correo_pagos"] != "")){
                                $correoFactura = $infoComunicacion["correo_pagos"];
                            }else{
                                $correoFactura = $infoEmpresa["correo_contacto"];
                            }
                        @endphp

                        <input type="text" id="correoFactura" name="correoFactura" class="w-50 mt-2" value="{{ $correoFactura }}" style="color: #51575d; background-color: #fff; border: 1px solid #d3d5d7; border-radius: 0.125rem; display: block; width: 100%; height: calc(1.5em + 0.75rem + 2px); padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5;">
                    </label>
                </p>

                <div class="pb-3">
                    <div class="bcard mt-4">
                        <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
                            <li class="nav-item mr-2px">
                                <a id="recarga-tab" onClick="cambiarModalidad('recarga');" class="d-style active btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#recarga" role="tab" aria-controls="recarga" aria-selected="true">
                                    <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                                    Recarga
                                </a>
                            </li>

                            <li class="nav-item mr-2px">
                                <a id="cargoAutomatico-tab" onClick="cambiarModalidad('cargo_automatico');" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#cargoAutomatico" role="tab" aria-controls="cargoAutomatico" aria-selected="false">
                                    <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                                    Cargo automático
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content bgc-white p-35 border-0">
                            <div class="tab-pane fade show active text-95" id="recarga" role="tabpanel" aria-labelledby="home1-tab-btn">
                                <div class="form-group row mt-2">
                                    <div class="col-md-6 col-sm-12 col-lg-3 pt-2 pt-lg-0">
                                        <label for="monedaPago1" class="mb-0 text-blue-m1"> Moneda: </label>
                                        <div class="input-group">
                                            <select id="monedaPago1" name="monedaPago1" class="form-control" onchange="cambioMoneda(this.value);">
                                                <option value="dolares">Dólares</option>
                                                <option value="colones">Colones</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-3 pt-2 pt-lg-0">
                                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> Monto a recargar: </label>
                                        <div class="input-group">
                                            <select id="montoRecarga" name="montoRecarga" class="form-control" onchange="calcularTotal();">
                                                <option value="">Seleccione...</option>
                                                <option value="10">$ 10</option>
                                                <option value="25">$ 25</option>
                                                <option value="50">$ 50</option>
                                                <option value="100">$ 100</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-3 pt-2 pt-lg-0">
                                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 "> I.V.A. a pagar:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text spanMoneda">$</span>
                                            </div>
                                            <input type="text" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="ivaPagar" name="ivaPagar" value="0.00" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-3 pt-2 pt-lg-0">
                                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Total a pagar:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text spanMoneda">$</span>
                                            </div>
                                            <input type="text" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="totalPagar" name="totalPagar" value="0.00" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-sm-12">
                                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Total a pagar equivalente a CRC: ₡{{ number_format($tipoCambioDolar, 2, ".", ",") }}</label>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-sm-12">
                                        <input type="hidden" id="accion" name="accion" value="pagoRecarga">
                                        <input type="hidden" id="modalidad" name="modalidad" value="recarga">
                                        <input type="hidden" id="tipoPago" name="tipoPago" value="tarjeta">
                                        <input type="hidden" id="tarifaImpuesto" name="tarifaImpuesto" value="{{ $infoEmpresa["tarifa_impuesto"] }}">

                                        <div class="bgc-white" style="margin-left: -20px; margin-right:-20px;">
                                            <ul class="nav nav-tabs nav-justified nav-tabs-simple nav-tabs-scroll border-b-1 brc-dark-l3 " role="tablist">

                                                <li class="nav-item mr-1px">
                                                    <a class="active pos-rel d-style btn btn-lighter-success btn-bgc-lighter-success btn-h-outline-green btn-h-bgc-white btn-a-green py-2 btn-brc-tp border-none border-t-3 radius-0 letter-spacing" id="recarga-tarjeta-tab-btn" data-toggle="tab" href="#recarga-tarjeta" role="tab" aria-selected="true" onClick="cambioTipoPago('tarjeta');">
                                                        <span class=""></span>
                                                        <i class="nav-icon fa fa-credit-card text-180 d-block my-1"></i>
                                                        <span class="text-90">
                                                            Tarjeta
                                                        </span>
                                                    </a>
                                                </li>

                                                <li class="nav-item mr-1px">
                                                    <a class="pos-rel d-style btn btn-lighter-purple btn-bgc-lighter-purple btn-h-outline-purple btn-h-bgc-white btn-a-purple py-2 btn-brc-tp border-none border-t-3 radius-0 letter-spacing" id="recarga-transferencia-tab-btn" data-toggle="tab" href="#recarga-transferencia" role="tab" aria-selected="false" onClick="cambioTipoPago('transferencia');">
                                                        <span class=""></span>
                                                        <i class="nav-icon fa fa-money-check-alt text-180 d-block my-1"></i>
                                                        <span class="text-90">
                                                            Transferencia
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content bgc-white p-35 border-0">
                                                <div class="tab-pane fade show active text-95" id="recarga-tarjeta" role="tabpanel" aria-labelledby="recarga-tarjeta-tab-btn">

                                                    <div class="pb-3">
                                                        <!-- Campos tarjeta -->
                                                        <div class="row align-items-center ml-5">
                                                            <div class="col-md-6 col-sm-12 px-0 px-md-1">
                                                                <!-- Tarjeta -->
                                                                <section class="tarjeta" id="tarjeta1">
                                                                    <div class="delantera">
                                                                        <div class="logo-marca" id="logo-marca1">
                                                                            <!-- <img src="img/logos/visa.png" alt=""> -->
                                                                        </div>
                                                                        <img  src="{{ asset('estilos/node_modules/PayCards/img/chip-tarjeta.png') }}" class="chip" alt="">
                                                                        <div class="datos ">
                                                                            <div class="grupo" id="numero1">
                                                                                <p class="label">Número Tarjeta</p>
                                                                                <p class="numero text-105">#### #### #### ####</p>
                                                                            </div>
                                                                            <div class="flexbox">
                                                                                <div class="grupo" id="nombre1" style="width: 140px">
                                                                                    <p class="label">Nombre Tarjeta</p>
                                                                                    <p class="nombre text-105 text-truncate" data-toggle="tooltip" data-placement="top" title="Aqui el nombre" type="button"></p>
                                                                                </div>

                                                                                <div class="grupo" id="expiracion1">
                                                                                    <p class="label">Expiración</p>
                                                                                    <p class="expiracion text-105"><span class="mes">MM</span> / <span class="year">AA</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="trasera">
                                                                        <div class="barra-magnetica"></div>
                                                                        <div class="datos">
                                                                            <div class="grupo group-firma" id="firma1">
                                                                                <p class="label">Firma</p>
                                                                                <div class="firma"><p></p></div>
                                                                            </div>
                                                                            <div class="grupo group-ccv">
                                                                                <p class="label">CCV</p>
                                                                                <p class="ccv" id="ccv1"></p>
                                                                            </div>
                                                                        </div>
                                                                        <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
                                                                        <a href="#" class="link-banco">www.tubanco.com</a>
                                                                    </div>
                                                                </section>
                                                            </div>

                                                            <div class="col-md-6 col-sm-12">
                                                                <!-- Formulario -->
                                                                <div class="formulario-tarjeta active mt-4 mt-md-0" id="formulario-tarjeta1">
                                                                    <div class="grupo">
                                                                        <label for="inputNumero">Número Tarjeta</label>
                                                                        <input type="text" class="inputNumero" id="inputNumero1" name="inputNumero1" maxlength="19" autocomplete="off">
                                                                    </div>
                                                                    <div class="grupo">
                                                                        <label for="inputNombre" >Nombre</label>
                                                                        <input type="text" class="inputNombre" id="inputNombre1" name="inputNombre1" maxlength="19" autocomplete="off" >
                                                                    </div>

                                                                    <div class="flexbox">
                                                                        <div class="grupo expira">
                                                                            <label for="selectMes">Expiración</label>
                                                                            <div class="flexbox">
                                                                                <div class="grupo-select">
                                                                                    <select name="selectMes1" id="selectMes1" >
                                                                                        <option value="" selected>Mes</option>
                                                                                    </select>
                                                                                    <i class="fas fa-angle-down"></i>
                                                                                </div>
                                                                                <div class="grupo-select">
                                                                                    <select name="selectYear1" id="selectYear1">
                                                                                        <option value="" selected>Año</option>
                                                                                    </select>
                                                                                    <i class="fas fa-angle-down"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="grupo group-ccv">
                                                                            <label for="inputCCV">CCV</label>
                                                                            <input type="text" id="inputCCV1" name="inputCCV1" maxlength="3" >
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-primary btn-lg btn-block px-4 btn-bold mt-4 mb-3">
                                                                        Pago Tarjeta
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Campos tarjeta fin -->
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade text-95" id="recarga-transferencia" role="tabpanel" aria-labelledby="recarga-transferencia-tab-btn">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label for="numeroTransferencia" class="mb-0 text-blue-m1"> No. depósito/transferencia: </label>
                                                            <input type="text" id="numeroTransferencia" name="numeroTransferencia" style="color: #51575d; background-color: #fff; border: 1px solid #d3d5d7; border-radius: 0.125rem; display: block; width: 100%; height: calc(1.5em + 0.75rem + 2px); padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5;">
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label for="codBanco" class="mb-0 text-blue-m1"> {{ __('Banco') }} </label>
                                                            <select id="codBanco" name="codBanco" style="color: #51575d; background-color: #fff; border: 1px solid #d3d5d7; border-radius: 0.125rem; display: block; width: 100%; height: calc(1.5em + 0.75rem + 2px); padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5;">
                                                                <option value="">Seleccione una opción...</option>
                                                                <option value="BAC">BAC San José</option>
                                                                <option value="BCR">Banco Costa Rica</option>
                                                                <option value="BN">Banco Nacional</option>
                                                                <option value="PROMERICA">Promérica</option>
                                                                <option value="SCOTIABANK">Scotiabank</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-lg-12 col-xl-12 pt-2 pt-lg-0 mt-3">
                                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Comentarios u observaciones') }}</label>
                                                            <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="comentarios" name="comentarios"></textarea>
                                                        </div>

                                                        <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2">
                                                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-4 px-4 btn-bold">
                                                                Registrar transferencia
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade text-95" id="cargoAutomatico" role="tabpanel" aria-labelledby="profile1-tab-btn">
                                <div class="mt-3 mb-3" style="@php if($infoEmpresa["cargo_automatico"] == 0){ echo "display:none"; } @endphp">
                                    <input type="checkbox" id="chkCargoAutomatico" name="chkCargoAutomatico" value="1" checked onChange="desactivarCargoAutomatico();"> Estoy afiliado al sistema de
                                    Cargo Automático.

                                    <!-- Mostrar tarjeta cargo automatico -->
                                    @if((isset($infoTarjeta)) && ($infoTarjeta != null))
                                        <div class="px-3 mt-5">
                                            <div class="row align-items-center ml-5">
                                                <div class="col-md-6 col-sm-12 px-0 px-md-1">
                                                    <section class="tarjeta" id="tarjeta3">
                                                        <div class="delantera">
                                                            <div class="logo-marca" id="logo-marca3">
                                                                <!-- <img src="img/logos/visa.png" alt=""> -->
                                                            </div>
                                                            <img  src="{{ asset('estilos/node_modules/PayCards/img/chip-tarjeta.png') }}" class="chip" alt="">
                                                            <div class="datos ">
                                                                <div class="grupo" id="numero3">
                                                                    <p class="label">Número Tarjeta</p>
                                                                    <p class="numero text-105">{{ $infoTarjeta["numero"] }}</p>
                                                                </div>
                                                                <div class="flexbox">
                                                                    <div class="grupo" id="nombre3" style="width: 140px">
                                                                        <p class="label">Nombre Tarjeta</p>
                                                                        <p class="nombre text-105 text-truncate" data-toggle="tooltip" data-placement="top" title="Aqui el nombre" type="button">
                                                                            {{ $infoTarjeta["nombre"] }}
                                                                        </p>
                                                                    </div>

                                                                    <div class="grupo" id="expiracion3">
                                                                        <p class="label">Expiración</p>
                                                                        <p class="expiracion text-105">
                                                                            {{ $infoTarjeta["fecha_expiracion"] }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="trasera">
                                                            <div class="barra-magnetica"></div>
                                                            <div class="datos">
                                                                <div class="grupo group-firma" id="firma3">
                                                                    <p class="label">Firma</p>
                                                                    <div class="firma"><p>{{ $infoTarjeta["nombre"] }}</p></div>
                                                                </div>
                                                                <div class="grupo group-ccv">
                                                                    <p class="label">CCV</p>
                                                                    <p class="ccv" id="ccv3">###</p>
                                                                </div>
                                                            </div>
                                                            <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
                                                            <a href="#" class="link-banco">www.tubanco.com</a>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Fin mostrar tarjeta cargo automatico -->
                                </div>

                                <div style="@php if($infoEmpresa["cargo_automatico"] == 1){ echo "display:none"; } @endphp">
                                    Descripción:<br><br>
                                    Si desea afiliarse al sistema de cargo automático con su tarjeta de crédito o
                                    débito para la renovación de la membresía de FacturaProfesional.com, favor de
                                    completar la siguiente información y aceptar el reglamento. Se aceptan los siguientes
                                    tipos de tarjetas VISA / MASTER CARD / AMERICAN EXPRESS.
                                    <br><br>
                                    <div class="pb-3">
                                        <!-- campos tarjeta #2 -->
                                        <div class="row align-items-center ml-5">
                                            <div class="col-md-6 col-sm-12 px-0 px-md-1">
                                                <!-- Tarjeta -->
                                                <section class="tarjeta" id="tarjeta2">
                                                    <div class="delantera">
                                                        <div class="logo-marca" id="logo-marca2">
                                                            <!-- <img src="img/logos/visa.png" alt=""> -->
                                                        </div>
                                                        <img  src="{{ asset('estilos/node_modules/PayCards/img/chip-tarjeta.png') }}" class="chip" alt="">
                                                        <div class="datos ">
                                                            <div class="grupo" id="numero2">
                                                                <p class="label">Número Tarjeta</p>
                                                                <p class="numero text-105">#### #### #### ####</p>
                                                            </div>
                                                            <div class="flexbox">
                                                                <div class="grupo" id="nombre2" style="width: 140px">
                                                                    <p class="label">Nombre Tarjeta</p>
                                                                    <p class="nombre text-105 text-truncate" data-toggle="tooltip" data-placement="top" title="Aqui el nombre" type="button"></p>
                                                                </div>

                                                                <div class="grupo" id="expiracion2">
                                                                    <p class="label">Expiración</p>
                                                                    <p class="expiracion text-105"><span class="mes">MM</span> / <span class="year">AA</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="trasera">
                                                        <div class="barra-magnetica"></div>
                                                        <div class="datos">
                                                            <div class="grupo group-firma" id="firma2">
                                                                <p class="label">Firma</p>
                                                                <div class="firma"><p></p></div>
                                                            </div>
                                                            <div class="grupo group-ccv">
                                                                <p class="label">CCV</p>
                                                                <p class="ccv" id="ccv2"></p>
                                                            </div>
                                                        </div>
                                                        <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
                                                        <a href="#" class="link-banco">www.tubanco.com</a>
                                                    </div>
                                                </section>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <!-- Formulario -->
                                                <div class="formulario-tarjeta active mt-4 mt-md-0" id="formulario-tarjeta2">
                                                    <div class="grupo">
                                                        <label for="inputNumero">Número Tarjeta</label>
                                                        <input type="text" class="inputNumero" id="inputNumero2" name="inputNumero2" maxlength="19" autocomplete="off">
                                                    </div>
                                                    <div class="grupo">
                                                        <label for="inputNombre" >Nombre</label>
                                                        <input type="text" class="inputNombre" id="inputNombre2" name="inputNombre2" maxlength="19" autocomplete="off" >
                                                    </div>

                                                    <div class="flexbox">
                                                        <div class="grupo expira">
                                                            <label for="selectMes">Expiración</label>
                                                            <div class="flexbox">
                                                                <div class="grupo-select">
                                                                    <select name="selectMes2" id="selectMes2" >
                                                                        <option value="" selected>Mes</option>
                                                                    </select>
                                                                    <i class="fas fa-angle-down"></i>
                                                                </div>
                                                                <div class="grupo-select">
                                                                    <select name="selectYear2" id="selectYear2">
                                                                        <option value="" selected>Año</option>
                                                                    </select>
                                                                    <i class="fas fa-angle-down"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="grupo group-ccv">
                                                            <label for="inputCCV">CCV</label>
                                                            <input type="text" id="inputCCV2" name="inputCCV2" maxlength="3" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fin campos tarjeta #2 -->
                                    </div>

                                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2">
                                        <label class="input-group d-inline-block mt-3 mb-0 text-secondary-d2">
                                            <input type="checkbox" class="mr-1" id="chkTerminos" name="chkTerminos"/>
                                            <span class="text-dark-m3">Aceptar el
                                                <a href="#" class="text-blue-d2" data-toggle="modal" data-target="#reglamento">
                                                    reglamento
                                                </a>
                                            </span>
                                        </label>

                                        <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-3">
                                            Registrar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade " id="reglamento" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title text-blue-d2">
                                                Reglamento de cargo automático
                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body ace-scrollbar">
                                            Este reglamento regula el sistema de cargos automáticos para el pago de las
                                            licencias de software de factura electrónica (Factura Profesional) de Cyberfuel S.A.,
                                            posterior al pago inicial.<br>
                                            El cliente autoriza a Cyberfuel S.A. a utilizar la información de tarjeta de crédito
                                            o débito para hacer el débito correspondiente a la mensualidad o anualidad del pago
                                            del monto de renovación de la licencia de utilización del software de Factura Profesional,
                                            conforme al plan adquirido y el tipo de periodicidad: mensual o anual.<br>
                                            Para inscribirse en el sistema de cargo automático el cliente debe suministrar la información
                                            en este formulario de la tarjeta de crédito o débito: número de tarjeta y su fecha de
                                            vencimiento, e indicar la aceptación de este reglamento.<br><br>

                                            Los cargos automáticos se realizarán tres días antes de vencerse la suscripción, con la
                                            posibilidad de reintento los días posteriores en caso de fallo.<br>
                                            El precio del servicio de Factura Profesional es en dólares; si el cliente solicita
                                            efectuar el pago en colones, este se hará basado en el tipo de cambio de Monex del BCCR
                                            del día de emisión de la factura.<br>
                                            A partir del 1 de Julio del 2019 se cobrara el I.V.A. en todos nuestros servicios
                                            conforme a la ley de fortalecimiento de las finanzas públicas.<br><br>

                                            Cyberfuel S.A. desactivará la tarjeta en el sistema de cargo automático,
                                            una semana antes del vencimiento e informará por el correo electrónico de contacto
                                            de la empresa, para que proceda de nuevo a suscribir un cargo automático con la
                                            tarjeta renovada u otra tarjeta que se encuentre vigente.<br>
                                            Además, Cyberfuel S.A. se reserva el derecho de desactivar la tarjeta en el
                                            sistema de cargo automático bajo los criterios que se consideren oportunos.<br><br>

                                            En cualquier caso de fallo ocurrido durante el cargo automático, el cliente deberá
                                            pagar la factura por otro método de pago o llamando al call center de Cyberfuel S.A.
                                            al teléfono 22049494. Posteriormente podrá suscribirse de nuevo al sistema de cargo
                                            automático para las posteriores renovaciones.<br>
                                            El cliente puede desinscribir el servicio de cargo automático en el momento que lo desee.
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
