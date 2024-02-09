$(document).ready(function(){
    $('.limited-to-100').on('input', function(){
        // Obtenemos el valor ingresado y lo convertimos a un número
        var valor=parseFloat($(this).val());
        // Verificamos si el valor es mayor a 100
        if(valor>100){
            // Si es mayor a 100, ajustamos el valor a 100
            $(this).val(100);
        }
    });

    // Adjunta un escuchador de eventos de clic a todos los botones con data-dismiss="modal"
    $('[data-dismiss="modal"]').on('click', function () {
        const modals = $('.modal');
        // Cierra todos los modales usando la función modal('hide')
        modals.modal('hide');
    });


});
