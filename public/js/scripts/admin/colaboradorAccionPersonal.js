$(function () {
    var descarga_accion_personal= $('#descarga_excel_colaborador_accion_personal');
    descarga_accion_personal.on('click', function (event) {
        event.preventDefault();
        waitingDialog.show()

        var id_colaborador = $('#id_colaborador').val();
        var datos = descarga_accion_personal.serialize();
        datos += "&id_colaborador=" + id_colaborador;

        $.ajax({
            type: 'POST',
            url: "/descarga_excel_colaborador_accion_personal",
            data: datos,
            success: function (response) {
                if (response.success) {
                    var link = document.createElement('a');
                    link.href = response.url;
                    link.download = 'Lista_de_INS.txt';
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

    $('#guardar').on('click', function (evt)
    {
        $('#confirmModal').modal('hide');
        $('#cargando').modal('show');
    });

    $('#frm-accionesPersonal').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            fechaAmonestacion: {
                required: function(element){
                    return $('#fechaAmonestacion').is(':visible');
                },
            },
            descripcion: {
                required: function(element){
                    return $('#descripcion').is(':visible');
                }
            },
            fechaSuspension: {
                required: function(element){
                    return $('#fechaSuspension').is(':visible');
                },
            },
            seleccionFechas: {
                required: function(element){
                    return $('#seleccionFechas').is(':visible');
                },
            },
            numeroBoleta: {
                required: function(element){
                    return $('#numeroBoleta').is(':visible');
                },
            },
            fechaInicial: {
                required: function(element){
                    return $('#fechaInicial').is(':visible');
                },
            },
            fechaFinal: {
                required: function(element){
                    return $('#fechaFinal').is(':visible');
                },
            },
            fechaRegimiento: {
                required: function(element){
                    return $('#fechaRegimiento').is(':visible');
                },
            },
            nuevoSalarioBase: {
                required: function(element){
                    return $('#nuevoSalarioBase').is(':visible');
                },
            },
            puesto: {
                required: function(element){
                    return $('#puesto').is(':visible');
                },
            },
            hora: {
                required: function(element){
                    return $('#hora').is(':visible');
                },
            },
            fechaSalida: {
                required: function(element){
                    return $('#fechaSalida').is(':visible');
                },
            },
            otrosRebajos: {
                required: function(element){
                    return $('#otrosRebajos').is(':visible');
                },
            },
            asociacionSolidarista: {
                required: function(element){
                    return $('#asociacionSolidarista').is(':visible');
                },
            },
            preaviso: {
                required: function(element){
                    return $('#preaviso').is(':visible');
                },
            },
            cesantia: {
                required: function(element){
                    return $('#cesantia').is(':visible');
                },
            },
            cantidadDias: {
                required: function(element){
                    return $('#cantidadDias').is(':visible');
                },
                max: function(element){
                    return $('#cantidadDias').is(':visible');
                },
            },
            /*porcentajePagarPermisos: {
                required: function(element){
                    return $('#porcentajePagarPermisos').is(':visible');
                },
                max:100
            }*/
        },

        messages: {
            fechaAmonestacion: {
                required: "Este campo es requerido."
            },
            descripcion: {
                required: "Este campo es requerido."
            },
            fechaSuspension: {
                required: "Este campo es requerido."
            },
            seleccionFechas: {
                required: "Este campo es requerido."
            },
            numeroBoleta: {
                required: "Este campo es requerido."
            },
            fechaInicial: {
                required: "Este campo es requerido."
            },
            fechaFinal: {
                required: "Este campo es requerido."
            },
            fechaRegimiento: {
                required: "Este campo es requerido."
            },
            nuevoSalarioBase: {
                required: "Este campo es requerido."
            },
            puesto: {
                required: "Este campo es requerido."
            },
            hora: {
                required: "Este campo es requerido."
            },
            fechaSalida: {
                required: "Este campo es requerido."
            },
            otrosRebajos: {
                required: "Este campo es requerido."
            },
            asociacionSolidarista: {
                required: "Este campo es requerido."
            },
            preaviso: {
                required: "Este campo es requerido."
            },
            cesantia: {
                required: "Este campo es requerido."
            },
            cantidadDias: {
                required: "Este campo es requerido.",
                max: "No dispone de la cantidad de dias de vacaciones que digitó."
            },
            /*porcentajePagarPermisos: {
                required: "Este campo es requerido.",
                max: "Por favor digite un valor menor o igual a 100."
            }*/
        },
        errorElement : 'span'
    });

    $("#registrar").on('click', function (evt)
    {
        if($('#frm-accionesPersonal').valid())
        {
            $('#confirmModal').modal('show');
        }
        else{
            return false;
        }
    });

    //Mostrar formularios

    //si existe el input
    if ($('#tipoAccion').length) {
        $('#tipoAccion').on('change', function (evt) {
            let accion = $('#tipoAccion').val();
            let id_colaborador = $('#id_colaborador').val();

            if (accion == "5-00005" || accion == "8-00008") {
                $('#previstaDiv').css("visibility", "hidden");
            } else {
                $('#previstaDiv').css("visibility", "visible");
            }

            $.ajax({
                type: 'POST',
                url: "/formularioAccionPersonal",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'accion': accion, 'id_colaborador': id_colaborador},
                success: (response) => {
                    $("#form-accionPersonal").empty().append(response);
                },
                error: function (response) {
                    alert(response.responseJSON.message);
                }
            });
        });

        let accion = $('#tipoAccion').val();
        let id_colaborador = $('#id_colaborador').val();

        $.ajax({
            type: 'POST',
            url: "/formularioAccionPersonal",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'accion': accion, 'id_colaborador': id_colaborador},
            success: (response) => {
                $("#form-accionPersonal").empty().append(response);
            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }
});

function modal_consulta_dias(id_colaborador, id_accion_personal, nombre_colaborador){
    waitingDialog.show();
    $.ajax({
        url: base_path+'/consulta_dias/',
        type: 'GET',
        data: {
            id_colaborador: id_colaborador,
            id_accion_personal: id_accion_personal
        },
        global:false,
        success: function(response){
            var dialog_documentos_digitales = bootbox.dialog({
                title: nombre_colaborador,
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-secondary",
                    },
                },
            });

            dialog_documentos_digitales.init(function(){
                dialog_documentos_digitales.attr("id", "global_bootbox_documento_digitales");
                dialog_documentos_digitales.find('.modal-dialog').css({
                    width: '35%', // O el valor que prefieras
                });
            });
            dialog_documentos_digitales.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}

