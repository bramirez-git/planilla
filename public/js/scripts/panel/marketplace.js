$(document).ready(function(){

    var frmMarketplace = $('#frm-marketplaces');
    frmMarketplace.validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            nombre_modulo: {
                required: true
            },
            precio: {
                required: true
            },
            descripcion: {
                required: true
            }
        },
        messages: {
            nombre_modulo: {
                required: "Este campo es requerido."
            },
            precio: {
                required: "Este campo es requerido."
            },
            descripcion: {
                required: "Este campo es requerido."
            }
        },
        errorElement: 'span'
    });

    // Captura el evento de clic en el botón con id #registrar
    $('#registrar').on('click', function(evt) {
        evt.preventDefault(); // Evita que el formulario se envíe normalmente

        var value = $('#estado').prop('checked') ? 1 : 2;

        $('#estado').prop('checked', $(this).prop('checked'));

        $('#valor_estado').val(value);


        if (frmMarketplace.valid()) {
            confirmar('', '¿Desea guardar el producto?', 'question', function() {
                waitingDialog.show();

                frmMarketplace.submit();
            });
        } else {
            return false;
        }
    });


    //Actualizar producto
    $('#actualizar').on('click', function(evt) {
        evt.preventDefault(); // Evita que el formulario se envíe normalmente

        var value = $('#estado').prop('checked') ? 1 : 2;

        $('#estado').prop('checked', $(this).prop('checked'));

        $('#valor_estado').val(value);


        if (frmMarketplace.valid()) {
            confirmar('', '¿Desea actualizar el producto?', 'question', function() {
                waitingDialog.show();

                frmMarketplace.submit();
            });
        } else {
            return false;
        }
    });

    //Eliminar un producto
    $('.eliminar-producto').on('click', function(event){
        event.preventDefault();
        // Obtiene el ID del formulario del atributo de datos del enlace
        var formId = $(this).data('form-id');
        confirmar('', '¿Está seguro que desea eliminar el producto?', 'question', function(){
            waitingDialog.show();
            $('#frm-destroy-marketplace-' + formId).submit();
        });
    });

    $('#precio').on('input', function() {
        var $t = $(this);
        var inputValue = $t.val();
        var cursorPosition = $t[0].selectionStart;

        // Eliminar cualquier carácter que no sea un dígito o un punto decimal
        var validatedValue = inputValue.replace(/[^\d.]/g, '');

        // Permitir solo un punto decimal
        var parts = validatedValue.split('.');
        if (parts.length > 2) {
            validatedValue = parts[0] + '.' + parts.slice(1).join('');
        }

        // Evitar un punto al inicio del número
        if (validatedValue.charAt(0) === '.') {
            validatedValue = validatedValue.slice(1);
        }

        // Actualizar el valor del campo con la versión validada
        $t.val(validatedValue);

        // Restaurar la posición del cursor después de formatear el valor
        if (cursorPosition < $t.val().length) {
            $t[0].setSelectionRange(cursorPosition, cursorPosition);
        }
    });





    /* document.addEventListener('DOMContentLoaded', function () {


            var agregarTerminosCheckbox = document.getElementById('agregarTerminos');
            var insertarArchivoCheckbox = document.getElementById('insertarArchivo');
            var areaTexto = document.getElementById('areaTexto');
            var campoArchivo = document.getElementById('campoArchivo');
            var terminosTextarea = document.getElementById('id-textarea-autosize-terminos');
            var archivoTerminos = document.getElementById('documento');

            function actualizarVisibilidad() {
                if (agregarTerminosCheckbox.checked) {
                    areaTexto.style.display = 'block';
                    terminosTextarea.setAttribute('required', 'true');
                } else {
                    areaTexto.style.display = 'none';
                    terminosTextarea.removeAttribute('required');
                }

                if (insertarArchivoCheckbox.checked) {
                    campoArchivo.style.display = 'block';
                    archivoTerminos.setAttribute('required', 'true');
                } else {
                    campoArchivo.style.display = 'none';
                    archivoTerminos.removeAttribute('required');
                }
            }


            actualizarVisibilidad();

            agregarTerminosCheckbox.addEventListener('change', actualizarVisibilidad);
            insertarArchivoCheckbox.addEventListener('change', actualizarVisibilidad);
        }); */


// Ajuste de texarea: esto hace que el texarea se expanda cuando el usuario está escribiendo...
    var textareaDescripcion = $('#descripcion');


    ajustarAltura(textareaDescripcion);

    textareaDescripcion.on('input', function() {
        ajustarAltura($(this));
    });



    function ajustarAltura(elemento) {
        elemento.css('height', 'auto');
        elemento.css('height', elemento.prop('scrollHeight') + 'px');
    }

    $(function () {
        var descarga_marketplace = $('#descarga_excel_marketplace');
        descarga_marketplace.on('click', function (event) {
            event.preventDefault();
            waitingDialog.show()
            var valor_busqueda = $('#buscar').val();
            var orden = $('[name="orden"]').val();
            var tipo_orden = $('[name="tipo_orden"]').val();

            var datos = descarga_marketplace.serialize();
            datos += "&buscar=" + valor_busqueda;
            datos += "&orden=" + orden;
            datos += "&tipo_orden=" + tipo_orden;


            $.ajax({
                type: 'POST',
                url: base_path+"/panelAdministracion/descargar_excel_marketplace",
                data: datos,
                success: function (response) {

                    if (response.success) {
                        var link = document.createElement('a');
                        link.href = response.url;
                        link.download = 'Lista_de_marketplace.txt';
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




});
