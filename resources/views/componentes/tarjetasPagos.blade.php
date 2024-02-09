@if(isset($id_input))
    <div class="row align-items-center">
        <div class="col-md-6 col-sm-12 px-0 px-md-1">
            <!-- Tarjeta -->
            <section class="tarjeta" id="tarjeta{{$id_input}}">
                <div class="delantera">
                    <div class="logo-marca" id="logo-marca{{$id_input}}">
                        <!-- <img src="img/logos/visa.png" alt=""> -->
                    </div>
                    <img  src="{{ asset('estilos/node_modules/PayCards/img/chip-tarjeta.png') }}" class="chip" alt="">
                    <div class="datos ">
                        <div class="grupo" id="numero{{$id_input}}">
                            <p class="label">Número Tarjeta</p>
                            <p class="numero text-105">#### #### #### ####</p>
                        </div>
                        <div class="flexbox">
                            <div class="grupo" id="nombre{{$id_input}}" style="width: 140px">
                                <p class="label">Nombre Tarjeta</p>
                                <p class="nombre text-105 text-truncate" data-toggle="tooltip" data-placement="top" title="Aqui el nombre" type="button"></p>
                            </div>

                            <div class="grupo" id="expiracion{{$id_input}}">
                                <p class="label">Expiración</p>
                                <p class="expiracion text-105"><span class="mes">MM</span> / <span class="year">AA</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trasera">
                    <div class="barra-magnetica"></div>
                    <div class="datos">
                        <div class="grupo group-firma" id="firma{{$id_input}}">
                            <p class="label">Firma</p>
                            <div class="firma"><p></p></div>
                        </div>
                        <div class="grupo group-ccv">
                            <p class="label">CCV</p>
                            <p class="ccv" id="ccv{{$id_input}}"></p>
                        </div>
                    </div>
                    <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
                    <a href="#" class="link-banco">www.tubanco.com</a>
                </div>
            </section>

            <!-- Contenedor Boton Abrir Formulario -->
            <!--<div class="contenedor-btn">
                <button type="button" class="btn-abrir-formulario" id="btn-abrir-formulario">
                    <i class="fas fa-plus"></i>
                </button>
            </div>-->

        </div>

        <div class="col-md-6 col-sm-12">
            <!-- Formulario -->
            <div class="formulario-tarjeta active mt-4 mt-md-0" id="formulario-tarjeta{{$id_input}}">
                <div class="grupo">
                    <label for="inputNumero">Número Tarjeta</label>
                    <input type="text" class="inputNumero" id="inputNumero{{$id_input}}" maxlength="19" autocomplete="off" >
                </div>
                <div class="grupo">
                    <label for="inputNombre" >Nombre</label>
                    <input type="text" class="inputNombre" id="inputNombre{{$id_input}}" maxlength="19" autocomplete="off" >
                </div>

                <div class="flexbox">
                    <div class="grupo expira">
                        <label for="selectMes">Expiración</label>
                        <div class="flexbox">
                            <div class="grupo-select">
                                <select name="mes" id="selectMes{{$id_input}}" >
                                    <option disabled selected >Mes</option>
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="grupo-select">
                                <select name="year" id="selectYear{{$id_input}}" >
                                    <option disabled selected>Año</option>
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grupo group-ccv">
                        <label for="inputCCV">CCV</label>
                        <input type="text" id="inputCCV{{$id_input}}" maxlength="3" >
                    </div>
                </div>


                <div class="grupo">
                    <label for="cancelarFactura"> Cancelar factura en:</label>

                    <div class="grupo-select">
                        <select id="cancelarFactura{{$id_input}}">
                            <option disabled selected>Seleccionar opción</option>
                            <option value="1">Colones</option>
                            <option value="2">Dólares</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>

                <div class="grupo">
                    <label for="comentarios"> Comentarios u observaciones:</label>
                    <textarea maxlength="200" style="width: 100%" placeholder="Límite de texto 200 caracteres" id="comentarios{{$id_input}}"></textarea>
                </div>
                <!--<button type="button" class="btn-enviar">Enviar</button>-->
            </div>
        </div>
    </div>
@endif
