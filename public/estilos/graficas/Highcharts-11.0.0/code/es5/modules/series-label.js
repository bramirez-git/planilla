/*
 Highcharts JS v11.0.0 (2023-04-26)

 (c) 2009-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
'use strict';(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/modules/series-label",["highcharts"],function(t){a(t);a.Highcharts=t;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function t(a,l,A,k){a.hasOwnProperty(l)||(a[l]=k.apply(null,A),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:l,module:a[l]}})))}a=a?
a._modules:{};t(a,"Extensions/SeriesLabel/SeriesLabelDefaults.js",[],function(){return{enabled:!0,connectorAllowed:!1,connectorNeighbourDistance:24,format:void 0,formatter:void 0,minFontSize:null,maxFontSize:null,onArea:null,style:{fontSize:"0.8em",fontWeight:"bold"},useHTML:!1,boxesToAvoid:[]}});t(a,"Extensions/SeriesLabel/SeriesLabelUtilities.js",[],function(){function a(a,k,l,u,d,v){a=(v-k)*(l-a)-(u-k)*(d-a);return 0<a?!0:!(0>a)}function l(A,k,l,u,d,v,y,z){return a(A,k,d,v,y,z)!==a(l,u,d,v,y,z)&&
a(A,k,l,u,d,v)!==a(A,k,l,u,y,z)}return{boxIntersectLine:function(a,k,t,u,d,v,y,z){return l(a,k,a+t,k,d,v,y,z)||l(a+t,k,a+t,k+u,d,v,y,z)||l(a,k+u,a+t,k+u,d,v,y,z)||l(a,k,a,k+u,d,v,y,z)},intersectRect:function(a,k){return!(k.left>a.right||k.right<a.left||k.top>a.bottom||k.bottom<a.top)}}});t(a,"Extensions/SeriesLabel/SeriesLabel.js",[a["Core/Animation/AnimationUtilities.js"],a["Core/Chart/Chart.js"],a["Core/FormatUtilities.js"],a["Core/Defaults.js"],a["Extensions/SeriesLabel/SeriesLabelDefaults.js"],
a["Extensions/SeriesLabel/SeriesLabelUtilities.js"],a["Core/Utilities.js"]],function(a,l,t,k,N,u,d){function v(c,a,f,b,g){var h=c.chart,F=c.options.label||{},B=C(F.onArea,!!c.area),m=B||F.connectorAllowed,e=h.boxesToAvoid,D=Number.MAX_VALUE,k=Number.MAX_VALUE,q,d,l;for(l=0;e&&l<e.length;l+=1)if(O(e[l],{left:a,right:a+b.width,top:f,bottom:f+b.height}))return!1;for(l=0;l<h.series.length;l+=1){var n=h.series[l];e=n.interpolatedPoints&&P([],n.interpolatedPoints,!0);if(n.visible&&e){var p=h.plotHeight/
10;for(d=h.plotTop;d<=h.plotTop+h.plotHeight;d+=p)e.unshift({chartX:h.plotLeft,chartY:d}),e.push({chartX:h.plotLeft+h.plotWidth,chartY:d});for(p=1;p<e.length;p+=1){if(e[p].chartX>=a-16&&e[p-1].chartX<=a+b.width+16){if(I(a,f,b.width,b.height,e[p-1].chartX,e[p-1].chartY,e[p].chartX,e[p].chartY))return!1;c===n&&!q&&g&&(q=I(a-16,f-16,b.width+32,b.height+32,e[p-1].chartX,e[p-1].chartY,e[p].chartX,e[p].chartY))}if((m||q)&&(c!==n||B)){d=a+b.width/2-e[p].chartX;var x=f+b.height/2-e[p].chartY;D=Math.min(D,
d*d+x*x)}}if(!B&&m&&c===n&&(g&&!q||D<Math.pow(F.connectorNeighbourDistance||1,2))){for(p=1;p<e.length;p+=1)if(q=Math.min(Math.pow(a+b.width/2-e[p].chartX,2)+Math.pow(f+b.height/2-e[p].chartY,2),Math.pow(a-e[p].chartX,2)+Math.pow(f-e[p].chartY,2),Math.pow(a+b.width-e[p].chartX,2)+Math.pow(f-e[p].chartY,2),Math.pow(a+b.width-e[p].chartX,2)+Math.pow(f+b.height-e[p].chartY,2),Math.pow(a-e[p].chartX,2)+Math.pow(f+b.height-e[p].chartY,2)),q<k){k=q;var v=e[p]}q=!0}}}return!g||q?{x:a,y:f,weight:D-(v?k:0),
connectorPoint:v}:!1}function y(a){a.boxesToAvoid=[];var B=a.labelSeries||[],c=a.boxesToAvoid;a.series.forEach(function(b){return(b.points||[]).forEach(function(a){return(a.dataLabels||[]).forEach(function(a){var g=a.getBBox(),h=a.translateX+(b.xAxis?b.xAxis.pos:b.chart.plotLeft);a=a.translateY+(b.yAxis?b.yAxis.pos:b.chart.plotTop);c.push({left:h,top:a,right:h+g.width,bottom:a+g.height})})})});B.forEach(function(b){var a=b.options.label||{};b.interpolatedPoints=z(b);c.push.apply(c,a.boxesToAvoid||
[])});a.series.forEach(function(b){function g(b,a,c){var e=Math.max(d,C(u,-Infinity)),h=Math.min(d+l,C(y,Infinity));return b>e&&b<=h-c.width&&a>=q&&a<=q+k-c.height}var h=b.options.label;if(h&&(b.xAxis||b.yAxis)){var c="highcharts-color-"+C(b.colorIndex,"none"),B=!b.labelBySeries,m=h.minFontSize,e=h.maxFontSize,f=a.inverted,d=f?b.yAxis.pos:b.xAxis.pos,q=f?b.xAxis.pos:b.yAxis.pos,l=a.inverted?b.yAxis.len:b.xAxis.len,k=a.inverted?b.xAxis.len:b.yAxis.len,n=b.interpolatedPoints,p=C(h.onArea,!!b.area),
x=[],t=b.xData||[],r,w=b.labelBySeries;if(p&&!f){f=[b.xAxis.toPixels(t[0]),b.xAxis.toPixels(t[t.length-1])];var u=Math.min.apply(Math,f);var y=Math.max.apply(Math,f)}if(b.visible&&!b.boosted&&n){w||(w=b.name,"string"===typeof h.format?w=Q(h.format,b,a):h.formatter&&(w=h.formatter.call(b)),b.labelBySeries=w=a.renderer.label(w,0,0,"connector",0,0,h.useHTML).addClass("highcharts-series-label highcharts-series-label-"+b.index+" "+(b.options.className||"")+" "+c),a.renderer.styledMode||(c="string"===typeof b.color?
b.color:"#666666",w.css(J({color:p?a.renderer.getContrast(c):c},h.style||{})),w.attr({opacity:a.renderer.forExport?1:0,stroke:b.color,"stroke-width":1})),m&&e&&w.css({fontSize:m+(b.sum||0)/(b.chart.labelSeriesMaxSum||0)*(e-m)+"px"}),w.attr({padding:0,zIndex:3}).add());m=w.getBBox();m.width=Math.round(m.width);for(f=n.length-1;0<f;--f)p?(e=n[f].chartX-m.width/2,c=(n[f].chartCenterY||0)-m.height/2,g(e,c,m)&&(r=v(b,e,c,m))):(e=n[f].chartX+3,c=n[f].chartY-m.height-3,g(e,c,m)&&(r=v(b,e,c,m,!0)),r&&x.push(r),
e=n[f].chartX+3,c=n[f].chartY+3,g(e,c,m)&&(r=v(b,e,c,m,!0)),r&&x.push(r),e=n[f].chartX-m.width-3,c=n[f].chartY+3,g(e,c,m)&&(r=v(b,e,c,m,!0)),r&&x.push(r),e=n[f].chartX-m.width-3,c=n[f].chartY-m.height-3,g(e,c,m)&&(r=v(b,e,c,m,!0))),r&&x.push(r);if(h.connectorAllowed&&!x.length&&!p)for(e=d+l-m.width;e>=d;e-=16)for(c=q;c<q+k-m.height;c+=16)(r=v(b,e,c,m,!0))&&x.push(r);if(x.length){if(x.sort(function(b,a){return a.weight-b.weight}),r=x[0],(a.boxesToAvoid||[]).push({left:r.x,right:r.x+m.width,top:r.y,
bottom:r.y+m.height}),(n=Math.sqrt(Math.pow(Math.abs(r.x-(w.x||0)),2)+Math.pow(Math.abs(r.y-(w.y||0)),2)))&&b.labelBySeries&&(x={opacity:a.renderer.forExport?1:0,x:r.x,y:r.y},h={opacity:1},10>=n&&(h={x:x.x,y:x.y},x={}),n=void 0,B&&(n=G(b.options.animation),n.duration*=.2),b.labelBySeries.attr(J(x,{anchorX:r.connectorPoint&&(r.connectorPoint.plotX||0)+d,anchorY:r.connectorPoint&&(r.connectorPoint.plotY||0)+q})).animate(h,n),b.options.kdNow=!0,b.buildKDTree(),b=b.searchPoint({chartX:r.x,chartY:r.y},
!0)))w.closest=[b,r.x-(b.plotX||0),r.y-(b.plotY||0)]}else w&&(b.labelBySeries=w.destroy())}else w&&(b.labelBySeries=w.destroy())}});R(a,"afterDrawSeriesLabels")}function z(a){function c(a){var e=Math.round((a.plotX||0)/8)+","+Math.round((a.plotY||0)/8);v[e]||(v[e]=1,b.push(a))}if(a.xAxis||a.yAxis){var f=a.points,b=[],g=a.graph||a.area,h=g&&g.element,d=a.chart.inverted,l=a.xAxis,m=a.yAxis,e=d?m.pos:l.pos;d=d?l.pos:m.pos;l=C((a.options.label||{}).onArea,!!a.area);var k=m.getThreshold(a.options.threshold),
v={};if(a.getPointSpline&&h&&h.getPointAtLength&&!l&&f.length<(a.chart.plotSizeX||0)/16){l=g.toD&&g.attr("d");g.toD&&g.attr({d:g.toD});m=h.getTotalLength();for(a=0;a<m;a+=16)k=h.getPointAtLength(a),c({chartX:e+k.x,chartY:d+k.y,plotX:k.x,plotY:k.y});l&&g.attr({d:l});var q=f[f.length-1];c({chartX:e+(q.plotX||0),chartY:d+(q.plotY||0)})}else for(m=f.length,g=void 0,a=0;a<m;a+=1){q=f[a];h=q.plotX;var t=q.plotY;if(E(h)&&E(t)){var u={plotX:h,plotY:t,chartX:e+h,chartY:d+t};l&&(u.chartCenterY=d+(t+C(q.yBottom,
k))/2);if(g){q=Math.abs(u.chartX-g.chartX);var n=Math.abs(u.chartY-g.chartY);q=Math.max(q,n);if(16<q)for(q=Math.ceil(q/16),n=1;n<q;n+=1)c({chartX:g.chartX+n/q*(u.chartX-g.chartX),chartY:g.chartY+n/q*(u.chartY-g.chartY),chartCenterY:(g.chartCenterY||0)+n/q*((u.chartCenterY||0)-(g.chartCenterY||0)),plotX:(g.plotX||0)+n/q*(h-(g.plotX||0)),plotY:(g.plotY||0)+n/q*(t-(g.plotY||0))})}c(u);g=u}}return b}}function A(a){if(this.renderer){var c=this,f=G(c.renderer.globalAnimation).duration;c.labelSeries=[];
c.labelSeriesMaxSum=0;c.seriesLabelTimer&&d.clearTimeout(c.seriesLabelTimer);c.series.forEach(function(b){var g=b.options.label||{},h=b.labelBySeries,d=h&&h.closest;g.enabled&&b.visible&&(b.graph||b.area)&&!b.boosted&&c.labelSeries&&(c.labelSeries.push(b),g.minFontSize&&g.maxFontSize&&b.yData&&(b.sum=b.yData.reduce(function(a,b){return(a||0)+(b||0)},0),c.labelSeriesMaxSum=Math.max(c.labelSeriesMaxSum||0,b.sum||0)),"load"===a.type&&(f=Math.max(f,G(b.options.animation).duration)),d&&("undefined"!==
typeof d[0].plotX?h.animate({x:d[0].plotX+d[1],y:d[0].plotY+d[2]}):h.attr({opacity:0})))});c.seriesLabelTimer=S(function(){c.series&&c.labelSeries&&y(c)},c.renderer.forExport||!f?0:f)}}function M(a,d,f,b,g){var c=g&&g.anchorX;g=g&&g.anchorY;var l=f/2;if(E(c)&&E(g)){var k=[["M",c,g]];var m=d-g;0>m&&(m=-b-m);m<f&&(l=c<a+f/2?m:f-m);g>d+b?k.push(["L",a+l,d+b]):g<d?k.push(["L",a+l,d]):c<a?k.push(["L",a,d+b/2]):c>a+f&&k.push(["L",a+f,d+b/2])}return k||[]}var P=this&&this.__spreadArray||function(a,d,f){if(f||
2===arguments.length)for(var b=0,c=d.length,h;b<c;b++)!h&&b in d||(h||(h=Array.prototype.slice.call(d,0,b)),h[b]=d[b]);return a.concat(h||Array.prototype.slice.call(d))},G=a.animObject,Q=t.format,K=k.setOptions,I=u.boxIntersectLine,O=u.intersectRect,L=d.addEvent,J=d.extend,R=d.fireEvent,E=d.isNumber,C=d.pick,S=d.syncTimeout,H=[];"";return{compose:function(a,k){d.pushUnique(H,a)&&(L(l,"load",A),L(l,"redraw",A));d.pushUnique(H,k)&&(k.prototype.symbols.connector=M);d.pushUnique(H,K)&&K({plotOptions:{series:{label:N}}})}}});
t(a,"masters/modules/series-label.src.js",[a["Core/Globals.js"],a["Extensions/SeriesLabel/SeriesLabel.js"]],function(a,l){l.compose(a.Chart,a.SVGRenderer)})});
//# sourceMappingURL=series-label.js.map