$(document).ready(function(){
$('#fechaPublicacion').val(getCurrentDateFormatted());

    var frmNoticias= $('#frm-create-noticia');

    frmNoticias.validate({
        errorElement: 'div',
        errorClass: 'text-danger', // Clase para el mensaje de error
        focusInvalid: false,
        rules: {
            tituloNoticia: {
                required: true
            },
            estadoNoticia: {
                required: true
            },
            fechaPublicacion: {
                required: true
            }
        },

        messages: {
            tituloNoticia: {
                required: "Este campo es requerido.",
            },
            estadoNoticia: {
                required: "Este campo es requerido.",
            },
            fechaPublicacion: {
                required: "Este campo es requerido.",
            }
        },

        errorPlacement: function (error, element) {
            // Verifica si el elemento es un campo de formulario
            if (element.hasClass("form-control")) {
                // Si es un campo de formulario, inserta después del contenedor .input-group
                error.insertAfter(element.closest('.input-group'));
            } else {
                // Si no es un campo de formulario, inserta después del elemento
                error.insertAfter(element);
            }
        }
        ,

        highlight: function (element, errorClass, validClass) {
            // Resaltar el campo con error
            $(element).closest('.form-group').addClass('has-error');
        },

        unhighlight: function (element, errorClass, validClass) {
            // Eliminar el resaltado cuando se corrige el error
            $(element).closest('.form-group').removeClass('has-error');
        }
    });

    // Captura el evento de clic en el botón con id #registrar
    $('#publicar').on('click', function(evt) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente

        if (frmNoticias.valid()) {
                waitingDialog.show();
                frmNoticias.submit();
        } else {
            return false;
        }
    });


    // Captura el evento de clic en el botón con id #registrar
    $('#agendar').on('click', function(evt) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente

        if (frmNoticias.valid()) {
            confirmar_input('Fecha de Publicación','Fecha emitida para agendar la publicación de la noticia','date',{
                value: getCurrentDateFormatted(),
                required: 'required',
                showOn: 'button',
            }    ,function(val){
                waitingDialog.show();
                $('#fechaPublicacion').val(val);
                $('#estadoNoticia').val('borrador');
                frmNoticias.submit();
            },function(){
                return false;
            });
        } else {
            return false;
        }
    });

});
