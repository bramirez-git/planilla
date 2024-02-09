
<div class="form-group row mt-4">
    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_categoria" name="nombre_categoria" readonly value="{{$resultadoAccion->nombre_categoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de terminación de contrato') }}</label>
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
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de salida') }}</label>
        <input type="text"  class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaSalida" name="fechaSalida" readonly  value="{{$resultadoAccion->fechas1}}"/>
    </div>

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Salario Bruto') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="salarioBruto" name="salarioBruto" readonly value="{{$resultadoAccion->salario_bruto}}"/>
        </div>
    </div>
</div>

<div class="form-group row mt-4">

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Dias de vacaciones') }}</label>
        <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="diasVacaciones" name="diasVacaciones" readonly value="{{$resultadoAccion->dias_vacaciones}}" />
    </div>

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Monto a pagar vacaciones') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="montoVacaciones" name="montoVacaciones" readonly value="{{$resultadoAccion->monto_vacaciones}}" />
        </div>
    </div>

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Aguinaldo acumulado') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="aguinaldoAcumulado" name="aguinaldoAcumulado" readonly value="{{$resultadoAccion->monto_vacaciones}}" />
        </div>
    </div>

</div>

<div class="form-group row mt-4">

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Otros Rebajos') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="otrosRebajos" name="otrosRebajos" readonly value="{{$resultadoAccion->deducciones}}" />
        </div>
    </div>

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Asociacion solidarista') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="asociacionSolidarista" name="asociacionSolidarista" readonly value="{{$resultadoAccion->asociacion_solidarista}}" />
        </div>
    </div>

    <div class="col-md-4 col-sm-12" id="cesantiaDiv" @if($resultadoAccion->abreviatura_subcategoria=="TERREN" || $resultadoAccion->abreviatura_subcategoria=="TERSRP" ) style="display: none" @endif>
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Monto de cesantía') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cesantia" name="cesantia" readonly  value="{{$resultadoAccion->monto_cesantia}}" />
    </div>

</div>

<div class="form-group row mt-4" >

    <div class="col-md-4 col-sm-12" id="preavisoDiv" @if($resultadoAccion->abreviatura_subcategoria!="TERCRP") style="display: none" @endif>
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cantidad de días de preaviso') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="preaviso" name="preaviso" readonly  value="{{$resultadoAccion->monto_preaviso}}" />
    </div>

    <div class="@if($resultadoAccion->abreviatura_subcategoria=="TERCRP") col-md-8 @endif col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Comentarios adicionales') }}</label>
        <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcion" name="descripcion" readonly>{{$resultadoAccion->comentarios}}</textarea>
    </div>
</div>
