@extends('Layouts.loginLayout')

@section('page-content')
<div id="id-col-main" class="col-md-8 offset-md-2 py-lg-5 bgc-white px-0">

    <!-- show this in desktop -->
    <div class="d-none d-lg-block col-sm-12 offset-sm-12 mt-lg-4 px-0">
        <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130 text-center text-black-50">
            <i class="fa fa-lock text-blue mr-1"></i>
            Doble factor de autenticación
        </h4>
    </div>

    <!-- show this in mobile device -->
    <div class="d-lg-none text-secondary-m1 my-4 text-center text-black-50">
        Doble factor de autenticación
    </div>
    <div class="form-group row px-3 mt-4">
        <div class="col-sm-12">
            <div class="alert bgc-white shadow-sm brc-info-m2 border-none border-l-5 radius-0 d-flex align-items-center"
                role="alert">
                <i class="fas fa-info-circle mr-3 fa-2x text-info-m3"></i>
                <div id="alerta_incapacidad">
                    Se ha enviado un código de verificación al número de teléfono terminado en {{$usuario[0]->frm_telefonoCeluar}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 d-flex flex-column align-items-center justify-content-center">
        <div class="pt-4 pb-5">
            <form method="POST" id="frm-verificar" action="{{ route('verificar2FA') }}">
                @csrf
                @method('POST')
                <div class="mb-3 text-center">
                    <label for="codigo_verificacion" class="mb-0 text-blue-m1 text-130">Código de Verificación</label>
                </div>
                <div class="input-group mb-3" id="inputs-container">
                   <input type="hidden" name="codigo_validacion" id="codigo_validacion" value="">

                </div>
                <div class="mb-3 text-center">
                    <button type="submit" id="btn-verificar" class="btn btn-primary rounded-pill text-100">Verificar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="form-row w-100" id="verificationContainer">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">
            <hr class="brc-default-l2 mt-0 mb-2 w-100" />
            <div class="p-0 px-md-2 text-dark-tp4 my-3" id="verificationMessage">
                ¿No has recibido el código?
                <a id="resendLink" class="text-blue-d1 text-600 mx-1" href="#">
                    Reenviar código
                </a>
            </div>
            <div id="resendMessage" style="display: none;"></div>
            <div id="resendTimer" style="display: none;"></div>
        </div>
    </div>
</div>
@endsection
<script type="module">
    $('#resendLink').click(function(e) {
        e.preventDefault();
        waitingDialog.show();
        $.ajax({
            type: 'POST',
            url:'{{ route("enviarCodigo") }}',
            success: function(response) {
                if (response.length && response[0] === 'enviado') {
                    mostrarAlertaExito("Código enviado correctamente");
                    $(this).hide();
                    $('#verificationMessage').hide();
                    $('#resendMessage').text('Se ha enviado el código de verificación.').show();
                    $('#resendTimer').html('Puedes volver a intentar en <span id="countdown">60</span> segundos').show();
                    var timeLeft = 60;
                    var timerInterval = setInterval(function () {
                        timeLeft--;
                        $('#countdown').text(timeLeft);
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            $('#resendTimer').hide();
                            $('#resendLink').show();
                            $('#resendMessage').hide();
                            $('#verificationMessage').show();
                        }
                    }, 1000);
                } else {
                    mensaje_swal('error', 'Hubo un error al enviar el código.');
                }
            },
            error: function(error) {
                mensaje_swal('error', error);
            }
        });

    });
</script>
