@extends('Layouts.menu')

@section('page-content')

    @if($resultado->isEmpty())

        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                <a href="{{ route('colaboradores.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Agregar Colaborador
                </a>
            </div>

            <div class="text-nowrap align-self-start pl-md-2">
                <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                    <div class="d-flex flex-row-reverse">
                        <div class="px-1">
                            <a href="#" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                </span>
                                Subir excel
                            </a>
                        </div>

                        <div class="px-1">
                        <button id="descarga_excel_colaboradores" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
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
            La lista de colaboradores está vacía.
        </div>
        <div class="alert bgc-secondary-l3 text-dark-m1 border-none border-l-4 brc-blue radius-0 py-3 text-115">
            <div>
                <p><i class="fas fa-info mr-2 mb-1 text-110 text-blue-d1 align-middle"></i>¿Ya cuenta con el archivo de texto (.TXT)?</p>
                <p>Recuerde que en el .TXT está la declaración de planilla de <b>riesgos del trabajo RT Virtual del INS</b>, puede realizar la importación de los colaboradores mediante esta opción,
                    el sistema se encarga de procesar la información y realiza una importación masiva de los colaboradores en el sistema de planillaprofesional.com,
                    luego debe completar la información adicional de cada colaborador que NO suministra el archivo del INS.</p>
            </div>

            <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                <a onClick="ui_adjuntar_documentos();" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    Cargar Archivo
                </a>
            </div>

        </div>
    @else

        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                <a href="{{ route('colaboradores.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Agregar Colaborador
                </a>
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

                                <div style="width: 24rem; max-width: 90vw; z-index:5000" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                    <div class="dropdown-inner">
                                        <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                            Search Filters
                                        </h5>

                                        <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{route('colaboradores.index')}}">
                                            @csrf
                                            <div class="dropdown-body my-25 px-3">
                                                <div class="px-2 px-md-3">
                                                    <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                                </div>

                                                <hr class="brc-default-l3" />

                                                <div class="d-flex align-items-center px-2 px-md-3">
                                                    <div class="mr-4">Ordenar por:</div>
                                                    <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="orden">
                                                        <option value="nombre" @if($orden=="nombre") selected @endif>Nombre</option>
                                                        <option value="num_colaborador" @if($orden=="num_colaborador") selected @endif>Número de Colaborador</option>
                                                        <option value="identificacion" @if($orden=="identificacion") selected @endif>Identificación</option>
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
                            <a href="{{route('colaboradores.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100">
                                <i class="nav-icon fa fa-retweet"></i>
                            </a>
                        </div>

                        <div class="px-1">
                            <button id="descarga_excel_colaboradores" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
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

        <div class="table-responsive border-t-3 brc-blue-m2" style="height:600px;position: sticky;">

            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4 sticky-top">
                <tr>
                    <th class="text-left text-secondary-d2 text-95 text-600">

                    </th>
                    <th  class="text-left text-secondary-d2 text-95 text-600">
                        Nombre Completo
                    </th>

                    <th class="text-left text-secondary-d2 text-95 text-600">
                        Identificaci&oacute;n
                    </th>

                    <th class="d-none d-sm-table-cell text-left text-secondary-d2 text-95 text-600">
                        Departamento
                    </th>

                    <th class='d-none d-sm-table-cell text-left text-secondary-d2 text-95 text-600'>
                        Correo
                    </th>

                    <th class="d-none d-sm-table-cell text-left text-secondary-d2 text-95 text-600">
                        Teléfono
                    </th>

                    <th  class="text-left text-secondary-d2 text-95 text-600">
                        Acción
                    </th>
                </tr>
                </thead>

                <tbody class="mt-1">
                @foreach($resultado as $datos)
                    @php
                        $color = "purple";
                        $numero = rand(1,6);
                        switch ($numero)
                        {
                            case 1 : $color="purple"; break;
                            case 2 : $color="red"; break;
                            case 3 : $color="green"; break;
                            case 4 : $color="blue"; break;
                            case 5 : $color="orange"; break;
                            case 6 : $color="primary"; break;
                        }
                    @endphp

                    <tr class="bgc-h-blue-l4 d-style">

                        @php
                            $esErrorPl = $datos->config_planilla;
                            $esErrorIN = $datos->config_ccss_ins;
                            $esError   = $esErrorPl === 'error' || $esErrorIN === 'error';
                        @endphp

                        <td data-label="" class="text-center"
                            data-eserrorpl="{{ json_encode($esErrorPl) }}"
                            data-eserrorin="{{ json_encode($esErrorIN) }}">
                            <button class="btn btn-xs {{ $esError ? 'btn-outline-danger' : 'btn-outline-success' }} error_colaborador" style="border: none;">
                                <i class="fas {{ $esError ? 'fa-exclamation-circle' : 'fa-check-circle' }}"></i>
                            </button>
                        </td>



                        <td data-label="Nombre completo:">

                            <a href='#' class='text-secondary-d2 text-95 text-600'>


                                   <span class="text-95 text-primary-d2 p-1 text-capitalize">
                           <strong>   {{ $datos->primer_nombre.' '.$datos->segundo_nombre }}</strong>
                        </span>
                        <div class="text-85 text-secondary-d1 text-capitalize px-0 mt-1">
                         {{ $datos->primer_apellido.' '.$datos->segundo_apellido }}
                        </div>
                            </a>
                        </td>



                        <td data-label="Identificaci&oacute;n:" class='text-grey-d1 text-right text-md-left'>
                            {{ $datos->identificacion }}
                        </td>

                         <td data-label="Departamento:" class='text-grey-d1 text-right text-md-left'>
                            {{ $datos->departamento }}
                        </td>

                        <td data-label="Correo:" class='text-grey-d1 text-right text-md-left'>
                            {{ $datos->correo_personal }}
                        </td>

                         <td data-label="Teléfono:" class='text-grey-d1 text-right text-md-left'>
                            {{ $datos->telefono_celular }}
                        </td>

                        <td data-label="Acción:" class='text-grey-d1 text text-md-center'>
                            <form method="POST"  id="eliminar_colaborador-{{$datos->id_colaborador}}" action="{{ route('colaboradores.destroy',[$datos->id_colaborador]) }}">
                                                                @method('DELETE')
                                <!-- action buttons -->
                                <div class='d-none d-lg-flex float-right'>
                                    <a href="{{ route('colaboradores.edit',[Crypt::encrypt($datos->id_colaborador)]) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{$datos->id_colaborador}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger eliminar_colaborador">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>

                                    <a href="#" data-toggle="collapse" data-target="#table-detail-{{$datos->id_colaborador}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-info btn-a-lighter-info collapsed" title="Mostrar herramientas">
                                        <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
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
                                            <a href="{{ route('colaboradores.edit',[Crypt::encrypt($datos->id_colaborador)]) }}" class="dropdown-item">
                                                <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                                {{ __('Editar') }}
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#dangerModal{{$datos->id_colaborador}}" class="dropdown-item eliminar_colaborador">
                                                <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                                {{ __('Eliminar') }}
                                            </a>
                                            <a href="#" data-toggle="collapse" data-target="#table-detail-{{$datos->id_colaborador}}" class="dropdown-item collapsed">
                                                <i class="fa fa-angle-down text-info-m1 mr-1 p-2 w-4"></i>
                                                {{ __('Mostrar herramientas') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>

                    <tr class="border-0 detail-row bgc-white">
                        <td colspan="6" class="p-0 border-none brc-secondary-l2">
                            <div class="table-detail collapse" id="table-detail-{{$datos->id_colaborador}}">
                                <div class="row">
                                    <div class="col-sm-12 py-3">
                                        <form autocomplete="off" method="GET" action="">
                                            <a href="{{ route('colaboradores_configuracion_index',[Crypt::encrypt($datos->id_colaborador)]) }}" title="Configuración" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1" style="margin-left: 20px;">
                                                <i style="width: 23px;" class="fa fa-users-viewfinder"></i>
                                            </a>

                                            <!--<a href="{ route('colaboradoresCurriculum.index') }}" data-id-colaborador="{Crypt::encrypt($datos->id_colaborador)}}" hidden="true" title="Currículum" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                <i style="width: 23px;" class="fa fa-clipboard-user"></i>
                                            </a>

                                            <a href="{ route('colaboradoresAmonestaciones.index') }}" data-id-colaborador="{Crypt::encrypt($datos->id_colaborador)}}" hidden="true" title="Amonestaciones" data-rel="tooltip" data-placement="bottom" class="enlace btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                <i style="width: 23px;" class="fa fa-file-circle-exclamation"></i>
                                            </a>-->

                                            <a href="{{ route('colaboradoresDocumentosDigitales.index') }}" data-id-colaborador="{{Crypt::encrypt($datos->id_colaborador)}}" title="Expedientes digitales" data-rel="tooltip" data-placement="bottom" class="enlace btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                <i style="width: 23px;" class="fa fa-folder-tree"></i>
                                            </a> <!-- data-toggle="modal" data-target="#adjuntarDocumentos" -->

                                            <a href="{{ route('colaboradoresPerfil.edit',[Crypt::encrypt($datos->id_colaborador)]) }}" title="Perfil" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                <i style="width: 23px;" class="fa fa-person-chalkboard"></i>
                                            </a>

                                            <a href="{{ route('colaboradoresConstanciaSalarial.index') }}" data-id-colaborador="{{Crypt::encrypt($datos->id_colaborador)}}" hidden="true" title="Constancia salarial" data-rel="tooltip" data-placement="bottom" class="enlace btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                <i style="width: 23px;" class="fa fa-money-check-dollar"></i>
                                            </a>

                                            @if(session()->get("prestamos") == 1)
                                                <a href="{{ route('colaboradoresPrestamos.index', [Crypt::encrypt($datos->id_colaborador)]) }}" title="Préstamos" data-rel="tooltip" data-placement="bottom" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                    <i style="width: 23px;" class="fa fa-bank"></i>
                                                </a>
                                            @else
                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom" title="Habilitar en configuración de empresa">
                                                    <button class="btn px-2 btn-lighter-gray font-bolder letter-spacing mb-1" disabled>
                                                        <i style="width: 23px;" class="fa fa-bank"></i>
                                                    </button>
                                                </span>
                                            @endif

                                            <a href="{{ route('colaboradoresEmbargos.index') }}" data-id-colaborador="{{Crypt::encrypt($datos->id_colaborador)}}" title="Embargos"  data-rel="tooltip" data-placement="bottom" class="enlace btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                <i style="width: 23px;" class="fa fa-sack-xmark"></i>
                                            </a>

                                            <a href="{{ route('colaboradorAccionPersonal.index') }}" data-id-colaborador="{{Crypt::encrypt($datos->id_colaborador)}}" title="Acción de personal" data-rel="tooltip" data-placement="bottom" class="enlace btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1">
                                                <i style="width: 23px;" class="fa fa-person-circle-plus"></i>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>


                @include('componentes.adjuntarDocumentos')
            </table>
        </div>

        @include('componentes.paginacion')
    @endif
@endsection
