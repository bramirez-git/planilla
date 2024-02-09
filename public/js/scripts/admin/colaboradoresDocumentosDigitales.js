$(document).ready(function(){
    $('#crearZipBtn').click(function(){
        exportarDocZIP();
    });
});
function ui_adjuntar_documentos(id='', cliente=''){
    waitingDialog.show();
    $.ajax({
        url: base_path+'/uiDocumentoDigitales/'+id, // Ruta en tu controlador de Laravel para obtener el contenido del modal
        type: 'GET',
        global:false,
        success: function(response){
            var dialog_documentos_digitales = bootbox.dialog({
                title: "Mantenimiento de documentos digitales",
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-secondary",
                    },
                    guardar: {
                        label: "<i class='fa fa-save'></i>&nbsp;Guardar",
                        className: "btn btn-light-primary",
                        callback: function(){
                            if($(form).valid()){
                                dialog_documentos_digitales.crear_documentos_digitales(id, '');
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
                dialog_documentos_digitales.on('shown.bs.modal', function () {
                    // Inicializar AmsifySuggestags después de que el modal se ha mostrado completamente
                    $('.palabrasClaves').amsifySuggestags({
                        suggestions: ['Amonestacion','Curriculum','PDF','Vacaciones']
                    });
                });
            });
            var form = dialog_documentos_digitales.find('form#frm-documentos-digitales');
            dialog_documentos_digitales.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}

$.fn.crear_documentos_digitales=function(id='', cliente=''){
    var dialog_documentos_digitales=$(this);
    var form=dialog_documentos_digitales.find('#frm-documentos-digitales');
    //var data=form.serializeObject();
    form.submit();
    /*data.id_cliente=cliente;
    data.id_contacto=id;
    mensaje_swal('success','exito!',function(){
        dialog_documentos_digitales.modal('hide');
    });*/

};


function ui_enviar_correo(id='', cliente=''){
    waitingDialog.show();
    $.ajax({
        url: base_path+'/uiEnviarCorreo/'+id, // Ruta en tu controlador de Laravel para obtener el contenido del modal
        type: 'GET',
        global:false,
        success: function(response){
            var dialog_enviar_correo = bootbox.dialog({
                title: "Enviar documentos por correo",
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-secondary",
                    },
                    guardar: {
                        label: "<i class='fa fa-paper-plane'></i>&nbsp;Enviar",
                        className: "btn btn-light-primary",
                        callback: function(){
                            if($(form).valid()){
                                dialog_enviar_correo.crear_enviar_correo(id, '');
                            }
                            return false;
                        }
                    }
                },
            });
            dialog_enviar_correo.init(function(){
                dialog_enviar_correo.attr("id", "global_bootbox_documento_digitales");
                dialog_enviar_correo.find('.modal-dialog').css({
                    width: '30%', // O el valor que prefieras
                });
                dialog_enviar_correo.on('shown.bs.modal', function () {
                    $('#tag-input').tagsinput({
                        tagClass: 'badge badge-secondary font-normal',
                        focusClass: 'tagsinput-focus'
                    });
                });
            });
            var form = dialog_enviar_correo.find('form#frm-enviar-correo');
            dialog_enviar_correo.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}

$.fn.crear_enviar_correo=function(id='', cliente=''){
    var dialog_enviar_correo=$(this);
    var form=dialog_enviar_correo.find('#frm-enviar-correo');
    form.submit();
};
async function exportarDocZIP() {
    let rowData = [];
    // Recopilar datos de las filas con casillas de verificación activas y agregarlos al archivo ZIP
    $('#simple-table tbody tr').each(async function(index) {
        let checkbox = $(this).find('td input[type="checkbox"]');
        if (checkbox.prop('checked')) {
            // Agregar datos adicionales al archivo ZIP
            const url_documento = $(checkbox).closest('td[data-url]').data('url');
            rowData.push({'index':index,'url':url_documento});
        }
    });
    if(!rowData.length){
        return false;
    }
    waitingDialog.show();
    $.ajax({
        type: 'POST',
        url: base_path+'/descargar_doc_digitales',
        global:false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: { files: rowData },
        success: function (data) {
            if (data.success) {
                // Convierte la cadena Base64 a un Blob
                const blob = base64toBlob(data.info.blob, 'application/zip');

                // Crea un enlace para descargar el archivo
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'archivo.zip';
                link.click();
                mostrarAlertaExito('Archivo ZIP creado.');
            } else {
                mostrarAlertaError('Error al crear el archivo zip:',data.error);
                console.error('Error al crear el archivo zip:', data.error);
            }
        },
        error: function (error) {
            mostrarAlertaError('Error en la solicitud AJAX:', error);
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

// Función para convertir Base64 a Blob
function base64toBlob(base64, contentType) {
    contentType = contentType || '';
    const sliceSize = 1024;
    const byteCharacters = atob(base64);
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        const slice = byteCharacters.slice(offset, offset + sliceSize);
        const byteNumbers = new Array(slice.length);

        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        const byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }

    return new Blob(byteArrays, { type: contentType });
}


$(document).on('change','#check_doc_all',function(event){
    var chk=$(':not(:disabled):checkbox[check_doc]');
    chk.prop('checked',$(this).prop('checked'));
    var cant = chk.filter(':checked').length;
    $('#count_checked').text(cant);
    if(cant <= 0){
        mostrarBotonRelacionarCompra('hide');
    }else {
        mostrarBotonRelacionarCompra('show');
    }
});

$(document).on('change',':checkbox[check_doc]',function(event){
    var chk=$(':checkbox[check_doc]');
    var cant = chk.filter(':checked').length;
    if(chk.length==cant){
        $('#check_doc_all').prop('checked',true);
    }
    else{
        $('#check_doc_all').prop('checked',false);
    }
    $('#count_checked').text(cant);
    if(cant <= 0){
        mostrarBotonRelacionarCompra('hide');
    }else {
        mostrarBotonRelacionarCompra('show');
    }
});

function mostrarBotonRelacionarCompra(accion) {
    if (accion === 'show') {
        $('#div_count_checked').show();
        $('*[id*=div_relacionar_compra]').each(function () {
            $(this).show();
        });
    }

    if (accion === 'hide') {
        $('#div_count_checked').hide();
        $('*[id*=div_relacionar_compra]').each(function () {
            $(this).hide();
        });
    }
}
