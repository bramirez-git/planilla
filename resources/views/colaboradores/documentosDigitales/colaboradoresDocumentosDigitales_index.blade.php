@extends('Layouts.menu')

@section('page-content')
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a onClick="ui_adjuntar_documentos('{{$id_colaborador}}','');" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                            </span>
                Agregar Documento
            </a>
            <a href="{{route('colaboradoresCurriculum.create')}}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                            </span>
                Agregar Curriculum
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

                            <div style="width: 24rem; max-width: 90vw;" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Search Filters
                                    </h5>

                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET"
                                          action="{{route('colaboradoresDocumentosDigitales.index')}}">
                                        @csrf
                                        <input type="text" id="id_colaborador" name="id_colaborador" hidden value="{{Crypt::encrypt($id_colaborador)}}">
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}"
                                                       class="form-control" placeholder="Buscar ..." />
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Buscar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3"
                                                        name="orden">
                                                    <option value="">--</option>
                                                    <option value="nombre" @if($orden=="nombre" ) selected @endif>Nombre
                                                    </option>
                                                    <option value="palabras_clave" @if($orden=="palabras clave" ) selected @endif>Palabras clave
                                                    </option>
                                                </select>
                                            </div>

                                            <br>

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Categoría:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" id="categoria" name="categoria">
                                                    <option value="">--</option>
                                                    <option value="amonestacion" @if($categoria=="amonestacion" ) {{$categoria}} @endif>Amonestación</option>
                                                    <option value="permiso" @if($categoria=="permiso" ) {{$categoria}} @endif>Permiso</option>
                                                    <option value="incapacidad" @if($categoria=="incapacidad" ) {{$categoria}} @endif>Incapacidad</option>
                                                    <option value="licencia" @if($categoria=="licencia" ) {{$categoria}} @endif>Licencia</option>
                                                    <option value="expediente" @if($categoria=="expediente" ) {{$categoria}} @endif>Expediente</option>
                                                </select>
                                            </div>

                                            <br>

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Fecha:</div>
                                                <div class="input-group input-daterange">
                                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fecha" name="fecha" value="@if($fecha!="") {{$fecha}} @endif"/>
                                                </div>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3"
                                                        name="orden">
                                                    <option value="">--</option>
                                                    <option value="num_colaborador" @if($tipo_orden=="num_colaborador" ) selected @endif>N.º del colaborador</option>
                                                    <option value="identificacion" @if($tipo_orden=="identificacion" ) selected @endif>Identificación</option>
                                                    <option value="nombre" @if($tipo_orden=="nombre" ) selected @endif>Nombre</option>
                                                </select>
                                            </div>

                                            <br>

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Tipo de orden:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3"
                                                        name="tipo_orden">
                                                    <option value="">--</option>
                                                    <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente
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

                        <button onclick="document.getElementById('recargar').submit();" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100">
                            <i class="nav-icon fa fa-retweet"></i>
                        </button>
                        <form method="GET" id="recargar" action="{{route('colaboradoresDocumentosDigitales.index')}}">
                            @csrf
                            <input type="text" id="id_colaborador" name="id_colaborador" hidden value="{{Crypt::encrypt($id_colaborador)}}">
                        </form>
                    </div>

                    <div class="px-1">
{{--                        <a id="crearZipBtn" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">--}}
{{--                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">--}}
{{--                                <i class="fas fa-file-archive mr-1 text-white text-120 mt-3px"></i>--}}
{{--                            </span>--}}
{{--                            Descargar zip--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <div id="div_count_checked" style="display: none">
                <button data-rel="tooltip" data-placement="top" data-original-title="Descargar zip Doc. digitales" id="crearZipBtn" class="btn px-4 btn-lighter-success text-600 letter-spacing mb-1">
                    Total Doc. (<span id="count_checked">0</span>)
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">

        @if($resultado->isEmpty())
            <div class="alert alert-warning">
                La lista de documentos está vacía.
            </div>
        @else
            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                    <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                <tr>
                    <th style="width: 1%;">
                        <label><input id="check_doc_all" type="checkbox"><span class="lbl"></span></label>
                    </th>
                     <th scope="col" class="text-left text-md-center align-middle">
                        Nombre de documento
                    </th>

                    <th scope="col" class="text-left text-md-center align-middle">
                        Palabras claves
                    </th>

                    <th scope="col" class="text-left text-md-center align-middle">
                        Fecha de documento
                    </th>

                    <th scope="col" class="text-left text-md-center align-middle">
                        Tipo
                    </th>

                    <th scope="col" class="text-left text-md-center align-middle">
                        Comentarios
                    </th>

                     <th scope="col" class="text-left text-md-center align-middle">
                        Descargar
                    </th>
                </tr>
                </thead>

                <tbody class="mt-1">
                @foreach($resultado as $documentos)
                    <tr class="bgc-h-blue-l4 d-style">
                        <td data-url="{{ $documentos->url_documento }}">
                            <label><input type="checkbox" check_doc="" class="ace" name="títulos[]" value="1"><span class="lbl"></span></label>
                        </td>
                        <td data-label="Nombre de documento:" class='text-grey-d1 text-right text-md-center small'>
                            {{$documentos->nombre}}
                        </td>

                        <td data-label="Palabras claves:" class='text-grey-d1 text-right text-md-center small'>
                            {{$documentos->palabras_clave}}
                        </td>

                        <td data-label="Fecha de documento:" class='text-grey-d1 text-right text-md-center small'>
                            {{$documentos->fecha}}
                        </td>

                        <td data-label="Tipo:" class='text-grey-d1 text-right text-md-center small'>
                            {{$documentos->tipo_elemento}}
                        </td>

                        <td data-label="Comentarios:" class='text-grey-d1 text-right text-md-center small'>
                            {{$documentos->comentarios}}
                        </td>

                        <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>

                            <form method="POST" action="#">
                                @csrf
                                @method('PUT')
                                <!-- action buttons -->
                                <div class='d-none d-lg-flex float-right'>

                                    @if($documentos->tipo_elemento == "accion_personal")
                                        <a href="{{ route('colaboradorAccionPersonal.show',[Crypt::encrypt($documentos->id_elemento.'-'.$id_colaborador)]) }}" title="Vista previa" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-orange btn-a-lighter-orange">
                                            <i class="fa fa-eye text-110 text-orange-d2 mr-1"></i>
                                        </a>
                                    @else
                                        <a href="{{route('colaboradoresDocumentosDigitales.show',[Crypt::encrypt($documentos->id_documento.'-'.$id_colaborador)])}}" title="Vista previa" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-orange btn-a-lighter-orange">
                                            <i class="fa fa-eye text-110 text-orange-d2 mr-1"></i>
                                        </a>
                                    @endif

                                    <a href="{{ $documentos->url_documento }}" download title="Descargar documentos" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-green btn-a-lighter-green">
                                        <i class="fa fa-download text-110 text-green-d2 mr-1"></i>
                                    </a>

                                    <a onClick="ui_enviar_correo('{{$documentos->id_documento.'-'.$id_colaborador}}','');" title="Enviar por correo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-info btn-a-lighter-info" >
                                        <i class="fa fa-envelope text-110 text-info-d2 mr-1"></i>
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
                                            @if($documentos->tipo_elemento == "accion_personal")
                                                <a href="{{ route('colaboradorAccionPersonal.show',[Crypt::encrypt($documentos->id_elemento.'-'.$id_colaborador)]) }}" class="dropdown-item">
                                                    <i class="fa fa-eye text-110 text-orange-d2 mr-1"></i>
                                                    {{ __('Vista previa') }}
                                                </a>
                                            @else
                                                <a href="{{route('colaboradoresDocumentosDigitales.show',[Crypt::encrypt($documentos->id_documento.'-'.$id_colaborador)])}}" class="dropdown-item">
                                                    <i class="fa fa-eye text-110 text-orange-d2 mr-1"></i>
                                                    {{ __('Vista previa') }}
                                                </a>
                                            @endif
                                            <a href="{{ $documentos->url_documento }}" download class="dropdown-item">
                                                <i class="fa fa-download text-green mr-1 p-2 w-4"></i>
                                                {{ __('Descargar documentos') }}
                                            </a>
                                            <a  onClick="ui_enviar_correo('{{$documentos->id_documento.'-'.$id_colaborador}}','');" class="dropdown-item">
                                                <i class="fa fa-eye text-info mr-1 p-2 w-4"></i>
                                                {{ __('Enviar por correo') }}
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fa fa-download text-danger mr-1 p-2 w-4"></i>
                                                {{ __('Descargar documento pdf') }}
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
            @include('componentes.paginacion')
        @endif
    </div>
@endsection
<script type="module">

</script>
