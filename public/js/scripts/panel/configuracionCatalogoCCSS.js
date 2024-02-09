$(function () {
    var descarga_noticias = $('#descarga_excel_CCSS');
    descarga_noticias.on('click', function (event) {
        event.preventDefault();
        waitingDialog.show()
        var valor_busqueda = $('#buscar').val();
        var orden = $('[name="filtro[orden]"]').val();
        var tipo_orden = $('[name="filtro[tipo_orden]"]').val();
        var columna = $('[name="filtro[buscar]"]').val();

        var datos = descarga_noticias.serialize();
        datos += "&buscar=" + valor_busqueda;
        datos += "&orden=" + orden;
        datos += "&tipo_orden=" + tipo_orden;
        datos += "&columna=" + columna;


        $.ajax({
            type: 'POST',
            url: base_path+"/panelAdministracion/descargar_excel_CCSS",
            data: datos,
            success: function (response) {

                if (response.success) {
                    var link = document.createElement('a');
                    link.href = response.url;
                    link.download = 'Lista_de_CCSS.txt';
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
