@extends('Layouts.menu')

@section('page-content')
    @php
        $ccssINS = "active";
        $contactoEmergencia = "";
        $familiar = "";
        $vehiculos = "";
        $permisosConducir = "";
        $planilla = "";
        $bancos = "";
        $vacaciones = "";
		$historico = "";

        if(session()->has("tipoForm"))
        {
            if(session()->get("tipoForm") == "CCSS-INS")
            {
                $ccssINS = "active";
                $contactoEmergencia = "";
                $familiar = "";
                $vehiculos = "";
                $permisosConducir = "";
                $planilla = "";
                $bancos = "";
                $vacaciones = "";
				$historico = "";
            }

            if(session()->get("tipoForm") == "Contactos de Emergencia")
            {
                $ccssINS = "";
                $contactoEmergencia = "active";
                $familiar = "";
                $vehiculos = "";
                $permisosConducir = "";
                $planilla = "";
                $bancos = "";
                $vacaciones = "";
				$historico = "";
            }

            if(session()->get("tipoForm") == "Familiares")
            {
                $ccssINS = "";
                $contactoEmergencia = "";
                $familiar = "active";
                $vehiculos = "";
                $permisosConducir = "";
                $planilla = "";
                $bancos = "";
                $vacaciones = "";
				$historico = "";
            }

            if(session()->get("tipoForm") == "Vehículos")
            {
                $ccssINS = "";
                $contactoEmergencia = "";
                $familiar = "";
                $vehiculos = "active";
                $permisosConducir = "";
                $planilla = "";
                $bancos = "";
                $vacaciones = "";
				$historico = "";
            }

            if(session()->get("tipoForm") == "Permisos de conducir")
            {
                $ccssINS = "";
                $contactoEmergencia = "";
                $familiar = "";
                $vehiculos = "";
                $permisosConducir = "active";
                $planilla = "";
                $bancos = "";
                $vacaciones = "";
				$historico = "";
            }

            if(session()->get("tipoForm") == "Planilla")
            {
                $ccssINS = "";
                $contactoEmergencia = "";
                $familiar = "";
                $vehiculos = "";
                $permisosConducir = "";
                $planilla = "active";
                $bancos = "";
                $vacaciones = "";
				$historico = "";
            }

            if(session()->get("tipoForm") == "Bancos")
            {
                $ccssINS = "";
                $contactoEmergencia = "";
                $familiar = "";
                $vehiculos = "";
                $permisosConducir = "";
                $planilla = "";
                $bancos = "active";
                $vacaciones = "";
				$historico = "";
            }

            if(session()->get("tipoForm") == "vacaciones")
            {
                $ccssINS = "";
                $contactoEmergencia = "";
                $familiar = "";
                $vehiculos = "";
                $permisosConducir = "";
                $planilla = "";
                $bancos = "";
                $vacaciones = "active";
				$historico = "";
            }
			if(session()->get("tipoForm") == "historico")
            {
                $ccssINS = "";
                $contactoEmergencia = "";
                $familiar = "";
                $vehiculos = "";
                $permisosConducir = "";
                $planilla = "";
                $bancos = "";
                $vacaciones = "";
				$historico = "active";
            }
        }
    @endphp
    <div class="pb-3">
        <div class="bcard">
            <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
                <li class="nav-item mr-2px"> <a id="CCSSINS-tab" class="d-style {{$ccssINS}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#CCSSINS" role="tab" aria-controls="CCSSINS" aria-selected="true"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> CCSS-INS-TD </a> </li>
                <li class="nav-item mr-2px"> <a id="contactoEmergencia-tab" class="d-style {{$contactoEmergencia}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#contactoEmergencia" role="tab" aria-controls="contactoEmergencia" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Contacto de emergencia </a> </li>
                <li class="nav-item"> <a id="familiares-tab" class="d-style {{$familiar}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#familiares" role="tab" aria-controls="familiares" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Familiares </a> </li>
                <li class="nav-item"> <a id="vehiculos-tab" class="d-style {{$vehiculos}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#vehiculos" role="tab" aria-controls="vehiculos" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Vehículos </a> </li>
                <li class="nav-item"> <a id="permisoConducir-tab" class="d-style {{$permisosConducir}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#permisoConducir" role="tab" aria-controls="permisoConducir" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Permisos de conducir </a> </li>
                <li class="nav-item"> <a id="planilla-tab" class="d-style {{$planilla}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#planilla" role="tab" aria-controls="planilla" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Planilla </a> </li>
                <li class="nav-item"> <a id="bancos-tab" class="d-style {{$bancos}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#bancos" role="tab" aria-controls="bancos" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> M&eacute;todo Pago </a> </li>
                <li class="nav-item"> <a id="vacaciones-tab" class="d-style {{$vacaciones}} btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#vacaciones" role="tab" aria-controls="vacaciones" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Vacaciones </a> </li>
                <li class="nav-item"> <a id="historico-tab" class="d-style {{$historico}}  btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#historico" role="tab" aria-controls="historico" aria-selected="false"> <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Histórico </a> </li>
            </ul>
            <div class="tab-content bgc-white p-35 border-0">
                <div class="tab-pane fade show {{$ccssINS}} text-95" id="CCSSINS" role="tabpanel" aria-labelledby="home1-tab-btn">
                    <form class="mt-lg-3" id="form-CCSSINS" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[ $idColaborador ])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="CCSS-INS" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="La Fecha de Ingreso es la fecha que el sistema registrara como la fecha oficial de inicio de labores reconocidas a nivel de CCSS e INS."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Fecha de Ingreso') }} </label>
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-fecha-ingreso="{{ old('fechaIngreso') ?? isset($resultadoINSCCSS->fecha_ingreso) ? date("d/m/Y",strtotime($resultadoINSCCSS->
                                fecha_ingreso)) : "" }}" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaIngreso" name="fechaIngreso" value="{{ old('fechaIngreso') ?? isset($resultadoINSCCSS->fecha_ingreso) ? date("d/m/Y",strtotime($resultadoINSCCSS->
                                fecha_ingreso)) : "" }}"/> </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="La Fecha de Salida es la fecha que el sistema registrara como la fecha oficial de terminación de labores reconocidas a nivel de CCSS e INS."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Fecha de Salida') }} </label>
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaSalida" name="fechaSalida" value="{{ old('fechaSalida') ?? isset($resultadoINSCCSS->fecha_ingreso) ? ($resultadoINSCCSS->fecha_salida == "0000-00-00" ? "" : date("d/m/Y",strtotime($resultadoINSCCSS->
                                fecha_salida))) : ""  }}"/> </div>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-lg-4">
                                <div class="card bcard h-100">
                                    <div class="card-header"> <span class="card-title text-125"> CCSS </span> </div>
                                    <div class="card-body">
                                        <div>
                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de asegurado') }}</label>
                                            @php
                                                $cedulaColaborador = "";
                                                $nacional = "";
                                                $aseguradoCCSS = "";
                                                $aseguradoins = "";
                                            @endphp

                                            @isset($resultadoINSCCSS->id_tipo_seguro_ins)
                                                @if($resultadoINSCCSS->id_tipo_seguro_ins=="1")
                                                    @php
                                                        $aseguradoCCSS = $resultadoColaborador->identificacion;
                                                        $aseguradoins = $resultadoINSCCSS->numero_seguro_ins;
                                                        $nacional = "readonly";
                                                    @endphp
                                                @else
                                                    @php
                                                        $aseguradoCCSS = $resultadoINSCCSS->numero_seguro_ccss;
                                                        $aseguradoins = $resultadoINSCCSS->numero_seguro_ccss;
                                                    @endphp
                                                @endif
                                            @endisset
                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroAsegurado" name="numeroAsegurado" value="{{ old('numeroAsegurado') ?? $aseguradoCCSS ?? "" }}" {{$nacional}}/>
                                        </div>
                                        <div class="mt-3">
                                            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo seguro CCSS') }} </label>
                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoSeguroCCSS" name="tipoSeguroCCSS" >

                                                @foreach($catalogoTipoSeguroCCSS as $datos)
                                                    @php $opcion=""; @endphp
                                                    @isset($resultadoINSCCSS->id_tipo_seguro_ccss)
                                                        @if($datos->id_tipo_seguro == $resultadoINSCCSS->id_tipo_seguro_ccss)
                                                            @php $opcion="selected"; @endphp
                                                        @endif
                                                    @endisset

                                                    <option value="{{ $datos->id_tipo_seguro }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->nombre }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de ocupación CCSS') }} </label>
                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoOcupacionCCSS" name="tipoOcupacionCCSS" >

                                                @foreach($catalogoOcupacionesCCSS as $datos)
                                                    @php $opcion=""; @endphp
                                                    @isset($resultadoINSCCSS->id_ocupacion_ccss)
                                                        @if($datos->id_ocupacion == $resultadoINSCCSS->id_ocupacion_ccss)
                                                            @php $opcion="selected"; @endphp
                                                        @endif
                                                    @endisset

                                                    <option value="{{ $datos->id_ocupacion }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->nombre }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="card bcard h-100">
                                    <div class="card-header"> <span class="card-title text-125"> INS </span> </div>
                                    <div class="card-body">
                                        <div>
                                            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nacionalidad INS') }} </label>
                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="nacionalidadINS" name="nacionalidadINS" >

                                                @foreach($catalogoNacionalidades as $datos)
                                                    @php $opcion=""; @endphp
                                                    @isset($resultadoINSCCSS->id_nacionalidad_ins)
                                                        @if($datos->id_nacionalidad == $resultadoINSCCSS->id_nacionalidad_ins)
                                                            @php $opcion="selected"; @endphp
                                                        @endif
                                                    @endisset

                                                    <option value="{{ $datos->id_nacionalidad }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->nombre }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de Identificación') }} </label>
                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoAsegurado" name="tipoAsegurado" >

                                                @foreach($catalogoTipoSeguroINS as $datos)
                                                    @php $opcion=""; @endphp
                                                    @isset($resultadoINSCCSS->id_tipo_seguro_ins)
                                                        @if($datos->id_tipo_seguro == $resultadoINSCCSS->id_tipo_seguro_ins)
                                                            @php $opcion="selected"; @endphp
                                                        @endif
                                                    @endisset

                                                    <option value="{{ $datos->id_tipo_seguro }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->nombre }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número  de Asegurado Riesgos de Trabajo INS') }}</label>
                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="riesgoTrabajo" name="riesgoTrabajo" value="{{ old('riesgoTrabajo')  ?? $aseguradoins ??  ""}}" {{$nacional}}/>
                                        </div>
                                        <div class="mt-3">
                                            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de ocupación INS') }} </label>
                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoOcupacionINS" name="tipoOcupacionINS" >

                                                @foreach($catalogoOcupacionesINS as $datos)
                                                    @php $opcion=""; @endphp
                                                    @isset($resultadoINSCCSS->id_ocupacion_ins)
                                                        @if($datos->id_ocupacion == $resultadoINSCCSS->id_ocupacion_ins)
                                                            @php $opcion="selected"; @endphp
                                                        @endif
                                                    @endisset

                                                    <option value="{{ $datos->id_ocupacion }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->categoria_perfil_ocupacional }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="card bcard h-100">
                                    <div class="card-header"> <span class="card-title text-125"> Tributación directa </span> </div>
                                    <div class="card-body">
                                        <div>
                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Pendiente de entrega."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Para el contribuyente extranjero') }} </label>
                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="tributacionDirectaExtranjero" name="tributacionDirectaExtranjero"  value="{{ old('tributacionDirectaExtranjero') ?? $resultadoINSCCSS->tributacion_directa ?? ""}}"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                            <div class="md-3 col-md-9 col-sm-12 text-nowrap"> <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1"> <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i> </span> Cancelar </a>
                                <button type="button" id="registrarINSCCSS"  class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1"> <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i> </span> Guardar </button>
                            </div>
                        </div>
                        <div class="modal fade" id="confirmModalINSCCSS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body"> ¿Desea guardar datos de CCSS-INS para el colaborador? <br />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar </button>
                                        <button id="guardar-CCSSINS" type="submit" class="btn btn-primary"  > Guardar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show {{$contactoEmergencia}} text-95" id="contactoEmergencia" role="tabpanel" aria-labelledby="profile1-tab-btn">
                    <form class="mt-lg-3" id="form-contactoEmergencia" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Contactos de Emergencia" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Contacto de emergencia') }}</label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="contactoEmergencia" name="contactoEmergencia"  />
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Parentesco de emergencia') }}</label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="parentescoEmergencia" name="parentescoEmergencia" >

                                    @foreach($catalogoParentesco as $datos)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoINSCCSS->id_parentesco)
                                            @if($datos->id_parentesco == $resultadoINSCCSS->id_parentesco)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset

                                        <option value="{{ $datos->id_parentesco }}" {{$opcion}}>{{ $datos->nombre }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono de emergencia') }}</label>
                                <input type="text"  class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefonoEmergencia" name="telefonoEmergencia"  />
                            </div>
                            <div class="col-md-3 col-sm-12 align-self-end">
                                <button type="button" id="registrarContacto" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px"> <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Contacto </button>
                            </div>
                        </div>
                        @if($resultadoContactos->isEmpty())
                            <div class="alert alert-warning"> No hay contactos registrados. </div>
                        @else
                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Contacto </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Parentesco </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Teléfono </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción </th>
                                </tr>
                                </thead>
                                <tbody class="mt-1">

                                @foreach($resultadoContactos as $datos)
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td data-label="Contacto:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->nombre }} </td>
                                        <td data-label="Parentesco:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->parentesco }} </td>
                                        <td data-label="Teléfono:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->telefono }} </td>
                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->

                                            <div class='d-none d-lg-flex justify-content-center'> <a data-toggle="modal" data-target="#modalEliminarContactoEmergencia{{$datos->id_contacto}}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger"> <i class="fa fa-trash-alt"></i> </a> </div>

                                            <!-- show a dropdown in mobile -->

                                            <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'> <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown"> <i class="fa fa-cog"></i> </a>
                                                <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                                    <div class="dropdown-inner">
                                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2"> {{ __('Acción') }} </div>
                                                        <a data-toggle="modal" data-target="#modalEliminarContactoEmergencia{{$datos->id_contacto}}" class="dropdown-item"> <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }} </a> </div>
                                                </div>
                                            </div>

                                            <!----></td>
                                    </tr>
                                    <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarContactoEmergencia{{$datos->id_contacto}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                                <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel"> ¡Atención! </h5>
                                                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true" class="text-150">&times;</span> </button>
                                                </div>
                                                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                                    <div class="d-flex align-items-top mr-2 mr-md-5"> <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                                        <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el contacto del colaborador? </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bgc-white-tp2 border-0">
                                                    <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No </button>
                                                    <a href="{{ route("colaboradoresEliminarContacto",[ $idColaborador,$datos->id_contacto]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                                        Si </a> </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>

                            </table>
                        @endif
                        <div class="modal fade" id="confirmModalContactoEmergencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body"> ¿Desea guardar datos de contacto de emergencia para el colaborador? <br />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar </button>
                                        <button id="guardar-ContactoEmergencia" type="submit" class="btn btn-primary" > Guardar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show  {{$familiar}} text-95" id="familiares" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-familiares" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Familiares" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Conyugue trabaja?') }} </label>
                                @php
                                    $opcionSi="";
                                    $opcionNo="";
                                @endphp
                                @isset($resultadoConyugue)
                                    @if($resultadoConyugue->trabaja_conyuge == "si")
                                        @php $opcionSi="selected"; @endphp
                                    @elseif($resultadoConyugue->trabaja_conyuge == "no")
                                        @php $opcionNo="selected"; @endphp
                                    @endif
                                @endisset
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="conyugeDependiente" name="conyugeDependiente" >
                                    @if($opcionSi!="selected" && $opcionNo!="selected")<option value=""></option>@endif
                                    <option value="si" {{ $opcionSi }}>Si</option>
                                    <option value="no" {{ $opcionNo }}>No</option>
                                </select>
                            </div>
                        </div>
                        <h3 class="card-title text-125"> <i class="nav-icon fa fa-arrows-down-to-people"></i> {{ __('Datos de los hijos') }} </h3>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Nacimiento') }}</label>
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaNacimientoHijo" name="fechaNacimientoHijo" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Estudiante') }} </label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="hijoEstudiante" name="hijoEstudiante" >
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 align-self-end">
                                <button type="button" id="registrarFamiliar" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px"> <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Hijo </button>
                            </div>
                        </div>
                        @if($resultadoFamiliares->isEmpty())
                            <div class="alert alert-warning"> No hay familiares registrados. </div>
                        @else
                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Fecha de Nacimiento </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Estudiante </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Edad </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción </th>
                                </tr>
                                </thead>
                                <tbody class="mt-1">

                                @foreach($resultadoFamiliares as $datos)
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td data-label="Fecha de Nacimiento:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->fecha_nacimiento }} </td>
                                        <td data-label="Estudiante:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->estudiante }} </td>
                                        <td data-label="Edad:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->edad }} </td>
                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->

                                            <div class='d-none d-lg-flex justify-content-center'> <a data-toggle="modal" data-target="#modalEliminarFamiliar{{$datos->id_familiar}}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger"> <i class="fa fa-trash-alt"></i> </a> </div>

                                            <!-- show a dropdown in mobile -->

                                            <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'> <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown"> <i class="fa fa-cog"></i> </a>
                                                <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                                    <div class="dropdown-inner">
                                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2"> {{ __('Acción') }} </div>
                                                        <a data-toggle="modal" data-target="#modalEliminarFamiliar{{$datos->id_familiar}}" class="dropdown-item"> <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }} </a> </div>
                                                </div>
                                            </div>

                                            <!----></td>
                                    </tr>
                                    <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarFamiliar{{$datos->id_familiar}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                                <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel"> ¡Atención! </h5>
                                                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true" class="text-150">&times;</span> </button>
                                                </div>
                                                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                                    <div class="d-flex align-items-top mr-2 mr-md-5"> <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                                        <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el familiar del colaborador? </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bgc-white-tp2 border-0">
                                                    <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No </button>
                                                    <a href="{{ route("colaboradoresEliminarFamiliar",[ $idColaborador,$datos->id_familiar]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                                        Si </a> </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>

                            </table>
                        @endif
                        <div class="modal fade" id="confirmModalFamiliares" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body"> ¿Desea guardar datos de familiares para el colaborador? <br />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar </button>
                                        <button id="guardar-Familiar" type="submit" class="btn btn-primary" > Guardar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show {{$vehiculos}} text-95" id="vehiculos" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-Vehiculo" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Vehículos" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-2 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo Vehículo') }}</label>
                                <select data-placeholder="Seleccione..." class="chosen-select form-control" id="tipoVehiculo" name="tipoVehiculo" >

                                    @foreach($catalogoTiposVehiculos as $datos)

                                        <option value="{{ $datos->id_tipo_vehiculo }}" >{{ $datos->nombre }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Marca') }}</label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="marca" name="marca"  />
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Modelo') }}</label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="modelo" name="modelo"  />
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Color') }}</label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="color" name="color"  />
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Placa') }}</label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="placa" name="placa"  />
                            </div>
                            <div class="text-nowrap col-md-1 col-sm-12 align-self-end pt-3">
                                <button type="button" id="registrarVehiculo" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px"> <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Vehículo </button>
                            </div>
                        </div>
                        @if($resultadoVehiculos->isEmpty())
                            <div class="alert alert-warning"> No hay vehiculos registrados. </div>
                        @else
                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Tipo Vehículo </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Marca </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Modelo </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Color </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Placa </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción </th>
                                </tr>
                                </thead>
                                <tbody class="mt-1">

                                @foreach($resultadoVehiculos as $datos)
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td data-label="Tipo Vehículo:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->tipo_vehiculo }} </td>
                                        <td data-label="Marca:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->marca }} </td>
                                        <td data-label="Modelo:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->modelo }} </td>
                                        <td data-label="Color:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->color }} </td>
                                        <td data-label="Placa:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->placa }} </td>
                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->

                                            <div class='d-none d-lg-flex justify-content-center'> <a data-toggle="modal" data-target="#modalEliminarVehiculos{{$datos->id_vehiculo}}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger"> <i class="fa fa-trash-alt"></i> </a> </div>

                                            <!-- show a dropdown in mobile -->

                                            <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'> <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown"> <i class="fa fa-cog"></i> </a>
                                                <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                                    <div class="dropdown-inner">
                                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2"> {{ __('Acción') }} </div>
                                                        <a data-toggle="modal" data-target="#modalEliminarVehiculos{{$datos->id_vehiculo}}" class="dropdown-item"> <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }} </a> </div>
                                                </div>
                                            </div>

                                            <!----></td>
                                    </tr>
                                    <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarVehiculos{{$datos->id_vehiculo}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                                <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel"> ¡Atención! </h5>
                                                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true" class="text-150">&times;</span> </button>
                                                </div>
                                                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                                    <div class="d-flex align-items-top mr-2 mr-md-5"> <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                                        <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el vehiculo del colaborador? </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bgc-white-tp2 border-0">
                                                    <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No </button>
                                                    <a href="{{ route("colaboradoresEliminarVehiculo",[ $idColaborador,$datos->id_vehiculo]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                                        Si </a> </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>

                            </table>
                        @endif
                        <div class="modal fade " id="confirmModalVehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body"> ¿Desea guardar datos de vehículos para el colaborador? <br />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar </button>
                                        <button id="guardar-Vehiculo" type="submit" class="btn btn-primary" > Guardar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show {{$permisosConducir}} text-95" id="permisoConducir" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-PermisoConducir" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Permisos de conducir" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de Licencia') }}</label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoLicencia" name="tipoLicencia" >

                                    @foreach($catalogoTipoLicencia as $datos)

                                        <option value="{{ $datos->id_licencia_conducir }}" >{{ $datos->licencia_conducir }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de licencia') }}</label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroLicencia" name="numeroLicencia"  />
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Fecha de Vencimiento</label>
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaVencimiento" name="fechaVencimiento" >
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 align-self-end">
                                <button type="button" id="registrarPermisoConducir" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px"> <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Permiso </button>
                            </div>
                        </div>
                        @if($resultadoLicencias->isEmpty())
                            <div class="alert alert-warning"> No hay permisos de conducir registrados. </div>
                        @else
                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Tipo de licencia </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Número de licencia </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Fecha de Vencimiento </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción </th>
                                </tr>
                                </thead>
                                <tbody class="mt-1">

                                @foreach($resultadoLicencias as $datos)
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td data-label="Tipo de licencia:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->licencia_conducir }} </td>
                                        <td data-label="Número de licencia:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->numero_licencia }} </td>
                                        <td data-label="Fecha de Vencimiento:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->fecha_vencimiento }} </td>
                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->

                                            <div class='d-none d-lg-flex justify-content-center'> <a data-toggle="modal" data-target="#modalEliminarPermisoConducir{{$datos->id_licencia_conducir}}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger"> <i class="fa fa-trash-alt"></i> </a> </div>

                                            <!-- show a dropdown in mobile -->

                                            <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'> <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown"> <i class="fa fa-cog"></i> </a>
                                                <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                                    <div class="dropdown-inner">
                                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2"> {{ __('Acción') }} </div>
                                                        <a data-toggle="modal" data-target="#modalEliminarPermisoConducir{{$datos->id_licencia_conducir}}" class="dropdown-item"> <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }} </a> </div>
                                                </div>
                                            </div>

                                            <!----></td>
                                    </tr>
                                    <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarPermisoConducir{{$datos->id_licencia_conducir}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                                <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel"> ¡Atención! </h5>
                                                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true" class="text-150">&times;</span> </button>
                                                </div>
                                                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                                    <div class="d-flex align-items-top mr-2 mr-md-5"> <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                                        <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el permiso de conducir del colaborador? </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bgc-white-tp2 border-0">
                                                    <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No </button>
                                                    <a href="{{ route("colaboradoresEliminarPermisoConducir",[ $idColaborador,$datos->id_licencia_conducir]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                                        Si </a> </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>

                            </table>
                        @endif
                        <div class="modal fade" id="confirmModalPermisoConducir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body"> ¿Desea guardar datos de permiso de conducir para el colaborador? <br />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar </button>
                                        <button id="guardar-PermisoConducir" type="submit" class="btn btn-primary" > Guardar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-collapse bgc-white text-dark-tp3 border-none border-t-4 shadow-sm brc-primary radius-0 py-3 d-flex align-items-start mt-4">
                        <div class="bgc-primary px-4 py-25 radius-1px mr-4 shadow-sm"> <i class="fa fa-exclamation text-180 text-white"></i> </div>
                        <div class="text-dark-tp3">
                            <h3 class="text-blue-d1 text-130">Importante!</h3>
                            Según lo dispuesto en el artículo 68 de la Ley de Tránsito por Vías Públicas
                            Terrestres, todo aspirante podrá solicitar que se le realice un examen práctico
                            de manejo, para la obtención de cualquiera de los siguientes tipos de licencia: </div>
                    </div>
                    <div class="accordion mt-4" id="accordionExample5">
                        <div class="card border-0 radius-0">
                            <div class="card-header border-0 bgc-transparent mb-0" id="licenciasA">
                                <h2 class="card-title bgc-info-d3 text-white brc-black-tp7"> <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_A" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5"> <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i> <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase A: </a> </h2>
                            </div>
                            <div id="licencias_A" class="collapse" aria-labelledby="licenciasA" data-parent="#accordionExample5">
                                <div class="card-body p-0">

                                    <!-- sub group -->
                                    <div class="card bcard h-auto">
                                        <div class="card-body p-0 bgc-white">
                                            <div class="accordion" id="licenciaA">
                                                <div class="card border-0">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA1">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaA_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-1: </a> </h2>
                                                    </div>
                                                    <div id="licenciaA_1" class="collapse" aria-labelledby="licenciaA1" data-parent="#licenciaA">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir bicimotos de 50 a 90 cc. Aspirante mayor de trece años. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA2">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaA_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-2: </a> </h2>
                                                    </div>
                                                    <div id="licenciaA_2" class="collapse" aria-labelledby="licenciaA2" data-parent="#licenciaA">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir motocicletas de 91 a 125 cc. Aspirante mayor de quince años. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA3">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaA_3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-3: </a> </h2>
                                                    </div>
                                                    <div id="licenciaA_3" class="collapse" aria-labelledby="licenciaA3" data-parent="#licenciaA">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir motocicletas de 126 a 500 cc. No requiere de condiciones adicionales. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA4">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaA_4" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-4: </a> </h2>
                                                    </div>
                                                    <div id="licenciaA_4" class="collapse" aria-labelledby="licenciaA4" data-parent="#licenciaA">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir motocicletas de 501 cc. O más. No requiere de condiciones adicionales. </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 radius-0">
                            <div class="card-header border-0 bgc-transparent mb-0" id="licenciasB">
                                <h2 class="card-title bgc-info-d3 text-white brc-black-tp7"> <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_B" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5"> <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i> <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase B: </a> </h2>
                            </div>
                            <div id="licencias_B" class="collapse" aria-labelledby="licenciasB" data-parent="#accordionExample5">
                                <div class="card-body p-0">

                                    <!-- sub group -->
                                    <div class="card bcard h-auto">
                                        <div class="card-body p-0 bgc-white">
                                            <div class="accordion" id="licenciaB">
                                                <div class="card border-0">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB1">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaB_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-1: </a> </h2>
                                                    </div>
                                                    <div id="licenciaB_1" class="collapse" aria-labelledby="licenciaB1" data-parent="#licenciaB">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir solo vehículos livianos de un cuarto a una y media toneladas de carga útil. No requiere de condiciones adicionales. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB2">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaB_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-2: </a> </h2>
                                                    </div>
                                                    <div id="licenciaB_2" class="collapse" aria-labelledby="licenciaB2" data-parent="#licenciaB">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir vehículos de todo peso hasta de cinco toneladas de carga útil. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB3">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaB_3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-3: </a> </h2>
                                                    </div>
                                                    <div id="licenciaB_3" class="collapse" aria-labelledby="licenciaB3" data-parent="#licenciaB">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir vehículos de todo peso, incluso los mayores de cinco toneladas de carga útil, excepto los vehículos pesados articulados. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB4">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaB_4" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-4: </a> </h2>
                                                    </div>
                                                    <div id="licenciaB_4" class="collapse" aria-labelledby="licenciaB4" data-parent="#licenciaB">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir vehículos de todo peso, incluso los articulados. </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 radius-0">
                            <div class="card-header border-0 bgc-transparent mb-0" id="licenciasC">
                                <h2 class="card-title bgc-info-d3 text-white brc-black-tp7"> <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_C" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5"> <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i> <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase C: </a> </h2>
                            </div>
                            <div id="licencias_C" class="collapse" aria-labelledby="licenciasC" data-parent="#accordionExample5">
                                <div class="card-body p-0">

                                    <!-- sub group -->
                                    <div class="card bcard h-auto">
                                        <div class="card-body p-0 bgc-white">
                                            <div class="accordion" id="licenciaC">
                                                <div class="card border-0">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaC1">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaC_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo C-1: </a> </h2>
                                                    </div>
                                                    <div id="licenciaC_1" class="collapse" aria-labelledby="licenciaC1" data-parent="#licenciaC">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir solo los vehículos de la modalidad taxi. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaC2">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaC_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo C-2: </a> </h2>
                                                    </div>
                                                    <div id="licenciaC_2" class="collapse" aria-labelledby="licenciaC2" data-parent="#licenciaC">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir solo los vehículos de transporte de personas de la modalidad autobús. <br>
                                                            El aspirante debe tener cinco años de experiencia en el manejo de los vehículos que autoriza conducir las licencias de la Clase B. </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 radius-0">
                            <div class="card-header border-0 bgc-transparent mb-0" id="licenciasD">
                                <h2 class="card-title bgc-info-d3 text-white brc-black-tp7"> <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_D" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5"> <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i> <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase D: </a> </h2>
                            </div>
                            <div id="licencias_D" class="collapse" aria-labelledby="licenciasD" data-parent="#accordionExample5">
                                <div class="card-body p-0">

                                    <!-- sub group -->
                                    <div class="card bcard h-auto">
                                        <div class="card-body p-0 bgc-white">
                                            <div class="accordion" id="licenciaD">
                                                <div class="card border-0">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaD1">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaD_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo D-1: </a> </h2>
                                                    </div>
                                                    <div id="licenciaD_1" class="collapse" aria-labelledby="licenciaD1" data-parent="#licenciaD">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir solamente tractores de llantas. Aspirante mayor de dieciséis años. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaD2">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaD_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo D-2: </a> </h2>
                                                    </div>
                                                    <div id="licenciaD_2" class="collapse" aria-labelledby="licenciaD2" data-parent="#licenciaD">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir sólo tractores de oruga. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaD3">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaD_3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo D-3: </a> </h2>
                                                    </div>
                                                    <div id="licenciaD_3" class="collapse" aria-labelledby="licenciaD3" data-parent="#licenciaD">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Permite conducir otros tipos de maquinaria. </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 radius-0">
                            <div class="card-header border-0 bgc-transparent mb-0" id="licenciasE">
                                <h2 class="card-title bgc-info-d3 text-white brc-black-tp7"> <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_E" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5"> <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i> <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase E: </a> </h2>
                            </div>
                            <div id="licencias_E" class="collapse" aria-labelledby="licenciasE" data-parent="#accordionExample5">
                                <div class="card-body p-0">

                                    <!-- sub group -->
                                    <div class="card bcard h-auto">
                                        <div class="card-body p-0 bgc-white">
                                            <div class="accordion" id="licenciaE">
                                                <div class="card border-0">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaE1">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaE_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo E-1: </a> </h2>
                                                    </div>
                                                    <div id="licenciaE_1" class="collapse" aria-labelledby="licenciaE1" data-parent="#licenciaE">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir los vehículos comprendidos dentro las clases de dos, tres, cuatro o más ejes; excepto los destinados al transporte público. <br>
                                                            <br>
                                                            Requisitos del conductor: Tener un año de experiencia, como mínimo, en el manejo de los vehículos que autorizan conducir las licencias tipos A-4 y B-4 y haber obtenido el Certificado del Curso Básico de Educación Vial para equipo especial. </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mt-1px">
                                                    <div class="card-header border-0 bgc-transparent mb-0" id="licenciaE2">
                                                        <h2 class="card-title text-info-d2"> <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaE_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50"> <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo E-2: </a> </h2>
                                                    </div>
                                                    <div id="licenciaE_2" class="collapse" aria-labelledby="licenciaE2" data-parent="#licenciaE">
                                                        <div class="card-body pl-5 pt-1 ml-2 text-justify"> Faculta para manejar tractores de llanta, de oruga y toda clase de vehículos de dos, tres,
                                                            cuatro o más ejes, así como la maquinaria que se autoriza mediante la licencia del tipo D-3.
                                                            Requisitos del conductor: Haber obtenido el Certificado del Curso Básico de Educación Vial
                                                            para conducir tractores de llanta y de oruga, así como el de equipo especial y tener un año
                                                            de experiencia en el manejo de los vehículos que autorizan a conducir las licencias tipos
                                                            A-4 y B-4. </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="mt-lg-3" id="form-Planilla-config" autocomplete="off" method="PUT" action="{{ route('administracionEmpresa.edit', [Crypt::encrypt(session()->get("id_cliente"))]) }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="tipoForm" value="Ocupaciones" hidden/>
                </form>
                <div class="tab-pane fade show {{$planilla}} text-95" id="planilla" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" id="form-Planilla" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Planilla" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Puesto de la empresa') }} </label>
                                <select id="puestoEmpresa" name="puestoEmpresa" data-placeholder="Seleccione una opción..." class="chosen-select form-control">
                                    @foreach($catalogoPuestos as $datos)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoPlanillas->id_puesto)
                                            @if($datos->id_puesto == $resultadoPlanillas->id_puesto)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset

                                        <option value="{{ $datos->id_puesto }}" {{$opcion}}>{{ $datos->nombre }}</option>

                                    @endforeach
                                </select>
                                <a href="#" id="configurar-link">Configurar</a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Perfil ocupacional') }}</label>
                                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="perfilOcupacional" name="perfilOcupacional" value="{{ old('perfilOcupacional') ?? $resultadoPlanillas->perfil_ocupacional ?? ""}}"/>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="El departamento se puede cambiar en esta sección y/o en la edición de datos del colaborador."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Departamento') }}
                                </label>
                                <select id="idDepartamento" name="idDepartamento" data-placeholder="Seleccione una opción..." class="chosen-select form-control">
                                    @foreach($catalogoDepartamentos as $datos)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoPlanillas->id_departamento)
                                            @if($datos->id_departamento == $resultadoPlanillas->id_departamento)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset

                                        <option value="{{ $datos->id_departamento }}" {{$opcion}}>{{ $datos->nombre }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Jornada de trabajo') }} </label>
                                <select id="jornadaTrabajo" name="jornadaTrabajo" data-placeholder="Seleccione un colaborador..." class="chosen-select form-control">
                                    @foreach($catalogoJornada as $datos)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoPlanillas->id_jornada_trabajo)
                                            @if($datos->id_jornada_trabajo == $resultadoPlanillas->id_jornada_trabajo)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset

                                        <option value="{{ $datos->id_jornada_trabajo }}" {{$opcion}}>{{ $datos->nombre }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de planilla') }}</label>
                                <div>
                                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" name="tipoPlanilla">
                                        @php
                                            $opcion = "";
                                        @endphp
                                        @foreach($catalogoTipoPlanilla as $datos)
                                            @php
                                                $opcion = "";
                                            @endphp
                                            @isset($resultadoPlanillas->id_tipo_planilla)
                                                @if($datos->id_tipo_planilla == $resultadoPlanillas->id_tipo_planilla)
                                                    @php
                                                        $opcion = "selected";
                                                    @endphp
                                                @endif
                                            @endisset

                                            <option value="{{ $datos->id_tipo_planilla }}" {{$opcion}}>{{ $datos->nombre }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }} </label>
                                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="moneda" name="moneda">
                                    @foreach($catalogoMonedas as $datos)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoPlanillas->id_moneda)
                                            @if($datos->id_moneda == $resultadoPlanillas->id_moneda)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset

                                        <option value="{{ $datos->id_moneda }}" {{$opcion}}>{{ $datos->leyenda }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Pendiente de definir."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Salario base') }}
                                </label>
                                <input type="text" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="salarioBase" name="salarioBase" value="{{ old('salarioBase') ?? $resultadoPlanillas->salario_base ?? ""}}"/>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de jornada') }} </label>
                                <select id="tipoTrabajo" name="tipoTrabajo" data-placeholder="Seleccione una opción..." class="chosen-select form-control">
                                    @foreach($catalogoTipoTrabajo as $datos)
                                        @php $opcion=""; @endphp
                                        @isset($resultadoPlanillas->id_tipo_trabajo)
                                            @if($datos->id_tipo_trabajo == $resultadoPlanillas->id_tipo_trabajo)
                                                @php $opcion="selected"; @endphp
                                            @endif
                                        @endisset

                                        <option value="{{ $datos->id_tipo_trabajo }}" {{$opcion}}>{{ $datos->nombre }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-3 col-sm-12">
                                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Es jefatura?') }} </label>
                                <br>
                                @php
                                    $opcion="";
                                @endphp
                                @if(isset($resultadoPlanillas->jefe))
                                    @if($resultadoPlanillas->jefe==1)
                                        @php
                                            $opcion="checked";
                                        @endphp
                                    @endif
                                @endif
                                <input type="checkbox" name="jefatura" class="ace-switch input-lg ace-switch-bars-h ace-switch-check ace-switch-times text-grey-l2 bgc-orange-d2 radius-2px" {{$opcion}}/>
                            </div>
                        </div>
                        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i> </span> Cancelar
                                </a>
                                <button type="button" id="registrarPlanilla" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i> </span> Guardar
                                </button>
                            </div>
                        </div>
                        <div class="modal fade" id="confirmModalPlanilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"> ¿Desea guardar datos de planilla para el colaborador?
                                        <br/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                                        <button type="submit" id="guardar-Planilla" class="btn btn-primary"> Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show {{$bancos}} text-95" id="bancos" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <input type="hidden" id="tipoPago" name="tipoPago" value=""/>

                    @if($resultadoBancos->isEmpty())
                        <!-- DEPOSITO -->
                        <form class="mt-lg-3" id="formDeposito" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                            @csrf
                            @method('PUT')
                            <input type="text" name="tipoForm" value="Bancos" hidden/>
                            <input type="text" name="modoPago" value="deposito" hidden/>

                            <div class="card">
                                <div class="card-header bgc-grey-l4">
                                    <div class="text-left">
                                        <input type="checkbox" id="chk_deposito" name="chk_deposito" class="bgc-primary" value="deposito" onchange="cambiarTipoPago('deposito');"> Dep&oacute;sito Bancario
                                    </div>
                                </div>
                                <div id="div_deposito" class="card-body" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-md-3 col-sm-12">
                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Banco') }}</label>
                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="banco" name="banco">
                                                @foreach($catalogoBancos as $datos)
                                                    <option value="{{ $datos->id_banco }}">{{ $datos->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }}</label>
                                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="moneda" name="moneda">
                                                @foreach($catalogoMonedas as $datos)
                                                    <option value="{{ $datos->id_moneda }}">{{ $datos->leyenda }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <label class="mb-0 text-blue-m1"> Cuenta IBAN </label>
                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cuentaIban" name="cuentaIban"/>
                                        </div>
                                        <div class="col-md-3 col-sm-12 align-self-end">
                                            <button type="button" id="registrarDeposito" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Registrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- SINPE MOVIL -->
                        <form class="mt-lg-3" id="formSinpeMovil" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                            @csrf
                            @method('PUT')
                            <input type="text" name="tipoForm" value="Bancos" hidden/>
                            <input type="text" name="modoPago" value="sinpe_movil" hidden/>

                            <div class="card mt-3">
                                <div class="card-header bgc-grey-l4">
                                    <div class="text-left">
                                        <input type="checkbox" id="chk_sinpe_movil" name="chk_sinpe_movil" class="bgc-primary" value="sinpe_movil" onchange="cambiarTipoPago('sinpe_movil');"> SINPE M&oacute;vil
                                    </div>
                                </div>
                                <div id="div_sinpe_movil" class="card-body" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-md-3 col-sm-12">
                                            <label class="mb-0 text-blue-m1"> N&uacute;mero Telef&oacute;nico </label>
                                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefonoSinpe" name="telefonoSinpe" value="{{ str_replace("-", "", $resultadoColaborador->telefono_celular) }}"/>
                                        </div>
                                        <div class="col-md-3 col-sm-12 align-self-end">
                                            <button type="button" id="registrarSinpeMovil" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Registrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- CHEQUE -->
                        <form class="mt-lg-3" id="formCheque" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
                            @csrf
                            @method('PUT')
                            <input type="text" name="tipoForm" value="Bancos" hidden/>
                            <input type="text" name="modoPago" value="cheque" hidden/>

                            <div class="card mt-3">
                                <div class="card-header bgc-grey-l4">
                                    <div class="text-left">
                                        <input type="checkbox" id="chk_cheque" name="chk_cheque" class="bgc-primary" value="cheque" onchange="cambiarTipoPago('cheque');"> Cheque
                                    </div>
                                </div>
                                <div id="div_cheque" class="card-body" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-md-9 col-sm-12">
                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                                                Un cheque es una orden de pago librada contra un banco que permite a la persona que lo recibe
                                                cobrar una cierta cantidad de dinero que está estipulada en el documento y que debe estar
                                                disponible en la cuenta bancaria de qui&eacute;n lo expide.
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-12 align-self-end">
                                            <button type="button" id="registrarCheque" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Registrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="alert alert-warning mt-4"> No hay m&eacute;todos de pago registrados.</div>
                    @else
                        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                            @foreach($resultadoBancos as $datos)
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> M&eacute;todo Pago</th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        @php
                                            if(($datos->tipo_pago == "deposito") || ($datos->tipo_pago == "sinpe_movil")){
                                                echo "Moneda";
                                            }
                                        @endphp
                                    </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                                        @php
                                            if($datos->tipo_pago == "deposito"){
                                                echo "Cuenta Planilla";
                                            }
                                            if($datos->tipo_pago == "sinpe_movil"){
                                                echo "Número Teléfono";
                                            }
                                        @endphp
                                    </th>
                                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción</th>
                                </tr>
                                </thead>
                                <tbody class="mt-1">
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td data-label="Banco:" class='text-grey-d1 text-right text-md-center small'>
                                            @php
                                                if($datos->tipo_pago == "deposito"){
                                                    echo sprintf("DEP&Oacute;SITO - %s", $datos->banco);
                                                }
                                                if($datos->tipo_pago == "sinpe_movil"){
                                                    echo "SINPE M&Oacute;VIL";
                                                }
                                                if($datos->tipo_pago == "cheque"){
                                                    echo "CHEQUE";
                                                }
                                            @endphp
                                        </td>
                                        <td data-label="Moneda:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->moneda_leyenda }} </td>
                                        <td data-label="Cuenta Planilla:" class='text-grey-d1 text-right text-md-center small'>
                                            @php
                                                if($datos->tipo_pago == "deposito"){
                                                    echo $datos->cuenta;
                                                }
                                                if($datos->tipo_pago == "sinpe_movil"){
                                                    echo $datos->telefono_sinpe;
                                                }
                                            @endphp
                                        </td>
                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->
                                            <div class='d-none d-lg-flex justify-content-center'>
                                                <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id_colaborador_banco}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2"> {{ __('Acción') }} </div>
                                                        <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id_colaborador_banco}}" class="dropdown-item">
                                                            <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!---->
                                        </td>
                                    </tr>
                                    <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarBanco{{$datos->id_colaborador_banco}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                                <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel"> ¡Atención! </h5>
                                                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" class="text-150">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                                    <div class="d-flex align-items-top mr-2 mr-md-5">
                                                        <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                                        <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el banco colaborador?</div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bgc-white-tp2 border-0">
                                                    <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No</button>
                                                    <a href="{{ route("colaboradoresEliminarBanco",[ $idColaborador,$datos->id_colaborador_banco]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                                        Si </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            @endforeach
                        </table>
                    @endif

                    <div class="modal fade" id="confirmModalTipoPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> ¿Desea guardar datos de tipo de pago del colaborador?
                                    <br/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                                    <button id="guardarTipoPago" type="submit" class="btn btn-primary"> Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show {{$vacaciones}} text-95" id="vacaciones" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',['1'])}}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="vacaciones" hidden/>
                        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                            <tr>
                                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Rango de años</th>
                                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Factor</th>
                                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Descripción</th>
                            </tr>
                            </thead>
                            <tbody class="mt-1">
                            <tr class="bgc-h-blue-l4 d-style">
                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango1" name="rango1" value="0-5"/>
                                </td>
                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor1" name="factor1" value="0.833"/>
                                </td>
                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 0.833) = 10 días.</td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango2" name="rango2" value="5-10"/>
                                </td>
                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor2" name="factor2" value="1"/>
                                </td>
                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1) = 12 días.</td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango3" name="rango3" value="10-15"/>
                                </td>
                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor3" name="factor3" value="1.2"/>
                                </td>
                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1.2) = 15 días.</td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango4" name="rango4" value="15-60"/>
                                </td>
                                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor4" name="factor4" value="2"/>
                                </td>
                                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 2) = 24 días.</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i> </span> Cancelar
                                </a>
                                <button type="button" data-toggle="modal" data-target="#confirmModalVacaciones" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i> </span> Guardar
                                </button>
                            </div>
                        </div>
                        <div class="modal fade" id="confirmModalVacaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"> ¿Desea guardar datos de vacaciones del colaborador?
                                        <br/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                                        <button type="submit" class="btn btn-primary"> Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{--Tab historico aguinaldos--}}
                <form action="{{ route('colaboradoresConfiguracion.edit',[Crypt::encrypt($idColaborador)]) }}" id="frm-link-date-ingreso"></form>
                <div class="tab-pane fade show {{$historico}} text-95" id="historico" role="tabpanel" aria-labelledby="more1-tab-btn">
                    <div class="card-body">
                        <form class="mt-lg-3 frm-historico" id="frm-historico-aguinaldo" autocomplete="off" method="POST" action="{{route('colaboradoresEditarHistorico')}}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id_colaborador" value="{{$idColaborador}}"/>
                            <input type="hidden" name="tipo" value="aguinaldo"/>
                            <input type="hidden" name="auxiliares" id="auxiliares" value="{{ htmlspecialchars(json_encode($resultadoHistorico['auxiliares']), ENT_QUOTES, 'UTF-8') }}"/>
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-secondary bgc-secondary-l4 brc-secondary-l2 text-dark-tp2" role="alert">
                                            <h5 class="alert-heading text-primary-d1 font-bolder"> Aguinaldo </h5>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit unde officiis fuga
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3" id="contenedorMeses"></div>
                            </div>
                        </form>
                        @if(empty($resultadoINSCCSS->fecha_ingreso))
                            <div class="alert alert-warning mb-45">
                                No se encuentran registros de la fecha de ingreso del colaborador.
                                <a href="#" class="link-registro-fecha-ingreso">
                                    ir a registrar
                                </a>
                            </div>
                        @else
                            <div class="d-flex flex-column flex-md-row justify-content-between">
                                <div class="text-nowrap align-self-start mb-sm-0 pb-4"></div>
                                <div class="text-nowrap align-self-start pl-md-2">
                                    <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                                        <div class="d-flex flex-row-reverse">
                                            <div class="px-1">
                                                <button id="btn-historico" class="btn btn-outline-green btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                              <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                                            </span>
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form class="mt-lg-3 frm-historico" id="frm-historico-renta" autocomplete="off" method="POST" action="{{route('colaboradoresEditarHistorico')}}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id_colaborador" value="{{$idColaborador}}"/>
                            <input type="hidden" name="tipo" value="renta"/>
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-secondary bgc-secondary-l4 brc-secondary-l2 text-dark-tp2" role="alert">
                                            <h5 class="alert-heading text-primary-d1 font-bolder"> Renta </h5>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit unde officiis fuga
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3" id="contenedor_renta"></div>
                            </div>
                        </form>
                        @if(empty($resultadoINSCCSS->fecha_ingreso))
                            <div class="alert alert-warning mb-45">
                                No se encuentran registros de la fecha de ingreso del colaborador.
                                <a href="#" class="link-registro-fecha-ingreso">
                                    ir a registrar
                                </a>
                            </div>
                        @else
                            <div class="d-flex flex-column flex-md-row justify-content-between">
                                <div class="text-nowrap align-self-start mb-sm-0 pb-4"></div>
                                <div class="text-nowrap align-self-start pl-md-2">
                                    <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                                        <div class="d-flex flex-row-reverse">
                                            <div class="px-1">
                                                <a id="btn-h-renta" class="btn btn-outline-green btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                              <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                                            </span>
                                                    Guardar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form class="mt-lg-3" id="frm-historico-vaciones" autocomplete="off" method="POST" action="{{route('colaboradoresEditarHistoricoVacaciones')}}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id_colaborador" value="{{$idColaborador}}"/>
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-secondary bgc-secondary-l4 brc-secondary-l2 text-dark-tp2" role="alert">
                                            <h5 class="alert-heading text-primary-d1 font-bolder"> Vacaciones </h5>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit unde officiis fuga
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                                        <label for="identificacion" class="mb-0 text-blue-m1"> Cantidad de días de vacaciones
                                            <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Dias"> <i class="fa-solid fa-circle-info blue"></i> </span>
                                        </label>
                                        <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="" name="vacaciones" value="{{$resultadoHistorico['vacaciones']??""}}" required="true">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="text-nowrap align-self-start mb-sm-0 pb-4"></div>
                            <div class="text-nowrap align-self-start pl-md-2">
                                <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                                    <div class="d-flex flex-row-reverse">
                                        <div class="px-1">
                                            <a id="btn-h-vacaciones" class="btn btn-outline-green btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                              <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                                            </span>
                                                Guardar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       {{--end tab historico aguinaldos--}}
            </div>
        </div>

    </div>
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Obtener la fecha dada (en este caso, 2023-09-13)
            var data_fecha_ingreso=$("#fechaIngreso").attr("data-fecha-ingreso");
            var fechaDada=new Date(data_fecha_ingreso);
            // Obtener el año actual
            var añoActual=new Date().getFullYear();
            // Obtener la fecha actual
            var fechaActual=new Date();
            // Calcular la diferencia en milisegundos entre las dos fechas
            var diferenciaEnMilisegundos=fechaDada-fechaActual;
            // Convertir la diferencia de milisegundos a meses
            var milisegundosEnUnMes=1000*60*60*24*30.44; // aproximadamente 30.44 días en un mes
            var diferenciaEnMeses=diferenciaEnMilisegundos/milisegundosEnUnMes;
            // Redondear la diferencia en meses si es necesario
            var diferenciaRedondeada=Math.round(diferenciaEnMeses);
            diferenciaRedondeada=Math.abs(diferenciaRedondeada);
            if(diferenciaRedondeada>=12){
                data_fecha_ingreso=new Date(añoActual, 0, 01);
            }
            // Crear una nueva fecha con el 31 de diciembre del año actual
            var fecha=new Date(añoActual, 11, 31); // El mes en JavaScript es indexado desde 0, por lo tanto, 11 representa diciembre
            // Formatear la fecha si es necesario
            var formatoFecha=fecha.getFullYear()+'-'+(fecha.getMonth()+1).toString().padStart(2, '0')+'-'+fecha.getDate().toString().padStart(2, '0');
            var fechaActual=new Date(formatoFecha);
            // Definir la fecha de inicio
            var fechaInicio=new Date(data_fecha_ingreso); // Cambia '2023-01-01' a tu fecha de inicio estática
            // Crear un array para almacenar los nombres de los meses
            var meses=[];
            // Iterar desde la fecha de inicio hasta la fecha actual y agregar los nombres de los meses al array
            for(var d=fechaInicio; d<=fechaActual; d.setMonth(d.getMonth()+1)){
                var mes=d.toLocaleDateString('es-ES', {month: 'long'});
                meses.push(mes);
            }
            // Obtener el contenedor donde se agregarán los meses
            var contenedor=$("#contenedorMeses");
            var contenedor_renta=$("#contenedor_renta");
            // Limpiar el contenedor antes de agregar nuevos meses
            contenedor.empty();
            contenedor_renta.empty();
            if(diferenciaRedondeada>=12){
                var mesCapitalizado = mes.charAt(0).toUpperCase() + mes.slice(1);
                var nuevoBloque=`
          <input type="hidden" name="historico_aguinaldo[-1][anio]" value="${añoActual-1}"/>
          <input type="hidden" name="historico_aguinaldo[-1][mes]" value="${mes}"/>
         <div class="col-md-6 col-sm-12 text-md-left mt-2">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> ${mesCapitalizado} ${añoActual-1}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" data-aguinaldo-mes="${mes}_${añoActual-1}_aguinaldo" id="${mes}_${añoActual-1}_aguinaldo" name="historico_aguinaldo[-1][monto]">
                </div>
            </div>`;
                // Agregar el nuevo bloque al contenedor
                contenedor.append(nuevoBloque);
            }
            meses.forEach(function(mes, index){
                var mesCapitalizado = mes.charAt(0).toUpperCase() + mes.slice(1);
                var nuevoBloque=`
          <input type="hidden" name="historico_aguinaldo[${index}][anio]" value="${añoActual}"/>
          <input type="hidden" name="historico_aguinaldo[${index}][mes]" value="${mes}"/>
         <div class="col-md-6 col-sm-12 text-md-left mt-2">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> ${mesCapitalizado} ${añoActual}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" data-aguinaldo-mes="${mes}_${añoActual}_aguinaldo" id="${mes}_${añoActual}_aguinaldo" name="historico_aguinaldo[${index}][monto]">
                </div>
            </div>`;
                var nuevoBloqueRenta=`
          <input type="hidden" name="historico_aguinaldo[${index}][anio]" value="${añoActual}"/>
          <input type="hidden" name="historico_aguinaldo[${index}][mes]" value="${mes}"/>
         <div class="col-md-6 col-sm-12 text-md-left mt-2">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> ${mesCapitalizado} ${añoActual}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" data-renta-mes="${mes}_${añoActual}_renta" id="${mes}_${añoActual}_renta" name="historico_aguinaldo[${index}][monto]">
                </div>
            </div>`;
                // Agregar el nuevo bloque al contenedor
                contenedor.append(nuevoBloque);
                contenedor_renta.append(nuevoBloqueRenta);
                // Si hemos alcanzado 6 elementos en la columna de la izquierda, empezamos a llenar la columna de la derecha
            });
            $('#frm-historico-aguinaldo input[name="anio"]').val(añoActual);
            var jsonAuxiliares = decodeEntities($('#frm-historico-aguinaldo input#auxiliares').val());
            var auxiliares = JSON.parse(jsonAuxiliares);
            // Obtén los IDs de los elementos de entrada del formulario usando jQuery
            var data_aguinaldo_mes = $('#frm-historico-aguinaldo input').map(function() {
                return $(this).attr('data-aguinaldo-mes');
            }).get();
            var data_renta_mes = $('#frm-historico-renta input').map(function() {
                return $(this).attr('data-renta-mes');
            }).get();

            var regex = /^(enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre)_(\d{4})_(aguinaldo|renta)$/;
            $.each(data_aguinaldo_mes, function(index, elemento) {
                if (regex.test(elemento)) {
                    let matches = elemento.match(regex);
                    let mes = matches[1];
                    let año = matches[2];
                    let identificador = matches[3];

                    let resultado = $.grep(auxiliares, function(auxiliar) {
                        return auxiliar.mes === parseInt(mesToNumber(mes)) && auxiliar.anio === parseInt(año) && auxiliar.tipo === identificador;
                    });

                    if (resultado.length > 0) {
                        $('#'+elemento).val(resultado[0].monto);
                    }
                }
            });
            $.each(data_renta_mes, function(index, elemento) {
                if (regex.test(elemento)) {
                    let matches = elemento.match(regex);
                    let mes = matches[1];
                    let año = matches[2];
                    let identificador = matches[3];
                    let resultado = $.grep(auxiliares, function(auxiliar) {
                        return auxiliar.mes === parseInt(mesToNumber(mes)) && auxiliar.anio === parseInt(año) && auxiliar.tipo === identificador;
                    });

                    if (resultado.length > 0) {
                        $('#'+elemento).val(resultado[0].monto);
                    }
                }
            });

            function mesToNumber(mes) {
                var meses = {
                    'enero': 1,
                    'febrero': 2,
                    'marzo': 3,
                    'abril': 4,
                    'mayo': 5,
                    'junio': 6,
                    'julio': 7,
                    'agosto': 8,
                    'septiembre': 9,
                    'octubre': 10,
                    'noviembre': 11,
                    'diciembre': 12
                };
                return meses[mes.toLowerCase()];
            }
            $('#btn-historico').click(function(e){
                e.preventDefault(); // Evita la acción predeterminada del enlace
                $('#cargando').modal('show');
                // Obtén el formulario por su ID
                var formulario=$('#frm-historico-aguinaldo');
                // Envía el formulario
                formulario.submit();
            });
            $('#btn-h-renta').click(function(e){
                e.preventDefault(); // Evita la acción predeterminada del enlace
                $('#cargando').modal('show');
                // Obtén el formulario por su ID
                var formulario=$('#frm-historico-renta');
                // Envía el formulario
                formulario.submit();
            });
            $('#btn-h-vacaciones').click(function(e){
                e.preventDefault(); // Evita la acción predeterminada del enlace
                $('#cargando').modal('show');
                // Obtén el formulario por su ID
                var formulario=$('#frm-historico-vaciones');
                // Envía el formulario
                formulario.submit();
            });
            $('.link-registro-fecha-ingreso').click(function(e){
                e.preventDefault(); // Evita la acción predeterminada del enlace
                $('#cargando').modal('show');
                var formulario=$('#frm-link-date-ingreso');
                // Envía el formulario
                formulario.submit();
            });
            $('.frm-historico .number-input').on('keydown', function (evt) {
                // Lógica del evento keydown aquí
                !/(^\d*\.?\d*$)|(Backspace|Control|Meta)/.test(evt.key) && evt.preventDefault();

                if ($(this).val().includes(".")) {
                    var key = evt.keyCode || evt.which;

                    if (key === 110 || key === 190 || key === 188) {
                        evt.preventDefault();
                    }
                }
            });

            function decodeEntities(encodedString) {
                var textArea = document.createElement('textarea');
                textArea.innerHTML = encodedString;
                return textArea.value;
            }
        });
    </script>

    <script type="module">
        $('#configurar-link').click(function(e){
            e.preventDefault(); // Evita la acción predeterminada del enlace
            // Obtén el formulario por su ID
            var formulario=$('#form-Planilla-config');
            // Envía el formulario
            formulario.submit();
        });

        //CCSS INS
        $('#guardar-CCSSINS').on('click', function (evt){
            $('#confirmModalINSCCSS').modal('hide');
            $('#cargando').modal('show');
        });

        $('#form-CCSSINS').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                fechaIngreso: {
                    required: true
                },
                numeroAsegurado: {
                    required: true
                },
                riesgoTrabajo: {
                    required: true
                }
            },

            messages: {
                fechaIngreso: {
                    required: "Este campo es requerido."
                },
                numeroAsegurado: {
                    required: "Este campo es requerido."
                },
                riesgoTrabajo: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarINSCCSS").on('click', function (evt){
            if($('#form-CCSSINS').valid()){
                $('#confirmModalINSCCSS').modal('show');
            }else{
                return false;
            }
        });

        //contactos de emergencia
        $('#guardar-ContactoEmergencia').on('click', function (evt){
            $('#confirmModalContactoEmergencia').modal('hide');
            $('#cargando').modal('show');
        });


        $('#form-contactoEmergencia').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                contactoEmergencia: {
                    required: true
                },
                parentescoEmergencia: {
                    required: true
                },
                telefonoEmergencia: {
                    required: true
                }
            },
            messages: {
                contactoEmergencia: {
                    required: "Este campo es requerido."
                },
                parentescoEmergencia: {
                    required: "Este campo es requerido."
                },
                telefonoEmergencia: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarContacto").on('click', function (evt){
            if($('#form-contactoEmergencia').valid()){
                $('#confirmModalContactoEmergencia').modal('show');
            }else{
                return false;
            }
        });

        //contactos de emergencia
        $('#guardar-ContactoEmergencia').on('click', function (evt){
            $('#confirmModalContactoEmergencia').modal('hide');
            $('#cargando').modal('show');
        });

        //Familiares
        $('#conyugeDependiente').on('change', function (evt){
            let conyugeDependiente = $('#conyugeDependiente').val();

            $.ajax({
                type:'GET',
                url: "{{ route('colaboradoresEditarConyugue') }}",
                data: {'conyugeDependiente':conyugeDependiente,
                    'idColaborador':{{$idColaborador}} },
                success: (response) => {
                    if (response) {
                        mostrarAlertaExito(response);
                    }
                },
                error: function(response){
                    alert(response.responseJSON.message);
                }
            });
        });


        $('#guardar-Familiar').on('click', function (evt){
            $('#confirmModalFamiliares').modal('hide');
            $('#cargando').modal('show');
        });


        $('#form-familiares').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                fechaNacimientoHijo: {
                    required: true
                }
            },

            messages: {
                fechaNacimientoHijo: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarFamiliar").on('click', function (evt){
            if($('#form-familiares').valid()){
                $('#confirmModalFamiliares').modal('show');
            }else{
                return false;
            }
        });

        //Vehiculos
        $('#guardar-Vehiculo').on('click', function (evt) {
            $('#confirmModalVehiculo').modal('hide');
            $('#cargando').modal('show');
        });


        $('#form-Vehiculo').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                marca: {
                    required: true
                },
                modelo: {
                    required: true
                },
                color: {
                    required: true
                },
                placa: {
                    required: true
                }
            },

            messages: {
                marca: {
                    required: "Este campo es requerido."
                },
                modelo: {
                    required: "Este campo es requerido."
                },
                color: {
                    required: "Este campo es requerido."
                },
                placa: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarVehiculo").on('click', function (evt){
            if($('#form-Vehiculo').valid()){
                $('#confirmModalVehiculo').modal('show');
            }else{
                return false;
            }
        });

        //Planilla
        $('#guardar-Planilla').on('click', function (evt){
            $('#confirmModalPlanilla').modal('hide');
            $('#cargando').modal('show');
        });


        $('#form-Planilla').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                perfilOcupacional: {
                    required: true
                },
                salarioBase: {
                    required: true
                },
                tipoPlanilla: {
                    required: true
                }
            },

            messages: {
                perfilOcupacional: {
                    required: "Este campo es requerido."
                },
                salarioBase: {
                    required: "Este campo es requerido."
                },
                tipoPlanilla: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarPlanilla").on('click', function (evt){
            if($('#form-Planilla').valid()){
                $('#confirmModalPlanilla').modal('show');
            }else{
                return false;
            }
        });

        //Vehiculos
        $('#guardar-Vehiculo').on('click', function (evt) {
            $('#confirmModalVehiculo').modal('hide');
            $('#cargando').modal('show');
        });


        $('#form-Vehiculo').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                marca: {
                    required: true
                },
                modelo: {
                    required: true
                },
                color: {
                    required: true
                },
                placa: {
                    required: true
                }
            },

            messages: {
                marca: {
                    required: "Este campo es requerido."
                },
                modelo: {
                    required: "Este campo es requerido."
                },
                color: {
                    required: "Este campo es requerido."
                },
                placa: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarVehiculo").on('click', function (evt){
            if($('#form-Vehiculo').valid()){
                $('#confirmModalVehiculo').modal('show');
            }else{
                return false;
            }
        });

        //permisos de conducir
        $('#guardar-PermisoConducir').on('click', function (evt){
            $('#confirmModalPermisoConducir').modal('hide');
            $('#cargando').modal('show');
        });


        $('#form-PermisoConducir').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                numeroLicencia: {
                    required: true
                },
                fechaVencimiento: {
                    required: true
                }
            },

            messages: {
                numeroLicencia: {
                    required: "Este campo es requerido."
                },
                fechaVencimiento: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarPermisoConducir").on('click', function (evt){
            if($('#form-PermisoConducir').valid()){
                $('#confirmModalPermisoConducir').modal('show');
            }else{
                return false;
            }
        });

        //Tipo Pago
        $('#guardarTipoPago').on('click', function (evt){
            $('#confirmModalBanco').modal('hide');
            $('#cargando').modal('show');

            var tipoPago = $("#tipoPago").val();
            if(tipoPago == "deposito"){
                $("#formDeposito").submit();
            }
            if(tipoPago == "sinpe_movil"){
                $("#formSinpeMovil").submit();
            }
            if(tipoPago == "cheque"){
                $("#formCheque").submit();
            }
        });

        $('#formDeposito').validate({
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

        $('#formSinpeMovil').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                telefonoSinpe: {
                    required: true
                }
            },
            messages: {
                telefonoSinpe: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrarDeposito").on('click', function (evt){
            if($('#formDeposito').valid()) {
                $('#confirmModalTipoPago').modal('show');
            }else{
                return false;
            }
        });

        $("#registrarSinpeMovil").on('click', function (evt){
            if($('#formSinpeMovil').valid()) {
                $('#confirmModalTipoPago').modal('show');
            }else{
                return false;
            }
        });

        $("#registrarCheque").on('click', function (evt){
            if($('#formCheque').valid()) {
                $('#confirmModalTipoPago').modal('show');
            }else{
                return false;
            }
        });
    </script>

    <script type="module">
        $("#tipoAsegurado").on('change', function(evt){
            if($("#tipoAsegurado").val()==1) {
                $("#numeroAsegurado").val({{$resultadoColaborador->identificacion}});
                $("#riesgoTrabajo").val({{$resultadoColaborador->identificacion}});
                $("#numeroAsegurado").prop("readonly",true);
                $("#riesgoTrabajo").prop("readonly",true);
            }else{
                $("#numeroAsegurado").val("");
                $("#riesgoTrabajo").val("");
                $("#numeroAsegurado").prop("readonly",false);
                $("#riesgoTrabajo").prop("readonly",false);
            }
        });
    </script>

    <script type="text/javascript">
        function cambiarTipoPago(tipo_pago){
            var ocultar_todos = false;

            //Deposito
            if(tipo_pago == "deposito"){
                if(($("#chk_deposito").is(":checked"))){
                    $("#chk_sinpe_movil").prop("checked", false);
                    $("#chk_cheque").prop("checked", false);

                    $("#div_sinpe_movil").hide();
                    $("#div_cheque").hide();
                    $("#div_deposito").show();
                }else{
                    ocultar_todos = true;
                }
            }

            if(tipo_pago == "sinpe_movil"){
                if(($("#chk_sinpe_movil").is(":checked"))) {
                    $("#chk_deposito").prop("checked", false);
                    $("#chk_cheque").prop("checked", false);

                    $("#div_deposito").hide();
                    $("#div_cheque").hide();
                    $("#div_sinpe_movil").show();
                }else{
                    ocultar_todos = true;
                }
            }

            if(tipo_pago == "cheque"){
                if(($("#chk_cheque").is(":checked"))) {
                    $("#chk_deposito").prop("checked", false);
                    $("#chk_sinpe_movil").prop("checked", false);

                    $("#div_deposito").hide();
                    $("#div_sinpe_movil").hide();
                    $("#div_cheque").show();
                }else{
                    ocultar_todos = true;
                }
            }

            if(ocultar_todos == true){
                $("#div_sinpe_movil").hide();
                $("#div_cheque").hide();
                $("#div_deposito").hide();
            }

            $("#tipoPago").val(tipo_pago);
        }
    </script>
@endpush
