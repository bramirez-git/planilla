@extends('Layouts.loginLayout')

@section('page-content')
    <div id="id-col-intro" class="col-lg-5 d-none d-lg-flex border-r-1 brc-default-l3 px-0">
        <!-- the left side section is carousel in this demo, to show some example variations -->

        <div id="loginBgCarousel" class="carousel slide minw-100 h-100">
            <ol class="d-none carousel-indicators">
                <li data-target="#loginBgCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#loginBgCarousel" data-slide-to="1"></li>
                <li data-target="#loginBgCarousel" data-slide-to="2"></li>
                <li data-target="#loginBgCarousel" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner minw-100 h-100">
                <div class="carousel-item active minw-100 h-100">
                    <!-- default carousel section that you see when you open auth page -->
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
                                    <img class="d-block w-100" src="{{asset('img/imagenesBanner/'.$banners['imagen'])}}" >
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



                <div class="carousel-item minw-100 h-100">
                    <!-- the second carousel item with dark background -->
                    <div style="background-image: url({{ asset('estilos/assets/image/auth-bg-2.svg') }});" class="d-flex flex-column align-items-center justify-content-start">
                        <a class="mt-5 mb-2" href="html/dashboard.html">
                            <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                        </a>

                        <h2 class="text-blue-l1">
                            <span class="text-80 text-white-tp3">App Planilla Profesional</span>
                        </h2>
                    </div>
                </div>

                <div class="carousel-item minw-100 h-100">
                    <div style="background-image: url({{ asset('estilos/assets/image/auth-bg-3.jpg') }});" class="d-flex flex-column align-items-center justify-content-start">
                        <div class="bgc-black-tp4 radius-1 p-3 w-90 text-center my-3 h-100">
                            <a class="mt-5 mb-2" href="html/dashboard.html">
                                <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                            </a>

                            <h2 class="text-blue-l1">
                                <span class="text-80 text-white-tp3">App Planilla Profesional</span>
                            </h2>
                        </div>
                    </div>
                </div>



                <div class="carousel-item minw-100 h-100">
                    <div style="background-image: url({{ asset('estilos/assets/image/auth-bg-4.jpg') }});" class="d-flex flex-column align-items-center justify-content-start">
                        <a class="mt-5 mb-2" href="html/dashboard.html">
                            <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                        </a>

                        <h2 class="text-blue-d1">
                            <span class="text-80 text-dark-tp3">App Planilla Profesional</span>
                        </h2>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="id-col-main" class="col-12 col-lg-7 py-lg-5 bgc-white px-0">
        <!-- you can also use these tab links -->
        <ul class="d-none mt-n4 mb-4 nav nav-tabs nav-tabs-simple justify-content-end bgc-black-tp11" role="tablist">
            <li class="nav-item mx-2">
                <a class="nav-link active px-2" data-toggle="tab" href="#id-tab-login" role="tab" aria-controls="id-tab-login" aria-selected="true">
                    Login
                </a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link px-2" data-toggle="tab" href="#id-tab-signup" role="tab" aria-controls="id-tab-signup" aria-selected="false">
                    Signup
                </a>
            </li>
        </ul>


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


                <form method="POST" action="{{ route('panelLogin') }}" class="form-row mt-4" id="login"  autocomplete="off">
                    @csrf
                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <div class="align-items-center input-floating-label text-blue brc-blue-m2">

                            <input id="usuario" type="text" class="form-control form-control-lg pr-4 shadow-none @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" required autofocus />

                            <!--<i class="fa fa-user text-grey-m2 ml-n4"></i>-->
                            <label class="floating-label text-grey-l1 ml-n3" for="usuario">
                                {{ __('Usuario') }}
                            </label>

                            @error('usuario')
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

                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">

                        <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4">
                            Ingresar
                        </button>
                    </div>
                </form>

            </div>

            <div class="tab-pane @if(isset($recover_pass)) active @endif mh-100 px-3 px-lg-0 pb-3" id="id-tab-forgot" data-swipe-prev="#id-tab-login">
                <div class="position-tl ml-3 mt-2">
                    <a href="#" class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp" data-toggle="tab" data-target="#id-tab-login">
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
                            Ingrese su correo de usuario:
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
                            Enviar
                        </button>
                    </div>
                </form>


                <div class="form-row w-100">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

                        <hr class="brc-default-l2 mt-0 mb-2 w-100" />

                        <div class="p-0 px-md-2 text-dark-tp4 my-3">
                            <a class="text-blue-d1 text-600 btn-text-slide-x" data-toggle="tab" data-target="#id-tab-login" href="#">
                                <i class="btn-text-2 fa fa-arrow-left text-110 align-text-bottom mr-2"></i>Regresar al login
                            </a>
                        </div>

                    </div>
                </div>
            </div>


            <div class="tab-pane @if(isset($reset)) active @endif mh-100 px-3 px-lg-0 pb-3" id="id-tab-forgot" data-swipe-prev="#id-tab-login">

                <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-5 px-0">
                    <h4 class="pt-4 pt-md-0 text-dark-tp4 border-b-1 brc-grey-l2 pb-1 text-130">
                        <i class="fa fa-key text-blue-m1 mr-1"></i>
                        Nueva contraseña
                    </h4>
                </div>


                <form autocomplete="off" class="form-row mt-4" id="resetPass" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @if(isset($reset))
                        <input type="hidden" name="token" value="{{ $token }}">
                    @endif
                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                            <input type="password" name="new_password" class="form-control form-control-lg pr-4 shadow-none" id="new_password">
                            <a href="#" id="toggle-password" class="btn btn-sm border-0 btn-white btn-h-light-blue btn-a-light-blue text-125 ml-n5 no-underline radius-1 d-style">
                                <i class="fa fa-eye-slash text-90 d-n-active w-3"></i>
                                <i class="fa fa-eye text-90 d-active w-3"></i>
                            </a>
                            <label class="floating-label text-grey-l1 text-100 ml-n3" for="new_password">
                                Contraseña
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                            <input type="password" name="confirm_new_password" class="form-control form-control-lg pr-4 shadow-none" id="confirm_new_password">
                            <a href="#" id="toggle-password2" class="btn btn-sm border-0 btn-white btn-h-light-blue btn-a-light-blue text-125 ml-n5 no-underline radius-1 d-style">
                                <i class="fa fa-eye-slash text-90 d-n-active w-3"></i>
                                <i class="fa fa-eye text-90 d-active w-3"></i>
                            </a>
                            <label class="floating-label text-grey-l1 text-100 ml-n3" for="confirm_new_password">
                                Confirmar contraseña
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-1">
                        <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4">
                            Cambiar contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- .tab-content -->
    </div>

@endsection
