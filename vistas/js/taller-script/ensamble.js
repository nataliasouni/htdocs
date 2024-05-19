// Para la primera tabla

// Obtener el elemento de entrada de filtro para la primera tabla
var filterInputP = document.getElementById("filterInputP");
// Obtener la tabla para la primera tabla
var tableP = document.getElementById("alertTableP");
// Obtener todas las filas de la primera tabla
var rowsP = tableP.getElementsByTagName("tr");
// Variables para realizar un seguimiento de los resultados filtrados y la paginación actual para la primera tabla
var filteredRowsP = [];
var currentPageP = 1;

// Para la segunda tabla

// Obtener el elemento de entrada de filtro para la segunda tabla
var filterInputPr = document.getElementById("filterInputPr");
// Obtener la tabla para la segunda tabla
var tablePr = document.getElementById("alertTablePr");
// Obtener todas las filas de la segunda tabla
var rowsPr = tablePr.getElementsByTagName("tr");
// Variables para realizar un seguimiento de los resultados filtrados y la paginación actual para la segunda tabla
var filteredRowsPr = [];
var currentPagePr = 1;

// Definir el número de elementos a mostrar por página
var itemsPerPage = 5;
var paginationGroupSize = 5;

// Funciones para la primera tabla

function showPageP(pageNumber) {
    var startIndex = (pageNumber - 1) * itemsPerPage;
    var endIndex = startIndex + itemsPerPage;

    // Recorrer las filas y mostrar u ocultar según el índice de página
    for (var i = 1; i < rowsP.length; i++) {
        if (filteredRowsP.includes(rowsP[i])) {
            if (filteredRowsP.indexOf(rowsP[i]) >= startIndex && filteredRowsP.indexOf(rowsP[i]) < endIndex) {
                rowsP[i].style.display = "";
            } else {
                rowsP[i].style.display = "none";
            }
        } else {
            rowsP[i].style.display = "none";
        }
    }
}

function createPaginationP(pageNumber, pageCount) {
    var paginationContainer = document.getElementById("paginationContainerP");

    paginationContainer.innerHTML = "";

    var currentGroup = Math.ceil(pageNumber / paginationGroupSize);
    var startPageIndex = (currentGroup - 1) * paginationGroupSize + 1;
    var endPageIndex = Math.min(startPageIndex + paginationGroupSize - 1, pageCount);

    if (pageNumber > 1) {
        var previousLink = document.createElement("a");
        previousLink.href = "#";
        previousLink.textContent = "Anterior";
        previousLink.addEventListener("click", function (event) {
            event.preventDefault();
            currentPageP = pageNumber - 1;
            showPageP(currentPageP);
            createPaginationP(currentPageP, pageCount);
        });
        paginationContainer.appendChild(previousLink);
    }

    for (var i = startPageIndex; i <= endPageIndex; i++) {
        var link = document.createElement("a");
        link.href = "#";
        link.textContent = i;
        if (i === pageNumber) {
            link.className = "active";
        }
        link.addEventListener("click", function (event) {
            event.preventDefault();
            currentPageP = parseInt(this.textContent);
            showPageP(currentPageP);
            createPaginationP(currentPageP, pageCount);
        });
        paginationContainer.appendChild(link);
    }

    if (pageNumber < pageCount) {
        var nextLink = document.createElement("a");
        nextLink.href = "#";
        nextLink.textContent = "Siguiente";
        nextLink.addEventListener("click", function (event) {
            event.preventDefault();
            currentPageP = pageNumber + 1;
            showPageP(currentPageP);
            createPaginationP(currentPageP, pageCount);
        });
        paginationContainer.appendChild(nextLink);
    }
}

function filterRowsP() {
    var filterValue = filterInputP.value.toLowerCase();
    filteredRowsP = [];

    for (var i = 1; i < rowsP.length; i++) {
        var cells = rowsP[i].getElementsByTagName("td");
        var match = false;

        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].textContent.toLowerCase();
            if (cellText.includes(filterValue)) {
                match = true;
                break;
            }
        }

        if (match) {
            filteredRowsP.push(rowsP[i]);
            rowsP[i].style.display = "";
        } else {
            rowsP[i].style.display = "none";
        }
    }
}

// Funciones para la segunda tabla

function showPagePr(pageNumber) {
    var startIndex = (pageNumber - 1) * itemsPerPage;
    var endIndex = startIndex + itemsPerPage;

    for (var i = 1; i < rowsPr.length; i++) {
        if (filteredRowsPr.includes(rowsPr[i])) {
            if (filteredRowsPr.indexOf(rowsPr[i]) >= startIndex
                && filteredRowsPr.indexOf(rowsPr[i]) < endIndex) {
                rowsPr[i].style.display = "";
            } else {
                rowsPr[i].style.display = "none";
            }
        } else {
            rowsPr[i].style.display = "none";
        }
    }
}

