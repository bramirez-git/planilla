<form id="form-comunicaciones" class="mt-lg-3" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Comunicaciones" hidden/>
    <input type="text" name="tab" value="comunicaciones-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-4 col-sm-12 mb-2">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Enviar entregables reportes CCSS e INS') }}</label>
            <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_reportes" name="correo_reportes" value="{{ old('correo_reportes') ?? $resultadoComunicacion->correo_reportes ??""}}"/>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Enviar a contabilidad los pagos') }}</label>
            <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_pagos" name="correo_pagos" value="{{ old('correo_pagos') ?? $resultadoComunicacion->correo_pagos ??""}}"/>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Recibir currículums') }}</label>
            <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_curriculums" name="correo_curriculums" value="{{ old('correo_curriculums') ?? $resultadoComunicacion->correo_curriculums ??""}}"/>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title=""> <i class="fa-solid fa-circle-info blue"></i> </span>{{ __('Enviar notificaciones detalle de planilla') }}
            </label>
            <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo_planilla" name="correo_planilla" value="{{ old('correo_planilla') ?? $resultadoComunicacion->correo_planilla ??""}}"/>
        </div>
    </div>
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                Cancelar
            </a>
            <button id="registrarcomunicaciones" type="button" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                Guardar
            </button>
        </div>
    </div>
    <div class="modal fade" id="confirmModalComunicaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                        Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Desea guardar datos de comunicaciones para la empresa?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button id="guardar-comunicaciones" type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form><!--validaciones-->
<script type="module">
    //2- COMUNICACIONES
    $('#guardar-comunicaciones').on('click', function(evt){
        $('#confirmModalComunicaciones').modal('hide');
        $('#cargando').modal('show');
    });
    $('#form-comunicaciones').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            correo_reportes: {
                required: true
            },
            correo_pagos: {
                required: true
            },
            correo_curriculums: {
                required: true
            }
        },
        messages: {
            correo_reportes: {
                required: "Este campo es requerido."
            },
            correo_pagos: {
                required: "Este campo es requerido."
            },
            correo_curriculums: {
                required: "Este campo es requerido."
            }
        },
        errorElement: 'span'
    });
    $("#registrarcomunicaciones").on('click', function(evt){
        if($('#form-comunicaciones').valid()){
            $('#confirmModalComunicaciones').modal('show');
        }else{
            return false;
        }
    });

</script>
