/**
 * jquery.serializeObject
 * Autor: bramirez
 * Creado: 2023-11-01
 * Modificado: 2023-11-01
 */
(function(){
	/**
	 * Normaliza el primer nombre de cada valor como se hace en un request nativo del navegador
	 */
	var normalizeFirstName=true;
	var regex_parts=/^([^\[]+)(\[(?:.|\n|\r)*\].*)$/;
	var regex_subparts=/^\[([^\]]*)\]((?:.|\n|\r)*)$/;
	var regex_valid_name=/^[^\[]/;
	/**
	 * Elimina todos los espacio/tab a la izquierda del string
	 * @param {string} str
	 * @returns {string}
	 */
	var ltrim=function(str){
		return String(str).replace(/^[ \t]+/, '');
	};
	/**
	 * Elimina solo el primer espacio/tab a la izquierda del string
	 * @param {string} str
	 * @returns {string}
	 */
	var ltrim_one=function(str){
		return String(str).replace(/^[ \t]/, '');
	};
	var next_id=function(obj){
		var k=0;
		if(typeof obj==='object'){
			if(Array.isArray(obj)){
				k=obj.length;
			}
			else{
				k=$.extend([], obj).length;
			}
		}
		return k;
	};
	var add_recursive=function(names, value, obj){
		if(!Array.isArray(names) || names.length==0) return false;
		var k=names.shift();
		if(ltrim_one(k)===''){
			k=next_id(obj);
		}
		if(names.length==0){
			obj[k]=value;
		}
		else{
			if(typeof obj[k]!=='object'){
				obj[k]=[];
			}
			add_recursive(names, value, obj[k]);
			if(Array.isArray(obj[k]) && obj[k].length!==Object.keys(obj[k]).length){
				obj[k]=$.extend({}, obj[k]);
			}
		}
		return true;
	};
	/**
	 * Convierte el nombre de un input en una lista de nombres como ruta del objeto
	 * @param name
	 * @returns {null|*[]}
	 */
	var nameToList=function(name){
		name=ltrim(name);
		if(!(name.match(regex_valid_name))) return null;
		var parts;
		var names=[];
		if(parts=name.match(regex_parts)){
			if(normalizeFirstName){
				parts[1]=parts[1].replace(/[ \[]/g, '_');
			}
			names.push(parts[1]);
			var subpart=parts[2];
			while(parts=subpart.match(regex_subparts)){
				names.push(parts[1]);
				subpart=parts[2];
			}
		}
		else{
			if(normalizeFirstName){
				// Se normaliza según el primer caracter en encontrarse (' ' o '[')
				if(parts=name.match(/([ \[])/)){
					if(parts[1]==' '){
						name=name.replace(/[ \[]/g, '_');
					}
					else if(parts[1]=='['){
						name=name.replace(/\[/g, '_');
					}
				}
			}
			names.push(name);
		}
		return names;
	};
	var add_form_item=function(name, value, obj){
		if(typeof name!=="string" || typeof value==="undefined"){
			return false;
		}
		var names=nameToList(name);
		if(!names) return false;
		add_recursive(names, value, obj);
		return true;
	};
	/**
	 * Transfiere los datos primitivos de un FormData a un objeto.<br>
	 * Los archivos un otros datos no primitivos se transfieren aun nuevo FormData si se requiere
	 * @param {FormData} fdata Objeto FormData de donde se leen los datos
	 * @param {?FormData} fdata_dest Objeto FormData al que se agregan todos los datos que no estan en el resultado
	 * @returns {null|object} Objeto resultado al que se agregaron los dato primitivos
	 */
	var formDataToObject=function(fdata, fdata_dest){
		if((fdata instanceof FormData)){
			if(!(fdata_dest instanceof FormData)){
				fdata_dest=null;
			}
			var obj={};
			$.each(Array.from(fdata.entries()), function(i, e){
				if((e[1] instanceof Object)){
					if(fdata_dest) fdata_dest.append(e[0], e[1]);
				}
				else{
					add_form_item(e[0], e[1], obj);
				}
			});
			return obj;
		}
		return null;
	};
	window.serializeObject_util={
		ltrim,
		ltrim_one,
		next_id,
		add_recursive,
		nameToList,
		add_form_item,
	};
	$.extend($.fn, {
		serializeObject: function(){
			var obj={};
			$.each($(this).serializeArray(), function(i, e){
				add_form_item(e['name'], e['value'], obj);
			});
			return obj;
		},
	});
	$.extend($, {
		serializeObject_util,
		formDataToObject,
	});
})();
