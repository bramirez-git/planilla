$(function () {
    var descarga_noticias = $('#descarga_excel_noticias');
    descarga_noticias.on('click', function (event) {
        event.preventDefault();
        waitingDialog.show()
        var valor_busqueda = $('#buscar').val();
        var valor_orden = $('[name="filtro[orden]"]').val();
        var estado = $('[name="filtro[estado]"]:checked').val();
        var valor_tipo_orden = $('[name="filtro[tipo_orden]"]').val();
        var valor_fecha_ingreso = $('#fechaIngreso').val();
        var valor_fecha_final = $('#fechaFinal').val();

        var datos = descarga_noticias.serialize();
        datos += "&buscar=" + valor_busqueda;
        datos += "&orden=" + valor_orden;
        datos += "&estado=" + estado;
        datos += "&tipo_orden=" + valor_tipo_orden;
        datos += "&fechaIngreso=" + valor_fecha_ingreso;
        datos += "&fechaFinal=" + valor_fecha_final;

        $.ajax({
            type: 'POST',
            url: base_path+"/panelAdministracion/descargar_excel_noticias",
            data: datos,
            success: function (response) {

                if (response.success) {
                    var link = document.createElement('a');
                    link.href = response.url;
                    link.download = 'Lista_de_noticias.txt';
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
