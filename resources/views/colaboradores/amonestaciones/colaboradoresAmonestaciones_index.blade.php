@extends('Layouts.menu')
@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <form method="GET" action="{{ route('colaboradoresAmonestaciones.create') }}">
                @csrf
                <input type="text" name="id_colaborador" value="{{Crypt::encrypt($id_colaborador)}}" hidden>
                <button type="submit" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                            </span>
                    Agregar Amonestación
                </button>
            </form>
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
                            <div data-display="static" style="width: 400px;" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Filtros de búsqueda </h5>
                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" id="frm_filtros" action="{{route('clientes.index')}}">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" value="{{ $buscar ?? '' }}" name="buscar" class="form-control" placeholder="Buscar ..."/>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[orden]">
                                                    <option value="concepto" @if($orden=="concepto") selected @endif>Concepto</option>
                                                    <option value="fecha" @if($orden=="fecha") selected @endif>Fecha</option>
                                                </select>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Tipo de orden:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[tipo_orden]">
                                                    <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente</option>
                                                    <option value="DESC" @if($tipo_orden=="DESC") selected @endif>Descendente</option>
                                                </select>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                        </div>
                                        <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                            <button class="btn px-4 py-15 text-95 btn-default">
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
                        <a href="{{route('clientes.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>
                    @if(!$resultado->isEmpty())
                        <div class="px-1">
                            <a href="{{ $resultadoExcel}}" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                            </span>
                                Exportar excel
                            </a>
                        </div>
                    @endif
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

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Nombre de la amonestación
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Fecha de amonestación
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Clasificación
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Tipo
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Descripción
                </th>

{{--                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">--}}
{{--                    Documento asociado--}}
{{--                </th>--}}

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            @foreach($resultado as $datos)
            <tr class="bgc-h-blue-l4 d-style">

                <td data-label="Nombre de la amonestación:" class='text-grey-d1 text-center text-md-center small'>
                    {{$datos->nombre ?? ""}}
                </td>

                <td data-label="Fecha de amonestación:" class='text-grey-d1 text-center text-md-center small'>
                    {{$datos->fecha ?? ""}}
                </td>

                <td data-label="Clasificación:" class='text-grey-d1 text-center text-md-center small'>
                    @if($datos->clasificacion==="leve")
                        <span class="badge badge-sm text-black pb-1 px-25 bgc-yellow-d1">Leve</span>
                    @elseif($datos->clasificacion=="grave")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-warning-d1">Grave</span>
                    @elseif($datos->clasificacion==="muy_grave")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-danger-d1">Muy Grave</span>
                    @endif
                </td>

                <td data-label="Tipo:" class='text-grey-d1 text-center text-md-center small'>
                    {{$datos->tipo ?? ""}}
                </td>

                <td data-label="Descripción:" class='text-grey-d1 text-center text-md-center small'>
                    <p>  {{$datos->descripcion ?? ""}}</p>
                </td>

{{--                <td data-label="Documento asociado:" class='text-grey-d1 text-center text-md-center small'>--}}
{{--                    Doc--}}
{{--                </td>--}}

                <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresAmonestaciones.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle amonestación" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
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
                                <a href="{{ route('colaboradoresAmonestaciones.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
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
    @endif
@endsection
@push('scripts')
    <script type="module">
        {{--$(document).ready(function() {--}}
        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}

        {{--    $.ajax({--}}
        {{--        type:'get',--}}
        {{--        url: "{{ route('generarPlanilla.show', [Crypt::encrypt($idPlanilla)]) }}",--}}
        {{--        data:{--}}
        {{--            'cantidad':{{$cantidad}},--}}
        {{--            'paginaActual':{{$paginaActual}},--}}
        {{--            'buscar':'{{$buscar}}',--}}
        {{--            'orden':'{{$orden}}',--}}
        {{--            'tipo_orden':'{{$tipo_orden}}'--}}
        {{--        },--}}
        {{--        beforeSend: function (){--}}
        {{--            waitingDialog.show();--}}
        {{--        },--}}
        {{--        success: (response) => {--}}
        {{--            $("#tablas").empty().append(response);--}}
        {{--        },--}}
        {{--        error: function(response){--}}
        {{--            alert(response);--}}
        {{--        },--}}
        {{--        complete: function (response){--}}
        {{--            waitingDialog.hide();--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endpush
