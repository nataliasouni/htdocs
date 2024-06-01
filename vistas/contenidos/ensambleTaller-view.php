<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-talleres/ensambleTaller.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <?php
                    // Verificar si $_GET['variable'] está definida y no está vacía
                    if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                        // Obtener el valor de $_GET['variable']
                        $Nombre = $_GET['variable'];
                        
                        echo '<h2 id="nombreTaller">'. $Nombre . '</h2>';
                    }
                    ?>
                    <p></p>
                    <h2 style='color: #0053A9' id="titulo">Ensambles</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar ensamble...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                    <th>Orden de producción</th>
                                    <th>Contenido del ensamble</th>
                                    <th>Cantidad(PE)</th>
                                    <th>Prendas cortadas</th>
                                    <th>Cantidad(PC)</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php
                                // Verificar si $_GET['variable'] está definida y no está vacía
                                if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                                    // Obtener el valor de $_GET['variable']
                                    $Nombre = $_GET['variable'];
                                    require_once "./controladores/talleresControlador.php";
                                    $insEnsamble = new talleresControlador();
                                    echo $insEnsamble->enlistarEnsamblePrendasControlador($Nombre);
                                    // Llamar a la función para enlistar productos con la categoría proporcionada
                                    
                                } else {
                                    // Si $_GET['variable'] no está definida o está vacía, mostrar un mensaje de error o manejar el caso según sea necesario
                                    echo "La variable 'variable' no está definida en la URL.";
                                }
                                ?>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationContainer">
                            <!-- Aquí se insertará dinámicamente la paginación -->
                        </ul>
                    </nav>
                    <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" onclick="location.href='../agregarEnsambleTaller?variable=<?php echo $Nombre; ?>'">Agregar Ensamble</button>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<script src="<?php echo SERVERURL; ?>vistas/js/taller-script/ensambleTaller.js"></script>
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