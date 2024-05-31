<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-alquiler/agregarProducto.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'> Agregar Producto Para Alquiler </h2>
                </div>

                <form class="formularioAjax content" action="<?php echo SERVERURL; ?>ajax/alquilerProductoAjax.php"
                    method="POST" data-form="save">

                    <div class="añadir_cleinte-form">
                        <div class="form-group">
                            <p class="titulos_form">Codigo del Producto</p>
                            <input type="number" name="codigoProducto" class="login_nombreUsuario" required>
                        </div>

                        <div class="form-group">
                            <p class="titulos_form">Nombre del Producto</p>
                            <input type="text" name="nombreProducto" class="login_password" required>
                        </div>

                        <div class="form-group">
                            <p class="titulos_form">Detalles del Producto</p>
                            <input type="text" name="detallesProducto" class="login_password" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Precio del Alquiler 15 Dias</p>
                            <div style="display: flex; align-items: center;">
                                <span style="margin-right: 2px;">$</span>
                                <input type="number" name="precio15Dias" class="login_password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Precio del Alquiler 30 Dias</p>
                            <div style="display: flex; align-items: center;">
                                <span style="margin-right: 2px;">$</span>
                                <input type="number" name="precio30Dias" class="login_password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <p class="titulos_form">Precio del Deposito</p>
                            <div style="display: flex; align-items: center;">
                                <span style="margin-right: 2px;">$</span>
                                <input type="number" name="precioDeposito" class="login_password" required>
                            </div>
                        </div>
                        <div class="botones">
                            <button class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar"
                                name="Enviar">Agregar</button>
                            <button id="botonCancelarAl" type="button" class="estado-cancelar" style="cursor: pointer"
                                title="Cancelar" name="Cancelar">Cancelar</button>
                        </div>
                    </div>
                </form>

            </div>
    </section>
</main>



<script src="<?php echo SERVERURL; ?>vistas/js/alquiler-script/botonCancelarAl.js" type="module"></script>