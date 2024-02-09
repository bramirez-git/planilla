$(document).ready(function(){

    grecaptcha.ready(function () {
        SetCaptchaToken('passwordReset');
        setInterval(function () { SetCaptchaToken('passwordReset'); }, 2 * 60 * 1000);
    });
    $('#new_password').on('input', function() {
        var password = $(this).val();
        validatePassword(password);
    });

    function validatePassword(password) {
        // Validación de longitud
        var isValidLength = password.length >= 8;
        toggleValidationStatus('validation-length', isValidLength);

        // Validación de letra mayúscula
        var hasUppercase = /[A-Z]/.test(password);
        toggleValidationStatus('validation-uppercase', hasUppercase);

        // Validación de letra minúscula
        var hasLowercase = /[a-z]/.test(password);
        toggleValidationStatus('validation-lowercase', hasLowercase);

        // Validación de carácter especial
        var hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password);
        toggleValidationStatus('validation-special', hasSpecialChar);

        // Validación de número
        var hasNumber = /\d/.test(password);
        toggleValidationStatus('validation-number', hasNumber);
    }

    function toggleValidationStatus(validationId, isValid) {
        // Añade o quita clases para cambiar el color de fondo y el icono según la validación
        var $validationElement = $('#' + validationId);
        var $iconElement = $validationElement.find('.indicatorResponsive i');
        $validationElement.toggleClass('valid-criteria', isValid).toggleClass('invalid-criteria', !isValid);
        $iconElement.toggleClass('fa-check btn-text-green', isValid).toggleClass('fa-xmark btn-text-red', !isValid);
    }

    // Agrega la validación del formulario usando jQuery Validation
    $("#frm-password-reset").validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            confirm_new_password: {
                required: true,
                equalTo: "#new_password" // Debe ser igual al campo de contraseña
            },
            password: {
                required: true,
            }
        },
        messages: {
            confirm_new_password: {
                required: "Por favor, confirme su contraseña.",
                equalTo: "Las contraseñas no coinciden."
            },
            password: {
                required: "Por favor, confirme su contraseña temporal.",
            }
        },
        errorPlacement: function(error, element) {
            // Personaliza la ubicación de los mensajes de error
            if (element.hasClass("form-control")) {
                error.insertAfter(element.closest('.input-floating-label'));
            } else {
                error.insertAfter(element);
            }
        }
    });

    // // Agrega un manejador de eventos para el envío del formulario
    // $("#frm-password-reset").on('submit', function(e) {
    //     // Verifica la validez del formulario
    //     if (!isFormValid()) {
    //         // Si el formulario no es válido, detén el envío
    //         e.preventDefault();
    //         return;
    //     }
    //     if (!$(this).valid()) {
    //         // Si el formulario no es válido, detén el envío
    //         e.preventDefault();
    //         return;
    //     }
    //     waitingDialog.show();
    //     $("#frm-password-reset").submit();
    // });

    $('#reset').on('click', function(evt) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente

        if ($("#frm-password-reset").valid() && isFormValid()) {
            waitingDialog.show();
                $("#frm-password-reset").submit();

        } else {
            return false;
        }
    });

    function isFormValid() {
        // Verifica si todos los criterios están cumplidos antes de permitir el envío del formulario
        var allCriteriaValid = $('.valid-criteria').length === $('.indicatorResponsive').length;
        return allCriteriaValid;
    }
});
