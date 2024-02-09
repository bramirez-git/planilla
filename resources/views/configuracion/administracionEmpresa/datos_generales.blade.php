<form id="form-datosgenerales" class="mt-lg-3" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Datos generales" hidden/>
    <input type="text" name="tab" value="datos_generales-tab" hidden/>
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
                    @if($existe_path)
                        <img alt="Gallery Image 6" style="width: 220px; height: 220px;" src="data:image/jpeg;base64,{{ $foto }}" class="w-100 d-zoom-2 " data-size="960x1200"/>
                        <input type="text" value="{{ Crypt::encrypt($resultadoEmpresa->foto) }}" hidden name="fotoActual"/>
                    @else
                        <img alt="Gallery Image 6" style="width: 220px; height: 220px;" src="{{ asset('img/default-empresa.png') }}" class="w-100 d-zoom-2 " data-size="960x1200"/>
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
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="id_tipo_identificacion" name="id_tipo_identificacion">
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
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de identificación') }}</label>
            <div class="input-group input-group-fade">
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" data-name_error="Número de identificación" id="identificacion" name="identificacion" value="{{ old('identificacion') ?? $resultadoEmpresa->identificacion ??""  }}"/>
                <div class="input-group-append">
                    <button class="btn btn-outline-default btn-bold" type="button" id="buscarCedula">Buscar</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nombre de empresa') }} </label>
            <input type="text" data-name_error="Nombre de empresa" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre" name="nombre" value="{{ old('nombre') ?? $resultadoEmpresa->nombre ??""  }}" readonly/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nombre de fantasía') }} </label>
            <input type="text" data-name_error="Nombre de fantasía" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_fantasia" name="nombre_fantasia" value="{{ old('nombre_fantasia') ?? $resultadoEmpresa->nombre_fantasia ??""  }}"/>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Correo electrónico') }} </label>
            <input type="text" data-inputmask="'alias': 'email'"
                   class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12" data-name_error="Correo electrónico" id="correo" name="correo" value="{{ old('nombre_fantasia') ?? $resultadoEmpresa->correo ??""  }}"/>
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
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"  id="provincia" name="provincia" onchange="cantones()">
                @foreach($provincias as $provincia)
                    @php $opcion=""; @endphp
                    @isset($resultadoEmpresa->id_provincia)
                        @if($provincia->id_provincia == $resultadoEmpresa->id_provincia)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset
                    <option value="{{ $provincia->id_provincia }}" {{$opcion}}>{{ ucwords(strtolower($provincia->provincia )) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Cantón') }} </label>
            <div id="cantones">
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="canton" name="canton" onchange="distritos()">
                    @foreach($cantones as $canton)
                        @php $opcion=""; @endphp
                        @isset($resultadoEmpresa->id_canton)
                            @if($canton->id_canton == $resultadoEmpresa->id_canton)
                                @php $opcion="selected"; @endphp
                            @endif
                        @endisset
                        <option value="{{ $canton->id_canton }}" {{$opcion}}>{{ ucwords(strtolower($canton->canton))}}</option>
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
                        <option value="{{ $distrito->id_distrito }}" {{$opcion}}>{{ ucwords(strtolower($distrito->distrito ))}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Barrio') }} </label>
            <div id="barrios">
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="barrio" name="barrio">
                    @foreach($barrios as $barrio)
                        @php $opcion=""; @endphp
                        @isset($resultadoEmpresa->id_barrio)
                            @if($barrio->id_barrio == $resultadoEmpresa->id_barrio)
                                @php $opcion="selected"; @endphp
                            @endif
                        @endisset
                        <option value="{{ $barrio->id_barrio }}" {{$opcion}}>{{ ucwords(strtolower($barrio->barrio)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Dirección') }}</label>
            <textarea class="input-group form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" data-name_error="Dirección" maxlength="200" placeholder="Límite de texto 200 caracteres" id="direccion" name="direccion"> {{ old('direccion') ?? $resultadoEmpresa->direccion ??""  }}</textarea>
        </div>
    </div>
    <div class="input-group form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Cómo se enteró de nuestro sistema?')
                        }} </label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control"
                    id="medio_comunicacion" name="medio_comunicacion" data-name_error="¿Cómo se enteró de nuestro sistema?">
                <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                @foreach($medios_comerciales as $medio)
                    @if($medio->estado === 'ACTIVO' && !in_array($medio->id_medio_comercial, [16,17]))
                        <option value="{{ ucfirst(strtolower($medio->nombre))  }}" @if($resultadoEmpresa->medio_comunicacion==ucfirst(strtolower($medio->nombre))) selected @endif>{{ ucfirst(strtolower($medio->nombre)) }}</option>
                    @endif
                @endforeach
                <option value="Otro" @if($resultadoEmpresa->medio_comunicacion=='Otro') selected @endif>Otro</option>
            </select>
        </div>
    </div>
    <br>
    <h3 class="card-title text-125 text-green-m2">
        <i class="nav-icon fa fa-address-book text-green-m2"></i>
        {{ __('Teléfonos') }}
    </h3>
    <hr>
    @php
        use App\Funciones\Generales\funcionesGenerales;
		 $general = new funcionesGenerales();
            $telefono_fijo = $general->parsePhoneNumber($resultadoEmpresa->telefono_fijo);
            $telefono_celular = $general->parsePhoneNumber($resultadoEmpresa->telefono_celular);
    @endphp
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <input name="frm_codigo_pais" value="{{$telefono_fijo['code']??""}}" type="hidden" id="frm_codigo_pais">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono fijo') }}</label>
            <div class="input-group">
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" data-name_error="Teléfono fijo" id="telefonoFijo" name="telefonoFijo" value="{{ old('telefonoFijo') ?? $telefono_fijo['telefono'] ?? ""}}"/>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <input name="frm_codigo_pais2" value="{{$telefono_celular['code']??""}}" type="hidden" id="frm_codigo_pais2">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono celular') }}</label>
            <div class="input-group">
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" data-name_error="Teléfono celular" id="telefonoCelular" name="telefonoCelular" value="{{ old('telefonoCelular') ?? $telefono_celular['telefono'] ??""}}"/>
            </div>
        </div>
    </div>
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
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
                        Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Desea guardar datos generales para la empresa?
                    <br/>
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
@if(file_exists(public_path('js/scripts/admin/config_datos_generales.min.js')))
    <script src="{{ asset('js/scripts/admin/config_datos_generales.min.js') }}?t={{ filemtime(public_path('js/scripts/admin/config_datos_generales.min.js')) }}"></script>
@endif
