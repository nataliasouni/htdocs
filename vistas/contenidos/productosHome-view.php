<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/productos.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/headerInicio.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Productos</h2>
                </div>

                <div class="gestionarProducto">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar producto...">
                    </div>
                    <div class="card-deck">
                        <?php
                        // Verificar si $_GET['variable'] está definida y no está vacía
                        if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                            // Obtener el valor de $_GET['variable']
                            $categoria = $_GET['variable'];

                            // Llamar a la función para enlistar productos con la categoría proporcionada
                            require_once "./controladores/productoControlador.php";
                            $insProducto = new productoControlador();
                            echo $insProducto->enlistarProductoHomeControlador($categoria, true); // El segundo parámetro indica que se mostrarán tarjetas
                        } else {
                            // Si $_GET['variable'] no está definida o está vacía, mostrar un mensaje de error o manejar el caso según sea necesario
                            echo "La variable 'variable' no está definida en la URL.";
                        }
                        ?>
                    </div>
                </div>
        </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/homepage-script/producto.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/producto-script/cancelarBtn.js" type="module"></script>