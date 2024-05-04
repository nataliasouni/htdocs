function setFechaActual() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    var fechaActual = yyyy + '-' + mm + '-' + dd;
    document.getElementById('fechaEntrega').value = fechaActual;
}

// Llama a la función setFechaActual() tan pronto como la página se carga
setFechaActual();

// Obtener la fecha de entrega y el campo de tiempo de alquiler
var fechaEntregaInput = document.getElementById('fechaEntrega');
var tiempoAlquilerSelect = document.getElementById('tiempoAlquiler');
var fechaDevolucionInput = document.getElementsByName('fechaDevolucion')[0];

// Agregar un evento change al campo de tiempo de alquiler
tiempoAlquilerSelect.addEventListener('change', function() {
    // Obtener la fecha de entrega seleccionada por el usuario
    var fechaEntrega = new Date(fechaEntregaInput.value);

    // Obtener el valor seleccionado del campo de tiempo de alquiler
    var tiempoAlquiler = parseInt(tiempoAlquilerSelect.value);

    // Calcular la fecha de devolución sumando el tiempo de alquiler a la fecha de entrega
    var fechaDevolucion = new Date(fechaEntrega.getTime() + tiempoAlquiler * 24 * 60 * 60 * 1000);

    // Formatear la fecha de devolución en formato YYYY-MM-DD
    var dd = String(fechaDevolucion.getDate()).padStart(2, '0');
    var mm = String(fechaDevolucion.getMonth() + 1).padStart(2, '0');
    var yyyy = fechaDevolucion.getFullYear();
    var fechaDevolucionFormatted = yyyy + '-' + mm + '-' + dd;

    // Asignar la fecha de devolución al campo correspondiente
    fechaDevolucionInput.value = fechaDevolucionFormatted;
});



