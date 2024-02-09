@extends('Layouts.menu')

@section('page-content')
        <div role="main" class="page-content container container-plus">
            <div class="row mt-2 mt-md-4">
                <!-- the left side profile picture and other info -->
                <div class="col-12 col-md-4">
                    <div class="card bcard">
                        <div class="card-body body-darkblue">
                    <span class="d-none position-tl mt-2 pt-3px">
                    <span class="text-white bgc-blue-d1 ml-2 radius-b-1 py-2 px-2">
                        <i class="fa fa-star"></i>
                    </span>
                    </span>
                            <div class="d-flex flex-column py-3 px-lg-3 justify-content-center align-items-center">
                                <div class="pos-rel">
                                    @if($existe_path)
                                        <img alt="Profile image"  style="width: 65px;height: 65px;" src="{{  route('image.show', ['dir_group' =>'usuarios' ,'filename' => $foto]) }}" class="radius-round bord1er-2 brc-warning-m1">
                                    @else
                                        <img alt="Profile image" src="{{ asset('img/default-user.png') }}" class="radius-round bord1er-2 brc-warning-m1">
                                    @endif
                                    <span class=" position-tr bgc-success p-1 radius-round border-2 brc-white mt-2px mr-2px"></span>
                                </div>
                                <div class="text-center mt-2">
                                    <h5 class="text-130 text-dark-m3">
                                        {{ $resultado->usuario ?? ""}}  </h5>
                                    <span class="text-80 text-primary text-600">
                                      {{ $resultado->nombre_departamento }}
                                    </span>
                                </div>
                                <hr class="w-90 mx-auto brc-secondary-l3">
                                <div class="text-center">
                                    <button type="button" href="{{ route('logout') }}" class="btn btn-blue pos-rel px-5 px-md-4 px-lg-5" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off mr-15 text-110"></i>
                                        Cerrar sesión
                                    </button>
                                </div>
                                <hr class="w-90 mx-auto mb-1 border-dotted">
                                <div class="mt-2 mx-3">
                                    <div class="text-secondary-d3 font-bolder text-90 mb-3">
                                        Roles asignados
                                    </div>
                                    <div class="text-left d-inline-flex flex-wrap">
                                        <span class="d-inline-block radius-round bgc-success-l2 text-dark-tp3 text-90 px-25 py-3px mx-2px my-2px">
                                                {{ $resultado->rol }}
                                            </span>
                                    </div>
                                </div>
                                <hr class="w-90 mx-auto mb-1 border-dotted">
                            </div><!-- /.d-flex -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- .col -->
                <!-- the right side profile tabs -->
                <div class="col-12 col-md-8 mt-3 mt-md-0">
                    <div class="card bcard h-100">
                        <div class="card-body p-0">
                            <div class="">
                                <div class="sticky-trigger"></div>
                                <div class="position-tr w-100 border-t-4 brc-blue-m2 radius-2 d-md-none"></div>
                                <ul id="profile-tabs" class="nav nav-tabs-scroll is-scrollable nav-tabs nav-tabs-simple p-1px pl-25 bgc-white border-b-1 brc-dark-l3" role="tablist">
                                    <li class="nav-item mr-2 mr-lg-3">
                                        <a class="d-style nav-link px-2 py-35 brc-green-tp1 {{  $tab=="info"?'active':'' }}" data-toggle="tab" href="#profile-tab-overview" role="tab" aria-controls="profile-tab-overview" aria-selected="false">
                                            <span class="d-n-active text-dark-l1">1. Información</span>
                                            <span class="d-active text-dark-m3">1. Información</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-2 mr-lg-3">
                                        <a class="d-style nav-link px-2 py-35 brc-green-tp1 {{  $tab=="password"?'active':'' }}" data-toggle="tab" href="#profile-tab-timeline" role="tab" aria-controls="profile-tab-timeline" aria-selected="false">
                                            <span class="d-n-active text-dark-l1">2. Actualizar contraseña</span>
                                            <span class="d-active text-dark-m3">2. Actualizar contraseña</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-2 mr-lg-3">
                                        <a class="d-style nav-link px-2 py-35 brc-green-tp1 {{  $tab=="edit_info"?'active':'' }}" data-toggle="tab" href="#profile-tab-edit" role="tab" aria-controls="profile-tab-edit" aria-selected="false">
                                            <span class="d-n-active text-dark-l1">3. Actualizar información</span>
                                            <span class="d-active text-dark-m3">3. Actualizar información</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-2 mr-lg-3">
                                        <a class="d-style nav-link px-2 py-35 brc-green-tp1 {{  $tab=="2FA"?'active':'' }}" data-toggle="tab" href="#profile-tab-fac" role="tab" aria-controls="profile-tab-overview" aria-selected="false">
                                            <span class="d-n-active text-dark-l1">4. Configuración 2FA</span>
                                            <span class="d-active text-dark-m3">4. Configuración 2FA</span>
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.sticky-nav-md -->
                            <div class="tab-content px-0 tab-sliding flex-grow-1 border-0">
                                <!-- overview tab -->
                                <div class="tab-pane show px-1 px-md-2 px-lg-4 {{  $tab=="info"?'active':'' }}" id="profile-tab-overview">
                                    <div class="row">
                                        <div class="col-12 px-4 mb-3 mt-45">
                                            <hr class="w-100 mx-auto mb-0 brc-default-l2">
                                            <div class="bgc-white radius-1">
                                                <table class="table table table-striped-default table-borderless">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <i class="far fa-user text-success"></i>
                                                        </td>
                                                        <td class="text-95 text-600 text-secondary-d2">
                                                            Nombre completo
                                                        </td>
                                                        <td class="text-dark-m3">
                                                            {{ $resultado->name ?? "" }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="far fa-envelope text-blue"></i>
                                                        </td>
                                                        <td class="text-95 text-600 text-secondary-d2">
                                                            Email
                                                        </td>
                                                        <td class="text-blue-d1 text-wrap">
                                                            {{ $resultado->email ?? ""}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-phone text-purple"></i>
                                                        </td>
                                                        <td class="text-95 text-600 text-secondary-d2">
                                                            Teléfono
                                                        </td>
                                                        <td class="text-dark-m3">
                                                            {{ $resultado->celular ?? "" }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="far fa-clock text-secondary"></i>
                                                        </td>
                                                        <td class="text-95 text-600 text-secondary-d2">
                                                            Último acceso
                                                        </td>
                                                        <td class="text-dark-m3">
                                                            {{  date('d/m/Y H:i:s', strtotime(session()->get("ultimo_acceso"))) }}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.tab-pane -->
                                <!-- timeline tab -->
                                <div class="tab-pane px-1 px-md-2 px-lg-4 {{  $tab=="password"?'active':'' }}" id="profile-tab-timeline">
                                    <!-- alternative infobox style -->
                                    <div class="row">
                                        <div class="col-12 col-lg-10 offset-lg-1 mt-3">
                                            <form method="POST" id="frm-password" action="{{ route('cambio_contrasena_usuario') }}">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group row mx-0 mt-45">
                                                    <label for="contrasena" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Contraseña actual</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="password" class="form-control input-group brc-success-m2" id="contrasena" name="contrasena" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0">
                                                    <label for="id-field3" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Contraseña nueva</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input id="password" type="password" class="form-control input-group brc-success-m2" name="new_contrasena" autocomplete="new-password">
                                                    </div>
                                                </div>

                                                <div class="form-group row mx-0">
                                                    <label for="id-field4" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Confirmar contraseña</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input id="password-confirm" type="password" class="form-control input-group brc-success-m2" name="password_confirmation" autocomplete="new-password">
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0 invisible">
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="text" class="form-control brc-on-focus brc-success-m2" id="email_cambio" name="email_cambio" value="{{session()->get('email')}}">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <hr class="border-double brc-dark-l3">
                                            <div class="form-group text-center mt-4 mb-3">
                                                <button type="button" id="btn-password" class="btn btn-outline-green radius-1 px-4 mx-1">
                                                    Guardar contraseña
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tab-pane -->
                                <!-- profile edit tab -->
                                <div class="tab-pane px-1 px-md-2 px-lg-4 {{  $tab=="edit_info"?'active':'' }}" id="profile-tab-edit">
                                    <!-- alternative infobox style -->
                                    <div class="row">
                                        <div class="col-12 col-lg-10 offset-lg-1 mt-3">
                                            <form method="POST" id="frm-info" action="{{ route('miCuenta.update',[Crypt::encrypt(session()->get("id_usuario"))]) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="empresa" value="{{session()->get('id_cliente')}}">
                                                <div class="form-group row mt-45 mx-0">
                                                    <label for="nombre" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Nombre completo</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="text" class="input-group form-control brc-on-focus brc-success-m2 input-group" id="nombre" name="nombre" value=" {{ $resultado->name ?? "" }}" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0">
                                                    <label for="id-field2" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Correo electrónico</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="email" class="input-group form-control brc-on-focus brc-success-m2 input-group" id="email" name="email" value=" {{ $resultado->email ?? "" }}" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0">
                                                    <label for="id-field1" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Departamentos</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <div class="input-group">
                                                        <select id="idDepartamento" name="idDepartamento" data-placeholder="Seleccione una opción..." class="chosen-select form-control brc-on-focus brc-success-m2" >
                                                            <option value="" @if($resultado->id_departamento == null) selected @endif disabled>Seleccione una opción...</option>
                                                            @foreach($departamentos as $departamento)
                                                                @if($departamento->estado=="activo")
                                                                    <option value="{{ $departamento->id_departamento }}"  @if($resultado->id_departamento == $departamento->id_departamento) selected @endif >{{ $departamento->nombre }}</option>
                                                                @endif
                                                            @endforeach
                                                            <option value="-1"  @if($resultado->id_departamento == -1) selected @endif >Outsourcing</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0 mb-45">
                                                    <input name="frm_codigo_pais" type="hidden" value="{{$resultado->telefono_code??""}}"  id="frm_codigo_pais">
                                                    <label for="id-field1" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Teléfono</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <div class="input-group">
{{--                                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefono" name="telefono" value=" {{ $resultado->telefono ?? "" }}"/>--}}
                                                            <input type="text" class="form-control brc-on-focus brc-success-m2" id="telefono" name="telefono" data-telefono="{{isset($resultado->telefono) ? $resultado->telefono : '' }}" value="">

                                                        </div>
                                                    </div>
                                                </div>
                                                @if($existe_path)
                                                    <input type="text" value="{{ Crypt::encrypt($resultado->foto) }}" hidden name="fotoActual"/>
                                                @endif
                                                <div class="form-group row mx-0">
                                                    <label for="id-field1" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Adjuntar foto</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <div class="input-group">
                                                            <div class="cropme" style="width: 150px; height: 150px;"></div>
                                                            <div id="cropMessage"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0 invisible">
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="text" class="form-control brc-on-focus brc-success-m2" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0 invisible">
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="text" class="form-control brc-on-focus brc-success-m2" value="">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <hr class="border-double brc-dark-l3">
                                            <div class="form-group text-center mt-4 mb-3">
                                                <button type="button" id="btn-info" class="btn btn-outline-green radius-1 px-4 mx-1">
                                                    Guardar información
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane px-1 px-md-2 px-lg-4 {{$tab=="2FA"?'active':''}}" id="profile-tab-fac">
                                    <div class="row">
                                        <div class="col-12 col-lg-10 offset-lg-1 mt-3">
                                            <form method="POST" id="frm-2fa" action="{{ route('actualizacion2FA') }}">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group row mx-0 align-items-center">
                                                    <label for="activar" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Activar autenticación</label>
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="hidden" name="activateTwoFactorAuth" id="activateTwoFactorAuthHidden" value="{{ $resultado->doble_autenticacion }}">
                                                        <input type="checkbox" id="activateTwoFactorAuth" class="ace-switch input-sm" {{ $resultado->doble_autenticacion == 1 ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="form-group row mx-0 align-items-center">
                                                    <label for="telefono" class="col-sm-4 col-xl-4 col-form-label text-sm-right">Teléfono registrado</label>
                                                    <input name="frm_codigo_pais_factor" value="{{ isset($resultado->telefono_code) ? $resultado->telefono_code : '506' }}" type="hidden" id="frm_codigo_pais_factor" style="position: relative; z-index: 7000;">
                                                    <div class="col-sm-8 col-lg-6">
                                                        <input type="text" class="form-control input-group brc-success-m2" id="telefono_factor" name="telefono_factor" placeholder="0000-0000" value="{{ old('telefono', isset($resultado->telefono) ? $resultado->telefono : '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <hr class="border-double brc-dark-l3">
                                                    <div class="form-group text-center mt-4 mb-3">
                                                        <button type="button" id="btn-2fa" class="btn btn-outline-green radius-1 px-4 mx-1">
                                                            Guardar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
@endsection
