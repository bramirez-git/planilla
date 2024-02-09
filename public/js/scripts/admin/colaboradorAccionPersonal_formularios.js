$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($('#fechaAmonestacion').length) {
        $('#fechaAmonestacion').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: false,
            calendarWeeks: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            language: 'es',
            startDate: '-1Y'
        });
    }

    if ($('#fechaSuspension').length) {
        $('#fechaSuspension').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: false,
            calendarWeeks: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            language: 'es',
            startDate: '-1Y'
        });
    }

    if ($('#fechaSalida').length) {
        $('#fechaSalida').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: false,
            calendarWeeks: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            language: 'es',
            startDate: '-1Y'
        });
    }

    if ($('#subTipoAccion').length) {
        $('#subTipoAccion').on('change', function (evt) {
            let tipoConstancia = $('#subTipoAccion').val().split("-")[1];

            //Si son acciones de amonestaciones
            if (tipoConstancia == "AMOLEV") {
                $('#descripcionDIV').show();
                $('#afectaGoceDiv').show();
                $('#afectaPlanillaDiv').show();
                $('#fechaSuspensionDiv').hide();
                $('#documentosDIV').hide();
                $('#afectaPlanilla').val("NO");
                $("#afectaGoce").val("CON GOCE SALARIAL");
            }

            if (tipoConstancia == "AMOGRA") {
                $('#documentosDIV').show();
                $('#afectaGoceDiv').show();
                $('#afectaPlanillaDiv').show();
                $('#descripcionDIV').hide();
                $('#fechaSuspensionDiv').hide();
                $('#afectaPlanilla').val("NO");
                $("#afectaGoce").val("CON GOCE SALARIAL");
            }

            if (tipoConstancia == "AMOMG") {
                $('#fechaSuspensionDiv').show();
                $('#documentosDIV').show();
                $('#afectaGoceDiv').show();
                $('#afectaPlanillaDiv').show();
                $('#descripcionDIV').hide();
                $('#afectaPlanilla').val("SI");
                $("#afectaGoce").val("SIN GOCE SALARIAL");
            }

            if (tipoConstancia == "AMODES") {
                $('#descripcionDIV').hide();
                $('#documentosDIV').show()
                $('#fechaSuspensionDiv').hide();
                $('#afectaGoceDiv').hide();
                $('#afectaPlanillaDiv').hide();
            }

            //Si son acciones de constancia
            if(tipoConstancia=="CONPLA")
            {
                $('#fechaSalidaDiv').show();
            }
            else{
                $('#fechaSalidaDiv').hide();
            }

            if(tipoConstancia=="CONSAL")
            {
                $('#ultimoSalarioBrutoDiv').show();
                $('#deduccionesDiv').show();
                $('#salarioNetoDiv').show();
            }
            else{
                $('#ultimoSalarioBrutoDiv').hide();
                $('#deduccionesDiv').hide();
                $('#salarioNetoDiv').hide();
            }
        });
    }


    if ($('#image-upload').length) {
        Dropzone.autoDiscover = false;

        var dropzone = new Dropzone('#image-upload', {

            thumbnailWidth: 200,

            maxFilesize: 256,

            acceptedFiles: ".docx,.doc,.pdf,.xls,.xlsx,.jpeg,.jpg,.png,.web",
            addRemoveLinks: true,
            dictRemoveFile: "×",
            removedfile: function (file) {
                var name = file.name;

                $.ajax({
                    type: 'POST',
                    url: '/dropzone/delete',//'{{route('dropzone.delete')}}',
                    data: {name: name},
                    success: function (data) {
                        console.log('success: ' + data);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });
    }
});
