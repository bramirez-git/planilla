<div class="card-body">
    <form id="formPagoPendiente" autocomplete="off" method="POST" action="javascript: pagoFacturaPendiente();">
        @csrf

        <div class="row align-items-center mt-n4">
            <div class="col-md-6 px-0 px-md-1">
                <div class="row mb-3 text-center">
                    <div class="col-md-6 pt-2 pt-lg-0">
                        <label class="mb-0 text-blue-m1 text-110"> Monto dólares: </label><br>
                        $ {{ number_format($infoRecarga["monto_dolares"], 2, ".", ",") }}
                    </div>
                    <div class="col-md-6 pt-2 pt-lg-0">
                        <label class="mb-0 text-blue-m1 text-110"> Monto colones: </label><br>
                        ₡ {{ number_format($infoRecarga["monto_colones"], 2, ".", ",") }}
                    </div>
                </div>

                <!-- Tarjeta -->
                <section class="tarjeta ml-5" id="tarjeta1">
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

            <div class="col-md-6">
                <!-- Formulario -->
                <div class="formulario-tarjeta active mt-4 mt-md-0" id="formulario-tarjeta1">
                    <div class="grupo">
                        <label for="monedaPago1">Moneda para pago</label>
                        <select id="monedaPago1" name="monedaPago1" class="grupo-select">
                            <option value="dolares">Dólares</option>
                            <option value="colones">Colones</option>
                        </select>
                    </div>
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

        <input type="hidden" id="accion" name="accion" value="pagoFactura">
        <input type="hidden" id="idRecarga" name="idRecarga" value="{{ $idRecarga }}">
    </form>
</div>

<script src="{{ asset('js/scripts/admin/facturacion_pago.min.js') }}?t={{ filemtime(public_path('js/scripts/admin/facturacion_pago.min.js')) }}"></script>

