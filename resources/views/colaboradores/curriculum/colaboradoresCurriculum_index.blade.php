@extends('Layouts.menu')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a href="{{ route('colaboradoresCurriculum.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                Agregar Currículum
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
                            <div data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Filtros de búsqueda </h5>
                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" id="frm_filtros" action="{{route('clientes.index')}}">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" value="{{ $buscar ?? '' }}" name="buscar" class="form-control" placeholder="Buscar ..."/>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Estado:</div>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado]" value="activo"> Activo
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado]" value="inactivo"> Inactivo
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round">
                                                        <input type="radio" name="filtro[estado]" id="estado_todos" value=""> Todos
                                                    </label>
                                                </div>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                        </div>
                                        <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                            <button class="btn px-4 py-15 text-95 btn-default btn-modal-cargando">
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
                        <a href="{{route('clientes.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>
{{--                    @if(!$resultado->isEmpty())--}}
                        <div class="px-1">
                            <a id="crearZipBtn" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa-regular fa-file-zipper mr-1 text-white text-120 mt-3px"></i>
{{--                                <i class="fa-solid fa-file-zipper mr-1 text-white text-120 mt-3px"></i>--}}
                            </span>
                                Descargar zip
                            </a>
                        </div>
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive border-t-3 brc-blue-m2">

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th style="width: 1%;">
                    <label><input id="check_compras_all" type="checkbox"><span class="lbl"></span></label>
                </th>
               <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                   Título otorgado
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Fecha de inicio
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Fecha de finalización
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                   Descripción del documento
                </th>

               <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                   Documento
                </th>

               <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                   Link URL de la credencial
                </th>

                <th scope="col" class="text-center text-secondary-d2 text-95 text-600">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            <tr class="bgc-h-blue-l4 d-style">
                <td>
                    <label><input type="checkbox" class="ace" name="títulos[]" value="1"><span class="lbl"></span></label>
                </td>
                <td data-label="Título otorgado:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería de Sistemas
                </td>

               <td data-label="Fecha de inicio:" class='text-grey-d1 text-center text-md-center small'>
                   {{ $fechaInicio }}
                </td>

                <td data-label="Fecha de finalización:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaFin }}
                </td>

                <td data-label="Descripción del documento:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería de Sistemas, Telemática y afines
                </td>

                <td data-label="Documento:" class='text-grey-d1 text-center text-md-center small'>
                    Doc
                </td>

                <td data-label="Link URL de la credencial:" class='text-grey-d1 text-center text-md-center small'>
                    https://app.planillaprofesional.com/
                </td>

               <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
                                    <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                    {{ __('Mostrar detalle Currículum') }}
                                </a>
                                <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="dropdown-item">
                                    <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                    {{ __('Eliminar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">
                <td>
                    <label><input type="checkbox" class="ace" name="títulos[]" value="2"><span class="lbl"></span></label>
                </td>
                <td data-label="Título otorgado:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería Electrónica
                </td>

                <td data-label="Fecha de inicio:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaInicio }}
                </td>

                <td data-label="Fecha de finalización:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaFin }}
                </td>

                <td data-label="Descripción del documento:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería Electrónica, Telecomunicaciones y afines
                </td>

                <td data-label="Documento:" class='text-grey-d1 text-center text-md-center small'>
                    Doc
                </td>

                <td data-label="Link URL de la credencial:" class='text-grey-d1 text-center text-md-center small'>
                    https://app.planillaprofesional.com/
                </td>

                <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
                                    <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                    {{ __('Mostrar detalle Currículum') }}
                                </a>
                                <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="dropdown-item">
                                    <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                    {{ __('Eliminar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">
                <td>
                    <label><input type="checkbox" class="ace" check_compra="" name="títulos[]" value="3"><span class="lbl"></span></label>
                </td>
                <td data-label="Título otorgado:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería Mecánica
                </td>

                <td data-label="Fecha de inicio:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaInicio }}
                </td>

                <td data-label="Fecha de finalización:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaFin }}
                </td>

                <td data-label="Descripción del documento:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería Mecánica y afines
                </td>

                <td data-label="Documento:" class='text-grey-d1 text-center text-md-center small'>
                    Doc
                </td>

                <td data-label="Link URL de la credencial:" class='text-grey-d1 text-center text-md-center small'>
                    https://app.planillaprofesional.com/
                </td>

                <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
                                    <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                    {{ __('Mostrar detalle Currículum') }}
                                </a>
                                <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="dropdown-item">
                                    <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                    {{ __('Eliminar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">
                <td>
                    <label><input type="checkbox" class="ace" name="títulos[]" value="4"><span class="lbl"></span></label>
                </td>
                <td data-label="Título otorgado:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería Química
                </td>

                <td data-label="Fecha de inicio:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaInicio }}
                </td>

                <td data-label="Fecha de finalización:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaFin }}
                </td>

                <td data-label="Descripción del documento:" class='text-grey-d1 text-center text-md-center small'>
                    Ingeniería Química y afines
                </td>

                <td data-label="Documento:" class='text-grey-d1 text-center text-md-center small'>
                    Doc
                </td>

                <td data-label="Link URL de la credencial:" class='text-grey-d1 text-center text-md-center small'>
                    https://app.planillaprofesional.com/
                </td>

                <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
                                    <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                    {{ __('Mostrar detalle Currículum') }}
                                </a>
                                <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="dropdown-item">
                                    <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                    {{ __('Eliminar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">
                <td>
                    <label><input type="checkbox" class="ace" name="títulos[]" value="5"><span class="lbl"></span></label>
                </td>
                <td data-label="Título otorgado:" class='text-grey-d1 text-center text-md-center small'>
                    Educación Física
                </td>

                <td data-label="Fecha de inicio:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaInicio }}
                </td>

                <td data-label="Fecha de finalización:" class='text-grey-d1 text-center text-md-center small'>
                    {{ $fechaFin }}
                </td>

                <td data-label="Descripción del documento:" class='text-grey-d1 text-center text-md-center small'>
                    Deportes, Educación Física y Recreación
                </td>

                <td data-label="Documento:" class='text-grey-d1 text-center text-md-center small'>
                    Doc
                </td>

                <td data-label="Link URL de la credencial:" class='text-grey-d1 text-center text-md-center small'>
                    https://app.planillaprofesional.com/
                </td>

                <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                <a href="{{ route('colaboradoresCurriculum.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
                                    <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                    {{ __('Mostrar detalle Currículum') }}
                                </a>
                                <a href="#" data-toggle="modal" data-target="#dangerModal{{1}}" class="dropdown-item">
                                    <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                    {{ __('Eliminar') }}
                                </a>
                            </div>
                        </div>
                    </div>
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
@push('scripts')
    <script type="module">
        $(document).ready(function(){
            $('#crearZipBtn').click(function(){
                exportarDatosComoZIP();
            });
        });
    </script>
@endpush
