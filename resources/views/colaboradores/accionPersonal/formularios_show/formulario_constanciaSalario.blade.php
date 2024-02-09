
<div class="form-group row mt-4">
    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_categoria" name="nombre_categoria" readonly value="{{$resultadoAccion->nombre_categoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de constancia') }}</label>
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
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Ocupación') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="ocupacion" name="ocupacion" readonly value="{{$resultadoAccion->ocupacion}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de inicio de labores') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicioLabores" name="fechaInicioLabores" readonly value="{{$resultadoAccion->fechas1}}" />
    </div>
</div>

<div class="form-group row mt-4">
    <div class="col-md-4 col-sm-12" id="fechaSalidaDiv" @if($resultadoAccion->abreviatura_subcategoria != "CONPLA") style="display: none;" @endif>
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de salida') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaSalida" name="fechaSalida" readonly value="{{$resultadoAccion->fechas2}}" />
    </div>

    <div class="col-md-4 col-sm-12" id="ultimoSalarioBrutoDiv" @if($resultadoAccion->abreviatura_subcategoria != "CONSAL") style="display: none;" @endif>
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Ultimo mes salario bruto') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="ultimoSalarioBruto" name="ultimoSalarioBruto" readonly value="{{$resultadoAccion->salario_bruto}}" />
    </div>

    <div class="col-md-4 col-sm-12" id="deduccionesDiv" @if($resultadoAccion->abreviatura_subcategoria != "CONSAL") style="display: none;" @endif>
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Deducciones') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="deducciones" name="deducciones" readonly value="{{$resultadoAccion->deducciones}}" />
    </div>

    <div class="col-md-4 col-sm-12" id="salarioNetoDiv" @if($resultadoAccion->abreviatura_subcategoria != "CONSAL") style="display: none;" @endif>
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Salario neto') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="salarioNeto" name="salarioNeto" readonly value="{{$resultadoAccion->salario_neto}}" />
    </div>
</div>
