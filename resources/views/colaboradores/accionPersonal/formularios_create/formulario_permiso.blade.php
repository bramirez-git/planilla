<div class="form-group row mt-4">
    <div class="col-md-3 col-sm-12">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo Permiso') }}</label>
        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="subTipoAccion" name="subTipoAccion" >
            @foreach($accionesPermisos as $accionPermiso)
                <option value="{{ $accionPermiso->id_subcategoria."-".$accionPermiso->abreviatura }}">{{ $accionPermiso->nombre }}</option>
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

    <div class="col-md-3 col-sm-12" id="variasFechas">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha(s)') }}</label>
        <div class="input-group input-daterange">
            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="seleccionFechas" name="seleccionFechas" readonly/>
        </div>
    </div>
</div>

<div class="form-group row mt-4">
    @foreach($accionesPermisos as $accionPermiso)
        @if($accionPermiso->editar_porcentaje1 ==1)
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1" data-toggle="tooltip" data-placement="top" title=" Porcentaje del salario base en el adelanto  ">
                Porcentaje a pagar del salario
            </label>
            <div class="input-group justify-content-center">
                <input type="number" max="100" min="1" placeholder="0,00" lang="en" data-name_error="Porcentaje del salario base en el adelanto" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input valid" id="porcentaje_salario" name="porcentaje_salario" value="100.00" aria-describedby="porcentaje_salario_adelanto-error" aria-invalid="false">
                <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>
        @endif
    @endforeach

    <div class="col-md-3 col-sm-12" id="afectaPlanillaDiv">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Afecta Planilla') }}</label>
        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="afectaPlanilla" name="afectaPlanilla" readonly value="SI"/>
    </div>

    <div class="col-md-3 col-sm-12" id="horaDiv" style="display: none;">
        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Hora') }}</label>
        <div class="input-group input-daterange">
            <input type="time" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="hora" name="hora"/>
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


    $('#subTipoAccion').on('change', function(evt)
    {
        let tipoPermiso = $('#subTipoAccion').val().split("-")[1];

        $('#seleccionFechas').val("");

        if(tipoPermiso=="PERCME")
        {
            $("#horaDiv").show();
        }
        else{
            $("#horaDiv").hide();
        }


        if(tipoPermiso=="PERCGO")
        {
            $("#afectaPlanillaDiv").show();
        }
        else{
            $("#afectaPlanillaDiv").hide();
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
