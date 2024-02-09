$('#editordata').summernote({
    height: 300,
    codemirror: {
        mode: 'text/html',
        htmlMode: true,
        lineNumbers: true,
        theme: 'default'
    },
    callbacks: {
        onImageUpload: function(files) {
            // No permitir la carga de imágenes
            return false;
        }
    },
});
$('.input-daterange').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    calendarWeeks: true,
    clearBtn: true,
    disableTouchKeyboard: true,
    language: 'es',
}).on('show', function (e) {
    // Detener la propagación del evento de clic para evitar que alcance el modal
    e.stopPropagation();
});
$('.note-view').css({
    'display': 'none',
    // Agrega otros estilos según sea necesario
});
$('.note-insert').css({
    'display': 'none',
    // Agrega otros estilos según sea necesario
});
$('.note-table').css({
    'display': 'none',
    // Agrega otros estilos según sea necesario
});

