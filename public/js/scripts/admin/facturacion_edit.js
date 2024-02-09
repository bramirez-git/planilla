
    $(document).ready(function() {
        //Validar formulario de recarga
        $('#formRecarga').validate({
            errorElement: "div",
            errorClass: "help-block",
            focusInvalid: false,
            rules: {
                "correoFactura": {
                    required: true
                },
                "montoRecarga": {
                    required: true
                }
            },
            messages: {
                "correoFactura": {
                    required: "Este campo es requerido.",
                },
                "montoRecarga": {
                    required: "Este campo es requerido.",
                }
            },
            errorPlacement: function(error, element){
                if(element.attr("type") == "checkbox") {
                    error.insertAfter(element.closest('.input-group'));
                }else{
                    error.insertAfter(element);
                }
            }
        });
    });

    function cambiarModalidad(modalidad){
        $("#modalidad").val(modalidad);
    }

    function cambioMoneda(moneda){
        //Dolares
        if(moneda == "dolares"){
            $(".spanMoneda").html("$");

            //Montos dolares
            var nuevosMontos = {
                "Seleccione..." : "",
                "$ 10" : "10",
                "$ 25" : "25",
                "$ 50" : "50",
                "$ 100": "100"
            };
        }

        //Colones
        if(moneda == "colones"){
            $(".spanMoneda").html("₡");

            //Montos colones
            var nuevosMontos = {
                "Seleccione..." : "",
                "₡ 1.00"     : "1",
                "₡ 5,000.00" : "5000",
                "₡ 10,000.00": "10000",
                "₡ 25,000.00": "25000",
                "₡ 50,000.00": "50000"
            };
        }

        //Agregar nuevos montos segun la moneda seleccionada
        var selectMontos = $("#montoRecarga");
        selectMontos.empty(); // remove old options
        $.each(nuevosMontos, function(key, value) {
            selectMontos.append($("<option></option>").attr("value", value).text(key));
        });

        //Limpia campos totales
        $("#ivaPagar").val("0.00");
        $("#totalPagar").val("0.00");
    }

    function cambioTipoPago(nuevoTipoPago){
        $("#tipoPago").val(nuevoTipoPago);
    }

    function calcularTotal(){
        var montoRecarga = parseFloat($("#montoRecarga").val());
        var porcentajeImpuesto = $("#tarifaImpuesto").val();
        var montoImpuesto = montoRecarga * (porcentajeImpuesto / 100);
        var montoTotal = parseFloat(montoRecarga + montoImpuesto);

        $("#ivaPagar").val(formatoDecimales(montoImpuesto));
        $("#totalPagar").val(formatoDecimales(montoTotal));
    }

    function validarFormularioPago(){
        var modalidad = $("#modalidad").val();
        var tipoPago = $("#tipoPago").val();

        $("#correoFactura").rules("add", {
            required: true,
            messages: {
                required: "Este campo es requerido."
            }
        });

        //Modalidad pago
        if(modalidad == "recarga"){
            //Eliminar validaciones de tarjeta #2 (cargo automatico)
            $("#chkTerminos").rules("remove");
            $("#inputNumero2").rules("remove");
            $("#inputNombre2").rules("remove");
            $("#selectMes2").rules("remove");
            $("#selectYear2").rules("remove");
            $("#inputCCV2").rules("remove");

            //Tarjeta
            if(tipoPago == "tarjeta"){
                //Eliminar validaciones de transferencia
                $("#numeroTransferencia").rules("remove");
                $("#codBanco").rules("remove");

                //Validaciones para tarjeta
                $("#montoRecarga").rules("add", {
                    required: true,
                    messages: {
                        required: "Este campo es requerido."
                    }
                });
                $("#inputNumero1").rules("add", {
                    required: true,
                    minlength: 18, //Contempla los espacios en blanco
                    messages: {
                        required: "Este campo es requerido.",
                        minlength: "Debe tener al menos 15 dígitos",
                    }
                });
                $("#inputNombre1").rules("add", {
                    required: true,
                    minlength: 5,
                    messages: {
                        required: "Este campo es requerido.",
                        minlength: "Debe tener al menos 5 caracteres",
                    }
                });
                $("#selectMes1").rules("add", {
                    required: true,
                    messages: {
                        required: "Este campo es requerido."
                    }
                });
                $("#selectYear1").rules("add", {
                    required: true,
                    messages: {
                        required: "Este campo es requerido."
                    }
                });
                $("#inputCCV1").rules("add", {
                    required: true,
                    minlength: 3,
                    messages: {
                        required: "Este campo es requerido.",
                        minlength: "Debe tener 3 dígitos"
                    }
                });
            }

            //Transferencia
            if(tipoPago == "transferencia"){
                //Eliminar validaciones de tarjeta #1 (pago en linea)
                $("#inputNumero1").rules("remove");
                $("#inputNombre1").rules("remove");
                $("#selectMes1").rules("remove");
                $("#selectYear1").rules("remove");
                $("#inputCCV1").rules("remove");

                //Validaciones para transferencia
                $("#montoRecarga").rules("add", {
                    required: true,
                    messages: {
                        required: "Este campo es requerido."
                    }
                });
                $("#numeroTransferencia").rules("add", {
                    required: true,
                    messages: {
                        required: "Este campo es requerido."
                    }
                });
                $("#codBanco").rules("add", {
                    required: true,
                    messages: {
                        required: "Este campo es requerido."
                    }
                });
            }
        }

        if(modalidad == "cargo_automatico"){
            //Elimina validaciones para recarga
            $("#montoRecarga").rules("remove");

            //Agregar validaciones para tarjeta #2 (cargo automatico)
            $("#chkTerminos").rules("add", {
                required: true,
                messages: {
                    required: "Debe aceptar el reglamento."
                }
            });
            $("#inputNumero2").rules("add", {
                required: true,
                minlength: 18, //Contempla los espacios en blanco
                messages: {
                    required: "Este campo es requerido.",
                    minlength: "Debe tener al menos 15 dígitos",
                }
            });
            $("#inputNombre2").rules("add", {
                required: true,
                minlength: 5,
                messages: {
                    required: "Este campo es requerido.",
                    minlength: "Debe tener al menos 5 caracteres",
                }
            });
            $("#selectMes2").rules("add", {
                required: true,
                messages: {
                    required: "Este campo es requerido."
                }
            });
            $("#selectYear2").rules("add", {
                required: true,
                messages: {
                    required: "Este campo es requerido."
                }
            });
            $("#inputCCV2").rules("add", {
                required: true,
                minlength: 3,
                messages: {
                    required: "Este campo es requerido.",
                    minlength: "Debe tener 3 dígitos"
                }
            });
        }

        if($("#formRecarga").valid()){
            return true;
        }else{
            return false;
        }
    }

    function pagoEnLinea(){
        var modalidad = $("#modalidad").val();
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_path + "/pagoEnLinea",
            data: $('#formRecarga').serialize(),
            global: false,
            beforeSend: function() {
                waitingDialog.show();
            },
            success: function(respuesta){
                var infoRespuesta = JSON.parse(respuesta);
                var msje_error = "";

                if(infoRespuesta.estado == "ok"){
                    if(modalidad == "recarga"){
                        msje_error = "Se ha realizado exitosamente la recarga - Factura #" + infoRespuesta.num_factura;
                    }
                    if(modalidad == "cargo_automatico"){
                        msje_error = "Se ha registrado exitosamente la tarjeta para el cargo automático";
                    }

                    //Mostrar mensaje
                    mensaje_swal("success", msje_error, function(){
                        fn_reload();
                    });
                }else{
                    msje_error = "Se ha presentado el siguiente error: " + infoRespuesta.msje_error;
                    if(infoRespuesta.num_factura != ""){
                        msje_error = msje_error + "<br><br>Adem&aacute;s se ha generado la <b>Factura #" +  infoRespuesta.num_factura +
                            "</b> la cu&aacute;l queda pendiente de pago.";
                    }

                    //Mostrar mensaje de error
                    mensaje_swal("error", msje_error, function(){
                        fn_reload();
                    });
                }
            },
            complete: function(response) {

            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }

    function desactivarCargoAutomatico(){
        confirmar('', '¿Desea realmente desactivar el Cargo Automático?', 'question', function(){

            //Desactivar cargo automatico
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: base_path + "/desactivarCargoAutomatico",
                data: "accion=desactivar",
                global: false,
                beforeSend: function() {
                    waitingDialog.show();
                },
                success: function(respuesta){
                    if(respuesta == "ok"){
                        //Mostrar mensaje
                        mensaje_swal("success", "Se ha desactivado el Cargo Automático", function(){
                            fn_reload();
                        });
                    }else{
                        //Mostrar mensaje de error
                        mensaje_swal("error", "Error al desactivar el Cargo Automático", function(){
                            fn_reload();
                        });
                    }
                },
                complete: function(response) {

                },
                error: function (response) {
                    alert(response.responseJSON.message);
                }
            });

        },function(){
            $("#chkCargoAutomatico").prop("checked", true);
        });
    }

    function formatoDecimales(monto){
        var nuevoMonto = 0;
        if(monto >= 0) {
            var partes_numero = monto.toString().split(".");
            partes_numero[0] = partes_numero[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            nuevoMonto = partes_numero.join(".");
            nuevoMonto = parseFloat(nuevoMonto).toFixed(2);
        }
        return nuevoMonto;
    }
