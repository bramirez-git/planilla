
<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de constancia') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="subTipoAccion" name="subTipoAccion" >
            @foreach($accionesTerminacionContrato as $accionTerminacionContrato)
                <option value="{{ $accionTerminacionContrato->id_subcategoria."-".$accionTerminacionContrato->abreviatura }}">{{ $accionTerminacionContrato->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre completo') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreCompleto" name="nombreCompleto" readonly value="{{$resultadoColaborador['nombre']}}" />
    </div>

    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cédula') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cedula" name="cedula" readonly value="{{$resultadoColaborador['identificacion']}}" />
    </div>

    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de salida') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaSalida" name="fechaSalida" readonly />
        </div>
    </div>
</div>

<div class="form-group row mt-4">

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Salario Bruto') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="salarioBruto" name="salarioBruto" readonly value="{{$resultadoColaborador['salario_bruto']}}"/>
        </div>
    </div>

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Dias de vacaciones') }}</label>
        <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="diasVacaciones" name="diasVacaciones" readonly value="{{$resultadoColaborador['dias_vacaciones']}}" />
    </div>

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Monto a pagar vacaciones') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="montoVacaciones" name="montoVacaciones" readonly  value="{{$resultadoColaborador['monto_vacaciones']}}" />
        </div>
    </div>

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Aguinaldo acumulado') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="aguinaldoAcumulado" name="aguinaldoAcumulado" readonly  value="{{$resultadoColaborador['aguinaldo_acumulado']}}" />
        </div>
    </div>

</div>

<div class="form-group row mt-4">

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Otros Rebajos') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="otrosRebajos" name="otrosRebajos" />
        </div>
    </div>

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Asociacion solidarista') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="asociacionSolidarista" name="asociacionSolidarista" />
        </div>
    </div>

    <div class="col-md-3 col-sm-12" id="preavisoDiv">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cantidad de días de preaviso') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="preaviso" name="preaviso"  />
    </div>

    <div class="col-md-3 col-sm-12" id="cesantiaDiv">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Monto de cesantía') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cesantia" name="cesantia" />
    </div>

</div>


<div class="form-group row mt-4" >
    <div class="col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Comentarios adicionales') }}</label>
        <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcion" name="descripcion" ></textarea>
    </div>
</div>

<script type="module">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#subTipoAccion').on('change', function(evt)
    {
        let tipoAccion = $('#subTipoAccion').val().split("-")[1];

        if(tipoAccion=="TERCRP")
        {
            $('#preavisoDiv').show();
        }
        else{
            $('#preavisoDiv').hide();
        }

        if(tipoAccion=="TERCRP" || tipoAccion=="TERJUB")
        {
            $('#cesantiaDiv').show();
        }
        else{
            $('#cesantiaDiv').hide();
        }
    });

    //fecha mascara
    $('#fechaSalida').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: false,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        startDate: '-1Y'
    });
</script>
