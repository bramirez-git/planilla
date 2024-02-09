(function() {
    var wLogin=null;
    var intLogin=null;
    var logLogin=function(){};
    var start_thread=function(log){
        if(log) {
            logLogin = function(){
                console.log.apply(null,arguments);
            };
        }else {
            logLogin = function(){};
        }
        stop_thread();
        if(wLogin) {
            intLogin = setInterval(fn_check, 500);
            logLogin('Interval iniciado');
            return true;
        }
        return false;
    };
    var stop_thread=function(){
        if(intLogin) {
            clearInterval(intLogin);
            intLogin = null;
            logLogin('Interval finalizado');
        }
    };
    var fn_check=function(){
        logLogin('Login check');
        try {
            if (wLogin.closed) {
                logLogin('wLogin cerrado');
                $.close_login();
            } else if (wLogin.document && wLogin.document.readyState === 'complete') {
                stop_thread();
                if(wLogin.location.origin !== window.location.origin || wLogin.location.pathname !== window.location.pathname) {
                    logLogin('wLogin URL diferente');
                    $.close_login();
                }else if($('#version_app',wLogin.document).length>0){
                    logLogin('wLogin logueado');
                    $.close_login();
                }else{
                    add_events();
                }
            }else{
                logLogin('wLogin Status: '+(wLogin.document?wLogin.document.readyState:'sin documento'));
            }
        }catch (e){
            logLogin('Error catch',e);
            $.close_login();
        }
    };
    var add_events=function(){
        $(wLogin).on('unload',function() {
            logLogin('wLogin event: unload');
            start_thread();
        });
        $(wLogin).on('error',function() {
            logLogin('wLogin event: error');
            $.close_login();
        });
    };
    $.open_login=function() {
        $.close_login();
        wLogin=window.open(location.pathname, 'inicio');
        wLogin.focus();
        waitingDialog.show();
        add_events();
    };
    $.close_login=function() {
        stop_thread();
        if(wLogin) {
            wLogin.close();
            wLogin = null;
            waitingDialog.hide();
        }
    };
    $(window).on('unload',function(){
        stop_thread();
        if(wLogin) {
            wLogin.close();
            wLogin = null;
        }
    });
})();


/**
 * Valida si hay una sesión abierta.
 * Si hay una sesión abierta, además, verifica los datos de la sesión.
 * @param {object} valid_datos Lista de datos de la sesión que se verificarán.<br/>
 * Los datos pueden ser:<br/>
 * <code>
 * {
 *  'empresa':'',
 *  'usuario':''
 *  'version_app':''
 * }</code><br>
 * Si el objeto actual (this) es un formulario, los datos se cargan de los inputs con prefijo 'sess_'. Ejemplo: name="sess_empresa"
 * @param {boolean} alert Default: FALSE. Si es TRUE, muestra mensajes de alerta al usuario
 * @param {object} opts Opciones avanzadas.<br/>
 * Los datos pueden ser:<br/>
 * <ul>
 *     <li>'on_invalid'</li>Evento. Función que se ejecuta si uno de los datos de la sesión es inválido.
 *     <li>'on_offline'</li>Evento. Función que se ejecuta si se perdió la conexión con el servidor.
 *     <li>'on_login'</li>Evento. Función que se ejecuta si no ha iniciado sesión.
 *     <li>'on_update'</li>Evento. Función que se ejecuta si el usuario está utilizando una aplicación desactualizada. Si no se define una función, siempre se muestra la alerta.
 * </ul>
 * Si los mensajes de alerta están habilitados, los eventos se ejecutan al cerrar el mensaje.
 * @returns {boolean} Devuelve TRUE si la sesión es válida. De lo contrario devuelve FALSE
 */
