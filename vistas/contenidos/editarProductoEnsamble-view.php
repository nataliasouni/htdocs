<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-producto/productos.css">

<?php

require_once "./controladores/ensambleControlador.php";
$insProductoControlador = new ensambleControlador();

$datosProducto = $insProductoControlador->datosProductoControlador($pagina[1]);
if ($datosProducto->rowCount() == 1) {
    $campos = $datosProducto->fetch();
    ?>

    <main class="full-box main-container">
        <!-- Incluir la barra lateral -->
        <?php include "./vistas/inc/NavLateral.php"; ?>

        <?php include "./vistas/inc/header.php"; ?>

        <section class="full-box page-content">

            <div class="page-content">

                <!-- Content -->
                <div class="tile-container">

                    <div class="choose-option">
                        <h2 style='color: #0053A9'>Editar producto</h2>
                    </div>

                    <form class="formularioAjax content campo" action="<?php echo SERVERURL; ?>ajax/productosAjax.php"
                        method="POST" data-form="update">
                        <input type="hidden" name="productoUpdate" value="<?= $pagina[1] ?>">

                        <div class="añadir_producto-form">
                            <div class="form-group">
                                <label for="idNormal" class="titulos_form">Id</label>
                                <input type="text" name="Id" class="producto_id" 
                                value="<?= $campos['Id'] ?>"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="Nombre" class="titulos_form">Nombre</label>
                                <input type="text" name="NombreUp" class="producto_nombre"
                                    value="<?= $campos['Nombre'] ?>" required>
                            </div>
                    </form>
                </div>
        </section>
    </main>

    <script>
        document.getElementById('Imagen').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var label = document.getElementById('customFileLabel');
        label.innerHTML = fileName;
    });
    </script>

    <script src="<?php echo SERVERURL; ?>vistas/js/producto-script/producto.js"></script>

    <script src="<?php echo SERVERURL; ?>vistas/js/producto-script/cancelarEdicion.js" type="module"></script>

    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>No hay datos que mostrar del producto</title>
        <!-- Css editar usuarios - Usuario no encontrado -->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-usuarios/noEncontrado.css">
    </head>

    <body>
        <div class="container">
            <div class="message">
                <h2>No hay datos que mostrar</h2>
                <p>No se encontraron registros para este producto.</p>
            </div>
        </div>

        <?php
}
?>