// Obtener el elemento de entrada de filtro
var filterInput = document.getElementById("filterInput");

// Obtener la tabla
var table = document.getElementById("alertTable");

// Obtener todas las filas de la tabla
var rows = table.getElementsByTagName("tr");

// Definir el número de elementos a mostrar por página
var itemsPerPage = 5;
var paginationGroupSize = 5;

// Variables para realizar un seguimiento de los resultados filtrados y la paginación actual
var filteredRows = [];
var currentPage = 1;

// Función para mostrar los elementos de la página actual
function showPage(pageNumber) {
  var startIndex = (pageNumber - 1) * itemsPerPage;
  var endIndex = startIndex + itemsPerPage;

  // Recorrer las filas y mostrar u ocultar según el índice de página
  for (var i = 1; i < rows.length; i++) {
    if (filteredRows.includes(rows[i])) {
      if (filteredRows.indexOf(rows[i]) >= startIndex && filteredRows.indexOf(rows[i]) < endIndex) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    } else {
      rows[i].style.display = "none";
    }
  }
}

// Función para crear los enlaces de paginación
function createPagination(pageNumber, pageCount) {
  // Obtener el elemento contenedor de la paginación
  var paginationContainer = document.getElementById("paginationContainer");

  // Limpiar el contenido anterior de la paginación
  paginationContainer.innerHTML = "";

  // Calcular el grupo de paginación actual
  var currentGroup = Math.ceil(pageNumber / paginationGroupSize);

  // Calcular el índice inicial y final del grupo de paginación
  var startPageIndex = (currentGroup - 1) * paginationGroupSize + 1;
  var endPageIndex = Math.min(startPageIndex + paginationGroupSize - 1, pageCount);

  // Crear el enlace "Anterior" si no estás en la primera página
  if (pageNumber > 1) {
    var previousLink = document.createElement("a");
    previousLink.href = "#";
    previousLink.textContent = "Anterior";
    previousLink.addEventListener("click", function (event) {
      event.preventDefault();
      currentPage = pageNumber - 1;
      showPage(currentPage);
      createPagination(currentPage, pageCount);
    });
    paginationContainer.appendChild(previousLink);
  }

  // Crear los enlaces de paginación numéricos
  for (var i = startPageIndex; i <= endPageIndex; i++) {
    var link = document.createElement("a");
    link.href = "#";
    link.textContent = i;
    if (i === pageNumber) {
      link.className = "active";
    }
    link.addEventListener("click", function (event) {
      event.preventDefault();
      currentPage = parseInt(this.textContent);
      showPage(currentPage);
      createPagination(currentPage, pageCount);
    });
    paginationContainer.appendChild(link);
  }

  // Crear el enlace "Siguiente" si no estás en la última página
  if (pageNumber < pageCount) {
    var nextLink = document.createElement("a");
    nextLink.href = "#";
    nextLink.textContent = "Siguiente";
    nextLink.addEventListener("click", function (event) {
      event.preventDefault();
      currentPage = pageNumber + 1;
      showPage(currentPage);
      createPagination(currentPage, pageCount);
    });
    paginationContainer.appendChild(nextLink);
  }
}

// Función para filtrar las filas según el valor del filtro
function filterRows() {
  var filterValue = filterInput.value.toLowerCase();
  filteredRows = [];

  for (var i = 1; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    var match = false;

    for (var j = 0; j < cells.length; j++) {
      var cellText = cells[j].textContent.toLowerCase();
      if (cellText.includes(filterValue)) {
        match = true;
        break;
      }
    }

    if (match) {
      filteredRows.push(rows[i]);
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
}

// Agregar un evento de escucha al elemento de entrada de filtro
filterInput.addEventListener("input", function () {
  filterRows();
  currentPage = 1;
  showPage(currentPage);
  createPagination(currentPage, Math.ceil(filteredRows.length / itemsPerPage));
});

// Mostrar la primera página al cargar la página
filterRows();
showPage(currentPage);
createPagination(currentPage, Math.ceil(filteredRows.length / itemsPerPage));

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

function generarPagare() {
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
    xhr.open('POST', '../../../pdfs/pagare/solicitudPDF.php', true);
    xhr.responseType = 'blob'; // Indicar que la respuesta será un blob (archivo binario)
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Crear una URL del objeto blob para el PDF generado
            var blob = new Blob([xhr.response], { type: 'application/pdf' });
            var url = window.URL.createObjectURL(blob);

            // Crear un enlace con la URL del PDF
            var link = document.createElement('a');
            link.href = url;
            link.download = 'pagare_alquiler_' + new Date().toISOString().slice(0, 10) + '.pdf'; // Nombre del archivo PDF
            document.body.appendChild(link);

            // Simular un clic en el enlace para abrir el PDF en una nueva pestaña y permitir la descarga
            link.click();

            // Limpiar la URL creada
            window.URL.revokeObjectURL(url);
        }
    };
    xhr.send(formData);
}