$.fn.validate_login = function (valid_datos, alert, opts){
    "use strict";
    var valid = false;
    var data={
        'empresa':'',
        'usuario':'',
        'version_app':''
    };
    Object.seal(data);
    if($(this).is('form')){
        var form=$(this);
        $.each(data,function(i,e){
            if(form.find('[name="sess_'+i+'"]').length){
                data[i]=form.find('[name="sess_'+i+'"]').val();
            }
        });
    }
    if(valid_datos && typeof valid_datos==='object') {
        $.extend(data, valid_datos);
    }
    data['version_app']=$('#version_app').data('version');
    var msj='<p>No se puede procesar la solicitud</p>';
    var post_msj='';
    opts=$.extend({},opts);
    $.ajax({
        url:base_path + "/verificarSesion",
        type: 'POST',
        data: data,
        async: false, //blocks window close
        global: false,
        success: function(resp,status,xhr) {
            sesion_check.report_last_ajax(xhr);
            var on_close=function(){};
            var login=function(){
                $.ajax({
                    method:'post',
                    global:false,
                    url:base_path + "/logout",
                });
                msj+='<p>Debe <a href="javascript:void(0)" onclick="fn_reload();">iniciar sesi&oacute;n</a> para continuar</p>';
                if(typeof opts.on_login==='function') {
                    on_close = opts.on_login;
                }
            };
            if (typeof resp !== 'object') {
                login();
            } else {
                if (resp.status==='logged') {
                    sesion_check.refresh_last_request();
                    valid=true;
                    return;
                } else if (resp.status==='login') {
                    login();
                } else {
                    if(typeof opts.on_invalid === 'function'){
                        on_close=opts.on_invalid;
                    }
                }
                $.each(resp.msj,function(i,e){
                    msj+='<p>'+e+'</p>';
                });
            }
            valid = false;
            if (alert) {
                mensaje_swal('error', msj+post_msj, function(){
                    fn_reload();
                });
            }else{
                on_close();
            }
        },
        error:function(xhr,status,err){
            var on_close=function(){};
            valid = false;
            if(xhr.status==0){
                msj += '<p>Fall&oacute; la conexi&oacute;n con el servidor</p>';
                if (typeof opts.on_offline === 'function') {
                    on_close = opts.on_offline;
                }
            }else{
                msj += '<p>Error de servidor (' + xhr.status + ')</p>';
            }
            if(alert){
                mensaje_swal('error',msj,on_close);
            }else{
                on_close();
            }
        }
    });
    return valid;
};

