@extends('Layouts.menu')

@section('page-content')
    <div class="d-flex flex-column flex-md-row justify-content-end">
        <div class="text-nowrap align-self-end pl-md-2">
            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
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

                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{route('historialPlanillas')}}">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="orden">
                                                    <option value="fecha" @if($orden=="fecha") selected @endif>Fecha Creaci&oacute;n</option>
                                                    <option value="tipo_planilla" @if($orden=="tipo_planilla") selected @endif>Tipo Planilla</option>
                                                    <option value="moneda" @if($orden=="moneda") selected @endif>Moneda</option>
                                                    <option value="monto" @if($orden=="monto") selected @endif>Monto Total</option>
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
                        <a href="{{ route('historialPlanillas') }}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>

                    <div class="px-1">
                        <a id="descargar_excel" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                            </span>
                            Exportar excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
        <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th class="text-center text-secondary-d2 text-95 text-600">
                    Fecha Creación
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Tipo Planilla
                </th>

                <th class="d-none d-sm-table-cell text-center text-secondary-d2 text-95 text-600">
                    Periodo
                </th>

                <th class="d-none d-sm-table-cell text-center text-secondary-d2 text-95 text-600">
                    Moneda
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Monto Total Planilla
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600" colspan="2" style="width:15%;">
                    <span class="mr-5">Acción</span>
                </th>
            </tr>
        </thead>

        <tbody class="mt-1">
            @php
                $contador = 0;
            @endphp

            @if(count($resultado) > 0)
                @foreach($resultado as $datos)
                    <tr class="bgc-h-blue-l4 d-style">
                        <td data-label="Fecha Creación:" class="text-center">
                            <span class="text-95 text-primary-d2 p-1 text-capitalize">
                                {{ date("d/m/Y", strtotime($datos->fecha_creacion)) }}
                            </span>
                        </td>

                        <td data-label="Tipo Planilla:" class="text-grey-d1 text-center text-md-center">
                            {{ $datos->nombre_tipo_planilla }}
                        </td>

                        <td data-label="Periodo:" class="text-grey-d1 text-center text-md-center">
                            {{ $datos->nombre_periodo }}
                        </td>

                        <td data-label="Moneda:" class="text-grey-d1 text-center text-md-center">
                            {{ ucfirst($datos->moneda) }}
                        </td>

                        <td data-label="Monto Total Planilla:" class="text-grey-d1 text-center text-md-center">
                            @if($datos->moneda == "colones")
                                &cent;
                            @else
                                &dollar;
                            @endif
                            {{ number_format($datos->monto_planilla, 2, ".", " ") }}
                        </td>

                        <td data-label="Acción:" class="text-grey-d1 text text-md-center">
                            <div class="d-none d-lg-flex ml-5">
                                @php
                                    $nombre_tooltip = "Cierre Mensual Planilla";
                                    /*if($datos->periodo_planilla == "mes_completo"){
                                        $nombre_tooltip = "Cierre Mensual Planilla";
                                    }else{
                                        $nombre_tooltip = "Auxiliares";
                                    }*/
                                @endphp

                                <!--if($datos->periodo_planilla != "mes_completo")
                                    <a href="{ route('detalleHistorialPlanilla', [Crypt::encrypt($datos->id_planilla), 0]) }}" class="mr-1 btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-primary btn-a-lighter-success tooltip-info" data-rel="tooltip" data-placement="bottom" title="{ $nombre_tooltip }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                endif-->
                            </div>
                        </td>

                        @php
                            $contador++;
                        @endphp


                        <td class="align-middle text-center bgc-grey-l3">
                            <a href="{{ route('detalleHistorialPlanilla', [Crypt::encrypt($datos->id_planilla), 0]) }}" class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="{{ $nombre_tooltip }}">
                                    <span class="badge btn-primary badge-lg arrowed">
                                        <i class="fa fa-calendar-alt"></i>
                                    </span>
                            </a>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @include('componentes.paginacion')

    <div class="mt-3"></div>
@endsection

@push("scripts")
    <script type="module">
        $('#descargar_excel').on('click', function (evt){
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('exportarExcelHistorialPlanillas') }}",
                data: {
                    "accion": 'descargar_excel_historial_planilla'
                },
                beforeSend: function() {
                    $("#cargando").modal("show");
                },
                success: function(url_excel){
                    if(url_excel != ""){
                        window.open(url_excel, "_self");
                        return false;
                    }
                },
                complete: function(response) {
                    $("#cargando").modal("hide");
                },
                error: function (response) {
                    alert(response.responseJSON.message);
                }
            });
        });
    </script>
@endpush
