$(document).ready(function(){

    $('#guardar').on('click', function (evt)
    {
        $('#confirmModal').modal('hide');
        $('#cargando').modal('show');
    });

    $('#frm-colaboradores').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            identificacion: {
                required: true
            },
            nombre1: {
                required: true
            },
            apellido1: {
                required: true
            },
            fechaNacimiento: {
                required: true
            },
            telefonoCelular: {
                required: true
            },
            correoPersonal: {
                required: true
            },
            direccion: {
                required: true
            }
        },

        messages: {
            identificacion: {
                required: "Este campo es requerido."
            },
            nombre1: {
                required: "Este campo es requerido."
            },
            apellido1: {
                required: "Este campo es requerido."
            },
            fechaNacimiento: {
                required: "Este campo es requerido."
            },
            telefonoCelular: {
                required: "Este campo es requerido."
            },
            correoPersonal: {
                required: "Este campo es requerido."
            },
            direccion: {
                required: "Este campo es requerido."
            }
        },
        errorElement : 'span'
    });

    $("#registrar").on('click', function (evt)
    {
        if($('#frm-colaboradores').valid())
        {
            $('#confirmModal').modal('show');
        }
        else{
            return false;
        }
    });
});
