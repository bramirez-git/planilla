$(document).ready(function() {
    $(".btn-modal-cargando").on("click", function () {
        $('#cargando').modal('show');
    });
    // Actualiza el valor oculto cuando el span cambia
    $('.valorSpan').on('DOMSubtreeModified', function() {
        var key = $(this).attr('data-key');
        var nuevoValor = $(this).text();
        $(key).val(nuevoValor);
    });
    $('#frm_cal_salarial').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            'data[salario]': {
                required: true
            }
        },
        messages: {
            'data[salario]': {
                required: "Este campo es requerido.",
            },
        },
        errorPlacement: function(error, element){
            if(element.hasClass("form-control")){
                error.insertAfter(element.closest('.input-group'));
            }else{
                error.insertAfter(element);
            }
        }
    });
    $("#enviarBtnDos").click(function() {
        if($('#frm_cal_salarial').valid())
        {
            waitingDialog.show();
            $("#frm_cal_salarial").submit();
        }
    });
    $("#enviarBtn").click(function() {
        if($('#frm_cal_salarial').valid())
        {
            waitingDialog.show();
            $("#frm_cal_salarial").submit();
        }
    });
});

//     $('table tbody').on('dblclick', 'td', function(){
//         var valCell = $(this).find('span').text();
//
//         $(this).find('span').hide();
//         $(this).find('div').show().html('\
// <div class="input-group">\
//   <input type="text" class="form-control-md" value="'+valCell+'">\
//   <span class="input-group-btn">\
//     <button id="save" class="btn btn-default" type="button"><i class="fa fa-check w-1 text-90 text-white-tp1"></i></button>\
//     <button id="close" class="btn btn-default" type="button"><i class="fa fa-close w-1 text-90 text-white-tp1"></i></button>\
//   </span>\
// </div>');
//         $(this).find('input').focus();
//         $(this).closest('tbody').find('td').not($(this)).each(function(){
//             $(this).find('span').show();
//             $(this).find('div').hide();
//         });
//     });

$('table').on('click','#close',function(){
    $(this).closest('td').find('span.value').show();
    $(this).closest('div').hide();
});
$('table').on('click','#save', function(){
    var getValueInput = $(this).closest('div').find('input').val();
    $(this).closest('td').find('span.value').text(getValueInput);

    $(this).closest('td').find('span.value').show();
    $(this).closest('div').hide();
});
