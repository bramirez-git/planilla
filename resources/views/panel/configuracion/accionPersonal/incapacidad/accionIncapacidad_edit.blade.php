@extends('Layouts.menuPanel')

@section('page-content')
    <!--<div class="p-3 ace-scroll" data-ace-scroll='{"height": 500, "autohide":false, "color": "grey"}'>-->
    <form class="mt-lg-3" id="frm-incapacidades" name="frm-incapacidades" autocomplete="off" method="POST" action="{{route('configuracionAccionIncapacidad.update',['5'])}}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-lg-4 col-sm-6 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Incapacidad INS
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">
                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>Si está amparado por la póliza de Riesgos del Trabajo (RT) el cálculo de su salario está basado en las últimas 3 planillas reportadas ante el INS por el seguro de Riesgos del Trabajo, antes de la fecha del accidente.</p>
                            <p>Durante los primeros 45 días de incapacidad, El INS paga el 60% de su salario diario, después del día 46 en adelante, EL INS ajusta a un 67% aproximadamente.</p>
                        </div>

                        <div class="p-3">
                            <p>En esta opci&oacute;n como Patrono puedo reconocer un subsidio adicional entre el 0% y el 40% durante los primeros 45 días de incapacidad</p>
                            <p>Deseo Reconocer el siguiente porcentaje como un subsidio para el colaborador entre el dia 1 y 45 de incapacidad</p>
                            <p>
                                <div class="input-group">
                                    <input type="text" readonly max="40" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="porcentajePatronoINS" name="porcentajePatronoINS" value="40">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </p>
                            <p> Deseo reconocer el siguiente Porcentaje despu&eacute;s del d&iacute;a 46 de incapacidad.</p>
                            <p class="mb-0">
                                <div class="input-group">
                                    <input type="text" readonly max="33" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="porcentajePatronoINS2" name="porcentajePatronoINS2" value="33">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            <div class="col-lg-4 col-sm-6 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3 h-100" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Incapacidad CCSS
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">

                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>Si se recurre a una incapacidad brindada por la CCSS, los primeros tres días son cubiertos por el patrono, pagando un 50% del salario como subsidio por enfermedad. A partir del cuarto día, el seguro de salud de la CCSS paga el 60% del salario como subsidio.</p>
                        </div>

                        <div class="p-3">
                            <p>En esta opci&oacute;n como Patrono puedo reconocer un subsidio adicional entre el 0% y el 40% después de los 45 días de incapacidad.</p>
                            <p>Deseo Reconocer el siguiente porcentaje como un subsidio para el colaborador después del cuarto día de incapacidad</p>
                            <p>
                            <div class="input-group">
                                <input type="text" readonly max="40" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="porcentajePatronoINS" name="porcentajePatronoINS" value="40">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            <div class="col-lg-4 col-sm-6 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3 h-100" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Maternidad CCSS
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">

                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>La licencia de maternidad consta de cuatro meses exactos. Durante este periodo
                                la embarazada devenga el salario completo. </p>
                        </div>

                        <div class="p-3">
                            <p>La CCSS paga el 50% del salario y la
                                persona empleadora tiene que pagar el otro 50%.</p>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-sm-6 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3 h-100" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Paternidad CCSS
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">

                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>El padre biológico podrá optar por una licencia de paternidad de dos días a la semana,
                                durante las primeras cuatro semanas de vida, a partir del nacimiento de su hija o hijo.
                                En caso de fallecimiento de la madre se otorgará una licencia de tres meses para el padre
                                biológico que se haga cargo del menor de edad. </p>
                        </div>

                        <div class="p-3">
                            <p>La CCSS paga el 50% del salario y la
                                persona empleadora tiene que pagar el otro 50%.</p>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            <div class="col-lg-4 col-sm-6 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3 h-100" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Adopción CCSS
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">

                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>Los padres adoptivos también podrán disfrutar de una licencia de paternidad.
                                Si la adopción es individual se brinda por tres meses, pero si la adopción es
                                conjunta, la licencia de tres meses podrá dividirse entre las personas adoptantes,
                                ya sea para tomarla de forma simultánea o alterna, según lo decidan las partes. </p>
                        </div>

                        <div class="p-3">
                            <p>La CCSS paga el 50% del salario y la
                                persona empleadora tiene que pagar el otro 50%.</p>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            <div class="col-lg-4 col-sm-6 mt-3 mt-sm-0 cards-container" id="card-container-12">
                <div class="card bgc-primary-d3 h-100" id="card-13" draggable="true">
                    <div class="card-header">
                        <h5 class="card-title text-125 text-white pt-1">
                            Invalidez CCSS
                        </h5>
                        <div class="card-toolbar no-border">
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body p-0 text-white collapse show">

                        <div class="alert bgc-blue-l3 brc-blue-l1 text-dark-tp2" role="alert">
                            <p>La incapacidad permanente se da cuando el trabajador no se recupera al 100%
                                tras una incapacidad temporal. Esto puede darse por diferentes causas. Sin embargo,
                                cuando la incapacidad permanente es ocasionada por enfermedad o accidente de trabajo,
                                el patrono debe responder ante el trabajador. </p>
                        </div>

                        <div class="p-3">
                            <p>Para este caso, el trabajador el derecho a una renta anual vitalicia, la cual también se
                                paga mes a mes. El valor de la misma es del 100 % de su salario anual, con un límite de
                                36,000 colones y el 67% sobre el exceso de esa suma. Además, ninguna renta mensual por
                                incapacidad total puede ser inferior a 1,500 colones (o la suma mayor que se fije
                                reglamentariamente).</p>
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

        $('#frm-incapacidades').validate({
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
            if($('#frm-incapacidades').valid())
            {
                $('#confirmModal').modal('show');
            }
            else{
                return false;
            }
        });

    </script>
@endpush
