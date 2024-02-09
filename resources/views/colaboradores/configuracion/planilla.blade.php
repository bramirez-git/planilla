<form class="mt-lg-3" id="form-Planilla-config" autocomplete="off" method="PUT" action="{{ route('administracionEmpresa.edit', [Crypt::encrypt(session()->get("id_cliente"))]) }}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Ocupaciones" hidden/>
    <input type="text" name="tab" value="planilla-tab" hidden/>
</form>
<form class="mt-lg-3" id="form-Planilla" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Planilla" hidden/>
    <input type="text" name="tab" value="planilla-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Ocupación') }} </label>
            <select id="puestoEmpresa" name="puestoEmpresa" data-placeholder="Seleccione una opción..." class="chosen-select form-control">
                @foreach($catalogoPuestos as $datos)
                    @php $opcion=""; @endphp
                    @isset($resultadoPlanillas->id_puesto)
                        @if($datos->id_puesto == $resultadoPlanillas->id_puesto)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset

                    <option value="{{ $datos->id_puesto }}" {{$opcion}}>{{ $datos->nombre }}</option>

                @endforeach
            </select>
            <a href="{{ route('link_config_ocupaciones') }}" id="submitLink">Configurar</a>
        </div>
        <div class="col-md-3 col-sm-12" hidden>
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1" > {{ __('Perfil ocupacional') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="perfilOcupacional" name="perfilOcupacional" value="NO-USO"/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="El departamento se puede cambiar en esta sección y/o en la edición de datos del colaborador."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Departamento') }}
            </label>
            <select id="idDepartamento" name="idDepartamento" data-placeholder="Seleccione una opción..." class="chosen-select form-control">
                @foreach($catalogoDepartamentos as $datos)
                    @php $opcion=""; @endphp
                    @isset($resultadoPlanillas->id_departamento)
                        @if($datos->id_departamento == $resultadoPlanillas->id_departamento)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset

                    <option value="{{ $datos->id_departamento }}" {{$opcion}}>{{ $datos->nombre }}</option>

                @endforeach
            </select>
            <a href="{{ route('link_config_departamentos') }}" id="submitLink">Configurar</a>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de planilla') }}</label>
            <div>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" name="tipoPlanilla">
                    @php
                        $opcion = "";
                    @endphp
                    @foreach($catalogoTipoPlanilla as $datos)
                        @php
                            $opcion = "";
                        @endphp
                        @isset($resultadoPlanillas->id_tipo_planilla)
                            @if($datos->id_tipo_planilla == $resultadoPlanillas->id_tipo_planilla)
                                @php
                                    $opcion = "selected";
                                @endphp
                            @endif
                        @endisset

                        <option value="{{ $datos->id_tipo_planilla }}" {{$opcion}}>{{ $datos->nombre }}</option>

                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }} </label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="moneda" name="moneda">
                @foreach($catalogoMonedas as $datos)
                    @php $opcion=""; @endphp
                    @isset($resultadoPlanillas->id_moneda)
                        @if($datos->id_moneda == $resultadoPlanillas->id_moneda)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset

                    <option value="{{ $datos->id_moneda }}" {{$opcion}}>{{ $datos->leyenda }}</option>

                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Pendiente de definir."> <i class="fa-solid fa-circle-info blue"></i> </span> {{ __('Salario base') }}
            </label>
            <input type="text" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="salarioBase" name="salarioBase" value="{{ old('salarioBase') ?? $resultadoPlanillas->salario_base ?? ""}}"/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo de jornada') }} </label>
            <select id="tipoTrabajo" name="tipoTrabajo" data-placeholder="Seleccione una opción..." class="chosen-select form-control">
                @foreach($catalogoTipoTrabajo as $datos)
                    @php $opcion=""; @endphp
                    @isset($resultadoPlanillas->id_tipo_trabajo)
                        @if($datos->id_tipo_trabajo == $resultadoPlanillas->id_tipo_trabajo)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset

                    <option value="{{ $datos->id_tipo_trabajo }}" {{$opcion}}>{{ $datos->nombre }}</option>

                @endforeach
            </select>
        </div>
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Es jefatura?') }} </label>
                <br>
                @php
                    $opcion="";
                @endphp
                @if(isset($resultadoPlanillas->jefe))
                    @if($resultadoPlanillas->jefe==1)
                        @php
                            $opcion="checked";
                        @endphp
                    @endif
                @endif
                <input type="checkbox" name="jefatura" class="ace-switch input-lg ace-switch-bars-h ace-switch-check ace-switch-times text-grey-l2 bgc-orange-d2 radius-2px" {{$opcion}}/>
            </div>
    </div>
    
    <hr>
    <h2>Tramos de Renta</h2>
    <div class="row mb-475">
            <div class="col-12">
                <div class="table-responsive border-t-3 brc-blue-m2">
                    <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                        <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>
                            <th class="text-center text-secondary-d2 text-95 text-600">
                                Tramo
                            </th>

                            <th class='text-center text-secondary-d2 text-95 text-600'>
                                Tarifa
                            </th>
                        </tr>
                        </thead>

                        <tbody class="mt-1">
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <div class="input-group-prepend">
                                        <span class="mr-1 mt-2">Sobre el exceso de </span>
                                        <span class="input-group-text mx-1">₡ {{number_format($resultado->tramo1_inicio, 2) }}</span>
                                    </div>

                                    <span class="mr-1 mt-2"> (aproximadamente US$1 340) y hasta </span>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text mx-1">₡ {{number_format($resultado->tramo1_final, 2) }}</span>
                                        
                                    </div>
                                    <span class="mt-2"> (aproximadamente US$1 960) </span>
                                </div>
                            </td>
                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text mx-1">{{number_format($resultado->tarifa1, 2) }}</span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mx-1">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <span class="mr-1 mt-2">Sobre el exceso de </span>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text mx-1">₡ {{number_format($resultado->tramo2_inicio, 2) }}</span>
                                        
                                    </div>
                                    <span class="mr-1 mt-2"> (aproximadamente US$1 960) y hasta </span>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text mx-1 mx-1">₡ {{number_format($resultado->tramo2_final, 2) }}</span>
                                        
                                    </div>
                                    <span class="mt-2"> (aproximadamente US$3 430) </span>
                                </div>
                            </td>
                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text mx-1">{{number_format($resultado->tarifa2, 2) }}</span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mx-1">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <span class="mr-1 mt-2">Sobre el exceso de </span>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text mx-1">₡ {{number_format($resultado->tramo3_inicio, 2) }}</span>
                                        
                                    </div>
                                    <span class="mr-1 mt-2">  (aproximadamente US$3 430) y hasta </span>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text mx-1">₡ {{number_format($resultado->tramo3_final, 2) }}</span>
                                        
                                    </div>
                                    <span class="mt-2"> (aproximadamente US$6 860) </span>
                                </div>
                            </td>
                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text mx-1">{{number_format($resultado->tarifa3, 2) }}</span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mx-1">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">
                            <td class="text-grey-d1">
                                <div class="input-group text-left">
                                    <span class="mr-1 mt-2">Sobre el exceso de </span>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text mx-1">₡ {{number_format($resultado->tramo4, 2) }}</span>
                                        
                                    </div>
                                    <span class="mt-2"> (aproximadamente US$6 860) </span>
                                </div>
                            </td>

                            <td class='text-grey-d1 text-center'>
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text mx-1">{{number_format($resultado->tarifa4, 2) }}</span>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mx-1">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i> </span> Cancelar
            </a>
            <button type="button" id="registrarPlanilla" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i> </span> Guardar
            </button>
        </div>
    </div>
    <div class="modal fade" id="confirmModalPlanilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Desea guardar datos de planilla para el colaborador?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" id="guardar-Planilla" class="btn btn-primary"> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script type="module">
    setupNumberInputValidation();
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    $('#configurar-link').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        // Obtén el formulario por su ID
        var formulario=$('#form-Planilla-config');
        // Envía el formulario
        formulario.submit();
    });
    //Planilla
    $('#guardar-Planilla').on('click', function (evt){
        $('#confirmModalPlanilla').modal('hide');
        $('#cargando').modal('show');
    });


    $('#form-Planilla').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            salarioBase: {
                required: true
            },
            tipoPlanilla: {
                required: true
            }
        },

        messages: {
            salarioBase: {
                required: "Este campo es requerido."
            },
            tipoPlanilla: {
                required: "Este campo es requerido."
            }
        },
        errorElement : 'span'
    });

    $("#registrarPlanilla").on('click', function (evt){
        if($('#form-Planilla').valid()){
            $('#confirmModalPlanilla').modal('show');
        }else{
            return false;
        }
    });

</script>
