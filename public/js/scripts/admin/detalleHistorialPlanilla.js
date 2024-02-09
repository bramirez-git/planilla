
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    }
});

// Objeto para almacenar los valores
var valores = {};

// Selector para todos los elementos de entrada con data-historial-planilla="true"
var inputs = $("input[data-historial-planilla='true']:hidden");

// Iterar sobre los elementos de entrada y almacenar sus valores en el objeto
inputs.each(function() {
    var id = $(this).attr("id");
    var valor = $(this).val();
    valores[id] = valor;
    // Asignar el valor al atributo data del elemento correspondiente
    $(this).data("valor", valor);
});
var urlDetalleHistorialPlanillaPost = $("#url_detalleHistorialPlanillaPost").val();

$.ajax({
    type: "post",
    url: urlDetalleHistorialPlanillaPost,
    data:valores,
    beforeSend: function() {
        waitingDialog.show();
    },
    success: (response) => {
        $("#tablas").empty().append(response);
        waitingDialog.hide();
    },
    error: function(response){
        mostrarAlertaError(response);
    }
});

var urlexportarExcelDetalleHistorialPlanilla = $("#url_exportarExcelDetalleHistorialPlanilla").val();
var id_planilla_encrypt = $("#url_exportarExcelDetalleHistorialPlanilla").data('id-encrypt');
$('#descargar_excel').on('click', function (evt){
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: urlexportarExcelDetalleHistorialPlanilla,
        data: {
            "id_planilla": id_planilla_encrypt
        },
        beforeSend: function() {
         waitingDialog.show();
        },
        success: function(url_excel){
            if(url_excel != ""){
                window.open(url_excel, "_self");
            }
            waitingDialog.hide();
        },
        error: function (response) {
            mostrarAlertaError(response.responseJSON.message);
        }
    });
});

var urlexportarArchivoTxtBancoHistorialPlanilla = $("#url_exportarArchivoTxtBancoHistorialPlanilla").val();
function descargar_txt_banco(id_banco){
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: urlexportarArchivoTxtBancoHistorialPlanilla,
        data: {
            "id_planilla": id_planilla_encrypt,
            "id_banco": id_banco
        },
        beforeSend: function() {
            //$("#cargando").modal("show");
        },
        success: function(url_txt_banco){
            if(url_txt_banco != ""){
                window.open(url_txt_banco, "_blank");
                return false;
            }
        },
        complete: function(response) {
            //$("#cargando").modal("hide");
        },
        error: function (response) {
            alert(response.responseJSON.message);
        }
    });
}

function closeMagnificPopup() {
    $('.mfp-close').trigger('click');
}