
    $(document).ready(function() {
        //Validar formulario de pago
        $('#formPagoPendiente').validate({
            errorElement: "div",
            errorClass: "help-block",
            focusInvalid: false,
            rules: {
                "inputNumero1": {
                    required: true,
                    minlength: 18,
                },
                "inputNombre1": {
                    required: true,
                    minlength: 5,
                },
                "selectMes1": {
                    required: true,
                },
                "selectYear1": {
                    required: true
                },
                "inputCCV1": {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                "inputNumero1": {
                    required: "Campo requerido",
                    minlength: "Debe tener al menos 15 dígitos"
                },
                "inputNombre1": {
                    required: "Campo requerido",
                    minlength: "Debe tener al menos 5 caracteres"
                },
                "selectMes1": {
                    required: "Campo requerido"
                },
                "selectYear1": {
                    required: "Campo requerido"
                },
                "inputCCV1": {
                    required: "Campo requerido",
                    minlength: "Debe tener 3 dígitos"
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

    function pagoFacturaPendiente(){
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_path + "/pagoFacturaPendiente",
            data: $('#formPagoPendiente').serialize(),
            global: false,
            beforeSend: function() {
                waitingDialog.show();
            },
            success: function(respuesta){
                var info_respuesta = JSON.parse(respuesta);
                var msje_error = "";

                if(info_respuesta.estado == "ok"){
                    msje_error = "Se ha realizado exitosamente el pago de la factura";
                    mensaje_swal("success", msje_error, function(){
                        fn_reload();
                    });
                }else{
                    msje_error = "Se ha presentado el siguiente error: " + info_respuesta.msje_error;
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

    //Tarjeta
    var tarjeta = document.querySelector('#tarjeta1'),
        //btnAbrirFormulario = document.querySelector('#btn-abrir-formulario'),
        formulario = document.querySelector('#formulario-tarjeta1'),
        numeroTarjeta = document.querySelector('#tarjeta1 .numero'),
        nombreTarjeta = document.querySelector('#tarjeta1 .nombre'),
        logoMarca = document.querySelector('#logo-marca1'),
        firma = document.querySelector('#tarjeta1 .firma p'),
        mesExpiracion = document.querySelector('#tarjeta1 .mes'),
        yearExpiracion = document.querySelector('#tarjeta1 .year'),
        ccv = document.querySelector('#tarjeta1 .ccv');

    var mostrarFrente = () => {
        if(tarjeta.classList.contains('active')){
            tarjeta.classList.remove('active');
        }
    }

    // * Rotacion de la tarjeta
    tarjeta.addEventListener('click', () => {
        tarjeta.classList.toggle('active');
    });

    // * Select del mes generado dinamicamente.
    for(let i = 1; i <= 12; i++){
        let opcion = document.createElement('option');
        if(i < 10){
            opcion.value = "0" + i;
            opcion.innerText = "0" + i;
        }else{
            opcion.value = i;
            opcion.innerText = i;
        }
        this.selectMes1.append(opcion);
    }

    // * Select del año generado dinamicamente.
    var yearActual = new Date().getFullYear();

    for(let i = yearActual; i <= yearActual + 8; i++){
        let opcion = document.createElement('option');
        opcion.value = i;
        opcion.innerText = i;
        this.selectYear1.append(opcion);
    }

    // * Input numero de tarjeta
    this.inputNumero1.addEventListener('keyup', (e) => {
        let valorInput = e.target.value;

        this.inputNumero1.value = valorInput
            // Eliminamos espacios en blanco
            .replace(/\s/g, '')
            // Eliminar las letras
            .replace(/\D/g, '')
            // Ponemos espacio cada cuatro numeros
            .replace(/([0-9]{4})/g, '$1 ')
            // Elimina el ultimo espaciado
            .trim();

        numeroTarjeta.textContent = valorInput;

        if(valorInput == ''){
            numeroTarjeta.textContent = '#### #### #### ####';

            logoMarca.innerHTML = '';
        }

        // Obtener la ruta del servidor
        var wwwUrlPath = window.document.location.href;
        var pathName = window.document.location.pathname;
        var pos = wwwUrlPath.indexOf(pathName);

        if(valorInput[0] == 3){
            logoMarca.innerHTML = '';
            const imagen = document.createElement('img');
            imagen.src = base_path+'/estilos/node_modules/PayCards/img/logos/american.png';
            logoMarca.appendChild(imagen);
        } else if(valorInput[0] == 4){
            logoMarca.innerHTML = '';
            const imagen = document.createElement('img');
            imagen.src = base_path+'/estilos/node_modules/PayCards/img/logos/visa.png';
            logoMarca.appendChild(imagen);
        } else if(valorInput[0] == 5){
            logoMarca.innerHTML = '';
            const imagen = document.createElement('img');
            imagen.src = base_path+'/estilos/node_modules/PayCards/img/logos/mastercard.png';
            logoMarca.appendChild(imagen);
        }

        // Volteamos la tarjeta para que el usuario vea el frente.
        mostrarFrente();
    });

    // * Input nombre de tarjeta
    this.inputNombre1.addEventListener('keyup', (e) => {
        let valorInput = e.target.value;

        this.inputNombre1.value = valorInput.replace(/[0-9]/g, '');
        nombreTarjeta.textContent = valorInput;
        firma.textContent = valorInput;

        if(valorInput == ''){
            nombreTarjeta.textContent = '';
        }

        mostrarFrente();
    });


    // * Select mes
    this.selectMes1.addEventListener('change', (e) => {
        mesExpiracion.textContent = e.target.value;
        mostrarFrente();
    });


    // * Select Año
    this.selectYear1.addEventListener('change', (e) => {
        yearExpiracion.textContent = e.target.value.slice(2);
        mostrarFrente();
    });

    // * CCV
    this.inputCCV1.addEventListener('keyup', () => {
        if(!tarjeta.classList.contains('active')){
            tarjeta.classList.toggle('active');
        }

        this.inputCCV1.value = this.inputCCV1.value
            // Eliminar los espacios
            .replace(/\s/g, '')
            // Eliminar las letras
            .replace(/\D/g, '');
        ccv1.textContent = this.inputCCV1.value;
    });
