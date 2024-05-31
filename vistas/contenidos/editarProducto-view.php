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
                            <div class="form-group">
                                <label for="Descripcion" class="titulos_form">Descripción</label>
                                <textarea name="DescripcionUp" class="producto_descripcion"
                                    required><?= $campos['Descripcion'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Categoria" class="titulos_form">Categoría</label>
                                <select name="CategoriaUp" class="selectform categoria" required>
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
                                    value="<?= $campos['Cantidad'] ?>" required>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Estado:</p>
                                <select name="EstadoUp" class="selectform area" required>
                                    <option value="si" <?php if ($campos['Estado'] == "si") {
                                        echo "selected";
                                    } ?>>Habilitada</option>
                                    <option value="no" <?php if ($campos['Estado'] == "no") {
                                        echo "selected";
                                    } ?>>Deshabilitada</option>
                                </select>
                            </div>       
                            <div class="form-group">
                                <label for="Imagen" class="titulos_form">Imagen</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="Imagen" name="ImagenUp" accept="image/*" lang="es">
                                    <label class="custom-file-label" id="customFileLabel" for="Imagen">Seleccionar archivo...</label>
                                </div>
                            </div>
                        </div>
                        <div class="botones">
                                <button id="btnActualizar" class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar" name="Enviar">Actualizar</button>
                                <button id="cancelarEdicion" type="button" class="estado-cancelar" style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button> 
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