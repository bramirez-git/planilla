
<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de constancia') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="subTipoAccion" name="subTipoAccion" >
            @foreach($accionesConstancias as $accionConstancia)
                <option value="{{ $accionConstancia->id_subcategoria."-".$accionConstancia->abreviatura }}">{{ $accionConstancia->nombre }}</option>
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
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Ocupación') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="ocupacion" name="ocupacion" readonly value="{{$resultadoColaborador['puesto_colaborador']}}" />
    </div>

</div>

<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de inicio de labores') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicioLabores" name="fechaInicioLabores" readonly value="{{$resultadoColaborador['fecha_ingreso']}}" />
    </div>
    <div class="col-md-3 col-sm-12" id="fechaSalidaDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de salida') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaSalida" name="fechaSalida" readonly value="{{$resultadoColaborador['fecha_salida']}}" />
    </div>

    <div class="col-md-3 col-sm-12" id="ultimoSalarioBrutoDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Ultimo mes salario bruto') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="ultimoSalarioBruto" name="ultimoSalarioBruto" readonly value="{{$resultadoColaborador['salario_bruto']}}" />
    </div>

    <div class="col-md-3 col-sm-12" id="deduccionesDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Deducciones') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="deducciones" name="deducciones" readonly value="{{$resultadoColaborador['deducciones']}}" />
    </div>

    <div class="col-md-3 col-sm-12" id="salarioNetoDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Salario neto') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="salarioNeto" name="salarioNeto" readonly value="{{$resultadoColaborador['salario_neto']}}" />
    </div>

</div>

<div class="row" style="display: none;">
    <div class="col-12">

        <form id="image-upload" action="{{ route('dropzone.store') }}" class="dropzone bgc-white border-0 shadow-sm radius-1 mt-3">
            @csrf
            <input type="text" value="{{ Crypt::encrypt($idColaborador) }}" name="idColaborador" hidden>
            <div class="fallback d-none">
                <input name="file" type="file" multiple />
            </div>

            <div class="dz-default dz-message">
                    <span class="text-150  text-grey-d2">
                    <span class="text-130 font-bolder"><i class="fa fa-caret-right text-danger-m1"></i> Arrastrar el documento </span>
                    para subir
                    <span class="text-90 text-grey-m1">(o click aquí)</span>
                    <br />
                    <i class="upload-icon fas fa-cloud-upload-alt text-blue-m1 fa-3x mt-4"></i>
                    </span>
            </div>
        </form>

    </div>
</div>

@if(file_exists(public_path('js/scripts/admin/colaboradorAccionPersonal_formularios.min.js')))
    <script src="{{ asset('js/scripts/admin/colaboradorAccionPersonal_formularios.min.js') }}?t={{ filemtime(public_path('js/scripts/admin/colaboradorAccionPersonal_formularios.min.js')) }}"></script>
@endif
