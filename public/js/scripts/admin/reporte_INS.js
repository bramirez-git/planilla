document.addEventListener("DOMContentLoaded", function() {
    var botones = document.querySelectorAll('.habilitar_botones');
    botones.forEach(function(boton) {
        boton.style.pointerEvents = 'auto';
    });
});
function getVariable() {
    $.ajax({
        url: base_path +'/mostrar_variable_temp',
        type: 'GET',
        global:false,
        success: function (data) {
            console.log(data);
            if(data==1){
                mensaje_swal('error','Se presentó un error al crear el archivo, por favor revisar el documento',
                    function(){
                    }, false, null, 'Continuar');
            }
            if(data==0){
                mostrarAlertaExito('¡Descarga completada con éxito!');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al realizar la solicitud Ajax:', error);
        }
    });
}
