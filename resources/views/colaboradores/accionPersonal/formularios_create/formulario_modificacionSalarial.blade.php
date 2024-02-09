
<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de constancia') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="subTipoAccion" name="subTipoAccion" >
            @foreach($accionesModificacionSalarial as $accionModificacionSalarial)
                <option value="{{ $accionModificacionSalarial->id_subcategoria."-".$accionModificacionSalarial->abreviatura }}">{{ $accionModificacionSalarial->nombre }}</option>
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
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de regimiento') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="fechaRegimiento" name="fechaRegimiento" readonly />
        </div>
    </div>

</div>

<div class="form-group row mt-4">

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Aplica aumento salarial') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="aplicaAumentoSalarial" name="aplicaAumentoSalarial" >
            <option value="1">SI</option>
            <option value="2">NO</option>
        </select>
    </div>

    <div class="col-md-3 col-sm-12" id="nuevoSalarioDiv">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nuevo Salario Base') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="spanSignoMoneda input-group-text">
                    {{'₡'}}
                </span>
            </div>
            <input type="number" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nuevoSalarioBase" name="nuevoSalarioBase" />
        </div>
    </div>

    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Puesto') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="puesto" name="puesto" readonly value="{{$resultadoColaborador['puesto_colaborador']}}" />
    </div>

</div>

<div class="row" id="documentosDIV"  style="display: none;">
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

<script type="module">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //fecha mascara
    $('#fechaRegimiento').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: false,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        startDate: '-1Y'
    });

    //nuevoSalarioDiv
    $('#aplicaAumentoSalarial').on('change', function(evt) {
        let aplicaAumentoSalarial = $('#aplicaAumentoSalarial').val();
        if(aplicaAumentoSalarial==1)
        {
            $('#nuevoSalarioDiv').show();
        }
        else{
            $('#nuevoSalarioDiv').hide();
        }
    });


    $('#subTipoAccion').on('change', function(evt)
    {
        let tipoConstancia = $('#subTipoAccion').val().split("-")[1];

        if(tipoConstancia=="MSCAP")
        {
            $('#puesto').attr('readonly', false);
        }

        if(tipoConstancia=="MSAUM")
        {
            $('#puesto').attr('readonly', true);
        }

    });

    Dropzone.autoDiscover = false;

    var dropzone = new Dropzone('#image-upload', {

        thumbnailWidth: 200,

        maxFilesize: 1,

        acceptedFiles: ".docx,.doc,.pdf,.xls,.xlsx,.jpeg,.jpg,.png,.web",
        addRemoveLinks: true,
        dictRemoveFile : "×",
        removedfile:function (file){
            var name = file.name;

            $.ajax({
                type: 'POST',
                url: '{{route('dropzone.delete')}}',
                data: {name: name},
                success: function(data){
                    console.log('success: ' + data);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    });

</script>
