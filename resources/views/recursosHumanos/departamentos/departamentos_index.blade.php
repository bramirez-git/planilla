@extends('Layouts.menu')

@section('page-content')

@if($resultado->isEmpty())

<div class="d-flex flex-column flex-md-row justify-content-between">
    <div class="text-nowrap align-self-start mb-sm-0 pb-4">
        <a href="{{ route('departamentos.create') }}"
            class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
            </span>
            Agregar Departamento
        </a>
    </div>

    <div class="text-nowrap align-self-start pl-md-2">
        <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
            <div class="d-flex flex-row-reverse">
                <div class="px-1">
                    <button id="descarga_excel_departamentos"
                        class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                        <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                            <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                        </span>
                        Exportar excel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-warning">
    La lista de Departamentos está vacía.
</div>
@else
<div class="d-flex flex-column flex-md-row justify-content-between">
    <div class="text-nowrap align-self-start mb-sm-0 pb-4">
        <a href="{{ route('departamentos.create') }}"
            class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
            </span>
            Agregar Departamento
        </a>
    </div>

    <div class="text-nowrap align-self-start pl-md-2">
        <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
            <div class="d-flex flex-row-reverse">
                <div class="px-1">
                    <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg h-100" data-display="static">
                        <input type="text" class="form-control mr-n3 pr-5 h-100" placeholder="Filtros de búsqueda"
                            readonly />

                        <a data-display="static" href="#"
                            class="align-self-center btn border-0 btn-outline-default py-1 px-2 btn-h-light-primary btn-a-light-primary radius-1 ml-n35"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-filter"></i>
                        </a>

                        <div style="width: 24rem; max-width: 90vw;" data-display="static"
                            class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                            <div class="dropdown-inner">
                                <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                    Search Filters
                                </h5>

                                <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET"
                                    action="{{route('departamentos.index')}}">
                                    @csrf
                                    <div class="dropdown-body my-25 px-3">
                                        <div class="px-2 px-md-3">
                                            <input type="text" id="buscar" name="buscar" value="{{ $buscar }}"
                                                class="form-control" placeholder="Buscar ..." />
                                        </div>

                                        <hr class="brc-default-l3" />

                                        <div class="d-flex align-items-center px-2 px-md-3">
                                            <div class="mr-4">Ordenar por:</div>
                                            <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3"
                                                name="orden">
                                                <option value="codigo" @if($orden=="codigo" ) selected @endif>Código
                                                </option>
                                                <option value="nombre" @if($orden=="nombre" ) selected @endif>Nombre
                                                </option>
                                            </select>
                                        </div>

                                        <hr class="brc-default-l3" />

                                        <div class="d-flex align-items-center px-2 px-md-3">
                                            <div class="mr-4">Tipo de orden:</div>
                                            <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3"
                                                name="tipo_orden">
                                                <option value="ASC" @if($tipo_orden=="ASC" ) selected @endif>Ascendente
                                                </option>
                                                <option value="DESC" @if($tipo_orden=="DESC" ) selected @endif>
                                                    Descendente</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div
                                        class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
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
                    <a href="{{route('departamentos.index')}}"
                        class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100">
                        <i class="nav-icon fa fa-retweet"></i>
                    </a>
                </div>

                <div class="px-1">
                    <button id="descarga_excel_departamentos"
                        class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                        <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                            <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                        </span>
                        Exportar excel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive border-t-3 brc-blue-m2">

    <table id="simple-table"
        class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
        <thead class="border-b-1 brc-default-l3 bgc-blue-l4 text-90">
            <tr>
                <th class="text-left">
                    Nombre Departamento
                </th>

                <th class="d-none d-sm-table-cell text-left">
                    Código de Departamento
                </th>

                <th class="d-none d-sm-table-cell text-left">
                    Encargado
                </th>

                <th class="text-left">
                    Estado
                </th>

                <th class="text-left">
                    Acción
                </th>
            </tr>
        </thead>

        <tbody class="mt-1">
            @foreach($resultado as $datos)

            <tr class="bgc-h-blue-l4 d-style">

                <td class='text-grey-d1'>
                    {{ $datos->nombre }}
                </td>

                <td class='d-none d-sm-table-cell  font-bold text-info'>
                    {{ $datos->codigo }}
                </td>

                <td class='d-none d-sm-table-cell text-grey text-95'>
                    {{ $datos->nombre_jefe }}
                </td>

                <td class='d-sm-table-cell'>
                    @if($datos->estado == "activo")
                    <span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>
                    @else
                    <span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Inactivo</span>
                    @endif
                </td>

                <td class="float-left">

                    <form method="POST" id="frm-destroy-departamento-{{$datos->id_departamento}}" action="{{ route('departamentos.destroy',[$datos->id_departamento]) }}">
                        @csrf
                        @method('DELETE')
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex float-right'>
                            <a href="{{ route('departamentos.edit',[Crypt::encrypt($datos->id_departamento)]) }}"
                                class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a data-form-id="{{$datos->id_departamento}}"
                                class="eliminar-departamento mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a href="{{ route('departamentos.edit',[Crypt::encrypt($datos->id_departamento)]) }}"
                                        class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        {{ __('Editar') }}
                                    </a>
                                    <a data-form-id="{{$datos->id_departamento}}" class="eliminar-departamento dropdown-item">
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
@include('componentes.paginacion')
@endif
@endsection
