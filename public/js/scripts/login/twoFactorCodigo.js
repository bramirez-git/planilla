$(document).ready(function() {
    var numInputs = 4;
    var inputsContainer = $('#inputs-container');
    var codigoVerificacion = [];
    var codigoVerificacionHidden = $('#codigo_validacion');

    $.validator.setDefaults({
        errorPlacement: function(error, element) {
        }
    });

    // Crear los inputs dinámicamente
    for (var i = 0; i < numInputs; i++) {
        var input = $('<input>').attr({
            type: 'text',
            class: 'form-control brc-on-focus brc-blue-m1  text-center telefono',
            id: 'codigo_verificacion_' + (i + 1),
            placeholder: 'X',
            maxlength: 1,
            required: true,
            autocomplete: 'off'
        });

        if (i > 0) {
            inputsContainer.append('&nbsp;&nbsp;');
        }

        inputsContainer.append(input);

        // Evento keyup para moverse al siguiente input cuando se alcance la longitud máxima
        input.on('keyup', function(event) {
            var maxLength = parseInt($(this).attr('maxlength'));
            var currentLength = $(this).val().length;

            if (currentLength === maxLength) {
                $(this).next().focus();
            } else if (event.which === 8 && currentLength === 0) {
                $(this).prev().focus();
            }

            actualizarCodigoVerificacionHidden();
        });

        // Evento input para actualizar el array codigoVerificacion cada vez que se ingrese un valor
        input.on('input', function() {
            var index = $(this).index();
            var value = $(this).val();
            codigoVerificacion[index] = value;
            actualizarCodigoVerificacionHidden();
        });
    }

    // Función para actualizar el valor del input hidden con el código de verificación
    function actualizarCodigoVerificacionHidden() {
        codigoVerificacionHidden.val(codigoVerificacion.join(''));
    }

    $('#btn-verificar').click(function(event) {
        var isValid = true;
        inputsContainer.find('input').each(function() {
            if (!$(this).valid()) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
            mensaje_swal('error', 'Por favor, ingrese el código.');
        } else {
            waitingDialog.show();
            actualizarCodigoVerificacionHidden();
        }
    });

});


