$(document).ready(function() {
    var frmVacaciones= $('#frm-colaboradores-vacaciones');
    frmVacaciones.validate({
        rules: {
            'vacaciones[factor1][rango-from]': {
                required: true,
                number: true,
                lessThan: '#rango-uno-to'
            },
            'vacaciones[factor1][rango-to]': {
                required: true,
                number: true,
                greaterThan: '#rango-uno-from'
            },
            'vacaciones[factor2][rango-from]': {
                required: true,
                number: true,
                lessThan: '#rango-dos-to',
                greaterThanLat:'#rango-uno-to'
            },
            'vacaciones[factor2][rango-to]': {
                required: true,
                number: true,
                greaterThan: '#rango-dos-from'
            },
            'vacaciones[factor3][rango-from]': {
                required: true,
                number: true,
                lessThan: '#rango-tres-to',
                greaterThanLat:'#rango-dos-to',
            },
            'vacaciones[factor3][rango-to]': {
                required: true,
                number: true,
                greaterThan: '#rango-tres-from'
            },
            'vacaciones[factor4][rango-from]': {
                required: true,
                number: true,
                lessThan: '#rango-cuatro-to',
                greaterThanLat:'#rango-tres-to',
            },
            'vacaciones[factor4][rango-to]': {
                required: true,
                number: true,
                greaterThan: '#rango-cuatro-from'
            },
            'vacaciones[factor1][factor]': {
                required: true,
                number: true,
                min: 0,
            },
            'vacaciones[factor2][factor]': {
                required: true,
                number: true,
                min: 0,
            },
            'vacaciones[factor3][factor]': {
                required: true,
                number: true,
                min: 0,
            },
            'vacaciones[factor4][factor]': {
                required: true,
                number: true,
                min: 0,
            }
        },
        messages: {
            'vacaciones[factor1][rango-from]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                lessThan: 'El valor debe ser menor al rango Final.'
            },
            'vacaciones[factor1][rango-to]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                greaterThan: 'El valor debe ser mayor al rango Inicial.'
            },
            'vacaciones[factor2][rango-from]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                lessThan: 'El valor debe ser menor al rango Final.',
                greaterThanLat: 'El valor debe ser mayor o igual al numero final del rango anterior',
            },
            'vacaciones[factor2][rango-to]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                greaterThan: 'El valor debe ser mayor al rango Inicial.',
            },
            'vacaciones[factor3][rango-from]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                lessThan: 'El valor debe ser menor al rango Final.',
                greaterThanLat: 'El valor debe ser mayor o igual al numero final del rango anterior',
            },
            'vacaciones[factor3][rango-to]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                greaterThan: 'El valor debe ser mayor al rango Inicial.'
            },
            'vacaciones[factor4][rango-from]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                lessThan: 'El valor debe ser menor al rango Final.',
                greaterThanLat: 'El valor debe ser mayor o igual al numero final del rango anterior',
            },
            'vacaciones[factor4][rango-to]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                greaterThan: 'El valor debe ser mayor al rango Inicial.'
            },
            'vacaciones[factor1][factor]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                min: "Por favor, digite un valor mayor o igual a 0.",
            },
            'vacaciones[factor2][factor]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                min: "Por favor, digite un valor mayor o igual a 0.",
            },
            'vacaciones[factor3][factor]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                min: "Por favor, digite un valor mayor o igual a 0.",
            },
            'vacaciones[factor4][factor]': {
                required: 'Este campo es requerido.',
                number: 'Por favor, digite un valor número válido.',
                min: "Por favor, digite un valor mayor o igual a 0.",
            }
        },
        errorPlacement: function (error, element) {
            // Insertar errores y agregar campo a la lista si aún no está presente
            if (element.hasClass("form-control")) {
                error.insertAfter(element.closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        },
    });

// Agregar la regla de validación personalizada
    $.validator.addMethod('greaterThan', function (value, element, param) {
        var target = $(param);
        return target.val() === '' || parseFloat(value) > parseFloat(target.val());
    }, 'El valor debe ser mayor al rango Inicial.');

    // Agregar la regla de validación personalizada
    $.validator.addMethod('greaterThanLat', function (value, element, param) {
        var target = $(param);
        return target.val() === '' || parseFloat(value) >= parseFloat(target.val());
    }, 'El valor debe ser mayor o igual al numero final del rango anterior.');


    $.validator.addMethod('lessThan', function (value, element, param) {
        var target = $(param);
        return target.val() === '' || parseFloat(value) < parseFloat(target.val());
    }, 'El valor debe ser menor al rango Final.');


    if ($('.number-input').length) {

        var numberInput = document.getElementsByClassName('number-input');

        for(var i = 0; i < numberInput.length; i++){
            numberInput[i].addEventListener('keydown', function (evt) {
                !/(^\d*\.?\d*$)|(Backspace|Control|Meta)/.test(evt.key) && evt.preventDefault();

                if($(this).val().includes("."))
                {
                    var e = evt || window.evt;
                    var key = e.keyCode || e.which;

                    if ( key === 110 || key === 190 || key === 188 ) {

                        evt.preventDefault();
                    }
                }
            });
        }
    }

    $("#registrarVcaciones").on('click', function(evt){
        if(frmVacaciones.valid()){
           waitingDialog.show();
            frmVacaciones.submit();
        }else{
            return false;
        }
    });

});
