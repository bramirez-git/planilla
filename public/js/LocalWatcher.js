/**
 * LocalWatcher.
 * Establece hilos que detectan cambios en un valor especifico del localStorage.
 * Autor: bramirez
 * Creado: 2023-11-06
 * Modificado: 2023-11-06
 */
(function () {
    if(typeof window.LocalWatcher==='function'){
        throw new DOMException('LocalWatcher all ready exists');
    }
    var LocalWatcher=function(name){
        if(this.constructor!==LocalWatcher){
            return new LocalWatcher(name);
        }
        this.name=String(name);
        this.fn_watcher=function(){};
        this.freq=0;
        this.localValue=null;
        this.id_hilo=null;
    };
    window.LocalWatcher=LocalWatcher;
    LocalWatcher.set_globalValue=function(name,value){
        "use strict";
        window.localStorage[name]=value;
    };
    LocalWatcher.get_globalValue=function(name){
        "use strict";
        return window.localStorage[name];
    };
    LocalWatcher.prototype.set_localValue=function(value){
        "use strict";
        this.localValue=value;
    };
    LocalWatcher.prototype.get_localValue=function(){
        "use strict";
        return this.localValue;
    };
    LocalWatcher.prototype.set_globalValue=function(value){
        "use strict";
        LocalWatcher.set_globalValue(this.name,value);
    };
    LocalWatcher.prototype.get_globalValue=function(){
        "use strict";
        return LocalWatcher.get_globalValue(this.name);
    };
    LocalWatcher.prototype.is_alive=function(){
        "use strict";
        return (typeof this.id_hilo==='number');
    };
    LocalWatcher.prototype.stop=function(){
        "use strict";
        if(this.is_alive()){
            clearInterval(this.id_hilo);
            this.id_hilo=null;
            return true;
        }
        return false;
    };
    LocalWatcher.prototype.watchNow=function(){
        "use strict";
        this.fn_watcher(window.localStorage[this.name],this.localValue);
    };
    LocalWatcher.prototype.start=function(fn_watcher,freq){
        "use strict";
        if(this.is_alive()) return false;
        if(typeof fn_watcher==='function'){
            this.fn_watcher=fn_watcher.bind(this);
        }
        if(typeof freq==='number'){
            this.freq=freq;
        }
        var hilo=(function () {
            this.fn_watcher(window.localStorage[this.name],this.localValue);
        }).bind(this);
        this.id_hilo = setInterval(hilo, this.freq);
    };
})();