@extends('Layouts.menuPanel')

@section('page-content')

    <form class="mt-lg-3" id="frm_salario_min" autocomplete="off" method="POST" action="{{route('configuracionSalarioMinimo.update',[Crypt::encrypt('12345')])}}">
        @csrf
        @method('PUT')
        <div class="form-group row mt-3">

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Salario mínimo actual </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" lang="en" value="{{number_format($result_salario_base->monto??0.00,2)}}" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="salarioMinimo" name="salarioMinimo">
                </div>
            </div>

            <div class="col-md-3 col-sm-12 align-self-end">
                <button type="button" id="btn_guardar" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-pen-to-square mr-1 text-white text-120 mt-3px"></i>
                                </span>
                    Actualizar
                </button>
            </div>

        </div>

    </form>

    <br>
    <div class="row mb-475">
        <div class="col-12">
            <div class="pb-3">
                <div class="bcard">
                    <ul class="nav nav-tabs bgc-secondary-l2 border-y-1 brc-secondary-l2" role="tablist">
                        <li class="nav-item mr-2px">
                            <a id="listaSalarios-tab" class="d-style active btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#listaSalarios" role="tab" aria-controls="listaSalarios" aria-selected="true">
                                <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                                Lista de salarios
                            </a>
                        </li>

                        <li class="nav-item mr-2px">
                            <a id="siglasSalario-tab" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#siglasSalario" role="tab" aria-controls="siglasSalario" aria-selected="false">
                                <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n3px"></span>
                                Siglas y Salarios Mínimos
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content bgc-white p-35 border-0">
                        <div class="tab-pane fade show active text-95" id="listaSalarios" role="tabpanel" aria-labelledby="home1-tab-btn">

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

                                                    <div style="width:400px;" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
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
                                                                </div>

                                                                <hr class="brc-default-l3" />

                                                                <div class="d-flex align-items-center px-2 px-md-3">
                                                                    <div class="mr-4">Ordenar por:</div>
                                                                    <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[orden]">
                                                                        <option value="ocupacion" @if($orden=="ocupacion") selected @endif>Profesión</option>
                                                                        <option value="siglas" @if($orden=="siglas") selected @endif>Sigla</option>
                                                                    </select>
                                                                </div>

                                                                <hr class="brc-default-l3" />

                                                                <div class="d-flex align-items-center px-2 px-md-3 mb-md-3">
                                                                    <div class="mr-4">Tipo de orden:</div>
                                                                    <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="filtro[tipo_orden]">
                                                                        <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente</option>
                                                                        <option value="DESC" @if($tipo_orden=="DESC") selected @endif>Descendente</option>
                                                                    </select>
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
                                                <a href="{{ route('configuracionSalarioMinimo.edit',[Crypt::encrypt('12345')])}}" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                                                    <i class="nav-icon fa fa-retweet"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($result_salario_minimo->isEmpty())
                                <div class="alert alert-warning">
                                    No se encuentran registros
                                </div>
                            @else
                            <div class="table-responsive border-t-3 brc-blue-m2">
                                <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                    <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                                    <tr>
                                        <th class="text-left text-secondary-d2 text-95 text-600">
                                            Profesión
                                        </th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">
                                            Sigla
                                        </th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">
                                            Monto
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody class="mt-1">
                                    @foreach($result_salario_minimo as $datos)
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td class="text-95 text-primary-d2 align-middle">
                                          <strong>{{ $datos->ocupacion }}</strong>
                                        </td>

                                        <td class='text-grey text-95 align-middle'>
                                            {{ $datos->siglas }}
                                        </td>

                                        <td class='text-grey text-95 align-middle'>
                                            ₡ {{ number_format($datos->salario??0.00,2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('componentes.paginacion')
                            @endif
                        </div>

                        <div class="tab-pane fade text-95" id="siglasSalario" role="tabpanel" aria-labelledby="profile1-tab-btn">
                            <div class="d-flex flex-column flex-md-row justify-content-between">
                                <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                                </div>
                                <div class="text-nowrap align-self-start pl-md-2">
                                    <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                                        <div class="d-flex flex-row-reverse">
                                            <div class="px-1">

                                            </div>
                                            <div class="px-1">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive border-t-3 brc-blue-m2">
                                <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                    <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                                    <tr>
                                        <th class="text-left text-secondary-d2 text-95 text-600">
                                            Siglas
                                        </th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">
                                            Detalles
                                        </th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">
                                            Monto
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody class="mt-1">
                                    @foreach($result_clasificacion_salario as $datos)
                                        <tr class="bgc-h-blue-l4 d-style">
                                            <td class="text-95 text-primary-d2 align-middle">
                                                <strong>{{ $datos->siglas }}</strong>
                                            </td>

                                            <td class='text-grey text-95 align-middle'>
                                                {{ $datos->clasificacion }}
                                            </td>

                                            <td class='text-grey text-95 align-middle'>
                                                ₡ {{ number_format($datos->salario_minimo??0.00,2) }}
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
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $("#btn_guardar").on('click', function (evt)
            {
                if($('#frm_salario_min').valid())
                {
                    $('#cargando').modal('show');
                    $('#frm_salario_min').submit();
                }
                else{
                    return false;
                }
            });
            $('#frm_salario_min').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    salarioMinimo: {
                        required: true
                    }
                },
                messages: {
                    salarioMinimo: {
                        required: "Este campo es requerido."
                    }
                },
                errorPlacement: function(error, element){
                    if(element.hasClass("form-control")){
                        error.insertAfter(element.closest('.input-group'));
                    }else{
                        error.insertAfter(element);
                    }
                }
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
                form.find("select").each(function () {
                    // Establecer la opción por posición (índice) 1 (Opción 2) para cada elemento <select>
                    $(this).prop("selectedIndex", 0)
                });
            });
        });
    </script>
@endpush
