$(document).ready(function(){

});


function contratar_servicio(){
    if($('#frm_contratar_serv').valid())
    {
        waitingDialog.show();
        $('#frm_contratar_serv').submit();
    }
    else{
        return false;
    }
}

function solicitar_baja_serv(){
    if($('#frm_baja_serv').valid())
    {
        waitingDialog.show();
        $('#frm_baja_serv').submit();
    }
    else{
        return false;
    }
}


function ui_contratar_servicio(id_servicio=""){
    waitingDialog.show();
    $.ajax({
        url: base_path+'/ui_contratar_servicios/'+id_servicio, // Ruta en tu controlador de Laravel para obtener el contenido del modal
        type: 'GET',
        global:false,
        success: function(response){
            var dialog_documentos_digitales = bootbox.dialog({
                title: $('<i>',{
                    class: 'fab fa-buffer text-blue-m2'
                }).prop('outerHTML')+"&nbsp;Servicio adicional",
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-danger",
                    }
                },
            });
            dialog_documentos_digitales.init(function(){
                dialog_documentos_digitales.attr("id", "global_bootbox_documento_digitales");
                dialog_documentos_digitales.find('.modal-dialog').css({
                    width: '50%', // O el valor que prefieras
                });
            });
            var form = dialog_documentos_digitales.find('form#frm-documentos-digitales');
            dialog_documentos_digitales.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}

function ui_servicio_config(id_servicio=""){
    waitingDialog.show();
    $.ajax({
        url: base_path+'/ui_servicio_config/'+id_servicio, // Ruta en tu controlador de Laravel para obtener el contenido del modal
        type: 'GET',
        global:false,
        success: function(response){
            var dialog_documentos_digitales = bootbox.dialog({
                title: $('<i>',{
                    class: 'fab fa-buffer text-blue-m2'
                }).prop('outerHTML')+"&nbsp;Servicio adicional",
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-danger",
                    }
                },
            });
            dialog_documentos_digitales.init(function(){
                dialog_documentos_digitales.attr("id", "global_bootbox_documento_digitales");
                dialog_documentos_digitales.find('.modal-dialog').css({
                    width: '50%', // O el valor que prefieras
                });
            });
            var form = dialog_documentos_digitales.find('form#frm-documentos-digitales');
            dialog_documentos_digitales.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}





