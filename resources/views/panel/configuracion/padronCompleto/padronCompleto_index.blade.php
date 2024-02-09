@extends('Layouts.menuPanel')

@section('page-content')
        <div class="">
            <div class="col-xs-12">
                <form action="{{ route("padron_show") }}" name="frm_padron_electoral" id="frm_padron_electoral" method="POST">
                    <h3 class="card-title text-115 text-green">
                        Filtros de Búsqueda
                    </h3>
                    <hr class="border-x-6">
                    <div id="frm_parametros1">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12">
                                <label for="nombre">Cédula</label>
                                <div class="form-group">
                                    <input type="text" name="filtros[cedula]" id="cedula" class="form-control" placeholder="Cédula"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="text-green-d1 border-0">
                    <hr class="border-6">
                    <div class="">
                        <div class="col-xs-12">
                            <button type="button" class="btn px-25 py-15 text-95 btn-outline-default btn-h-outline-default" onclick="waitingDialog.show(); window.location.reload(1);">
                                <i class="fas fa-undo"></i>&nbsp;Limpiar
                            </button>
                            <button type="submit" id="btn_buscar_contrato" class="btn px-25 py-15 text-95 btn-outline-default btn-h-outline-primary">
                                <i class="fa fa-filter"></i>&nbsp;Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr class="border border-l-1">
        <div id="tablas">
        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div class="text-nowrap align-self-start mb-sm-0 pb-4"></div>
            <div class="text-nowrap align-self-start pl-md-2">
                <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                    <div class="d-flex flex-row-reverse">
                        <div class="px-1"></div>
                        <div class="px-1"></div>
                        <div class="px-1">
                            <div class="dropdown d-inline-block h-100">
                                <button class="btn btn-outline-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Más acciones
                                    <i class="fa fa-angle-down ml-2 text-90"></i>
                                </button>
                                <div class="dropdown-menu dropdown-caret">
                                    <a class="dropdown-item" href="{{ route('configuracionPadronCompleto.create') }}">
                                        Subir padrón
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(empty($resultado))
            <div class="alert alert-lg bgc-blue-l4 border-0 border-t-3 brc-blue-m2 mb-3 radius-0 pr-3 py-3 d-flex">
                Aplique filtros para mostrar resultados
            </div>
        @endif
    </div>
@endsection

