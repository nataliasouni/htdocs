<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-trabajador/trabajador.css">
<?php


require_once "./controladores/alquilerproductosControlador.php";
$insAlquilerControlador = new alquilerproductosControlador();

$datosTrabajador = $insAlquilerControlador->datosAlquilerproductoControlador($pagina[1]);
if ($datosTrabajador->rowCount() == 1) {
    $campos = $datosTrabajador->fetch();
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
                        <h2 style='color: #0053A9'>Editar Producto de Alquiler</h2>
                    </div>

                    <form class="formularioAjax content campo"
                        action="<?php echo SERVERURL; ?>ajax/alquilerProductoAjax.php" method="POST" data-form="update">
                        <input type="hidden" name="productoAlquilerUpdate" value="<?= $pagina[1] ?>">
                        <div class="añadir_cleinte-form">
                            <div class="form-group">
                                <p class="titulos_form">Codigo del Producto</p>
                                <input type="text" name="codigoUp" class="login_nombreUsuario" value="<?= $campos['id'] ?>"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Nombre del Producto</p>
                                <input type="text" name="nombreUp" class="login_password"
                                    value="<?= $campos['nombreproducto'] ?>" required
                                    >
                            </div>

                            <div class="form-group">
                                <p class="titulos_form">Detalles del Producto</p>
                                <input type="text" name="detallesProducto" class="login_password"
                                    value="<?= $campos['detalles'] ?>" required>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Precio del Alquiler 15 Dias</p>
                                <input type="number" name="precio15Dias" class="login_password"
                                    value="<?= $campos['alquiler15dias'] ?>" required
                                    >
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Precio del Alquiler 30 Dias</p>
                                <input type="number" name="precio30Dias" class="login_password"
                                    value="<?= $campos['alquiler30dias'] ?>" required
                                    >
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Precio del Deposito</p>
                                <input type="number" name="precioDeposito" class="login_password"
                                    value="<?= $campos['deposito'] ?>" required
                                    >
                            </div>

                            <div class="botones">
                                <button id="btnActualizar" class="estado-enviar" type="submit" style="cursor: pointer"
                                    title="Enviar" name="Enviar">Actualizar</button>
                                <button id="botonCancelarAl" type="button" class="estado-cancelar"
                                    style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button>
                            </div>
                        </div>
                    </form>

                </div>
        </section>
    </main>

    <script src="<?php echo SERVERURL; ?>vistas/js/alquiler-script/botonCancelarAl.js" type="module"></script>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>No hay datos que mostrar de usuarios</title>
        <!-- Css editar usuarios - Usuario no encontrado -->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-trabajador/noEncontrado.css">
    </head>

    <body>
        <div class="container">
            <div class="message">
                <h2>No hay datos que mostrar</h2>
                <p>No se encontraron registros para este usuario.</p>
            </div>
        </div>

        <?php
}
?>