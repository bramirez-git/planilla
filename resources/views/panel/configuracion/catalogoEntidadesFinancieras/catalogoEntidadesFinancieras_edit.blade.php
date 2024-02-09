@extends('Layouts.menuPanel')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <button  type="button" data-toggle="modal" data-target="#confirmModalBanco" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                </span>
                Agregar Banco
            </button>
        </div>
        <form method="POST" id="banco_modal" class="id-danger-yes-btn" action="{{ route('configuracionEntidadesFinancieras.store') }}">
            @csrf
            <div class="modal fade" data-backdrop-bg="bgc-white" id="confirmModalBanco" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content bgc-transparent brc-blue shadow">
                        <div class="modal-header py-2 bgc-blue border-0  radius-t-1">
                            <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="warningModalLabel">
                                Agregar banco </h5>
                            <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-150">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body bgc-white-tp2 p-md-4">
                            <div>
                                <label for="id-form-field-focus-1" class="mb-2"> {{ __('Nombre banco:') }}</label>
                                <div class="input-group text-secondary-d2 text-105">
                                    <input type="text" class="form-control col-sm-12" id="nombreBanco" name="nombre_banco"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bgc-white-tp2 border-0">
                            <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal" id="cerrar_modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn px-4 btn-blue" id="id-danger-yes-btn">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="text-nowrap align-self-start pl-md-2">
            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                <div class="d-flex flex-row-reverse">
                    <div class="px-1">
                        <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg h-100" data-display="static">
                            <input type="text" class="form-control mr-n3 pr-5 h-100" placeholder="Filtros de búsqueda" readonly/>

                            <a data-display="static" href="#" class="align-self-center btn border-0 btn-outline-default py-1 px-2 btn-h-light-primary btn-a-light-primary radius-1 ml-n35" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter"></i>
                            </a>

                            <div style="width:400px;" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Search Filters
                                    </h5>

                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="" id="miFormulario">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" name="buscar" value="{{$buscar}}" class="form-control" placeholder="Buscar ..." />
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[orden]">
                                                    <option value="id_banco" @if($orden=="id_banco") selected @endif>Id de banco</option>
                                                    <option value="nombre" @if($orden=="nombre") selected @endif>Nombre de banco</option>
                                                </select>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Tipo de orden:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[tipo_orden]">
                                                    <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente</option>
                                                    <option value="DESC" @if($tipo_orden=="DESC") selected @endif>Descendente</option>
                                                </select>
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
                        <a href="{{route('configuracionEntidadesFinancieras.edit',[Crypt::encrypt('12345')])}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>
{{--                    @if(!$resultado->isEmpty())--}}
{{--                        <div class="px-1">--}}
{{--                            <a class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">--}}
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
    <div class="table-responsive border-t-3 brc-blue-m2">
        @if($resultado->isEmpty())
            <div class="alert alert-warning">
                No se encuentran registros
            </div>
        @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th class='text-center'>
                    Nombre de banco
                </th>
                <th class="text-center">
                    Acción
                </th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultado as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                    <td class='text-grey text-primary text-95 text-center'>
                        <strong>   {{ $datos->nombre }}</strong>
                    </td>
                    <td>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a href="#" data-toggle="modal" data-target="#editModal{{$datos->id_banco}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#dangerModal{{$datos->id_banco}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a href="#" data-toggle="modal" data-target="#editModal{{$datos->id_banco}}" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-success-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Editar') }}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{$datos->id_banco}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form method="POST" id="banco_modal_uno" action="{{ route('configuracionEntidadesFinancieras.destroy',[Crypt::encrypt($datos->id_banco)]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{$datos->id_banco}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                        <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                            <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                                ¡Atención! </h5>
                                            <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="text-150">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                            <div class="d-flex align-items-top mr-2 mr-md-5">
                                                <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                                <div class="text-secondary-d2 text-105">
                                                    ¿Está seguro que desea eliminar el banco?
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
                        <form method="POST" id="banco_modal_dos" class="id-danger-yes-btn" action="{{ route('configuracionEntidadesFinancieras.update',[Crypt::encrypt($datos->id_banco)]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal fade" data-backdrop-bg="bgc-white" id="editModal{{$datos->id_banco}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content bgc-transparent brc-warning-m2 shadow">
                                        <div class="modal-header py-2 bgc-warning-tp1 border-0  radius-t-1">
                                            <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="warningModalLabel">
                                                Editar banco </h5>
                                            <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="text-150">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body bgc-white-tp2 p-md-4">
                                            <div>
                                                <label for="id-form-field-focus-1" class="mb-2"> {{ __('Nombre banco:') }}</label>
                                                <div class="input-group text-secondary-d2 text-105">
                                                    <input type="text" class="form-control col-sm-12" id="nombre_banco" name="nombre_banco" value="{{ $datos->nombre }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bgc-white-tp2 border-0">
                                            <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal" id="cancelButton">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn px-4 btn-warning btn-modal-cargando" id="id-danger-yes-btn">
                                                Guardar
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
        </table>
    </div>
    @include('componentes.paginacion')
    @endif
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script type="module">
        $(".btn-modal-cargando").on("click", function () {
            $('#cargando').modal('show');
        });

        $('.id-danger-yes-btn').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                nombre_banco: {
                    required: true
                }
            },

            messages: {
                nombre_banco: {
                    required: "Este campo es requerido."
                }
            },
            errorPlacement: function (error, element) {
                if (element.hasClass("form-control")) {
                    error.insertAfter(element.closest('.input-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $("#id-danger-yes-btn").on('click', function(evt){
            var form = $(this).closest('form'); // Encuentra el formulario padre del botón clickeado
            if (form.valid()) {
                $('#cargando').modal('show');
            }
        });
        $(document).ready(function(){
            // Adjunta un escuchador de eventos de clic a todos los botones con data-dismiss="modal"
            $('[data-dismiss="modal"]').on('click', function () {
                const modals = $('.modal');
                // Cierra todos los modales usando la función modal('hide')
                modals.modal('hide');
            });

            $("#limpiarCampos").on("click", function () {
                // Obtener el formulario por su ID
                const form = $("#miFormulario");

                // Limpiar los campos estableciendo su valor en cadena vacía
                form.find("input[type=text]").val('');
                form.find("select").each(function () {
                    // Establecer la opción por posición (índice) 1 (Opción 2) para cada elemento <select>
                    $(this).prop("selectedIndex", 0)
                });
            });
        });
    </script>
@endpush
