@extends('Layouts.menuPanel')

@section('page-content')

    @if($cantidad == 0)
        <div class="alert alert-warning">
            La lista de usuarios está vacía.
        </div>
    @else
        <div class="d-flex flex-row-reverse">
            <div class="py-2">
                <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg" data-display="static">
                    <input type="text" class="form-control mr-n3 pr-5" placeholder="Filtros de búsqueda" readonly/>

                    <a data-display="static" href="#" class="align-self-center btn border-0 btn-outline-default py-1 px-2 btn-h-light-primary btn-a-light-primary radius-1 ml-n35" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-filter"></i>
                    </a>

                    <div style="width: 24rem; max-width: 90vw;" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                        <div class="dropdown-inner">
                            <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                Search Filters
                            </h5>

                            <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{route('usuarios.index')}}">
                                @csrf
                                <div class="dropdown-body my-25 px-3">
                                    <div class="px-2 px-md-3">
                                        <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar ..." />
                                    </div>

                                    <hr class="brc-default-l3" />

                                    <div class="d-flex align-items-center px-2 px-md-3">
                                        <div class="mr-4">Buscar por:</div>
                                        <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="columna">
                                            <option value="name">Nombre</option>
                                            <option value="usuario">Usuario</option>
                                            <option value="extension">Extensión</option>
                                            <option value="nombre_departamento">Departamento</option>
                                            <option value="rol">Rol</option>
                                        </select>
                                    </div>

                                    <hr class="brc-default-l3" />

                                    <div class="d-flex align-items-center px-2 px-md-3">
                                        <div class="mr-4">Estado:</div>
                                        <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="estado">
                                            <option value="0"> ------ </option>
                                            <option value="ACTIVO">Activo</option>
                                            <option value="INACTIVO">Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                    <button type="submit" class="btn px-4 py-15 text-95 btn-default">
                                        Buscar
                                    </button>
                                    <button type="reset" class="btn px-25 py-15 text-95 btn-outline-default">
                                        Limpiar filtros
                                    </button>
                                </div>
                            </form>
                        </div><!-- .dropdown-inner -->
                    </div>
                </div>
            </div>
            <div class="p-2">
                <a href="{{route('usuarios.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100">
                    <i class="nav-icon fa fa-retweet"></i>
                </a>
            </div>
        </div>
        <div class="table-responsive">

            <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                <tr>
                    <th class="text-center">
                        Nombre
                    </th>

                    <th  class="text-center">
                        Usuario
                    </th>

                    <th class="text-center">
                        Correo
                    </th>

                    <th class="text-center">
                        Extensión
                    </th>

                    <th class="text-center">
                        Nombre de departamento
                    </th>

                    <th class="text-center">
                        Rol
                    </th>

                    <th class='text-center'>
                        Estado
                    </th>

                    <th  class="text-center">
                        Acción
                    </th>
                </tr>
                </thead>

                <tbody class="mt-1">
                @foreach($usuarios as $user)
                    <tr class="bgc-h-blue-l4 d-style">
                        <td class='text-grey-d1 align-middle'>
                            {{ $user->name }}
                        </td>
                        <td class='text-grey-d1 align-middle'>
                            {{ $user->usuario }}
                        </td>
                        <td class='text-grey-d1 align-middle'>
                            {{ $user->email }}
                        </td>
                        <td class='text-grey-d1 text-center align-middle'>
                            {{ $user->extension }}
                        </td>
                        <td class='text-grey-d1 text-center align-middle'>
                            {{ $user->nombre_departamento }}
                        </td>
                        <td class='text-grey-d1 text-center align-middle'>
                            {{ $user->rol }}
                        </td>
                        <td class='text-grey-d1 text-center align-middle'>
                            @if($user->status == 'ACTIVO')
                                <span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>
                            @else
                                <span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Inactivo</span>
                            @endif
                        </td>
                        <td class=" align-middle">
                            <div class='d-none d-lg-flex float-right'>
                                <a href="#" data-toggle="modal" data-target="#dangerModal{{ $user->usuario }}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>

                            <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                                <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </a>

                                <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                    <div class="dropdown-inner">
                                        <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                            {{ __('Acción') }}
                                        </div>
                                        <a href="#" data-toggle="modal" data-target="#dangerModal{{ $user->usuario }}"  class="dropdown-item">
                                            <i class="fa fa-eye text-blue mr-1 p-2 w-4"></i>
                                            {{ __('Ver detalles') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{ $user->usuario }}" tabindex="-1" role="dialog" aria-labelledby="primaryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content bgc-transparent brc-primary-m2 shadow">
                                        <div class="modal-header py-2 bgc-primary-tp1 border-0  radius-t-1">
                                            <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="primaryModalLabel">
                                                {{ $user->name }}
                                            </h5>
                                        </div>


                                        <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                            <div class="d-flex align-items-top mr-2 mr-md-5">
                                                No hay datos registrados
                                            </div>
                                        </div>

                                        <div class="modal-footer bgc-white-tp2 border-0">
                                            <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        @if ($cantidad > 0)
        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <span class="text-nowrap text-grey-d2">
                    Mostrando {{ $porPagina > 0 ? min(($paginaActual - 1) * $porPagina + 1, $totalRegistros) : 0 }} - {{ min($paginaActual * $porPagina, $totalRegistros) }} de {{ $totalRegistros }}
                </span>

                <form action="{{ route('usuarios.index') }}" method="GET" class="ml-3">
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
                        <li class="page-item"><a class="page-link" href="{{ route('usuarios.index', ['page' => $paginaActual - 1, 'porPagina' => $porPagina]) }}"><i class="fa fa-arrow-left"></i></a></li>
                    @endif

                    @for ($i = 1; $i <= ceil($totalRegistros / $porPagina); $i++)
                        <li class="page-item {{ $paginaActual == $i ? 'active' : '' }}"><a class="page-link" href="{{ route('usuarios.index', ['page' => $i, 'porPagina' => $porPagina]) }}">{{ $i }}</a></li>
                    @endfor

                    @if ($paginaActual < ceil($totalRegistros / $porPagina))
                        <li class="page-item"><a class="page-link" href="{{ route('usuarios.index', ['page' => $paginaActual + 1, 'porPagina' => $porPagina]) }}"><i class="fa fa-arrow-right"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
        @endif
    @endempty
@endsection
