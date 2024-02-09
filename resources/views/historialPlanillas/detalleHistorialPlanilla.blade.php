@extends('Layouts.menu')

@section('head')
    <meta name="csrf_token" id="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('page-content')
    <div class="d-flex flex-column flex-lg-row justify-content-start justify-content-lg-between align-items-end">
        <div class="col-lg-2 px-0">
            <div class="row">
                <div class="form-group col-12 col-lg mb-0 mt-1 mt-md-0">
                    <label class="text-primary-d1 text-95">Salario Devengado</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="spanSignoMoneda input-group-text">
                                @if($resultadoPlanilla->moneda == "colones")
                                    &cent;
                                @else
                                    &dollar;
                               @endif
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ number_format($resultadoPlanilla->planilla_total_devengado, 2, ".", " ") }}" readonly/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 my-2 my-lg-0 px-0 px-lg-2 text-nowrap">
            <span class="mt-35">
                <a href="{{
                    route('descargaArchivoBancario',[
                        Crypt::encrypt($idPlanilla)
                    ]) }}"
                    class="ajax-popup-link btn px-2 btn-light-orange font-bolder letter-spacing text-95">
                    Archivo Bancario
                </a>
            </span>
        </div>
        <div class="col-lg-4 ml-lg-2">
            <div class="d-inline-flex float-right ml-sm-0">
                <div class="d-flex flex-row-reverse">
                    <div class="px-1">
                        <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg h-100" data-display="static">
                            <input type="text" class="form-control mr-n3 pr-5 h-100" placeholder="Filtros de búsqueda" readonly/>

                            <a data-display="static" href="#" class="align-self-center btn border-0 btn-outline-default py-1 px-2 btn-h-light-primary btn-a-light-primary radius-1 ml-n35" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter"></i>
                            </a>

                            <div style="width: 24rem; max-width: 90vw;" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Search Filters
                                    </h5>

                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{ Request::url() }}">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="orden">
                                                    <option value="nombre" @if($orden=="nombre") selected @endif>Nombre</option>
                                                    <option value="identificacion" @if($orden=="identificacion") selected @endif>Identificación</option>
                                                </select>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Tipo de orden:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="tipo_orden">
                                                    <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente</option>
                                                    <option value="DESC" @if($tipo_orden=="DESC") selected @endif>Descendente</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                            <button type="reset" class="btn px-25 py-15 text-95 btn-outline-default">
                                                Limpiar filtros
                                            </button>
                                            <button type="submit" class="btn px-4 py-15 text-95 btn-default">
                                                Buscar
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- .dropdown-inner -->
                            </div>
                        </div>
                    </div>

                    <div class="px-1">
                        <a title="Recargar" href="{{Request::url()}}" class="btn btn-yellow btn-sm  h-100 d-inline-flex align-items-center">
                            <i class="fa fa-retweet text-115"></i>
                        </a>
                    </div>

                    <div class="px-1">
                        <a id="descargar_excel" title="Exportar Excel" href="#" class="btn btn-success btn-sm h-100 d-inline-flex align-items-center">
                            <i class="fa fa-file-excel text-115 px-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="text" value="{{ route('detalleHistorialPlanillaPost', [Crypt::encrypt($idPlanilla)]) }}" id="url_detalleHistorialPlanillaPost" hidden="true">
    <input type="text" value="{{ route('exportarExcelDetalleHistorialPlanilla') }}" data-id-encrypt="{{ Crypt::encrypt($idPlanilla) }}" id="url_exportarExcelDetalleHistorialPlanilla" hidden="true">
    <input type="text" value="{{ route('exportarArchivoTxtBancoHistorialPlanilla') }}" id="url_exportarArchivoTxtBancoHistorialPlanilla" hidden="true">
    <input type="text" value="{{ $cantidad }}" data-historial-planilla="true" id="cantidad" hidden="true">
    <input type="text" value="{{ $paginaActual }}" data-historial-planilla="true" id="paginaActual" hidden="true">
    <input type="text" value="{{ $buscar }}" data-historial-planilla="true" id="buscar" hidden="true">
    <input type="text" value="{{ $orden }}" data-historial-planilla="true" id="orden" hidden="true">
    <input type="text" value="{{ $tipo_orden }}" data-historial-planilla="true" id="tipo_orden" hidden="true">
    <div id="tablas">
    </div>

    @include('componentes.modalCargando')
@endsection

