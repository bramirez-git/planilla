$(function($) {
    $('.btn-filtro').click(function(){
        waitingDialog.show();
        var url=$("input[name='url']").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: url,
            success: (response)=>{
                waitingDialog.hide();
            },
            complete: function(){
                waitingDialog.hide();
            },
            error: function(response){
                alert(response.responseJSON.message);
                waitingDialog.hide();
            }
        });
    });
    $('.btn-ajax').click(function(){
        waitingDialog.show();
        var encryptedId=$(this).data('encrypted-id'); // Obtiene el valor cifrado de 'data-encrypted-id'
        var url=$("input[name='url_ajax']").val();
        url=url.replace(':id', encryptedId);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: url,
            success: (response)=>{
                waitingDialog.hide();
            },
            complete: function(){
                waitingDialog.hide();
            },
            error: function(response){
                alert(response.responseJSON.message);
                waitingDialog.hide();
            }
        });
    });
    $(".submitLink").click(function(e) {
        e.preventDefault(); // Evita que el enlace siga el enlace href
        var id=$(this).attr("id");
        $("#frm_activar_cuenta_"+id).submit();
        var formulario = $("#frm_activar_cuenta_"+id);
        waitingDialog.show();

        $.ajax({
            type: "POST",
            url: formulario.attr('action'),
            data: {
                type: 'POST',
                url: formulario.attr('action'),
                data: formulario.serialize()
            },
            success: function(response) {
                // Maneja la respuesta exitosa aquí, si es necesario
                // console.log(response);
            },
            error: function(error) {
                // Maneja los errores aquí, si es necesario
                // console.error(error);
            },
            complete: function() {
                // Esto se ejecutará después de que la solicitud AJAX se complete,
                // independientemente de si fue exitosa o no.
            }
        });
    });

    $("#limpiarCampos").on("click", function(){
        // Obtener el formulario por su ID
        const form=$("#frm_filtros");
        // Limpiar los campos estableciendo su valor en cadena vacía
        form.find("input[type=text]").val('');
        // form.find("input[type=radio]").prop("checked", false);
        form.find("input[type=checkbox]").prop("checked", false);
        // Seleccionar la opción "Inactivo"
        form.find("input[name='filtro[estado]'][value='']").trigger("click");
    });
});


$(function () {
    var descarga_cliente = $('#descarga_excel_cliente');
    descarga_cliente.on('click', function (event) {
        event.preventDefault();
        waitingDialog.show()
        var valor_busqueda = $('#buscar').val();
        var estado = $('[name="filtro[estado]"]:checked').val();
        var telefono = $('[name="filtro[telefono]"]').val();
        var correo_empresa = $('[name="filtro[correo_empresa]"]').val();
        var correo_contacto = $('[name="filtro[correo_contacto]"]').val();
        var fecha_ingreso = $('[name="filtro[fecha_ingreso]"]').val();
        var fecha_final = $('[name="filtro[fecha_final]"]').val();
        var tipos_empresa = $('[name="filtro[tipos_empresa][]"]:checked').map(function() {
            return this.value;
        }).get();


        var datos = descarga_cliente.serialize();
        datos += "&buscar=" + valor_busqueda;
        datos += "&estado=" + estado;
        datos += "&telefono=" + telefono;
        datos += "&correo_empresa=" + correo_empresa;
        datos += "&correo_contacto=" + correo_contacto;
        datos += "&fecha_ingreso=" + fecha_ingreso;
        datos += "&fecha_final=" + fecha_final;
        datos += "&tipos_empresa=" + tipos_empresa;

        $.ajax({
            type: 'POST',
            url: base_path+"/panelAdministracion/descargar_excel_cliente",
            data: datos,
            success: function (response) {

                if (response.success) {
                    var link = document.createElement('a');
                    link.href = response.url;
                    link.download = 'Lista_de_cliente.txt';
                    link.click();
                    waitingDialog.hide();
                    mostrarAlertaExito(response.message);
                } else {
                    waitingDialog.hide();
                    mensaje_swal('error', response.message);
                }
            },
            error: function (error) {
                waitingDialog.hide();
                mensaje_swal('error', error);
            }
        });
    });
});

