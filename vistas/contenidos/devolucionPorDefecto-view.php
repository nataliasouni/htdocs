<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-prendasQ/prendasQ.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Prendas Defectuosas</h2>
                </div>

                <div class="gestionarProducto">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar prenda...">
                    </div>

                    <div class="table-responsive">
                        <table id="alertTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once "./controladores/devolucionPrendasControlador.php";
                                $insPrendas = new devolucionPrendasControlador();
                                echo $insPrendas->enlistarPrenda2Controlador();
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="pagination" id="paginationContainer"></div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/prendasC-script/prendasC.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/prendasC-script/cancelarBtn.js" type="module"></script>

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