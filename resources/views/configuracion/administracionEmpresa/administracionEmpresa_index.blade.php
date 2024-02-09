@extends('Layouts.menu')

@section('page-content')
    @php
        $generales = "active";
        $comunicaciones = "";
        $planilla = "";
        $bancos = "";
        $ocupaciones = "";
        $accionPersonal = "";

        if(session()->has("tipoForm"))
        {
            if(session()->get("tipoForm") == "Datos generales")
            {
                $generales = "active";
                $comunicaciones = "";
                $planilla = "";
                $bancos = "";
                $ocupaciones = "";
                $accionPersonal = "";
            }

            if(session()->get("tipoForm") == "Comunicaciones")
            {
                $generales = "";
                $comunicaciones = "active";
                $planilla = "";
                $bancos = "";
                $ocupaciones = "";
                $accionPersonal = "";
            }

            if(session()->get("tipoForm") == "Planilla")
            {
                $generales = "";
                $comunicaciones = "";
                $planilla = "active";
                $bancos = "";
                $ocupaciones = "";
                $accionPersonal = "";
            }

            if(session()->get("tipoForm") == "Bancos")
            {
                $generales = "";
                $comunicaciones = "";
                $planilla = "";
                $bancos = "active";
                $ocupaciones = "";
                $accionPersonal = "";
            }

            if(session()->get("tipoForm") == "Ocupaciones")
            {
                $generales = "";
                $comunicaciones = "";
                $planilla = "";
                $bancos = "";
                $ocupaciones = "active";
                $accionPersonal = "";
            }

            if(session()->get("tipoForm") == "Acción de personal")
            {
                $generales = "";
                $comunicaciones = "";
                $planilla = "";
                $bancos = "";
                $ocupaciones = "";
                $accionPersonal = "active";
            }
        }
    @endphp

    <div class="pb-3">
        <div class="bcard">
            <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
                <li class="nav-item mr-2px">
                    <a id="DatosGenerales-tab" class="d-style {{$generales}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#datosGenerales" role="tab" aria-controls="datosGenerales" aria-selected="true">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-bars-staggered text-green-m2"></i>
                        Datos Generales
                    </a>
                </li>

                <li class="nav-item mr-2px">
                    <a id="comunicaciones-tab" class="d-style {{$comunicaciones}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#comunicaciones" role="tab" aria-controls="comunicaciones" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-envelope text-green-m2"></i>
                        Comunicaciones
                    </a>
                </li>

                <li class="nav-item">
                    <a id="ajustePlanilla-tab" class="d-style {{$planilla}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#ajustePlanilla" role="tab" aria-controls="ajustePlanilla" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-money-check-dollar text-green-m2"></i>
                        Planilla
                    </a>
                </li>

                <li class="nav-item">
                    <a id="bancos-tab" class="d-style {{$bancos}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#bancos" role="tab" aria-controls="vehiculos" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-building-columns text-green-m2"></i>
                        Bancos
                    </a>
                </li>

                <li class="nav-item">
                    <a id="controlHorario-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#controlHorario" role="tab" aria-controls="controlHorario" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-clock text-green-m2"></i>
                        Control de horario
                    </a>
                </li>

                <li class="nav-item">
                    <a id="ocupaciones-tab" class="d-style {{$ocupaciones}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#ocupaciones" role="tab" aria-controls="ocupaciones" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-helmet-safety text-green-m2"></i>
                        Ocupaciones
                    </a>
                </li>

                <li class="nav-item">
                    <a id="accionPersonal-tab" class="d-style {{$accionPersonal}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#accionPersonal" role="tab" aria-controls="accionPersonal" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-location-arrow text-green-m2"></i>
                        Acción de personal
                    </a>
                </li>
            </ul>
            <div class="tab-content bgc-white p-35 border-0">
                <div class="tab-pane fade show {{$generales}} text-95" id="datosGenerales" role="tabpanel" aria-labelledby="home1-tab-btn">
                    <form id="form-datosgenerales" class="mt-lg-3" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Datos generales" hidden/>

                        <br>
                        <h3 class="card-title text-125 text-green-m2">
                            <i class="nav-icon fa fa-business-time text-green-m2"></i>
                            {{ __('Información de la empresa') }}
                        </h3>
                        <hr>

                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Logo de la empresa') }}</label>

                                <div class="pos-rel d-style radius-1 shadow-sm overflow-hidden bgc-secondary-m3">
                                    <a href="#" class="show-lightbox">
                                        @if(file_exists(public_path($resultadoEmpresa->foto)) && ($resultadoEmpresa->foto!="") &&($resultadoEmpresa->foto!="archivos/fotos/empresas/"))
                                            <img alt="Gallery Image 6" style="width: 220px; height: 220px;" src="{{ asset($resultadoEmpresa->foto) }}" class="w-100 d-zoom-2 " data-size="960x1200" />
                                            <input type="text" value="{{$resultadoEmpresa->foto}}" hidden name="fotoActual"/>
                                        @else
                                            <img alt="Gallery Image 6" style="width: 220px; height: 220px;" src="{{ asset('archivos/fotos/empresas/default-empresa.png') }}" class="w-100 d-zoom-2 " data-size="960x1200" />
                                        @endif
                                    </a>
                                </div>

                                <a href="#id-more-buttons" class="d-style px-4 btn btn-white collapsed my-3 col-md-12 col-sm-12" data-toggle="collapse" aria-expanded="false">
                                    <span class="d-collapsed">
                                        Cambiar foto
                                        <i class="fa fa-angle-double-right ml-35"></i>
                                    </span>
                                    <span class="d-n-collapsed text-600">
                                        <i class="fa fa-angle-double-left"></i>
                                    </span>
                                </a>
                            </div>
                            <div id="id-more-buttons" class="collapse col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Adjuntar foto de empresa') }}</label>

                                <div class="input-group">
                                    <div class="cropme" style="width: 220px; height: 220px;"></div>
                                    <div id="cropMessage"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-4">

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de identificación') }}</label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="id_tipo_identificacion" name="id_tipo_identificacion" >
                                    @foreach($tiposIdentificaciones as $datos)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoEmpresa->id_tipo_identificacion)
                                            @if($datos->id_tipo_empresa == $resultadoEmpresa->id_tipo_identificacion)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset
                                        <option value="{{ $datos->id_tipo_empresa }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cédula') }}</label>
                                <div class="input-group input-group-fade">
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="identificacion" name="identificacion" value="{{ old('identificacion') ?? $resultadoEmpresa->identificacion ??""  }}" />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-default btn-bold" type="button" id="buscarCedula">Buscar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nombre') }} </label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre" name="nombre" value="{{ old('nombre') ?? $resultadoEmpresa->nombre ??""  }}"  readonly/>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nombre de fantasía') }} </label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_fantasia" name="nombre_fantasia" value="{{ old('nombre_fantasia') ?? $resultadoEmpresa->nombre_fantasia ??""  }}" />
                            </div>
                        </div>

                        <br>
                        <h3 class="card-title text-125 text-green-m2">
                            <i class="nav-icon fa fa-route text-green-m2"></i>
                            {{ __('Dirección') }}
                        </h3>
                        <hr>

                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Provincia') }} </label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="provincia" name="provincia" onchange="cantones()">
                                    @foreach($provincias as $provincia)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoEmpresa->id_provincia)
                                            @if($provincia->id_provincia == $resultadoEmpresa->id_provincia)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset
                                        <option value="{{ $provincia->id_provincia }}" {{$opcion}}>{{ $provincia->provincia }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Cantón') }} </label>
                                <div id="cantones">
                                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="canton" name="canton"  onchange="distritos()">
                                        @foreach($cantones as $canton)
                                            @php $opcion=""; @endphp
                                            @isset($resultadoEmpresa->id_canton)
                                                @if($canton->id_canton == $resultadoEmpresa->id_canton)
                                                    @php $opcion="selected"; @endphp
                                                @endif
                                            @endisset
                                            <option value="{{ $canton->id_canton }}" {{$opcion}}>{{ $canton->canton }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Distrito') }} </label>
                                <div id="distritos">
                                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="distrito" name="distrito" onchange="barrios()">
                                        @foreach($distritos as $distrito)
                                            @php $opcion=""; @endphp
                                            @isset($resultadoEmpresa->id_distrito)
                                                @if($distrito->id_distrito == $resultadoEmpresa->id_distrito)
                                                    @php $opcion="selected"; @endphp
                                                @endif
                                            @endisset
                                            <option value="{{ $distrito->id_distrito }}" {{$opcion}}>{{ $distrito->distrito }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Barrio') }} </label>
                                <div id="barrios">
                                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="barrio" name="barrio" >
                                        @foreach($barrios as $barrio)
                                            @php $opcion=""; @endphp
                                            @isset($resultadoEmpresa->id_barrio)
                                                @if($barrio->id_barrio == $resultadoEmpresa->id_barrio)
                                                    @php $opcion="selected"; @endphp
                                                @endif
                                            @endisset
                                            <option value="{{ $barrio->id_barrio }}" {{$opcion}}>{{ $barrio->barrio }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Dirección exacta') }}</label>
                                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="direccion" name="direccion" > {{ old('direccion') ?? $resultadoEmpresa->direccion ??""  }}</textarea>
                            </div>
                        </div>

                        <br>
                        <h3 class="card-title text-125 text-green-m2">
                            <i class="nav-icon fa fa-address-book text-green-m2"></i>
                            {{ __('Teléfonos') }}
                        </h3>
                        <hr>

                        <div class="form-group row mt-4">

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono fijo') }}</label>
                                <input type="text"  class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefonoFijo" name="telefonoFijo" value="{{ old('telefonoFijo') ?? $resultadoEmpresa->telefono_fijo ?? ""}}"  />
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono Celular') }}</label>
                                <input type="text"  class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefonoCelular" name="telefonoCelular" value="{{ old('telefonoCelular') ?? $resultadoEmpresa->telefono_celular ??""}}"  />
                            </div>
                        </div>

                        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Cancelar
                                </a>
                                <button type="button" id="registrardatosgenerales" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Guardar
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="confirmModalDatosGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                                            Mensaje
                                        </h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Desea guardar datos generales para la empresa?
                                        <br />
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <button type="submit" class="btn btn-primary" id="guardar-datosgenerales">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane show {{$comunicaciones}} fade text-95" id="comunicaciones" role="tabpanel" aria-labelledby="profile1-tab-btn">
                    <form id="form-comunicaciones" class="mt-lg-3" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Comunicaciones" hidden/>

                        <div class="form-group row mt-4">
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Enviar entregables reportes CCSS e INS') }}</label>
                                <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_reportes" name="correo_reportes" value="{{ old('correo_reportes') ?? $resultadoComunicacion->correo_reportes ??""}}" />
                            </div>

                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Enviar a contabilidad los pagos') }}</label>
                                <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_pagos" name="correo_pagos" value="{{ old('correo_pagos') ?? $resultadoComunicacion->correo_pagos ??""}}" />
                            </div>

                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Recibir currículums') }}</label>
                                <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_curriculums" name="correo_curriculums" value="{{ old('correo_curriculums') ?? $resultadoComunicacion->correo_curriculums ??""}}" />
                            </div>

                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> <span class="tooltip-info"
                                                                                                    data-rel="tooltip" data-placement="bottom" title="" data-original-title=""> <i
                                            class="fa-solid fa-circle-info blue"></i> </span>{{ __('Enviar notificaciones detalle de planilla') }}</label>
                                <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_planilla" name="correo_planilla" value="{{ old('correo_planilla') ?? $resultadoComunicacion->correo_planilla ??""}}" />
                            </div>
                        </div>

                        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Cancelar
                                </a>
                                <button id="registrarcomunicaciones" type="button" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Guardar
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="confirmModalComunicaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                                            Mensaje
                                        </h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Desea guardar datos de comunicaciones para la empresa?
                                        <br />
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <button id="guardar-comunicaciones" type="submit" class="btn btn-primary" >
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane show {{$planilla}} fade text-95" id="ajustePlanilla" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-planilla" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Planilla" hidden/>

                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('País') }} </label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="id_pais" name="id_pais" >
                                    @foreach($catalogoPaises as $paises)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoPlanilla->id_pais)
                                            @if($paises->id_pais == $resultadoPlanilla->id_pais)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset
                                        <option value="{{ $paises->id_pais }}" {{$opcion}}>{{ $paises->codigo.'-'.$paises->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de planilla') }}</label>
                                <div>
                                    <select class="form-control" data-style="btn-outline-default btn-h-outline-primary btn-a-outline-primary" multiple id="selectpicker1" name="id_tipos_planilla[]">
                                        @php
                                            $mensual ="";
                                        @endphp
                                        @foreach($catalogoTipoPlanilla as $datos)
                                            @php
                                                $opcion = "";
                                            @endphp
                                            @isset($resultadoPlanilla->id_tipos_planilla)
                                                @php
                                                    $planillas = explode(",", $resultadoPlanilla->id_tipos_planilla);
                                                @endphp

                                                @foreach($planillas as $planilla)
                                                    @if($datos->id_tipo_planilla == $planilla)
                                                        @if($planilla==2)
                                                            @php
                                                                $mensual ="si";
                                                            @endphp
                                                        @endif

                                                        @php
                                                            $opcion = "selected";
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endisset
                                            <option value="{{ $datos->id_tipo_planilla }}" {{$opcion}}>{{ $datos->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }} </label>
                                <div>
                                    <select class="form-control" data-style="btn-outline-default btn-h-outline-primary btn-a-outline-primary" multiple id="selectpicker2" name="id_monedas[]">
                                        @foreach($catalogoMonedas as $datos)
                                            @php
                                                $opcion = "";
                                            @endphp
                                            @isset($resultadoPlanilla->id_monedas)
                                                @php
                                                    $monedas = explode(",", $resultadoPlanilla->id_monedas);
                                                @endphp

                                                @foreach($monedas as $moneda)
                                                    @if($datos->id_moneda == $moneda)
                                                        @php
                                                            $opcion = "selected";
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endisset
                                            <option value="{{ $datos->id_moneda }}" {{$opcion}}>{{ $datos->leyenda }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <br>
                                <a href="#" class="btn px-4 btn-light-success font-bolder btn-brc-tp mb-1" data-toggle="modal" data-target="#deduccionPatronal">Ver deducciones patronales</a>

                            </div>
                        </div>

                        <div class="form-group row mt-4" id="divTipoPago" @if($mensual=="") style="display: none;" @endif>
                            <!-- tipo de pago  -->
                            <div class="mt-2 col-lg-4 col-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="El tipo de pago es definido únicamente para la planilla mensual, para indicar si el pago puede ser con o sin adelanto.">
                                        <i class="fa-solid fa-circle-info blue"></i>
                                    </span>
                                    {{ __('Tipo de pago') }}
                                </label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control mt-1" id="id_tipo_pago" name="id_tipo_pago" onchange="opcionSeleccionada()">
                                    @foreach($catalogoTiposPago as $tipoPago)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoPlanilla->id_tipo_pago)
                                            @if($tipoPago->id_tipo_pago == $resultadoPlanilla->id_tipo_pago)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset
                                        <option value="{{ $tipoPago->id_tipo_pago }}" {{$opcion}}>{{ $tipoPago->codigo.'-'.$tipoPago->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2 col-lg-4 col-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1" data-toggle="tooltip" data-placement="top" title=" {{ __('Porcentaje del salario base en el adelanto ') }} ">
                                     <span class="d-inline-block text-truncate" style="max-width: 203px;">
                                    {{ __('Porcentaje del salario base en el adelanto ') }}
                                    </span>
                                </label>
                                <div class="input-group justify-content-center">
                                    <input type="text" @isset($resultadoPlanilla->id_tipo_pago) @if($resultadoPlanilla->id_tipo_pago!=1) disabled @endif @endisset lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="porcentaje_salario_adelanto" name="porcentaje_salario_adelanto" value="{{ old('porcentaje_salario_adelanto') ?? $resultadoPlanilla->porcentaje_salario_adelanto ??"0.00"}}" />
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div id="cargas_sociales" class="mt-2 col-lg-4 col-12 @isset($resultadoPlanilla->id_tipo_pago) @if($resultadoPlanilla->id_tipo_pago!=1) d-none @endif @endisset">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1" data-toggle="tooltip" data-placement="top" title=" Cálcular cargas sociales y renta a rebajar con el adelanto de salario">

                                    <span class="d-inline-block">
                                   Cargas sociales y renta en adelanto...
                                    </span>
                                </label>
                                <br>

                                <div class="form-check form-check-inline">
                                    <div class="my-1">
                                        <label>
                                            <input type="radio" @isset($resultadoPlanilla->aplicar_cargas_renta_adelanto) @if($resultadoPlanilla->aplicar_cargas_renta_adelanto =="si") checked @endif @endisset name="form-field-select-cargas" id="inlineRadio1" value="Si" class="mr-1">
                                            Si
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="my-1">
                                        <label>
                                            <input type="radio" @isset($resultadoPlanilla->aplicar_cargas_renta_adelanto) @if($resultadoPlanilla->aplicar_cargas_renta_adelanto =="no") checked @endif @endisset  name="form-field-select-cargas" id="inlineRadio2" value="No" class="mr-1">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 d-none">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Porcentaje de cargas sociales y renta a rebajar en adelanto') }} </label>
                                <div class="input-group justify-content-center">
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="porcentaje_cargas_adelanto" name="porcentaje_cargas_adelanto"  value="{{ old('porcentaje_cargas_adelanto') ?? $resultadoPlanilla->porcentaje_cargas_adelanto ??"0.00"}}" />
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 d-none">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Porcentaje de otras deducciones no grabables en adelanto') }} </label>
                                <div class="input-group justify-content-center">
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="porcentaje_deducciones_adelanto" name="porcentaje_deducciones_adelanto" value="{{ old('porcentaje_deducciones_adelanto') ?? $resultadoPlanilla->porcentaje_deducciones_adelanto ??"0.00"}}"/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row mt-4">
                            <div class="mt-2 col-lg-4 col-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Años de cesantía?') }} </label>
                                <input type="text" min="8"  lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input mt-1" id="anios_cesantia" name="anios_cesantia" value="{{ old('aniosCesantia') ?? $resultadoPlanilla->anios_cesantia ??""}}" />
                            </div>
                            <div class="mt-2 col-lg-4 col-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Número patrono CCSS') }} </label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 mt-1" id="numero_patrono_ccss" name="numero_patrono_ccss" readonly value="{{ old('numero_patrono_ccss') ?? $resultadoEmpresa->identificacion ??""}}" />
                            </div>
                            <div class="mt-2 col-lg-4 col-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Número póliza INS') }} </label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 mt-1" id="numero_poliza_ins" name="numero_poliza_ins" readonly value="{{ old('numero_poliza_ins') ?? $resultadoEmpresa->identificacion ??""}}" />
                            </div>
                        </div>
                        <br>
                        <h3 class="card-title text-125 text-green-m2">
                            <i class="nav-icon fa fa-screwdriver-wrench text-green-m2"></i>
                            {{ __('Ajustes') }}
                        </h3>
                        <hr>
                        <div class="form-group row mt-4">

                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->envio_comprobante_pago)){
                                    if($resultadoPlanilla->envio_comprobante_pago==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp
                            <div class="col-12 cards-container" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Envío de comprobante de pago?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="envio_comprobante_pago">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>


                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->vacaciones_adelantadas)){
                                    if($resultadoPlanilla->vacaciones_adelantadas==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp
                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Vacaciones adelantadas?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="vacaciones_adelantadas">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>

                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->adelanto_aguinaldo)){
                                    if($resultadoPlanilla->adelanto_aguinaldo==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Adelanto de aguinaldo en efectivo?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="adelanto_aguinaldo">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>


                        </div>
                        <!--  //////////////////////////////////////////////////////////////////////-->

                        <div class="form-group row mt-4">
                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->envio_comprobante_pago)){
                                    if($resultadoPlanilla->envio_comprobante_pago==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Envío de comprobante de pago?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="envio_comprobante_pago">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>





                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->vacaciones_adelantadas)){
                                    if($resultadoPlanilla->vacaciones_adelantadas==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Vacaciones adelantadas?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="vacaciones_adelantadas">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>

                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->adelanto_aguinaldo)){
                                    if($resultadoPlanilla->adelanto_aguinaldo==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Adelanto de aguinaldo en efectivo?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="adelanto_aguinaldo">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>

                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->plan_bonificaciones)){
                                    if($resultadoPlanilla->plan_bonificaciones==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Plan de bonificaciones?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="plan_bonificaciones">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>

                        </div>

                        <div class="form-group row mt-4">

                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->plan_ahorro_voluntario)){
                                    if($resultadoPlanilla->plan_ahorro_voluntario==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Plan de ahorro voluntario?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="plan_ahorro_voluntario">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>

                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->modulo_liquidacion)){
                                    if($resultadoPlanilla->modulo_liquidacion==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Módulo de liquidación?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} name="modulo_liquidacion">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>

                        </div>



                        @php
                            $mostrar="display: none;";
                        @endphp
                        @isset($resultadoPlanilla->asociacion_solidarista)
                            @if($resultadoPlanilla->asociacion_solidarista!=0)
                                @php
                                    $mostrar="";
                                @endphp
                            @endif
                        @endisset

                        <div class="form-group row align-items-center">
                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->asociacion_solidarista)){
                                    if($resultadoPlanilla->asociacion_solidarista==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Asociación solidarista?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} id="asociacion" name="asociacion_solidarista">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>

                            <div class="col-12 mt-4">
                                <div class="form-group row" id="divAportes" style="{{$mostrar}}">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Porcentaje aporte de patrono') }} </label>
                                        <div class="input-group justify-content-center">
                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="asociacion_solidarista_patrono" name="asociacion_solidarista_patrono"  value="{{ old('asociacion_solidarista_patrono') ?? $resultadoPlanilla->asociacion_solidarista_patrono ??"0.00"}}" />
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mt-2 mt-md-0">
                                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Porcentaje aporte de colaborador') }} </label>
                                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="asociacion_solidarista_colaborador" name="asociacion_solidarista_colaborador"  value="{{ old('asociacion_solidarista_colaborador') ?? $resultadoPlanilla->asociacion_solidarista_colaborador ??"0.00"}}" />
                                    </div>
                                </div>
                            </div>

                        </div>

                        @php
                            $mostrar="display: none;";
                        @endphp
                        @isset($resultadoPlanilla->prestamos)
                            @if($resultadoPlanilla->prestamos!=0)
                                @php
                                    $mostrar="";
                                @endphp
                            @endif
                        @endisset

                        <div class="form-group row align-items-center">
                            @php
                                $opcion = "";
                                if(isset($resultadoPlanilla->prestamos)){
                                    if($resultadoPlanilla->prestamos==1){
                                        $opcion = "checked";
                                    }
                                    else {
                                        $opcion = "";
                                    }
                                }
                            @endphp

                            <div class="col-12 cards-container mt-4" id="">
                                <div class="card border-0 shadow-sm" id="card-8" draggable="false">
                                    <div class="card-header bgc-primary-d3">
                                        <h5 class="card-title text-25 text-white pt-1">
                                            {{ __('¿Préstamos?') }}
                                        </h5>

                                        <div class="card-toolbar no-border">
                                            <label class="mb-0 ml-2">
                                                <input type="checkbox" class="ace-switch align-bottom text-dark-tp5 bgc-warning-d2" {{$opcion}} id="prestamos" name="prestamos">
                                            </label>
                                        </div>
                                    </div><!-- /.card-header -->

                                    <div class="card-body p-0 border-1 border-t-0 brc-green-m2">
                                        <div class="p-3">
                                            <p class="mb-0 text-dark-m2">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
                                            </p>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div>


                            <div class="col-12 mt-4">
                                <div class="form-group row" id="divPrestamos" style="{{$mostrar}}">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tasa mínima de interés anual') }} </label>
                                        <div class="input-group justify-content-center">
                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="prestamos_tasa" name="prestamos_tasa"  value="{{ old('prestamos_tasa') ?? $resultadoPlanilla->prestamos_tasa ??"0.00"}}" />
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mt-2 mt-md-0">
                                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Cantidad máxima de cuotas mensuales') }} </label>
                                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="prestamos_cuotas" name="prestamos_cuotas"  value="{{ old('prestamos_cuotas') ?? $resultadoPlanilla->prestamos_cuotas ??"0.00"}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h3 class="card-title text-125 text-green-m2">
                            <i class="nav-icon fa fa-clock text-green-m2"></i>
                            {{ __('Vacaciones') }}
                        </h3>
                        <hr>
                        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                            <tr>
                                <th scope="col" class="text-left text-md-center align-middle">
                                    Rango de años
                                </th>

                                <th scope="col" class="text-left text-md-center align-middle">
                                    Factor
                                </th>

                                <th scope="col" class="text-left text-md-center align-middle">
                                    Descripción
                                </th>
                            </tr>
                            </thead>

                            <tbody class="mt-1">
                            <tr class="bgc-h-blue-l4 d-style">

                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango1" name="rango1" value="0-5" />
                                </td>

                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor1" name="factor1" value="0.833" />
                                </td>

                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                                    Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 0.833) = 10 días.
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">

                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango2" name="rango2" value="5-10" />
                                </td>

                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor2" name="factor2" value="1" />
                                </td>


                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                                    Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1) = 12 días.
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">

                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango3" name="rango3" value="10-15" />
                                </td>

                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor3" name="factor3" value="1.2" />
                                </td>


                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                                    Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1.2) = 15 días.
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">

                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango4" name="rango4" value="15-60" />
                                </td>

                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor4" name="factor4" value="2" />
                                </td>


                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                                    Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 2) = 24 días.
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        <div class="modal fade " id="deduccionPatronal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title text-blue-d2">
                                            Deducciones patronales por ley
                                        </h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body ace-scrollbar">
                                        <br>Las deducciones son montos establecidos por ley, por lo tanto no son modificables.<br><br>

                                        <div class="table-responsive">
                                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                                <tr>
                                                    <th class="text-center" rowspan="2" style="vertical-align : middle;text-align:center;">
                                                        Deducciones Patronales
                                                    </th>
                                                    <th scope="col" class="text-left text-md-center small align-middle">
                                                        Contribuciones
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody class="mt-1">
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        Base mínima de cotización vigente
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        CCSS S.E.M
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="9.25" min="0.00" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="ccssSEM" name="ccssSEM" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        IVM Patronal
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="5.08" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="IVMPatronal" name="IVMPatronal" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        A.S.F.A
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="5.00" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="ASFA" name="ASFA" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        Cuota patronal banco popular
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="0.25" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="CuotaBP" name="CuotaBP" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        I.M.A.S.
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="0.50" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="IMAS" name="IMAS" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        I.N.A.
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="1.50" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="INA" name="INA" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        LPT Banco Popular patrono
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="0.25" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="LPTBPPatrono" name="LPTBPPatrono" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        LPT Banco Popular obrero
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="1.00" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="LPTBPObrero" name="LPTBPObrero" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        LPT INS
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="1.00" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="LPTINS" name="LPTINS" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        FCL
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="3.00" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="FCL" name="FCL" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        Pensión complementaria obligatoria
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="0.50" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="pensionComplementaria" name="pensionComplementaria" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style table-primary">
                                                    <td class="text-grey-d1 font-bolder">
                                                        Total empresa
                                                    </td>

                                                    <td class='text-grey-d1 text-center font-bolder'>
                                                        <label id="Patrono" name="Patrono">
                                                            27.33%
                                                        </label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="table-responsive">
                                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                                <tr>
                                                    <th class="text-center" rowspan="2" style="vertical-align : middle;text-align:center;">
                                                        Deducciones a Colaboradores
                                                    </th>
                                                    <th class="text-center" >
                                                        Contribuciones
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody class="mt-1">
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        CCSS S.E.M
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="5.50" min="0.00" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="ccssSEMColaborador" name="ccssSEMColaborador" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        CCSS IVM
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="3.84" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="CCSSIVM" name="CCSSIVM" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bgc-h-blue-l4 d-style">
                                                    <td class="text-grey-d1">
                                                        Banco Popular
                                                    </td>

                                                    <td class='text-grey-d1'>
                                                        <div class="input-group justify-content-center">
                                                            <input type="text" value="1.00" min="0" lang="en"  class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="bancoPopular" name="bancoPopular" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr class="bgc-h-blue-l4 d-style table-primary">
                                                    <td class="text-grey-d1 font-bolder">
                                                        Total Colaborador
                                                    </td>

                                                    <td class='text-grey-d1 text-center font-bolder'>
                                                        <label id="Colaborador" name="Colaborador">
                                                            10.34%
                                                        </label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <br><br>
                                        <div class="alert alert-info font-bolder" >
                                            Total general: <label id="TotalGeneral" name="TotalGeneral">
                                                37.67%
                                            </label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Cancelar
                                </a>
                                <button type="button" id="registrarplanilla" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Guardar
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="confirmModalPlanilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                                            Mensaje
                                        </h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Desea guardar datos de planilla para la empresa?
                                        <br />
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <button type="submit" id="guardar-planilla" class="btn btn-primary" >
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane show {{$bancos}} fade text-95" id="bancos" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-bancos" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Bancos" hidden/>

                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de planilla') }}</label>
                                <div>
                                    <select class="form-control" data-style="btn-outline-default btn-h-outline-primary btn-a-outline-primary" multiple id="selectpicker3" name="id_tipos_planilla_banco[]">
                                        @if(isset($resultadoPlanilla->id_tipos_planilla))
                                            @php
                                                $planillas = explode(",", $resultadoPlanilla->id_tipos_planilla);
                                            @endphp

                                            @foreach($catalogoTipoPlanilla as $datos)
                                                @foreach($planillas as $planilla)
                                                    @if($datos->id_tipo_planilla==$planilla)
                                                        <option value="{{ $datos->id_tipo_planilla }}" {{$opcion}}>{{ $datos->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach($catalogoTipoPlanilla as $datos)
                                                <option value="{{ $datos->id_tipo_planilla }}" >{{ $datos->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }} </label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="id_moneda_Banco" name="id_moneda_Banco" >
                                    @if(isset($resultadoPlanilla->id_monedas))
                                        @php
                                            $monedas = explode(",", $resultadoPlanilla->id_monedas);
                                        @endphp

                                        @foreach($catalogoMonedas as $datos)
                                            @foreach($monedas as $moneda)
                                                @if($datos->id_moneda==$moneda)
                                                    <option value="{{ $datos->id_moneda }}" {{$opcion}}>{{ $datos->leyenda }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        @foreach($catalogoMonedas as $datos)
                                            <option value="{{ $datos->id_moneda }}" >{{ $datos->leyenda }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Banco') }}</label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="id_banco" name="id_banco" >
                                    @foreach($catalogoBancos as $datos)
                                        <option value="{{ $datos->id_banco }}" >{{ $datos->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cuenta IBAN') }} </label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cuentaIban" name="cuentaIban"  />
                            </div>
                        </div>

                        <div class="form-group row mt-4">

                            <div class="col-md-3 col-sm-12 align-self-end">
                                <button type="button" id="registrarbancos" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                </span>
                                    Agregar
                                </button>
                            </div>
                        </div>

                        @if($resultadoBancos->isEmpty())
                            <div class="alert alert-warning">
                                No hay bancos registrados.
                            </div>
                        @else
                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Tipo de Planilla
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Banco
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Moneda
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Cuenta IBAN
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Acción
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="mt-1">

                                @foreach($resultadoBancos as $datos)
                                    <tr class="bgc-h-blue-l4 d-style">

                                        <td data-label=" Tipo de Planilla:" class='text-grey-d1 text-right text-md-center small'>
                                            {{ $datos->tipo_planilla }}
                                        </td>

                                        <td data-label="Banco:" class='text-grey-d1 text-right text-md-center small'>
                                            {{ $datos->banco }}
                                        </td>

                                        <td data-label="Banco:" class='text-grey-d1 text-right text-md-center small'>
                                            @if($datos->moneda == "colones")
                                                {{ "Colones" }}
                                            @else
                                                {!! "D&oacute;lares" !!}
                                            @endif
                                        </td>

                                        <td data-label=" Cuenta IBAN:" class='text-grey-d1 text-right text-md-center small'>
                                            {{ $datos->cuenta_iban }}
                                        </td>

                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex justify-content-center'>
                                                <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id}}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </div>

                                            <!-- show a dropdown in mobile -->
                                            <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                                                <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                                    <i class="fa fa-cog"></i>
                                                </a>

                                                <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                                    <div class="dropdown-inner">
                                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                                            {{ __('Acción') }}
                                                        </div>
                                                        <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id}}" class="dropdown-item">
                                                            <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                                            {{ __('Eliminar') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!---->
                                        </td>
                                    </tr>

                                    <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarBanco{{$datos->id}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                                <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                                        ¡Atención!
                                                    </h5>

                                                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" class="text-150">&times;</span>
                                                    </button>
                                                </div>


                                                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                                    <div class="d-flex align-items-top mr-2 mr-md-5">
                                                        <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                                        <div class="text-secondary-d2 text-105">
                                                            ¿Está seguro que desea eliminar el banco de la empresa?
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer bgc-white-tp2 border-0">
                                                    <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                                        No
                                                    </button>

                                                    <a href="{{ route("empresaEliminarBanco",[ Crypt::encrypt(session()->get("id_cliente")), $datos->id]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                                        Si
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </tbody>
                            </table>
                        @endif

                        <div class="modal fade" id="confirmModalBancos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                                            Mensaje
                                        </h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Desea guardar datos de bancos para la empresa?
                                        <br />
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <button type="submit" id="guardar-bancos" class="btn btn-primary" >
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade text-95" id="controlHorario" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Control de horario" hidden/>
                        <div class="alert alert-secondary bgc-secondary-l4 brc-secondary-l2 text-dark-tp2" role="alert">
                            <h5 class="alert-heading text-primary-d1 font-bolder">
                                Alerta de mensaje
                            </h5>

                            M&oacute;dulo de <b>control de horario</b> en construcci&oacute;n
                        </div>
                    </form>
                </div>
                <div class="tab-pane show {{$ocupaciones}} fade text-95" id="ocupaciones" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-ocupaciones" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Ocupaciones" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Código de la ocupación') }}</label>
                                <input type="text"  class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12" id="codigoPuesto" name="codigoPuesto"  />
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de la ocupación') }}</label>
                                <input type="text"  class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombrePuesto" name="nombrePuesto"  />
                            </div>
                            <div class="col-md-3 col-sm-12 align-self-end">
                                <button type="button"  id="registrarocupaciones" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                    <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Agregar Ocupación
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-3 border-t-1 brc-secondary-l2 py-35 mx-n25">
                        @if($resultadoPuestos->isEmpty())
                            <div class="alert alert-warning">
                                No hay ocupaciones registradas.
                            </div>
                        @else
                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Código de la ocupación
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Nombre de la ocupación
                                    </th>

                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        Acción
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="mt-1">
                                @foreach($resultadoPuestos as $datos)
                                    <tr class="bgc-h-blue-l4 d-style">

                                        <td data-label=" Código de puesto:" class='text-grey-d1 text-right text-md-center small'>
                                            {{$datos->codigo}}
                                        </td>

                                        <td data-label="Puesto:" class='text-grey-d1 text-right text-md-center small'>
                                            {{$datos->nombre}}
                                        </td>

                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex justify-content-center'>
                                                <a href="#" data-toggle="modal" data-target="#editModal{{$datos->id_puesto}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <a data-form-id="{{$datos->id_puesto}}"  class="delete-btn mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </div>

                                            <!-- show a dropdown in mobile -->
                                            <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                                                <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                                    <i class="fa fa-cog"></i>
                                                </a>

                                                <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                                    <div class="dropdown-inner">
                                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                                            {{ __('Acción') }}
                                                        </div>
                                                        <a href="#" data-toggle="modal" data-target="#editModal{{$datos->id_puesto}}" class="dropdown-item">
                                                            <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                            Editar
                                                        </a>
                                                        <a class="btn delete-btn dropdown-item" data-form-id="{{$datos->id_puesto}}">
                                                            <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                                            {{ __('Eliminar') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <form method="POST" id="frm-delete-puesto-{{$datos->id_puesto}}" action="{{ route('puestosEmpresa.delete',[$datos->id_puesto]) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <form method="POST" action="{{ route('puestosEmpresa.update',[$datos->id_puesto]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal fade" data-backdrop-bg="bgc-white" id="editModal{{$datos->id_puesto}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <div class="modal-content bgc-transparent brc-warning-m2 shadow">
                                                            <div class="modal-header py-2 bgc-warning-tp1 border-0  radius-t-1">
                                                                <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="warningModalLabel">
                                                                    Editar puesto
                                                                </h5>

                                                                <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true" class="text-150">&times;</span>
                                                                </button>
                                                            </div>


                                                            <div class="modal-body bgc-white-tp2 p-md-4">
                                                                <div>
                                                                    <div class="text-secondary-d2 text-105">
                                                                        Código de puesto:
                                                                        <input type="text" value="{{$datos->codigo}}" class="form-control col-sm-12" id="codigoPuestoEditar" name="codigoPuestoEditar"/>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div>
                                                                    <div class="text-secondary-d2 text-105">
                                                                        Nombre de puesto:
                                                                        <input type="text" value="{{$datos->nombre}}" class="form-control col-sm-12" id="nombrePuestoEditar" name="nombrePuestoEditar"/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer bgc-white-tp2 border-0">
                                                                <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                                                    Cancelar
                                                                </button>

                                                                <button type="submit" class="btn px-4 btn-warning" id="id-danger-yes-btn">
                                                                    Guardar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <div class="tab-pane show {{$accionPersonal}} fade text-95" id="accionPersonal" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-accionPersonal" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Acción de personal" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-4 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de acción de personal') }}</label>
                                <input type="text"  class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="codigoAccionPersonal" name="codigoAccionPersonal"  />
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="nombreAccionPersonal" name="nombreAccionPersonal" >
                                    @foreach($accionesPersonal as $accionPersonal)
                                        <option value="{{$accionPersonal->id_categoria}}" >{{ $accionPersonal->codigo." - ".$accionPersonal->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 align-self-end mt-2 mt-md-0">
                                <div class="px-1">
                                    <button type="button"  id="registraraccionespersonal" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                    <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                        Agregar acción de personal
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="modal fade" id="confirmModalAccionesPersonal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                                            Mensaje
                                        </h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Desea guardar acción de personal para la empresa?
                                        <br />
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <button type="submit" class="btn btn-primary" id="guardar-accionespersonal">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mt-3 border-t-1 brc-secondary-l2 py-35 mx-n25">



                        <table id="simple-table" class="resp mb-0 table  table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                            <tr>
                                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                    Código de acción de personal
                                </th>

                                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                    Nombre de acción de personal
                                </th>

                                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                    Acción
                                </th>
                            </tr>
                            </thead>

                            <tbody class="mt-1">
                            @foreach($accionesPersonal as $accionPersonal)
                                <tr class="bgc-h-blue-l4 d-style">

                                    <td data-label="Código de acción de personal:" class='text-grey-d1 text-right text-md-center small'>
                                        {{$accionPersonal->codigo}}
                                    </td>

                                    <td data-label="Nombre de acción de personal:" class='text-grey-d1 text-right text-md-center small'>
                                        {{$accionPersonal->nombre}}
                                    </td>

                                    <td data-label=" Acción:" class='text-grey-d1 text-right text-md-center small'>
                                        <!-- action buttons -->
                                        <div class='d-none d-lg-flex justify-content-center'>
                                            <a href="#" data-toggle="modal" data-target="#editModal{{$accionPersonal->id_categoria}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success"><i class="fa fa-pencil-alt"></i></a>
                                        </div>

                                        <!-- show a dropdown in mobile -->
                                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                                            <a href="#" data-toggle="modal" data-target="#editModal{{$accionPersonal->id_categoria}}" class="btn btn-default btn-xs py-15 radius-round"><i class="fa fa-pencil-alt"></i></a>
                                        </div>

                                        <form method="POST" action="{{ route('configuracionAccionPersonal.update',[Crypt::encrypt(session()->get('id_cliente'))]) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal fade" data-backdrop-bg="bgc-white" id="editModal{{$accionPersonal->id_categoria}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <div class="modal-content bgc-transparent brc-warning-m2 shadow">
                                                        <div class="modal-header py-2 bgc-warning-tp1 border-0  radius-t-1">
                                                            <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="warningModalLabel">
                                                                Editar acción de personal
                                                            </h5>

                                                            <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="text-150">&times;</span>
                                                            </button>
                                                        </div>


                                                        <div class="modal-body bgc-white-tp2 p-md-4">
                                                            <div >
                                                                <div class="text-secondary-d2 text-105">
                                                                    Nombre acción de personal:
                                                                    <input type="text" class="form-control col-sm-12" id="nombreAccionEdit" name="nombreAccionEdit"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer bgc-white-tp2 border-0">
                                                            <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                                                Cancelar
                                                            </button>

                                                            <button type="submit" class="btn px-4 btn-warning" id="id-danger-yes-btn">
                                                                Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('componentes.modalCargando')

    <div class="modal fade" data-backdrop-bg="bgc-white" id="error" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                        Error
                    </h5>
                </div>


                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                    <div class="d-flex align-items-top mr-2 mr-md-5">
                        <div class="text-secondary-d2 text-105 ml-3">
                            <i class="fas fa-exclamation-triangle mr-1 mb-1 text-danger"></i>
                            No se encontraron resultados para la cédula indicada.
                        </div>
                    </div>
                </div>

                <div class="modal-footer bgc-white-tp2 border-0">
                    <button type="button" class="btn px-4 btn-danger" id="id-danger-yes-btn" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!--validaciones-->
    <script type="module">
        //1- MODULO GENERALES
        $('#guardar-datosgenerales').on('click', function (evt)
        {
            $('#confirmModalDatosGeneral').modal('hide');
            $('#cargando').modal('show');
        });

        $('#form-datosgenerales').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                identificacion: {
                    required: true
                },
                nombre: {
                    required: true
                },
                nombre_fantasia: {
                    required: true
                },
                direccion: {
                    required: true
                },
                telefonoFijo: {
                    required: true
                },
                telefonoCelular: {
                    required: true
                }
            },

            messages: {
                identificacion: {
                    required: "Este campo es requerido."
                },
                nombre: {
                    required: "Este campo es requerido."
                },
                nombre_fantasia: {
                    required: "Este campo es requerido."
                },
                direccion: {
                    required: "Este campo es requerido."
                },
                telefonoFijo: {
                    required: "Este campo es requerido."
                },
                telefonoCelular: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrardatosgenerales").on('click', function (evt)
        {
            if($('#form-datosgenerales').valid())
            {
                $('#confirmModalDatosGeneral').modal('show');
            }
            else
            {
                return false;
            }
        });

        //2- COMUNICACIONES
        $('#guardar-comunicaciones').on('click', function (evt)
        {
            $('#confirmModalComunicaciones').modal('hide');
            $('#cargando').modal('show');
        });

        $('#form-comunicaciones').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                correo_reportes: {
                    required: true
                },
                correo_pagos: {
                    required: true
                },
                correo_curriculums: {
                    required: true
                }
            },

            messages: {
                correo_reportes: {
                    required: "Este campo es requerido."
                },
                correo_pagos: {
                    required: "Este campo es requerido."
                },
                correo_curriculums: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarcomunicaciones").on('click', function (evt)
        {
            if($('#form-comunicaciones').valid())
            {
                $('#confirmModalComunicaciones').modal('show');
            }
            else
            {
                return false;
            }
        });

        //3- Planilla
        $('#guardar-planilla').on('click', function (evt)
        {
            $('#confirmModalPlanilla').modal('hide');
            $('#cargando').modal('show');
        });

        $('#form-planilla').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                anios_cesantia: {
                    required: true,
                    min:1,
                    max:8
                },
                numero_patrono_ccss: {
                    required: true
                },
                numero_poliza_ins: {
                    required: true
                },
                porcentaje_salario_adelanto:{
                    max:50
                }
            },

            messages: {
                anios_cesantia: {
                    required: "Este campo es requerido.",
                    min: "Por favor, digite un valor mayor o igual a 1.",
                    max: "Por favor, digite un valor menor o igual a 8."
                },
                numero_patrono_ccss: {
                    required: "Este campo es requerido."
                },
                numero_poliza_ins: {
                    required: "Este campo es requerido."
                },
                porcentaje_salario_adelanto:{
                    max: "Por favor, digite un valor menor o igual a 50."
                }
            },
            errorElement : 'span'
        });

        $("#registrarplanilla").on('click', function (evt)
        {
            if($('#form-planilla').valid())
            {
                $('#confirmModalPlanilla').modal('show');
            }
            else
            {
                return false;
            }
        });

        //4- Bancos
        $('#guardar-bancos').on('click', function (evt)
        {
            $('#confirmModalBancos').modal('hide');
            $('#cargando').modal('show');
        });

        $('#form-bancos').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                cuentaIban: {
                    required: true
                }
            },

            messages: {
                cuentaIban: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarbancos").on('click', function (evt)
        {
            if($('#form-bancos').valid())
            {
                $('#confirmModalBancos').modal('show');
            }
            else
            {
                return false;
            }
        });

        //6- Ocupaciones
        $('#guardar-ocupaciones').on('click', function (evt)
        {
            $('#confirmModalOcupaciones').modal('hide');
            $('#cargando').modal('show');
        });

        $('#form-ocupaciones').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                codigoPuesto: {
                    required: true,
                    maxlength: 5  // Define que el campo debe tener menos de 5 caracteres
                },
                nombrePuesto: {
                    required: true
                }
            },
            messages: {
                codigoPuesto: {
                    required: "Este campo es requerido.",
                    maxlength: "El código debe tener menos de 5 caracteres."
                },
                nombrePuesto: {
                    required: "Este campo es requerido."
                }
            },
            errorPlacement: function(error, element){
                if(element.hasClass("form-control")){
                    error.insertAfter(element.closest('.input-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        });


        $("#registrarocupaciones").on('click', function (evt)
        {
            if($('#form-ocupaciones').valid())
            {
                confirmar('', '¿Desea guardar el registrado de la ocupación?', 'question', function() {
                    waitingDialog.show();
                    $('#form-ocupaciones').submit();
                });
            }
            else
            {
                return false;
            }
        });

        $('.delete-btn').on('click', function(event) {
            // Evita que el enlace realice su acción predeterminada (navegar a otra página)
            event.preventDefault();
            // Obtiene el ID del formulario del atributo de datos del enlace
            var formId = $(this).data('form-id');
            confirmar('', ' ¿Está seguro que desea eliminar la ocupación?', 'question', function() {
                waitingDialog.show();
                // Selecciona el formulario por su ID dinámico y envíalo
                $('#frm-delete-puesto-' + formId).submit();
            });
        });

        //7- Acción de personal
        $('#guardar-accionespersonal').on('click', function (evt)
        {
            $('#confirmModalAccionesPersonal').modal('hide');
            $('#cargando').modal('show');
        });

        $('#form-accionPersonal').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                codigoAccionPersonal: {
                    required: true
                }
            },
            messages: {
                codigoAccionPersonal: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registraraccionespersonal").on('click', function (evt)
        {
            if($('#form-accionPersonal').valid())
            {
                $('#confirmModalAccionesPersonal').modal('show');
            }
            else
            {
                return false;
            }
        });
    </script>

    <!--funciones-->
    <script type="module">

        $('#buscarCedula').on('click', function (evt)
        {
            $('#cargando').modal('show');
            let cedula = $("#identificacion").val().replaceAll("-","").trim();

            $.ajax({
                type: "POST",
                url: "{{ route('obtenerNombre.edit') }}",
                data:{'cedula':cedula},
                success:function(response) {
                    $("#nombre").val(response);
                    $('#cargando').modal('hide');
                },
                error:function()
                {
                    $('#cargando').modal('hide');
                    $("#nombre").val("");
                    $('#error').modal('show');
                }
            });
        });

        $('#tipoIdentificacion').on("change", function (evt)
        {
            if($('#tipoIdentificacion').val()==1)
            {
                //cedula mascara
                $("#cedula").inputmask({
                    mask: '9-9999-9999',
                    placeholder: '9-9999-9999',
                    showMaskOnHover: true,
                    showMaskOnFocus: true,
                    onBeforePaste: function (pastedValue, opts) {
                        var processedValue = pastedValue;

                        //do something with it

                        return processedValue;
                    }
                });

                //cedula mascara
                $("#patronoCCSS").inputmask({
                    mask: '9-9999999999-999-999',
                    placeholder: '9-9999999999-999-999',
                    showMaskOnHover: true,
                    showMaskOnFocus: true,
                    onBeforePaste: function (pastedValue, opts) {
                        var processedValue = pastedValue;

                        //do something with it

                        return processedValue;
                    }
                });
            }
            else if($('#tipoIdentificacion').val()==2)
            {
                //cedula mascara
                $("#cedula").inputmask({
                    mask: '9-999-999999',
                    placeholder: '9-999-999999',
                    showMaskOnHover: true,
                    showMaskOnFocus: true,
                    onBeforePaste: function (pastedValue, opts) {
                        var processedValue = pastedValue;

                        //do something with it

                        return processedValue;
                    }
                });

                //cedula mascara
                $("#patronoCCSS").inputmask({
                    mask: '9-99999999999-999-999',
                    placeholder: '9-99999999999-999-999',
                    showMaskOnHover: true,
                    showMaskOnFocus: true,
                    onBeforePaste: function (pastedValue, opts) {
                        var processedValue = pastedValue;

                        //do something with it

                        return processedValue;
                    }
                });
            }
        });
    </script>


    <script type="module">

        $('#selectpicker1').on('change', function ()
        {
            let seleccionado = 0;
            $('#selectpicker1 :selected').each(function(i, sel)
            {
                if($(sel).val() == 2)
                {
                    seleccionado = 2;
                }
            });

            if(seleccionado == 2)
            {
                $('#divTipoPago').show();
            }
            else
            {
                $('#divTipoPago').hide();
            }
        });

        $('#asociacion').on('click',function(){
            if( $('#asociacion').is(':checked') )
            {
                $('#divAportes').show();
            }
            else
            {
                $('#divAportes').hide();
            }
        });

        $('#prestamos').on('click',function(){
            if( $('#prestamos').is(':checked') )
            {
                $('#divPrestamos').show();
            }
            else
            {
                $('#divPrestamos').hide();
            }
        });
    </script>

    <script>
        function opcionSeleccionada() {
            var select = document.getElementById("id_tipo_pago");
            var opcionSeleccionada = select.value;

            // Realiza la acción deseada según la opción seleccionada
            switch (opcionSeleccionada) {
                case "1":
                    $("#porcentaje_salario_adelanto").prop("disabled", false);
                    $("#porcentaje_salario_adelanto").val("50.00")
                    $("#cargas_sociales").removeClass("d-none");
                    break;
                case "2":
                    $("#porcentaje_salario_adelanto").prop("disabled", true);
                    $("#porcentaje_salario_adelanto").val("0");
                    $("#cargas_sociales").addClass("d-none");

                    break;

                default:
                    $("#porcentaje_salario_adelanto").prop("disabled", false);
                    $("#porcentaje_salario_adelanto").val("50.00")
                    $("#cargas_sociales").addClass("d-none");
                    break;
            }
        }
    </script>

@endpush
