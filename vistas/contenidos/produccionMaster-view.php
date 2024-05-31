<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-produccionMaster/produccionMaster.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Producciones</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar registro...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                    <th>Nombre del trabajador</th>
                                    <th>Taller</th>
                                    <th>Fecha</th>
                                    <th>Tipo de prenda</th>
                                    <th>Prendas elaboradas</th>
                                    <th>Prendas defectuosas</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            require_once "./controladores/produccionControlador.php";
                            $produccion = new produccionControlador();
                            echo $produccion->generarTablaProduccion();
                            ?>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationContainer">
                            <!-- Aquí se insertará dinámicamente la paginación -->
                        </ul>
                    </nav>
                    <div class="d-flex justify-content-end">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/produccionMaster-script/registroProduccionM.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener todas las filas del cuerpo de la tabla
    var tableRows = document.querySelectorAll('#alertTable tbody tr');

    tableRows.forEach(function(row) {
        // Obtener todas las celdas de la fila
        var cells = row.querySelectorAll('td');

        cells.forEach(function(cell) {
            // Convertir el contenido de texto de la celda a minúsculas sin afectar el HTML interno
            cell.innerHTML = cell.innerHTML.split(/(<[^>]*>)/).map(function(part) {
                return part.startsWith('<') ? part : part.toLowerCase();
            }).join('');
        });
    });
});

</script>