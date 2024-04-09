<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-producto/productos.css">

<?php

require_once "./controladores/productoControlador.php";
$insProductoControlador = new productoControlador();

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
                        <h2 style='color: #0053A9'>Detalles producto</h2>
                    </div>

                    <div class="detallesUs">
                        <form class="detallesU">
                            <input type="hidden" name="usuarioUpdate" value="<?= $pagina[1] ?>" disabled>
                            <div class="añadir_producto-form">
                                <div class="form-group">
                                    <label for="idNormal" class="titulos_form">Id</label>
                                    <input type="text" name="Id" class="producto_id" value="<?= $campos['Id'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="Nombre" class="titulos_form">Nombre</label>
                                    <input type="text" name="NombreUp" class="producto_nombre"
                                        value="<?= $campos['Nombre'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="Descripcion" class="titulos_form">Descripción</label>
                                    <textarea name="DescripcionUp" class="producto_descripcion"
                                        disabled><?= $campos['Descripcion'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Categoria" class="titulos_form">Categoría</label>
                                    <select name="CategoriaUp" class="selectform categoria" disabled>
                                        <option value="Movilidad y Recuperación" <?php if ($campos['Categoria'] == "Movilidad y Recuperación") {
                                            echo "selected";
                                        } ?>>Movilidad y Recuperación</option>
                                        <option value="Muebles Hospitalarios" <?php if ($campos['Categoria'] == "Muebles Hospitalarios") {
                                            echo "selected";
                                        } ?>>Muebles Hospitalarios</option>
                                        <option value="Línea Respiratoria" <?php if ($campos['Categoria'] == "Línea Respiratoria") {
                                            echo "selected";
                                        } ?>>Línea Respiratoria</option>
                                        <option value="Colchones y Colchonetas" <?php if ($campos['Categoria'] == "Colchones y Colchonetas") {
                                            echo "selected";
                                        } ?>>Colchones y Colchonetas</option>
                                        <option value="Prendas Quirurgicas" <?php if ($campos['Categoria'] == "Prendas Quirurgicas") {
                                            echo "selected";
                                        } ?>>Prendas Quirurgicas</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Cantidad" class="titulos_form">Cantidad</label>
                                    <input type="number" name="CantidadUp" class="producto_cantidad"
                                        value="<?= $campos['Cantidad'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Estado de la cuenta:</p>
                                    <select name="EstadoUp" class="selectform area" disabled>
                                        <option value="si" <?php if ($campos['Estado'] == "si") {
                                            echo "selected";
                                        } ?>>Habilitada</option>
                                        <option value="no" <?php if ($campos['Estado'] == "no") {
                                            echo "selected";
                                        } ?>>Deshabilitada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Alquiler" class="titulos_form">Alquiler</label>
                                    <select name="AlquilerUp" class="selectform alquiler" disabled>
                                        <option value="Sí" <?php if ($campos['Alquiler'] == "Sí") {
                                            echo "selected";
                                        } ?>>Sí</option>
                                        <option value="No" <?php if ($campos['Alquiler'] == "No") {
                                            echo "selected";
                                        } ?>>No</option>
                                    </select>
                                </div>
                                <div class="form-group"
                                    style="display: flex; justify-content: center; align-items: center;">
                                    <img src="<?= SERVERURL . 'src/imagenes/productos/' . $campos['Imagen'] ?>"
                                        style="max-width: 100px; height: auto;">
                                </div>
                            </div>
                        </form>
                        <div class="boton">
                            <a onclick="window.history.back();"><button class="estado-volver" title="Volver"
                                    name="Volver">Volver</button></a>
                        </div>
                    </div>
        </section>
    </main>

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