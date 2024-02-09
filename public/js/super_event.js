/**
 * Super Evento.
 * Establece eventos que se ejecutan en todas las ventanas/pestañas del mismo sitio en el mismo navegador
 * Autor: bramirez
 * Creado: 2023-11-05
 * Modificado: 2023-11-05
 */
(function () {
    if (typeof jQuery.super_event_ver !== 'undefined') {
        return false;
    }
    var main_event = 'storage';
    var event_prefix = '_SE-';
    var super_event_list_cfg = {};
    var sEvent = {
        super_event_ver: 'Ver 1.0',
    };
    sEvent.super_event_list = function (log) {
        "use strict";
        if(log) {
            console.log(super_event_list_cfg);
        }
        return Object.keys(super_event_list_cfg);
    };
    /**
     * Valida el nombre de un evento. Solo se aceptan letras (mayúsculas y minusculas), números, guión (-) y guion bajo (_)
     * @param {string} event_name
     * @returns {boolean}
     */
    sEvent.super_event_valid_name = function (event_name) {
        "use strict";
        if (typeof event_name !== 'string') {
            return false;
        }
        if (String(event_name).match(/^[a-zA-Z0-9\_\-]+$/gi)) {
            return true;
        }
        return false;
    };
    /**
     * Detiene el escuchado del evento
     * @param {string} event_name
     * @returns {boolean|null}
     */
    sEvent.super_event_stop = function (event_name) {
        "use strict";
        if (!sEvent.super_event_valid_name(event_name)) return null;
        if (typeof super_event_list_cfg[event_name] === 'object') {
            delete super_event_list_cfg[event_name];
        }
        $(window).unbind(main_event + '.' + event_prefix + event_name);
        return true;
    };
    /**
     * Inicia el escuchado del evento
     * @param {string} event_name
     * @param {function} fn Función que se ejecutará cuando se reciba el evento.
     * Recibe tres parámetros: el valor del evento (value), el objeto del evento (event), y el nombre del evento (event_name)
     * @returns {boolean|null} Devuelve FALSE, si el nombre del evento es invalido o no se recibe una función para ejecutar con el evento.
     * Devuelve TRUE, si se inició la escucha del evento
     * Devuelve NULL, si ya se está escuchando el evento con ese nombre.
     */
    sEvent.super_event_start = function (event_name, fn) {
        "use strict";
        if (!sEvent.super_event_valid_name(event_name) || (typeof fn !== 'function')) {
            return false;
        }
        if (typeof super_event_list_cfg[event_name] === 'object') {
            return null;
        }
        var event_cfg = {};
        var full_name = event_prefix + event_name;
        event_cfg['fn'] = fn;
        super_event_list_cfg[event_name] = event_cfg;
        $(window).bind(main_event + '.' + full_name, function (e) {
            if (e.originalEvent.key === full_name && typeof e.originalEvent.newValue==='string') {
                event_cfg['fn'](e.originalEvent.newValue, e.originalEvent, event_name);
            }
        });
        return true;
    };
    /**
     * Envía el evento a las demás ventanas del sitio.
     * @param {string} event_name
     * @param {string} value Valor a enviar
     * @param {boolean} clean Si es TRUE o no se especifica, limpia el valor del evento después de enviarlo
     * @returns {boolean}
     */
    sEvent.super_event_send = function (event_name, value, clean) {
        "use strict";
        if (!sEvent.super_event_clean(event_name)) {
            return false;
        }
        window.localStorage[event_prefix + event_name] = value;
        if(clean || typeof clean==='undefined'){
            sEvent.super_event_clean(event_name);
        }
        return true;
    };
    /**
     * Obtiene el último valor del evento
     * @param {string} event_name
     * @returns {string|null|boolean} Devuelve el último valor del evento.
     * Si es FALSE, el nombre del evento es inválido.
     * Si es NULL, el último valor del evento esta vacío.
     */
    sEvent.super_event_get = function (event_name) {
        if (!sEvent.super_event_valid_name(event_name)) {
            return false;
        }
        return window.localStorage[event_prefix + event_name];
    };
    /**
     * Limpia el ultimo evento con el nombre correspondiente.
     * @param {string} event_name
     * @returns {boolean}
     */
    sEvent.super_event_clean = function (event_name) {
        "use strict";
        if (!sEvent.super_event_valid_name(event_name)) {
            return false;
        }
        delete window.localStorage[event_prefix + event_name];
        return true;
    };
    jQuery.extend(sEvent);
})();
