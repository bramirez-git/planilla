$(function(){
    grafico_planilla_mensual();
    grafico_planilla_mensual_colaboradores();
    grafico_planilla_mensual_aguinaldos();
    grafico_ocupaciones();
    grafico_ocupaciones_INS();

    $("#filtroPlanillaMensual").on("change", function() {
        // Obtener el valor seleccionado
        var selectedValue = $(this).val();
        grafico_planilla_mensual(selectedValue);
    });
    $("#filtroUserPlanillaMensual").on("change", function() {
        // Obtener el valor seleccionado
        var selectedValue = $(this).val();
        grafico_planilla_mensual_colaboradores(selectedValue);
    });
    $("#filtroAgunaldos").on("change", function() {
        // Obtener el valor seleccionado
        var selectedValue = $(this).val();
        grafico_planilla_mensual_aguinaldos(selectedValue);
    });
});

function grafico_planilla_mensual(fecha){
    waitingDialog.loading('#container2', $('<div>', {
        'class': "bolder",
        'html':'Cargando...'
    }).prop('outerHTML'));
    $.ajax({
        url: base_path+'/grafico_planilla_mensual', // Usa la función url() de Laravel para generar la URL completa
        method: 'POST',
        data: { fecha: fecha },
        global: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
        },
        success: function (resp) {
            let resultado_anio_actual = [];
            let mesesKeys = Object.keys(resp.resultado.periodo_consulta.meses);
            // Ordenar las claves para asegurar el mismo orden
            mesesKeys.sort();
            // Iterar sobre las claves ordenadas y agregar los valores al array
            mesesKeys.forEach(function(key) {
                resultado_anio_actual.push(resp.resultado.periodo_consulta.meses[key]);
            });

            let resultado_anio_anterior = [];
            let mesesKeysAnterior = Object.keys(resp.resultado.periodo_anterior.meses);
            // Ordenar las claves para asegurar el mismo orden
            mesesKeysAnterior.sort();
            // Iterar sobre las claves ordenadas y agregar los valores al array
            mesesKeysAnterior.forEach(function(key) {
                resultado_anio_anterior.push(resp.resultado.periodo_anterior.meses[key]);
            });

            let data =Highcharts.chart('container2', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xAxis: {
                    categories: [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:15px; margin-right:120px;">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0;width:300px;">{series.name} </td>' +'</tr>'+
                        '<td style="padding:0"><b>USD: {point.y:.1f}</b></td>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: "Planilla mensual "+resp.resultado.periodo_anterior.periodo,
                    data: resultado_anio_anterior

                },
                    {
                        name: "Planilla mensual "+ resp.resultado.periodo_consulta.periodo,
                        data: resultado_anio_actual

                    }]
            });

            return data;
        },
        error: function () {
        }
    });
}

function grafico_planilla_mensual_colaboradores(fecha){
    waitingDialog.loading('#container3', $('<div>', {
        'class': "bolder",
        'html':'Cargando...'
    }).prop('outerHTML'));
    $.ajax({
        url: base_path+'/grafico_planilla_mensual_colaboradores', // Usa la función url() de Laravel para generar la URL completa
        method: 'POST',
        data: { fecha: fecha },
        global: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
        },
        success: function (resp) {
            let resultado_anio_actual = [];
            let mesesKeys = Object.keys(resp.resultado.periodo_consulta.meses);
            // Ordenar las claves para asegurar el mismo orden
            mesesKeys.sort();
            // Iterar sobre las claves ordenadas y agregar los valores al array
            mesesKeys.forEach(function(key) {
                resultado_anio_actual.push(resp.resultado.periodo_consulta.meses[key]);
            });

            let resultado_anio_anterior = [];
            let mesesKeysAnterior = Object.keys(resp.resultado.periodo_anterior.meses);
            // Ordenar las claves para asegurar el mismo orden
            mesesKeysAnterior.sort();
            // Iterar sobre las claves ordenadas y agregar los valores al array
            mesesKeysAnterior.forEach(function(key) {
                resultado_anio_anterior.push(resp.resultado.periodo_anterior.meses[key]);
            });
            let data = Highcharts.chart('container3', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xAxis: {
                    categories: [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:15px; margin-right:120px;">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0;width:300px;">{series.name} </td>' +'</tr>'+
                        '<td style="padding:0"><b>Cant: {point.y:.1f}</b></td>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                    name: "Colaboradores " + resp.resultado.periodo_anterior.periodo,
                    data: resultado_anio_anterior

                },
                    {
                    name: "Colaboradores "+ resp.resultado.periodo_consulta.periodo,
                    data: resultado_anio_actual

                }]
            });


            return data;
        },
        error: function () {
        }
    });
}

