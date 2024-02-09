@extends('Layouts.menuPanel')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
        </div>

        <div class="text-nowrap align-self-start pl-md-2">
            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                <div class="d-flex flex-row-reverse">
                    <div class="px-1">
                        <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg h-100" data-display="static">
                            <input type="text" class="form-control mr-n3 pr-5 h-100" placeholder="Filtros de búsqueda" readonly/>

                            <a data-display="static" href="#" class="align-self-center btn border-0 btn-outline-default py-1 px-2 btn-h-light-primary btn-a-light-primary radius-1 ml-n35" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter"></i>
                            </a>

                            <div style="width:400px;" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Search Filters
                                    </h5>

                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" id="frm_filros" action="">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[orden]">
                                                    <option value="" @if($orden=="") selected @endif>Seleccionar orden</option>
                                                    <option value="codigo" @if($orden=="codigo") selected @endif>Codigo</option>
                                                    <option value="categoria_perfil_ocupacional" @if($orden=="categoria_perfil_ocupacional") selected @endif>Ocupación</option>
                                                </select>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Tipo de orden:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[tipo_orden]">
                                                    <option value="" @if($tipo_orden=="") selected @endif>Seleccionar tipo de orden</option>
                                                    <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente</option>
                                                    <option value="DESC" @if($tipo_orden=="DESC") selected @endif>Descendente</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                            <button type="submit" class="btn px-4 py-15 text-95 btn-default btn-modal-cargando">
                                                Buscar
                                            </button>
                                            <a id="limpiarCampos" class="btn px-25 py-15 text-95 btn-outline-default">
                                                Limpiar filtros
                                            </a>
                                        </div>
                                    </form>
                                </div><!-- .dropdown-inner -->
                            </div>
                        </div>
                    </div>

                    <div class="px-1">
                        <a href="{{route('configuracionCatalogoINS.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>

                        <div class="px-1">
                            <div class="dropdown d-inline-block h-100">
                                <button class="btn btn-outline-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Más acciones
                                    <i class="fa fa-angle-down ml-2 text-90"></i>
                                </button>
                                <div class="dropdown-menu dropdown-caret">
                                    @if(!$resultado->isEmpty())
                                    <button id="descarga_excel_INS" class="dropdown-item">Descargar excel</button>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('configuracionCatalogoINS.create') }}">Subir excel</a>
                                    <a href="{{ route('descargarPlantilla') }}" class="dropdown-item">Descargar plantilla de excel</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    @if($resultado->isEmpty())
        <div class="alert alert-warning">
            No se encuentran registros
        </div>
    @else
        <div class="table-responsive border-t-3 brc-blue-m2">

            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                <tr>
                    <th class="text-left text-secondary-d2 text-95 text-600">
                        Código
                    </th>

                    <th  class="d-none d-sm-table-cell text-left text-secondary-d2 text-95 text-600">
                        Ocupación
                    </th>
                </tr>
                </thead>

                <tbody class="mt-1">
                @foreach($resultado as $datos)
                    <tr class="bgc-h-blue-l4 d-style">
                        <td class='d-none d-sm-table-cell text-primary text-grey-d1 align-middle'>
                            <strong>{{ $datos->codigo }}</strong>
                        </td>
                        <td class='d-none d-sm-table-cell text-grey-d1 align-middle'>
                            {{ $datos->categoria_perfil_ocupacional }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.paginacion')
    @endif
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function(){
            $(".btn-modal-cargando").on("click", function () {
                $('#cargando').modal('show');
            });

            $("#limpiarCampos").on("click", function () {
                // Obtener el formulario por su ID
                const form = $("#frm_filros");

                // Limpiar los campos estableciendo su valor en cadena vacía
                form.find("input[type=text]").val('');
                form.find("select").each(function () {
                    // Establecer la opción por posición (índice) 1 (Opción 2) para cada elemento <select>
                    $(this).prop("selectedIndex", 0)
                });
            });

        });
    </script>
@endpush
