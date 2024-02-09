<div class="form-group row mt-4">
    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_categoria" name="nombre_categoria" readonly value="{{$resultadoAccion->nombre_categoria}}" />
    </div>

    <div class="col-md-4 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de Incapacidad') }}</label>
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

    <div class="col-md-4 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de boleta') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroBoleta" name="numeroBoleta" readonly value="{{$resultadoAccion->boleta}}" />
    </div>
</div>
