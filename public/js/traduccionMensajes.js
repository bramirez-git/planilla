//Validación para campos textos
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");

    for (var i = 0; i < elements.length; i++)
    {
        type = elements[i].getAttribute('type');

        if(type != 'email') {
            elements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("Este campo es obligatorio.");
                }
            };
            elements[i].oninput = function (e) {
                e.target.setCustomValidity("");
            };
        }
        else
        {
            elements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");

                if (e.target.validity.valueMissing) {
                    e.target.setCustomValidity("Este campo es obligatorio.");
                }
                else if(!e.target.validity.valid) {
                    e.target.setCustomValidity("Ingrese un formato de correo válido");
                }
            };
            elements[i].oninput = function (e) {
                e.target.setCustomValidity("");
            };
        }
    }
});


//Validación para campos select
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("SELECT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Por favor seleccione una opción.");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
});