function createPaginationPr(pageNumber, pageCount) {
    var paginationContainer = document.getElementById("paginationContainerPr");

    paginationContainer.innerHTML = "";

    var currentGroup = Math.ceil(pageNumber / paginationGroupSize);
    var startPageIndex = (currentGroup - 1) * paginationGroupSize + 1;
    var endPageIndex = Math.min(startPageIndex + paginationGroupSize - 1, pageCount);

    if (pageNumber > 1) {
        var previousLink = document.createElement("a");
        previousLink.href = "#";
        previousLink.textContent = "Anterior";
        previousLink.addEventListener("click", function (event) {
            event.preventDefault();
            currentPagePr = pageNumber - 1;
            showPagePr(currentPagePr);
            createPaginationPr(currentPagePr, pageCount);
        });
        paginationContainer.appendChild(previousLink);
    }

    for (var i = startPageIndex; i <= endPageIndex; i++) {
        var link = document.createElement("a");
        link.href = "#";
        link.textContent = i;
        if (i === pageNumber) {
            link.className = "active";
        }
        link.addEventListener("click", function (event) {
            event.preventDefault();
            currentPagePr = parseInt(this.textContent);
            showPagePr(currentPagePr);
            createPaginationPr(currentPagePr, pageCount);
        });
        paginationContainer.appendChild(link);
    }

    if (pageNumber < pageCount) {
        var nextLink = document.createElement("a");
        nextLink.href = "#";
        nextLink.textContent = "Siguiente";
        nextLink.addEventListener("click", function (event) {
            event.preventDefault();
            currentPagePr = pageNumber + 1;
            showPagePr(currentPagePr);
            createPaginationPr(currentPagePr, pageCount);
        });
        paginationContainer.appendChild(nextLink);
    }
}

function filterRowsPr() {
    var filterValue = filterInputPr.value.toLowerCase();
    filteredRowsPr = [];

    for (var i = 1; i < rowsPr.length; i++) {
        var cells = rowsPr[i].getElementsByTagName("td");
        var match = false;

        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].textContent.toLowerCase();
            if (cellText.includes(filterValue)) {
                match = true;
                break;
            }
        }

        if (match) {
            filteredRowsPr.push(rowsPr[i]);
            rowsPr[i].style.display = "";
        } else {
            rowsPr[i].style.display = "none";
        }
    }
}

// Agregar eventos de escucha al elemento de entrada de filtro para ambas tablas
filterInputP.addEventListener("input", function () {
    filterRowsP();
    currentPageP = 1;
    showPageP(currentPageP);
    createPaginationP(currentPageP, Math.ceil(filteredRowsP.length / itemsPerPage));
});

filterInputPr.addEventListener("input", function () {
    filterRowsPr();
    currentPagePr = 1;
    showPagePr(currentPagePr);
    createPaginationPr(currentPagePr, Math.ceil(filteredRowsPr.length / itemsPerPage));
});

// Mostrar la primera página al cargar la página para ambas tablas
filterRowsP();
showPageP(currentPageP);
createPaginationP(currentPageP, Math.ceil(filteredRowsP.length / itemsPerPage));

filterRowsPr();
showPagePr(currentPagePr);
createPaginationPr(currentPagePr, Math.ceil(filteredRowsPr.length / itemsPerPage));

document.getElementById('AgregarEnsamble').addEventListener('click', function () {

    // Obtener los datos de la tabla de productos
    var datosTablaProductos = [];
    document.querySelectorAll('#alertTableP tbody tr').forEach(function (row) {
        var id = row.querySelector('td:nth-child(1)').textContent;
        var cantidad = row.querySelector('.cantidad').value;
        datosTablaProductos.push({ Id: id, Cantidad: cantidad });
    });

    // Obtener los datos de la tabla de prendas
    var datosTablaPrendas = [];
    document.querySelectorAll('#alertTablePr tbody tr').forEach(function (row) {
        var id = row.querySelector('td:nth-child(1)').textContent;
        var cantidad = row.querySelector('.cantidad').value;
        datosTablaPrendas.push({ Id: id, Cantidad: cantidad });
    });

    // Colocar los datos en los campos ocultos como JSON
    document.getElementById('datosTablaProductos').value = JSON.stringify(datosTablaProductos);
    document.getElementById('datosTablaPrendas').value = JSON.stringify(datosTablaPrendas);

    // Mostrar alerta de SweetAlert
    swal("¡Datos agregados!", "Los datos se han agregado correctamente.", "success")
        .then((value) => {
            // Enviar el formulario manualmente después de mostrar la alerta
            document.querySelector('form').submit();
        });
});

// Obtener el valor de la variable 'variable' de la URL
var nombreTaller = obtenerNombreTaller();

// Asignar el valor al campo oculto del formulario
document.getElementById('nombreTaller').value = nombreTaller;

// Función para obtener el valor de la variable 'variable' de la URL
function obtenerNombreTaller() {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('variable');
}






