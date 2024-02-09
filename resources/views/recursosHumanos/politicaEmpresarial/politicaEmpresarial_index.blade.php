@extends('Layouts.menu')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a href="{{ route('politicaEmpresarial.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                Agregar Políticas Empresariales
            </a>
        </div>

        <div class="text-nowrap align-self-start pl-md-2">
            <div class="d-inline-flex align-items-center ml-sm-0  mr-1 pb-4">
                <a href="#" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                        <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Exportar excel
                </a>
            </div>

            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                <i class="fa fa-search text-grey-m1 pos-abs ml-2"></i>
                <input type="text" class="form-control pl-425 h-5" placeholder="Buscar">
            </div>
        </div>
    </div>

    <div class="table-responsive">

        <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
            <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
            <tr>
                <th class="text-left">
                    Código de Documento
                </th>

                <th class="d-none d-sm-table-cell text-left">
                    Nombre del Documento
                </th>

                <th class="d-none d-sm-table-cell text-left">
                    Fecha de registro
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
            <tr class="bgc-h-blue-l4 d-style">

                <td class="text-600 text-orange-d2 text-left">
                    doc-Política-1
                </td>

                <td class="d-none d-sm-table-cell text-grey-d1 text-left">
                    Politica 1
                </td>

                <td class='d-none d-sm-table-cell text-grey-d1 text-left'>
                    20-08-2021
                </td>

                <td class='text-grey text-95 text-left'>
                    <span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Inactivo</span>
                </td>

                <td class="float-left">

                    <form method="POST" action="{{ route('politicaEmpresarial.destroy',['1']) }}">
                        @csrf
                        @method('DELETE')
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex float-right'>
                            <a href="{{ route('politicaEmpresarial.edit',['1']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                                <i class="fa fa-download"></i>
                            </a>

                            <a href="#" data-toggle="modal" data-target="#dangerModal{{'1'}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        {{ __('Acción') }}
                                    </div>
                                    <a href="{{ route('politicaEmpresarial.edit',['1']) }}" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        {{ __('Editar') }}
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-download text-orange mr-1 p-2 w-4"></i>
                                        {{ __('Descargar') }}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{'1'}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{'1'}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                    <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                        <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                            ¡Atención!
                                        </h5>

                                        <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-150">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                        <div class="d-flex align-items-top mr-2 mr-md-5">
                                            <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                            <div class="text-secondary-d2 text-105">
                                                ¿Está seguro que desea eliminar esta política empresarial?
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer bgc-white-tp2 border-0">
                                        <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                            Si
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">

                <td class="text-600 text-orange-d2 text-left">
                    doc-Política-2
                </td>

                <td class="d-none d-sm-table-cell text-grey-d1 text-left">
                    Politica 2
                </td>

                <td class='d-none d-sm-table-cell text-grey-d1 text-left'>
                    01-01-2022
                </td>

                <td class='text-grey text-95 text-left'>
                    <span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>
                </td>

                
                <td class="float-left">

                    <form method="POST" action="{{ route('politicaEmpresarial.destroy',['2']) }}">
                        @csrf
                        @method('DELETE')
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex float-right'>
                            <a href="{{ route('politicaEmpresarial.edit',['2']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                                <i class="fa fa-download"></i>
                            </a>

                            <a href="#" data-toggle="modal" data-target="#dangerModal{{'2'}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        {{ __('Acción') }}
                                    </div>
                                    <a href="{{ route('politicaEmpresarial.edit',['2']) }}" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        {{ __('Editar') }}
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-download text-orange mr-1 p-2 w-4"></i>
                                        {{ __('Descargar') }}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{'2'}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{'2'}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                    <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                        <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                            ¡Atención!
                                        </h5>

                                        <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-150">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                        <div class="d-flex align-items-top mr-2 mr-md-5">
                                            <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                            <div class="text-secondary-d2 text-105">
                                                ¿Está seguro que desea eliminar esta política empresarial?
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer bgc-white-tp2 border-0">
                                        <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                            Si
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">

                <td class="text-600 text-orange-d2 text-left">
                    doc-Política-3
                </td>

                <td class="d-none d-sm-table-cell text-grey-d1 text-left">
                    Politica 3
                </td>

                <td class='d-none d-sm-table-cell text-grey-d1 text-left'>
                    22-02-2022
                </td>

                <td class='text-grey text-95 text-left'>
                    <span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>
                </td>

               
                <td class="float-left">

                    <form method="POST" action="{{ route('politicaEmpresarial.destroy',['3']) }}">
                        @csrf
                        @method('DELETE')
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex float-right'>
                            <a href="{{ route('politicaEmpresarial.edit',['3']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                                <i class="fa fa-download"></i>
                            </a>

                            <a href="#" data-toggle="modal" data-target="#dangerModal{{'3'}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        {{ __('Acción') }}
                                    </div>
                                    <a href="{{ route('politicaEmpresarial.edit',['3']) }}" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        {{ __('Editar') }}
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fa fa-download text-orange mr-1 p-2 w-4"></i>
                                        {{ __('Descargar') }}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{'3'}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{'3'}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                    <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                        <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                            ¡Atención!
                                        </h5>

                                        <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-150">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                        <div class="d-flex align-items-top mr-2 mr-md-5">
                                            <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                            <div class="text-secondary-d2 text-105">
                                                ¿Está seguro que desea eliminar esta política empresarial?
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer bgc-white-tp2 border-0">
                                        <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                            Si
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- table footer -->
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-center align-self-sm-start  pt-3">
            <span class="d-inline-block text-grey-d2">
                Mostrando 1 - 10 de 152
						</span>

            <select class="ml-3 ace-select no-border angle-down brc-h-blue-m3 w-auto pr-45 text-secondary-d3">
                <option value="10">Mostrar 10</option>
                <option value="20">Mostrar 20</option>
                <option value="50">Mostrar 50</option>
            </select>
        </div>

        <div class="btn-group align-self-center align-self-sm-start pt-3">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-arrow-left"></i></a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-arrow-right"></i></a></li>
            </ul>
        </div>
    </div>
@endsection
