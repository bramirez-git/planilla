/*
 Highstock JS v11.0.0 (2023-04-26)

 Indicator series type for Highcharts Stock

 (c) 2010-2021 Daniel Studencki

 License: www.highcharts.com/license
*/
'use strict';(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/indicators/price-channel",["highcharts","highcharts/modules/stock"],function(e){a(e);a.Highcharts=e;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function e(a,c,f,g){a.hasOwnProperty(c)||(a[c]=g.apply(null,f),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:c,
module:a[c]}})))}a=a?a._modules:{};e(a,"Stock/Indicators/ArrayUtilities.js",[],function(){return{getArrayExtremes:function(a,c,f){return a.reduce((a,e)=>[Math.min(a[0],e[c]),Math.max(a[1],e[f])],[Number.MAX_VALUE,-Number.MAX_VALUE])}}});e(a,"Stock/Indicators/MultipleLinesComposition.js",[a["Core/Series/SeriesRegistry.js"],a["Core/Utilities.js"]],function(a,c){const {sma:{prototype:f}}=a.seriesTypes,{defined:e,error:u,merge:p}=c;var k;(function(a){function l(b){return"plot"+b.charAt(0).toUpperCase()+
b.slice(1)}function w(b,h){const a=[];(b.pointArrayMap||[]).forEach(b=>{b!==h&&a.push(l(b))});return a}function v(){const b=this,a=b.linesApiNames;var d=b.areaLinesNames;const q=b.points,c=b.options,k=b.graph,v={options:{gapSize:c.gapSize}},g=[];var m=w(b,b.pointValKey);let n=q.length,r;m.forEach((b,a)=>{for(g[a]=[];n--;)r=q[n],g[a].push({x:r.x,plotX:r.plotX,plotY:r[b],isNull:!e(r[b])});n=q.length});if(b.userOptions.fillColor&&d.length){var t=m.indexOf(l(d[0]));t=g[t];d=1===d.length?q:g[m.indexOf(l(d[1]))];
m=b.color;b.points=d;b.nextPoints=t;b.color=b.userOptions.fillColor;b.options=p(q,v);b.graph=b.area;b.fillGraph=!0;f.drawGraph.call(b);b.area=b.graph;delete b.nextPoints;delete b.fillGraph;b.color=m}a.forEach((a,h)=>{g[h]?(b.points=g[h],c[a]?b.options=p(c[a].styles,v):u('Error: "There is no '+a+' in DOCS options declared. Check if linesApiNames are consistent with your DOCS line names."'),b.graph=b["graph"+a],f.drawGraph.call(b),b["graph"+a]=b.graph):u('Error: "'+a+" doesn't have equivalent in pointArrayMap. To many elements in linesApiNames relative to pointArrayMap.\"")});
b.points=q;b.options=c;b.graph=k;f.drawGraph.call(b)}function k(b){var a;let d=[];b=b||this.points;if(this.fillGraph&&this.nextPoints){if((a=f.getGraphPath.call(this,this.nextPoints))&&a.length){a[0][0]="L";d=f.getGraphPath.call(this,b);a=a.slice(0,d.length);for(let b=a.length-1;0<=b;b--)d.push(a[b])}}else d=f.getGraphPath.apply(this,arguments);return d}function g(b){const a=[];(this.pointArrayMap||[]).forEach(h=>{a.push(b[h])});return a}function t(){const b=this.pointArrayMap;let a=[],d;a=w(this);
f.translate.apply(this,arguments);this.points.forEach(h=>{b.forEach((b,c)=>{d=h[b];this.dataModify&&(d=this.dataModify.modifyValue(d));null!==d&&(h[a[c]]=this.yAxis.toPixels(d,!0))})})}const x=[],y=["bottomLine"],m=["top","bottom"],n=["top"];a.compose=function(b){if(c.pushUnique(x,b)){const a=b.prototype;a.linesApiNames=a.linesApiNames||y.slice();a.pointArrayMap=a.pointArrayMap||m.slice();a.pointValKey=a.pointValKey||"top";a.areaLinesNames=a.areaLinesNames||n.slice();a.drawGraph=v;a.getGraphPath=
k;a.toYData=g;a.translate=t}return b}})(k||(k={}));return k});e(a,"Stock/Indicators/PC/PCIndicator.js",[a["Stock/Indicators/ArrayUtilities.js"],a["Stock/Indicators/MultipleLinesComposition.js"],a["Core/Color/Palettes.js"],a["Core/Series/SeriesRegistry.js"],a["Core/Utilities.js"]],function(a,c,f,g,e){const {sma:p}=g.seriesTypes,{merge:k,extend:u}=e;class l extends p{constructor(){super(...arguments);this.points=this.options=this.data=void 0}getValues(c,e){e=e.period;const f=c.xData,g=(c=c.yData)?c.length:
0,k=[],l=[],p=[];let m,n,b;if(!(g<e)){for(b=e;b<=g;b++){n=f[b-1];var h=c.slice(b-e,b);var d=a.getArrayExtremes(h,2,1);h=d[1];m=d[0];d=(h+m)/2;k.push([n,h,d,m]);l.push(n);p.push([h,d,m])}return{values:k,xData:l,yData:p}}}}l.defaultOptions=k(p.defaultOptions,{params:{index:void 0,period:20},lineWidth:1,topLine:{styles:{lineColor:f.colors[2],lineWidth:1}},bottomLine:{styles:{lineColor:f.colors[8],lineWidth:1}},dataGrouping:{approximation:"averages"}});u(l.prototype,{areaLinesNames:["top","bottom"],nameBase:"Price Channel",
nameComponents:["period"],linesApiNames:["topLine","bottomLine"],pointArrayMap:["top","middle","bottom"],pointValKey:"middle"});c.compose(l);g.registerSeriesType("pc",l);"";return l});e(a,"masters/indicators/price-channel.src.js",[],function(){})});
//# sourceMappingURL=price-channel.js.map