@extends('Layouts.menuPanel')

@section('page-content')
    <div class="row mb-475">
        <div class="col-sm-12 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Notificaciones Email') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                                <a href="{{ route('panelMiscelaneosNotificaciones.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                                    Agregar Notificación
                                </a>
                            </div>

                            <div class="text-nowrap align-self-start pl-md-2">
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

                                    <th class="d-none d-sm-table-cell text-center">
                                        Id Notificación
                                    </th>

                                    <th class="text-center">
                                        Nombre
                                    </th>

                                    <th class="text-center">
                                        Medio envío
                                    </th>

                                    <th class="d-none d-sm-table-cell text-center">
                                        Fecha
                                    </th>

                                    <th class="text-center">
                                        Acción
                                    </th>
                                </tr>
                                </thead>

                                <tbody class="mt-1">
                                <tr class="bgc-h-blue-l4 d-style">

                                    <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                                        1
                                    </td>

                                    <td>
                                        Carta de cumpleaños.
                                    </td>

                                    <td class='text-95 text-center'>
                                        sendgrid
                                    </td>


                                    <td class='d-none d-sm-table-cell text-center'>
                                        07-02-2022
                                    </td>

                                    <td>

                                        <form method="POST" action="{{ route('panelMiscelaneosNotificaciones.destroy',['1']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex float-right'>
                                                <a href="{{ route('panelMiscelaneosNotificaciones.edit',['1']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                    <i class="fa fa-pencil-alt"></i>
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
                                                        <a href="{{ route('panelMiscelaneosNotificaciones.edit',['1']) }}" class="dropdown-item">
                                                            <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                            {{ __('Editar') }}
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
                                                                    ¿Está seguro que desea eliminar la notificación?
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

                                    <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                                        2
                                    </td>

                                    <td>
                                        Carta de Aniversario.
                                    </td>

                                    <td class='text-95 text-center'>
                                        sendgrid
                                    </td>


                                    <td class='d-none d-sm-table-cell text-center'>
                                       26-11-2021
                                    </td>

                                    <td>

                                        <form method="POST" action="{{ route('panelMiscelaneosNotificaciones.destroy',['2']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex float-right'>
                                                <a href="{{ route('panelMiscelaneosNotificaciones.edit',['2']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                    <i class="fa fa-pencil-alt"></i>
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
                                                        <a href="{{ route('panelMiscelaneosNotificaciones.edit',['2']) }}" class="dropdown-item">
                                                            <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                            {{ __('Editar') }}
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
                                                                    ¿Está seguro que desea eliminar la notificación?
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

                                    <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                                        3
                                    </td>

                                    <td>
                                        Comprobante de pago Planilla.
                                    </td>

                                    <td class='text-95 text-center'>
                                        sendgrid
                                    </td>


                                    <td class='d-none d-sm-table-cell text-center'>
                                        12-01-2021
                                    </td>

                                    <td>

                                        <form method="POST" action="{{ route('panelMiscelaneosNotificaciones.destroy',['3']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex float-right'>
                                                <a href="{{ route('panelMiscelaneosNotificaciones.edit',['3']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                    <i class="fa fa-pencil-alt"></i>
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
                                                        <a href="{{ route('panelMiscelaneosNotificaciones.edit',['3']) }}" class="dropdown-item">
                                                            <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                            {{ __('Editar') }}
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
                                                                    ¿Está seguro que desea eliminar la notificación?
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

                                    <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                                        4
                                    </td>

                                    <td>
                                        Notificaciones de comunicados.
                                    </td>

                                    <td class='text-95 text-center'>
                                        sendgrid
                                    </td>


                                    <td class='d-none d-sm-table-cell text-center'>
                                        19-07-2021
                                    </td>

                                    <td>

                                        <form method="POST" action="{{ route('panelMiscelaneosNotificaciones.destroy',['4']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex float-right'>
                                                <a href="{{ route('panelMiscelaneosNotificaciones.edit',['4']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>

                                                <a href="#" data-toggle="modal" data-target="#dangerModal{{'4'}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                                        <a href="{{ route('panelMiscelaneosNotificaciones.edit',['4']) }}" class="dropdown-item">
                                                            <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                            {{ __('Editar') }}
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#dangerModal{{'4'}}" class="dropdown-item">
                                                            <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                                            {{ __('Eliminar') }}
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{'4'}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                                                    ¿Está seguro que desea eliminar la notificación?
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

                                    <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                                        5
                                    </td>

                                    <td>
                                        Constancia Salarial.
                                    </td>

                                    <td class='text-95 text-center'>
                                        sendgrid
                                    </td>


                                    <td class='d-none d-sm-table-cell text-center'>
                                        19-07-2021
                                    </td>

                                    <td>

                                        <form method="POST" action="{{ route('panelMiscelaneosNotificaciones.destroy',['5']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex float-right'>
                                                <a href="{{ route('panelMiscelaneosNotificaciones.edit',['5']) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>

                                                <a href="#" data-toggle="modal" data-target="#dangerModal{{'5'}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                                        <a href="{{ route('panelMiscelaneosNotificaciones.edit',['5']) }}" class="dropdown-item">
                                                            <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                            {{ __('Editar') }}
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#dangerModal{{'5'}}" class="dropdown-item">
                                                            <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                                            {{ __('Eliminar') }}
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{'5'}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                                                    ¿Está seguro que desea eliminar la notificación?
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
                    </div>
                </div><!-- /.card-body -->

            </div>
        </div>
    </div>


@endsection
