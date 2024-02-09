@extends('Layouts.activacionCuentaLayout')

@section('page-content')
    <div id="id-col-main" class="col-12 py-lg-5 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bgc-blue-l4">
                        <h4 class="card-title text-secondary">
                            {{ __('Cambio de contraseña para la cuenta asociada al correo: '). $correo }}
                        </h4>
                    </div>
                    <!-- Resto del contenido de la tarjeta -->
                    <div class="card-body">
                        <form method="POST" id="frm-password-reset" action="{{ route('passwordReset') }}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="reset" value="{{ $reset ??''}}">
                            <input type="hidden" name="correo" value="{{ $correo ??''}}">
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">
                            <div class="container form-group row px-3">
                                <h6 class="card-title text-secondary text-center mb-4">
                                    {{ __('Ingresa la contraseña temporal enviada a tu correo')}}
                                </h6>
                                <div class="col-md-12 col-sm-12 ml-4 mt-15">
                                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 text-125">
                                        <h5 class="text-secondary">Contraseña recibida</h5>
                                    </label>
                                    <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                        <input id="password" type="password" class="form-control form-control-lg pr-4 shadow-none has-content" name="password" autocomplete="current-password">
                                        <a href="#" id="togglepassword" class="btn btn-sm border-0 btn-white btn-h-light-blue btn-a-light-blue text-125 ml-n5 no-underline radius-1 d-style">
                                            <i class="fa fa-eye-slash text-90 d-n-active w-3"></i>
                                            <i class="fa fa-eye text-90 d-active w-3"></i>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 col-sm-12 ml-4 mt-15">
                                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 text-125">
                                        <h5 class="text-secondary">Contraseña</h5>
                                    </label>
                                    <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                        <input id="new_password" type="password" class="form-control form-control-lg pr-4 shadow-none has-content" name="new_password" autocomplete="current-password">
                                        <a href="#" id="toggle-password" class="btn btn-sm border-0 btn-white btn-h-light-blue btn-a-light-blue text-125 ml-n5 no-underline radius-1 d-style">
                                            <i class="fa fa-eye-slash text-90 d-n-active w-3"></i>
                                            <i class="fa fa-eye text-90 d-active w-3"></i>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 col-sm-12 ml-4">
                                    <h5 class="text-secondary">La contraseña debe contener lo siguiente:</h5>
                                    <div class="mb-1">
                                        <div id="validation-length" class="d-flex align-items-center mt-1">
                                            <div class="indicatorResponsive mr-3">
                                                <span><i class="fa-solid fa-xmark btn-text-red"></i></span>
                                            </div>
                                            <div class="text-secondary">
                                                <span>Al menos 8 caracteres</span>
                                            </div>
                                        </div>
                                        <div id="validation-uppercase" class="d-flex align-items-center mt-1">
                                            <div class="indicatorResponsive mr-3">
                                                <span><i class="fa-solid fa-xmark btn-text-red"></i></span>
                                            </div>
                                            <div class="text-secondary">
                                                <span>Al menos una letra mayúscula</span>
                                            </div>
                                        </div>
                                        <div id="validation-lowercase" class="d-flex align-items-center mt-1">
                                            <div class="indicatorResponsive mr-3">
                                                <span><i class="fa-solid fa-xmark btn-text-red"></i></span>
                                            </div>
                                            <div class="text-secondary ">
                                                <span>Al menos una letra minúscula</span>
                                            </div>
                                        </div>
                                        <div id="validation-special" class="d-flex align-items-center mt-1">
                                            <div class="indicatorResponsive mr-3">
                                                <span><i class="fa-solid fa-xmark btn-text-red"></i></span>
                                            </div>
                                            <div class="text-secondary">
                                                <span>Al menos un carácter especial</span>
                                            </div>
                                        </div>
                                        <div id="validation-number" class="d-flex align-items-center mt-1">
                                            <div class="indicatorResponsive mr-3">
                                                <span><i class="fa-solid fa-xmark btn-text-red"></i></span>
                                            </div>
                                            <div class="text-secondary">
                                                <span>Al menos un número</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 col-sm-12 ml-4">
                                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 text-125">
                                        <h5 class="text-secondary">Confirmar contraseña</h5>
                                    </label>
                                    <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                        <input id="confirm_new_password" type="password" class="form-control form-control-lg pr-4 shadow-none has-content" name="confirm_new_password" autocomplete="current-password">
                                        <a href="#" id="toggle-password2" class="btn btn-sm border-0 btn-white btn-h-light-blue btn-a-light-blue text-125 ml-n5 no-underline radius-1 d-style">
                                            <i class="fa fa-eye-slash text-90 d-n-active w-3"></i>
                                            <i class="fa fa-eye text-90 d-active w-3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="button" id="reset" class="g-recaptcha btn btn-primary">
                                        {{ __('Cambiar contraseña ') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
