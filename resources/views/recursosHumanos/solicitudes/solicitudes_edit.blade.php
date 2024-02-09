@extends('Layouts.menu')

@section('page-content')
    <form autocomplete="off" method="POST" action="{{route('solicitudes.update',['1'])}}">
        @csrf
        @method('PUT')
        <div class="form-group row ">
            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> Solicitante: </label>
                <select id="idColaborador" data-placeholder="Seleccione un colaborador..." class="chosen-select form-control"  required="true">
                    <option value=""></option>
                    <option value='1-1111-1111'>Mary Codish</option>
                    <option value='1-1111-1112'>Alex Techie</option>
                    <option value='1-1111-1113'>Carl Simmons</option>
                    <option value='1-1111-1114'>David Rookie</option>
                </select>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de solicitud:') }}</label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoPermiso" name="tipoPermiso" required="true">
                    <option value=""></option>
                    <option value="1">Vacaciones</option>
                    <option value="2">Incapacidad</option>
                    <option value="3">Teletrabajo</option>
                    <option value="4">Entreno</option>
                    <option value="5">Permiso especial</option>
                </select>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0 input-daterange">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de solicitud:') }}</label>
                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicialSolicitudes" name="fechaInicialSolicitudes" required="true" placeholder="Fecha Inicial"/>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> Responsable directo: </label>
                <select id="idColaborador" data-placeholder="Seleccione un colaborador..." class="chosen-select form-control"  required="true">
                    <option value=""></option>
                    <option value='1-1111-1111'>Mary Codish</option>
                    <option value='1-1111-1112'>Alex Techie</option>
                    <option value='1-1111-1113'>Carl Simmons</option>
                    <option value='1-1111-1114'>David Rookie</option>
                </select>
            </div>
        </div>

        <br>
        <div class="table-responsive">
            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                <tr>
                    <th class="text-left text-secondary-d2 text-95 text-600">
                        Modalidad
                    </th>

                    <th class="text-left text-secondary-d2 text-95 text-600">
                        Fecha
                    </th>

                    <th class="text-left text-secondary-d2 text-95 text-600">
                        Tiempo
                    </th>

                   <th class="text-left text-secondary-d2 text-95 text-600">
                        <a href="#" data-toggle="modal" data-target="#dangerModal" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-blue btn-h-lighter-info btn-a-lighter-info">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </a>
                    </th>
                </tr>
                </thead>

                <tbody class="mt-1">
                <tr class="bgc-h-blue-l4 d-style">

                    <td data-label="Modalidad:" class="text-right text-md-center">
                        <div class="form-group row mt-1">
                            <div class="col-md-10 col-sm-12">
                                <select id="modalidad" data-placeholder="Seleccione una opción..." class="form-control" >
                                    <option value=""></option>
                                    <option value='1' selected>Rango de fechas</option>
                                    <option value='2'>Día completo</option>
                                    <option value='3'>Medío día<option>
                                </select>
                            </div>
                        </div>
                    </td>

                    <td data-label="Fecha:">
                        <div class="form-group row mt-1 justify-content-start">
                            <div class="col-md-4 col-sm-12">
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicialSolicitudes" name="fechaInicialSolicitudes" required="true">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaFinalSolicitudes" name="fechaFinalSolicitudes" required="true">
                                </div>
                            </div>
                        </div>
                    </td>

                    <td data-label="Tiempo:" class="text-right text-md-center">
                        Día completo
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class="d-none d-lg-flex justify-content-start justify-content-md-end">
                            <a href="#" data-toggle="modal" data-target="#dangerModal" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class="dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg">
                            <a href="#" class="btn btn-default btn-xs py-15 radius-round dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        Acción
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <tr class="bgc-h-blue-l4 d-style">

                    <td data-label="Modalidad:" class="text-right text-md-center">
                        <div class="form-group row mt-1">
                            <div class="col-md-10 col-sm-12">
                                <select id="modalidad" data-placeholder="Seleccione una opción..." class="form-control" >
                                    <option value=""></option>
                                    <option value='1'>Rango de fechas</option>
                                    <option value='2' selected>Día completo</option>
                                    <option value='3'>Medío día<option>
                                </select>
                            </div>
                        </div>
                    </td>

                    <td data-label="Fecha:" class="text-right text-md-center">
                        <div class="form-group row mt-1 justify-content-start">
                            <div class="col-md-8 col-sm-12">
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicialSolicitudes" name="fechaInicialSolicitudes" required="true">
                                </div>
                            </div>
                        </div>
                    </td>

                    <td data-label="Tiempo:" class="text-right text-md-center">
                        Día completo
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class="d-none d-lg-flex justify-content-start justify-content-md-end">
                            <a href="#" data-toggle="modal" data-target="#dangerModal" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class="dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg">
                            <a href="#" class="btn btn-default btn-xs py-15 radius-round dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        Acción
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <tr class="bgc-h-blue-l4 d-style">

                    <td data-label="Modalidad:" class="text-center">
                        <div class="form-group row mt-1">
                            <div class="col-md-10 col-sm-12">
                                <select id="modalidad" data-placeholder="Seleccione una opción..." class="form-control" >
                                    <option value=""></option>
                                    <option value='1'>Rango de fechas</option>
                                    <option value='2'>Día completo</option>
                                    <option value='3' selected>Medío día<option>
                                </select>
                            </div>
                        </div>
                    </td>

                    <td data-label="Fecha:" class="text-center">
                        <div class="form-group row mt-1 justify-content-start">
                            <div class="col-md-8 col-sm-12">
                                <div class="input-group input-daterange">
                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicialSolicitudes" name="fechaInicialSolicitudes" required="true">
                                </div>
                            </div>
                        </div>
                    </td>

                    <td data-label="Tiempo:" class="text-center">
                        <div class="form-group row mt-1">
                            <div class="col-sm-12">
                                <select id="tiempo" data-placeholder="Seleccione una opción..." class="form-control" >
                                    <option value=""></option>
                                    <option value='1'>Mañana</option>
                                    <option value='2'>Tarde</option>
                                </select>
                            </div>
                        </div>
                    </td>

                    <td>
                        <!-- action buttons -->
                        <div class="d-none d-lg-flex justify-content-start justify-content-md-end">
                            <a href="#" data-toggle="modal" data-target="#dangerModal" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class="dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg">
                            <a href="#" class="btn btn-default btn-xs py-15 radius-round dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        Acción
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <br>
        <div class="form-group row mt-3">
            <div class="col-sm-12">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> Comentarios u observaciones: </label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200"
                          placeholder="Comentarios" id="comentarios" name="comentarios" required="true" ></textarea>
            </div>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <button type="button" data-toggle="modal" data-target="#modalWithScroll2" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                            <i class="fa fa-info mr-1 text-white text-120 mt-3px"></i>
                                        </span>
                    {{ __('Ver detalles') }}
                </button>
                <button type="button" data-toggle="modal" data-target="#adjuntarDocumentos" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                            <i class="fa fa-folder-tree mr-1 text-white text-120 mt-3px"></i>
                                        </span>
                    {{ __('Documentos') }}
                </button>
                <button type="submit" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                            <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                        </span>
                    {{ __('Reservar día') }}
                </button>
            </div>
        </div>

    </form>

    <div class="modal fade" id="modalWithScroll2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-blue-d2">
                        Detalles de solicitudes
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body ace-scrollbar">
                    <div class="form-group row mt-3">
                        <div class="col-sm-12">
                            <p class="alert bgc-secondary-l4 brc-info-m1 border-0 border-l-4 radius-0 text-dark-tp2 mb-1">
                                {{ __('Cantidad de días libres: 16') }}
                                <br>
                                {{ __('Cantidad de días si se aprueban: 15') }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-sm-12">
                            <p class="alert bgc-secondary-l4 brc-orange-m1 border-0 border-l-4 radius-0 text-dark-tp2 mb-1">
                                <strong> {{ __('Colaboradores con solicitudes los mismos días') }} </strong>
                                <br>
                                {{ __('Juan Perez Solano: 15/09/2022 al 19/09/2022') }}
                                <br>
                                {{ __('Maria Rojas Mena: 10/09/2022 al 11/09/2022') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>

            </div>
        </div>
    </div>

    @include('componentes.adjuntarDocumentos')
@endsection
