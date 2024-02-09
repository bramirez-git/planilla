@extends('Layouts.menuPanel')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a href="{{ route('noticiasPanel.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                Agregar Noticia
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
                                        Search Filters
                                    </h5>

                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" id="frm_filtros" action="">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Estado:</div>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado]" @if($estado=="activa") checked  @endif value="activa"> Activo
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado]" @if($estado=="inactiva") checked  @endif value="inactiva"> Inactivo
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado]" @if($estado=="pendiente") checked  @endif value="pendiente"> Pendiente
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1" style="display: none;">
                                                        <input type="radio" name="filtro[estado]" @if($estado=="") checked  @endif value="" style="display: none;">
                                                    </label>
                                                </div>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[orden]">
                                                    <option value="" @if($orden=="") selected @endif>Seleccionar orden</option>
                                                    <option value="id" @if($orden=="id") selected @endif>Id</option>
                                                    <option value="titulo" @if($orden=="titulo") selected @endif>Titulo</option>
                                                    <option value="fecha" @if($orden=="fecha") selected @endif>Fecha publicación</option>
                                                </select>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Tipo de orden:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[tipo_orden]">
                                                    <option value="" @if($tipo_orden=="") selected @endif>Seleccionar tipo</option>
                                                    <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente</option>
                                                    <option value="DESC" @if($tipo_orden=="DESC") selected @endif>Descendente</option>
                                                </select>
                                            </div>

                                            <hr class="brc-default-l3"/>

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Fecha publicación</div>
                                                <div class="input-group input-daterange">
                                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" placeholder="Desde" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaIngreso" name="filtro[fecha_ingreso]" value="{{ $fecha1 }}"/>
                                                </div>
                                                <label class="m-2">-</label>
                                                <div class="input-group input-daterange">
                                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" placeholder="Hasta" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaFinal" name="filtro[fecha_final]" value="{{ $fecha2 }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                            <button type="submit" class="btn px-4 py-15 text-95 btn-default btn-modal-cargando">
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
                        <a href="{{route('noticiasPanel.index')}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>
                    @if(!$resultado->isEmpty())
                        <div class="px-1">
                            <button id="descarga_excel_noticias" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                            </span>
                                Exportar excel
                            </button>
                        </div>
                    @endif
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

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th  class="text-center text-secondary-d2 text-95 text-600">
                    Id
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Titulo
                </th>

                <th class="d-none d-sm-table-cell text-center">
                    Estado
                </th>

                <th class="d-none d-sm-table-cell text-center">
                    Fecha publicación
                </th>

                <th  class="d-none d-sm-table-cell text-left">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            @foreach($resultado as $datos)
            <tr class="bgc-h-blue-l4 d-style">
                <td class="text-center">
                    <a href='#' class='text-secondary-d2 text-95 text-600'>


                                   <span class="text-95 text-primary-d2 p-1 text-capitalize">
                           <strong>   {{ $datos->id_noticia}}</strong>
                        </span>
                    </a>
                </td>

                <td class='text-grey-d1 align-middle text-center'>
                    {{ $datos->titulo}}
                </td>


                <td class='text-grey text-95 text-center align-middle text'>
                    @if($datos->estado==="activa")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-success-d1">Activa</span>
                    @elseif($datos->estado==="inactiva")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-danger-d1">Inactiva</span>
                    @elseif($datos->estado==="pendiente")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-warning-d1">Pendiente</span>
                    @endif
                </td>

                <td class='d-none d-sm-table-cell text-center align-middle text-center'>
                    {{ date("d/m/Y",strtotime($datos->fecha)) }}
                </td>

                <td class="align-middle">
                    <form method="POST" action="{{ route('noticiasPanel.destroy',[Crypt::encrypt($datos->id_noticia)]) }}">
                        @csrf
                        @method('DELETE')
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex float-left'>
                            <a data-encrypted-id="{{ Crypt::encrypt($datos->id_noticia) }}" href="{{ route('noticiasPanel.edit',[Crypt::encrypt($datos->id_noticia)]) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success btn-ajax">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a href="#" data-toggle="modal" data-target="#dangerModal{{$datos->id_noticia}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a href="{{ route('noticiasPanel.edit',[Crypt::encrypt($datos->id_noticia)]) }}" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        {{ __('Ver detalles') }}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{$datos->id_noticia}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{$datos->id_noticia}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                                ¿Está seguro que desea eliminar la noticia?
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer bgc-white-tp2 border-0">
                                        <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn px-4 btn-danger btn-modal-cargando" id="id-danger-yes-btn">
                                            Si
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
            @include('componentes.adjuntarDocumentos')
        </table>
    </div>
    @include('componentes.paginacion')
    @endif
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $(".btn-modal-cargando").on("click", function () {
                $('#cargando').modal('show');
            });

            $('.btn-ajax').click(function() {
                $('#cargando').modal('show');
                var encryptedId = $(this).data('encrypted-id'); // Obtiene el valor cifrado de 'data-encrypted-id'
                var url = "{{ route('noticiasPanel.edit', ':id') }}";
                url = url.replace(':id', encryptedId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'GET',
                    url: url,
                    success: (response) => {
                        $('#cargando').modal('hide');
                    },
                    error: function(response){
                        alert(response.responseJSON.message);
                        $('#cargando').modal('hide');
                    }
                });
            });

            // Adjunta un escuchador de eventos de clic a todos los botones con data-dismiss="modal"
            $('[data-dismiss="modal"]').on('click', function () {
                const modals = $('.modal');
                // Cierra todos los modales usando la función modal('hide')
                modals.modal('hide');
            });

            $("#limpiarCampos").on("click", function () {
                // Obtener el formulario por su ID
                const form = $("#frm_filtros");

                // Limpiar los campos estableciendo su valor en cadena vacía
                form.find("input[type=text]").val('');
                // Seleccionar la opción "Inactivo"
                form.find("input[name='filtro[estado]'][value='']").trigger("click");
                form.find("select").each(function () {
                    // Establecer la opción por posición (índice) 1 (Opción 2) para cada elemento <select>
                    $(this).prop("selectedIndex", 0)
                });
            });
        });
    </script>
@endpush
