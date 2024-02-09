(function(){
    $(document).off('click.tabLoader').on('click.tabLoader', 'li>a[data-load]:not(.loaded)', function (event) {
        var target = $(this).data("load");
        if (target.length > 0) {
            waitingDialog.show();
            $.ajax({
                url: target, // Usa la función url() de Laravel para generar la URL completa
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
                },
                success: function () {
                    window.location.href = target;
                },
                error: function () {
                    window.location.href = target;
                }
            });
        }
    });
})();

(function(){
    $(document).off('click.tabLoader').on('click.tabLoader','.nav-tabs li>a[data-load]:not(.loaded)', function (event) {
        var btn=$(this);
        var target=$($(this).attr('href'));
        if(target.length>0) {
            waitingDialog.loading(target);
            $.ajax({
                url: $(this).data('load'),
                method: 'get',
                global:false,
                success: function (data) {
                    if (typeof data === 'string') {
                        btn.addClass('loaded');
                        target.html(data);
                        // $.UIRefresh(1);
                    } else if(typeof data==='object') {
                        if (typeof data.html === 'string') {
                            btn.addClass('loaded');
                            target.html(data.html);
                            // $.UIRefresh(1);
                        } else {
                            target.html('');
                            if(typeof data.alert==='string'){
                                target.append_alert(data.alert, 'info');
                            }else{
                                target.append_alert('Respuesta inesperada', 'error')
                            }
                        }
                    }
                },
                error: function () {
                    target.html('');
                    target.append_alert('Error al realizar la solicitud', 'error')
                }
            });
        }
    });
})();

(function() {
    $(document).off('change.jscolor').on('change.jscolor', '.jscolor', function (event) {
        if (this.jscolor && typeof this.jscolor === 'object') {
            this.jscolor.fromString(this.value);
        }
    });
    $.extend($.fn.intlTelInput.defaults,{
        preferredCountries:['cr'],
        separateDialCode:true,
    });
    jQuery.validator.addMethod("intlTelInput", function(value, element) {
        var plugin=$(element).data('plugin_intlTelInput');
        if(typeof plugin==='object' && typeof plugin.isValidNumber==='function'){
            return (plugin.isValidNumber() && String(value).match(/^\d*$/));
        }
        return false;
    }, "N&uacute;mero de tel&eacute;fono inv&aacute;lido");

    jQuery.validator.setDefaults({
        errorElement: 'div',
        errorClass: 'help-block',
        ignore: ":disabled,:disabled *",
        highlight: function (e) {
            $(e).closest('.form-group').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');
            $(e).remove();
        },
    });
})();

