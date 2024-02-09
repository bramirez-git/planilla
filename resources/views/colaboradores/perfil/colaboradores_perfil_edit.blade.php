@extends('Layouts.menu')

@section('page-content')
    <!--<div class="p-3 ace-scroll" data-ace-scroll='{"height": 500, "autohide":false, "color": "grey"}'>-->
    <form class="mt-lg-3" id="frm-colaboradores"  autocomplete="off" method="POST" action="{{route('colaboradoresPerfil.update',[$idColaborador])}}">
        @csrf
        @method('PUT')
        <input type="text" name="tipoForm" value="Perfil" hidden/>
        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12 d-none">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">{{ __('Nombre del puesto') }}</label>
                <select id="idPuesto" name="idPuesto" data-placeholder="Seleccione una opción..." class="chosen-select form-control">
                  <option value="0"></option>
                    <!-- @if(count($puestos) > 0)
                        @foreach($puestos as $puesto)
                            @php $opcion=""; @endphp
                            @isset($resultado->id_puesto)
                                @if($puesto->id_puesto == $resultado->id_puesto)
                                    @php $opcion="selected"; @endphp
                                @endif
                            @endisset
                            <option value="{{ $puesto->id_puesto }}" {{$opcion}}>{{ $puesto->nombre }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected>{{ __('No hay puestos disponibles') }}</option>
                    @endif -->
                </select>
            </div>


            <div class="col-md-3 col-sm-12 d-none">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Identificación del cargo') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="identificacionCargo" name="identificacionCargo" value="NO-USO" />
            </div>
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                    {{ __('Mínimo salario') }}</label>
                <div class="input-group align-items">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="minimoSalario" name="minimoSalario" value="{{ old("identificacionCargo") ?? (isset($resultado->salario_minimo) ? $resultado->salario_minimo : "") }}"/>
                </div>
            </div>
            <div class="col-md-1 col-sm-12 mt-4">
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="text-nowrap align-self-start pl-md-2">
                        <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                            <div class="d-flex flex-row-reverse">
                                <div class="px-1">
                                    <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg h-100">
                                        <button type="button" id="filtroButton" class="btn btn-xs btn-info btn-bold brc-white-tp3 shadow-sm radius-round text-125 px-25 ml-2">?</button>
                                        <div style="width: 24rem; max-width: 90vw; z-index: 4000;" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret" id="filtroMenu">
                                            <div class="dropdown-inner">
                                                <div class="dropdown-header bgc-blue-l2 py-2 text-left position-relative border-t-1 brc-secondary-l2 mb-3">
                                                    <label for="id-form-field-focus-1" class="mb-0 ml-1"> {{ __('Consultas salarios mínimos') }}</label>
                                                </div>
                                                <div class="dropdown-body my-25 px-3">
                                                    <div class="d-flex align-items-center px-2 px-md-3 mb-3">
                                                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Seleccione aquí la ocupación:') }}</label>
                                                    </div>
                                                    <div class="d-flex align-items-center px-2 px-md-3">
                                                        <div class="input-group">
                                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="catalogoSalariosMinimos" name="catalogoSalariosMinimos">
                                                            @if(count($catalogoSalariosMinimos) > 0)
                                                                @foreach($catalogoSalariosMinimos as $datos)
                                                                    <option value="{{ $datos->salario }}" {{$opcion}}>{{ $datos->siglas." - ".$datos->ocupacion }}</option>
                                                                @endforeach
                                                            @else
                                                              <option value="" disabled selected>{{ __('Catálogo no disponible') }}</option>
                                                            @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .dropdown-inner -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Máximo salario') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="maximoSalario" name="maximoSalario" value="{{ old("identificacionCargo") ?? (isset($resultado->salario_maximo) ? $resultado->salario_maximo : "") }}"/>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Correo Electrónico Empresarial') }}</label>
                <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correoEmpresarial" name="correoEmpresarial" value="{{ old('correoEmpresarial') ?? (isset($resultado->correo_empresarial) ? $resultado->correo_empresarial : "") }}"/>
            </div>
        </div>

        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12 d-none">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Departamento') }} </label>
                <select id="idDepartamento" name="idDepartamento" data-placeholder="Seleccione una opción..." class="chosen-select form-control" >
                 <option value="0"></option>
                  <!-- @if(count($departamentos) > 0)
                    @foreach($departamentos as $departamento)
                        @if($departamento->estado=="activo")
                            @php $opcion=""; @endphp
                            @isset($resultado->id_departamento)
                                @if($departamento->id_departamento == $resultado->id_departamento)
                                    @php $opcion="selected"; @endphp
                                @endif
                            @endisset
                        <option value="{{ $departamento->id_departamento }}" {{$opcion}}>{{ $departamento->nombre }}</option>

                        @endif
                    @endforeach
                @else
                  <option value="" disabled selected>{{ __('Departamento no disponible') }}</option>
                @endif-->
                </select>
            </div>

            <div class="col-md-6 col-sm-12">
                <input name="frm_codigo_pais" value="506" type="hidden" id="frm_codigo_pais">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 "> {{ __('Teléfono') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 telefono" id="telefonoCelular" name="telefonoCelular" value="{{ old('frm_telefono') ?? isset($resultado->frm_telefono) ? $resultado->frm_telefono : ""}}"/>
                <div id="mensajeError" style="color: red;"></div>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Extensión') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="extension" name="extension" value="{{ old('extension') ?? isset($resultado->extension) ? $resultado->extension : "" }}"/>
            </div>
        </div>

        <div class="form-group row mt-4">

            <div class="col-md-6 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Objetivo del puesto') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12"  maxlength="200" placeholder="Límite de texto 200 caracteres" id="objetivoPuesto" name="objetivoPuesto" >{{ old('objetivoPuesto') ?? (isset($resultado->objetivo_puesto) ? $resultado->objetivo_puesto : "") }}</textarea>
            </div>


            <div class="col-md-6 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Funciones') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12"  maxlength="200" placeholder="Límite de texto 200 caracteres" id="funcionesPuesto" name="funcionesPuesto" >{{ old('funcionesPuesto') ?? (isset($resultado->funciones_puesto) ? $resultado->funciones_puesto : "") }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-md-6 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tareas') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12"  maxlength="200" placeholder="Límite de texto 200 caracteres" id="tareasPuesto" name="tareasPuesto" >{{ old('tareasPuesto') ?? (isset($resultado->tareas_puesto) ? $resultado->tareas_puesto : "") }}</textarea>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Habilidades y competencias') }}</label>
                <textarea class="form-control brc-on-focus brc-blue-m1 col-sm-12"  maxlength="200" placeholder="Límite de texto 200 caracteres"  id="habilidadesCompetencias" name="habilidadesCompetencias"  >{{ old('habilidadesCompetencias') ?? (isset($resultado->habilidades_competencias) ? $resultado->habilidades_competencias : "") }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-md-6 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Formación académica mínima necesaria') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12"  maxlength="200" placeholder="Límite de texto 200 caracteres" id="formacionAcademica" name="formacionAcademica" >{{ old('formacionAcademica') ?? (isset($resultado->formacion_academica) ? $resultado->formacion_academica : "") }}</textarea>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Experiencia') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12"  maxlength="200" placeholder="Límite de texto 200 caracteres" id="experiencia" name="experiencia" >{{ old('experiencia') ?? (isset($resultado->experiencia) ? $resultado->experiencia : "") }}</textarea>
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
                <button type="button" id="registrar" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Modificar
                </button>
            </div>
        </div>
    </form>
    @include('componentes.modalCargando')
@endsection
