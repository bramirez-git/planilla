<div class="container">
    <h3 class="card-title text-150 text-green-m2 text-center">
        {{$resultado->nombre}}  </h3>
    <hr>
    <div class="pb-3">
        <div class="bcard">
            <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
                <li class="nav-item mr-2px">
                    <a id="servicio-info-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-85 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#datosGenerales" role="tab" aria-controls="datosGenerales" aria-selected="true">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-question-circle text-green-m2"></i>
                        Acerca de
                    </a>
                </li>
                <li class="nav-item mr-2px">
                    <a id="info-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-85 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-info-circle text-green-m2"></i>
                        Información
                    </a>
                </li>
                <li class="nav-item mr-2px">
                    <a id="DatosGenerales-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-85 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#config_serv" role="tab" aria-controls="datosGenerales" aria-selected="true">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fas fa-tasks text-green-m2"></i>
                        Configuración
                    </a>
                </li>
                <li class="nav-item mr-2px">
                    <a id="DatosGenerales-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-85 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#baja_serv" role="tab" aria-controls="datosGenerales" aria-selected="true">
                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                        <i class="nav-icon fa fa-ban text-green-m2"></i>
                        Dar de baja
                    </a>
                </li>
            </ul>
            <div class="tab-content bgc-white p-35 border-0">
                <div class="tab-pane fade show text-95" id="datosGenerales" role="tabpanel" aria-labelledby="home1-tab-btn">
                    <div class="container">
                        <div class="html_servicio_adicional">
                            <div class="space-10"></div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <h4 class="card-title text-125 text-green-m2">
                                        Descripción </h4>
                                    <hr>
                                    <p class="text-100">{{$resultado->descripcion}}</p>
                                    <h4 class="card-title text-125 text-green-m2">
                                        Precio </h4>
                                    <hr>
                                    <p>Este servicio tiene un costo de ${{$resultado->precio}} USD + IVA / mensuales.</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show text-95" id="info" role="tabpanel" aria-labelledby="home1-tab-btn">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <colgroup>
                                        <col style="width: 50%">
                                        <col style="width: 50%">
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <th class="align-right">Costo del servicio:</th>
                                        <td>
                                            <div>
                                                ${{$resultado->precio}}  USD + IVA / mensuales<br>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-right">Condición del servicio:</th>
                                        <td>
                                            <div>
                                                <a href="javascript:void(0)">Contratado</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-right">Próxima renovación:</th>
                                        <td>
                                            <div class="clearfix">
                                                2-01-2024<br> Días restantes: 22<br>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show text-95" id="config_serv" role="tabpanel" aria-labelledby="home1-tab-btn">
                    <div class="space-10"></div>
                    <div class="col-xs-12">
                        <h4 class="card-title text-125 text-green-m2">
                            Opciones por defecto </h4>
                        <hr>
                        <div class="form-group">
                            <i class="fa fa-info-circle text-blue-m2 open-popAlert" role="button" data-content="Esta configuración define la condición por defecto, del check para el registro de compras por pagar desde los formularios de <strong>compras del exterior</strong> y <strong>recepción de documentos</strong>."></i>&nbsp;Gestión dato uno de configuración:
                            <span id="registrar_dc" class="bolder">Habilitado</span>
                            <a href="javascript:void(0)" onclick="">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-info-circle text-blue-m2 open-popAlert" role="button" data-content="Iniciar la gestión de la deuda de forma automática, al registrar la compra por pagar"></i>&nbsp;Gestión dato dos de configuración:
                            <span id="registrar_deuda_dc" class="bolder">Deshabilitado</span>
                            <a href="javascript:void(0)" onclick="">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show text-95" id="baja_serv" role="tabpanel" aria-labelledby="home1-tab-btn">
                    <form method="POST" id="frm_baja_serv" action="{{ route('desactivar_servicio',$resultado->id_servicio) }}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="proc" value="solicitar_baja">
                        <div role="button" class="d-style border-1 bgc-primary-l4 brc-primary-m3 px-3 pt-25 pb-1 pos-rel shadow-sm overflow-hidden radius-1 text-justify mb-3">
                            <p class="text-grey pos-rel">
                                Si solicita la baja, el servicio dejará de cobrarse a partir de la próxima fecha de renovación.<br>
                                Puede cancelar esta solicitud antes de la fecha de renovación para continuar utilizando el servicio.
                            </p>
                        </div>
                        <div>
                            <button onclick="solicitar_baja_serv()" class="btn btn-primary btn-raised py-2 px-25 text-105 mb-1">
                                <i class="fa fa-ban"></i>&nbsp;Solicitar baja
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module">
    $(function(){
        if("{{session()->has('tipoForm')}}"){
            $('#'+"{{session()->get('tipo_form')}}").trigger("click");
        }else{
            $('#servicio-info-tab').trigger("click");
        }

    });
</script>
