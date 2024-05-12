<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/productos.css">

<?php include "./vistas/inc/headerInicio.php"; ?>

<main class="full-box main-container">

    <!-- Sección de Productos -->
    <section id="productos" class="productos">
        <div class="container-productos" id="container-productos">
            <?php
            require_once "./controladores/productoControlador.php";
            $insProducto = new productoControlador();
            echo $insProducto->enlistarProductosHomeControlador();
            ?>
        </div>
    </section>

</main>

<?php include "./vistas/inc/footerHome.php"; ?>