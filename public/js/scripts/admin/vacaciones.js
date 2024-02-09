$(document).ready(function(){

});

function ui_motivo_vacaciones(id_empresa='', id_colaborador='', Nombre=''){
    var resultado = obtenerMesYAno();
    waitingDialog.show();
    $.ajax({
        url: base_path+'/ui_motivo_vacaciones', // Ruta en tu controlador de Laravel para obtener el contenido del modal
        type: 'GET',
        global:false,
        success: function(response){
            var dialog_documentos_digitales = bootbox.dialog({
                title: "Razón de las vacaciones " + resultado.nombreMes + " de " + resultado.ano+" ("+Nombre+")",
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-secondary",
                    },
                    guardar: {
                        label: "<i class='fa fa-save'></i>&nbsp;Guardar",
                        className: "btn btn-light-primary",
                        callback: function(){
                            // if($(form).valid()){
                            //     // dialog_documentos_digitales.crear_vacaciones(id, '');
                            // }
                            return false;
                        }
                    }
                },
            });
            dialog_documentos_digitales.init(function(){
                dialog_documentos_digitales.attr("id", "global_bootbox_documento_digitales");
                dialog_documentos_digitales.find('.modal-dialog').css({
                    width: '50%',
                });
                dialog_documentos_digitales.on('shown.bs.modal', function () {
                    // Inicializar AmsifySuggestags después de que el modal se ha mostrado completamente
                    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                        editable:true,
                        selectable: true,
                        themeSystem: 'bootstrap',
                        locale:'es',
                        headerToolbar: {
                            start: 'prev,next',
                            center: 'title',
                            end: 'dayGridMonth'
                        },
                        dateClick: function(info) {
                            confirmar_input('Vacaciones','Seleccione un motivo para registro de vacaciones','select',{
                                options:[
                                    'Seleccione una opción',
                                    'Enfermedad',
                                    'Maternidad',
                                    'Tramite',
                                    'Medio día'
                                ],
                                required: 'required',
                            }    ,function(val){
                                console.log(val);
                            });
                        },
                        select: function(info) {
                            confirmar_input('Vacaciones','Seleccione un motivo para registro de vacaciones','select',{
                                options:[
                                    'Seleccione una opción',
                                    'Enfermedad',
                                    'Maternidad',
                                    'Tramite',
                                    'Medio día'
                                ],
                                required: 'required',
                            }    ,function(val){
                                console.log(val);
                            });
                            // alert('selected ' + info.startStr + ' to ' + info.endStr);
                        },
                        events: [
                            {
                                start: '2023-12-11',
                                end: '2023-12-11',
                                title:'MD',
                            },
                            {
                                start: '2023-12-13',
                                end: '2023-12-13',
                                title:'E',
                            },
                            {
                                start: '2023-12-25',
                                end: '2023-12-28',
                                title:'Vacaciones',
                            },
                            {
                                start: '2023-12-06',
                                end: '2023-12-08',
                                title:'Vacaciones',
                            }
                        ]

                    });
                    calendar.render();
                });
            });
            var form = dialog_documentos_digitales.find('form#frm-documentos-digitales');
            dialog_documentos_digitales.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}

function ui_calendario_vacaciones(id_empresa='', id_colaborador='', Nombre=''){
    waitingDialog.show();
    $.ajax({
        url: base_path+'/ui_calendario_vacaciones', // Ruta en tu controlador de Laravel para obtener el contenido del modal
        type: 'GET',
        global:false,
        success: function(response){
            var dialog_documentos_digitales = bootbox.dialog({
                title: "Calendario vacaciones de ("+Nombre+")",
                message: response.html,
                size : "lg",
                buttons: {
                    cancel: {
                        label: "<i class='fa fa-times'></i>&nbsp;Cerrar",
                        className: "btn btn-light-secondary",
                    },
                    guardar: {
                        label: "<i class='fa fa-save'></i>&nbsp;Guardar",
                        className: "btn btn-light-primary",
                        callback: function(){
                            // if($(form).valid()){
                            //     // dialog_documentos_digitales.crear_vacaciones(id, '');
                            // }
                            return false;
                        }
                    }
                },
            });
            dialog_documentos_digitales.init(function(){
                dialog_documentos_digitales.attr("id", "global_bootbox_documento_digitales");
                dialog_documentos_digitales.find('.modal-dialog').css({
                    width: '50%',
                });
                dialog_documentos_digitales.on('shown.bs.modal', function () {
                    // Inicializar AmsifySuggestags después de que el modal se ha mostrado completamente
                    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                        editable:true,
                        selectable: true,
                        themeSystem: 'bootstrap',
                        locale:'es',
                        headerToolbar: {
                            start: 'prev,next',
                            center: 'title',
                            end: 'dayGridMonth'
                        },
                        dateClick: function(info) {
                            confirmar_input('Vacaciones','Seleccione un motivo para registro de vacaciones','select',{
                                options:[
                                    'Seleccione una opción',
                                    'Enfermedad',
                                    'Maternidad',
                                    'Tramite',
                                    'Medio día'
                                ],
                                required: 'required',
                            }    ,function(val){
                                console.log(val);
                            });
                        },
                        select: function(info) {
                            confirmar_input('Vacaciones','Seleccione un motivo para registro de vacaciones','select',{
                                options:[
                                    'Seleccione una opción',
                                    'Enfermedad',
                                    'Maternidad',
                                    'Tramite',
                                    'Medio día'
                                ],
                                required: 'required',
                            }    ,function(val){
                                console.log(val);
                            });
                            // alert('selected ' + info.startStr + ' to ' + info.endStr);
                        },
                        events: [
                            {
                                start: '2023-12-11',
                                end: '2023-12-11',
                                title:'MD',
                            },
                            {
                                start: '2023-12-13',
                                end: '2023-12-13',
                                title:'E',
                            },
                            {
                                start: '2023-12-25',
                                end: '2023-12-28',
                                title:'Vacaciones',
                            },
                            {
                                start: '2023-12-06',
                                end: '2023-12-08',
                                title:'Vacaciones',
                            }
                        ]

                    });
                    calendar.render();
                });
            });
            var form = dialog_documentos_digitales.find('form#frm-documentos-digitales');
            dialog_documentos_digitales.modal('show');
        },complete:function(){
            waitingDialog.hide();
        }
    });
}

$.fn.crear_vacaciones=function(id='', cliente=''){
    var dialog_documentos_digitales=$(this);
    var form=dialog_documentos_digitales.find('#frm-documentos-digitales');
    //var data=form.serializeObject();
    form.submit();
    /*data.id_cliente=cliente;
    data.id_contacto=id;
    mensaje_swal('success','exito!',function(){
        dialog_documentos_digitales.modal('hide');
    });*/

};



