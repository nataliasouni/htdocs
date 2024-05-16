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
tiempoAlquilerSelect.addEventListener('change', function () {
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
tiempoAlquilerSelect.addEventListener('change', function () {
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

function generarContrato() {
    // Obtener los valores de los campos del formulario
    var fechaEntrega = document.getElementById("fechaEntrega").value;
    var fechaDevolucion = document.getElementById("fechaDevolucion").value;
    var tiempoAlquiler = document.getElementById("tiempoAlquiler").value;
    var nombreCliente = document.getElementById("nombreCliente").value;
    var cedulaCliente = document.getElementById("cedulaCliente").value;
    var nombreProducto = document.getElementById("nombreProducto").value;

    // Crear objeto FormData para enviar los datos al script PHP
    var formData = new FormData();
    formData.append('fechaEntrega', fechaEntrega);
    formData.append('fechaDevolucion', fechaDevolucion);
    formData.append('tiempoAlquiler', tiempoAlquiler);
    formData.append('nombreCliente', nombreCliente);
    formData.append('cedulaCliente', cedulaCliente);
    formData.append('nombreProducto', nombreProducto);

    // Enviar los datos al script PHP utilizando AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../../pdfs/contrato/contratoPDF.php', true);
    xhr.responseType = 'blob'; // Indicar que la respuesta será un blob (archivo binario)
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Crear una URL del objeto blob para el PDF generado
            var blob = new Blob([xhr.response], { type: 'application/pdf' });
            var url = window.URL.createObjectURL(blob);

            // Crear un enlace con la URL del PDF
            var link = document.createElement('a');
            link.href = url;
            link.download = 'contrato_alquiler_' + new Date().toISOString().slice(0, 10) + '.pdf'; // Nombre del archivo PDF
            document.body.appendChild(link);

            // Simular un clic en el enlace para abrir el PDF en una nueva pestaña y permitir la descarga
            link.click();

            // Limpiar la URL creada
            window.URL.revokeObjectURL(url);
        }
    };
    xhr.send(formData);
}



