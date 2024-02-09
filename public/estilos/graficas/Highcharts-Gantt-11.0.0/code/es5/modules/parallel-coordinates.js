/*
 Highcharts JS v11.0.0 (2023-04-26)

 Support for parallel coordinates in Highcharts

 (c) 2010-2021 Pawel Fus

 License: www.highcharts.com/license
*/
'use strict';(function(b){"object"===typeof module&&module.exports?(b["default"]=b,module.exports=b):"function"===typeof define&&define.amd?define("highcharts/modules/parallel-coordinates",["highcharts"],function(g){b(g);b.Highcharts=g;return b}):b("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(b){function g(b,k,g,p){b.hasOwnProperty(k)||(b[k]=p.apply(null,g),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:k,module:b[k]}})))}
b=b?b._modules:{};g(b,"Extensions/ParallelCoordinates.js",[b["Core/Axis/Axis.js"],b["Core/Chart/Chart.js"],b["Core/FormatUtilities.js"],b["Core/Globals.js"],b["Core/Defaults.js"],b["Core/Series/Series.js"],b["Core/Utilities.js"]],function(b,k,g,p,y,q,d){function z(a){var c=this.series&&this.series.chart,b=a.apply(this,Array.prototype.slice.call(arguments,1)),h;if(c&&c.hasParallelCoordinates&&!r(b.formattedValue)){var f=c.yAxis[this.x];var e=f.options;c=(h=v(e.tooltipValueFormat,e.labels.format))?
A(h,w(this,{value:this.y}),c):f.dateTime?c.time.dateFormat(c.time.resolveDTLFormat(e.dateTimeLabelFormats[f.tickPositions.info.unitName]).main,this.y):e.categories?e.categories[this.y]:this.y;b.formattedValue=b.point.formattedValue=c}return b}var A=g.format;g=y.setOptions;var l=d.addEvent,B=d.arrayMax,C=d.arrayMin,r=d.defined,D=d.erase,w=d.extend,t=d.isNumber,m=d.merge,v=d.pick,u=d.splat,E=d.wrap;d=k.prototype;var x={lineWidth:0,tickLength:0,opposite:!0,type:"category"};g({chart:{parallelCoordinates:!1,
parallelAxes:{lineWidth:1,title:{text:"",reserveSpace:!1},labels:{x:0,y:4,align:"center",reserveSpace:!1},offset:0}}});l(k,"init",function(a){a=a.args[0];var c=u(a.yAxis||{}),b=[],h=c.length;if(this.hasParallelCoordinates=a.chart&&a.chart.parallelCoordinates){for(this.setParallelInfo(a);h<=this.parallelInfo.counter;h++)b.push({});a.legend||(a.legend={});"undefined"===typeof a.legend.enabled&&(a.legend.enabled=!1);m(!0,a,{boost:{seriesThreshold:Number.MAX_VALUE},plotOptions:{series:{boostThreshold:Number.MAX_VALUE}}});
a.yAxis=c.concat(b);a.xAxis=m(x,u(a.xAxis||{})[0])}});l(k,"update",function(a){a=a.options;a.chart&&(r(a.chart.parallelCoordinates)&&(this.hasParallelCoordinates=a.chart.parallelCoordinates),this.options.chart.parallelAxes=m(this.options.chart.parallelAxes,a.chart.parallelAxes));this.hasParallelCoordinates&&(a.series&&this.setParallelInfo(a),this.yAxis.forEach(function(a){a.update({},!1)}))});w(d,{setParallelInfo:function(a){var c=this;a=a.series;c.parallelInfo={counter:0};a.forEach(function(a){a.data&&
(c.parallelInfo.counter=Math.max(c.parallelInfo.counter,a.data.length-1))})}});l(q,"bindAxes",function(a){if(this.chart.hasParallelCoordinates){var c=this;this.chart.axes.forEach(function(a){c.insert(a.series);a.isDirty=!0});c.xAxis=this.chart.xAxis[0];c.yAxis=this.chart.yAxis[0];a.preventDefault()}});l(q,"afterTranslate",function(){var a=this.chart,c=this.points,b=c&&c.length,h=Number.MAX_VALUE,f;if(this.chart.hasParallelCoordinates){for(f=0;f<b;f++){var e=c[f];if(r(e.y)){e.plotX=a.polar?a.yAxis[f].angleRad||
0:a.inverted?a.plotHeight-a.yAxis[f].top+a.plotTop:a.yAxis[f].left-a.plotLeft;e.clientX=e.plotX;e.plotY=a.yAxis[f].translate(e.y,!1,!0,void 0,!0);t(e.high)&&(e.plotHigh=a.yAxis[f].translate(e.high,!1,!0,void 0,!0));"undefined"!==typeof d&&(h=Math.min(h,Math.abs(e.plotX-d)));var d=e.plotX;e.isInside=a.isInsidePlot(e.plotX,e.plotY,{inverted:a.inverted})}else e.isNull=!0}this.closestPointRangePx=h}},{order:1});l(q,"destroy",function(){this.chart.hasParallelCoordinates&&(this.chart.axes||[]).forEach(function(a){a&&
a.series&&(D(a.series,this),a.isDirty=a.forceRedraw=!0)},this)});["line","spline"].forEach(function(a){E(p.seriesTypes[a].prototype.pointClass.prototype,"getLabelConfig",z)});var F=function(){function a(a){this.axis=a}a.prototype.setPosition=function(a,b){var c=this.axis,f=c.chart,e=((this.position||0)+.5)/(f.parallelInfo.counter+1);f.polar?b.angle=360*e:(b[a[0]]=100*e+"%",c[a[1]]=b[a[1]]=0,c[a[2]]=b[a[2]]=null,c[a[3]]=b[a[3]]=null)};return a}(),n;(function(a){function b(a){var b=this.chart,c=this.parallelCoordinates,
f=["left","width","height","top"];if(b.hasParallelCoordinates)if(b.inverted&&(f=f.reverse()),this.isXAxis)this.options=m(this.options,x,a.userOptions);else{var d=b.yAxis.indexOf(this);this.options=m(this.options,this.chart.options.chart.parallelAxes,a.userOptions);c.position=v(c.position,0<=d?d:b.yAxis.length);c.setPosition(f,this.options)}}function d(a){var b=this.chart,c=this.parallelCoordinates;if(c&&b&&b.hasParallelCoordinates&&!this.isXAxis){var f=c.position,d=[];this.series.forEach(function(a){a.yData&&
a.visible&&t(f)&&d.push.apply(d,u(a.yData[f]))});d=d.filter(t);this.dataMin=C(d);this.dataMax=B(d);a.preventDefault()}}function g(){this.parallelCoordinates||(this.parallelCoordinates=new F(this))}a.compose=function(a){a.keepProps.push("parallel");l(a,"init",g);l(a,"afterSetOptions",b);l(a,"getSeriesExtremes",d)}})(n||(n={}));n.compose(b);return n});g(b,"masters/modules/parallel-coordinates.src.js",[],function(){})});
//# sourceMappingURL=parallel-coordinates.js.map