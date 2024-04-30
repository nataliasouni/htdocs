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


// Define una función que establece la fecha actual en el campo de fecha de entrega
function setFechaActual() {
    // Obtener la fecha actual en formato YYYY-MM-DD
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
    var yyyy = today.getFullYear();
    var fechaActual = yyyy + '-' + mm + '-' + dd;

    // Asignar la fecha actual al campo de fecha de entrega
    document.getElementById('fechaEntrega').value = fechaActual;
}

// Llamar a la función cuando se dispare el evento 'DOMContentLoaded'
document.addEventListener('DOMContentLoaded', setFechaActual);


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

