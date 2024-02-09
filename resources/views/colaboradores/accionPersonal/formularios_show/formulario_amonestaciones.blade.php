
<div class="form-group row mt-4">
    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_categoria" name="nombre_categoria" readonly value="{{$resultadoAccion->nombre_categoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de Amonestación') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_subcategoria" name="nombre_subcategoria" readonly value="{{$resultadoAccion->nombre_subcategoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cédula') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cedula" name="cedula" readonly value="{{$resultadoAccion->identificacion}}" />
    </div>

</div>

<div class="form-group row mt-4">

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre completo') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreCompleto" name="nombreCompleto" readonly value="{{$resultadoAccion->nombre_colaborador}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Amonestación') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaAmonestacion" name="fechaAmonestacion" readonly value="{{$resultadoAccion->fechas1}}" />
    </div>

    <div class="col-md-4 col-sm-12" id="fechaSuspensionDiv" @if($resultadoAccion->abreviatura_subcategoria != "AMOMG") style="display: none;" @endif>
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de suspensión') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaSuspension" name="fechaSuspension" readonly value="{{$resultadoAccion->fechas2}}" />
    </div>
</div>

<div class="form-group row mt-4">

    <div class="col-md-3 col-sm-12" id="afectaGoceDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Amonestación implica') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="afectaGoce" name="afectaGoce" readonly value="{{$resultadoAccion->tipo}}" />
    </div>

</div>

<div class="form-group row mt-4" id="descripcionDIV" @if($resultadoAccion->abreviatura_subcategoria != "AMOLEV") style="display: none;" @endif>
    <div class="col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción') }}</label>
        <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcion" name="descripcion" readonly >{{$resultadoAccion->comentarios}}</textarea>
    </div>
</div>
