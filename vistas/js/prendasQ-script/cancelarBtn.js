import { SERVERURL } from '../../../config/APPJS.js';

let botonCancelar = document.getElementById('botonCancelar');
let formulario = document.getElementsByClassName('formularioAjax')[0];
let formCambiado = false;

//Obtener elementos del form
let elementosFormulario = formulario.elements;
for (let i = 0; i < elementosFormulario.length; i++) {
    elementosFormulario[i].addEventListener('input', function () {
    formCambiado = true;
    });
}

botonCancelar.addEventListener('click', function () {
    if (formCambiado) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Los datos que hayas ingresado se eliminarán y regresarás a la ventana "Prendas Cortadas".',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                window.history.back();
              }
        });
    } else {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Regresarás a la ventana "Prendas Cortadas".',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                window.history.back();
              }
        });
    }
});
