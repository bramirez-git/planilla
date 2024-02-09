/*
 Highstock JS v11.0.0 (2023-04-26)

 Indicator series type for Highcharts Stock

 (c) 2010-2021 Daniel Studencki

 License: www.highcharts.com/license
*/
'use strict';(function(c){"object"===typeof module&&module.exports?(c["default"]=c,module.exports=c):"function"===typeof define&&define.amd?define("highcharts/indicators/acceleration-bands",["highcharts","highcharts/modules/stock"],function(e){c(e);c.Highcharts=e;return c}):c("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(c){function e(c,g,h,e){c.hasOwnProperty(g)||(c[g]=e.apply(null,h),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:g,
module:c[g]}})))}c=c?c._modules:{};e(c,"Stock/Indicators/MultipleLinesComposition.js",[c["Core/Series/SeriesRegistry.js"],c["Core/Utilities.js"]],function(c,g){const {sma:{prototype:h}}=c.seriesTypes,{defined:e,error:n,merge:p}=g;var f;(function(c){function x(a){return"plot"+a.charAt(0).toUpperCase()+a.slice(1)}function z(a,b){const d=[];(a.pointArrayMap||[]).forEach(a=>{a!==b&&d.push(x(a))});return d}function y(){const a=this,b=a.linesApiNames;var d=a.areaLinesNames;const c=a.points,l=a.options,
y=a.graph,g={options:{gapSize:l.gapSize}},f=[];var k=z(a,a.pointValKey);let u=c.length,t;k.forEach((a,b)=>{for(f[b]=[];u--;)t=c[u],f[b].push({x:t.x,plotX:t.plotX,plotY:t[a],isNull:!e(t[a])});u=c.length});if(a.userOptions.fillColor&&d.length){var m=k.indexOf(x(d[0]));m=f[m];d=1===d.length?c:f[k.indexOf(x(d[1]))];k=a.color;a.points=d;a.nextPoints=m;a.color=a.userOptions.fillColor;a.options=p(c,g);a.graph=a.area;a.fillGraph=!0;h.drawGraph.call(a);a.area=a.graph;delete a.nextPoints;delete a.fillGraph;
a.color=k}b.forEach((b,d)=>{f[d]?(a.points=f[d],l[b]?a.options=p(l[b].styles,g):n('Error: "There is no '+b+' in DOCS options declared. Check if linesApiNames are consistent with your DOCS line names."'),a.graph=a["graph"+b],h.drawGraph.call(a),a["graph"+b]=a.graph):n('Error: "'+b+" doesn't have equivalent in pointArrayMap. To many elements in linesApiNames relative to pointArrayMap.\"")});a.points=c;a.options=l;a.graph=y;h.drawGraph.call(a)}function f(a){var b;let d=[];a=a||this.points;if(this.fillGraph&&
this.nextPoints){if((b=h.getGraphPath.call(this,this.nextPoints))&&b.length){b[0][0]="L";d=h.getGraphPath.call(this,a);b=b.slice(0,d.length);for(let a=b.length-1;0<=a;a--)d.push(b[a])}}else d=h.getGraphPath.apply(this,arguments);return d}function k(a){const b=[];(this.pointArrayMap||[]).forEach(d=>{b.push(a[d])});return b}function u(){const a=this.pointArrayMap;let b=[],d;b=z(this);h.translate.apply(this,arguments);this.points.forEach(c=>{a.forEach((a,f)=>{d=c[a];this.dataModify&&(d=this.dataModify.modifyValue(d));
null!==d&&(c[b[f]]=this.yAxis.toPixels(d,!0))})})}const m=[],A=["bottomLine"],v=["top","bottom"],w=["top"];c.compose=function(a){if(g.pushUnique(m,a)){const b=a.prototype;b.linesApiNames=b.linesApiNames||A.slice();b.pointArrayMap=b.pointArrayMap||v.slice();b.pointValKey=b.pointValKey||"top";b.areaLinesNames=b.areaLinesNames||w.slice();b.drawGraph=y;b.getGraphPath=f;b.toYData=k;b.translate=u}return a}})(f||(f={}));return f});e(c,"Stock/Indicators/ABands/ABandsIndicator.js",[c["Stock/Indicators/MultipleLinesComposition.js"],
c["Core/Series/SeriesRegistry.js"],c["Core/Utilities.js"]],function(c,g,h){const {sma:e}=g.seriesTypes,{correctFloat:n,extend:p,merge:f}=h;class k extends e{constructor(){super(...arguments);this.points=this.options=this.data=void 0}getValues(c,f){const e=f.period,g=f.factor;f=f.index;const k=c.xData,h=(c=c.yData)?c.length:0,m=[],p=[],v=[],w=[],a=[];let b;if(!(h<e)){for(b=0;b<=h;b++){if(b<h){var d=c[b][2];var q=c[b][1];var l=g;d=n(q-d)/(n(q+d)/2)*1E3*l;m.push(c[b][1]*n(1+2*d));p.push(c[b][2]*n(1-
2*d))}if(b>=e){d=k.slice(b-e,b);var r=c.slice(b-e,b);l=super.getValues.call(this,{xData:d,yData:m.slice(b-e,b)},{period:e});q=super.getValues.call(this,{xData:d,yData:p.slice(b-e,b)},{period:e});r=super.getValues.call(this,{xData:d,yData:r},{period:e,index:f});d=r.xData[0];l=l.yData[0];q=q.yData[0];r=r.yData[0];v.push([d,l,r,q]);w.push(d);a.push([l,r,q])}}return{values:v,xData:w,yData:a}}}}k.defaultOptions=f(e.defaultOptions,{params:{period:20,factor:.001,index:3},lineWidth:1,topLine:{styles:{lineWidth:1}},
bottomLine:{styles:{lineWidth:1}},dataGrouping:{approximation:"averages"}});p(k.prototype,{areaLinesNames:["top","bottom"],linesApiNames:["topLine","bottomLine"],nameBase:"Acceleration Bands",nameComponents:["period","factor"],pointArrayMap:["top","middle","bottom"],pointValKey:"middle"});c.compose(k);g.registerSeriesType("abands",k);"";return k});e(c,"masters/indicators/acceleration-bands.src.js",[],function(){})});
//# sourceMappingURL=acceleration-bands.js.map