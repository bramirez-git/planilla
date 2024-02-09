@extends('Layouts.menu')

@section('page-content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            {{--            <a href="{{ route('noticias.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">--}}
            {{--                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">--}}
            {{--							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>--}}
            {{--						</span>--}}
            {{--                Agregar Noticia--}}
            {{--            </a>--}}
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
                                                <div class="mr-4">Departementos :</div>
                                                <div class="input-group input-daterange sticky-top">
                                                    <select>

                                                    </select>
                                                </div>
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
                    {{--                    @if(!$resultado->isEmpty())--}}
                    {{--                        <div class="px-1">--}}
                    {{--                            <a href="" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">--}}
                    {{--                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">--}}
                    {{--                                <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>--}}
                    {{--                            </span>--}}
                    {{--                                Exportar excel--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}
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
            <table id="simple-table-horas" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                <tr data-id-dr="0">
                    <th scope="col" class="text-left text-md-center small align-middle">
                        <strong> Nombre</strong>
                    </th>
                    <th scope="col" class="text-left text-md-center small align-middle">
                        <strong> Días tomados en el año</strong>
                    </th>
                    <th scope="col" class="text-left text-md-center small align-middle">
                        <strong> Días por año</strong>
                    </th>
                    <th scope="col" class="text-left text-md-center small align-middle">
                        <strong> Vacaciones anteriores</strong>
                    </th>
                    <th scope="col" class="text-left text-md-center small align-middle">
                        <strong> Días pendientes</strong>
                    </th>
                    <th scope="col" class="text-left text-md-center small align-middle"></th>
                    <th scope="col" class="text-left text-md-center small align-middle"></th>
                </tr>
                </thead>
                <tbody class="mt-1">
                <tr class="bgc-h-blue-l4 d-style" data-id-dr="50">
                    <td data-label="Nombre:" class="text-grey-d1 text-right text-md-center small">
                        BRANDON
                        RAMIREZ
                        VARGAS
                    </td>
                    <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                    </td>
                    <td data-label="Hora Extra&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
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
                    <td data-label="Días Feriados a pagar" class="text-grey-d1 text-right text-md-center">
                        <div class="text-md-center">
                            <div class="m-auto d-md-inline-block d-block align-middle">
                                                   <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <a onclick="ui_calendario_vacaciones('{{1}}','','BRANDON RAMIREZ VARGAS')" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1" style="margin-left: 5px;" data-original-title="Calendario vacaciones">
                            <i style="width: 23px;" class="fa fa-calendar-days"></i>
                        </a>
                        <a onclick="ui_motivo_vacaciones('{{1}}','','BRANDON RAMIREZ VARGAS')" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1" style="margin-left: 5px;" data-original-title="Razón vacaciones">
                            <i style="width: 23px;" class="fa fa-handshake"></i>
                        </a>
                    </td>
                    <td class="text-center"></td>
                </tr>
                <tr class="border-0 detail-row">
                    <td colspan="6" class="p-0 border-none brc-secondary-l2">
                        <div class="table-detail collapse" id="table-razon-{{1}}">
                            <div class="row">
                                <div class="col-sm-12 py-4">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="card bcard">
                                            <div class="card-body p-0">
                                                <div class="table-responsive border-t-3 brc-blue-m2">
                                                    <table id="simple-table-horas2" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                                        <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                                                        <tr>
                                                            <th data-rel="tooltip" data-placement="right" data-original-title="Enfermedad" class="text-center text-secondary-d2 text-95 text-600">
                                                                E
                                                            </th>
                                                            <th data-rel="tooltip" data-placement="right" data-original-title="Vacaciones" class="text-center text-secondary-d2 text-95 text-600">
                                                                V
                                                            </th>
                                                            <th data-rel="tooltip" data-placement="right" data-original-title="Maternidad" class=" text-secondary-d2 text-95 text-600 text-center">
                                                                M
                                                            </th>
                                                            <th data-rel="tooltip" data-placement="right" data-original-title="Tramites" class="text-center text-secondary-d2 text-95 text-600">
                                                                T
                                                            </th>
                                                            <th data-rel="tooltip" data-placement="right" data-original-title="Medio dia" class="text-center text-secondary-d2 text-95 text-600">
                                                                MD
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="mt-1">
                                                        @foreach($resultado as $datos)
                                                            <tr class="bgc-h-blue-l4 d-style">
                                                                <td class="d-none d-sm-table-cell text-600 text-primary-d2 text-center">
                                                                    1
                                                                </td>
                                                                <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                                                                    5
                                                                </td>
                                                                <td class='text-grey text-95 text-center'>
                                                                    1
                                                                </td>
                                                                <td class='text-grey text-95 text-center'>
                                                                    2
                                                                </td>
                                                                <td class='text-grey text-95 text-center'>
                                                                    3
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="bgc-h-blue-l4 d-style" data-id-dr="48">
                    <td data-label="Nombre:" class="text-grey-d1 text-right text-md-center small">
                        JIRETH
                        SUSANA
                    </td>
                    <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                    </td>
                    <td data-label="Hora Extra&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
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
                    <td data-label="Días Feriados a pagar" class="text-grey-d1 text-right text-md-center">
                       <span class="badge badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                    </td>
                    <td class="text-center">
                        <a onclick="ui_calendario_vacaciones('{{2}}','','JIRETH SUSANA')" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1" style="margin-left: 5px;" data-original-title="Calendario vacaciones">
                            <i style="width: 23px;" class="fa fa-calendar-days"></i>
                        </a>
                        <a onclick="ui_motivo_vacaciones('{{2}}','','JIRETH SUSANA')" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1" style="margin-left: 5px;" data-original-title="Razón vacaciones">
                            <i style="width: 23px;" class="fa fa-handshake"></i>
                        </a>
                    </td>
                    <td class="text-center"></td>
                </tr>
                <tr class="bgc-h-blue-l4 d-style" data-id-dr="46">
                    <td data-label="Nombre:" class="text-grey-d1 text-right text-md-center small">
                        MARCO
                        DE
                        CEDEÑO
                        JESUS
                    </td>
                    <td data-label="Hora Normal a pagar" class="text-grey-d1 text-right text-md-center">
                         <span class="badge badge-primary badge-md py-2">
                            10
                        </span>
                    </td>
                    <td data-label="Hora Extra&nbsp;a pagar" class="text-grey-d1 text-right text-md-center">
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
                    <td data-label="Días Feriados a pagar" class="text-grey-d1 text-right text-md-center">
                        <span class="badge ba badge-md mb-2 py-0">
                                                        <a class="btn btn-raised btn-success text-100 p-1">
                                                            20
                                                        </a>
                                                    </span>
                    </td>
                    <td class="text-center">
                        <a onclick="ui_calendario_vacaciones('{{3}}','','MARCO DE CEDEÑO JESUS')" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1" style="margin-left: 5px;" data-original-title="Calendario vacaciones">
                            <i style="width: 23px;" class="fa fa-calendar-days"></i>
                        </a>
                        <a onclick="ui_motivo_vacaciones('{{3}}','','MARCO DE CEDEÑO JESUS')" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1" style="margin-left: 5px;" data-original-title="Razón vacaciones">
                            <i style="width: 23px;" class="fa fa-handshake"></i>
                        </a>
                    </td>
                    <td class="text-center"></td>
                </tr>
                </tbody>
            </table>
        </div>
        @include('componentes.paginacion')
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
