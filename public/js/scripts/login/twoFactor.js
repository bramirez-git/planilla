$(document).ready(function() {
    $('#btn-2fa').click(function() {
        waitingDialog.show();
        $('#frm-2fa').submit();
    });

    var tel1 = $('#telefono_factor');
    var dial1 = $('#codigo');

    tel1.intlTelInput({
        preferredCountries: ['cr', 'ni', 'pa', 'co', 'ec', 'pe', 'cl', 'ar', 'br', 'us'],
        separateDialCode: true
    });

    tel1.on('countrychange', function (event, countryData) {
        dial1.val(countryData.dialCode);
    });

    dial1.on('change', function (event) {
        var tel = tel1.val();
        tel1.intlTelInput('setNumber', '+' + this.value);
        tel1.intlTelInput('setNumber', tel);
    });

    dial1.change();

    tel1.intlTelInput();

    tel1.on('input', function () {
        var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
        var longitudMaxima = (codigoPais === 'cr') ? 8 : 15;

        var valor = tel1.val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

        if (valor.length > longitudMaxima) {
            valor = valor.substring(0, longitudMaxima);
        }

        // No aplicar guiones si es internacional
        if (codigoPais !== 'cr') {
            tel1.inputmask('remove'); // Eliminar la máscara
        } else {
            // Verificar los dígitos iniciales para Costa Rica (2, 8, 6, 7)
            if (!/^([248679])/.test(valor) && valor !== '') {
                valor = '';
            } else {
                tel1.inputmask({
                    mask: '9999-9999',
                    showMaskOnHover: false,
                    showMaskOnFocus: false
                });
            }
        }

        tel1.val(valor);

    });

    tel1.on('countrychange', function () {
        var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
        if (codigoPais !== 'cr') {
            // Para números internacionales, aplicar máscara de 15 dígitos
            tel1.inputmask({
                mask: '999999999999999',
                showMaskOnHover: false,
                showMaskOnFocus: false
            });
        } else {
            tel1.val('');
        }
    });

    tel1.on('blur', function () {
        var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
        var valor = tel1.val().replace(/\D/g, '');

        var mensajeError = $('#mensajeError');
    });

});

document.addEventListener('DOMContentLoaded', function () {
    var checkbox = document.getElementById('activateTwoFactorAuth');
    var formSection = document.getElementById('twoFactorAuthForm');
    var laterParagraph = document.getElementById('laterParagraph');

    if (checkbox && formSection && laterParagraph) {
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                formSection.style.display = 'block';
                laterParagraph.style.display = 'none';
            } else {
                formSection.style.display = 'none';
                laterParagraph.style.display = 'block';
            }
        });
    }
});

const checkbox = document.getElementById("activateTwoFactorAuth");
const hiddenInput = document.getElementById("activateTwoFactorAuthHidden");

if (checkbox && hiddenInput) {
    checkbox.addEventListener("change", function() {
        hiddenInput.value = this.checked ? "1" : "0";
    });
}
