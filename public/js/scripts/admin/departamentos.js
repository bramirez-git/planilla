$(document).ready(function(){
    var frmDepartamentos = $('#frm-departamentos');
    // departamentos_create.blade
    frmDepartamentos.validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            codigoDepartamento: {
                required: true
            },
            nombreDepartamento: {
                required: true
            },
            descripcionDepartamento: {
                required: true
            }
        },

        messages: {
            codigoDepartamento: {
                required: "Este campo es requerido."
            },
            nombreDepartamento: {
                required: "Este campo es requerido."
            },
            descripcionDepartamento: {
                required: "Este campo es requerido."
            }
        },
        errorElement : 'span'
    });
    // Captura el evento de clic en el botón con id #registrar
    $('#registrar').on('click', function(evt) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente

        if (frmDepartamentos.valid()) {
            confirmar('', '¿Desea guardar el registro del departamento?', 'question', function() {
                waitingDialog.show();
                frmDepartamentos.submit();
            });
        } else {
            return false;
        }
    });

    $('.delete-btn').on('click', function(event) {
        // Evita que el enlace realice su acción predeterminada (navegar a otra página)
        event.preventDefault();
        // Obtiene el ID del formulario del atributo de datos del enlace
        var formId = $(this).data('form-id');
        confirmar('', ' ¿Está seguro que desea eliminar la ocupación?', 'question', function() {
            waitingDialog.show();
            // Selecciona el formulario por su ID dinámico y envíalo
            $('#frm-delete-puesto-' + formId).submit();
        });
    });
    $('.eliminar-departamento').on('click', function(event){
        // Evita que el enlace realice su acción predeterminada (navegar a otra página)
        event.preventDefault();
        // Obtiene el ID del formulario del atributo de datos del enlace
        var formId = $(this).data('form-id');
        confirmar('', '¿Está seguro que desea eliminar el departamento?', 'question', function(){
            waitingDialog.show();
            $('#frm-destroy-departamento-' + formId).submit();
        });
    });

});

$(function () {
    var descarga_departamentos= $('#descarga_excel_departamentos');

    descarga_departamentos.on('click', function (event) {
        event.preventDefault();
        waitingDialog.show()

        var valor_busqueda = $('#buscar').val();
        var valor_orden = $('[name="orden"]').val();
        var datos = descarga_departamentos.serialize();
        
        datos += "&buscar=" + valor_busqueda;
        datos += "&orden=" + valor_orden;

        $.ajax({
            type: 'POST',
            url: "/descargar_excel_departamentos",
            data: datos,
            success: function (response) {

                if (response.success) {
                    var link = document.createElement('a');
                    link.href = response.url;
                    link.download = 'Lista_de_departamentos.txt';
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
