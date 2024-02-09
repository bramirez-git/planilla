@extends('Layouts.loginLayout')

@section('page-content')
<div id="id-col-main" class="col-12 py-lg-5 bgc-white px-0">
    <div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-signup" data-swipe-prev="#id-tab-login">
        <div class="position-tl ml-3 pt-3 mt-lg-0">
            <a href="{{ route('login') }}"
                class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp">
                <i class="fa fa-arrow-left"></i>
            </a>
        </div>

        <!-- show this in desktop -->
        <div class="d-none d-lg-block col-sm-12 offset-sm-12 mt-lg-3 px-0">
            <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130 text-center">
                <i class="fa fa-user text-blue mr-1"></i>
                Crear cuenta
            </h4>
        </div>

        <!-- show this in mobile device -->
        <div class="d-lg-none text-secondary-m1 my-4 text-center text-black-50">
            <i class="fa fa-leaf text-success-m2 text-200 mb-4"></i>
            <h1 class="text-170">
                App Planilla Profesional
            </h1>

            Crear cuenta
        </div>

<br>
        <form id="frm-crearCuenta" autocomplete="off" class="mt-lg-3" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="g-recaptcha" data-sitekey="TU_CLAVE_DEL_SITIO_RECAPTCHA"></div>
            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">
            <div class="form-group row px-3">

                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de identificación') }} </label>
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"
                        id="tipoIdentificacion" data-name_error="" name="tipoIdentificacion">
                        @foreach($tiposIdentificacion as $tiposIdentificacionEmpresa)
                        <option value="{{ $tiposIdentificacionEmpresa->id_tipo_empresa }}">{{
                            $tiposIdentificacionEmpresa->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de identificación')
                        }}</label>
                    <div class="input-group input-group-fade">
                        <input type="text" data-name_error="Número de identificación" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="identificacion"
                            name="identificacion"
                               value="{{ old('identificacion') }}" />
                        <div class="input-group-append">
                            <button class="btn btn-outline-default btn-bold" type="button"
                                id="buscarCedula">Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de empresa') }}</label>
                    <div class="input-group">
                        <input type="text" data-name_error="Nombre de empresa" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombrePersona"
                            name="nombrePersona" value="{{ old('nombrePersona') }}" />
                    </div>
                </div>
            </div>
            <div class="form-group row px-3">
                <div class="col-md-4 col-sm-12">
                    <input name="frm_codigo_pais" type="hidden" id="frm_codigo_pais">
                    <label for="telefonoFijo" class="mb-0 text-blue-m1"> {{ __('Teléfono') }}</label>
                    <div class="input-group">
                        <input type="text" data-name_error="Teléfono" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefono" placeholder="0000-0000" name="telefono"/>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Correo electrónico') }}</label>
                    <div class="input-group">
                        <input type="text" data-name_error="Correo electrónico" data-inputmask="'alias': 'email'"
                            class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo" name="correo"  value="{{ old('correo') }}" />
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Provincia') }} </label>
                    <div class="input-group">
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"
                                id="provincia" name="provincia" data-name_error="Provincia" onchange="cantones()">
                            <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                            @foreach($provincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}">{{ ucfirst($provincia->provincia) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group row px-3">
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Cantón') }} </label>
                    <div id="cantones" class="input-group">
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"
                            id="canton" name="canton" data-name_error="Cantón" onchange="distritos()">
                            <option value="" selected="selected" disabled="Cantón">Seleccione una opción...</option>
                            @foreach($cantones as $canton)
                            <option value="{{ $canton->id_canton }}">{{ ucfirst(strtolower($canton->canton)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Distrito') }} </label>
                    <div id="distritos" class="input-group">
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"
                            id="distrito" name="distrito" data-name_error="Distrito" onchange="barrios()">
                            <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                            @foreach($distritos as $distrito)
                            <option value="{{ $distrito->id_distrito }}">{{  ucfirst(strtolower($distrito->distrito)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Barrio') }} </label>
                    <div id="barrios" class="input-group">
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"
                                id="barrio" name="barrio" data-name_error="Barrio">
                            <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                            @foreach($barrios as $barrio)
                                <option value="{{ $barrio->id_barrio }}">{{ ucfirst($barrio->barrio) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group row px-3">
                <div class="col-md-8 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Dirección') }} </label>
                    <div class="input-group">
                        <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" id="id-textarea-limit2"
                                  maxlength="200" placeholder="Límite de texto 200 caracteres" data-name_error="Dirección" name="direccion"
                                  style="height:41px">{{ old('direccion')}}</textarea>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Cómo se enteró de nuestro sistema?')
                        }} </label>
                    <div class="input-group">
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"
                                id="medio_comunicacion" name="medio_comunicacion" data-name_error="¿Cómo se enteró de nuestro sistema?">
                            <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                            @foreach($medios_comerciales as $medio)
                                @if($medio->estado === 'ACTIVO' && !in_array($medio->id_medio_comercial, [16,17]))
                                    <option value="{{ ucfirst(strtolower($medio->nombre))  }}" @if(old('medio_comunicacion') == ucfirst(strtolower($medio->nombre))) selected @endif>{{ ucfirst(strtolower($medio->nombre)) }}</option>
                                @endif
                            @endforeach
                            <option value="Otro" @if(old('medio_comunicacion')=='Otro') selected  @endif>Otro</option>
                        </select>
                    </div>
                </div>
            </div>
<br>
            <!-- show this in desktop -->
            <div class="d-none d-lg-block col-sm-12 offset-sm-12 mt-lg-4 px-0">
                <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130 text-center text-black-50">
                    <i class="fa fa-address-card text-blue mr-1"></i>
                    Datos de Contacto
                </h4>
            </div>

            <!-- show this in mobile device -->
            <div class="d-lg-none text-secondary-m1 my-4 text-center text-black-50">
                Datos de Contacto
            </div>
            <div class="form-group row px-3 mt-4">
                <div class="col-sm-12">
                    <div class="alert bgc-white shadow-sm brc-info-m2 border-none border-l-5 radius-0 d-flex align-items-center"
                        role="alert">
                        <i class="fas fa-info-circle mr-3 fa-2x text-info-m3"></i>
                        <div id="alerta_incapacidad">
                            A los siguientes datos de contacto se envían las credenciales para el acceso de
                            planillaprofesional.com
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row px-3 mt-3">
                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nombre Contacto') }} </label>
                    <div class="input-group">
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreContacto"
                            name="nombreContacto" data-name_error="Nombre Contacto" value="{{ old('nombreContacto') }}" />
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Correo eléctronico de contacto') }}
                    </label>
                    <div class="input-group">
                        <input type="text" data-name_error="Correo eléctronico de contacto" data-inputmask="'alias': 'email'"
                            class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correoContacto"
                            name="correoContacto" value="{{ old('correoContacto') }}" />
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="form-group row px-3 mt-3">
                <div class="col-12 col-sm-12">
                    <h2 class="py-4 text-left ml-3 text-black-50">Términos &amp; Condiciones</h2>
                </div>
            </div>
            <div class="form-group row px-3 mt-3">
                <div class="col-12 col-sm-12 text-center">
                    <img class="d-block m-auto" src="{{ asset('img/logo-cyberfuel.webp') }}" alt="">
                </div>
            </div>
            <div class="form-group row px-3 mt-3">
                <div class="col-12 col-sm-12 text-center">
                    <div class="scroll-f bg-light">
                        <div class="px-4 text-justify">
                            <div class="d-flex justify-content-end mb-2">
                                <p>Fecha: 12/1/2024<br>Versión: 1
                                </p>
                            </div>
                            <p class="text-dark-m2">
                                El sitio web <a target="_blank"
                                                href="http://www.planillaprofesional.com/">www.planillaprofesional.com</a> y
                                el contenido que en él se encuentra
                                (conjuntamente, la “Plataforma”) es propiedad de la empresa CYBERFUEL S.A., constituida
                                bajo
                                las leyes de la República de Costa Rica, cédula de persona jurídica número 3-101-246627,
                                domiciliada en Santa Ana, Parque Empresarial FORUM I, Edificio E, Piso 2 (“CYBERFUEL”).
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CYBERFUEL:</span> es la empresa desarrolladora y propietaria del
                                software de PlanillaProfesional.com y alojamiento de la infraestructura de la misma..
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold"> PLATAFORMA</span> o <span class="font-bold">SISTEMA:</span> es
                                la
                                solución que se encuentra en el sitio web <a target="_blank"
                                                                             href="http://www.planillaprofesional.com/">www.planillaprofesional.com</a>, que
                                permite
                                optimizar la gestión del Recurso Humano, y todos los aspectos relacionados para poder
                                generar una planilla conforme a los requerimientos específicos de la Republica de Costa
                                Rica.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold"> CLIENTE:</span> es la persona física, jurídica, DIMEX o NITE
                                que
                                contrata con CYBERFUEL el servicio de la plataforma <a target="_blank"
                                                                                       href="http://www.planillaprofesional.com/">www.planillaprofesional.com</a>, la cual
                                es
                                intransferible.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold"> USUARIOS:</span> son las personas físicas autorizadas por el
                                CLIENTE, para utilizar la plataforma de <a target="_blank"
                                                                           href="http://www.planillaprofesional.com/">www.planillaprofesional.com</a>
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold"> MERCADO</span> o <span class="font-bold">MARKET PLACE:</span>
                                es la
                                opción de la plataforma en la cual se puede activar o inactivar opciones adicionales con
                                o
                                sin costo.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">DESCRIPCIÓN GENERAL DE LA PLATAFORMA </span>
                            </p>

                            <p class="text-dark-m2">
                                PlanillaProfesional.com es la solución llave en mano donde podrá llevar la operación del
                                Recurso Humano de su Empresa para el control de sus colaboradores y las solicitudes de
                                estos
                                para poder generar una Planilla de forma eficiente y rápida.
                            </p>

                            <p class="text-dark-m2">
                                Se basa en una solución web donde los USUARIOS autorizados realizan el proceso de carga
                                de
                                información de los colaboradores del CLIENTE conforme a los perfiles otorgados por el
                                CLIENTE por medio de permisos de acceso a roles determinados y otras opciones.
                            </p>

                            <p class="text-dark-m2">
                                Una de las características del SISTEMA es incluir los perfiles de los colaboradores de
                                la
                                empresa, los cambios que ocurran creando acciones de personas para llevar el histórico
                                de
                                los colaboradores o incidir en los montos a pagar según corresponda.
                            </p>

                            <p class="text-dark-m2">
                                Finalmente, el sistema provee toda la información necesaria para hacer llegar la
                                información
                                a los diferentes bancos para el pago de los adelantos de salario o mensuales, CCSS, INS,
                                Retenciones de Hacienda, Embargos, Aguinaldos, Resumen Anual de retenciones, entre
                                otros.
                            </p>

                            <p class="text-dark-m2">
                                El sistema permite llevar las planillas en dólares o colones, con la respectiva
                                colonización
                                de los reportes para las instituciones que así lo requieren.
                            </p>

                            <p class="text-dark-m2">
                                Usted podrá disfrutar de las funcionalidades de la Plataforma luego adherirse a los
                                términos
                                y condiciones y sus actualizaciones indicadas en la página web <a
                                    href="http://www.planillaprofesional.com/"
                                    target="_blank">www.planillaprofesional.com</a>. A partir de ese momento, usted será
                                considerado como <span class="font-bold">CLIENTE</span> de la Plataforma, mientras esté
                                vigente la relación comercial y su membresía se mantenga activa.
                            </p>

                            <p class="text-dark-m2">
                                PlanillaProfesional.com fue creado tomando en cuenta las particularidades del Código de
                                Trabajo de Costa Rica con jornadas extraordinarias, pago de feriados, disfrute o pago de
                                vacaciones, catálogos de actividades del INS y CCSS de forma muy intuitiva para los
                                usuarios, reduciendo al mínimo las posibilidades de error u omisión de las
                                responsabilidades
                                laborales.
                            </p>

                            <p class="text-dark-m2">
                                Las características y opciones de cada uno de los planes están publicados en nuestro
                                sitio
                                web <a href="http://www.planillaprofesional.com/"
                                       target="_blank">www.planillaprofesional.com</a>.
                            </p>

                            <p class="text-dark-m2">
                                DERECHOS DE PROPIEDAD INTELECTUAL
                            </p>

                            <p class="text-dark-m2">
                                CYBERFUEL S.A. es titular de todos los derechos de autor, marcas, derechos de propiedad
                                intelectual, Know–how y cuantos otros derechos guardan relación con la Plataforma y el
                                servicio contratado; así como de los programas informáticos necesarios para su
                                implementación.
                            </p>

                            <p class="text-dark-m2">
                                Los datos y contenido transmitidos por el Usuario a la PLATAFORMA a través de la página
                                web
                                serán propiedad exclusiva del Usuario. <br>
                                Queda absolutamente prohibida la distribución, modificación, alteración, cesión,
                                comunicación pública y cualquier otro acto que no sea expresamente autorizado por <span
                                    class="font-bold">CYBERFUEL</span>.
                            </p>


                            <p class="text-dark-m2">
                                <span class="font-bold"> COSTO DE LA PLATAFORMA</span>
                            </p>

                            <p class="text-dark-m2">
                                En el sitio <a href="http://www.planillaprofesional.com/"
                                               target="_blank">www.planillaprofesional.com</a> encontrará el precio mensual por colaborador incluido en la planilla, el precio mensual de la plataforma, así como otras características que podrá contratar en el MARKETPLACE con el fin de obtener opciones avanzadas para el proceso de Planilla y Administración de Recursos Humanos. </p>

                            <p class="text-dark-m2">   La utilización de la plataforma tiene los siguientes costos y opera bajo la modalidad de prepago: </p>

                            <p class="text-dark-m2">  El costo de activación de su empresa en la plataforma [persona física o jurídica] tiene un costo inicial de $ 10 + IVA lo que le permitirá incluir toda la información de la empresa y colaboradores, acciones de personal, salarios extras y hasta generar el primer adelanto quincenal en caso de que la empresa opte por un pago mensual y un adelanto quincenal en el primer mes. </p>

                            <p class="text-dark-m2"> El día 25 de cada mes se le comunicará por correo el saldo de su cuenta a la fecha y el saldo mínimo que deberá tener para generar el cierre de la planilla y obtener todos los reportes, archivos a enviar a terceros como bancos, CCSS e INS, correos o listados de planilla conformado por los siguientes rubros: </p>

                            <p class="text-dark-m2">  $ 20.00 + IVA por uso mensual de la plataforma, cargo independiente de la cantidad de colaboradores en planilla.
                                $ 1.00 por cada colaborador incluido en el sistema a dicha fecha activo o inactivo.
                                El costo adicional de las facilidades seleccionadas en el Marketplace. </p>



                            <p class="text-dark-m2">
                                <span class="font-bold">  FORMAS DE PAGO</span>
                            </p>

                            <p class="text-dark-m2">
                                El CLIENTE deberá contar con suficiente saldo prepagado  para generar las Planillas conforme al correo que enviamos el día 25 del mes.

                            </p>



                            <p class="text-dark-m2">
                                En la opción de Mercado “Market Place” se ofrecen opciones adicionales con o sin costo
                                que
                                deben ser activadas para poderlas visualizar y utilizar en la plataforma.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold"> Formas de pago:</span>
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CYBERFUEL</span> pone a disposición del <span
                                    class="font-bold">CLIENTE</span> las siguientes opciones de pago:
                            </p>

                            <p class="text-dark-m2">

                            <ul class="list-unstyled text-left mx-auto mb-1">
                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                        La Plataforma: mediante el uso de una tarjeta de crédito o débito VISA, American
                                        Express, Master Card
                                    </span>
                                </li>

                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                        Depósito o transferencia en cuentas bancarias de <span
                                            class="font-bold">CYBERFUEL</span>, debidamente indicadas en las facturas o
                                        facilitadas a solicitud del CLIENTE
                                    </span>
                                </li>

                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                        Pago mediante SINPE MOVIL de <span class="font-bold">CYBERFUEL</span>, el cuál
                                        se
                                        indica en las facturas
                                    </span>
                                </li>

                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                        Pago mediante Paypal, en la pasarela de pago de <span
                                            class="font-bold">CYBERFUEL</span>
                                    </span>
                                </li>

                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                      Pago automático donde el cliente autoriza a que se efectuemos un cargo automático por el monto indicado en el correo del día 25 de cada mes.
                                    </span>
                                </li>


                            </ul>

                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">DESCUENTOS</span>
                            </p>

                            <p class="text-dark-m2">
                                Con el fin de promover la plataforma <span class="font-bold">CYBERFUEL</span> podrá
                                realizar
                                acuerdos, promociones o convenios para que potenciales clientes puedan hacer uso de la
                                plataforma, para esto podrá realizar mecánicas y estrategias de promoción a potenciales
                                clientes nuevos, como también brindar nuevas opciones a los clientes actuales.
                            </p>


                            <p class="text-dark-m2">
                               <span
                                   class="font-bold">CYBERFUEL</span> podrá ofrecer descuentos por cualquiera de los rubros que componen la tarifa mensual, pero estos no podrán ser recurrentes, o bien cualquier otro requerimiento o mecánica especial que se indique en la estrategia de promoción.


                            </p>

                            <p class="text-dark-m2">
                                En caso de promociones o descuentos a  <span
                                    class="font-bold">CLIENTES</span> existentes deberán pagar antes de la fecha indicada, de lo contrario perderá la totalidad de este.


                            </p>




                            <p class="text-dark-m2">
                                <span class="font-bold">OBLIGACIONES DEL CLIENTE</span>
                            </p>
                            <p class="text-dark-m2">
                                El <span class="font-bold">CLIENTE</span> tendrá estas obligaciones:
                            </p>
                            <p class="text-dark-m2">
                                Ser el único y exclusivo responsable de los datos de USUARIO (usuario y contraseña) de
                                acceso que le han sido otorgados para disfrutar de la Plataforma y de la generación de
                                documentos electrónicos.
                            </p>
                            <p class="text-dark-m2">
                                Pagar en tiempo y forma los montos por concepto del servicio contratado.
                            </p>

                            <p class="text-dark-m2">
                                Respetar los derechos de propiedad intelectual de <span
                                    class="font-bold">CYBERFUEL</span> y
                                de terceros.
                            </p>

                            <p class="text-dark-m2">
                                Cumplir con la normativa y políticas de <span class="font-bold">CYBERFUEL</span>, sin
                                incurrir en actividades ilícitas o contrarias a la buena fe y al orden público.
                            </p>

                            <p class="text-dark-m2">
                                El CLIENTE es el único responsable de la información y datos asignados en el SISTEMA, y
                                por
                                lo tanto de cualquier error u omisión que se origine a causa de la información ingresada
                                al
                                SISTEMA.
                            </p>

                            <p class="text-dark-m2">
                                En caso de que el <span class="font-bold">CLIENTE</span> no requiera más de alguna
                                opción
                                adicional del mercado “Market Place”, podrá inactivarla y aplicara a partir del
                                siguiente
                                ciclo mensual.
                            </p>

                            <p class="text-dark-m2">
                                En el Market Place, en caso de opciones gratuitas o de cobro adicional, <span
                                    class="font-bold">CYBERFUEL</span> podrá inactivar por el no pago o vencimiento de
                                la
                                membresía, la misma del sistema, eliminando los datos de la opción.
                            </p>

                            <p class="text-dark-m2">
                                En caso de que el <span class="font-bold">CLIENTE</span> no requiera más del servicio prestado por CYBERFUEL, deberá realizar el respaldo de todos sus documentos (Datos de empleados, planillas, acciones de personal, control de vacaciones y demás documentación que considere importante), antes de la fecha de expiración del servicio.
                            </p>




                            <p class="text-dark-m2">
                                Una vez transcurridos 3 meses con la membresía vencida por falta de pago, el <span class="font-bold">CLIENTE</span> será notificado al correo electrónico registrado en la plataforma. Alertando a este sobre la eliminación de los documentos electrónicos (Datos de empleados, planillas, acciones de personal, control de vacaciones y demás documentación de su perfil almacenados en la plataforma liberando a <span class="font-bold">CYBERFUEL</span> de la recuperación de la información.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">LIBERACIÓN DE RESPONSABILIDAD PARA CYBERFUEL</span>
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CYBERFUEL</span> no asume y se libera de toda responsabilidad
                                por:
                            </p>

                            <p class="text-dark-m2">
                                Los daños que cause el Usuario a terceros o a los bienes de estos, debido a los envíos
                                de
                                planillas y/o su contenido
                            </p>

                            <p class="text-dark-m2">
                                La no presentación de documentos en la Oficina Virtual de la Caja Costarricense del
                                Seguro
                                Social y el Instituto Nacional de Seguros, debido a: saturaciones propias del sistema de
                                la
                                CCSS e INS, o errores u omisiones causadas por información incorrecta cargada en el
                                SISTEMA
                            </p>

                            <p class="text-dark-m2">
                                La falta de ejecución o retraso del servicio contratado por motivo de caso fortuito o
                                fuerza
                                mayor
                            </p>

                            <p class="text-dark-m2">
                                Incumplimiento de normativa nacional e internacional, como la de protección de datos de
                                carácter personal, por parte del Usuario
                            </p>

                            <p class="text-dark-m2">
                                Los motivos indicados en el contrato suscrito con <span
                                    class="font-bold">CYBERFUEL</span>
                                (de ser aplicable)
                            </p>

                            <p class="text-dark-m2">
                                Respaldo de la información enviada y recibida, en caso de que el cliente suspenda la
                                prestación del servicio de forma continua
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">RELACIÓN LABORAL</span>
                            </p>

                            <p class="text-dark-m2">
                                No existe ni existirá ninguna relación laboral entre el personal de <span
                                    class="font-bold">CYBERFUEL</span> y el <span class="font-bold">CLIENTE</span> o
                                viceversa; por lo que cada una de las Partes mantendrá el carácter de patrono hacia su
                                personal y asumirá íntegramente la responsabilidad derivada de dicha relación y los
                                riesgos
                                relacionados a sus respectivas labores, sin que exista nunca ningún tipo de sustitución
                                patronal.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CONFIDENCIALIDAD</span>
                            </p>

                            <p class="text-dark-m2">
                                Las Partes acuerdan dar carácter confidencial a este acuerdo, obligándose a no revelar a
                                terceros ninguno de los puntos que integran su contenido sin el consentimiento expreso
                                de
                                ambas.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CYBERFUEL</span> reconoce el carácter confidencial de toda la
                                información del <span class="font-bold">CLIENTE</span> que reciba en su Plataforma y se
                                compromete a no revelar a terceros dicha información o la naturaleza de dicha
                                información,
                                salvo que cuente con la previa autorización del <span class="font-bold">CLIENTE</span>.
                            </p>

                            <p class="text-dark-m2">
                                Por su parte, el <span class="font-bold">CLIENTE</span> garantiza la confidencialidad de
                                toda la información que pueda conocer con respecto al Servicio, infraestructuras,
                                sistemas y
                                demás medios técnicos y humanos de <span class="font-bold">CYBERFUEL</span>, y se
                                compromete
                                a no revelar a terceros dicha información o la naturaleza de dicha información, salvo
                                que
                                cuente con la previa autorización de <span class="font-bold">CYBERFUEL</span>.
                            </p>

                            <p class="text-dark-m2">
                                No se considerará un acto de violación por parte de <span
                                    class="font-bold">CYBERFUEL</span>
                                al secreto de las comunicaciones y/o al deber de confidencialidad, el cumplimiento de la
                                obligación de retener los datos de conexión y tráfico a disposición de jueces,
                                tribunales
                                y/o Ministerio Público, en tanto la orden respectiva sea emitida de conformidad con la
                                normativa vigente y provenga de una autoridad competente para tal efecto, tal cual las
                                antes
                                citadas.
                            </p>

                            <p class="text-dark-m2">
                                Las Partes deberán tomar todas las medidas necesarias para que sus funcionarios,
                                proveedores
                                y demás agentes asuman personalmente las obligaciones de confidencialidad y seguridad
                                que
                                aquí se detallan, para que dicha información no sea almacenada, ni pueda ser accesada
                                por
                                personas no autorizadas y/o que no hayan suscrito los pertinentes acuerdos de
                                confidencialidad.
                            </p>

                            <p class="text-dark-m2">
                                Las Partes entienden y aceptan que las obligaciones de confidencialidad que asumen las
                                obligan tanto a ellas como a sus empresas afiliadas, subsidiarias, afines, propietarias
                                y/o
                                subordinadas, así como a sus socios, mandatarios, representantes, directores, agencias y
                                empleados.
                            </p>

                            <p class="text-dark-m2">
                                Ninguna de las Partes adquirirá derecho alguno sobre la información confidencial o
                                derechos
                                de propiedad de la otra Parte como resultado de este acuerdo.
                            </p>

                            <p class="text-dark-m2">
                                Las Partes acuerdan que podrán divulgar información confidencial ante las autoridades
                                públicas competentes, cuando éstas se lo requieran expresamente. En este supuesto, es
                                obligación de la Parte requerida calificar expresamente como confidencial la
                                información, y
                                solicitar a la autoridad respectiva que sea tratada y archivada como tal.
                            </p>

                            <p class="text-dark-m2">
                                Ninguna de las Partes usará el nombre de la otra en actividades de publicidad, promoción
                                o
                                similares, sin contar de previo con el consentimiento de la otra Parte.
                            </p>

                            <p class="text-dark-m2">
                                Estas obligaciones de confidencialidad para ambas Partes persistirán durante los 5 años
                                siguientes a la finalización del acuerdo y sus prórrogas.
                            </p>

                            <p class="text-dark-m2">
                                Confiando en las obligaciones de confidencialidad aquí incluidas, ambas Partes se
                                comprometen a brindarse mutuamente la información requerida para realizar exitosamente
                                el
                                objeto del presente acuerdo.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">PROTECCION DE DATOS DE CARÁCTER PERSONAL</span>
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CYBERFUEL</span> garantiza el pleno cumplimiento de las
                                obligaciones
                                dispuestas por la Ley de Protección de la Persona Frente al Tratamiento de sus Datos
                                Personales No. 8968 y su reglamento. De conformidad con la normativa vigente sobre
                                protección de datos de carácter personal, <span class="font-bold">CYBERFUEL</span>
                                cumplirá
                                durante el plazo de este acuerdo el papel de intermediario tecnológico.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CLIENTE</span> entiende y acepta que deberá adecuar su
                                funcionamiento comercial a tal normativa y, de ser aplicable, registrar las bases de
                                datos
                                susceptibles de registro ante la Agencia de Protección de Datos de los Habitantes
                                (Prodhab),
                                en caso de que la base de datos sea registrable conforme a la normativa de Costa Rica.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CYBERFUEL</span> no se hará responsable de los incumplimientos
                                en
                                que el <span class="font-bold">CLIENTE</span> incurra con respecto a la Prodhab y/o
                                terceros, en cuanto a las obligaciones contenidas en la normativa nacional o
                                internacional
                                de protección de datos personales, en la parte o actividad que corresponda.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CLIENTE</span> será el responsable, si así lo desea el mismo
                                compartir su información para la identidad tributaria, con el fin de que esta
                                herramienta le
                                permita realizar el registro de cliente en los diferentes comercios o proveedores, para
                                que
                                le llegue la factura o tiquete de una forma más rápida
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CANCELACIÓN Y DEVOLUCIÓN</span>
                            </p>

                            <p class="text-dark-m2">
                                Se establecen las condiciones en caso de que el cliente desee la devolución del dinero
                                correspondiente a los servicios que ofrece el servicio de PlanillaProfesional.com
                            </p>

                            <p class="text-dark-m2">
                                Una vez efectuado el pago correspondiente al plan seleccionado por el CLIENTE para
                                PlanillaProfesional.com y se diera la cancelación por algún motivo, el mismo debe ser
                                comunicado por escrito al correo: <a target="_blank"
                                                                     href="mailto:info@planillaprofesional.com">info@planillaprofesional.com</a>, y debe
                                cumplir con las siguientes indicaciones:
                            </p>

                            <p class="text-dark-m2">

                            <ul class="list-unstyled text-left mx-auto mb-1">
                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                        Debe de tener menos de 10 días de haber comprado el servicio
                                        <ul class="list-unstyled text-left mx-auto mb-1">
                                            <li><i class="w-3 text-center fa fa-exclamation-triangle text-orange"></i>En
                                                caso de omitir esto, se le realizará un cargo de $10 (diez dólares)
                                                por
                                                cargos administrativos</li>
                                        </ul>
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                        No debe de haber emitido ningún documento electrónico (Datos de empleados,
                                        planillas, acciones de personal, control de vacaciones y demás documentación)
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check text-success-m2 text-110 mr-1 mt-1"></i>
                                    <span class="text-110 text-1">
                                        Indicar la razón del porqué no desea el servicio
                                    </span>
                                </li>

                            </ul>
                            </p>

                            <p class="text-dark-m2">
                                Una vez enviado el documento, se analizará cada caso y si cumple se le realizará el
                                reintegro ya sea por medio de algún banco del territorio nacional de Costa Rica
                                indicando la
                                cuenta IBAN del <span class="font-bold">CLIENTE</span>.
                            </p>

                            <p class="text-dark-m2">
                                Así mismo se procederá a la suspensión inmediata del servicio y la anulación de la
                                factura
                                mediante una nota de crédito.
                            </p>
                            <p class="text-dark-m2">
                                <span class="font-bold">RESOLUCIÓN ALTERNA DE CONFLICTOS</span>
                            </p>

                            <p class="text-dark-m2">
                                Las controversias, diferencias, disputas o reclamos que pudieran derivarse del uso de la
                                Plataforma por parte del Usuario, serán sometidas en primera instancia al Centro de
                                Asistencia de <span class="font-bold">CYBERFUEL</span>, en segunda instancia a un
                                procedimiento de conciliación, y en tercera instancia a un arbitraje de derecho, ambos
                                en el
                                Centro de Conciliación y Arbitraje de la Cámara de Comercio de Costa Rica, según los
                                términos proporcionados oportunamente por <span class="font-bold">CYBERFUEL</span>.
                            </p>

                            <p class="text-dark-m2">
                                <span class="font-bold">CENTRO DE ASISTENCIA</span>
                            </p>

                            <p class="text-dark-m2">
                                La Plataforma permanecerá activa, con un 99% de disponibilidad, durante las 24 horas del
                                día, los 365 días del año, salvo interrupciones o suspensiones por motivo de caso
                                fortuito o
                                fuerza mayor.
                            </p>

                            <p class="text-dark-m2">
                                En caso de incidentes, consultas o solicitudes particulares, el Usuario podrá recurrir
                                al
                                Centro de Asistencia de <span class="font-bold">CYBERFUEL</span> disponible en la
                                Plataforma.
                            </p>

                            <p class="text-dark-m2">
                                El acceso a la Plataforma implica la aceptación por el Usuario del contenido de estos
                                Términos & Condiciones, y su compromiso de respetarlos.
                            </p>


                            <p class="text-dark-m2">
                                <span class="font-bold">CYBERFUEL</span> se reserva el derecho a modificar, actualizar o
                                suprimir cualquier contenido de la Plataforma, en cualquier momento y sin previo aviso,
                                salvo que se disponga lo contrario en contratos suscritos por <span
                                    class="font-bold">CYBERFUEL</span> y el CLIENTE o USUARIO.
                            </p>


                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2">
                <label class="d-inline-block mt-3 mb-0 text-secondary-d2">
                        <input type="checkbox" class="mr-1" id="aceptarTerminosCondiciones"
                            name="aceptarTerminosCondiciones[]" data-name_error="Aceptar términos y condiciones"/>
                        <span class="text-blue-d2">Aceptar términos y condiciones</span>
                </label>


                <button type="button" id="registrar" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-3">
                    Registrar
                </button>
            </div>
        </form>

        <div class="form-row w-100">
            <div
                class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

                <hr class="brc-default-l2 mt-0 mb-2 w-100" />

                <div class="p-0 px-md-2 text-dark-tp4 my-3">
                    Ya está registrado?
                    <a class="text-blue-d1 text-600 mx-1" href="{{ route('login') }}">
                        Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
