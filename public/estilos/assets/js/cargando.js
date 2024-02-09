/**
 * Module for displaying "Waiting for..." dialog using Bootstrap
 *
 * @author bramirez
 */
// var rutaImagenCargando = $("#data-ruta-imagen-cargando").data("ruta-imagen-cargando");
var waitingDialog = waitingDialog || (function ($) {
    'use strict';
    var waitingDialog={
        show_msg: function (title,message) {
            return swal({
                allowEscapeKey: false,
                allowOutsideClick: false,
                allowEnterKey: false,
                html: waitingDialog.html('<h3>'+title+'</h3><br/><div>'+message+'</div>'),
                showCancelButton: false,
                showConfirmButton: false,
                animation: false
            });
        },
        show: function () {
            return waitingDialog.show_msg('Sus datos se est&aacute;n procesando.','<p>Por favor, espere.</p>');
        },
        hide: function () {
            swal.closeModal();
        },
        html:function(after,max_width_img){
            if(max_width_img==parseInt(max_width_img) && parseInt(max_width_img)>0){
                max_width_img=parseInt(max_width_img);
            }else{
                max_width_img=200;
            }
            var node='<img src="' + rutaImagenCargando + '" style="max-width: '+max_width_img+'px; width: 100%;">';
            if(typeof after!=='string') after='';
            return '<table width="100%" style="max-width: 100%; height: 100%;"><tbody><tr><td align="center" style="text-align: center;">'+node+after+'</td></tr></tbody></table>';
        },
        loading:function(selector,text){
            if(typeof text!=='string') text='Cargando...';
            $(selector).html(waitingDialog.html('<p>'+text+'</p>'));
        }
    };
    return waitingDialog;

})(jQuery);
