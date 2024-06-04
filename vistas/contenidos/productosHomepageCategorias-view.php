<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/productos.css">

<?php include "./vistas/inc/headerInicio.php"; ?>

<main class="full-box main-container">

    <!-- Sección de Productos -->
    <section id="productos" class="productos">
        <div class="container-productos" id="container-productos">
            <?php
            // Verificar si $_GET['variable'] está definida y no está vacía
            if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                // Obtener el valor de $_GET['variable']
                $categoria = $_GET['variable'];

                // Llamar a la función para enlistar productos con la categoría proporcionada
                require_once "./controladores/productoControlador.php";
                $insProducto = new productoControlador();
                echo $insProducto->enlistarProductoControladorCategoria($categoria);
            } else {
                // Si $_GET['variable'] no está definida o está vacía, mostrar un mensaje de error o manejar el caso según sea necesario
                echo "La variable 'variable' no está definida en la URL.";
            }
            ?>
        </div>
    </section>

    <?php include "./vistas/inc/botonsubir.php"; ?>
</main>

<?php include "./vistas/inc/footerHome.php"; ?>