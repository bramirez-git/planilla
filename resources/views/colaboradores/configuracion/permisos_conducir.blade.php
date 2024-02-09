<form class="mt-lg-3" id="form-PermisoConducir" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Permisos de conducir" hidden/>
    <input type="text" name="tab" value="permisoConducir-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de Licencia') }}</label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoLicencia" name="tipoLicencia">
                @foreach($catalogoTipoLicencia as $datos)

                    <option value="{{ $datos->id_licencia_conducir }}">{{ $datos->licencia_conducir }}</option>

                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de licencia') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroLicencia" name="numeroLicencia"/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Fecha de Vencimiento</label>
            <div class="input-group input-daterange">
                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaVencimiento" name="fechaVencimiento">
            </div>
        </div>
        <div class="col-md-3 col-sm-12 align-self-end">
            <button type="button" id="registrarPermisoConducir" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Permiso
            </button>
        </div>
    </div>
    @if($resultadoLicencias->isEmpty())
        <div class="alert alert-warning"> No hay permisos de conducir registrados.</div>
    @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Tipo de licencia</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Número de licencia</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Fecha de Vencimiento</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción</th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultadoLicencias as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                    <td data-label="Tipo de licencia:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->licencia_conducir }} </td>
                    <td data-label="Número de licencia:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->numero_licencia }} </td>
                    <td data-label="Fecha de Vencimiento:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->fecha_vencimiento }} </td>
                    <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a data-toggle="modal" data-target="#modalEliminarPermisoConducir{{$datos->id_licencia_conducir}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a data-toggle="modal" data-target="#modalEliminarPermisoConducir{{$datos->id_licencia_conducir}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </td>
                </tr>
                <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarPermisoConducir{{$datos->id_licencia_conducir}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                    <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el permiso de conducir del colaborador?</div>
                                </div>
                            </div>
                            <div class="modal-footer bgc-white-tp2 border-0">
                                <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No</button>
                                <a href="{{ route("colaboradoresEliminarPermisoConducir",[ $idColaborador,$datos->id_licencia_conducir]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                    Si </a>
                            </div>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Desea guardar datos de permiso de conducir para el colaborador?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                    <button id="guardar-PermisoConducir" type="submit" class="btn btn-primary"> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="alert alert-collapse bgc-white text-dark-tp3 border-none border-t-4 shadow-sm brc-primary radius-0 py-3 d-flex align-items-start mt-4">
    <div class="bgc-primary px-4 py-25 radius-1px mr-4 shadow-sm">
        <i class="fa fa-exclamation text-180 text-white"></i>
    </div>
    <div class="text-dark-tp3">
        <h3 class="text-blue-d1 text-130">Importante!</h3>
        Según lo dispuesto en el artículo 68 de la Ley de Tránsito por Vías Públicas
        Terrestres, todo aspirante podrá solicitar que se le realice un examen práctico
        de manejo, para la obtención de cualquiera de los siguientes tipos de licencia:
    </div>
</div>
<div class="accordion mt-4" id="accordionExample5">
    <div class="card border-0 radius-0">
        <div class="card-header border-0 bgc-transparent mb-0" id="licenciasA">
            <h2 class="card-title bgc-info-d3 text-white brc-black-tp7">
                <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_A" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5">
                    <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i>
                    <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase A:
                </a>
            </h2>
        </div>
        <div id="licencias_A" class="collapse" aria-labelledby="licenciasA" data-parent="#accordionExample5">
            <div class="card-body p-0">
                <!-- sub group -->
                <div class="card bcard h-auto">
                    <div class="card-body p-0 bgc-white">
                        <div class="accordion" id="licenciaA">
                            <div class="card border-0">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA1">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaA_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-1:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaA_1" class="collapse" aria-labelledby="licenciaA1" data-parent="#licenciaA">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Para el manejo de motocicleta y bicimotos que tenga un cilindraje de 125 cc.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA2">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaA_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-2:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaA_2" class="collapse" aria-labelledby="licenciaA2" data-parent="#licenciaA">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify"> Para el manejo de motocicletas y bicimotos cuyo cilindraje no sea superior a los 500 cc.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA3">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaA_3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-3:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaA_3" class="collapse" aria-labelledby="licenciaA3" data-parent="#licenciaA">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify"> Para el manejo de motocicletas tipo A1 y A2 y  donde no hay límite de cilindraje o potencia.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaA4">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaA_4" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo A-4:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaA_4" class="collapse" aria-labelledby="licenciaA4" data-parent="#licenciaA">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify"> Autoriza para conducir motocicletas de 501 cc. O más. No requiere de condiciones adicionales.</div>
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
            <h2 class="card-title bgc-info-d3 text-white brc-black-tp7">
                <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_B" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5">
                    <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i>
                    <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase B:
                </a>
            </h2>
        </div>
        <div id="licencias_B" class="collapse" aria-labelledby="licenciasB" data-parent="#accordionExample5">
            <div class="card-body p-0">
                <!-- sub group -->
                <div class="card bcard h-auto">
                    <div class="card-body p-0 bgc-white">
                        <div class="accordion" id="licenciaB">
                            <div class="card border-0">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB1">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaB_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-1:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaB_1" class="collapse" aria-labelledby="licenciaB1" data-parent="#licenciaB">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify"> Automoviles.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB2">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaB_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-2:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaB_2" class="collapse" aria-labelledby="licenciaB2" data-parent="#licenciaB">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Para el manejo de camión pequeño.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB3">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaB_3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-3:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaB_3" class="collapse" aria-labelledby="licenciaB3" data-parent="#licenciaB">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify"> Para el manejo de camión pesado.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaB4">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaB_4" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo B-4:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaB_4" class="collapse" aria-labelledby="licenciaB4" data-parent="#licenciaB">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify"> Para el manejo de camión articulado.</div>
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
            <h2 class="card-title bgc-info-d3 text-white brc-black-tp7">
                <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_C" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5">
                    <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i>
                    <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase C:
                </a>
            </h2>
        </div>
        <div id="licencias_C" class="collapse" aria-labelledby="licenciasC" data-parent="#accordionExample5">
            <div class="card-body p-0">
                <!-- sub group -->
                <div class="card bcard h-auto">
                    <div class="card-body p-0 bgc-white">
                        <div class="accordion" id="licenciaC">
                            <div class="card border-0">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaC1">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaC_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo C-1:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaC_1" class="collapse" aria-labelledby="licenciaC1" data-parent="#licenciaC">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify"> Para el manejo de  taxi.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaC2">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaC_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo C-2:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaC_2" class="collapse" aria-labelledby="licenciaC2" data-parent="#licenciaC">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Para el manejo de  autobús.
                                    </div>
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
            <h2 class="card-title bgc-info-d3 text-white brc-black-tp7">
                <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_D" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5">
                    <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i>
                    <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase D:
                </a>
            </h2>
        </div>
        <div id="licencias_D" class="collapse" aria-labelledby="licenciasD" data-parent="#accordionExample5">
            <div class="card-body p-0">
                <!-- sub group -->
                <div class="card bcard h-auto">
                    <div class="card-body p-0 bgc-white">
                        <div class="accordion" id="licenciaD">
                            <div class="card border-0">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaD1">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaD_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo D-1:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaD_1" class="collapse" aria-labelledby="licenciaD1" data-parent="#licenciaD">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Tractores y maquinaria.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaD2">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaD_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo D-2:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaD_2" class="collapse" aria-labelledby="licenciaD2" data-parent="#licenciaD">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Tractores y maquinaria.</div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaD3">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaD_3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo D-3:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaD_3" class="collapse" aria-labelledby="licenciaD3" data-parent="#licenciaD">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Tractores y maquinaria.</div>
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
            <h2 class="card-title bgc-info-d3 text-white brc-black-tp7">
                <a class="btn btn-info bgc-info-d1 accordion-toggle radius-0 d-style border-l-5 btn-brc-tp" href="#licencias_E" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne5">
                    <i class="d-collapsed fa fa-plus-square mr-1 text-105 text-white"></i>
                    <i class="d-n-collapsed fa fa-minus-square mr-1 text-105 text-white"></i> Licencias de conducir de clase E:
                </a>
            </h2>
        </div>
        <div id="licencias_E" class="collapse" aria-labelledby="licenciasE" data-parent="#accordionExample5">
            <div class="card-body p-0">
                <!-- sub group -->
                <div class="card bcard h-auto">
                    <div class="card-body p-0 bgc-white">
                        <div class="accordion" id="licenciaE">
                            <div class="card border-0">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaE1">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle collapsed pl-5" href="#licenciaE_1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo E-1:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaE_1" class="collapse" aria-labelledby="licenciaE1" data-parent="#licenciaE">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Universales.
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 mt-1px">
                                <div class="card-header border-0 bgc-transparent mb-0" id="licenciaE2">
                                    <h2 class="card-title text-info-d2">
                                        <a class="btn btn-white btn-h-lighter-info btn-a-lighter-info accordion-toggle pl-5 collapsed" href="#licenciaE_2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo50">
                                            <i class="fa fa-angle-right toggle-icon mr-15"></i> Tipo E-2:
                                        </a>
                                    </h2>
                                </div>
                                <div id="licenciaE_2" class="collapse" aria-labelledby="licenciaE2" data-parent="#licenciaE">
                                    <div class="card-body pl-5 pt-1 ml-2 text-justify">Universales.
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
<script type="module">
    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "dd/mm/yyyy"
    };

    //Dfecha mascara
    $('.input-daterange').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es'
    });
    $(":input:not(select)").inputmask();
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
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

</script>
