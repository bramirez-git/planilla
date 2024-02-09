<form class="mt-lg-3" id="form-CCSSINS" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[ $idColaborador ])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="CCSS-INS" hidden/>
    <input type="text" name="tab" value="CCSSINS-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="La Fecha de Ingreso es la fecha que el sistema registrara como la fecha oficial de inicio de labores reconocidas a nivel de CCSS e INS."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Fecha de Ingreso') }}
            </label>
            <div class="input-group input-daterange">
                <input type="text" data-inputmask-alias="date" data-fecha-ingreso="{{ old('fechaIngreso') ?? isset($resultadoINSCCSS->fecha_ingreso) ? date("d/m/Y",strtotime($resultadoINSCCSS->
                                fecha_ingreso)) : "" }}" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaIngreso" name="fechaIngreso" value="{{ old('fechaIngreso') ?? isset($resultadoINSCCSS->fecha_ingreso) ? date("d/m/Y",strtotime($resultadoINSCCSS->
                                fecha_ingreso)) : "" }}"/>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="La Fecha de Salida es la fecha que el sistema registrara como la fecha oficial de terminación de labores reconocidas a nivel de CCSS e INS."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Fecha de Salida') }}
            </label>
            <div class="input-group input-daterange">
                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaSalida" name="fechaSalida" value="{{ old('fechaSalida') ?? isset($resultadoINSCCSS->fecha_ingreso) ? ($resultadoINSCCSS->fecha_salida == "0000-00-00" ? "" : date("d/m/Y",strtotime($resultadoINSCCSS->fecha_salida))) : "" }}" readonly>
            </div>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-lg-4">
            <div class="card bcard h-100">
                <div class="card-header">
                    <span class="card-title text-125"> CCSS </span>
                </div>
                <div class="card-body">
                    <div>
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de asegurado') }}</label>
                        @php
                            $cedulaColaborador = "";
                            $nacional = "";
                            $aseguradoCCSS = "";
                            $aseguradoins = "";


                            if (empty($resultadoINSCCSS)) {

                                    if($resultadoColaborador->id_tipo_identificacion == 1)
                                    {
                                           $aseguradoCCSS  = $resultadoColaborador->identificacion;
                                            $aseguradoins  = "0".$resultadoColaborador->identificacion;
                                            $nacional      = "readonly";
                                    }
                            } else
                            {
                                     if($resultadoColaborador->id_tipo_identificacion == 1)
                                    {
                                            $aseguradoCCSS = $resultadoINSCCSS->numero_seguro_ccss;
                                            $aseguradoins  = "0".$resultadoINSCCSS->numero_seguro_ccss;
                                            $nacional      = "readonly";
                                    }else
                                    {
                                         $aseguradoCCSS = $resultadoINSCCSS->numero_seguro_ccss;
                                         $aseguradoins = $resultadoINSCCSS->numero_seguro_ccss;
                                    }

                            }
                        @endphp
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroAsegurado" name="numeroAsegurado" value="{{ old('numeroAsegurado') ?? $aseguradoCCSS ?? "" }}" {{$nacional}}/>
                    </div>
                    <div class="mt-3">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo seguro CCSS') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoSeguroCCSS" name="tipoSeguroCCSS">
                            @foreach($catalogoTipoSeguroCCSS as $datos)
                                @php $opcion=""; @endphp
                                @isset($resultadoINSCCSS->id_tipo_seguro_ccss)
                                    @if($datos->id_tipo_seguro == $resultadoINSCCSS->id_tipo_seguro_ccss)
                                        @php $opcion="selected"; @endphp
                                    @endif
                                @endisset

                                <option value="{{ $datos->id_tipo_seguro }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->nombre }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de ocupación CCSS') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoOcupacionCCSS" name="tipoOcupacionCCSS">
                            @foreach($catalogoOcupacionesCCSS as $datos)
                                @php $opcion=""; @endphp
                                @isset($resultadoINSCCSS->id_ocupacion_ccss)
                                    @if($datos->id_ocupacion == $resultadoINSCCSS->id_ocupacion_ccss)
                                        @php $opcion="selected"; @endphp
                                    @endif
                                @endisset

                                <option value="{{ $datos->id_ocupacion }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->nombre }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-3 mt-lg-0">
            <div class="card bcard h-100">
                <div class="card-header">
                    <span class="card-title text-125"> INS </span>
                </div>
                <div class="card-body">
                    <div>
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Nacionalidad INS') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="nacionalidadINS" name="nacionalidadINS">
                            @foreach($catalogoNacionalidades as $datos)
                                @php
                                    $opcion = ($resultadoINSCCSS && $datos->id_nacionalidad == $resultadoINSCCSS->id_nacionalidad_ins) ? "selected" : "";
                                    $disabled = ($resultadoColaborador->id_tipo_identificacion == 1 && $datos->codigo != "CR") ? "disabled" : "";
                                @endphp
                                <option value="{{ $datos->id_nacionalidad }}" {{$opcion}} {{$disabled}}>{{ $datos->codigo." - ".$datos->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de Identificación') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoAsegurado" name="tipoAsegurado">
                        @foreach($catalogoTipoSeguroINS as $datos)
                            @php
                                $opcion = ($resultadoINSCCSS && $datos->id_tipo_seguro == $resultadoINSCCSS->id_tipo_seguro_ins) ? "selected" : "";
                                if ($resultadoColaborador->id_tipo_identificacion == 1) {
                                    $opcion = ($datos->codigo == "CN") ? "selected" : "";
                                    $disabled = ($datos->codigo != "CN") ? "disabled" : "";
                                } else {
                                    $opcion = empty($opcion) ? (
                                        ($datos->codigo == "SN" && $resultadoColaborador->id_tipo_identificacion == 6) ? "selected" : (
                                            ($datos->id_tipo_seguro == $resultadoColaborador->id_tipo_identificacion) ? "selected" : ""
                                        )
                                    ) : $opcion;
                                    $disabled = "";
                                }
                            @endphp

                            <option value="{{ $datos->id_tipo_seguro }}" {{$opcion}} {{$disabled}}>{{ $datos->codigo." - ".$datos->nombre }}</option>
                        @endforeach



                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número  de Asegurado Riesgos de Trabajo INS') }}</label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="riesgoTrabajo" name="riesgoTrabajo" value="{{ old('riesgoTrabajo') ?? $aseguradoins ?? '' }}" />

                    </div>
                    <div class="mt-3">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de ocupación INS') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoOcupacionINS" name="tipoOcupacionINS">
                            @foreach($catalogoOcupacionesINS as $datos)
                                @php $opcion=""; @endphp
                                @isset($resultadoINSCCSS->id_ocupacion_ins)
                                    @if($datos->id_ocupacion == $resultadoINSCCSS->id_ocupacion_ins)
                                        @php $opcion="selected"; @endphp
                                    @endif
                                @endisset

                                <option value="{{ $datos->id_ocupacion }}" {{$opcion}}>{{ $datos->codigo." - ".$datos->categoria_perfil_ocupacional }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Jornada de trabajo') }} </label>
                        <select id="jornadaTrabajo" name="jornadaTrabajo" data-placeholder="Seleccione un colaborador..." class="chosen-select form-control">
                            @foreach($catalogoJornada as $datos)
                                @php $opcion=""; @endphp
                                @isset($resultadoINSCCSS->id_jornada_trabajo)
                                    @if($datos->id_jornada_trabajo == $resultadoINSCCSS->id_jornada_trabajo)
                                        @php $opcion="selected"; @endphp
                                    @endif
                                @endisset

                                <option value="{{ $datos->id_jornada_trabajo }}" {{$opcion}}>{{ $datos->nombre }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-lg-4 mt-3 mt-lg-0">
            <div class="card bcard h-100">
                <div class="card-header">
                    <span class="card-title text-125"> Tributación directa </span>
                </div>
                <div class="card-body">
                    <div>
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                            <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Pendiente de entrega."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Para el contribuyente extranjero') }}
                        </label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="tributacionDirectaExtranjero" name="tributacionDirectaExtranjero" value="{{ old('tributacionDirectaExtranjero') ?? $resultadoINSCCSS->tributacion_directa ?? ""}}"/>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i> </span> Cancelar
            </a>
            <button type="button" id="registrarINSCCSS" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i> </span> Guardar
            </button>
        </div>
    </div>
    <div class="modal fade" id="confirmModalINSCCSS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Desea guardar datos de CCSS-INS para el colaborador?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                    <button id="guardar-CCSSINS" type="submit" class="btn btn-primary"> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="module">
    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        mask:"dd/mm/yyyy",
        format: "dd/mm/yyyy"
    };

    $(document).ready(function() {
        // Función para verificar y deshabilitar el campo de fecha de salida
       /*  function actualizarEstadoFechaSalida() {
            var fechaIngreso = $('#fechaIngreso').val();
            var fechaSalida = $('#fechaSalida');

            // Verificar si hay una fecha de ingreso
            if (fechaIngreso) {
                // Habilitar el campo de fecha de salida
                fechaSalida.prop('disabled', false);
            } else {
                // Deshabilitar el campo de fecha de salida y limpiar su valor
                fechaSalida.prop('disabled', true).val('');
            }
        }
 */
        // Configurar el DatePicker para fecha de ingreso
        $('#fechaIngreso').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            calendarWeeks: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            language: 'es',
            endDate: new Date(),
        });/* .on('changeDate', function (selected) {
            // Actualizar la fecha de inicio del segundo DatePicker
            $('#fechaSalida').datepicker('setStartDate', selected.date);
            actualizarEstadoFechaSalida(); // Llamar a la función después de cambiar la fecha de ingreso
        }) */

       /*  // Configurar el DatePicker para fecha de salida
        $('#fechaSalida').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            calendarWeeks: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            language: 'es'
        });

        // Llamar a la función al cargar la página para establecer el estado inicial
        actualizarEstadoFechaSalida(); */

        // Llamar a la función también cuando el valor de #fechaIngreso cambie manualmente
       // $('#fechaIngreso').on('change', actualizarEstadoFechaSalida);
    });



    $(":input:not(select)").inputmask();
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    //CCSS INS
    $('#guardar-CCSSINS').on('click', function (evt){
        $('#confirmModalINSCCSS').modal('hide');
        $('#cargando').modal('show');
    });

    $('#form-CCSSINS').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            fechaIngreso: {
                required: true
            },
            numeroAsegurado: {
                required: true
            },
            riesgoTrabajo: {
                required: true
            }
        },

        messages: {
            fechaIngreso: {
                required: "Este campo es requerido."
            },
            numeroAsegurado: {
                required: "Este campo es requerido."
            },
            riesgoTrabajo: {
                required: "Este campo es requerido."
            }
        },
        errorElement : 'span'
    });

    $("#registrarINSCCSS").on('click', function (evt){
        if($('#form-CCSSINS').valid()){
            $('#confirmModalINSCCSS').modal('show');
        }else{
            return false;
        }
    });

    $("#tipoAsegurado").on('change', function(evt){
        if($("#tipoAsegurado").val()==1) {
            $("#numeroAsegurado").val({{$resultadoColaborador->identificacion}});
            $("#riesgoTrabajo").val("0" + {{$resultadoColaborador->identificacion}});
            $("#numeroAsegurado").prop("readonly",true);
            //$("#riesgoTrabajo").prop("readonly",true);
        }else{
            $("#numeroAsegurado").val("");
            $("#riesgoTrabajo").val("");
            $("#numeroAsegurado").prop("readonly",false);
            //$("#riesgoTrabajo").prop("readonly",false);
        }
    });
</script>
