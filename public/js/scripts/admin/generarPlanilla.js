$(document).ready(function(){
    // Eliminar planilla
    var frmDestroyPlanilla = $('#frm-destroy-planilla');

    frmDestroyPlanilla.on('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente

        if ($(this).valid()) {
            confirmar('', '¿Está seguro que desea desechar la planilla?', 'question', function() {
                waitingDialog.show();
                // Realiza una solicitud AJAX para enviar el formulario
                $.ajax({
                    type: 'DELETE',
                    url: frmDestroyPlanilla.attr('action'),
                    data: frmDestroyPlanilla.serialize(),
                    success: function(response) {
                        // Redirige a la ruta proporcionada por el controlador si la respuesta es exitosa
                        if (response.success) {
                            mensaje_swal('success',response.message,function(){
                                waitingDialog.show();
                                window.location.href = response.redirect;
                            },false,null,'Continuar');
                        } else {
                            // mensaje_swal('error', response.error);
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
    // Captura el evento de clic en el botón con id #btn-delete-planilla
    $('#btn-delete-planilla').on('click', function(evt) {
        // Activa el evento de envío del formulario
        frmDestroyPlanilla.submit();
    });

});
