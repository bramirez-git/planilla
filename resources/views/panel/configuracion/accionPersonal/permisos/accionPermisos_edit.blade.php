@extends('Layouts.menuPanel')

@section('page-content')
    <form class="mt-lg-3" id="frm-permisos" name="frm-permisos" autocomplete="off" method="POST" action="{{route('configuracionAccionPermisos.update',['5'])}}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-lg-6 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3 h-100" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Sin goce salarial
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">
                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>Si un empleado solicita permiso para ausentarse en un dia o varios días en especifico
                                y no lo desea tomar como vacaciones, puede solicitar un permiso sin goce salarial.</p>
                        </div>

                        <div class="p-3">
                            <p>Se solicitará mediante un calendario la o las fechas para el permiso sin goce salarial.</p>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            <div class="col-lg-6 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Con goce salarial
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">
                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>Si un empleado solicita permiso para ausentarse en un dia o varios días en especifico
                                y no lo desea tomar como vacaciones, puede solicitar un permiso con goce salarial
                                según el porcentaje que acuerde el patrono.</p>
                        </div>

                        <div class="p-3">
                            <p>Se solicitará mediante un calendario la o las fechas para el permiso con goce salarial.</p>

                            <p>El porcentaje que se desea pagar al goce de salario será de:</p>
                            <p class="mb-0">
                                <div class="input-group">
                                    <input type="text" readonly max="100" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="porcentajePatronoINS2" name="porcentajePatronoINS2" value="100">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </div>


        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
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
                    Modificar
                </button>
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
                        ¿Desea modificar el registro de incapacidades?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary" id="guardar">
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('componentes.modalCargando')
@endsection

@push('scripts')
    <script type="module">
        $('#guardar').on('click', function (evt)
        {
            $('#confirmModal').modal('hide');
            $('#cargando').modal('show');
        });

        $('#frm-permisos').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                porcentajePaternidadCCSS: {
                    required: true
                },
                porcentajePaternidadPatrono: {
                    required: true
                },
                porcentajeMaternidadCCSS: {
                    required: true
                },
                porcentajeMaternidadPatrono: {
                    required: true
                },
                porcentajeAdopcionCCSS: {
                    required: true
                },
                porcentajeAdopcionPatrono: {
                    required: true
                }
            },

            messages: {
                porcentajePaternidadCCSS: {
                    required: "Este campo es requerido."
                },
                porcentajePaternidadPatrono: {
                    required: "Este campo es requerido."
                },
                porcentajeMaternidadCCSS: {
                    required: "Este campo es requerido."
                },
                porcentajeMaternidadPatrono: {
                    required: "Este campo es requerido."
                },
                porcentajeAdopcionCCSS: {
                    required: "Este campo es requerido."
                },
                porcentajeAdopcionPatrono: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrar").on('click', function (evt)
        {
            if($('#frm-permisos').valid())
            {
                $('#confirmModal').modal('show');
            }
            else{
                return false;
            }
        });

    </script>
@endpush
