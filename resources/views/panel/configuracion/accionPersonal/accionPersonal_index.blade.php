@extends('Layouts.menuPanel')

@section('page-content')
    <div class="table-responsive border-t-3 brc-blue-m2">
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th class='text-center text-secondary-d2 text-95 text-600'>
                    Código
                </th>
                <th class='text-center text-secondary-d2 text-95 text-600'>
                    Nombre de acción de personal
                </th>
                <th class='text-center text-secondary-d2 text-95 text-600'>
                    Siglas
                </th>
                <th class='text-center text-secondary-d2 text-95 text-600'>
                    Estado
                </th>
                <th class="text-center text-secondary-d2 text-95 text-600">
                    Acción
                </th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultado as $datos)
            <tr class="bgc-h-blue-l4 d-style">
                <td class='d-none d-sm-table-cell text-primary-d2 text-center'>
                    <strong>{{ $datos->codigo }}</strong>
                </td>
                <td class='d-none d-sm-table-cell text-grey-d1 text-center'>
                    {{ $datos->nombre }}
                </td>
                <td class='d-none d-sm-table-cell text-grey-d1 text-center'>
                    {{ $datos->abreviatura }}
                </td>
                <td class='text-grey text-95 text-center'>
                    @if($datos->estado==="activo")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-success-d1">Activo</span>
                    @elseif($datos->estado==="inactivo")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-danger-d1">Inactivo</span>
                    @endif
                </td>
                <td class="align-middle">
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>

                            <a href="{{route("configuracionAccionPersonal.edit",[Crypt::encrypt($datos->id_categoria)])}}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
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
                                <a href="{{route("configuracionAccionPersonal.edit",[Crypt::encrypt($datos->id_categoria)])}}" class="dropdown-item">
                                    <i class="fa fa-pencil-alt text-success-m1 mr-1 p-2 w-4"></i>
                                    {{ __('Editar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <form method="POST" id="frm_categoria" action="{{ route('configuracionAccionPersonal.updateCategoria') }}">
                        <input type="hidden" name="frm_categoria[id_categoria]" value="{{Crypt::encrypt($datos->id_categoria)}}"/>
                        @csrf
                        @method('PUT')
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="editModal{{$datos->id_categoria}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bgc-transparent brc-warning-m2 shadow">
                                    <div class="modal-header py-2 bgc-warning-tp1 border-0  radius-t-1">
                                        <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="warningModalLabel">
                                            Editar acción de personal </h5>
                                        <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-150">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bgc-white-tp2 p-md-4">
                                        <div>
                                            <label for="id-form-field-focus-1" class="mb-2"> {{ __('Nombre acción de personal:') }}</label>
                                            <div class="input-group text-secondary-d2 text-105">
                                                <input type="text" class="form-control col-sm-12" value="{{$datos->nombre}}" id="nombreAccionEdit" name="frm_categoria[nombre]"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bgc-white-tp2 border-0">
                                        <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn px-4 btn-warning" id="id-danger-yes-btn">
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
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function(){
            $('#frm_categoria').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    'frm_categoria[nombre]': {
                        required: true
                    }
                },

                messages: {
                    'frm_categoria[nombre]': {
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

            $("#id-danger-yes-btn").on('click', function (evt)
            {
                if($('#frm_categoria').valid())
                {
                    $('#cargando').modal('show');
                }
                else{
                    return false;
                }
            });

            $(".btn-modal-cargando").on("click", function () {
                $('#cargando').modal('show');
            });
        });
    </script>
@endpush

