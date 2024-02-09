$(document).ready(function(){

    var frmColaboradores = $('#frm-colaboradores');
    // departamentos_create.blade

    frmColaboradores.on('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente

        if ($(this).valid()) {
            confirmar('', '¿Desea agregar al colaborador los datos del perfil?', 'question', function() {
                waitingDialog.show();
                // Realiza una solicitud AJAX para enviar el formulario
                $.ajax({
                    type: 'POST',
                    url: frmColaboradores.attr('action'),
                    data: frmColaboradores.serialize(),
                    success: function(response) {
                        // Redirige a la ruta proporcionada por el controlador si la respuesta es exitosa
                        if (response.success) {
                            mostrarAlertaExito(response.message);

                        } else {
                            mensaje_swal('error', response.error);
                        }
                    },
                    error: function(error) {
                        // Maneja errores si la solicitud falla
                        mensaje_swal('error', error);
                    }
                });
            });
        } else {
            return false;
        }
    });

    // Captura el evento de clic en el botón con id #registrar
    $('#registrar').on('click', function(evt) {
        // Activa el evento de envío del formulario
        frmColaboradores.submit();
    });

    $('#catalogoSalariosMinimos').on('change', function() {
        // Obtener el valor seleccionado del select
        var selectedValue = $(this).val();

        // Asignar el valor seleccionado al input
        $('#minimoSalario').val(parseFloat(selectedValue).toFixed(2));
    });
    // agregar  intlTelInput
    tel1 = $('#telefonoCelular');
    dial1 = $('#frm_codigo_pais');
    tel1.intlTelInput({
        preferredCountries: ['cr'],
        separateDialCode: true
    });
    tel1.on('countrychange', function (event, countryData) {
        dial1.val(countryData.dialCode);
    });
    dial1.on('change', function (event) {
        var tel = tel1.val();
        tel1.intlTelInput('setNumber', '+' + this.value);
        tel1.intlTelInput('setNumber', tel);
    });
    dial1.change();


// función para no permitir letras ni caracteleres especiales a los telefonos

        var tel1 = $("#telefonoCelular");
        tel1.intlTelInput();

        tel1.on('input', function () {
            var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
            var longitudMaxima = (codigoPais === 'cr') ? 8 : 15;

            var valor = tel1.val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

            if (valor.length > longitudMaxima) {
                valor = valor.substring(0, longitudMaxima);
            }



            // No aplicar guiones si es internacional
            if (codigoPais !== 'cr') {
                tel1.inputmask('remove');

            } else {
                // Verificar los dígitos iniciales para Costa Rica (2, 8, 6, 7)
                if (!/^([248679])/.test(valor) && valor !== '') {
                    valor = '';
                } else {
                    tel1.inputmask({
                        mask: '9999-9999',
                        showMaskOnHover: false,
                        showMaskOnFocus: false
                    });

                }
            }
            tel1.val(valor);
            quitarMensajeError();
        });


    tel1.on('blur', function () {
        var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
        var valor = tel1.val().replace(/\D/g, '');

        var mensajeError = $('#mensajeError');

        if (codigoPais === 'cr' && valor.length < 8) {

            mensajeError.text('El número de teléfono en Costa Rica debe tener al menos 8 dígitos.');
        } else {

            quitarMensajeError();
        }
    });

    function quitarMensajeError() {
        $('#mensajeError').text('');
    }

    tel1.on('countrychange', function () {
        var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
        if (codigoPais !== 'cr') {
            // Para números internacionales, aplicar máscara de 15 dígitos
            tel1.inputmask({
                mask: '999999999999999',
                showMaskOnHover: false,
                showMaskOnFocus: false
            });
        } else {
            tel1.val('');
        }
    });

});

$('#guardar').on('click', function (evt)
{
    $('#confirmModal').modal('hide');
    $('#cargando').modal('show');
});

$('#frm-colaboradores').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
        identificacionCargo: {
            required: true
        },
        minimoSalario: {
            required: true
        },
        maximoSalario: {
            required: true
        },
        correoEmpresarial: {
            required: true
        },
        telefono: {
            required: true,
            telefonoValido: true
        },
        extension: {
            required: true
        },
        objetivoPuesto: {
            required: true
        },
        funcionesPuesto: {
            required: true
        },
        tareasPuesto: {
            required: true
        },
        habilidadesCompetencias: {
            required: true
        },
        formacionAcademica: {
            required: true
        },
        experiencia: {
            required: true
        }
    },

    messages: {
        identificacionCargo: {
            required: "Este campo es requerido."
        },
        minimoSalario: {
            required: "Este campo es requerido."
        },
        maximoSalario: {
            required: "Este campo es requerido."
        },
        correoEmpresarial: {
            required: "Este campo es requerido."
        },
        telefono: {
            required: "Este campo es requerido.",
            telefonoValido: "El número de teléfono debe tener al menos 8 dígitos para Costa Rica."
        },
        extension: {
            required: "Este campo es requerido."
        },
        objetivoPuesto: {
            required: "Este campo es requerido."
        },
        funcionesPuesto: {
            required: "Este campo es requerido."
        },
        tareasPuesto: {
            required: "Este campo es requerido."
        },
        habilidadesCompetencias: {
            required: "Este campo es requerido."
        },
        formacionAcademica: {
            required: "Este campo es requerido."
        },
        experiencia: {
            required: "Este campo es requerido."
        }
    },
    errorElement : 'span'
});

$("#registrar").on('click', function (evt)
{
    if($('#frm-colaboradores').valid())
    {
        $('#confirmModal').modal('show');
    }
    else{
        return false;
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const filtroButton = document.getElementById("filtroButton");
    const filtroMenu = document.getElementById("filtroMenu");

    filtroButton.addEventListener("click", function (e) {
        e.preventDefault();
        filtroMenu.classList.toggle("show");
    });

    document.addEventListener("click", function (e) {
        if (!filtroMenu.contains(e.target) && !filtroButton.contains(e.target)) {
            filtroMenu.classList.remove("show");
        }
    });

    const selectPuesto = document.getElementById("idPuesto");
    const selectDepartamento = document.getElementById("idDepartamento");

    if (selectPuesto.options.length === 1 && selectPuesto.options[0].value === "") {
        Swal.fire({
            icon: 'warning',
            title: 'No hay puestos disponibles',
            text: 'Configura los puestos antes de continuar.',
            confirmButtonText: 'OK'
        }).then(function() {
            window.history.back();
        });
    }

    if (selectDepartamento.options.length === 1 && selectDepartamento.options[0].value === "") {
        Swal.fire({
            icon:  'warning',
            title: 'No hay departamentos disponibles',
            text: 'Configura los departamentos antes de continuar.',
            confirmButtonText: 'OK'
        }).then(function() {
            window.history.back();
        });
    }

});

