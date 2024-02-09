//para calendarios en fechas
$(document).ready(function(){

    //Calendario
    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "dd/mm/yyyy"
    };

    //Dfecha mascara
    $('.input-daterange').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        orientation: 'bottom'
    });

    //masacara excepto el select
    $(":input:not(select)").inputmask();
    //celular mascara


    //IBAN mascara
    $("#cuentaIban").inputmask({
        mask: 'CR 9999 9999 9999 9999 9999',
        placeholder: 'CR 9999 9999 9999 9999 9999',
        showMaskOnHover: true,
        showMaskOnFocus: true,
        onBeforePaste: function (pastedValue, opts) {
            var processedValue = pastedValue;

            //do something with it

            return processedValue;
        }
    });

    $('[data-rel=tooltip]').tooltip({html: true});

    $(".variables_clic").on("click", function() {
        $(".note-editable").append($(this).text().trim()+" ");
    });
});

//subir fotos
if ($('.cropme').length) {
    //crop de fotos
    $('.cropme').simpleCropper();
}

//bootbox
bootbox.setDefaults({'locale' : 'es'});

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$("[data-toggle=tooltip]").tooltip();


//numeros en los text
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


//buscar numero de cedula

if ($('#buscarCedula').length)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}