(function(){
    is_URL_same_script=function(url){
        var thisUrl=String(url).split(/[\?#]/)[0];
        if(thisUrl=='') return true;
        var baseURI=String(location.href).split(/[\?#]/)[0];
        if(thisUrl==baseURI) return true;
        var pathname=baseURI.replace(location.origin,'');
        if(thisUrl==pathname) return true;
        var pathfile=pathname.split('/').pop();
        if(thisUrl==pathfile) return true;
        return false;
    };
    // Actualización de la fecha y hora obtenida del servidor
    var super_event_name='set_servertime';
    var set_servertime=function(time){
        var newDate=moment(time);
        if(newDate.isValid()){
            SERVER_DATETIME_ISO=newDate.format();
            return true;
        }
        return false;
    };
    $(document).ajaxComplete(function(event, xhr, opt){
        if(xhr.getResponseHeader('date') && is_URL_same_script(opt.url)){
            if(set_servertime(xhr.getResponseHeader('date'))){
                $.super_event_send(super_event_name, SERVER_DATETIME_ISO);
            }
        }
    });
    $.super_event_start(super_event_name, function(value, event, event_name){
        "use strict";
        set_servertime(value);
    });
})();

(function(){
    var sesion_check=LocalWatcher('sess_time');
    window.sesion_check=sesion_check;
    if(!isFinite(parseInt(window.sesion_check_logout_t)) || window.sesion_check_logout_t<=0) {
        window.sesion_check_logout_t=420;
    }
    if(!isFinite(parseInt(window.sesion_check_alert_t)) || window.sesion_check_alert_t<=0) {
        window.sesion_check_alert_t=parseInt(config_tiempo_sesion)*60;
    }
    sesion_check['alert_t'] = parseInt(window.sesion_check_alert_t);
    sesion_check['logout_t'] = parseInt(window.sesion_check_logout_t);
    sesion_check['status']='';
    sesion_check.refresh_last_request=function(timeStamp) {
        if(parseInt(timeStamp)!==timeStamp){
            timeStamp=Date.now();
        }
        sesion_check.set_localValue(timeStamp);
    };
    sesion_check.report_last_ajax=function(xhr,url,timeStamp){
        var valid=true;
        if (typeof url !== 'undefined' && url !== null) {
            valid=is_URL_same_script(url);
        }
        if(valid){
            if(typeof xhr!=='object' || typeof xhr.getResponseHeader!=='function'){
                console.error('XHR invalido');
            }else if(xhr.getResponseHeader('admin-sess-update')) {
                sesion_check.refresh_last_request(timeStamp);
            }else{
                if(sesion_check.log)
                    console.log('Request no reportado');
            }
        } else {
            // console.error('URL no valida para ser reportada: '+url);
        }
    };
    $(document).ajaxComplete(function(event,xhr,opt){
        sesion_check.report_last_ajax(xhr,opt.url,event.timeStamp);
    });
    sesion_check['dialog_check_sess']=null;
    sesion_check['dialog_login_sess']=null;
    var close_check_sess=function(){
        if(sesion_check['dialog_check_sess']){
            $.close_login();
            sesion_check['dialog_check_sess'].modal('hide');
            sesion_check['dialog_check_sess']=null;
        }
    };
    var close_login_sess=function(){
        if(sesion_check['dialog_login_sess']){
            $.close_login();
            sesion_check['dialog_login_sess'].modal('hide');
            sesion_check['dialog_login_sess']=null;
        }
    };
    var coundown_to_time=function(seconds){
        var m=parseInt(seconds/60);
        var s=parseInt(seconds%60);
        var countdown_txt='';
        if(m>0){
            m=String(m);
            while(m.length<2){
                m='0'+m;
            }
            countdown_txt+=m+':';
        }
        s=String(s);
        while(s.length<2){
            s='0'+s;
        }
        countdown_txt+=s;
        return countdown_txt;
    };
    sesion_check.refresh_last_request();
    sesion_check.log=false;
    sesion_check.start(function(globalValue,localValue){
        if(globalValue!=localValue){
            if(!isFinite(parseInt(localValue))){
                localValue=0;
            }
            if(!isFinite(parseInt(globalValue))){
                globalValue=0;
            }
            if (localValue > globalValue) {
                localValue=Math.min(localValue, Date.now());
                this.set_globalValue(localValue);
                this.set_localValue(localValue);
                if(sesion_check.log)
                    console.log('Enviado '+localValue);
            } else {
                globalValue=Math.min(globalValue, Date.now());
                this.set_globalValue(globalValue);
                this.set_localValue(globalValue);
                if(sesion_check.log)
                    console.log('Recibido '+globalValue);
            }
        } else {
            var time_inactivo=parseInt((Date.now()-localValue)/1000);
            var logout_countdown=sesion_check['logout_t']-(time_inactivo-sesion_check['alert_t']);
            var status=null;
            if(logout_countdown<0) {
                status = 'logout_time';
            }else if(time_inactivo>=sesion_check['alert_t']){
                status='alert_time';
            }else{
                status='';
            }
            if(sesion_check['status']===status){
                if(status==='alert_time'){
                    if(logout_countdown>=0) {
                        $('#sess_time_coutdown').text(coundown_to_time(logout_countdown));
                    }
                }
                return;
            }
            sesion_check['status']=status;
            if (sesion_check['status'] === '') {
                close_check_sess();
                close_login_sess();
            } else if (sesion_check['status'] === 'alert_time') {
                close_check_sess();
                close_login_sess();
                sesion_check['dialog_check_sess']=bootbox.dialog({
                    title: '<span class="text-orange"><i class="fa fa-exclamation-triangle text-orange"></i>&nbsp;Tiempo de sesi&oacute;n</span>',
                    message: 'La sesi&oacute;n se cerrar&aacute; autom&aacute;ticamente en <strong><span id="sess_time_coutdown"></span></strong> segundos por inactividad.<br>' +
                        '&iquest;Desea continuar utilizando la sesi&oacute;n actual?',
                    buttons: {
                        ok: {
                            label: "<i class='fa fa-check'></i>&nbsp;Verificar y Continuar con la sesi&oacute;n actual",
                            className: "btn btn-light-primary",
                            callback: function() {
                                $().validate_login({},1);
                                return false;
                            }
                        }
                    },
                    closeButton: false
                }).off('shown.bs.modal');
            } else if (sesion_check['status'] === 'logout_time') {
                close_check_sess();
                close_login_sess();
                $.ajax({
                    method:'post',
                    global:false,
                    url:base_path + "/logout",
                });
                sesion_check['dialog_login_sess']=bootbox.dialog({
                    title: '<span class="text-danger"><i class="fa fa-exclamation-triangle text-danger"></i>&nbsp;Tiempo de sesi&oacute;n</span>',
                    message: 'La sesi&oacute;n ya caduc&oacute;.<br>' +
                        'Por favor, inicia sesión nuevamente.',
                    buttons: {
                        // button: {
                        //     label: "<i class='fa fa-unlock'></i>&nbsp;Cerrar sesi&oacute;n",
                        //     className: "btn btn-light-danger",
                        //     callback: function(){
                        //         waitingDialog.show();
                        //         window.location.href = base_path;
                        //         return false;
                        //     }
                        // },
                        ok: {
                            label: "<i class='fa-solid fa-rotate'></i>&nbsp;Iniciar sesi&oacute;n",
                            className: "btn btn-light-primary",
                            callback: function() {
                                waitingDialog.show();
                                window.location.href = base_path;
                                return false;
                            }
                        }
                    },
                    closeButton: false
                }).off('shown.bs.modal');
            }
        }
    },100);
})();




// SuperEvent: account_check
$(function(){
    if(typeof window.account_check==='object'){
        return;
    }
    var account_check={
        status: '',
        div: $('<div id="account_alert" class="clearfix text-center"></div>').insertAfter('#breadcrumbs'),
        localData: null,
        localJSON: null,
        log: false,
    };
    window.account_check=account_check;
    var account_check_name='account_check';
    account_check.reload=function(){
        confirmar('', '¿Desea recargar esta página?', 'question', function(){
            window.location.reload();
        });
    };
    account_check.dialog_alert=$();
    account_check.close_msg=function(){
        account_check.dialog_alert.modal('hide');
    };
    account_check.show_msg=function(){
        account_check.close_msg();
        var title='<i class="fa fa-exclamation-triangle"></i>&nbsp;Cambio en la sesión';
        var title_app='<i class="fa fa-exclamation-triangle"></i>&nbsp;Actualización del sitio';
        account_check.dialog_alert=bootbox.dialog({
            title: (account_check.status=='app'?title_app:title),
            message: (account_check.status=='app'?help_text_app:help_text),
            buttons: {
                "Cerrar": {
                    "label": "<i class='fa fa-times'></i>&nbsp;Cerrar",
                    "className": "btn btn-white btn-danger"
                },
            },
        }).off('shown.bs.modal');
    };
    account_check.close=function(){
        account_check.div.empty();
        account_check.close_msg();
    };
    account_check.open=function(){
        $(document).scrollTop(0);
        account_check.close();
        var title,recomendacion;
        if(account_check.status==='app'){
            title='La versión del sitio fue actualizada';
            recomendacion=account_check.recomendacion_app;
        }
        else if(account_check.status==='emp'){
            title='Se cambió la empresa de esta sesión';
            recomendacion=account_check.recomendacion;
        }else{
            return;
        }
        account_check.div.append_alert('<div><i class="fa fa-exclamation-triangle"></i> <b>'+title+'</b> <i class="fa fa-exclamation-triangle"></i></div>' +
            '<div>' + recomendacion + '</div>','error-o',false);
        account_check.show_msg();
    };
    var help_text='Al cambiar uno de los datos de la sesión, es posible que se consulten o registren datos de forma inconsistente.<br><br>' +
        'Por esta razón le recomendamos que recargue la página actual para que siga utilizándo el sistema de forma segura.<br><br>' +
        'En caso de querer conservar los avances del proceso actual o la información consultada, puede ir a otra ventana/pestaña para volver al estado anterior de la sesión.<br><br>' +
        'Por ejemplo: <i>Puede volver a cambiar a la empresa/sucursal/terminal que esta usando en esta ventana/prestaña, o bien, volver a iniciar sesión con el usuario que indica la interfaz, según sea el caso.</i>';
    var help_text_app='Al actualizar la versión del sitio, es posible que existan nuevas características, cambios en el comportamiento actual de la interfaz u otras mejoras que son imperceptibles.<br><br>' +
        'Por esta razón le solicitamos refrescar la página actual para que siga utilizándo el sistema de forma segura.';
    account_check.recomendacion='Le recomendamos <a href="javascript:void(0)" onclick="account_check.reload()">recargar</a> esta página. ' +
        '<span class="blue" role="button" onclick="account_check.show_msg(this)"><i class="fa fa-question-circle"></i></span>';
    account_check.recomendacion_app='Debe <a href="javascript:void(0)" onclick="account_check.reload()">refrescar</a> para continuar utilizando el sistema. ' +
        '<span class="blue" role="button" onclick="account_check.show_msg(this)"><i class="fa fa-question-circle"></i></span>';
    $.account_check=function(accountJSON){
        account_check.refresh_localData();
        if(!account_check.localData){
            if(account_check.log)
                console.log('Sin local Data');
            return false;
        }
        var status='';
        if(accountJSON!=account_check.localJSON || account_check.status!==status){
            var account=null;
            try{
                account=JSON.parse(accountJSON);
            }catch(e){
            }
            if(account && typeof account==='object'){
                if(account.app!=account_check.localData.app){
                    status='app';
                }
                else if(account.usr!=account_check.localData.usr){
                    status='usr';
                }
                else if(account.emp!=account_check.localData.emp){
                    status='emp';
                }
                if(account_check.status!==status){
                    account_check.status=status;
                    account_check.open();
                    if(account_check.log)
                        console.log('Nuevo status',status);
                }
                else{
                    if(account_check.log)
                        console.log('Sin cambio de status',status);
                }
            }
            else{
                if(account_check.log)
                    console.log('Sin datos válidos',account);
            }
        }
        else{
            if(account_check.log)
                console.log('Sin cambios');
        }
    };
    account_check.refresh_localData=function(forzarLectura){
        if(account_check.localData && !forzarLectura){
            return;
        }
        var data=account_check.normalizeData($('form#validate_login').serializeObject());
        account_check.localJSON=JSON.stringify(data);
        account_check.localData=data;
    };
    account_check.normalizeData=function(data){
        if(!data || typeof data!=='object'){
            return false;
        }
        var nData={};
        nData['app']=(data['app']?data['app']:data['app_version']);
        if((typeof nData['app']!=='string') && data['app_version']!=nData['app']){
            return false;
        }
        nData['usr']=parseInt(data['usr']?data['usr']:data['sess_usuario']);
        if(!is_numeric(nData['usr']) && data['sess_usuario']!=nData['usr']){
            return false;
        }
        nData['emp']=parseInt(data['emp']?data['emp']:data['sess_empresa']);
        if(!is_numeric(nData['emp']) && data['sess_empresa']!=nData['emp']){
            return false;
        }
        return nData;
    };
    account_check.report_account_data=function(data){
        var nData=account_check.normalizeData(data);
        if(!nData){
            if(account_check.log)
                console.log('Data no valida');
            return;
        }
        nData=JSON.stringify(nData);
        $.super_event_send(account_check_name,nData);
        $.account_check(nData);
    };
    account_check.report_last_ajax=function(xhr,url){
        var valid=true;
        if (typeof url !== 'undefined' && url !== null) {
            valid=is_URL_same_script(url);
        }
        if(valid){
            if(typeof xhr!=='object' || typeof xhr.getResponseHeader!=='function'){
                console.error('XHR invalido');
                return;
            }
            var data={
                'app_version': xhr.getResponseHeader('app_version'),
                'sess_empresa': xhr.getResponseHeader('sess_empresa'),
                'sess_usuario': xhr.getResponseHeader('sess_usuario'),
            };
            account_check.report_account_data(data);
        } else {
            console.error('URL no valida para ser reportada: '+url);
        }
    };
    account_check.refresh_localData(true);
    account_check.report_account_data($('form#validate_login').serializeObject());
    $.super_event_start(account_check_name, function(value, event, event_name){
        "use strict";
        $.account_check(value);
    });
    $(document).ajaxComplete(function(event,xhr,opt){
        account_check.report_last_ajax(xhr,opt.url);
    });
    $.ajaxSettings.headers=$.extend({},$.ajaxSettings.headers);
    $.each($('#validate_login').serializeObject(),function(i,e){
        $.ajaxSettings.headers[String(i).replace(/_/g,'-')]=e;
    });
});



