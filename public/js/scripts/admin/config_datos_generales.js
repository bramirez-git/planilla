
var errores = [];
$(document).ready(function(){
    $('#telefonoFijo').inputmask('9999-9999');
    $('#telefonoCelular').inputmask('9999-9999');

    let tel1=$('#telefonoFijo');
    let dial1=$('#frm_codigo_pais');
    tel1.intlTelInput({
        preferredCountries: ['cr'],
        separateDialCode: true
    });
    tel1.on('countrychange', function(event, countryData){
        dial1.val(countryData.dialCode);
    });
    dial1.on('change', function(event){
        var tel=tel1.val();
        tel1.intlTelInput('setNumber', '+'+this.value);
        tel1.intlTelInput('setNumber', tel);
    });
    dial1.change();
    let tel2=$('#telefonoCelular');
    let dial2=$('#frm_codigo_pais2');
    tel2.intlTelInput({
        preferredCountries: ['cr'],
        separateDialCode: true,
    });
    tel2.on('countrychange', function(event, countryData){
        dial2.val(countryData.dialCode);
    });
    dial2.on('change', function(event){
        var tel=tel2.val();
        tel2.intlTelInput('setNumber', '+'+this.value);
        tel2.intlTelInput('setNumber', tel);
    });
    dial2.change();
});
$('#selectpicker1').selectpicker();
$('#selectpicker2').selectpicker();
$('#selectpicker3').selectpicker();
if ($('.chosen-select').length){
    $(".chosen-select").chosen({allow_single_deselect: true});
}
//1- MODULO GENERALES
$('#guardar-datosgenerales').on('click', function (evt)
{
    $('#confirmModalDatosGeneral').modal('hide');
    $('#cargando').modal('show');
});
$('.cropme').simpleCropper();
$('#correo').inputmask();
$('#form-datosgenerales').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
        identificacion: {
            required: true
        },
        nombre: {
            required: true
        },
        nombre_fantasia: {
            required: true
        },
        direccion: {
            required: true
        },
        telefonoFijo: {
            required: true
        },
        telefonoCelular: {
            required: true
        },
        correo: {
            required: true
        },
        medio_comunicacion:{
            required: true
        }
    },

    messages: {
        identificacion: {
            required: "Este campo es requerido."
        },
        nombre: {
            required: "Este campo es requerido."
        },
        nombre_fantasia: {
            required: "Este campo es requerido."
        },
        direccion: {
            required: "Este campo es requerido."
        },
        telefonoFijo: {
            required: "Este campo es requerido."
        },
        telefonoCelular: {
            required: "Este campo es requerido."
        },
        correo: {
            required: "Este campo es requerido."
        },
        medio_comunicacion:{
            required: "Este campo es requerido."
        }
    },
    errorPlacement: function (error, element) {

        if (element.hasClass("form-control")) {
            error.insertAfter(element.closest('.input-group'));
        } else {
            error.insertAfter(element);
        }
    },
    invalidHandler: function(event, validator) {
        $.each(validator.errorList, function(index) {
            var elemento = validator.errorList[index].element;
            manejarError(elemento, true);
        });
    },
});

$("#registrardatosgenerales").on('click', function (evt)
{
    if($('#form-datosgenerales').valid())
    {
        $('#confirmModalDatosGeneral').modal('show');
    }
    else
    {
        var listaErroresHTML = '<br>' +
            '<ol style="text-align: left; margin-left: 70px;">';

        // Agregar elementos li para cada error usando Object.keys(errores).forEach
        Object.keys(errores).forEach(function (fieldName) {
            listaErroresHTML += '<li style="">' + fieldName + '</li>';
        });

        // Cerrar la lista ordenada
        listaErroresHTML += '</ol>';
        mensaje_swal('error', 'Por favor, confirme los siguientes campos:<br>' + listaErroresHTML, function () {
        }, false, null, 'Continuar');
        errores=[];
        return false;
    }
});

$('#buscarCedula').on('click', function (evt)
{

    if(evt.keyCode===13){
        return;
    }
    if($('#identificacion').val()==""){
        return;
    }
    waitingDialog.show();
    let cedula=$("#identificacion").val().replaceAll("-", "").trim();
    $.ajax({
        type: "POST",
        url: base_path + "/obtenerNombreCedulaRegistro",
        data: {'cedula': cedula},
        global:false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
        },
        success: function(response){
            if(response.success){
                $("#nombre").val(response.resultado);
                document.getElementById("nombre").readOnly=true;
                mostrarAlertaExito('Se encontraron resultados en el padrón electoral.');
            }else{
                $("#nombre").val("");
                $("#nombre").removeAttr("readonly");
                mensaje_swal('info', ' El servicio automatizado de consulta al padrón electoral no retorno resultados, para este caso debe completar la información del nombre de forma manual.',
                    function(){
                    }, false, null, 'Continuar');
            }

        },
        complete: function(){
        },
        error: function(){
            $("#nombre").val("");
            $("#nombre").removeAttr("readonly");
            mensaje_swal('info', ' El servicio automatizado de consulta al padrón electoral no retorno resultados, para este caso debe completar la información del nombre de forma manual.',
                function(){
                }, false, null, 'Continuar');
        }
    });
});

$('#tipoIdentificacion').on("change", function (evt)
{
    if($('#tipoIdentificacion').val()==1)
    {
        //cedula mascara
        $("#cedula").inputmask({
            mask: '9-9999-9999',
            placeholder: '9-9999-9999',
            showMaskOnHover: true,
            showMaskOnFocus: true,
            onBeforePaste: function (pastedValue, opts) {
                var processedValue = pastedValue;

                //do something with it

                return processedValue;
            }
        });

        //cedula mascara
        $("#patronoCCSS").inputmask({
            mask: '9-9999999999-999-999',
            placeholder: '9-9999999999-999-999',
            showMaskOnHover: true,
            showMaskOnFocus: true,
            onBeforePaste: function (pastedValue, opts) {
                var processedValue = pastedValue;

                //do something with it

                return processedValue;
            }
        });
    }
    else if($('#tipoIdentificacion').val()==2)
    {
        //cedula mascara
        $("#cedula").inputmask({
            mask: '9-999-999999',
            placeholder: '9-999-999999',
            showMaskOnHover: true,
            showMaskOnFocus: true,
            onBeforePaste: function (pastedValue, opts) {
                var processedValue = pastedValue;

                //do something with it

                return processedValue;
            }
        });

        //cedula mascara
        $("#patronoCCSS").inputmask({
            mask: '9-99999999999-999-999',
            placeholder: '9-99999999999-999-999',
            showMaskOnHover: true,
            showMaskOnFocus: true,
            onBeforePaste: function (pastedValue, opts) {
                var processedValue = pastedValue;

                //do something with it

                return processedValue;
            }
        });
    }
});

function manejarError(element, agregar) {
    // Agregar o eliminar el nombre del campo de la lista de errores
    var fieldName = $(element).data("name_error");
    if (agregar) {
        errores[fieldName] = true;
    } else {
        delete errores[fieldName];
    }
}
