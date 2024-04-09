<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-ensamble/ensamble.css">

<?php

require_once "./controladores/ensambleControlador.php";
$insEnsambleControlador = new ensambleControlador();

$datosEnsamble = $insEnsambleControlador->datosEnsambleControlador($pagina[1]);
if ($datosEnsamble->rowCount() == 1) {
    $campos = $datosEnsamble->fetch();
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

                    <form class="formularioAjax content campo" action="<?php echo SERVERURL; ?>ajax/ensambleAjax.php"
                        method="POST" data-form="update">
                        <input type="hidden" name="idEnsambleUp" value="<?= $pagina[1] ?>">

                        <div class="añadir_producto-form">
                            <div class="form-group">
                                <p class="titulos_form">Orden de Producción</p>
                                <input type="text" name="OrdenProduccionUp" value="<?= $campos['ensamble_id'] ?>"
                                    class="login_nombreUsuario" disabled>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Cantidad de Producción</p>
                                <input type="number" value="<?= $campos['CantidadProduccion'] ?>" name="CantidadPUp"
                                    class="login_password" disabled>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Estado de la cuenta:</p>
                                <select name="EstadoUp" class="selectform area" disabled>
                                    <option value="Si" <?php if ($campos['Estado'] == "Si") {
                                        echo "selected";
                                    } ?>>Habilitada</option>
                                    <option value="No" <?php if ($campos['Estado'] == "No") {
                                        echo "selected";
                                    } ?>>Deshabilitada</option>
                                </select>
                            </div>

                            <div class="gestionarProducto">
                                <div class="choose-option">
                                    <h2 style='color: #0053A9'>Productos del ensamble</h2>
                                </div>
                                <div class="choose-option">
                                    <p>A cada producto agrega la cantidad y si esta o no pendiente</p>
                                </div>
                                <div class="filter-container">
                                    <input type="text" class="form-control" id="filterInput"
                                        placeholder="Buscar producto...">
                                </div>
                                <div class="table-responsive">
                                    <table id="alertTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Pendiente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Obtener los productos asociados a este ensamble
                                            $productosEnsamble = $insEnsambleControlador->obtenerProductosEnsambleControlador($campos['ensamble_id'] ?? 0);
                                            while ($producto = $productosEnsamble->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $producto['Id'] ?>
                                                        <input type="hidden" name="IdProducto[<?= $producto['Id'] ?>]"
                                                            value="<?= $producto['Id'] ?>" disabled>
                                                    </td>
                                                    <td>
                                                        <?= $producto['Nombre'] ?>
                                                    </td>
                                                    <!-- Agrega campos de entrada para la cantidad y el estado pendiente -->
                                                    <td><input type="number" name="CantidadUp[<?= $producto['Id'] ?>]"
                                                            value="<?= $producto['cantidad'] ?>" class="producto_cantidad"
                                                            disabled></td>
                                                    <td>
                                                        <select class="selectform area"
                                                            name="PendienteUp[<?= $producto['Id'] ?>]" disabled>
                                                            <option value="Si" <?php if ($producto['Pendiente'] == "Si") {
                                                                echo "selected";
                                                            } ?>>Está Pendiente</option>
                                                            <option value="No" <?php if ($producto['Pendiente'] == "No") {
                                                                echo "selected";
                                                            } ?>>No está pendiente</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination" id="paginationContainer"></div>
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
        <title>No hay datos que mostrar del ensamble</title>
        <!-- Css editar usuarios - Usuario no encontrado -->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-usuarios/noEncontrado.css">
    </head>

    <body>
        <div class="container">
            <div class="message">
                <h2>No hay datos que mostrar</h2>
                <p>No se encontraron registros para este ensamble.</p>
            </div>
        </div>

        <?php
}
?>