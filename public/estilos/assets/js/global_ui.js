(function(){
    $(document).off('click.tabLoader').on('click.tabLoader', 'li>a[data-load]:not(.loaded)', function (event) {
        var target = $(this).data("load");
        if (target.length > 0) {
            waitingDialog.show();
            $.ajax({
                url: target, // Usa la función url() de Laravel para generar la URL completa
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Agrega el token CSRF de Laravel a la solicitud
                },
                success: function () {
                    waitingDialog.hide();
                },
                complete: function () {
                    waitingDialog.hide();
                },
                error: function () {
                    waitingDialog.hide();
                }
            });
        }
    });
})();

