<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo Incapacidad') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="subTipoAccion" name="subTipoAccion" >
            @foreach($accionesLicencias as $accionLicencia)
                <option value="{{ $accionLicencia->id_subcategoria."-".$accionLicencia->abreviatura }}">{{ $accionLicencia->nombre }}</option>
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

    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Afecta Planilla') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="afectaPlanilla" name="afectaPlanilla" readonly value="SI" />
    </div>
</div>

<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12" >
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de boleta') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroBoleta" name="numeroBoleta" />
    </div>

    <div class="col-md-3 col-sm-12" id="fechasIniciales">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha Inicio') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicial" name="fechaInicial" readonly/>
        </div>
    </div>

    <div class="col-md-3 col-sm-12" id="fechasFinales">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha Final') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaFinal" name="fechaFinal" readonly/>
        </div>
    </div>

    <div class="col-md-3 col-sm-12" id="variasFechas">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha(s)') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="seleccionFechas" name="seleccionFechas" readonly/>
        </div>
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

    @if($idAccion=="00005")
        //mostrar y ocultar campos
        $('#fechasIniciales').hide();
        $('#fechasFinales').hide();
        $('#variasFechas').show();
    @else
        //mostrar y ocultar campos
        $('#fechasIniciales').show();
        $('#fechasFinales').show();
        $('#variasFechas').hide();
    @endif

    $('#subTipoAccion').on('change', function(evt)
    {
        let tipoIncapacidad = $('#subTipoAccion').val().split("-")[1];

        $('#fechaInicial').val("");
        $('#fechaFinal').val("");
        $('#seleccionFechas').val("");

        if(tipoIncapacidad=="MACCSS"||tipoIncapacidad=="PACCSS"||tipoIncapacidad=="ADCCSS")
        {
            if(tipoIncapacidad=="MACCSS"||tipoIncapacidad=="ADCCSS")
            {
                $('#fechasIniciales').show();
                $('#fechasFinales').show();
                $('#variasFechas').hide();
            }
            else
            {
                $('#fechasIniciales').hide();
                $('#fechasFinales').hide();
                $('#variasFechas').show();
            }
            $("#alerta_incapacidad").empty().append("La acción a realizar, no aplica una deducción en el salario del colaborador." +
                "<br>El patrono realiza el pago del 50 % del salario y la CCSS se hace cargo del otro 50%.");
        }
        else
        {
            $('#fechasIniciales').hide();
            $('#fechasFinales').hide();
            $('#variasFechas').show();

            $("#alerta_incapacidad").empty().append("La acción a realizar, aplica una deducción en el salario del colaborador.");
        }
    });

    //fecha mascara
    $('#fechaInicial').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        startDate: '-1Y'
    });

    $('#fechaFinal').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        startDate: '-1Y'
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
