<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-prendasQ/prendasQ.css">

<?php

require_once "./controladores/prendasControlador.php";
$insPrendaControlador = new prendasControlador();

$datosPrenda = $insPrendaControlador->datosPrendaControlador($pagina[1]);
if ($datosPrenda->rowCount() == 1) {
    $campos = $datosPrenda->fetch();
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
                        <h2 style='color: #0053A9'>Editar insumo</h2>
                    </div>

                    <div class="detallesUs">
                        <form class="detallesU">
                            <input type="hidden" name="prendaUpdate" value="<?= $pagina[1] ?>" disabled>

                            <div class="añadir_producto-form">
                                <div class="form-group">
                                    <label for="idPrenda" class="titulos_form">Id</label>
                                    <input type="text" name="IdPrenda" class="producto_id" value="<?= $campos['id'] ?>"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="Nombre" class="titulos_form">Nombre</label>
                                    <input type="text" name="NombreUp" class="producto_nombre"
                                        value="<?= $campos['nombre'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="Descripcion" class="titulos_form">Descripción</label>
                                    <textarea name="DescripcionUp" class="producto_descripcion"
                                        disabled><?= $campos['descripcion'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Cantidad" class="titulos_form">Cantidad</label>
                                    <input type="number" name="CantidadUp" class="producto_cantidad"
                                        value="<?= $campos['cantidadDisponible'] ?>" disabled>
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