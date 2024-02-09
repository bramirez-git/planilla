
//Funcion para mensajes de exito
function MensajeExito(mensaje) {
    $.aceToaster.add({
        placement: 'tc',
        title: 'Proceso Exitoso!',
        body: mensaje,

        icon: '<i class="text-green mr-2 text-130">\
                    <i class="fas fa-exclamation-circle mt-25 fa-2x text-green"></i>\
                   </i>',
        iconClass: 'mt-3',

        delay: 8000,

        closeClass: 'btn btn-light-danger border-0 btn-bgc-tp btn-xs px-2 py-0 text-150 position-tr mt-n25',

        className: 'bgc-white-tp1 border-none border-t-4 brc-success-tp1 rounded-sm pl-3 pr-1',
        headerClass: 'bg-transparent border-0 text-120 text-green-d3 font-bolder mt-3',
        bodyClass: 'pt-0 pb-3 text-105'
    })
}

//Funcion para mensajes de exito
function MensajeError(mensaje1,mensaje2) {

    $.aceToaster.add({
        placement: 'tc',
        title: 'Error!',
        body: mensaje1+'<br><br>'+mensaje2,

        icon: '<i class="text-danger-d1 mr-2 text-130">\
                    <i class="fas fa-times mt-25 fa-2x text-danger"></i>\
                   </i>',
        iconClass: 'mt-3',

        delay: 8000,

        closeClass: 'btn btn-light-danger border-0 btn-bgc-tp btn-xs px-2 py-0 text-150 position-tr mt-n25',

        className: 'bgc-white-tp1 border-none border-t-4 brc-danger-tp1 rounded-sm pl-3 pr-1',
        headerClass: 'bg-transparent border-0 text-120 text-danger-d3 font-bolder mt-3',
        bodyClass: 'pt-0 pb-3 text-105'
    })
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
        url: "/obtenerCantones",
        data: { "provincia": provincia},
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
        url: "/obtenerDistritos",
        data: { "provincia": provincia,"canton": canton},
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
        url: "/obtenerBarrios",
        data: { "provincia": provincia,"canton": canton,"distrito": distrito},
        success: (response) => {
            $( "#barrios" ).html(response);
        },
        error: function(response){
            alert(response.responseJSON.message);
        }
    });
}



//Funcion para mensajes de exito
function MensajeExito(mensaje) {
    $.aceToaster.add({
        placement: 'tc',
        title: 'Proceso Exitoso!',
        body: mensaje,

        icon: '<i class="text-green mr-2 text-130">\
                    <i class="fas fa-exclamation-circle mt-25 fa-2x text-green"></i>\
                   </i>',
        iconClass: 'mt-3',

        delay: 8000,

        closeClass: 'btn btn-light-danger border-0 btn-bgc-tp btn-xs px-2 py-0 text-150 position-tr mt-n25',

        className: 'bgc-white-tp1 border-none border-t-4 brc-success-tp1 rounded-sm pl-3 pr-1',
        headerClass: 'bg-transparent border-0 text-120 text-green-d3 font-bolder mt-3',
        bodyClass: 'pt-0 pb-3 text-105'
    })
}

//Funcion para mensajes de exito
function MensajeError(mensaje1,mensaje2) {

    $.aceToaster.add({
        placement: 'tc',
        title: 'Error!',
        body: mensaje1+'<br><br>'+mensaje2,

        icon: '<i class="text-danger-d1 mr-2 text-130">\
                    <i class="fas fa-times mt-25 fa-2x text-danger"></i>\
                   </i>',
        iconClass: 'mt-3',

        delay: 8000,

        closeClass: 'btn btn-light-danger border-0 btn-bgc-tp btn-xs px-2 py-0 text-150 position-tr mt-n25',

        className: 'bgc-white-tp1 border-none border-t-4 brc-danger-tp1 rounded-sm pl-3 pr-1',
        headerClass: 'bg-transparent border-0 text-120 text-danger-d3 font-bolder mt-3',
        bodyClass: 'pt-0 pb-3 text-105'
    })
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
        url: "/obtenerCantones",
        data: { "provincia": provincia},
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
        url: "/obtenerDistritos",
        data: { "provincia": provincia,"canton": canton},
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
        url: "/obtenerBarrios",
        data: { "provincia": provincia,"canton": canton,"distrito": distrito},
        success: (response) => {
            $( "#barrios" ).html(response);
        },
        error: function(response){
            alert(response.responseJSON.message);
        }
    });
}



//Funcion para mensajes de exito
function MensajeExito(mensaje) {
    $.aceToaster.add({
        placement: 'tc',
        title: 'Proceso Exitoso!',
        body: mensaje,

        icon: '<i class="text-green mr-2 text-130">\
                    <i class="fas fa-exclamation-circle mt-25 fa-2x text-green"></i>\
                   </i>',
        iconClass: 'mt-3',

        delay: 8000,

        closeClass: 'btn btn-light-danger border-0 btn-bgc-tp btn-xs px-2 py-0 text-150 position-tr mt-n25',

        className: 'bgc-white-tp1 border-none border-t-4 brc-success-tp1 rounded-sm pl-3 pr-1',
        headerClass: 'bg-transparent border-0 text-120 text-green-d3 font-bolder mt-3',
        bodyClass: 'pt-0 pb-3 text-105'
    })
}

//Funcion para mensajes de exito
function MensajeError(mensaje1,mensaje2) {

    $.aceToaster.add({
        placement: 'tc',
        title: 'Error!',
        body: mensaje1+'<br><br>'+mensaje2,

        icon: '<i class="text-danger-d1 mr-2 text-130">\
                    <i class="fas fa-times mt-25 fa-2x text-danger"></i>\
                   </i>',
        iconClass: 'mt-3',

        delay: 8000,

        closeClass: 'btn btn-light-danger border-0 btn-bgc-tp btn-xs px-2 py-0 text-150 position-tr mt-n25',

        className: 'bgc-white-tp1 border-none border-t-4 brc-danger-tp1 rounded-sm pl-3 pr-1',
        headerClass: 'bg-transparent border-0 text-120 text-danger-d3 font-bolder mt-3',
        bodyClass: 'pt-0 pb-3 text-105'
    })
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
        url: "/obtenerCantones",
        data: { "provincia": provincia},
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
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/obtenerDistritos",
        data: { "provincia": provincia,"canton": canton},
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
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/obtenerBarrios",
        data: { "provincia": provincia,"canton": canton,"distrito": distrito},
        success: (response) => {
            $( "#barrios" ).html(response);
        },
        error: function(response){
            alert(response.responseJSON.message);
        }
    });
}


