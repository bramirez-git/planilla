@extends('Layouts.menuPanel')

@section('page-content')
    <div class="row mb-475">
        <div class="col-sm-12 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden">
                <div class="card-header align-items-center">
                    <h3 class="card-title text-125">
                        <i class="nav-icon fa fa-store"></i>
                        Marketplace
                    </h3>
                </div>

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                                <a href="{{ route('marketplace.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                                    Agregar nuevo producto
                                </a>
                            </div>

                            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                                <div class="d-flex flex-row-reverse">
                                @if ($cantidad > 0)

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

                                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{route('marketplace.index')}}">
                                                        @csrf
                                                        <div class="dropdown-body my-25 px-3">
                                                            <div class="px-2 px-md-3">
                                                                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                                            </div>

                                                            <hr class="brc-default-l3" />

                                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                                <div class="mr-4">Ordenar por:</div>
                                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="orden">
                                                                    <option value="nombre" @if($orden=="nombre") selected @endif>Nombre de módulo</option>
                                                                    <option value="precio" @if($orden=="precio") selected @endif>Precio</option>
                                                                    <option value="estado" @if($orden=="estado") selected @endif>Estado</option>
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
                                @endif

                                    <div class="px-1">
                                        <a href="{{route('marketplace.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100">
                                            <i class="nav-icon fa fa-retweet"></i>
                                        </a>
                                    </div>

                                    <div class="px-1">
                                        <button id="descarga_excel_marketplace" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                        <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                            <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                                        </span>
                                            Exportar excel
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive border-t-3 brc-blue-m2" style="position: sticky;">
                        @if ($cantidad > 0)
                        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                                <tr>

                                    <!-- <th class="d-none d-sm-table-cell col-sm-1 text-center">
                                        Id pruducto
                                    </th> -->

                                    <th class="col-sm-2 text-center">
                                        Nombre del m&oacute;dulo
                                    </th>

                                    <th class='d-none d-md-table-cell text-95 text-center'>
                                        Descripci&oacute;n
                                    </th>

                                    <th class="d-sm-table-cell col-sm-2 text-center">
                                        Precio
                                    </th>

                                    <th class="d-sm-table-cell col-sm-2 text-center">
                                       Estado de producto
                                    </th>

                                    <th class="col-sm-2 text-center">
                                        Acción
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="mt-1">

                                    @foreach ( $resultado as $producto)
                                        <tr class="bgc-h-blue-l4 d-style">

                                       <!--  <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                                          {{$producto->id_servicio}}
                                        </td> -->

                                        <td data-label=" Nombre del m&oacute;dulo:" class='text-grey-d1 text-right text-md-center'>
                                            <a href='#' class='text-secondary-d2 text-95 text-600' style="cursor: auto;">
                                                <span class="text-95 text-primary-d2 p-1 text-capitalize">
                                                    <strong>{{$producto->nombre}}</strong>
                                                </span>
                                            </a>
                                        </td>

                                        <td class='d-none d-md-table-cell text-95 text-center'>
                                            {{$producto->descripcion}}

                                        </td>


                                        <td data-label="Precio:" class='text-grey-d1 text-right text-md-center'>
                                            $ {{$producto->precio}}
                                        </td>

                                        <td data-label="Estado de producto:" class='text-grey-d1 text-right text-md-center'>
                                            <span class="badge badge-sm bgc-{{ $producto->estado === 'activo' ? 'green' : 'red' }}-d1 text-white pb-1 px-25 rounded-pill">{{ ucfirst($producto->estado) }}</span>
                                        </td>


                                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center'>

                                            <form method="POST" id="frm-destroy-marketplace-{{$producto->id_servicio}}" action="{{ route('marketplace.destroy',[$producto->id_servicio]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <!-- action buttons -->
                                                <div class='d-none d-lg-flex float-right'>
                                                    <a href="{{ route('marketplace.edit',[Crypt::encrypt($producto->id_servicio)]) }}"
                                                        class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>

                                                    <a data-form-id="{{$producto->id_servicio}}"
                                                        class="eliminar-producto mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                </div>

                                                <!-- show a dropdown in mobile -->
                                                <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                                                    <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle'
                                                        data-toggle="dropdown">
                                                        <i class="fa fa-cog"></i>
                                                    </a>

                                                    <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                                        <div class="dropdown-inner">
                                                            <div
                                                                class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                                                {{ __('Acción') }}
                                                            </div>
                                                            <a href="{{ route('marketplace.edit',[Crypt::encrypt($producto->id_servicio)]) }}"
                                                                class="dropdown-item">
                                                                <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                                {{ __('Editar') }}
                                                            </a>
                                                            <a data-form-id="{{$producto->id_servicio}}" class="eliminar-producto dropdown-item">
                                                                <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                                                {{ __('Eliminar') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        @else
                            <div class="alert alert-warning">
                                No hay productos que mostrar.
                            </div>
                         @endif

                        <!-- table footer -->
                        @if ($cantidad > 0)
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="d-flex flex-column flex-md-row align-items-center">
                                <span class="text-nowrap text-grey-d2">
                                    Mostrando {{ $porPagina > 0 ? min(($paginaActual - 1) * $porPagina + 1, $totalRegistros) : 0 }} - {{ min($paginaActual * $porPagina, $totalRegistros) }} de {{ $totalRegistros }}
                                </span>

                                <form action="{{ route('marketplace.index') }}" method="GET" class="ml-3">
                                    <select name="porPagina" class="ace-select no-border angle-down brc-h-blue-m3 w-auto pr-45 text-secondary-d3" onchange="this.form.submit()">
                                        <option value="5" {{ $porPagina == 5 ? 'selected' : '' }}>Mostrar 5</option>
                                        <option value="10" {{ $porPagina == 10 ? 'selected' : '' }}>Mostrar 10</option>
                                        <option value="20" {{ $porPagina == 20 ? 'selected' : '' }}>Mostrar 20</option>
                                        <option value="50" {{ $porPagina == 50 ? 'selected' : '' }}>Mostrar 50</option>
                                    </select>
                                </form>
                            </div>

                            <div class="btn-group align-self-center align-self-sm-start pt-3">
                                <ul class="pagination">
                                    @if ($paginaActual > 1)
                                        <li class="page-item"><a class="page-link" href="{{ route('marketplace.index', ['page' => $paginaActual - 1, 'porPagina' => $porPagina]) }}"><i class="fa fa-arrow-left"></i></a></li>
                                    @endif

                                    @for ($i = 1; $i <= ceil($totalRegistros / $porPagina); $i++)
                                        <li class="page-item {{ $paginaActual == $i ? 'active' : '' }}"><a class="page-link" href="{{ route('marketplace.index', ['page' => $i, 'porPagina' => $porPagina]) }}">{{ $i }}</a></li>
                                    @endfor

                                    @if ($paginaActual < ceil($totalRegistros / $porPagina))
                                        <li class="page-item"><a class="page-link" href="{{ route('marketplace.index', ['page' => $paginaActual + 1, 'porPagina' => $porPagina]) }}"><i class="fa fa-arrow-right"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>


                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
