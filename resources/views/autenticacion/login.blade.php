@extends('Layouts.loginLayout')

@section('page-content')
    <div id="id-col-intro" class="col-lg-5 d-none d-lg-flex border-r-1 brc-default-l3 px-0">
        <!-- the left side section is carousel in this demo, to show some example variations -->

        <div id="loginBgCarousel" class="carousel slide minw-100 h-100">

            <div class="carousel-inner minw-100 h-100">
                <div class="carousel-item active minw-100 h-100">
                    <!-- default carousel section that you see when you open login page -->
                    <!--<div style="background-image: url({ $banner["banners"][1]["url_imagen1"] }});" class="px-3 bgc-blue-l4 d-flex flex-column align-items-center justify-content-center">

                    </div>-->

                    <div id="carouselLogin" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($banner as $banners)
                                <li data-target="#carouselLogin" data-slide-to="{{ $loop->iteration }}" class=" {{ $loop->first ? 'active' : '' }} "></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($banner as $banners)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <a @if($banners['url_destino'] !=null) href="{{$banners['url_destino']}}" target="_blank" @endif>
                                        <img class="d-block w-100" style="height:765px;" src="{{asset('img/imagenesBanner/'.$banners['imagen'])}}" >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselLogin" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselLogin" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="id-col-main" class="col-12 col-lg-7 py-lg-5 bgc-white px-0">
        <br>
        <div class="tab-content tab-sliding border-0 p-0" data-swipe="right">

            <div class="tab-pane @if(isset($login)) active @endif  show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
                <!-- show this in desktop -->
                <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
                    <h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-130">
                        <i class="fa fa-coffee text-orange-m1 mr-1"></i>
                        App Planilla Profesional
                    </h4>
                </div>

                <!-- show this in mobile device -->
                <div class="d-lg-none text-secondary-m1 my-4 text-center">
                    <a href="html/dashboard.html">
                        <i class="fa fa-leaf text-success-m2 text-200 mb-4"></i>
                    </a>
                    <h1 class="text-170">
                                                <span class="text-blue-d1">
                                                    App Planilla Profesional
                                                </span>
                    </h1>

                </div>


                <form method="POST" action="{{ route('login') }}" class="form-row mt-4" id="login"  autocomplete="off">
                    @csrf
                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <div class="align-items-center input-floating-label text-blue brc-blue-m2">

                            <input id="email" type="email" class="form-control form-control-lg pr-4 shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus />

                            <!--<i class="fa fa-user text-grey-m2 ml-n4"></i>-->
                            <label class="floating-label text-grey-l1 ml-n3" for="email">
                                {{ __('Correo Electrónico') }}
                            </label>

                            @error('email')
                            <span class="invalid-feedback text-center" role="alert">
                                                        <strong>{{ __('Usuario o contraseña incorrectos') }}</strong>
                                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                            <input id="password" type="password" class="form-control form-control-lg pr-4 shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                            <a href="#" id="togglepassword" class="btn btn-sm border-0 btn-white btn-h-light-blue btn-a-light-blue text-125 ml-n5 no-underline radius-1 d-style">
                                <i class="fa fa-eye-slash text-90 d-n-active w-3"></i>
                                <i class="fa fa-eye text-90 d-active w-3"></i>
                            </a>
                            <label class="floating-label text-grey-l1 text-100 ml-n3" for="password">
                                Contraseña
                            </label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2">
                        <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2">
                            Ingresar
                        </button>
                    </div>
                </form>

                <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-right text-md-right mt-4 mb-2">
                    <a id="login-link" href="#" class="text-primary-m1 text-95" data-toggle="tab" data-target="#id-tab-forgot">
                        ¿Olvidó su contraseña?
                    </a>
                </div>
                <div class="form-row">
                    <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

                        <hr class="brc-default-l2 mt-0 mb-2 w-100" />

                        <div class="p-0 px-md-2 text-dark-tp3 my-3">
                            ¿No tienes usuario?
                            <a class="text-success-m1 text-600 mx-1" href="{{ route('register') }}">
                                Crear cuenta.
                            </a>
                        </div>
                        <div class="p-0 px-md-2 text-dark-tp3">
                            <a class="btn btn-green btn-block px-4 btn-bold mt-5 mb-4" href="https://www.planillaprofesional.com/">
                                Regresar al Website
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3 mt-lg-4 px-0">
                    <div class="text-center"> <img src="{{asset('img/sectigo2.png')}}" width="180"> </div>
                </div>
            </div>

            <div class="tab-pane @if(isset($recover_pass)) active @endif mh-100 px-3 px-lg-0 pb-3" id="id-tab-forgot" data-swipe-prev="#id-tab-login">
                <div class="position-tl ml-3 mt-2">
                    <a href="#" id="forgot-link" class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp" data-toggle="tab" data-target="#id-tab-login">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>


                <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-5 px-0">
                    <h4 class="pt-4 pt-md-0 text-dark-tp4 border-b-1 brc-grey-l2 pb-1 text-130">
                        <i class="fa fa-key text-blue-m1 mr-1"></i>
                        Recuperación de contraseña
                    </h4>
                </div>


                <form autocomplete="off" class="form-row mt-4" id="recordarPass" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <label class="text-secondary-d3 mb-3">
                            Ingrese su correo electrónico y enviaremos las instrucciones:
                        </label>
                        <div class="align-items-center input-floating-label text-blue brc-blue-m2">

                            <input id="id-recover-email" type="email" class="form-control form-control-lg pr-4 shadow-none" name="id_recover_email" required autofocus />

                            <!--<i class="fa fa-user text-grey-m2 ml-n4"></i>-->
                            <label class="floating-label text-grey-l1 ml-n3" for="id-recover-email">
                                {{ __('Correo Electrónico') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-1">
                        <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4">
                            Continuar
                        </button>
                    </div>
                </form>


                <div class="form-row w-100">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

                        <hr class="brc-default-l2 mt-0 mb-2 w-100" />

                        <div class="p-0 px-md-2 text-dark-tp4 my-3">
                            <a class="text-blue-d1 text-600 btn-text-slide-x" id="forgot-link-dos" data-toggle="tab" data-target="#id-tab-login" href="#">
                                <i class="btn-text-2 fa fa-arrow-left text-110 align-text-bottom mr-2"></i>Regresar al login
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- .tab-content -->
    </div>

@endsection

@push("scripts")
    <script type="module">
        $(document).ready(function() {
            // Manejar clic en el enlace del tab de login
            $('#login-link').on('click', function() {
                // Activar el tab de login y desactivar el tab de recuperación de contraseña
                $('#id-tab-login').removeClass('active');
                $('#id-tab-forgot').addClass('active');
            });

            // Manejar clic en el enlace del tab de recuperación de contraseña
            $('#forgot-link').on('click', function() {
                // Activar el tab de recuperación de contraseña y desactivar el tab de login
                $('#id-tab-forgot').removeClass('active');
                $('#id-tab-login').addClass('active');
            });
            $('#forgot-link-dos').on('click', function() {
                // Activar el tab de recuperación de contraseña y desactivar el tab de login
                $('#id-tab-forgot').removeClass('active');
                $('#id-tab-login').addClass('active');
            });
        });
    </script>
    @if(isset($errors) && $errors->any())
        <script type='text/javascript'>
            var errores = @json($errors->toArray());
            mostrarAlertaError(errores.mensaje1[0], errores.mensaje2[0]);
        </script>
    @endif
    @if(isset($success))
        <script type='text/javascript'>mostrarAlertaExito('{{ $success}}'); </script>
    @endif
@endpush
