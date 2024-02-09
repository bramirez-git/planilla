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
                Tu cuenta ha sido creada
            </h4>
        </div>

        <!-- show this in mobile device -->
        <div class="d-lg-none text-secondary-m1 my-4 text-center text-black-50">
            <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130 text-center">
                <i class="fa fa-user text-blue mr-1"></i>
                Tu cuenta ha sido creada
            </h4>
        </div>
        <br>
        <div class="text-center pt-4 pb-5">
            <h1 class="btn-text-dark">El registro se completó exitosamente.</h1>
            <h2 class="mr-1 ml-1 pl-3 pr-3 text-dark"><p>¡Las instrucciones de activación han sido enviadas con éxito al correo electrónico proporcionado!</p></h2>
        </div>
        <br>
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
