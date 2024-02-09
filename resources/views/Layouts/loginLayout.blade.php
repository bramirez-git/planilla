<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>Login - App Planilla Profesional</title>

    <!-- AQUI SE INCLUYEN TODOS LOS CSS-->
    <!-- "Login" page styles, specific to this page for demo only -->
    <link rel="stylesheet" type="text/css" href="{{ asset('estilos/application/views/default/pages/partials/page-login/@page-style.css') }}">
    @include('common.global_styles')
    @stack('headers')
</head>

<body>
<div class="body-container">

    <div class="main-container container bgc-transparent">
        <div class="main-content minh-100 justify-content-center">
            <div class="p-2 p-md-4">
                <div class="row" id="row-1">
                    <div class="col-12 col-xl-10 offset-xl-1 bgc-white shadow radius-1 overflow-hidden">

                        <div class="row" id="row-2">
                            @yield('page-content')
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="d-lg-none my-3 text-white-tp1 text-center">
                    Planilla Profesional &copy; {{ now()->year }}
                </div>
            </div>
        </div>

    </div>

</div>
<!-- AQUI SE INCLUYEN LOS JS-->
@include('common.admin_scripts')
{{-- google reCAPTCHA --}}
<script src="https://www.google.com/recaptcha/api.js?render={{env('reCAPTCHA_site_key_cliente')}}"></script>
{{-- end google reCAPTCHA --}}
@if(session()->has('js-activar-cuenta'))
    <script src="{{ asset('js/scripts/login/activacion-cuenta.min.js') }}?t={{ filemtime(public_path('js/scripts/login/activacion-cuenta.min.js')) }}"></script>
@endif
@if(session()->has('js-password-reset'))
    <script src="{{ asset('js/scripts/login/password-reset.min.js') }}?t={{ filemtime(public_path('js/scripts/login/password-reset.min.js')) }}"></script>
@endif

@if(session()->has('warning_registro'))
    <script type='text/javascript'>mensaje_swal('warning','{{ session()->get('warning_registro')}}',
            function(){
            }, false, null, 'Continuar'); </script>
@endif
@if(session()->has('two_factor'))
    <script src="{{ asset('js/scripts/login/twoFactorCodigo.min.js') }}?t={{ filemtime(public_path('js/scripts/login/twoFactorCodigo.min.js')) }}"></script>
    <script src="{{ asset('js/scripts/login/twoFactor.min.js') }}?t={{ filemtime(public_path('js/scripts/login/twoFactor.min.js')) }}"></script>
@endif
<script src="{{ asset('js/scripts/login/register.min.js') }}?t={{ filemtime(public_path('js/scripts/login/register.min.js')) }}"></script>
</body>

</html>
