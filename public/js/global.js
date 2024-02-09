
// Función global para mostrar un toast con SweetAlert2 Éxito
function mostrarAlertaExito(message='', position = 'top', duration = 3000) {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: 'success',
        title: 'Éxito!',
        text: message
    });
}

// Función global para mostrar un toast con SweetAlert2 Error
function mostrarAlertaError(mensaje1="",mensaje2='', position = 'top', duration = 3000) {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: 'error',
        title: 'Error!',
        html: mensaje1 + '<br><br>' + mensaje2,
    });
}


// Función global para mostrar un toast con SweetAlert2 Éxito
function mostrarAlertaWarning(message='', position = 'top', duration = 3000) {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: 'warning',
        title: 'Advertencia!',
        text: message
    });
}

/**
 * Muestra una alerta personalizada en la interfaz de usuario.
 *
 * @param {string} tipo - El tipo de alerta ('success', 'info', 'warning').
 * @param {string} mensaje - El mensaje que se mostrará en la alerta.
 */

function ui_alert(tipo, mensaje) {
    var icono, iconoClase, titulo, clase, retraso;

    if (tipo === 'success') {
        icono = '<i class="text-green mr-2 text-130">\
                    <i class="fas fa-exclamation-circle mt-25 fa-2x text-green"></i>\
                   </i>';
        iconoClase = 'mt-3';
        titulo = 'Proceso Exitoso!';
        clase = 'bgc-white-tp1 border-none border-t-4 brc-success-tp1 rounded-sm pl-3 pr-1';
        retraso = 8000;
    }
    else if (tipo === 'info') {
        icono = '<i class="text-blue mr-2 text-130">\
                    <i class="fas fa-info-circle mt-25 fa-2x text-blue"></i>\
                 </i>';
        iconoClase = 'mt-3';
        titulo = 'Información';
        clase = 'bgc-white-tp1 border-none border-t-4 brc-primary-tp1 rounded-sm pl-3 pr-1';
        retraso = 8000;
    } else if (tipo === 'warning') {
        icono = '<i class="text-yellow mr-2 text-130">\
                    <i class="fas fa-exclamation-triangle mt-25 fa-2x text-yellow"></i>\
                 </i>';
        iconoClase = 'mt-3';
        titulo = 'Advertencia';
        clase = 'bgc-white-tp1 border-none border-t-4 brc-warning-tp1 rounded-sm pl-3 pr-1';
        retraso = 8000;
    } else {
        // Tipo de mensaje desconocido, manejar según necesidad
        return;
    }

    $.aceToaster.add({
        placement: 'tc',
        title: titulo,
        body: mensaje,
        icon: icono,
        iconClass: iconoClase,
        delay: retraso,
        closeClass: 'btn btn-light-danger border-0 btn-bgc-tp btn-xs px-2 py-0 text-150 position-tr mt-n25',
        className: clase,
        headerClass: 'bg-transparent border-0 text-120 font-bolder mt-3',
        bodyClass: 'pt-0 pb-3 text-105'
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function cantones()
{
    let provincia = $("#provincia").val();

    $.ajax({
        type:'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: base_path + "/obtenerCantones",
        data: { "provincia": provincia},
        global:false,
        success: (response) => {
            $( "#cantones" ).html(response);
            distritos();
        },
        error: function(response){
            alert(response.responseJSON.message);
        }
    });
}

function distritos()
{
    let provincia = $("#provincia").val();
    let canton = $("#canton").val();

    $.ajax({
        type:'POST',
        url: base_path + "/obtenerDistritos",
        data: { "provincia": provincia,"canton": canton},
        global:false,
        success: (response) => {
            $( "#distritos" ).html(response);
            barrios();
        },
        error: function(response){
            alert(response.responseJSON.message);
        }
    });
}

function barrios()
{
    let provincia = $("#provincia").val();
    let canton = $("#canton").val();
    let distrito = $("#distrito").val();

    $.ajax({
        type:'POST',
        url: base_path + "/obtenerBarrios",
        data: { "provincia": provincia,"canton": canton,"distrito": distrito},
        global:false,
        success: (response) => {
            $( "#barrios" ).html(response);
        },
        error: function(response){
            alert(response.responseJSON.message);
        }
    });
}


var fn_reload = function () {
    "use strict";
    waitingDialog.show();
    window.location.reload();
};

async function exportarDatosComoZIP() {
    const zip = new JSZip();
    // Recopilar datos de las filas con casillas de verificación activas y agregarlos al archivo ZIP
    $('#simple-table tbody tr').each(function(index) {
        const checkbox = $(this).find('td input[type="checkbox"]');
        if (checkbox.prop('checked')) {
            const rowData = [];
            $(this).find('td').each(function() {
                rowData.push($(this).text());
            });
            zip.file(`datos_${index}.txt`, rowData.join('\t'));
        }
    });

    try {
        // Generar el archivo ZIP
        const content = await zip.generateAsync({ type: 'blob' });
        // Crear un objeto URL y un enlace para descargar el archivo
        const url = URL.createObjectURL(content);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'datos.zip';
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    } catch (error) {
        console.error('Error al generar el archivo ZIP:', error);
    }
}

/**
 * Misma función que su homónimo en PHP
 * @param val
 * @returns {boolean}
 */
function is_numeric(val){
    return (!isNaN(val) && isFinite(parseFloat(val)));
}

function setupNumberInputValidation() {
    if ($('.number-input').length) {
        var numberInput = document.getElementsByClassName('number-input');

        for (var i = 0; i < numberInput.length; i++) {
            numberInput[i].addEventListener('keydown', function (evt) {
                !/(^\d*\.?\d*$)|(Backspace|Control|Meta)/.test(evt.key) && evt.preventDefault();

                if ($(this).val().includes(".")) {
                    var e = evt || window.evt;
                    var key = e.keyCode || e.which;

                    if (key === 110 || key === 190 || key === 188) {
                        evt.preventDefault();
                    }
                }
            });
        }
    }
}

function obtenerMesYAno() {
    var fecha = new Date();
    // Opciones de formato para obtener el nombre del mes completo
    var options = { month: 'long' };

    // Obtiene el nombre del mes actual
    var nombreMes = fecha.toLocaleDateString('es-ES', options);

    // Obtiene el año actual
    var ano = fecha.getFullYear();

    // Devuelve un objeto con el nombre del mes y el año
    return {
        nombreMes: nombreMes,
        ano: ano
    };
}

function manejarKeyup() {
    var $t = $(this);
    var value = $t.val();

    // Verifica si el valor completo es un número
    if (!/^\d+$/.test(value)) {
        // Si no es un número, elimina los caracteres no numéricos
        value = value.replace(/[^\d]/g, '');
    }

    $t.val(value);
}

function SetCaptchaToken(action){
    grecaptcha.execute(reCAPTCHA_site_key_cliente, {action: action}).then(function (token) {
        $('#g-recaptcha-response').val(token);
    }, false);
}

