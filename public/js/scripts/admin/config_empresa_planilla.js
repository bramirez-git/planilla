$(document).ready(function(){
    var errores = [];
    $('#anios_cesantia').on('input', manejarKeyup);
    $('#numero_poliza_ins').on('input', manejarKeyup);
    $('#selectpicker1').selectpicker();
    $('#selectpicker2').selectpicker();
    $('#selectpicker3').selectpicker();
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    //3- Planilla
    $('#guardar-planilla').on('click', function(evt){
        $('#confirmModalPlanilla').modal('hide');
        $('#cargando').modal('show');
    });
    $.validator.setDefaults({
        ignore: []
    });

    var frmCinfigPlanilla=$('#form-planilla');
    frmCinfigPlanilla.validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            id_pais: {
                required: true
            },
            "id_tipos_planilla[]": {
                required: true
            },
            "id_monedas[]": {
                required: true
            },
            id_tipo_pago: {
                required: true
            },
            porcentaje_salario_adelanto: {
                number:true,
                max: 50,
                min: 1,
            },
            anios_cesantia: {
                required: true,
                min: 1,
                max: 8
            },
            numero_patrono_ccss: {
                required: true
            },
            numero_poliza_ins: {
                required: true
            },
            porcentaje_poliza_ins: {
                number:true,
                required: true,
                min: 1,
                max: 100
            },
        },
        messages: {
            id_pais: {
                required: "Este campo es requerido."
            },
            "id_tipos_planilla[]": {
                required: "Este campo es requerido."
            },
            "id_monedas[]": {
                required: "Este campo es requerido."
            },
            id_tipo_pago: {
                required: "Este campo es requerido."
            },
            porcentaje_salario_adelanto: {
                number: "Por favor, digite un valor número válido",
                max: "Por favor, digite un valor menor o igual a 50.",
                min: "Por favor, digite un valor mayor o igual a 0.",
            },
            anios_cesantia: {
                required: "Este campo es requerido.",
                min: "Por favor, digite un valor mayor o igual a 1.",
                max: "Por favor, digite un valor menor o igual a 8."
            },
            numero_patrono_ccss: {
                required: "Este campo es requerido."
            },
            numero_poliza_ins: {
                required: "Digite su número de póliza de riesgos de Trabajo. Esta consta de 7 dígitos y se puede visualizar en su recibo de pago."
            },
            porcentaje_poliza_ins: {
                number: "Por favor, digite un valor número válido",
                required: "Este campo es requerido.",
                min: "Por favor, digite un valor mayor o igual a 1.",
                max: "Por favor, digite un valor menor o igual a 100."
            }
        },
        errorPlacement: function (error, element) {
            // Insertar errores y agregar campo a la lista si aún no está presente
            if (element.hasClass("form-control")) {
                error.insertAfter(element.closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        },
        invalidHandler: function(event, validator) {
            $.each(validator.errorList, function(index) {
                var elemento = validator.errorList[index].element;
                manejarError(elemento, true);
            });
        },
    });
    $("#registrarplanilla").on('click', function(evt){
        if(frmCinfigPlanilla.valid()){
            $('#confirmModalPlanilla').modal('show');
        }else{
            var listaErroresHTML = '<br>' +
                '<ol style="text-align: left; margin-left: 70px;">';

            // Agregar elementos li para cada error usando Object.keys(errores).forEach
            Object.keys(errores).forEach(function (fieldName) {
                listaErroresHTML += '<li style="">' + fieldName + '</li>';
            });

            // Cerrar la lista ordenada
            listaErroresHTML += '</ol>';
            mensaje_swal('error', 'Por favor, confirme los siguientes campos:<br>' + listaErroresHTML, function () {
            }, false, null, 'Continuar');
            errores=[];
            return false;
        }
    });
    $('#selectpicker1').on('change', function(){
        let seleccionado=0;
        $('#selectpicker1 :selected').each(function(i, sel){
            if($(sel).val()==2){
                seleccionado=2;
            }
        });
        if(seleccionado==2){
            $('#divTipoPago').show();
        }else{
            $('#divTipoPago').hide();
        }
    });
    $('#asociacion').on('click', function(){
        if($('#asociacion').is(':checked')){
            $('#divAportes').show();
        }else{
            $('#divAportes').hide();
        }
    });
    $('#prestamos').on('click', function(){
        if($('#prestamos').is(':checked')){
            $('#divPrestamos').show();
        }else{
            $('#divPrestamos').hide();
        }
    });

    function manejarError(element, agregar) {
        // Agregar o eliminar el nombre del campo de la lista de errores
        var fieldName = $(element).data("name_error");
        if (agregar) {
            errores[fieldName] = true;
        } else {
            delete errores[fieldName];
        }
    }


});

function opcionSeleccionada(){
    var select=document.getElementById("id_tipo_pago");
    var opcionSeleccionada=select.value;
    // Realiza la acción deseada según la opción seleccionada
    switch(opcionSeleccionada){
        case "1":
            $("#porcentaje_salario_adelanto").prop("disabled", false);
            $("#porcentaje_salario_adelanto").val("50.00")
            $("#cargas_sociales").removeClass("d-none");
            break;
        case "2":
            $("#porcentaje_salario_adelanto").prop("disabled", true);
            $("#porcentaje_salario_adelanto").val("0");
            $("#cargas_sociales").addClass("d-none");
            break;
        default:
            $("#porcentaje_salario_adelanto").prop("disabled", false);
            $("#porcentaje_salario_adelanto").val("50.00")
            $("#cargas_sociales").addClass("d-none");
            break;
    }
}

