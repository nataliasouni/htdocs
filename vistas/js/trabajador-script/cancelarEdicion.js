import { SERVERURL } from '../../../config/APPJS.js';

document.getElementById('cancelarEdicionUsuario').addEventListener('click', function () {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Los datos que hayas ingresado se eliminarán y regresarás a la ventana "trabajadores".',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then(function (result) {
        if (result.value) {
            window.location.href = SERVERURL + 'trabajadores';
          }
    });
});
