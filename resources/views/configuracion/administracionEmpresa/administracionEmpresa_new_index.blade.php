@extends('Layouts.menu')

@section('page-content')
    <div class="pb-3">
        <div class="bcard">
            <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
                <li class="nav-item mr-2px">
                    <a id="datos_generales-tab" href="#tab_datos_generales" data-toggle="tab" data-load="{{route("datos_generales")}}" class="d-style  btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0"  role="tab" aria-controls="datosGenerales" aria-selected="true">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-bars-staggered text-green-m2"></i>
                        Datos generales
                    </a>
                </li>

                <li class="nav-item mr-2px">
                    <a id="comunicaciones-tab" href="#tab_comunicaciones" data-toggle="tab" data-load="{{route("tab_comunicaciones")}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" role="tab" aria-controls="comunicaciones" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-envelope text-green-m2"></i>
                        Comunicaciones
                    </a>
                </li>

                <li class="nav-item">
                    <a id="ajustePlanilla-tab" data-toggle="tab" href="#tab_ajustePlanilla" data-load="{{route("tab_planilla")}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" role="tab" aria-controls="ajustePlanilla" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-money-check-dollar text-green-m2"></i>
                        Planilla
                    </a>
                </li>

                <li class="nav-item">
                    <a id="bancos-tab" data-toggle="tab" href="#tab_bancos" data-load="{{route("tab_bancos")}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" role="tab" aria-controls="vehiculos" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-building-columns text-green-m2"></i>
                        Bancos
                    </a>
                </li>

                <li class="nav-item">
                    <a id="controlHorario-tab" data-toggle="tab" href="#tab_controlHorario" data-load="{{route("tab_control_horario")}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" role="tab" aria-controls="controlHorario" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-clock text-green-m2"></i>
                        Control de horario
                    </a>
                </li>

                <li class="nav-item">
                    <a id="ocupaciones-tab" data-toggle="tab" href="#tab_ocupaciones" data-load="{{route("tab_ocupaciones")}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" role="tab" aria-controls="ocupaciones" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-helmet-safety text-green-m2"></i>
                        Ocupaciones
                    </a>
                </li>

                <li class="nav-item">
                    <a id="accionPersonal-tab" data-toggle="tab" href="#tab_accionPersonal" data-load="{{route("tab_accion_personal")}}" class="d-style  btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" role="tab" aria-controls="accionPersonal" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-location-arrow text-green-m2"></i>
                        Acción de personal
                    </a>
                </li>
                <li class="nav-item">
                    <a id="sistema-tab" data-toggle="tab" href="#tab_sistema" data-load="{{route("tab_sistema")}}" class="d-style  btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" role="tab" aria-controls="accionPersonal" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-gears text-green-m2"></i>
                        Sistema
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content bgc-white p-35 border-0">
        <div id="tab_datos_generales" class="tab-pane fade in"></div>
        <div id="tab_comunicaciones" class="tab-pane fade in"></div>
        <div id="tab_ajustePlanilla" class="tab-pane fade in"></div>
        <div id="tab_bancos" class="tab-pane fade in"></div>
        <div id="tab_controlHorario" class="tab-pane fade in"></div>
        <div id="tab_ocupaciones" class="tab-pane fade in"></div>
        <div id="tab_accionPersonal" class="tab-pane fade in"></div>
        <div id="tab_sistema" class="tab-pane fade in"></div>
    </div>
    <script type="module">
        $(function(){
            if("{{session()->has('tipoForm')}}"){
                $('#'+"{{session()->get('tipo_form')}}").trigger("click");
            }else{
                $('#datos_generales-tab').trigger("click");
            }
        });
    </script>

@endsection
