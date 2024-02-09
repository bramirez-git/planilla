<div class="form-group row mt-4">
    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_categoria" name="nombre_categoria" readonly value="{{$resultadoAccion->nombre_categoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de permiso') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_subcategoria" name="nombre_subcategoria" readonly value="{{$resultadoAccion->nombre_subcategoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre completo') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreCompleto" name="nombreCompleto" readonly value="{{$resultadoAccion->nombre_colaborador}}" />
    </div>
</div>

<div class="form-group row mt-4">

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cédula') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cedula" name="cedula" readonly value="{{$resultadoAccion->identificacion}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-1" class="mb-0 text-blue-m1" data-toggle="tooltip" data-placement="top" title=" Porcentaje del salario base en el adelanto  ">
            Porcentaje a pagar del salario
        </label>
        <div class="input-group justify-content-center">
            <input type="number" max="100" min="1" placeholder="0,00" lang="en" data-name_error="Porcentaje del salario base en el adelanto" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input valid" id="porcentaje_salario" name="porcentaje_salario" readonly value="{{$resultadoAccion->porcentaje}}" aria-describedby="porcentaje_salario_adelanto-error" aria-invalid="false">
            <div class="input-group-prepend">
                <span class="input-group-text">%</span>
            </div>
        </div>
    </div>

    @if($resultadoAccion->abreviatura_subcategoria=="PERCME")
    <div class="col-md-4 col-sm-12" id="horaDiv">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Hora') }}</label>
        <div class="input-group input-daterange">
            <input type="time" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="hora" name="hora" readonly value="{{$resultadoAccion->hora}}"/>
        </div>
    </div>
    @endif

</div>



