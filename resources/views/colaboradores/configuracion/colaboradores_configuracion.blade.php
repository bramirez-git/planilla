@extends('Layouts.menu')

@section('page-content')
    <div class="pb-3">
        <div class="bcard">
            <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
                <li class="nav-item mr-2px">
                    <a id="CCSSINS-tab" href="#tab_CCSSINS" data-load="{{route('tab_CCSSINS',[$id_colaborador])}}" class="d-style  btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="CCSSINS" aria-selected="true">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> CCSS-INS-TD
                    </a>
                </li>
                <li class="nav-item mr-2px">
                    <a id="contactoEmergencia-tab" href="#tab_contactoEmergencia" data-load="{{route('tab_contactoEmergencia',[$id_colaborador])}}" class="d-style  btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="contactoEmergencia" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Contacto de emergencia
                    </a>
                </li>
                <li class="nav-item">
                    <a id="familiares-tab" href="#tab_familiares" data-load="{{route('tab_familiares',[$id_colaborador])}}"  class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="familiares" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Familiares
                    </a>
                </li>
                <li class="nav-item">
                    <a id="vehiculos-tab" href="#tab_vehiculos" data-load="{{route('tab_vehiculos',[$id_colaborador])}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="vehiculos" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Vehículos
                    </a>
                </li>
                <li class="nav-item">
                    <a id="permisoConducir-tab" href="#tab_permisoConducir" data-load="{{route('tab_permisoConducir',[$id_colaborador])}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="permisoConducir" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Permisos de conducir
                    </a>
                </li>
                <li class="nav-item">
                    <a id="planilla-tab" href="#tab_planilla_colaborador" data-load="{{route('tab_planilla_colaborador',[$id_colaborador])}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="planilla" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Planilla
                    </a>
                </li>
                <li class="nav-item">
                    <a id="bancos-tab" href="#tab_bancos_colaborador" data-load="{{route('tab_bancos_colaborador',[$id_colaborador])}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="bancos" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> M&eacute;todo Pago
                    </a>
                </li>
                <li class="nav-item">
                    <a id="vacaciones-tab" href="#tab_vacaciones" data-load="{{route('tab_vacaciones',[$id_colaborador])}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="vacaciones" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Vacaciones
                    </a>
                </li>
                <li class="nav-item">
                    <a id="historico-tab" href="#tab_historico" data-load="{{route('tab_historico',[$id_colaborador])}}" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" role="tab" aria-controls="historico" aria-selected="false">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span> Histórico
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content bgc-white p-35 border-0">
        <div id="tab_CCSSINS" class="tab-pane fade in"></div>
        <div id="tab_contactoEmergencia" class="tab-pane fade in"></div>
        <div id="tab_familiares" class="tab-pane fade in"></div>
        <div id="tab_vehiculos" class="tab-pane fade in"></div>
        <div id="tab_permisoConducir" class="tab-pane fade in"></div>
        <div id="tab_planilla_colaborador" class="tab-pane fade in"></div>
        <div id="tab_bancos_colaborador" class="tab-pane fade in"></div>
        <div id="tab_vacaciones" class="tab-pane fade in"></div>
        <div id="tab_historico" class="tab-pane fade in"></div>
    </div>
    <script type="module">
        $(function(){
            if("{{session()->has('tipoForm')}}"){
                $('#'+"{{session()->get('tipoForm')}}").trigger("click");
            }else{
                $('#CCSSINS-tab').trigger("click");
            }
        });
    </script>
@endsection
