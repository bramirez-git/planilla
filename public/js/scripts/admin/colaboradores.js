$(document).ready(function() {

    // agregar  intlTelInput
    tel1 = $('#telefonoCelular');
    dial1 = $('#frm_codigo_pais');
    tel1.intlTelInput({
        preferredCountries: ['cr', 'ni', 'pa', 'co', 'ec', 'pe', 'cl', 'ar', 'br', 'us'],
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

    tel2 = $('#telefonoCasa');
    dial2 = $('#frm_codigo_pais2');
    tel2.intlTelInput({
        preferredCountries: ['cr', 'ni', 'pa', 'co', 'ec', 'pe', 'cl', 'ar', 'br', 'us'],
        separateDialCode: true,
    });
    tel2.on('countrychange', function (event, countryData) {
        dial2.val(countryData.dialCode);
    });
    dial2.on('change', function (event) {
        var tel = tel2.val();
        tel2.intlTelInput('setNumber', '+' + this.value);
        tel2.intlTelInput('setNumber', tel);
    });
    dial2.change();

    $('#guardar').on('click', function (evt) {
        $('#confirmModal').modal('hide');
        $('#cargando').modal('show');
    });

    $.validator.setDefaults({
        ignore: []
    });

    $('#frm-colaboradores').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            identificacion: {
                required: true
            },
            nombre1: {
                required: true
            },
            apellido1: {
                required: true
            },
            apellido2: {
                required: true
            },
            genero: {
                required: true
            },
            fechaNacimiento: {
                required: true
            },
            estadoCivil: {
                required: true
            },
            telefonoCelular: {
                required: true
            },
            correoPersonal: {
                required: true
            },
            provincia: {
                required: true
            },
            canton: {
                required: true
            },
            distrito: {
                required: true
            },
            barrio: {
                required: true
            },
            direccion: {
                required: true
            }
        },

        messages: {
            identificacion: {
                required: "Este campo es requerido."
            },
            nombre1: {
                required: "Este campo es requerido."
            },
            apellido1: {
                required: "Este campo es requerido."
            },
            apellido2: {
                required: "Este campo es requerido."
            },
            genero: {
                required: "Este campo es requerido."
            },
            fechaNacimiento: {
                required: "Este campo es requerido."
            },
            estadoCivil: {
                required: "Este campo es requerido."
            },
            telefonoCelular: {
                required: "Este campo es requerido."
            },
            correoPersonal: {
                required: "Este campo es requerido."
            },
            provincia: {
                required: "Este campo es requerido."
            },
            canton: {
                required: "Este campo es requerido."
            },
            distrito: {
                required: "Este campo es requerido."
            },
            barrio: {
                required: "Este campo es requerido."
            },
            direccion: {
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
    $("#registrar").on('click', function (evt) {
        if ($('#frm-colaboradores').valid()) {
            $('#confirmModal').modal('show');
        } else {
            return false;
        }
    });

//    <!--buscar cedula-->
    $("#identificacion").keydown(function (event) {
        // Verifica si la tecla presionada es la tecla "Enter" (código 13)
        if (event.keyCode === 13) {

            event.preventDefault();
        }
    });

    $('#buscarCedula').on('click', function (evt) {
        if (evt.keyCode === 13) {
            return;
        }

        if ($('#identificacion').val() == "") {
            return;
        }

        if ($('#tipoIdentificacion').val() == 1) {
            var url_obtener_nombre = $("#url_obtener_nombre").val();
            waitingDialog.show();
            let cedula = $("#identificacion").val().replaceAll("-", "").trim();

            $.ajax({
                type: "POST",
                url: url_obtener_nombre,
                data: {'cedula': cedula},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
                },
                success: function (response) {
                    let nombre = response.split("/@.");

                    $("#numeroColaborador").val(cedula);

                    $("#nombre1").val(nombre[0]);
                    $("#nombre2").val(nombre[1]);
                    $("#apellido1").val(nombre[2]);
                    $("#apellido2").val(nombre[3]);

                    document.getElementById("nombre1").readOnly = true;
                    document.getElementById("nombre2").readOnly = true;
                    document.getElementById("apellido1").readOnly = true;
                    document.getElementById("apellido2").readOnly = true;
                    mostrarAlertaExito('Se encontraron resultados en el padrón electoral.');
                },
                complete: function () {
                },
                error: function () {
                    $("#nombre1").val("");
                    $("#nombre2").val("");
                    $("#apellido1").val("");
                    $("#apellido2").val("");
                    $("#nombre1").removeAttr("readonly");
                    $("#nombre2").removeAttr("readonly");
                    $("#apellido1").removeAttr("readonly");
                    $("#apellido2").removeAttr("readonly");
                    mensaje_swal('info', ' El servicio automatizado de consulta al padrón electoral no retorno resultados, para este caso debe completar la información del nombre y apellidos del colaborador de forma manual.',
                        function () {
                        }, false, null, 'Continuar');
                }
            });
        }
    });

    $('#tipoIdentificacion').on("change", function (evt) {
        if ($('#tipoIdentificacion').val() == 1) {
            $("#nombre1").val("");
            $("#nombre2").val("");
            $("#apellido1").val("");
            $("#apellido2").val("");
            $("#nombre1").prop('readonly', true);
            $("#nombre2").prop('readonly', true);
            $("#apellido1").prop('readonly', true);
            $("#apellido2").prop('readonly', true);
            $('#buscarCedula').prop('disabled', false);
        } else {
            $("#nombre1").val("");
            $("#nombre2").val("");
            $("#apellido1").val("");
            $("#apellido2").val("");
            $("#nombre1").prop('readonly', false);
            $("#nombre2").prop('readonly', false);
            $("#apellido1").prop('readonly', false);
            $("#apellido2").prop('readonly', false);
            $('#buscarCedula').prop('disabled', true);
        }
    });

    //Alerta de eliminacion
    $('.eliminar_colaborador').on('click', function (event) {
        // Evita que el enlace realice su acción predeterminada (navegar a otra página)
        event.preventDefault();
        mensaje_swal('info', 'Esta sección no está habilitada por el momento. Intente más tarde.');
    });

    $('.error_colaborador').on('click', function (event) {
        event.preventDefault();

        var esErrorPl = $(this).closest('td').data('eserrorpl').replace(/"/g, '');
        var esErrorIN = $(this).closest('td').data('eserrorin').replace(/"/g, '');
        var mensajeErrorPl = "Falta configuración de planilla del colaborador";
        var mensajeErrorIN = "Faltan datos de CCSS-INS del colaborador";


        if (esErrorPl === 'error' && esErrorIN === 'error') {
            var mensajeFinal = '&bull; ' + mensajeErrorPl + '<br> &bull; ' + mensajeErrorIN;

            mensaje_swal('error', mensajeFinal);
        } else if (esErrorPl === 'error' && esErrorIN === 'ok') {
            mensaje_swal('error', mensajeErrorPl);
        } else if (esErrorIN === 'error' && esErrorPl === 'ok') {
            mensaje_swal('error', mensajeErrorIN);
        } else {
            mensaje_swal('info', 'La configuración del colaborador está completa!!');
        }
    });








    // Validacion para telefonos
    function manejarInputTelefono(telInput, tipoTelefono) {
        var codigoPais = telInput.intlTelInput('getSelectedCountryData').iso2;
        var longitudMaxima = (codigoPais === 'cr') ? 8 : 15;

        var valor = telInput.val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

        if (valor.length > longitudMaxima) {
            valor = valor.substring(0, longitudMaxima);
        }

        // No aplicar guiones si es internacional
        if (codigoPais !== 'cr') {
            telInput.inputmask('remove');
        } else {
            // Verificar los dígitos iniciales para Costa Rica (2, 8, 6, 7)
            if ((tipoTelefono === 'fijo' && !/^[24]/.test(valor)) || (tipoTelefono === 'celular' && !/^[6789]/.test(valor)) && valor !== '') {
                valor = '';
            } else {
                telInput.inputmask({
                    mask: '9999-9999',
                    showMaskOnHover: false,
                    showMaskOnFocus: false
                });
            }
        }

        telInput.val(valor);
        quitarMensajeError(telInput);
    }

    function manejarBlurTelefono(telInput, tipoTelefono) {
        var codigoPais = telInput.intlTelInput('getSelectedCountryData').iso2;
        var valor = telInput.val().replace(/\D/g, '');

        // Identificar los divs de mensajes de error para fijos y celulares
        var mensajeErrorFijo = $('#mensajeErrorFijo');
        var mensajeErrorCelular = $('#mensajeErrorCelular');

        if (codigoPais === 'cr') {
            if (valor.length < 8) {
                var mensaje = (tipoTelefono === 'fijo') ? 'El número de teléfono fijo en Costa Rica debe tener al menos 8 dígitos.' :
                    'El número de teléfono celular en Costa Rica debe tener al menos 8 dígitos.';
                // Mostrar el mensaje de error en el div correspondiente
                if (tipoTelefono === 'fijo') {
                    mensajeErrorFijo.text(mensaje);
                    mensajeErrorCelular.text(''); // Limpiar el mensaje de error del otro tipo
                } else {
                    mensajeErrorCelular.text(mensaje);
                    mensajeErrorFijo.text(''); // Limpiar el mensaje de error del otro tipo
                }
            } else {
                // Limpiar ambos mensajes de error si no hay error
                mensajeErrorFijo.text('');
                mensajeErrorCelular.text('');
            }
        } else {
            // Limpiar ambos mensajes de error si no es Costa Rica
            mensajeErrorFijo.text('');
            mensajeErrorCelular.text('');
        }
    }


    function quitarMensajeError(telInput) {
        $('#mensajeError').text('');
    }

    function manejarCountryChange(telInput) {
        var codigoPais = telInput.intlTelInput('getSelectedCountryData').iso2;
        if (codigoPais !== 'cr') {
            // Para números internacionales, aplicar máscara de 15 dígitos
            telInput.inputmask({
                mask: '999999999999999',
                showMaskOnHover: false,
                showMaskOnFocus: false
            });
        } else {
            telInput.val('');
        }
    }

    var telFijo = $("#telefonoCasa");
    telFijo.intlTelInput();

    telFijo.on('input', function () {
        manejarInputTelefono(telFijo, 'fijo');

    });

    telFijo.on('blur', function () {
        manejarBlurTelefono(telFijo, 'fijo');
    });

    telFijo.on('countrychange', function () {
        manejarCountryChange(telFijo);
    });

    var telCelular = $("#telefonoCelular");
    telCelular.intlTelInput();

    telCelular.on('input', function () {
        manejarInputTelefono(telCelular, 'celular');
    });

    telCelular.on('blur', function () {
        manejarBlurTelefono(telCelular, 'celular');
    });

    telCelular.on('countrychange', function () {
        manejarCountryChange(telCelular);
    });



    //Validar que sea mayor de edad
    var fechaNacimientoInput = $('#fechaNacimiento');

    fechaNacimientoInput.on('change', function () {

        validarEdad(fechaNacimientoInput.val());
    });


    function validarEdad(fechaNacimiento) {
        // Dividir la cadena en día, mes y año
        var partes = fechaNacimiento.split('/');

        // Crear un objeto de fecha con el formato dd/mm/yyyy
        var fechaNac = new Date(partes[2], partes[1] - 1, partes[0]);

        // Obtener la fecha actual
        var fechaActual = new Date();

        // Comparar los meses y días para ajustar la edad si el cumpleaños ya ha ocurrido este año
        var ajuste = (fechaActual.getMonth() > fechaNac.getMonth() ||
            (fechaActual.getMonth() === fechaNac.getMonth() && fechaActual.getDate() >= fechaNac.getDate())) ? 0 : -1;

        // Calcular la diferencia en años
        var edad = fechaActual.getFullYear() - fechaNac.getFullYear() + ajuste;

        if (edad < 18) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debes ser mayor de 18 años.',
            });
            fechaNacimientoInput.val('');
        }

    }

    // Validaciones de formatos

    aplicarMascara();
    actualizarPlaceholder();

   // Función para validar el formato cuando cambia el tipo de identificación
    $("#tipoIdentificacion").change(function() {
        aplicarMascara();
        actualizarPlaceholder();
    });


    // Función para aplicar la máscara al campo de identificación
    function aplicarMascara() {

        var tipoIdentificacion = $("#tipoIdentificacion").val();

        var $identificacion = $("#identificacion");

        $identificacion.inputmask('remove');

        switch (tipoIdentificacion) {
            case "1":
                // Máscara para Cédula Física Nacional: 9-9999-9999
                $identificacion.inputmask('9-9999-9999');
                break;
            case "2":
                // Máscara para Cédula de Residencia: 999-AAA-99999999999
                $identificacion.inputmask('999-AAA-99999999999');
                break;
            case "6":
                $('#identificacion').inputmask({
                    mask: 'AA-99999999-AAA9',
                    definitions: {
                        'A': {
                            validator: '[A-Za-z]',
                            cardinality: 1
                        },
                        '9': {
                            validator: '[0-9]',
                            cardinality: 1
                        },
                        '*': {
                            validator: '[A-Za-z0-9]',
                            cardinality: 1
                        }
                    }
                });

                break;
            case "3":
                // Máscara para Documento Único: 999999999999
                $identificacion.inputmask('999999999999');
                break;
            case "4":
                // Máscara para Pasaporte: 9??????????
                $identificacion.inputmask('9**********');
                break;
            case "5":
                // Máscara para Documento Único: 999999999999
                $identificacion.inputmask('999999999999');
                break;
            default:
                break;
        }
    }

    function actualizarPlaceholder() {
        var tipoIdentificacion = $("#tipoIdentificacion").val();
        var nuevoPlaceholder = "";

        switch (tipoIdentificacion) {
            case "1":
                nuevoPlaceholder = "9-9999-9999";
                break;
            case "2":
                nuevoPlaceholder = "999-AAA-99999999999";
                break;
            case "6":
                nuevoPlaceholder = "AA-DDMMYYYY-ABC1";
                break;
            case "3":
                nuevoPlaceholder = "999999999999";
                break;
            case "4":
                nuevoPlaceholder = "9**********";
                break;
            case "5":
                nuevoPlaceholder = "999999999999";
                break;
            default:
                break;
        }


        $("#identificacion").attr("placeholder", nuevoPlaceholder);
    }


});

// Obtener todos los elementos con la clase "enlace"
var enlaces = document.querySelectorAll('.enlace');

// Agregar un evento de clic a cada enlace
enlaces.forEach(function(enlace) {
    enlace.addEventListener('click', function(event) {
        var id_colaborador = this.getAttribute('data-id-colaborador');
        // Construir la URL con el parámetro
        var nuevaURL = this.getAttribute('href') + '?id_colaborador=' + encodeURIComponent(id_colaborador);

        // Redirigir a la nueva URL
        window.location.href = nuevaURL;

        // Prevenir el comportamiento predeterminado del enlace
        event.preventDefault();
    });
});

function ui_adjuntar_documentos(){
    waitingDialog.show();
    $.ajax({
        url: base_path+'/uiDocumentoColaboradores/',
        type: 'GET',
        global:false,
        success: function(response){
            var dialog_documentos_digitales = bootbox.dialog({
                title: "Cargar archivo de colaboradores",
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-secondary",
                    },
                    guardar: {
                        label: "<i class='fa fa-save'></i>&nbsp;Registrar",
                        className: "btn btn-light-primary",
                        callback: function(){
                            if($(form).valid()){
                                dialog_documentos_digitales.crear_documentos_digitales();
                                }
                            return false;
                        }
                    }
                },
            });

            dialog_documentos_digitales.init(function(){
                dialog_documentos_digitales.attr("id", "global_bootbox_documento_digitales");
                dialog_documentos_digitales.find('.modal-dialog').css({
                    width: '50%', // O el valor que prefieras
                });
            });
            var form = dialog_documentos_digitales.find('form#frm-documento-colaboradores');
            dialog_documentos_digitales.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}

$.fn.crear_documentos_digitales=function(){
    var dialog_documentos_digitales=$(this);
    var form=dialog_documentos_digitales.find('#frm-documento-colaboradores');
    form.submit();

};

$(function () {
    var descarga_colaboradores = $('#descarga_excel_colaboradores');
    descarga_colaboradores.on('click', function (event) {
        event.preventDefault();
        waitingDialog.show()

        var valor_busqueda = $('#buscar').val();
        var valor_orden = $('[name="orden"]').val();
        var datos = descarga_colaboradores.serialize();

        datos += "&buscar=" + valor_busqueda;
        datos += "&orden=" + valor_orden;

        $.ajax({
            type: 'GET',
            url: "/descargar_excel",
            data: datos,
            success: function (response) {

                if (response.success) {
                    var link = document.createElement('a');
                    link.href = response.url;
                    link.download = 'Lista_de_colaboradores.txt';
                    link.click();
                    waitingDialog.hide();
                    mostrarAlertaExito(response.message);
                } else {
                    waitingDialog.hide();
                    mensaje_swal('error', response.message);
                }
            },
            error: function (error) {
                waitingDialog.hide();
                mensaje_swal('error', error);
            }
        });
    });
});




