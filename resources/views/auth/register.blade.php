@extends('Layouts.loginLayout')

@section('page-content')
    <div id="id-col-main" class="col-12 py-lg-5 bgc-white px-0">
        <div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-signup" data-swipe-prev="#id-tab-login">
            <div class="position-tl ml-3 pt-3 mt-lg-0">
                <a href="{{ route('login') }}" class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp">
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
            <div class="d-lg-none text-secondary-m1 my-4 text-center">
                <i class="fa fa-leaf text-success-m2 text-200 mb-4"></i>
                <h1 class="text-170">
                    App Planilla Profesional
                </h1>

                Crear cuenta
            </div>


            <form autocomplete="off" class="mt-lg-3" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row px-3">

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de identificación') }}</label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroColaborador" name="numeroColaborador"  required="true"/>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de identificación') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoIdentificacion" name="tipoIdentificacion" required="true">
                            <option value=""></option>
                            <option value="1">CÉDULA FÍSICA</option>
                            <option value="2">CÉDULA JURÍDICA</option>
                            <option value="3">DIMEX</option>
                            <option value="4">NITE</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de la persona o empresa') }}</label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombrePersona" name="nombrePersona"  required="true"/>
                    </div>
                </div>
                <div class="form-group row px-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono') }}</label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefono" name="telefono"  required="true"/>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Correo Electrónico') }}</label>
                        <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo" name="correo"  required="true"/>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Provincia') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="provincia" name="provincia" onchange="cantones()">
                            @foreach($provincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}">{{ $provincia->provincia }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row px-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Cantón') }} </label>
                        <div id="cantones">
                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="canton" name="canton" onchange="distritos()">
                                @foreach($cantones as $canton)
                                    <option value="{{ $canton->id_canton }}">{{ $canton->canton }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Distrito') }} </label>
                        <div id="distritos">
                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="distrito" name="distrito" onchange="barrios()">
                                @foreach($distritos as $distrito)
                                    <option value="{{ $distrito->id_distrito }}">{{ $distrito->distrito }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Barrio') }} </label>
                        <div id="barrios">
                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="barrio" name="barrio" >
                                @foreach($barrios as $barrio)
                                    <option value="{{ $barrio->id_barrio }}">{{ $barrio->barrio }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row px-3">
                    <div class="col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Dirección') }} </label>
                        <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" name="descripcionDocumento" style="height: 55px" required="true"></textarea>
                    </div>
                </div>

                <div class="form-group row px-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Cómo se enteró de nuestro sistema?') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="barrio" name="barrio" required="true">
                            <option value=""></option>
                            <option value="1">Anuncio en radio</option>
                            <option value="2">Anuncio en revista</option>
                            <option value="3">Anuncio en periódico</option>
                            <option value="4">Facebook.com</option>
                            <option value="5">Instagram.com</option>
                            <option value="6">Linkedin.com</option>
                            <option value="7">Búsqueda en google</option>
                            <option value="8">Vallas publicitarias</option>
                            <option value="9">Colegio profesional</option>
                            <option value="10">Contador</option>
                            <option value="11">Amigo</option>
                            <option value="12">Messenger</option>
                            <option value="13">Whatsapp</option>
                            <option value="14">Cliente de Cyberfuel</option>
                            <option value="15">Otros</option>
                        </select>
                    </div>
                </div>

                <!-- show this in desktop -->
                <div class="d-none d-lg-block col-sm-12 offset-sm-12 mt-lg-4 px-0">
                    <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130 text-center">
                        <i class="fa fa-address-card text-blue mr-1"></i>
                        Datos de Contacto
                    </h4>
                </div>

                <!-- show this in mobile device -->
                <div class="d-lg-none text-secondary-m1 my-4 text-center">
                    Datos de Contacto
                </div>
                <div class="form-group row px-3 mt-3">
                    <div class="col-sm-12">
                        <div class="alert bgc-white shadow-sm brc-info-m2 border-none border-l-5 radius-0 d-flex align-items-center" role="alert">
                            <i class="fas fa-info-circle mr-3 fa-2x text-info-m3"></i>
                            <div id="alerta_incapacidad">
                                A los siguientes datos de contacto se envían las credenciales para el acceso de planillaprofesional.com
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row px-3 mt-3">
                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nombre Contacto') }} </label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreContacto" name="nombreContacto"  required="true"/>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Correo eléctronico de contacto') }} </label>
                        <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="sitioWeb" name="sitioWeb"  required="true"/>
                    </div>
                </div>

                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2">
                    <label class="d-inline-block mt-3 mb-0 text-secondary-d2">
                        <input type="checkbox" class="mr-1" id="id-agree" />
                        <span class="text-dark-m3">Aceptar <a href="#" class="text-blue-d2" data-toggle="modal" data-target="#terminosCondiciones">términos y condiciones</a></span>
                    </label>

                    <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-3">
                        Registrar
                    </button>
                </div>
            </form>

            <div class="modal fade show" id="terminosCondiciones" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-message modal-dialog-scrollable" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title text-blue-d2">
                                Términos y condiciones
                            </h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body ace-scrollbar">
                            What is Lorem Ipsum?<br>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <br>
                            when an unknown printer took a galley of type and scrambled it to make a type <br>
                            specimen book. It has survived not only five centuries, but also the leap into <br>
                            electronic typesetting, remaining essentially unchanged. It was popularised in <br>
                            the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, <br>
                            and more recently with desktop publishing software like Aldus PageMaker including <br>
                            versions of Lorem Ipsum.<br><br>

                            Why do we use it?<br>
                            It is a long established fact that a reader will be distracted by the readable<br>
                            content of a page when looking at its layout. The point of using Lorem Ipsum <br>
                            is that it has a more-or-less normal distribution of letters, as opposed to <br>
                            using 'Content here, content here', making it look like readable English. <br>
                            Many desktop publishing packages and web page editors now use Lorem Ipsum <br>
                            as their default model text, and a search for 'lorem ipsum' will uncover <br>
                            many web sites still in their infancy. Various versions have evolved over <br>
                            the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            <br><br>

                            Where does it come from?<br>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. <br>
                            It has roots in a piece of classical Latin literature from 45 BC, <br>
                            making it over 2000 years old. Richard McClintock, a Latin professor at <br>
                            Hampden-Sydney College in Virginia, looked up one of the more obscure <br>
                            Latin words, consectetur, from a Lorem Ipsum passage, and going through <br>
                            the cites of the word in classical literature, discovered the undoubtable<br>
                            source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus<br>
                            Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. <br>
                            This book is a treatise on the theory of ethics, very popular during the Renaissance.<br>
                            The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from <br>
                            a line in section 1.10.32.<br><br>

                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for <br>
                            those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum"<br>
                            by Cicero are also reproduced in their exact original form, accompanied by English <br>
                            versions from the 1914 translation by H. Rackham.<br><br>

                            Where can I get some?<br>
                            There are many variations of passages of Lorem Ipsum available, but the majority <br>
                            have suffered alteration in some form, by injected humour, or randomised words <br>
                            which don't look even slightly believable. If you are going to use a passage of <br>
                            Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the<br>
                            middle of text. All the Lorem Ipsum generators on the Internet tend to repeat<br>
                            predefined chunks as necessary, making this the first true generator on the <br>
                            Internet. It uses a dictionary of over 200 Latin words, combined with a handful <br>
                            of model sentence structures, to generate Lorem Ipsum which looks reasonable.<br>
                            The generated Lorem Ipsum is therefore always free from repetition, injected <br>
                            humour, or non-characteristic words etc.
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cerrar
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-row w-100">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

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