function grafico_planilla_mensual_aguinaldos(fecha){
    waitingDialog.loading('#containerAgunaldo', $('<div>', {
        'class': "bolder",
        'html':'Cargando...'
    }).prop('outerHTML'));
    $.ajax({
        url: base_path+'/grafico_planilla_mensual_aguinaldos', // Usa la función url() de Laravel para generar la URL completa
        method: 'POST',
        data: { fecha: fecha },
        global: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
        },
        success: function (resp) {
            let resultado_anio_actual = [];
            let mesesKeys = Object.keys(resp.resultado.periodo_consulta.meses);
            // Ordenar las claves para asegurar el mismo orden
            mesesKeys.sort();
            // Iterar sobre las claves ordenadas y agregar los valores al array
            mesesKeys.forEach(function(key) {
                resultado_anio_actual.push(resp.resultado.periodo_consulta.meses[key]);
            });

            let resultado_anio_anterior = [];
            let mesesKeysAnterior = Object.keys(resp.resultado.periodo_anterior.meses);
            // Ordenar las claves para asegurar el mismo orden
            mesesKeysAnterior.sort();
            // Iterar sobre las claves ordenadas y agregar los valores al array
            mesesKeysAnterior.forEach(function(key) {
                resultado_anio_anterior.push(resp.resultado.periodo_anterior.meses[key]);
            });
            resultado_anio_actual.unshift(resultado_anio_actual.pop());
            resultado_anio_anterior.unshift(resultado_anio_anterior.pop());
            let data =Highcharts.chart('containerAgunaldo', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xAxis: {
                    categories: [
                        'Diciembre',
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:15px; margin-right:120px;">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0;width:300px;">{series.name} </td>' +'</tr>'+
                        '<td style="padding:0"><b>USD: {point.y:.1f}</b></td>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: "Aguinaldos "+resp.resultado.periodo_anterior.periodo,
                    data: resultado_anio_anterior

                },
                    {
                        name: "Aguinaldos "+resp.resultado.periodo_consulta.periodo,
                        data: resultado_anio_actual

                    }]
            });

            return data;
        },
        error: function () {
        }
    });
}
function grafico_ocupaciones(){
    waitingDialog.loading('#container1129', $('<div>', {
        'class': "bolder",
        'html':'Cargando...'
    }).prop('outerHTML'));
    $.ajax({
        url: base_path+'/grafico_ocupaciones', // Usa la función url() de Laravel para generar la URL completa
        method: 'GET',
        global: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
        },
        success: function (resp) {
            var dataPoints = [];
            // Iterate through resp.resultado and create data points
            $.each(resp.resultado, function (index, item) {
                var dataPoint = [item.ocupacion,item.total_colaboradores];
                dataPoints.push(dataPoint);
            });
            let data =  Highcharts.chart('container1129', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: '',
                    align: 'left'
                },
                subtitle: {
                    text: '',
                    align: 'left'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Porcentaje',
                    data: dataPoints
                }]
            });

            return data;
        },
        error: function () {
        }
    });
}
function grafico_ocupaciones_INS(){
    waitingDialog.loading('#container4', $('<div>', {
        'class': "bolder",
        'html':'Cargando...'
    }).prop('outerHTML'));
    $.ajax({
        url: base_path+'/grafico_ocupaciones_INS', // Usa la función url() de Laravel para generar la URL completa
        method: 'GET',
        global: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
        },
        success: function (resp) {
            var dataPoints = [];
            // Iterate through resp.resultado and create data points
            $.each(resp.resultado, function (index, item) {
                var dataPoint = [item.ocupacion,item.total_colaboradores];
                dataPoints.push(dataPoint);
            });
            let data = Highcharts.chart('container4', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: '',
                    align: 'left'
                },
                subtitle: {
                    text: '',
                    align: 'left'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Porcentaje',
                    data: dataPoints
                }],
                colors: [
                    '#3498db', // Azul
                    '#2ecc71', // Verde
                    '#e74c3c', // Rojo
                    '#f39c12', // Amarillo
                    '#9b59b6', // Morado
                    '#11dab6'  // Verde azulado
                ],
            });
            return data;
        },
        error: function () {
        }
    });
}