(function(){
    // Stops event focusin.bs.modal (Modal Bootstrap)
    $(document).off('focusin.swal_over_modal').on('focusin.swal_over_modal', '.swal2-modal', function (event) {
        event.stopPropagation();
    });

    /**
     * Configuración por defecto para los CD_BAR
     * @type {{size: number, timeKeeper: number, opacity: number, onFinish: string, fillLength: boolean}}
     * @private
     */
    var _default_cd_bar = {
        timeKeeper: 25000,
        fillLength: true,
        opacity: 0.5,
        size: 11,
        onFinish: 'click'
    };

    /**
     * @param {string} title
     * @param {string} msg
     * @param {string} type
     * @param {function|null} fn_ok
     * @param {function|null} fn_cancel
     * @param {string|object|null} cd_bar
     * @returns {Promise}
     */
    confirmar = function (title, msg, type, fn_ok, fn_cancel, cd_bar = null) {
        var _cfg_cd_bar = null;
        if (typeof cd_bar === "string" && ["OK", "CANCEL"].includes(cd_bar.toUpperCase())) {
            _cfg_cd_bar = $.extend({}, _default_cd_bar, {
                BTN_SWAL: cd_bar
            });
        } else if (typeof cd_bar === "object" && cd_bar) {
            _cfg_cd_bar = $.extend({}, {
                BTN_SWAL: 'OK'
            }, _default_cd_bar, cd_bar);
        }

        return Swal.fire({
            title: title,
            html: msg,
            icon: type,
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            confirmButtonColor: '#007bff', // Cambia el color del botón confirmar
            cancelButtonColor: '#dc3545', // Cambia el color del botón cancelar
            allowOutsideClick: false,
            didOpen: function () {
                if (typeof _cfg_cd_bar === "object" && _cfg_cd_bar) {
                    var btn_cd_bar = Swal.getConfirmButton();
                    var btn_cancel = Swal.getCancelButton();
                    if (typeof _cfg_cd_bar.BTN_SWAL == "string" && _cfg_cd_bar.BTN_SWAL.toUpperCase() === 'CANCEL') {
                        btn_cd_bar = Swal.getCancelButton();
                        btn_cancel = Swal.getConfirmButton();
                    }
                    var div = $('<div>');
                    $(Swal.getContent()).append(div);
                    var cd_bar_object = div.cd_bar($.extend({}, _cfg_cd_bar, {
                        target: btn_cd_bar,
                    }));
                    btn_cd_bar.add(btn_cancel).click(function () {
                        cd_bar_object.cancel();
                    });
                }
            }
        }).then(
            function (result) {
                if (result.isConfirmed && typeof fn_ok === "function") {
                    fn_ok();
                } else if (result.dismiss === Swal.DismissReason.cancel && typeof fn_cancel === "function") {
                    fn_cancel();
                }
            }
        );
    };

    /**
     * @param { String } type
     * @param { String } text
     * @param { function|null } fn_ok
     * @param { boolean } close_esc
     * @param { String|Object|null } cd_bar
     * @param { String|null } confirmButtonText
     * @returns {Promise}
     */
    mensaje_swal = function (type, text, fn_ok = null, close_esc = true, cd_bar = null, confirmButtonText = "OK") {
        var _cfg_cd_bar = null;
        if (typeof cd_bar === "string" && cd_bar.toUpperCase() === 'OK') {
            _cfg_cd_bar = $.extend({}, _default_cd_bar);
        } else if (typeof cd_bar === "object" && cd_bar) {
            _cfg_cd_bar = $.extend({}, _default_cd_bar, cd_bar);
        }
        var title_default = (typeof text !== 'string' || text.trim() == '');

        switch (type) {
            case 'error':
                if (title_default) {
                    text = 'Se ha presentado un error!<br/>Por favor, reintente.';
                }
                var opt = {
                    'icon': 'error',
                    'title': 'Error!',
                    'html': text,
                    'confirmButtonText': confirmButtonText
                };
                break;
            case 'warning':
                if (title_default) {
                    text = 'Se ha presentado una alerta!<br/>Por favor, verifique.';
                }
                var opt = {
                    'icon': 'warning',
                    'title': 'Alerta!',
                    'html': text,
                    'confirmButtonText': confirmButtonText
                };
                break;
            case 'success':
                if (title_default) {
                    text = 'Se ha procesado correctamente la solicitud!';
                }
                var opt = {
                    'icon': 'success',
                    'title': '&Eacute;xito!',
                    'html': text,
                    'confirmButtonText': confirmButtonText
                };
                break;
            case 'info':
                if (title_default) {
                    return Promise.resolve();
                }
                var opt = {
                    'icon': 'info',
                    'title': '',
                    'html': text,
                    'confirmButtonText': confirmButtonText
                };
                break;
            default:
                if (title_default) {
                    return Promise.resolve();
                }
                var opt = {
                    'icon': 'info',
                    'title': '',
                    'html': text,
                    'confirmButtonText': confirmButtonText
                };
                break;
        }

        return Swal.fire({
            icon: opt['icon'],
            title: opt['title'],
            html: opt['html'],
            allowOutsideClick: false,
            allowEscapeKey: (close_esc !== false),
            confirmButtonText: opt['confirmButtonText'],
            confirmButtonColor: '#3e89e4', // Cambia el color del botón confirmar
            didOpen: function () {
                if (typeof _cfg_cd_bar === "object" && _cfg_cd_bar) {
                    var btn_cd_bar = Swal.getConfirmButton();
                    var div = $('<div>');
                    $(Swal.getContent()).append(div);
                    var cd_bar_object = div.cd_bar($.extend({}, _cfg_cd_bar, {
                        target: btn_cd_bar,
                    }));
                    btn_cd_bar.click(function () {
                        cd_bar_object.cancel();
                    });
                }
            }
        }).then(function (result) {
            if (typeof fn_ok === "function" && result.isConfirmed) {
                fn_ok();
            }
        });
    };


    var input; // Declarar input fuera de la función para que tenga un alcance global

    confirmar_frase = function(title, msg, word, fn_ok, fn_cancel, close_esc) {
        var html = '';
        var t = title;
        if (typeof t !== 'string' || String(t).trim() == '') {
            t = 'Confirmar Solicitud';
        }
        if (typeof msg === 'string' && String(msg).trim() != '') {
            html += '<p>' + msg + '</p>';
        }
        html += '<p>Escriba la frase "<b class="text-uppercase">' + word + '</b>" para confirmar la solicitud.</p>' +
            '<div class="inline input-group input-group-lg"><input type="text" id="input_confirm_word" class="form-control text-center text-uppercase" autocomplete="off"></div>';

        return Swal.fire({
            title: t,
            html: html,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-default',
            allowOutsideClick: false,
            showCloseButton: false,
            allowEscapeKey: false,
            customClass: {
                input: 'form-control'
            },
            preConfirm: () => {
                const inputValue = document.getElementById('input_confirm_word').value;
                if (String(word).toLowerCase() !== String(inputValue).toLowerCase()) {
                    Swal.showValidationMessage('La frase ingresada no coincide.');
                }
            }
        }).then((result) => {
            input = document.getElementById('input_confirm_word'); // Inicializar input aquí
            if (result.isConfirmed && String(word).toLowerCase() === String(input.value).toLowerCase()) {
                if (typeof fn_ok === 'function') {
                    fn_ok(input.value, result);
                }
            } else if (result.dismiss === Swal.DismissReason.cancel && typeof fn_cancel === 'function') {
                fn_cancel(result.dismiss);
            }
        });
    };

    confirmar_input=function(title, msg, input_type, value_init, fn_ok, fn_cancel, fn_alter_input, hideIcon){
        var html=$('<div>');
        var input;
        var extras=$();
        var btn_confirm;
        var t=title;
        var config_i={};
        var tag_input='<input>';
        var config_input={
            type:"text",
            class:"form-control",
        };
        var option_list=[];
        if(value_init && typeof value_init==='object'){
            if(Array.isArray(value_init)){
                option_list=value_init;
                value_init=null;
            }
            else{
                if(Array.isArray(value_init['options'])){
                    option_list=value_init['options'];
                    delete value_init['options'];
                }
                $.extend(config_i,value_init);
                value_init=value_init['value'];
            }
        }
        if (typeof t !== 'string' || String(t).trim()==''){
            t = '';
        }
        if(typeof msg==='string' && String(msg).trim()!=''){
            html.append($('<p>', {html: msg}));
        }
        if(input_type=='textarea'){
            tag_input='<textarea>';
            config_input={
                class:"form-control",
                style:"resize: none; height: initial;",
                rows:4,
            };
        }
        else if(input_type=='select'){
            tag_input='<select>';
            config_input={
                class:"form-control",
            };
        }
        else if(input_type=='buttons'){
            tag_input='<input>';
            config_input={
                type:"text",
                class:"form-control",
                style: "display: none;",
            };
        }
        else if(input_type=='number'){
            tag_input='<input>';
            config_input={
                type:"number",
                class:"form-control",
            };
        }
        else if(input_type=='date'){
            tag_input = '<input>';
            config_input = {
                type: "text",
                class: "form-control",
                value: getCurrentDateFormatted(),
            };
        }
        else if(input_type=='daterange'){
            tag_input='<input>';
            config_input={
                type:"text",
                class:"form-control add-daterangepicker",
            };
        }
        else if(input_type=='dateRelative'){
            tag_input='<input>';
            config_input={
                type:"text",
                class:"add-dateRelative",
                'data-auto-submit': 1,
            };
        }
        else if(input_type=='datetimeRelative'){
            tag_input='<input>';
            config_input={
                type:"text",
                class:"add-datetimeRelative",
                'data-auto-submit': 1,
            };
        }
        else{
            input_type='text';
        }
        if(typeof config_i.style!=='undefined' && typeof config_input.style==='string'){
            config_i.style=config_input.style+'; '+config_i.style;
        }
        if(typeof config_i.type!=='undefined' && typeof config_input.type==='string'){
            config_i.type=config_input.type;
        }
        html.append('<div class="form-group"><div id="input_confirm_container" style="margin: auto;"></div></div>');
        if(input_type!='buttons'){
            html.find('#input_confirm_container').addClass('input-group input-group-lg').css({width:'75%'});
        }
        input=$(tag_input,$.extend({},config_input,config_i,{id:"input_confirm",})).addClass(config_input.class).attr('autocomplete','off');
        if(option_list.length>0){
            if(input_type=='text'){
                if(config_i.dropdown){
                    var dropdown=$('<div class="input-group-btn dropdown">'+
                        '<button class="btn btn-default btn-white" type="button" data-toggle="dropdown"><span class="caret"></span></button>'+
                        '<ul class="dropdown-menu"></ul>'+
                        '</div>');
                    var dropdownMenu=dropdown.find('.dropdown-menu');
                    dropdownMenu.on('click.apply_value', 'li:not(.disabled)>a[value]', function(event){
                        input.val($(this).attr('value'));
                        input.change();
                        input.focus();
                    });
                    $.each(option_list, function(i, e){
                        if(typeof e!=='object'){
                            e={
                                text: e,
                                value: e
                            };
                        }
                        $('<li>').append($('<a>', $.extend({value: ''}, e, {
                            href: 'javascript:void(0)',
                            tabindex: 0,
                        })).css({'white-space': 'normal'})).appendTo(dropdownMenu);
                    });
                    extras=extras.add(dropdown);
                }
                else{
                    var data_list=$('<datalist>', {
                        id: 'confirm_input_option_list',
                        class: 'data-list',
                    });
                    input.attr('list', 'confirm_input_option_list');
                    $.each(option_list, function(i, e){
                        if(typeof e!=='object'){
                            e={
                                text: e,
                                value: e
                            };
                        }
                        $('<option>', $.extend({}, e)).appendTo(data_list);
                    });
                    extras=extras.add(data_list);
                }
            }
            else if(input_type=='select'){
                $.each(option_list, function(i, e){
                    if(typeof e!=='object'){
                        e={
                            text: e,
                            value: e
                        };
                    }
                    $('<option>', $.extend({}, e)).appendTo(input);
                });
            }
            else if(input_type=='buttons'){
                var button_list=$('<div class="button-list">');
                button_list.on('click.apply_value', 'button[value]', function(event){
                    input.val($(this).val());
                    input.change();
                    if(!btn_confirm.prop('disabled')){
                        btn_confirm.click();
                    }
                });
                $.each(option_list, function(i, e){
                    if(typeof e!=='object'){
                        e={
                            text: e,
                            value: e
                        };
                    }
                    $('<button>', $.extend({}, e)).addClass('btn btn-primary swal2-styled').appendTo(button_list);
                });
                extras=extras.add(button_list);
            }
        }
        var confirmButton=(input_type!=='buttons');
        html=html.prop('outerHTML');
        var prom=Swal.fire({
            title: t,
            html: html,
            icon: (hideIcon?'':'question'),
            showCancelButton: true,
            showConfirmButton: confirmButton,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-default',
            },
            allowOutsideClick: false,
            showCloseButton: false,
            allowEscapeKey: false,
            didOpen:function(dialog){
                dialog=$(dialog);
                btn_confirm=$(Swal.getConfirmButton());
                var input_container=dialog.find('#input_confirm_container');
                input_container.empty();
                input_container.prepend(input);
                input_container.append(extras);
                if(typeof fn_alter_input==='function'){
                    input.each(function(i, e){
                        fn_alter_input.apply(e, [i, e]);
                    });
                }
                input.on('change input', function(event){
                    if(input.is(':valid')){
                        btn_confirm.prop('disabled', null);
                    }
                    else{
                        btn_confirm.prop('disabled', 'disabled');
                    }
                });
                if (input_type == 'date') {
                    // Initialize datepicker here
                    input.datepicker({
                        autoclose: true,
                        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        today: "Hoy",
                        monthsTitle: "Meses",
                        clear: "Borrar",
                        weekStart: 1,
                        format: "dd/mm/yyyy",
                        language: 'es'
                    });
                }
                if(typeof value_init==='string' || typeof value_init==='number' || Array.isArray(value_init)){
                    input.val(value_init);
                }

                input.change();
            },
        }).then(
            function (result) {
                if (result.isConfirmed && typeof fn_ok === "function") {
                    fn_ok.apply(input, [input.val(), result]);
                } else if (result.dismiss === Swal.DismissReason.cancel && typeof fn_cancel === "function") {
                    var closeDialog = fn_cancel.apply(input, [result.dismiss]);

                    if (closeDialog) {
                        // Cierra la ventana modal solo si fn_cancel devuelve true
                        Swal.fire.close();
                    }
                }
            }
        );
        return prom;
    };

})();

