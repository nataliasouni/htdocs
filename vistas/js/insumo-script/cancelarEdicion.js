document.getElementById('cancelarEdicion').addEventListener('click', function () {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Los datos que hayas ingresado se eliminarán y regresarás a la ventana anterior.',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then(function (result) {
        if (result.value) {
            // Retroceder una página en el historial de navegación
            window.history.back();
        }
    });
});


