@extends('Layouts.loginLayout')

@section('page-content')
<div id="id-col-main" class="col-12 py-lg-3 bgc-white px-0">
    <div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-signup" data-swipe-prev="#id-tab-login">
        <!-- Show this on desktop -->
        <div class="d-none d-lg-block col-12 mt-lg-3 px-0">
            <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130 text-center">
                <i class="fa fa-lock text-blue mr-1"></i>
                 Doble factor de autenticación
            </h4>
        </div>
        <div class="d-lg-none text-secondary-m1 my-4 text-center text-black-50">
            <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130 text-center">
                <i class="fa fa-lock text-blue mr-1"></i>
                Doble factor de autenticación
            </h4>
        </div>
        <br>
        <form method="POST" id="frm-2fa" action="{{ route('activar2FAlogin') }}">
            @csrf
            @method('POST')
            <div class="form-group form-check text-center">
                <input type="hidden" name="activateTwoFactorAuth" id="activateTwoFactorAuthHidden" value="0">
                <input type="checkbox" id="activateTwoFactorAuth" class="ace-switch input-sm">
                <label class="form-check-label" for="activateTwoFactorAuth">Activar Doble factor de autenticación</label>
            </div>

            <div class="form-row w-100" id="laterParagraph">
                <div class="col-12 text-center">
                    <p class="mt-3 text-muted">¿Prefieres hacerlo más tarde? <a href="{{ route('login') }}">Hazlo más tarde</a></p>
                </div>
            </div>
            <div class="form-row w-100" id="twoFactorAuthForm" style="display: none;">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 d-flex flex-column align-items-center justify-content-center">
                    <div class="pt-4 pb-5">
                        <div id="phoneInputSection">
                            <div class="mb-3 text-center">
                                <label for="telefono" class="mb-0 text-blue-m1">Ingresa tu número de teléfono</label>
                            </div>
                            <div class="input-group mb-3">
                               <input name="codigo" value="{{ isset($resultado->frm_cod_paisCelular) ? $resultado->frm_cod_paisCelular : '506' }}" type="hidden" id="codigo" style="position: relative; z-index: 7000;">
                                <div class="input-group">
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 " id="telefono_factor" name="telefono_factor" placeholder="0000-0000" value="{{ old('telefono_factor', isset($resultado->frm_telefonoCeluar) ? $resultado->frm_telefonoCeluar : '') }}"/>
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" id="btn-2fa" class="btn btn-primary">Enviar código y activar 2FA</button>
                            </div>
                        </div>
                    </div>

                    <hr class="brc-default-l2 mt-0 mb-2 w-100" />
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

