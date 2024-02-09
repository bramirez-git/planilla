@extends('Layouts.menu')

@section('page-content')
    @if(false)
        <div class="alert alert-warning">
            No se encuentran registros
        </div>
    @else
        <div class="page-content container container-plus">
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
                                    <div data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                        <div class="dropdown-inner">
                                            <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                                Filtros de búsqueda </h5>
                                            <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" id="frm_filtros" action="{{""}}">
                                                @csrf
                                                <input type="text" value="{{ '' }}" hidden name="url"/>
                                                <div class="dropdown-body my-25 px-3">
                                                    <div class="d-flex align-items-center px-2 px-md-3 mt-3 mb-3">
                                                        <div class="text-nowrap">Nombre :</div>
                                                    </div>
                                                    <div class="px-2 px-md-3">
                                                        <input type="text" style="width: 400px" id="buscar" value="{{ $buscar ?? '' }}" name="buscar" class="form-control" placeholder="Buscar ..."/>
                                                    </div>
                                                    <hr class="brc-default-l3"/>
                                                    <div class="d-flex align-items-center px-2 px-md-3">
                                                        <div class="mr-4">Mes de vacaciones :</div>
                                                        <div class="input-group input-daterange sticky-top">
                                                            <input type="text" data-placement="button" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaIngreso" name="filtro[fecha_ingreso]" value=""/>
                                                        </div>
                                                    </div>
                                                    <hr class="brc-default-l3"/>
                                                    <div class="d-flex align-items-center px-2 px-md-3">
                                                        <div class="mr-4 text-nowrap">Departamento:</div>
                                                        <input type="text" id="telefono" value="" name="filtro[telefono]" class="form-control" placeholder="Departamento"/>
                                                    </div>
                                                </div>
                                                <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                                    <button type="submit" onclick="waitingDialog.show();" class="btn px-4 py-15 text-95 btn-default btn-modal-cargando">
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
                                <a href="{{route('vacaciones.index')}}" onclick="waitingDialog.show();" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                                    <i class="nav-icon fa fa-retweet"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card dcard">
                        <div class="card-body px-1 px-md-3">

                            <div class="table-responsive">
                                <table class="table table-bordered" >
                                    <thead>
                                    <tr>
                                        @php
                                            $dias = 31;
                                        @endphp
                                        <th class="first-column-table">Nombre</th>
                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <th>{{ $contador }}</th>
                                        @endfor
                                        <th class="first-column-table">Días tomados en el año</th>
                                        <th class="first-column-table">Días por año</th>
                                        <th class="first-column-table">Vacaciones anteriores</th>
                                        <th class="first-column-table">Días pendientes</th>
                                        <th class="first-column-table"><span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Enfermedad"> <i class="fa-solid fa-circle-info blue"></i> </span>E</th>
                                        <th class="first-column-table"><span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Vacaciones"> <i class="fa-solid fa-circle-info blue"></i> </span>V</th>
                                        <th class="first-column-table"><span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Maternidad"> <i class="fa-solid fa-circle-info blue"></i> </span>M</th>
                                        <th class="first-column-table"><span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Tramites"> <i class="fa-solid fa-circle-info blue"></i> </span>T</th>
                                        <th class="first-column-table"><span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Medio dia"> <i class="fa-solid fa-circle-info blue"></i> </span>MD</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td class="text-nowrap first-column-table" >Jose Fabio Castillo</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(45,12)))
                                                    <th>
                                                      M
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            14
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Carlos Solis</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(10,15)))
                                                    <th>
                                                        V
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            5
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Juancarlos mora</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(10,14)))
                                                    <th>
                                                        V
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            3
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Ana melissa reyes</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(1,6)))
                                                    <th>
                                                        V
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            5
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Alfredo Istok Sosa</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(3,4)))
                                                    <th>
                                                        T
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            2
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Karen Regina Rodriguez segura</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(20,31)))
                                                    <th>
                                                        V
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            8
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Maria Rojas Mena</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(27,30)))
                                                    <th>
                                                        V
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            2
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Juan Perez Rosales</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(1,2)))
                                                    <th>
                                                       MD
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td><td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td><td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td><td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td><td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            2
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap first-column-table" >Pedro Vargas Diaz</td>
                                        @php
                                            $dias = 31;
                                        @endphp

                                        @for($contador = 1;$contador <= $dias; $contador++)
                                            <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                            @switch($contador)
                                                @case(6) <th class="bgc-grey-l2"> </th> @break
                                                @case(7) <th class="bgc-grey-l2"> </th> @break
                                                @case(13) <th class="bgc-grey-l2"> </th> @break
                                                @case(14) <th class="bgc-grey-l2"> </th> @break
                                                @case(20) <th class="bgc-grey-l2"> </th> @break
                                                @case(21) <th class="bgc-grey-l2"> </th> @break
                                                @case(27) <th class="bgc-grey-l2"> </th> @break
                                                @case(28) <th class="bgc-grey-l2"> </th> @break
                                                @case(in_array($contador,range(29,30)))
                                                    <th>
                                                      E
                                                    </th>
                                                    @break
                                                @default
                                                    <th></th>
                                            @endswitch
                                        @endfor
                                        <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                                <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
                                            2
                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                        <td data-label="Hora Doble&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            @include('componentes.paginacion')
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div>
        </div>
    @endif
@endsection

<script type="module">
    $('.input-daterange').datepicker({
        format: 'mm/yyyy', // Solo mes y año
        minViewMode: 1, // Establece el nivel de visualización mínimo a meses
        autoclose: true,
        calendarWeeks: true,
        clearBtn: true,
        orientation: 'bottom',
        disableTouchKeyboard: true,
        language: 'es'
    });
    $('#fechaIngreso').val(obtenerFechaEnFormatoMMYYYY);

    function obtenerFechaEnFormatoMMYYYY(){
        var fecha=new Date();
        var mes=fecha.getMonth()+1; // Sumar 1 porque los meses van de 0 a 11
        var ano=fecha.getFullYear();
        // Formatear la fecha como 'mm/yyyy'
        var fechaFormateada=mes<10?'0'+mes:mes; // Agrega un cero si el mes es de un solo dígito
        fechaFormateada+='/'+ano;
        return fechaFormateada;
    }

    // Establecer la fecha actual en el formato 'mm/yyyy' en el elemento con id 'fechaIngreso'
    $('#fechaIngreso').val(obtenerFechaEnFormatoMMYYYY());
</script>
