/*
 Highstock JS v11.0.0 (2023-04-26)

 Indicator series type for Highcharts Stock

 (c) 2010-2021 Rafal Sebestjanski

 License: www.highcharts.com/license
*/
'use strict';(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/indicators/dmi",["highcharts","highcharts/modules/stock"],function(l){a(l);a.Highcharts=l;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function l(a,g,h,l){a.hasOwnProperty(g)||(a[g]=l.apply(null,h),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:g,
module:a[g]}})))}a=a?a._modules:{};l(a,"Stock/Indicators/MultipleLinesComposition.js",[a["Core/Series/SeriesRegistry.js"],a["Core/Utilities.js"]],function(a,g){var h=a.seriesTypes.sma.prototype,l=g.defined,v=g.error,r=g.merge,k;(function(a){function k(c){return"plot"+c.charAt(0).toUpperCase()+c.slice(1)}function z(c,b){var m=[];(c.pointArrayMap||[]).forEach(function(c){c!==b&&m.push(k(c))});return m}function f(){var c=this,b=c.linesApiNames,d=c.areaLinesNames,e=c.points,a=c.options,y=c.graph,f={options:{gapSize:a.gapSize}},
g=[],t=z(c,c.pointValKey),w=e.length,u;t.forEach(function(c,b){for(g[b]=[];w--;)u=e[w],g[b].push({x:u.x,plotX:u.plotX,plotY:u[c],isNull:!l(u[c])});w=e.length});if(c.userOptions.fillColor&&d.length){var x=t.indexOf(k(d[0]));x=g[x];d=1===d.length?e:g[t.indexOf(k(d[1]))];t=c.color;c.points=d;c.nextPoints=x;c.color=c.userOptions.fillColor;c.options=r(e,f);c.graph=c.area;c.fillGraph=!0;h.drawGraph.call(c);c.area=c.graph;delete c.nextPoints;delete c.fillGraph;c.color=t}b.forEach(function(b,d){g[d]?(c.points=
g[d],a[b]?c.options=r(a[b].styles,f):v('Error: "There is no '+b+' in DOCS options declared. Check if linesApiNames are consistent with your DOCS line names."'),c.graph=c["graph"+b],h.drawGraph.call(c),c["graph"+b]=c.graph):v('Error: "'+b+" doesn't have equivalent in pointArrayMap. To many elements in linesApiNames relative to pointArrayMap.\"")});c.points=e;c.options=a;c.graph=y;h.drawGraph.call(c)}function b(c){var b,d=[];c=c||this.points;if(this.fillGraph&&this.nextPoints){if((b=h.getGraphPath.call(this,
this.nextPoints))&&b.length){b[0][0]="L";d=h.getGraphPath.call(this,c);b=b.slice(0,d.length);for(var e=b.length-1;0<=e;e--)d.push(b[e])}}else d=h.getGraphPath.apply(this,arguments);return d}function d(b){var c=[];(this.pointArrayMap||[]).forEach(function(d){c.push(b[d])});return c}function y(){var b=this,d=this.pointArrayMap,a=[],e;a=z(this);h.translate.apply(this,arguments);this.points.forEach(function(c){d.forEach(function(d,m){e=c[d];b.dataModify&&(e=b.dataModify.modifyValue(e));null!==e&&(c[a[m]]=
b.yAxis.toPixels(e,!0))})})}var t=[],w=["bottomLine"],u=["top","bottom"],x=["top"];a.compose=function(c){if(g.pushUnique(t,c)){var a=c.prototype;a.linesApiNames=a.linesApiNames||w.slice();a.pointArrayMap=a.pointArrayMap||u.slice();a.pointValKey=a.pointValKey||"top";a.areaLinesNames=a.areaLinesNames||x.slice();a.drawGraph=f;a.getGraphPath=b;a.toYData=d;a.translate=y}return c}})(k||(k={}));return k});l(a,"Stock/Indicators/DMI/DMIIndicator.js",[a["Stock/Indicators/MultipleLinesComposition.js"],a["Core/Series/SeriesRegistry.js"],
a["Core/Utilities.js"]],function(a,g,h){var l=this&&this.__extends||function(){var a=function(f,b){a=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(b,a){b.__proto__=a}||function(b,a){for(var d in a)Object.prototype.hasOwnProperty.call(a,d)&&(b[d]=a[d])};return a(f,b)};return function(f,b){function d(){this.constructor=f}if("function"!==typeof b&&null!==b)throw new TypeError("Class extends value "+String(b)+" is not a constructor or null");a(f,b);f.prototype=null===b?Object.create(b):
(d.prototype=b.prototype,new d)}}(),v=g.seriesTypes.sma,r=h.correctFloat,k=h.extend,A=h.isArray,B=h.merge;h=function(a){function f(){var b=null!==a&&a.apply(this,arguments)||this;b.options=void 0;return b}l(f,a);f.prototype.calculateDM=function(b,a,f){var d=b[a][1],g=b[a][2],h=b[a-1][1];b=b[a-1][2];return r(d-h>b-g?f?Math.max(d-h,0):0:f?0:Math.max(b-g,0))};f.prototype.calculateDI=function(b,a){return b/a*100};f.prototype.calculateDX=function(b,a){return r(Math.abs(b-a)/Math.abs(b+a)*100)};f.prototype.smoothValues=
function(b,a,f){return r(b-b/f+a)};f.prototype.getTR=function(b,a){return r(Math.max(b[1]-b[2],a?Math.abs(b[1]-a[3]):0,a?Math.abs(b[2]-a[3]):0))};f.prototype.getValues=function(b,a){a=a.period;var d=b.xData,f=(b=b.yData)?b.length:0,g=[],h=[],l=[];if(!(d.length<=a)&&A(b[0])&&4===b[0].length){var c=0,m=0,k=0,e;for(e=1;e<f;e++)if(e<=a){var n=this.calculateDM(b,e,!0);var p=this.calculateDM(b,e);var q=this.getTR(b[e],b[e-1]);c+=n;m+=p;k+=q;e===a&&(q=this.calculateDI(c,k),p=this.calculateDI(m,k),n=this.calculateDX(c,
m),g.push([d[e],n,q,p]),h.push(d[e]),l.push([n,q,p]))}else n=this.calculateDM(b,e,!0),p=this.calculateDM(b,e),q=this.getTR(b[e],b[e-1]),c=this.smoothValues(c,n,a),m=this.smoothValues(m,p,a),k=this.smoothValues(k,q,a),q=this.calculateDI(c,k),p=this.calculateDI(m,k),n=this.calculateDX(c,m),g.push([d[e],n,q,p]),h.push(d[e]),l.push([n,q,p]);return{values:g,xData:h,yData:l}}};f.defaultOptions=B(v.defaultOptions,{params:{index:void 0},marker:{enabled:!1},tooltip:{pointFormat:'<span style="color: {point.color}">\u25cf</span><b> {series.name}</b><br/><span style="color: {point.color}">DX</span>: {point.y}<br/><span style="color: {point.series.options.plusDILine.styles.lineColor}">+DI</span>: {point.plusDI}<br/><span style="color: {point.series.options.minusDILine.styles.lineColor}">-DI</span>: {point.minusDI}<br/>'},
plusDILine:{styles:{lineWidth:1,lineColor:"#06b535"}},minusDILine:{styles:{lineWidth:1,lineColor:"#f21313"}},dataGrouping:{approximation:"averages"}});return f}(v);k(h.prototype,{areaLinesNames:[],nameBase:"DMI",linesApiNames:["plusDILine","minusDILine"],pointArrayMap:["y","plusDI","minusDI"],parallelArrays:["x","y","plusDI","minusDI"],pointValKey:"y"});a.compose(h);g.registerSeriesType("dmi",h);"";return h});l(a,"masters/indicators/dmi.src.js",[],function(){})});
//# sourceMappingURL=dmi.js.map