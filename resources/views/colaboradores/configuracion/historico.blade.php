<div class="card-body">
    <div class="mt-3 card bcard bgc-transparent shadow-none">
        <div class="card-body tabs-left p-0">
            <ul class="nav nav-tabs align-self-start" role="tablist">
                <li class="nav-item shadow-sm">
                    <a class="nav-link text-left py-3 active" id="aguinaldo-tab-btn" data-toggle="tab" href="#aguinaldo" role="tab" aria-controls="home14" aria-selected="true">
                        <h3 class="card-title text-125">
                            {{--            <i class="nav-icon fa fa-business-time text-green-m2"></i>--}}
                            {{ __('Aguinaldo') }}
                        </h3>
                    </a>
                </li>

                <li class="nav-item shadow-sm">
                    <a class="nav-link text-nowrap py-3" id="renta-tab-btn" data-toggle="tab" href="#renta" role="tab" aria-controls="profile14" aria-selected="false">
                        <h3 class="card-title text-125">
                            {{--            <i class="nav-icon fa fa-business-time text-green-m2"></i>--}}
                            {{ __('Renta') }}
                        </h3>
                    </a>
                </li>

                <li class="nav-item shadow-sm">
                    <a class="nav-link text-nowrap py-3" id="vacaciones-tab-btn" data-toggle="tab" href="#vacaciones" role="tab" aria-controls="more14" aria-selected="false">
                        <h3 class="card-title text-125">
                            {{--            <i class="nav-icon fa fa-business-time text-green-m2"></i>--}}
                            {{ __('Vacaciones') }}
                        </h3>
                    </a>
                </li>
            </ul>

            <div class="tab-content p-35 border-1 brc-grey-l1 shadow-sm bgc-white">
                <div class="tab-pane fade text-95 active show" id="aguinaldo" role="tabpanel" aria-labelledby="home14-tab-btn">
                    <form class="mt-lg-3 frm-historico" id="frm-historico-aguinaldo" autocomplete="off" method="POST" action="{{route('colaboradoresEditarHistorico')}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id_colaborador" value="{{$idColaborador}}"/>
                        <input type="hidden" name="tipo" value="aguinaldo"/>
                        <input type="text" name="tab" value="historico-tab" hidden/>
                        <div class="form-group row mt-4">
                            <div class="col-sm-12">
                                <div class="alert bgc-white shadow-sm brc-primary-m2 border-none border-l-5 radius-0 d-flex align-items-center" role="alert">
                                    {{--                    <i class="fas fa-info-circle mr-3 fa-2x text-info-m3"></i>--}}
                                    <div id="alerta_incapacidad">
                                        <a class="alert-link text-dark">
                                            <p>En esta sección puede tener registro de los montos correspondientes a periodos anteriores relacionados con el aguinaldo del colaborador.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($existe_fecha_ingreso)
                            @php
                                function obtenerValorPorMes($obj_historico, $mes,$anio) {
                                    foreach ($obj_historico as $obj) {

                                        if ($obj->mes == $mes && $obj->anio==$anio) {
                                            return $obj->monto;
                                        }
                                    }
                                    return '';
                                }
                            @endphp
                            <div>
                                <div class="form-group row mt-3" id="">
                                    @if($aguinaldo_diciembre)
                                    <div class="col-md-6 col-sm-12 text-md-left mt-2">
                                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> {{ucfirst('Diciembre') .' '.$anioActual-1}}
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₡</span>
                                            </div>
                                            <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="historico_aguinaldo[diciembre]" name="historico_aguinaldo[diciembre]" value="{{ obtenerValorPorMes($aguinaldos, 'diciembre',$anioActual-1) }}">
                                        </div>
                                    </div>
                                    @endif
                                    @foreach($meses as $mes)
                                        @if($mes!='diciembre')
                                            <div class="col-md-6 col-sm-12 text-md-left mt-2">
                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> {{ucfirst($mes) .' '.$anioActual}}
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₡</span>
                                                    </div>
                                                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="historico_aguinaldo[{{$mes}}]" name="historico_aguinaldo[{{$mes}}]" value="{{ obtenerValorPorMes($aguinaldos, $mes,$anioActual) }}">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
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
                        @else
                            <div role="alert" class="alert alert-warning bgc-warning-l4 brc-warning-m3 border-2 d-flex align-items-center">
                                {{--            <i class="fas fa-exclamation-circle mr-3 fa-2x text-orange"></i>--}}
                                <div class="text-dark-tp2">
                                    No se encuentran registros de la <span class="alert-link text-dark" style="text-decoration: underline;">fecha de ingreso</span> del colaborador
                                    <a href="#" onclick="link_config_colaborador_index()" class="alert-link text-orange-d2">
                                        ir a registrar
                                    </a>.
                                </div>
                            </div>
                        @endif
                    </form>
                </div>

                <div class="tab-pane fade text-95" id="renta" role="tabpanel" aria-labelledby="profile14-tab-btn">
                    <form class="mt-lg-3 frm-historico" id="frm-historico-renta" autocomplete="off" method="POST" action="{{route('colaboradoresEditarHistorico')}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id_colaborador" value="{{$idColaborador}}"/>
                        <input type="hidden" name="tipo" value="renta"/>
                        <div class="form-group row mt-4">
                            <div class="col-sm-12">
                                <div class="alert bgc-white shadow-sm brc-primary-m2 border-none border-l-5 radius-0 d-flex align-items-center" role="alert">
                                    {{--                    <i class="fas fa-info-circle mr-3 fa-2x text-info-m3"></i>--}}
                                    <div id="alerta_incapacidad">
                                        <a class="alert-link text-dark">
                                            En esta sección puede tener registro de los montos correspondientes a periodos anteriores relacionados con la retención de renta del colaborador.
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($existe_fecha_ingreso)
                            <div>
                                <div class="form-group row mt-3" id="">
                                    @foreach($meses as $mes)
                                        <div class="col-md-6 col-sm-12 text-md-left mt-2">
                                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> {{ucfirst($mes) .' '.$anioActual}}
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₡</span>
                                                </div>
                                                <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="historico_aguinaldo[{{$mes}}]" name="historico_aguinaldo[{{$mes}}]" value="{{ obtenerValorPorMes($rentas, $mes,$anioActual) }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
                        @else
                            <div role="alert" class="alert alert-warning bgc-warning-l4 brc-warning-m3 border-2 d-flex align-items-center">
                                {{--            <i class="fas fa-exclamation-circle mr-3 fa-2x text-orange"></i>--}}
                                <div class="text-dark-tp2">
                                    No se encuentran registros de la <span class="alert-link text-dark" style="text-decoration: underline;">fecha de ingreso</span> del colaborador
                                    <a href="#" onclick="link_config_colaborador_index()" class="alert-link text-orange-d2">
                                        ir a registrar
                                    </a>.
                                </div>
                            </div>
                        @endif
                    </form>
                </div>

                <div class="tab-pane fade text-95" id="vacaciones" role="tabpanel" aria-labelledby="more14-tab-btn">
                    <form class="mt-lg-3" id="frm-historico-vaciones" autocomplete="off" method="POST" action="{{route('colaboradoresEditarHistoricoVacaciones')}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id_colaborador" value="{{$idColaborador}}"/>
                        <div class="form-group row mt-4">
                            <div class="col-sm-12">
                                <div class="alert bgc-white shadow-sm brc-primary-m2 border-none border-l-5 radius-0 d-flex align-items-center" role="alert">
                                    {{--                    <i class="fas fa-info-circle mr-3 fa-2x text-info-m3"></i>--}}
                                    <div id="alerta_incapacidad">
                                        <a class="alert-link text-dark">
                                            Esta sección es un registro auxiliar si el colaborador arrastra de forma positiva o negativa dias de vacaciones.
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="form-group row mt-3">
                                <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                                    <label for="identificacion" class="mb-0 text-blue-m1"> Cantidad de días de vacaciones
                                    </label>
                                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="" name="vacaciones" value="{{$vacaciones??""}}" required="true">
                                </div>
                            </div>
                        </div>
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
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="module">
    $(function(){
        if("{{session()->has('tipo_tab_hitorico')}}"){
            $('#'+"{{session()->get('tipo_tab_hitorico')}}").trigger("click");
        }else{
            $('#aguinaldo-tab-btn').trigger("click");
        }
    });
</script>
@if(file_exists(public_path('js/scripts/admin/config_colaborador_historico.min.js')))
    <script src="{{ asset('js/scripts/admin/config_colaborador_historico.min.js') }}?t={{ filemtime(public_path('js/scripts/admin/config_colaborador_historico.min.js')) }}"></script>
@endif


