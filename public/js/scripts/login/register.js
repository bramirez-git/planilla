
var errores = [];
$(document).ready(function(){
    grecaptcha.ready(function () {
        SetCaptchaToken('register');
        setInterval(function () { SetCaptchaToken('register'); }, 2 * 60 * 1000);
    });

// Función para aplicar la máscara según si el número es nacional o internacional
//     function aplicarMascaraSegunTipo(telInput, mascaraNacional, mascaraInternacional) {
//         var tipoTelefono = telInput.intlTelInput('getSelectedCountryData').iso2;
//
//         if (tipoTelefono === 'cr') {
//             telInput.inputmask(mascaraNacional);
//         } else {
//             telInput.inputmask(mascaraInternacional);
//         }
//     }

    // Aplicar máscaras iniciales
    $('#telefono').inputmask('9999-9999');
    $('#telefono_celular').inputmask('9999-9999');

    var tel1=$('#telefono');
    var dial1=$('#frm_codigo_pais');
    tel1.intlTelInput({
        preferredCountries: ['cr', 'ni', 'pa', 'co', 'ec', 'pe', 'cl', 'ar', 'br', 'us'],
        separateDialCode:true
    });
    tel1.on('countrychange',function(event,countryData){
        dial1.val(countryData.dialCode);
        aplicarMascaraSegunTipo(tel1, '9999-9999', '999999999999999');
    });
    dial1.on('change',function(event){
        var tel=tel1.val();
        tel1.intlTelInput('setNumber','+'+this.value);
        tel1.intlTelInput('setNumber',tel);
    });
    dial1.change();

// Configurar intlTelInput para el segundo teléfono
    var tel2 = $('#telefono_celular');
    var dial2 = $('#frm_cod_pais_celular');
    tel2.intlTelInput({
        preferredCountries: ['cr', 'ni', 'pa', 'co', 'ec', 'pe', 'cl', 'ar', 'br', 'us'],
        separateDialCode:true
    });
    tel2.on('countrychange',function(event,countryData){
        dial2.val(countryData.dialCode);
        aplicarMascaraSegunTipo(tel2, '9999-9999', '999999999999999');
    });
    dial2.on('change',function(event){
        var tel=tel2.val();
        tel2.intlTelInput('setNumber','+'+this.value);
        tel2.intlTelInput('setNumber',tel);
    });
    dial2.change();

    $.validator.setDefaults({
        ignore: []
    });
    $.validator.addMethod("primerCaracterValido", function(value, element) {
        // Elimina los guiones de la máscara y toma el primer carácter
        var primerCaracter = value.replace(/-/g, '').charAt(0);

        // Verifica que el primer carácter sea uno de los caracteres válidos (2346789)
        return /^[246789]$/.test(primerCaracter);
    }, "Por favor, ingrese un teléfono válido para Costa Rica.");


    $.validator.addMethod("minlength20", function(value, element) {
        return this.optional(element) || value.length >= 20;
    }, "La dirección debe tener al menos 20 caracteres.");

    $.validator.addMethod("telefonoValido", function(value, element) {
        // Elimina los guiones de la máscara y luego verifica que el número de teléfono tenga al menos 8 dígitos
        var phoneNumber = value.replace(/-/g, '');

        // Obtén el tipo de teléfono (código de país)
        var tipoTelefono = $(element).intlTelInput('getSelectedCountryData').iso2;

        // Aplica la regla de validación solo si el tipo de teléfono es 'cr' (Costa Rica)
        return tipoTelefono === 'cr' && /^[0-9]{8,}$/.test(phoneNumber);
    }, "Por favor, ingrese un teléfono válido para Costa Rica.");

// Función para aplicar la máscara según el tipo de teléfono
    function aplicarMascaraSegunTipo(telInput, mascaraNacional, mascaraInternacional) {
        var tipoTelefono = telInput.intlTelInput('getSelectedCountryData').iso2;

        // Obtener el valor del campo de teléfono
        var telefonoValue = telInput.val();

        // Verificar si el tipo de teléfono es 'cr' (Costa Rica)
        if (tipoTelefono === 'cr') {
            // Aplicar la máscara y configurar la regla de validación
            telInput.inputmask({
                mask: mascaraNacional,
                min: 8
            });
            telInput.rules('add', {
                primerCaracterValido:true,
                telefonoValido: true,

            });
            telInput.attr('placeholder', "0000-0000");
        } else {
            // Quitar la máscara y eliminar la regla de validación
            telInput.inputmask({
                mask: mascaraInternacional,
                min: 15
            });
            telInput.rules('remove', 'primerCaracterValido');
            telInput.rules('remove', 'telefonoValido');
            telInput.removeAttr('placeholder');
        }
    }

    var frmCrearCuenta=$('#frm-crearCuenta');
    frmCrearCuenta.validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: true,
        rules: {
            identificacion: {
                required: true
            },
            nombrePersona: {
                required: true
            },
            telefono: {
                required: true,
                telefonoValido: true,
                primerCaracterValido:true
            },
            telefono_celular: {
                required: true,
                telefonoValido: true
            },
            correo: {
                required: true
            },
            provincia:{
                required: true
            },
            canton:{
                required: true
            },
            distrito:{
                required: true
            },
            barrio:{
                required: true
            },
            nombreContacto: {
                required: true
            },
            correoContacto: {
                required: true
            },
            direccion: {
                required: true,
                minlength20: true
            },
            medio_comunicacion: {
                required: true
            },
            "aceptarTerminosCondiciones[]": {
                required: true
            },
        },

        messages: {
            identificacion: {
                required: "Este campo es requerido."
            },
            nombrePersona: {
                required: "Este campo es requerido."
            },
            telefono: {
                required: "Este campo es requerido."
            },
            telefono_celular: {
                required: "Este campo es requerido."
            },
            correo: {
                required: "Este campo es requerido."
            },
            provincia:{
                required: "Este campo es requerido."
            },
            canton:{
                required: "Este campo es requerido."
            },
            distrito:{
                required: "Este campo es requerido."
            },
            barrio:{
                required: "Este campo es requerido."
            },
            nombreContacto: {
                required: "Este campo es requerido."
            },
            direccion: {
                required: "Este campo es requerido."
            },
            medio_comunicacion: {
                required: "Este campo es requerido."
            },
            correoContacto: {
                required: "Este campo es requerido."
            },
            "aceptarTerminosCondiciones[]": {
                required: "Este campo es requerido."
            },
        },
        errorPlacement: function (error, element) {
            // Insertar errores y agregar campo a la lista si aún no está presente
            if (element.attr("type") === "checkbox" && element.attr("id") === "aceptarTerminosCondiciones") {
                error.insertAfter(element.parent());
            } else if (element.hasClass("form-control")) {
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

    $('#registrar').on('click', function(evt) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        if (frmCrearCuenta.valid()) {
                waitingDialog.show();
                frmCrearCuenta.submit();
        } else {
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
    $('#buscarCedula').on('click', function(evt){

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
                    $("#nombrePersona").val(response.resultado);
                    document.getElementById("nombrePersona").readOnly=true;
                    mostrarAlertaExito('Se encontraron resultados en el padrón electoral.');
                }else{
                    $("#nombrePersona").val("");
                    $("#nombrePersona").removeAttr("readonly");
                    mensaje_swal('info', ' El servicio automatizado de consulta al padrón electoral no retorno resultados, para este caso debe completar la información del nombre de forma manual.',
                        function(){
                        }, false, null, 'Continuar');
                }

            },
            complete: function(){
            },
            error: function(){
                $("#nombrePersona").val("");
                $("#nombrePersona").removeAttr("readonly");
                mensaje_swal('info', ' El servicio automatizado de consulta al padrón electoral no retorno resultados, para este caso debe completar la información del nombre de forma manual.',
                    function(){
                    }, false, null, 'Continuar');
            }
        });
    });
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



