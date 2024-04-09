import { SERVERURL } from '../../../config/APPJS.js';

let botonCancelar = document.getElementById('botonCancelarES');
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
            text: 'Los datos que hayas ingresado se eliminarán y regresarás a la ventana "registroES".',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                window.location.href = SERVERURL + 'registroES';
              }
        });
    } else {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Regresarás a la ventana "trabajadores".',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                window.location.href = SERVERURL + 'registroES';
              }
        });
    }
});