$(document).ready(function() {
    $('#btn-historico').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        waitingDialog.show();
        // Obtén el formulario por su ID
        var formulario=$('#frm-historico-aguinaldo');
        // Envía el formulario
        formulario.submit();
    });
    $('#btn-h-renta').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        waitingDialog.show();
        // Obtén el formulario por su ID
        var formulario=$('#frm-historico-renta');
        // Envía el formulario
        formulario.submit();
    });
    $('#btn-h-vacaciones').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        waitingDialog.show();
        // Obtén el formulario por su ID
        var formulario=$('#frm-historico-vaciones');
        // Envía el formulario
        formulario.submit();
    });

    if ($('.number-input').length) {

        var numberInput = document.getElementsByClassName('number-input');

        for(var i = 0; i < numberInput.length; i++){
            numberInput[i].addEventListener('keydown', function (evt) {
                !/(^\d*\.?\d*$)|(Backspace|Control|Meta)/.test(evt.key) && evt.preventDefault();

                if($(this).val().includes("."))
                {
                    var e = evt || window.evt;
                    var key = e.keyCode || e.which;

                    if ( key === 110 || key === 190 || key === 188 ) {

                        evt.preventDefault();
                    }
                }
            });
        }
    }

});
function link_config_colaborador_index(){
    $('#CCSSINS-tab').trigger("click");
}
