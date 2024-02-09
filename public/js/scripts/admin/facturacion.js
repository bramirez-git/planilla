
    function pagarFacturaPendiente(idRecarga, numFactura){
        waitingDialog.show();
        $.ajax({
            url: base_path + "/pagoFactura/" + idRecarga,
            type: "GET",
            global: false,
            success: function (response) {
                var dialog_facturacion_pago = bootbox.dialog({
                    title: "Pago Factura #" + numFactura,
                    message: response.html,
                    centerVertical: true,
                    size: "lg",
                });
                dialog_facturacion_pago.init(function () {
                    dialog_facturacion_pago.attr("id", "global_bootbox_facturacion_pago");
                    dialog_facturacion_pago.find('.modal-dialog').css({
                        width: '70%',
                    });
                });
                dialog_facturacion_pago.modal('show');
                waitingDialog.hide();
            }
        });
    }

    function pagarFacturaSinpeMovil(idRecarga, numFactura){
        waitingDialog.show();
        $.ajax({
            url: base_path + "/pagoFacturaSinpeMovil/" + idRecarga,
            type: "GET",
            global: false,
            success: function (response) {
                var dialog_pago_sinpe_movil = bootbox.dialog({
                    title: "Pago Factura #" + numFactura,
                    message: response.html,
                    centerVertical: true,
                    size: "lg",
                });
                dialog_pago_sinpe_movil.init(function () {
                    dialog_pago_sinpe_movil.attr("id", "global_bootbox_pago_sinpe_movil");
                    dialog_pago_sinpe_movil.find('.modal-dialog').css({
                        width: '70%',
                    });
                });
                dialog_pago_sinpe_movil.modal('show');
                waitingDialog.hide();
            }
        });
    }

    function descargarPdfFactura(id_recarga){
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_path + "/descargarPdfFactura",
            data: "id_recarga=" + id_recarga + "&accion=descargarPdfFactura",
            global: false,
            beforeSend: function() {
                waitingDialog.show();
            },
            success: function(respuesta){
                var info_respuesta = JSON.parse(respuesta);
                if((info_respuesta.estado == "ok") && (info_respuesta.url_pdf != "")){
                    waitingDialog.hide();
                    window.open(info_respuesta.url_pdf, "_blank");
                    return false;
                }else{
                    mostrarAlertaError( "Se presentó un error al generar el PDF.");
                }
            },
            complete: function(response) {

            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }

    function descargarXmlFactura(id_recarga){
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_path + "/descargarXmlFactura",
            data: "id_recarga=" + id_recarga + "&accion=descargarXml",
            global: false,
            beforeSend: function() {
                waitingDialog.show();
            },
            success: function(respuesta){
                var info_respuesta = JSON.parse(respuesta);
                if((info_respuesta.estado == "ok") && (info_respuesta.url_xml != "")){
                    waitingDialog.hide();
                    window.open(info_respuesta.url_xml, "_blank");
                    return false;
                }else{
                    mostrarAlertaError( "No hay datos para mostrar.");
                }
            },
            complete: function(response) {

            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }

    function descargarXmlMHFactura(id_recarga){
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_path + "/descargarXmlMHFactura",
            data: "id_recarga=" + id_recarga + "&accion=descargarXmlMH",
            global: false,
            beforeSend: function() {
                waitingDialog.show();
            },
            success: function(respuesta){
                var info_respuesta = JSON.parse(respuesta);
                if((info_respuesta.estado == "ok") && (info_respuesta.url_xml != "")){
                    waitingDialog.hide();
                    window.open(info_respuesta.url_xml, "_blank");
                    return false;
                }else{
                    mostrarAlertaError( "No hay datos para mostrar.");
                }
            },
            complete: function(response) {

            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }


