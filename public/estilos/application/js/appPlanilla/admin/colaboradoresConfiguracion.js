$(document).ready(function() {
    // Obtener la fecha dada (en este caso, 2023-09-13)
    var data_fecha_ingreso=$("#fechaIngreso").attr("data-fecha-ingreso");
    var fechaDada=new Date(data_fecha_ingreso);
    // Obtener el año actual
    var añoActual=new Date().getFullYear();
    // Obtener la fecha actual
    var fechaActual=new Date();
    // Calcular la diferencia en milisegundos entre las dos fechas
    var diferenciaEnMilisegundos=fechaDada-fechaActual;
    // Convertir la diferencia de milisegundos a meses
    var milisegundosEnUnMes=1000*60*60*24*30.44; // aproximadamente 30.44 días en un mes
    var diferenciaEnMeses=diferenciaEnMilisegundos/milisegundosEnUnMes;
    // Redondear la diferencia en meses si es necesario
    var diferenciaRedondeada=Math.round(diferenciaEnMeses);
    diferenciaRedondeada=Math.abs(diferenciaRedondeada);
    if(diferenciaRedondeada>=12){
        data_fecha_ingreso=new Date(añoActual, 0, 01);
    }
    // Crear una nueva fecha con el 31 de diciembre del año actual
    var fecha=new Date(añoActual, 11, 31); // El mes en JavaScript es indexado desde 0, por lo tanto, 11 representa diciembre
    // Formatear la fecha si es necesario
    var formatoFecha=fecha.getFullYear()+'-'+(fecha.getMonth()+1).toString().padStart(2, '0')+'-'+fecha.getDate().toString().padStart(2, '0');
    var fechaActual=new Date(formatoFecha);
    // Definir la fecha de inicio
    var fechaInicio=new Date(data_fecha_ingreso); // Cambia '2023-01-01' a tu fecha de inicio estática
    // Crear un array para almacenar los nombres de los meses
    var meses=[];
    // Iterar desde la fecha de inicio hasta la fecha actual y agregar los nombres de los meses al array
    for(var d=fechaInicio; d<=fechaActual; d.setMonth(d.getMonth()+1)){
        var mes=d.toLocaleDateString('es-ES', {month: 'long'});
        meses.push(mes);
    }
    // Obtener el contenedor donde se agregarán los meses
    var contenedor=$("#contenedorMeses");
    var contenedor_renta=$("#contenedor_renta");
    // Limpiar el contenedor antes de agregar nuevos meses
    contenedor.empty();
    contenedor_renta.empty();
    if(diferenciaRedondeada>=12){
        var mesCapitalizado = mes.charAt(0).toUpperCase() + mes.slice(1);
        var nuevoBloque=`
          <input type="hidden" name="historico_aguinaldo[-1][anio]" value="${añoActual-1}"/>
          <input type="hidden" name="historico_aguinaldo[-1][mes]" value="${mes}"/>
         <div class="col-md-6 col-sm-12 text-md-left mt-2">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> ${mesCapitalizado} ${añoActual-1}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" data-aguinaldo-mes="${mes}_${añoActual-1}_aguinaldo" id="${mes}_${añoActual-1}_aguinaldo" name="historico_aguinaldo[-1][monto]">
                </div>
            </div>`;
        // Agregar el nuevo bloque al contenedor
        contenedor.append(nuevoBloque);
    }
    meses.forEach(function(mes, index){
        var mesCapitalizado = mes.charAt(0).toUpperCase() + mes.slice(1);
        var nuevoBloque=`
          <input type="hidden" name="historico_aguinaldo[${index}][anio]" value="${añoActual}"/>
          <input type="hidden" name="historico_aguinaldo[${index}][mes]" value="${mes}"/>
         <div class="col-md-6 col-sm-12 text-md-left mt-2">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> ${mesCapitalizado} ${añoActual}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" data-aguinaldo-mes="${mes}_${añoActual}_aguinaldo" id="${mes}_${añoActual}_aguinaldo" name="historico_aguinaldo[${index}][monto]">
                </div>
            </div>`;
        var nuevoBloqueRenta=`
          <input type="hidden" name="historico_aguinaldo[${index}][anio]" value="${añoActual}"/>
          <input type="hidden" name="historico_aguinaldo[${index}][mes]" value="${mes}"/>
         <div class="col-md-6 col-sm-12 text-md-left mt-2">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0"> ${mesCapitalizado} ${añoActual}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" data-renta-mes="${mes}_${añoActual}_renta" id="${mes}_${añoActual}_renta" name="historico_aguinaldo[${index}][monto]">
                </div>
            </div>`;
        // Agregar el nuevo bloque al contenedor
        contenedor.append(nuevoBloque);
        contenedor_renta.append(nuevoBloqueRenta);
        // Si hemos alcanzado 6 elementos en la columna de la izquierda, empezamos a llenar la columna de la derecha
    });
    $('#frm-historico-aguinaldo input[name="anio"]').val(añoActual);
    var jsonAuxiliares = decodeEntities($('#frm-historico-aguinaldo input#auxiliares').val());
    var auxiliares = JSON.parse(jsonAuxiliares);
    // Obtén los IDs de los elementos de entrada del formulario usando jQuery
    var data_aguinaldo_mes = $('#frm-historico-aguinaldo input').map(function() {
        return $(this).attr('data-aguinaldo-mes');
    }).get();
    var data_renta_mes = $('#frm-historico-renta input').map(function() {
        return $(this).attr('data-renta-mes');
    }).get();

    var regex = /^(enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre)_(\d{4})_(aguinaldo|renta)$/;
    $.each(data_aguinaldo_mes, function(index, elemento) {
        if (regex.test(elemento)) {
            let matches = elemento.match(regex);
            let mes = matches[1];
            let año = matches[2];
            let identificador = matches[3];

            let resultado = $.grep(auxiliares, function(auxiliar) {
                return auxiliar.mes === parseInt(mesToNumber(mes)) && auxiliar.anio === parseInt(año) && auxiliar.tipo === identificador;
            });

            if (resultado.length > 0) {
                $('#'+elemento).val(resultado[0].monto);
            }
        }
    });
    $.each(data_renta_mes, function(index, elemento) {
        if (regex.test(elemento)) {
            let matches = elemento.match(regex);
            let mes = matches[1];
            let año = matches[2];
            let identificador = matches[3];
            let resultado = $.grep(auxiliares, function(auxiliar) {
                return auxiliar.mes === parseInt(mesToNumber(mes)) && auxiliar.anio === parseInt(año) && auxiliar.tipo === identificador;
            });

            if (resultado.length > 0) {
                $('#'+elemento).val(resultado[0].monto);
            }
        }
    });

    function mesToNumber(mes) {
        var meses = {
            'enero': 1,
            'febrero': 2,
            'marzo': 3,
            'abril': 4,
            'mayo': 5,
            'junio': 6,
            'julio': 7,
            'agosto': 8,
            'septiembre': 9,
            'octubre': 10,
            'noviembre': 11,
            'diciembre': 12
        };
        return meses[mes.toLowerCase()];
    }
    $('#btn-historico').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        $('#cargando').modal('show');
        // Obtén el formulario por su ID
        var formulario=$('#frm-historico-aguinaldo');
        // Envía el formulario
        formulario.submit();
    });
    $('#btn-h-renta').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        $('#cargando').modal('show');
        // Obtén el formulario por su ID
        var formulario=$('#frm-historico-renta');
        // Envía el formulario
        formulario.submit();
    });
    $('#btn-h-vacaciones').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        $('#cargando').modal('show');
        // Obtén el formulario por su ID
        var formulario=$('#frm-historico-vaciones');
        // Envía el formulario
        formulario.submit();
    });
    $('.link-registro-fecha-ingreso').click(function(e){
        e.preventDefault(); // Evita la acción predeterminada del enlace
        $('#cargando').modal('show');
        var formulario=$('#frm-link-date-ingreso');
        // Envía el formulario
        formulario.submit();
    });
    $('.frm-historico .number-input').on('keydown', function (evt) {
        // Lógica del evento keydown aquí
        !/(^\d*\.?\d*$)|(Backspace|Control|Meta)/.test(evt.key) && evt.preventDefault();

        if ($(this).val().includes(".")) {
            var key = evt.keyCode || evt.which;

            if (key === 110 || key === 190 || key === 188) {
                evt.preventDefault();
            }
        }
    });
    function decodeEntities(encodedString) {
        var textArea = document.createElement('textarea');
        textArea.innerHTML = encodedString;
        return textArea.value;
    }
});
