$(function(){
    $("#limpiarCampos").on("click", function(){
        // Obtener el formulario por su ID
        const form=$("#frm_filtros");
        // Limpiar los campos estableciendo su valor en cadena vacía
        form.find("input[type=text]").val('');
        // form.find("input[type=radio]").prop("checked", false);
        // form.find("input[type=checkbox]").prop("checked", false);
        // Seleccionar la opción "Inactivo"
        form.find("input[name='filtro[estado][]'][value='']").trigger("click");
    });
});



$.fn.create_update_noticia=function(id='', cliente=''){
    var dialog_noticia=$(this);
    var form=dialog_noticia.find('#frm-mantenimiento-noticia');
    var data=form.serializeObject();
    data.id_cliente=cliente;
    data.id=id;
    console.log(data);
    // despues de aquii se implementa logica de guardado u editado
    dialog_noticia.modal('hide');
    mostrarAlertaExito('exito!');

};
function delete_noticia(id_noticia = '') {
    confirmar('Eliminar noticia', '&iquest;Desea eliminar la noticia?', 'question', function () {
        waitingDialog.show();
        // Obtén la URL desde el atributo de datos del elemento HTML
        var noticiasDestroyUrl = $('#noticiasDestroyUrl').data('url-destroy');
        $.ajax({
            url: noticiasDestroyUrl.replace('1', id_noticia),
            type: 'DELETE',
            data:{id_noticia:id_noticia},
            global:false,
            success: function (response) {
                console.log();
                // Redirige a la ruta proporcionada por el controlador si la respuesta es exitosa
                if (response.success) {
                    window.location.href = response.redirect + '?success=' + response.success + '&message=' + response.message;
                } else {
                    mostrarAlertaError(response.error);
                }
            }
        });
    });
}
