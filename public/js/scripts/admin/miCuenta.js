$(document).ready(function() {
    // Aplicar máscaras iniciales
    $('#telefono').inputmask('9999-9999');
    var frm_info_cuenta=$('#frm-info');
    frm_info_cuenta.validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            nombre:{
                required: true
            },
            email: {
                required: true,
                email: true
            },
            idDepartamento: {
                required: true
            },
            telefono: {
                required: true,
                telefonoValidoCR: true,
            }
        },
        messages: {
            nombre:{
                required: "Este campo es requerido."
            },
            email: {
                required: "Este campo es requerido.",
                email: "Por favor, ingrese un correo electrónico válido."
            },
            idDepartamento: {
                required: "Este campo es requerido."
            },
            telefono: {
                required: "Este campo es requerido."
            }
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("form-control")) {
                error.insertAfter(element.closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        }
    });

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

    $('#frm-password').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            contrasena:{
                required: true
            },
            // Define las reglas de validación aquí (generateRules())
            new_contrasena: {
                required: true,
                minlength: 6 // Por ejemplo, requerir al menos 6 caracteres en la contraseña
            },
            password_confirmation: {
                required: true,
                equalTo: "#password" // Asegura que coincida con el campo de contraseña
            }
        },
        messages: {
            contrasena:{
                required: "La contraseña es requerida",
                minlength: "La contraseña debe tener al menos 6 caracteres"
            },
            // Define los mensajes de error aquí (generateMessages())
            new_contrasena: {
                required: "La contraseña es requerida",
                minlength: "La contraseña debe tener al menos 6 caracteres"
            },
            password_confirmation: {
                required: "La confirmación de contraseña es requerida",
                equalTo: "Las contraseñas no coinciden"
            }
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("form-control")) {
                error.insertAfter(element.closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        }
    });

    $.validator.setDefaults({
        ignore: []
    });
    function aplicarMascaraSegunTipo(telInput, mascaraNacional, mascaraInternacional) {
        var tipoTelefono = telInput.intlTelInput('getSelectedCountryData').iso2;
        // Verificar si el tipo de teléfono es 'cr' (Costa Rica)
        if (tipoTelefono === 'cr') {
            // Aplicar la máscara y configurar la regla de validación
            telInput.inputmask({
                mask: mascaraNacional
            });
            telInput.rules('add', {
                telefonoValidoCR:true,
            });
            telInput.attr('placeholder', "0000-0000");
        } else {
            // Quitar la máscara y eliminar la regla de validación
            telInput.inputmask({
                mask: mascaraInternacional,
                min: 15
            });
            if (telInput.rules('has', 'telefonoValidoCR')) {
                telInput.rules('remove', 'telefonoValidoCR');
            }
            telInput.removeAttr('placeholder');
        }
    }
    $.validator.addMethod("telefonoValidoCR", function(value, element) {
        // Elimina los guiones de la máscara y luego verifica que el número de teléfono tenga al menos 8 dígitos
        var phoneNumber = value.replace(/-/g, '');

        // Obtén el tipo de teléfono (código de país)
        var tipoTelefono = $(element).intlTelInput('getSelectedCountryData').iso2;

        // Verifica que el primer carácter sea uno de los caracteres válidos (2346789)
        var primerCaracterValido = /^[246789]$/.test(phoneNumber.charAt(0));

        // Verifica que el número de teléfono tenga al menos 8 dígitos
        var telefonoValido = /^[0-9]{8,}$/.test(phoneNumber);

        // Aplica la regla de validación solo si el tipo de teléfono es 'cr' (Costa Rica) y cumple ambas condiciones
        return tipoTelefono === 'cr' && primerCaracterValido && telefonoValido;
    }, "Por favor, ingrese un teléfono válido.");

    $('#telefono').val($('#telefono').data('telefono'));

    $('#btn-password').click(function() {
        if($('#frm-password').valid())
        {
            waitingDialog.show();
            $('#frm-password').submit();
        }
        else{
            return false;
        }
    });
    $('#btn-info').click(function() {
        if(frm_info_cuenta.valid())
        {
            waitingDialog.show();
            $('#frm-info').submit();
        }
        else{
            return false;
        }
    });

    $('#btn-2fa').click(function() {
        waitingDialog.show();
        $('#frm-2fa').submit();
    });

    var tel2  = $('#telefono_factor');
    var dial2 = $('#frm_codigo_pais_factor');
    tel2.intlTelInput({
        preferredCountries: ['cr', 'ni', 'pa', 'co', 'ec', 'pe', 'cl', 'ar', 'br', 'us'],
        separateDialCode: true
    });
    tel2.on('countrychange', function (event, countryData) {
        dial1.val(countryData.dialCode);
    });
    dial2.on('change', function (event) {
        var tel = tel2.val();
        tel2.intlTelInput('setNumber', '+' + this.value);
        tel2.intlTelInput('setNumber', tel);
    });
    dial2.change();
    tel2.intlTelInput();
    tel2.on('input', function () {
        var codigoPais = tel2.intlTelInput('getSelectedCountryData').iso2;
        var longitudMaxima = (codigoPais === 'cr') ? 8 : 15;
        var valor = tel2.val().replace(/\D/g, ''); // Eliminar caracteres no numéricos
        if (valor.length > longitudMaxima) {
            valor = valor.substring(0, longitudMaxima);
        }
        // No aplicar guiones si es internacional
        if (codigoPais !== 'cr') {
            tel2.inputmask('remove'); // Eliminar la máscara
        } else {
            // Verificar los dígitos iniciales para Costa Rica (2, 8, 6, 7)
            if (!/^([248679])/.test(valor) && valor !== '') {
                valor = '';
            } else {
                tel2.inputmask({
                    mask: '9999-9999',
                    showMaskOnHover: false,
                    showMaskOnFocus: false
                });
            }
        }
        tel2.val(valor);
    });
    tel2.on('countrychange', function () {
        var codigoPais = tel2.intlTelInput('getSelectedCountryData').iso2;
        if (codigoPais !== 'cr') {
            // Para números internacionales, aplicar máscara de 15 dígitos
            tel2.inputmask({
                mask: '999999999999999',
                showMaskOnHover: false,
                showMaskOnFocus: false
            });
        } else {
            tel2.val('');
        }
    });
    tel2.on('blur', function () {
        var codigoPais = tel2.intlTelInput('getSelectedCountryData').iso2;
        var valor = tel2.val().replace(/\D/g, '');
        var mensajeError = $('#mensajeError');
    });

});

document.getElementById('activateTwoFactorAuth').addEventListener('click', function() {
    var checkbox = document.getElementById('activateTwoFactorAuth');
    var hiddenField = document.getElementById('activateTwoFactorAuthHidden');
    hiddenField.value = checkbox.checked ? 1 : 0;
});
