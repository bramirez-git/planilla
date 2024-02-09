
<div class="modal fade" id="calcularEmbargos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-blue-d2">
                    Calculadora de embargo
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body ace-scrollbar">
                <div class="form-group row mt-3">
                    <div class="col-md-6 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Salario bruto mensual</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₡</span>
                            </div>
                            <input type="text" min="0" step="0.5" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="salarioBrutoMensual" name="salarioBrutoMensual" required="true"/>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Pensiones alimenticias (si aplica)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₡</span>
                            </div>
                            <input type="text" min="0" step="0.5" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="pensionesAlimenticias" name="pensionesAlimenticias" required="true"/>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-md-6 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Otro embargo #1 (si aplica)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₡</span>
                            </div>
                            <input type="text" min="0" step="0.5" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="otroEmbargo1" name="otroEmbargo1" required="true"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Otro embargo #2 (si aplica)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₡</span>
                            </div>
                            <input type="text" min="0" step="0.5" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="otroEmbargo2" name="otroEmbargo2" required="true"/>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-md-3 col-sm-12">
                        <button type="button" id="calcularEmbargo" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-calculator mr-1 text-white text-120 mt-3px"></i>
                            </span>
                            Calcular
                        </button>
                    </div>
                </div>
                <div class="form-group row mt-4" id="divTotalEmbargar" style="display: none;">
                    <div class="col-sm-12">
                        <p class="alert bgc-secondary-l4 brc-green-m1 border-0 border-l-4 radius-0 text-dark-tp2 mb-1">
                            Total a embargar:
                            <label id="totalEmbargar">₡ 400 000</label>
                        </p>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script type="module">
        $('#calcularEmbargo').on('click', function (evt)
        {
            //aqui se extraeria el calculo

            //aqui se cambiaria el total por lo obtenido
            document.getElementById('totalEmbargar').innerHTML = "₡ 300 000";

            //se muestra el div
            $('#divTotalEmbargar').show();
        });

        $('#cerrarX').on('click', function (evt)
        {
            $('#divTotalEmbargar').hide();
        });

        $('#cerrar').on('click', function (evt)
        {
            $('#divTotalEmbargar').hide();
        });
    </script>
@endpush
