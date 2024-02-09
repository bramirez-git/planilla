/*
 Highcharts JS v11.0.0 (2023-04-26)

 Data module

 (c) 2012-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
'use strict';var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.arrayIteratorImpl=function(a){var b=0;return function(){return b<a.length?{done:!1,value:a[b++]}:{done:!0}}};$jscomp.arrayIterator=function(a){return{next:$jscomp.arrayIteratorImpl(a)}};$jscomp.ASSUME_ES5=!1;$jscomp.ASSUME_NO_NATIVE_MAP=!1;$jscomp.ASSUME_NO_NATIVE_SET=!1;$jscomp.SIMPLE_FROUND_POLYFILL=!1;$jscomp.ISOLATE_POLYFILLS=!1;
$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(a,b,c){if(a==Array.prototype||a==Object.prototype)return a;a[b]=c.value;return a};$jscomp.getGlobal=function(a){a=["object"==typeof globalThis&&globalThis,a,"object"==typeof window&&window,"object"==typeof self&&self,"object"==typeof global&&global];for(var b=0;b<a.length;++b){var c=a[b];if(c&&c.Math==Math)return c}throw Error("Cannot find global object");};$jscomp.global=$jscomp.getGlobal(this);
$jscomp.SYMBOL_PREFIX="jscomp_symbol_";$jscomp.initSymbol=function(){$jscomp.initSymbol=function(){};$jscomp.global.Symbol||($jscomp.global.Symbol=$jscomp.Symbol)};$jscomp.SymbolClass=function(a,b){this.$jscomp$symbol$id_=a;$jscomp.defineProperty(this,"description",{configurable:!0,writable:!0,value:b})};$jscomp.SymbolClass.prototype.toString=function(){return this.$jscomp$symbol$id_};
$jscomp.Symbol=function(){function a(c){if(this instanceof a)throw new TypeError("Symbol is not a constructor");return new $jscomp.SymbolClass($jscomp.SYMBOL_PREFIX+(c||"")+"_"+b++,c)}var b=0;return a}();
$jscomp.initSymbolIterator=function(){$jscomp.initSymbol();var a=$jscomp.global.Symbol.iterator;a||(a=$jscomp.global.Symbol.iterator=$jscomp.global.Symbol("Symbol.iterator"));"function"!=typeof Array.prototype[a]&&$jscomp.defineProperty(Array.prototype,a,{configurable:!0,writable:!0,value:function(){return $jscomp.iteratorPrototype($jscomp.arrayIteratorImpl(this))}});$jscomp.initSymbolIterator=function(){}};
$jscomp.initSymbolAsyncIterator=function(){$jscomp.initSymbol();var a=$jscomp.global.Symbol.asyncIterator;a||(a=$jscomp.global.Symbol.asyncIterator=$jscomp.global.Symbol("Symbol.asyncIterator"));$jscomp.initSymbolAsyncIterator=function(){}};$jscomp.iteratorPrototype=function(a){$jscomp.initSymbolIterator();a={next:a};a[$jscomp.global.Symbol.iterator]=function(){return this};return a};
$jscomp.iteratorFromArray=function(a,b){$jscomp.initSymbolIterator();a instanceof String&&(a+="");var c=0,h={next:function(){if(c<a.length){var k=c++;return{value:b(k,a[k]),done:!1}}h.next=function(){return{done:!0,value:void 0}};return h.next()}};h[Symbol.iterator]=function(){return h};return h};$jscomp.polyfills={};$jscomp.propertyToPolyfillSymbol={};$jscomp.POLYFILL_PREFIX="$jscp$";$jscomp.IS_SYMBOL_NATIVE="function"===typeof Symbol&&"symbol"===typeof Symbol("x");
var $jscomp$lookupPolyfilledValue=function(a,b){var c=$jscomp.propertyToPolyfillSymbol[b];if(null==c)return a[b];c=a[c];return void 0!==c?c:a[b]};$jscomp.polyfill=function(a,b,c,h){b&&($jscomp.ISOLATE_POLYFILLS?$jscomp.polyfillIsolated(a,b,c,h):$jscomp.polyfillUnisolated(a,b,c,h))};
$jscomp.polyfillUnisolated=function(a,b,c,h){c=$jscomp.global;a=a.split(".");for(h=0;h<a.length-1;h++){var k=a[h];k in c||(c[k]={});c=c[k]}a=a[a.length-1];h=c[a];b=b(h);b!=h&&null!=b&&$jscomp.defineProperty(c,a,{configurable:!0,writable:!0,value:b})};
$jscomp.polyfillIsolated=function(a,b,c,h){var k=a.split(".");a=1===k.length;h=k[0];h=!a&&h in $jscomp.polyfills?$jscomp.polyfills:$jscomp.global;for(var u=0;u<k.length-1;u++){var w=k[u];w in h||(h[w]={});h=h[w]}k=k[k.length-1];c=$jscomp.IS_SYMBOL_NATIVE&&"es6"===c?h[k]:null;b=b(c);null!=b&&(a?$jscomp.defineProperty($jscomp.polyfills,k,{configurable:!0,writable:!0,value:b}):b!==c&&($jscomp.propertyToPolyfillSymbol[k]=$jscomp.IS_SYMBOL_NATIVE?$jscomp.global.Symbol(k):$jscomp.POLYFILL_PREFIX+k,k=$jscomp.propertyToPolyfillSymbol[k],
$jscomp.defineProperty(h,k,{configurable:!0,writable:!0,value:b})))};$jscomp.polyfill("Array.prototype.values",function(a){return a?a:function(){return $jscomp.iteratorFromArray(this,function(a,c){return c})}},"es8","es3");
(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/modules/data",["highcharts"],function(b){a(b);a.Highcharts=b;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function b(a,h,b,u){a.hasOwnProperty(h)||(a[h]=u.apply(null,b),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:h,module:a[h]}})))}a=a?a._modules:{};b(a,"Core/HttpUtilities.js",
[a["Core/Globals.js"],a["Core/Utilities.js"]],function(a,h){var b=a.doc,c=h.createElement,w=h.discardElement,A=h.merge,p=h.objectEach,F={ajax:function(a){var c={json:"application/json",xml:"application/xml",text:"text/plain",octet:"application/octet-stream"},b=new XMLHttpRequest;if(!a.url)return!1;b.open((a.type||"get").toUpperCase(),a.url,!0);a.headers&&a.headers["Content-Type"]||b.setRequestHeader("Content-Type",c[a.dataType||"json"]||c.text);p(a.headers,function(a,c){b.setRequestHeader(c,a)});
a.responseType&&(b.responseType=a.responseType);b.onreadystatechange=function(){if(4===b.readyState){if(200===b.status){if("blob"!==a.responseType){var c=b.responseText;if("json"===a.dataType)try{c=JSON.parse(c)}catch(y){if(y instanceof Error){a.error&&a.error(b,y);return}}}return a.success&&a.success(c,b)}a.error&&a.error(b,b.responseText)}};a.data&&"string"!==typeof a.data&&(a.data=JSON.stringify(a.data));b.send(a.data)},getJSON:function(a,b){F.ajax({url:a,success:b,dataType:"json",headers:{"Content-Type":"text/plain"}})},
post:function(a,h,k){var u=c("form",A({method:"post",action:a,enctype:"multipart/form-data"},k),{display:"none"},b.body);p(h,function(a,b){c("input",{type:"hidden",name:b,value:a},void 0,u)});u.submit();w(u)}};"";return F});b(a,"Extensions/Data.js",[a["Core/Chart/Chart.js"],a["Core/Defaults.js"],a["Core/Globals.js"],a["Core/HttpUtilities.js"],a["Core/Series/Point.js"],a["Core/Series/SeriesRegistry.js"],a["Core/Utilities.js"]],function(a,b,k,u,w,A,p){function c(a){return!(!a||!(a.rowsURL||a.csvURL||
a.columnsURL))}var h=b.getOptions,K=k.doc,E=u.ajax,B=A.seriesTypes;b=p.addEvent;var y=p.defined,L=p.extend,M=p.fireEvent,G=p.isNumber,x=p.merge,N=p.objectEach,C=p.pick,O=p.splat,J=function(){function a(f,m,e){void 0===m&&(m={});this.rowsToColumns=a.rowsToColumns;this.dateFormats={"YYYY/mm/dd":{regex:/^([0-9]{4})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{1,2})$/,parser:function(a){return a?Date.UTC(+a[1],a[2]-1,+a[3]):NaN}},"dd/mm/YYYY":{regex:/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{4})$/,parser:function(a){return a?
Date.UTC(+a[3],a[2]-1,+a[1]):NaN},alternative:"mm/dd/YYYY"},"mm/dd/YYYY":{regex:/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{4})$/,parser:function(a){return a?Date.UTC(+a[3],a[1]-1,+a[2]):NaN}},"dd/mm/YY":{regex:/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{2})$/,parser:function(a){if(!a)return NaN;var f=+a[3];f=f>(new Date).getFullYear()-2E3?f+1900:f+2E3;return Date.UTC(f,a[2]-1,+a[1])},alternative:"mm/dd/YY"},"mm/dd/YY":{regex:/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{2})$/,parser:function(a){return a?
Date.UTC(+a[3]+2E3,a[1]-1,+a[2]):NaN}}};this.chart=e;this.chartOptions=m;this.options=f;this.rawColumns=[];this.init(f,m,e)}a.data=function(f,m,e){void 0===m&&(m={});return new a(f,m,e)};a.rowsToColumns=function(a){var f,e;if(a){var l=[];var d=a.length;for(f=0;f<d;f++){var b=a[f].length;for(e=0;e<b;e++)l[e]||(l[e]=[]),l[e][f]=a[f][e]}}return l};a.prototype.init=function(a,m,e){var f=a.decimalPoint;m&&(this.chartOptions=m);e&&(this.chart=e);"."!==f&&","!==f&&(f=void 0);this.options=a;this.columns=
a.columns||this.rowsToColumns(a.rows)||[];this.firstRowAsNames=C(a.firstRowAsNames,this.firstRowAsNames,!0);this.decimalRegex=f&&new RegExp("^(-?[0-9]+)"+f+"([0-9]+)$");void 0!==this.liveDataTimeout&&clearTimeout(this.liveDataTimeout);this.rawColumns=[];if(this.columns.length){this.dataFound();var d=!c(a)}d||(d=this.fetchLiveData());d||(d=!!this.parseCSV().length);d||(d=!!this.parseTable().length);d||(d=this.parseGoogleSpreadsheet());!d&&a.afterComplete&&a.afterComplete()};a.prototype.getColumnDistribution=
function(){var a=this.chartOptions,m=this.options,e=[],b=function(a){return(B[a||"line"].prototype.pointArrayMap||[0]).length},d=a&&a.chart&&a.chart.type,r=[],c=[];m=m&&m.seriesMapping||a&&a.series&&a.series.map(function(){return{x:0}})||[];var h=0,q;(a&&a.series||[]).forEach(function(a){r.push(b(a.type||d))});m.forEach(function(a){e.push(a.x||0)});0===e.length&&e.push(0);m.forEach(function(f){var m=new I,e=r[h]||b(d),l=(a&&a.series||[])[h]||{},n=B[l.type||d||"line"].prototype.pointArrayMap,v=n||
["y"];(y(f.x)||l.isCartesian||!n)&&m.addColumnReader(f.x,"x");N(f,function(a,f){"x"!==f&&m.addColumnReader(a,f)});for(q=0;q<e;q++)m.hasReader(v[q])||m.addColumnReader(void 0,v[q]);c.push(m);h++});m=B[d||"line"].prototype.pointArrayMap;"undefined"===typeof m&&(m=["y"]);this.valueCount={global:b(d),xColumns:e,individual:r,seriesBuilders:c,globalPointArrayMap:m}};a.prototype.dataFound=function(){this.options.switchRowsAndColumns&&(this.columns=this.rowsToColumns(this.columns));this.getColumnDistribution();
this.parseTypes();!1!==this.parsed()&&this.complete()};a.prototype.parseCSV=function(a){function f(a,f,m,d){function e(f){g=a[f];k=a[f-1];H=a[f+1]}function c(a){n.length<t+1&&n.push([a]);n[t][n[t].length-1]!==a&&n[t].push(a)}function b(){h>p||p>q?(++p,v=""):(!isNaN(parseFloat(v))&&isFinite(v)?(v=parseFloat(v),c("number")):isNaN(Date.parse(v))?c("string"):(v=v.replace(/\//g,"-"),c("date")),r.length<t+1&&r.push([]),m||(r[t][f]=v),v="",++t,++p)}var l=0,g="",k="",H="",v="",p=0,t=0;if(a.trim().length&&
"#"!==a.trim()[0]){for(;l<a.length;l++)if(e(l),'"'===g)for(e(++l);l<a.length&&('"'!==g||'"'===k||'"'===H);){if('"'!==g||'"'===g&&'"'!==k)v+=g;e(++l)}else d&&d[g]?d[g](g,v)&&b():g===D?b():v+=g;b()}}function e(a){var f=0,m=0,e=!1;a.some(function(a,d){var e=!1,c="";if(13<d)return!0;for(var b=0;b<a.length;b++){d=a[b];var l=a[b+1];var r=a[b-1];if("#"===d)break;if('"'===d)if(e){if('"'!==r&&'"'!==l){for(;" "===l&&b<a.length;)l=a[++b];"undefined"!==typeof g[l]&&g[l]++;e=!1}}else e=!0;else"undefined"!==typeof g[d]?
(c=c.trim(),isNaN(Date.parse(c))?!isNaN(c)&&isFinite(c)||g[d]++:g[d]++,c=""):c+=d;","===d&&m++;"."===d&&f++}});e=g[";"]>g[","]?";":",";c.decimalPoint||(c.decimalPoint=f>m?".":",",d.decimalRegex=new RegExp("^(-?[0-9]+)"+c.decimalPoint+"([0-9]+)$"));return e}function b(a,f){var m=[],e=[],b=[],l=0,r=!1,g;if(!f||f>a.length)f=a.length;for(;l<f;l++)if("undefined"!==typeof a[l]&&a[l]&&a[l].length){var n=a[l].trim().replace(/\//g," ").replace(/\-/g," ").replace(/\./g," ").split(" ");b=["","",""];for(g=0;g<
n.length;g++)g<b.length&&(n[g]=parseInt(n[g],10),n[g]&&(e[g]=!e[g]||e[g]<n[g]?n[g]:e[g],"undefined"!==typeof m[g]?m[g]!==n[g]&&(m[g]=!1):m[g]=n[g],31<n[g]?b[g]=100>n[g]?"YY":"YYYY":12<n[g]&&31>=n[g]?(b[g]="dd",r=!0):b[g].length||(b[g]="mm")))}if(r){for(g=0;g<m.length;g++)!1!==m[g]?12<e[g]&&"YY"!==b[g]&&"YYYY"!==b[g]&&(b[g]="YY"):12<e[g]&&"mm"===b[g]&&(b[g]="dd");3===b.length&&"dd"===b[1]&&"dd"===b[2]&&(b[2]="YY");a=b.join("/");return(c.dateFormats||d.dateFormats)[a]?a:(M("deduceDateFailed"),"YYYY/mm/dd")}return"YYYY/mm/dd"}
var d=this,r=this.columns=[],c=a||this.options,h="undefined"!==typeof c.startColumn&&c.startColumn?c.startColumn:0,q=c.endColumn||Number.MAX_VALUE,n=[],g={",":0,";":0,"\t":0},k=c.csv;a="undefined"!==typeof c.startRow&&c.startRow?c.startRow:0;var p=c.endRow||Number.MAX_VALUE,t=0;k&&c.beforeParse&&(k=c.beforeParse.call(this,k));if(k){k=k.replace(/\r\n/g,"\n").replace(/\r/g,"\n").split(c.lineDelimiter||"\n");if(!a||0>a)a=0;if(!p||p>=k.length)p=k.length-1;if(c.itemDelimiter)var D=c.itemDelimiter;else D=
null,D=e(k);var u=0;for(t=a;t<=p;t++)"#"===k[t][0]?u++:f(k[t],t-a-u);c.columnTypes&&0!==c.columnTypes.length||!n.length||!n[0].length||"date"!==n[0][1]||c.dateFormat||(c.dateFormat=b(r[0]));this.dataFound()}return r};a.prototype.parseTable=function(){var a=this.options,m=this.columns||[],e=a.startRow||0,b=a.endRow||Number.MAX_VALUE,d=a.startColumn||0,c=a.endColumn||Number.MAX_VALUE;a.table&&(a=a.table,"string"===typeof a&&(a=K.getElementById(a)),[].forEach.call(a.getElementsByTagName("tr"),function(a,
f){f>=e&&f<=b&&[].forEach.call(a.children,function(a,b){var g=m[b-d],l=1;if(("TD"===a.tagName||"TH"===a.tagName)&&b>=d&&b<=c)for(m[b-d]||(m[b-d]=[]),m[b-d][f-e]=a.innerHTML;f-e>=l&&void 0===g[f-e-l];)g[f-e-l]=null,l++})}),this.dataFound());return m};a.prototype.fetchLiveData=function(){function a(f){function e(e,c,r){function g(){d&&b.liveDataURL===e&&(m.liveDataTimeout=setTimeout(a,k))}if(!e||!/^(http|\/|\.\/|\.\.\/)/.test(e))return e&&l.error&&l.error("Invalid URL"),!1;f&&(clearTimeout(m.liveDataTimeout),
b.liveDataURL=e);E({url:e,dataType:r||"json",success:function(a){b&&b.series&&c(a);g()},error:function(a,f){3>++h&&g();return l.error&&l.error(f,a)}});return!0}e(r.csvURL,function(a){b.update({data:{csv:a}})},"text")||e(r.rowsURL,function(a){b.update({data:{rows:a}})})||e(r.columnsURL,function(a){b.update({data:{columns:a}})})}var m=this,b=this.chart,l=this.options,d=l.enablePolling,r=x(l),h=0,k=1E3*(l.dataRefreshRate||2);if(!c(l))return!1;1E3>k&&(k=1E3);delete l.csvURL;delete l.rowsURL;delete l.columnsURL;
a(!0);return c(l)};a.prototype.parseGoogleSpreadsheet=function(){function a(f){var d=["https://sheets.googleapis.com/v4/spreadsheets",c,"values",h(),"?alt=json&majorDimension=COLUMNS&valueRenderOption=UNFORMATTED_VALUE&dateTimeRenderOption=FORMATTED_STRING&key="+e.googleAPIKey].join("/");E({url:d,dataType:"json",success:function(d){f(d);e.enablePolling&&(b.liveDataTimeout=setTimeout(function(){a(f)},r))},error:function(a,f){return e.error&&e.error(f,a)}})}var b=this,e=this.options,c=e.googleSpreadsheetKey,
d=this.chart,r=Math.max(1E3*(e.dataRefreshRate||2),4E3),h=function(){if(e.googleSpreadsheetRange)return e.googleSpreadsheetRange;var a=("ABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt(e.startColumn||0)||"A")+((e.startRow||0)+1),f="ABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt(C(e.endColumn,-1))||"ZZ";y(e.endRow)&&(f+=e.endRow+1);return"".concat(a,":").concat(f)};c&&(delete e.googleSpreadsheetKey,a(function(a){a=a.values;if(!a||0===a.length)return!1;var f=a.reduce(function(a,f){return Math.max(a,f.length)},0);a.forEach(function(a){for(var b=
0;b<f;b++)"undefined"===typeof a[b]&&(a[b]=null)});d&&d.series?d.update({data:{columns:a}}):(b.columns=a,b.dataFound())}));return!1};a.prototype.trim=function(a,b){"string"===typeof a&&(a=a.replace(/^\s+|\s+$/g,""),b&&/^[0-9\s]+$/.test(a)&&(a=a.replace(/\s/g,"")),this.decimalRegex&&(a=a.replace(this.decimalRegex,"$1.$2")));return a};a.prototype.parseTypes=function(){for(var a=this.columns||[],b=a.length;b--;)this.parseColumn(a[b],b)};a.prototype.parseColumn=function(a,b){var e=this.rawColumns,f=this.columns,
d=this.firstRowAsNames,c=-1!==this.valueCount.xColumns.indexOf(b),m=[],h=this.chartOptions,k=(this.options.columnTypes||[])[b];h=c&&(h&&h.xAxis&&"category"===O(h.xAxis)[0].type||"string"===k);var n=y(a.name),g=a.length,p,u;for(e[b]||(e[b]=[]);g--;){var t=m[g]||a[g];var z=this.trim(t);var w=this.trim(t,!0);var x=parseFloat(w);"undefined"===typeof e[b][g]&&(e[b][g]=z);h||0===g&&d&&!n?a[g]=""+z:+w===x?(a[g]=x,31536E6<x&&"float"!==k?a.isDatetime=!0:a.isNumeric=!0,"undefined"!==typeof a[g+1]&&(u=x>a[g+
1])):(z&&z.length&&(p=this.parseDate(t)),c&&G(p)&&"float"!==k?(m[g]=t,a[g]=p,a.isDatetime=!0,"undefined"!==typeof a[g+1]&&(t=p>a[g+1],t!==u&&"undefined"!==typeof u&&(this.alternativeFormat?(this.dateFormat=this.alternativeFormat,g=a.length,this.alternativeFormat=this.dateFormats[this.dateFormat].alternative):a.unsorted=!0),u=t)):(a[g]=""===z?null:z,0!==g&&(a.isDatetime||a.isNumeric)&&(a.mixed=!0)))}c&&a.mixed&&(f[b]=e[b]);if(c&&u&&this.options.sort)for(b=0;b<f.length;b++)f[b].reverse(),d&&f[b].unshift(f[b].pop())};
a.prototype.parseDate=function(a){var b=this.options.parseDate,e,f=this.options.dateFormat||this.dateFormat,d;if(b)var c=b(a);else if("string"===typeof a){if(f)(b=this.dateFormats[f])||(b=this.dateFormats["YYYY/mm/dd"]),(d=a.match(b.regex))&&(c=b.parser(d));else for(e in this.dateFormats)if(b=this.dateFormats[e],d=a.match(b.regex)){this.dateFormat=e;this.alternativeFormat=b.alternative;c=b.parser(d);break}d||(a.match(/:.+(GMT|UTC|[Z+-])/)&&(a=a.replace(/\s*(?:GMT|UTC)?([+-])(\d\d)(\d\d)$/,"$1$2:$3").replace(/(?:\s+|GMT|UTC)([+-])/,
"$1").replace(/(\d)\s*(?:GMT|UTC|Z)$/,"$1+00:00")),d=Date.parse(a),"object"===typeof d&&null!==d&&d.getTime?c=d.getTime()-6E4*d.getTimezoneOffset():G(d)&&(c=d-6E4*(new Date(d)).getTimezoneOffset()))}return c};a.prototype.getData=function(){if(this.columns)return this.rowsToColumns(this.columns).slice(1)};a.prototype.parsed=function(){if(this.options.parsed)return this.options.parsed.call(this,this.columns)};a.prototype.complete=function(){var a=this.columns,b=this.options,e=[],c,d,h;if(b.complete||
b.afterComplete){if(this.firstRowAsNames)for(d=0;d<a.length;d++){var k=a[d];y(k.name)||(k.name=C(k.shift(),"").toString())}k=[];var p=a.length;var q=this.valueCount.seriesBuilders;d=[];var n=[];for(h=0;h<p;h+=1)d.push(!0);for(p=0;p<q.length;p+=1){var g=q[p].getReferencedColumnIndexes();for(h=0;h<g.length;h+=1)d[g[h]]=!1}for(h=0;h<d.length;h+=1)d[h]&&n.push(h);for(d=0;d<this.valueCount.seriesBuilders.length;d++)q=this.valueCount.seriesBuilders[d],q.populateColumns(n)&&e.push(q);for(;0<n.length;){q=
new I;q.addColumnReader(0,"x");d=n.indexOf(0);-1!==d&&n.splice(d,1);for(d=0;d<this.valueCount.global;d++)q.addColumnReader(void 0,this.valueCount.globalPointArrayMap[d]);q.populateColumns(n)&&e.push(q)}0<e.length&&0<e[0].readers.length&&(n=a[e[0].readers[0].columnIndex],"undefined"!==typeof n&&(n.isDatetime?c="datetime":n.isNumeric||(c="category")));if("category"===c)for(d=0;d<e.length;d++)for(q=e[d],n=0;n<q.readers.length;n++)"x"===q.readers[n].configName&&(q.readers[n].configName="name");for(d=
0;d<e.length;d++){q=e[d];n=[];for(h=0;h<a[0].length;h++)n[h]=q.read(a,h);k[d]={data:n};q.name&&(k[d].name=q.name);"category"===c&&(k[d].turboThreshold=0)}a={series:k};c&&(a.xAxis={type:c},"category"===c&&(a.xAxis.uniqueNames=!1));b.complete&&b.complete(a);b.afterComplete&&b.afterComplete(a)}};a.prototype.update=function(a,b){var c=this.chart,f=c.options;a&&(a.afterComplete=function(a){a&&(a.xAxis&&c.xAxis[0]&&a.xAxis.type===c.xAxis[0].options.type&&delete a.xAxis,c.update(a,b,!0))},x(!0,f.data,a),
f.data&&f.data.googleSpreadsheetKey&&!a.columns&&delete f.data.columns,this.init(f.data))};return a}();b(a,"init",function(a){var b=this,c=a.args[1],e=h().data,l=a.args[0]||{};(e||l&&l.data)&&!b.hasDataDef&&(b.hasDataDef=!0,e=x(e,l.data),b.data=new J(L(e,{afterComplete:function(a){var e;if(Object.hasOwnProperty.call(l,"series"))if("object"===typeof l.series)for(e=Math.max(l.series.length,a&&a.series?a.series.length:0);e--;){var d=l.series[e]||{};l.series[e]=x(d,a&&a.series?a.series[e]:{})}else delete l.series;
l=x(a,l);b.init(l,c)}}),l,b),a.preventDefault())});var I=function(){function a(){this.readers=[];this.pointIsArray=!0}a.prototype.populateColumns=function(a){var b=!0;this.readers.forEach(function(b){"undefined"===typeof b.columnIndex&&(b.columnIndex=a.shift())});this.readers.forEach(function(a){"undefined"===typeof a.columnIndex&&(b=!1)});return b};a.prototype.read=function(a,b){var c=this.pointIsArray,f=c?[]:{};this.readers.forEach(function(e){var d=a[e.columnIndex][b];c?f.push(d):0<e.configName.indexOf(".")?
w.prototype.setNestedProperty(f,d,e.configName):f[e.configName]=d});if("undefined"===typeof this.name&&2<=this.readers.length){var d=[];this.readers.forEach(function(a){"x"!==a.configName&&"name"!==a.configName&&"y"!==a.configName||"undefined"===typeof a.columnIndex||d.push(a.columnIndex)});2<=d.length&&(d.shift(),d.sort(function(a,b){return a-b}),this.name=a[d.shift()].name)}return f};a.prototype.addColumnReader=function(a,b){this.readers.push({columnIndex:a,configName:b});"x"!==b&&"y"!==b&&"undefined"!==
typeof b&&(this.pointIsArray=!1)};a.prototype.getReferencedColumnIndexes=function(){var a=[],b;for(b=0;b<this.readers.length;b+=1){var c=this.readers[b];"undefined"!==typeof c.columnIndex&&a.push(c.columnIndex)}return a};a.prototype.hasReader=function(a){var b;for(b=0;b<this.readers.length;b+=1){var c=this.readers[b];if(c.configName===a)return!0}};return a}();"";return J});b(a,"masters/modules/data.src.js",[a["Core/Globals.js"],a["Core/HttpUtilities.js"],a["Extensions/Data.js"]],function(a,b,k){a.ajax=
b.ajax;a.data=k.data;a.getJSON=b.getJSON;a.post=b.post;a.Data=k;a.HttpUtilities=b})});
//# sourceMappingURL=data.js.map