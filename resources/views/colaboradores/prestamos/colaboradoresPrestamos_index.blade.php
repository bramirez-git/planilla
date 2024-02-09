@extends('Layouts.menu')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a href="{{ route('colaboradoresPrestamos.create', ["id_colaborador" => $idColaborador]) }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                </span>
                Agregar Préstamo
            </a>
        </div>

        <div class="text-nowrap align-self-start pl-md-2">
            <div class="text-nowrap align-self-start pl-md-2">
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

                                        <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{route('colaboradoresPrestamos.index')}}">
                                            @csrf

                                            <input type="hidden" id="id_colaborador" name="id_colaborador" value="{{ $idColaborador }}"/>
                                            <div class="dropdown-body my-25 px-3">
                                                <div class="px-2 px-md-3">
                                                    <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                                </div>

                                                <hr class="brc-default-l3" />

                                                <div class="d-flex align-items-center px-2 px-md-3">
                                                    <div class="mr-4">Ordenar por:</div>
                                                    <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="orden">
                                                        <option value="concepto" @if($orden=="concepto") selected @endif>Concepto</option>
                                                        <option value="monto" @if($orden=="monto") selected @endif>Monto pr&eacute;stamo</option>
                                                        <option value="fecha_inicio" @if($orden=="fecha_inicio") selected @endif>Fecha inicio</option>
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
                            <a href="{{route('colaboradoresPrestamos.index', ["id_colaborador" => $idColaborador])}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100">
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
    </div>

    <div class="table-responsive">

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
           <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Concepto Préstamo
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Monto del préstamo
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Fecha de préstamo
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Cantidad de cuotas
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Tasa de interés anual
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            @foreach($resultado as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                     <td data-label="Concepto Préstamo:" class='text-grey-d1 text-md-center small'>
                         {{ $datos->concepto }}
                    </td>

                    <td data-label="Monto del préstamo:" class='text-grey-d1 text-right text-md-center'>
                        <span class="badge badge-primary badge-md mb-2">
                            @if($datos->codigo == "COL")
                                &cent;
                            @else
                                &dollar;
                            @endif
                            @php echo number_format($datos->monto, 2, ".", " "); @endphp
                        </span>
                    </td>

                    <td data-label=" Fecha de préstamo:" class='text-grey-d1 text-right text-md-center small'>
                        @php echo date("d/m/Y", strtotime($datos->fecha_inicio)); @endphp
                    </td>

                    <td data-label="Cantidad de cuotas:" class='text-grey-d1 text-right text-md-center small'>
                        {{ $datos->cantidad_cuotas }}
                    </td>

                    <td data-label=" Tasa de interés:" class='text-grey-d1 text-right text-md-center small'>
                        {{ $datos->tasa_interes }}%
                    </td>

                     <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a href="{{ route('verDetallePrestamo',[Crypt::encrypt($datos->id_colaborador), Crypt::encrypt($datos->id_prestamo)]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        {{ __('Acción') }}
                                    </div>
                                    <a href="{{ route('verDetallePrestamo',[$datos->id_colaborador, $datos->id_prestamo]) }}" class="dropdown-item">
                                        <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                        {{ __('Mostrar detalle préstamo') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('componentes.paginacion')
@endsection

@push('scripts')
    <script type="module">
        $('#descargar_excel').on('click', function (evt){
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('descargarExcelPrestamos') }}",
                data: {
                    "id_colaborador": '{{  $idColaborador }}'
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
