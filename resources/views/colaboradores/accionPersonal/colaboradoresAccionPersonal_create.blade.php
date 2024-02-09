@extends('Layouts.menu')

@section('page-content')
    <form id="frm-accionesPersonal" class="mt-lg-3" autocomplete="off" method="POST" action="{{route('colaboradorAccionPersonal.store')}}">
        @csrf
        <input type="text" id="id_colaborador" name="id_colaborador" value="{{ Crypt::encrypt($idColaborador) }}" hidden/>
        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoAccion" name="tipoAccion" >
                    @foreach($accionesPersonal as $accionPersonal)
                        <option value="{{ $accionPersonal->id_categoria.'-'.$accionPersonal->codigo }}">{{ $accionPersonal->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="form-accionPersonal">

        </div>

        <div class="mt-2 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Cancelar
                </a>

                <button type="button" id="registrar" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Registrar
                </button>

                <a data-toggle="modal" data-target="#prevista" id="previstaDiv" class="btn btn-outline-danger btn-text-dark btn-h-danger btn-a-danger btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                            <span class="bgc-danger h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-eye mr-1 text-white text-120 mt-3px"></i>
                            </span>
                    Vista Previa
                </a>
            </div>
        </div>


        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                            Mensaje
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        ¿Desea guardar la acción de personal?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary" id="guardar">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--vista previa de ejemplo solo es maquetado, se pasará a un blade externo-->
    <div class="modal fade " id="prevista" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-blue-d2">
                        Vista previa
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body ace-scrollbar bg-secondary">

                    <div class="modal-body ace-scrollbar">
                        <div class="card bcard mb-4">
                            <div class="card-body px-4 px-lg-5">
                                Aqui estaria la vista previa del archivo.
                            </div>
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
    <!-- vista previa de ejemplo solo es maquetado, se pasará a un blade externo-->

    @include('componentes.modalCargando')
    @include('componentes.modalExito')
    @include('componentes.modalError')
@endsection

@push('headers')
    <!--link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" rel="stylesheet"/-->
@endpush

@push('scripts')
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/language/es_ES.min.js"></script-->
@endpush
