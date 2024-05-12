<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/detalles.css">

<?php

require_once "./controladores/productoControlador.php";
$insProductoControlador = new productoControlador();
$url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $url);
$pagina = isset($url_parts[2]) ? $url_parts[2] : null;

$datosProducto = $insProductoControlador->datosProductoControlador($pagina);
if ($datosProducto->rowCount() == 1) {
    $campos = $datosProducto->fetch();
    ?>

    <?php include "./vistas/inc/headerInicio.php"; ?>

    <main class="detallesProductos">
        <section class="container-detalles">
            <div class="product-image">
                <img src="<?php echo SERVERURL . 'src/imagenes/Productos/' . $campos['Imagen']; ?>"
                    alt="Imagen del producto">
            </div>
            <div class="product-info">
                <h2 class="titulo"><?php echo $campos['Nombre']; ?></h2>
                <p class="descripcion"><?php echo $campos['Descripcion']; ?></p>
            </div>
        </section>
    </main>

    <!-- Sección de productos destacados -->
    <section class="productos-destacados">
        <h2>Productos destacados</h2>
        <div class="container-destacados">
            <button class="btn-prev">&#10094;</button>
            <div class="productos-container">
                <?php
                require_once "./controladores/productoControlador.php";
                $insProducto = new productoControlador();
                echo $insProducto->enlistarProductosDestacadosControlador($campos['Id']);
                ?>
            </div>
            <button class="btn-next">&#10095;</button>
        </div>
    </section>


    <?php include "./vistas/inc/footerHome.php"; ?>

    <script>
        // Desplazamiento suave al hacer clic en los botones de navegación
        document.querySelector('.btn-prev').addEventListener('click', function () {
            document.querySelector('.productos-container').scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });

        document.querySelector('.btn-next').addEventListener('click', function () {
            document.querySelector('.productos-container').scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });
    </script>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>No hay datos que mostrar del producto</title>
    </head>
    <?php include "./vistas/inc/headerInicio.php"; ?>

    <body>
        <div class="container">
            <div class="message">
                <h2>No hay datos que mostrar</h2>
                <p>No se encontraron registros para este producto.</p>
            </div>
        </div>

        <?php include "./vistas/inc/footerHome.php"; ?>

        <?php
}
?>