<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo Incapacidad') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="subTipoAccion" name="subTipoAccion" >
            @foreach($accionesIncapacidad as $accionIncapacidad)
                <option value="{{ $accionIncapacidad->id_subcategoria."-".$accionIncapacidad->abreviatura }}">{{ $accionIncapacidad->nombre }}</option>
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

    <div class="col-md-3 col-sm-12" id="afectaPlanillaDiv">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Afecta Planilla') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="afectaPlanilla" name="afectaPlanilla" readonly value="SI"/>
    </div>

</div>

<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12" id="variasFechas">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha(s)') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="seleccionFechas" name="seleccionFechas" readonly/>
        </div>
    </div>

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de boleta') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroBoleta" name="numeroBoleta" />
    </div>
</div>

<div class="row">
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
    $('#seleccionFechas').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: false,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        multidate: true,
        startDate: '-1Y'
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
