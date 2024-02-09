
<div class="form-group row mt-4">
    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_categoria" name="nombre_categoria" readonly value="{{$resultadoAccion->nombre_categoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de modificación salarial') }}</label>
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
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de regimiento') }}</label>
        <input type="text"  class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaRegimiento" name="fechaRegimiento" readonly value="{{$resultadoAccion->fechas1}}"/>
    </div>

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Aplica aumento salarial') }}</label>
        <input type="text"  class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="aplicaAumentoSalarial" name="aplicaAumentoSalarial" readonly @if($resultadoAccion->aumento == 1) value="SI" @else value="NO" @endif/>
    </div>
</div>

<div class="form-group row mt-4">
    @if($resultadoAccion->aumento == 1)
        <div class="col-md-4 col-sm-12" id="nuevoSalarioDiv">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nuevo Salario Base') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="spanSignoMoneda input-group-text">
                        {{'₡'}}
                    </span>
                </div>
                <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nuevoSalarioBase" name="nuevoSalarioBase" readonly value="{{$resultadoAccion->nuevo_salario}}"/>
            </div>
        </div>
    @endif

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Puesto') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="puesto" name="puesto" readonly value="{{$resultadoAccion->ocupacion}}" />
    </div>

</div>