(function(){
    // FIX: Abrir múltiples modals
    $(document).on('hidden.bs.modal', '.modal', function () {
        if($('.modal:visible').length>0) {
            $('body').addClass('modal-open');
        }
    });
})();

(function() {
    var defaults={
        // 'html_close':'<span aria-hidden="true">&times;</span>',
        'html_close':'<i class="fa fa-times"></i>',
    };
    var tipos_alerta = {
        'info': 'alert-info',
        'question': 'alert-info',
        'error': 'alert-danger',
        'warning': 'alert-warning',
        'success': 'alert-success',
        'info-o': 'alert-info',
        'question-o': 'alert-info',
        'error-o': 'alert-danger',
        'warning-o': 'alert-warning',
        'success-o': 'alert-success',
        'default': 'alert-info',
    };
    var tipos_icono = {
        'info': 'fa fa-info-circle',
        'question': 'fa fa-question-circle',
        'error': 'fa fa-minus-circle',
        'warning': 'fa fa-exclamation-triangle',
        'success': 'fa fa-check-circle',
    };
    /**
     * Genera una alerta HTML
     * @param {string} texto Texto o HTML de la alerta
     * @param {string} type Opcional. Tipo de alerta. Posibles valores:<ul>
     *     <li>info: Azul con icono</li>
     *     <li>question: Azul con icono</li>
     *     <li>error: Rojo con icono</li>
     *     <li>warning: Amarillo con icono</li>
     *     <li>success: Verde con icono</li>
     *     <li>info-o: Azul sin icono</li>
     *     <li>question-o: Azul sin icono</li>
     *     <li>error-o: Rojo sin icono</li>
     *     <li>warning-o: Amarillo sin icono</li>
     *     <li>success-o: Verde sin icono</li>
     *     <li>default: Este es el valor por defecto. Igual que 'info-o'</li>
     * </ul>
     * @param {boolean} close Si es diferente a FALSE, agrega un boton de cerrado a la alerta
     * @param {function} onClose Se ejecuta al cerrar la alerta
     * @returns {jQuery} Devuelve el nodo de la nueva alerta
     */
    $.make_alert = function (texto, type, close, onClose) {
        var alert = $('<div class="alert"></div>');
        if (!tipos_alerta[type]) type='default';
        alert.addClass(tipos_alerta[type]);
        if (typeof onClose === 'function') {
            alert.on('closed.bs.alert', onClose);
        }
        if (close !== false) {
            var closeBtn = $('<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>');
            closeBtn.html(defaults.html_close);
            alert.addClass('alert-dismissable');
            alert.append(closeBtn);
        }
        if (tipos_icono[type]) {
            alert.append('<div style="float: left;"><span class="'+tipos_icono[type]+'"></span>&nbsp;</div>');
        }
        alert.append($('<div class="clearfix"></div>').append(texto));
        alert.alert();
        return alert;
    };
    $.make_alert.defaults=defaults;
    /**
     * Crea una alerta con <code>$.make_alert()</code> y la agrega al final nodo seleccionado
     * @see $.make_alert
     * @param texto
     * @param type
     * @param close
     * @param onClose
     * @param showSpeed Si se indica, el alert se mostrará esta velocidad. Ver <code>jQuery.show</code>
     * @returns {*}
     */
    $.fn.append_alert = function (texto, type, close, onClose, showSpeed) {
        "use strict";
        if (!this) return $();
        var alert=$.make_alert(texto,type,close,onClose).hide();
        alert.appendTo(this);
        return alert.show(showSpeed);
    };
    /**
     * Crea una alerta con <code>$.make_alert()</code> y la agrega al inicio del nodo seleccionado
     * @see $.make_alert
     * @param texto
     * @param type
     * @param close
     * @param onClose
     * @param showSpeed Si se indica, el alert se mostrará esta velocidad. Ver <code>jQuery.show</code>
     * @returns {*}
     */
    $.fn.prepend_alert = function (texto, type, close, onClose, showSpeed) {
        "use strict";
        if (!this) return $();
        var alert=$.make_alert(texto,type,close,onClose).hide();
        alert.prependTo(this);
        return alert.show(showSpeed);
    };
    /**
     * Crea una alerta con <code>$.make_alert()</code> y la agrega antes del nodo seleccionado
     * @see $.make_alert
     * @param texto
     * @param type
     * @param close
     * @param onClose
     * @param showSpeed Si se indica, el alert se mostrará esta velocidad. Ver <code>jQuery.show</code>
     * @returns {*}
     */
    $.fn.insertBefore_alert = function (texto, type, close, onClose, showSpeed) {
        "use strict";
        if (!this) return $();
        var alert=$.make_alert(texto,type,close,onClose).hide();
        alert.insertBefore(this);
        return alert.show(showSpeed);
    };

    /**
     * Crea una alerta con <code>$.make_alert()</code> y la agrega después del nodo seleccionado
     * @see $.make_alert
     * @param texto
     * @param type
     * @param close
     * @param onClose
     * @param showSpeed Si se indica, el alert se mostrará esta velocidad. Ver <code>jQuery.show</code>
     * @returns {*}
     */
    $.fn.insertAfter_alert = function (texto, type, close, onClose, showSpeed) {
        "use strict";
        if (!this) return $();
        var alert=$.make_alert(texto,type,close,onClose).hide();
        alert.insertAfter(this);
        return alert.show(showSpeed);
    };
})();

function getCurrentDateFormatted() {
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1; // Months are zero-based
    var year = currentDate.getFullYear();

    // Format the date as 'dd/mm/yyyy'
    var formattedDate = (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month + '/' + year;

    return formattedDate;
}
