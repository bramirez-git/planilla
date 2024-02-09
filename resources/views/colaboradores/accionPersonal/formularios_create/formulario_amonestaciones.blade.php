
<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de Amonestación') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="subTipoAccion" name="subTipoAccion" >
            @foreach($accionesAmonestaciones as $accionAmonestacion)
                <option value="{{ $accionAmonestacion->id_subcategoria."-".$accionAmonestacion->abreviatura }}">{{ $accionAmonestacion->nombre }}</option>
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
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Amonestación') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaAmonestacion" name="fechaAmonestacion" readonly/>
        </div>
    </div>

</div>

<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12" id="fechaSuspensionDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de suspensión') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaSuspension" name="fechaSuspension" readonly/>
        </div>
    </div>

    <div class="col-md-3 col-sm-12" id="afectaGoceDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Amonestación implica') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="afectaGoce" name="afectaGoce" readonly />
    </div>

    <div class="col-md-3 col-sm-12" id="afectaPlanillaDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Afecta Planilla') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="afectaPlanilla" name="afectaPlanilla" readonly />
    </div>

</div>

<div class="form-group row mt-4" id="descripcionDIV" style="display: none;">
    <div class="col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción') }}</label>
        <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcion" name="descripcion" ></textarea>
    </div>
</div>

<div class="row" id="documentosDIV" >
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
