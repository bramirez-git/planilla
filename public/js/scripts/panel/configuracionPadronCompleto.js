
$(function($) {
    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash,silverlight,html4',
        browse_button : 'pickfiles',     // you can pass an id
        container: document.getElementById('container_padron'), // DOM Element
        url : base_path  + '/panelAdministracion/cargarPadronElectoral',
        chunk_size: '1mb',
        headers: {
            "x-csrf-token" : $("[name=_token]").val()
        },
        allow_extensions: 'txt',
        flash_swf_url : base_path + '/js/plupload-3.1.5/Moxie.swf',
        silverlight_xap_url : base_path + '/js/plupload-3.1.5/Moxie.xap',
        filters : {
            max_file_size : '1000mb',
            mime_types: [
                {title : "Image files", extensions : "jpg,gif,png"},
                {title : "Zip files", extensions : "zip"},
                {title : "Txt files", extensions : "txt"}
            ]
        },
        init: {
            PostInit: function() {
                document.getElementById('filelist').innerHTML = '';
                document.getElementById('uploadfiles').onclick = function() {
                    uploader.start();
                    $("#div_guardar_padron").show();
                    return false;
                };
            },

            FilesAdded: function(up, files) {
                plupload.each(files, function(file) {
                    document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                });
                $("#archivo_cargado").val("1");
            },

            UploadProgress: function(up, file) {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },

            Error: function(up, err) {
                document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
            }
        }
    });

    uploader.init();
    var frmPadron = $('#frm_padron_electoral');
    frmPadron.on('submit', function(event){
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        waitingDialog.show();
        // Realiza una solicitud AJAX para enviar el formulario
        $.ajax({
            type: 'POST',
            url: frmPadron.attr('action'),
            data: frmPadron.serialize(),
            success: function(response){
                if(response.mensaje1 == null){
                    $("#tablas").empty().append(response);
                    waitingDialog.hide();
                }else{
                    mostrarAlertaError(response.mensaje1,response.mensaje2);
                }
            },
            error: function(error){
                mostrarAlertaError(error);
            }
        });
    });

    $(".btn-modal-cargando").on("click", function () {
        $('#cargando').modal('show');
    });

    $("#limpiarCampos").on("click", function () {
        // Obtener el formulario por su ID
        const form = $("#frm_filros");

        // Limpiar los campos estableciendo su valor en cadena vacía
        form.find("input[type=text]").val('');
        form.find("select").each(function () {
            // Establecer la opción por posición (índice) 1 (Opción 2) para cada elemento <select>
            $(this).prop("selectedIndex", 0)
        });
    });
});

function descargar_excel(){
    $.ajax({
        type: "POST",
        data: "mantenimiento=exportar_excel",
        url: base_path + '/panelAdministracion/descargarExcelPadron',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function() {
            waitingDialog.show();
        },
        success: function(url_excel){
            if(url_excel != ""){
                window.open(url_excel, "_self");
                return false;
            }
        },
        complete: function(response) {
            waitingDialog.hide();
        },
        error: function (response) {
            alert(response.responseJSON.message);
        }
    });
}

function registrar_datos(){
    var archivo_cargado = $("#archivo_cargado").val();
    if(archivo_cargado == "1") {
        $.ajax({
            type: "POST",
            timeout: 1 * 60 * 60 * 1000,  // 1 hora
            data: "mantenimiento=guardar_padron",
            url: base_path + '/panelAdministracion/guardarPadronElectoral',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () {
                waitingDialog.show();
            },
            success: function (respuesta) {
                waitingDialog.hide();
                if(respuesta == "ok"){
                    setTimeout(function() {
                        mostrarAlertaExito( 'Se cargó el padrón electoral.');
                    }, 500);
                }
            },
            complete: function () {
                waitingDialog.hide();
            },
            error: function () {
                waitingDialog.hide();
            }
        });
    }else{
        mostrarAlertaError( 'Debe seleccionar el archivo.');
    }
}