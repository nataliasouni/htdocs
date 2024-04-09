<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-alquiler/agregarAlquiler.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">
        <div class="page-content">
            <!-- Content -->
            <div class="tile-container">
                <div class="choose-option">
                    <h2 style='color: #0053A9'>Alquilar Producto</h2>
                </div>

                <div class="formularioAjax content">
                    <h2 class="choose-option">-------- ALQUILER-------</h2>
                    <form class="añadir_cleinte-form" action="<?php echo SERVERURL; ?>ajax/registroESAjax.php" method="POST" data-form="save">
                        <div class="form-group">
                            <p class="titulos_form">ID</p>
                            <input type="text" name="cedulaA" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fecha de Alquiler</p>
                            <input type="text" name="fecha" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fecha de Entrega</p>
                            <input type="text" name="horaEntrada" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Tiempo de alquiler</p>
                            <input type="text" name="horaSalida" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Total a Pagar</p>
                            <input type="text" name="horasTrabajadas" class="login_nombreUsuario" required>
                        </div>
                        </a>

                        <div class="form-group">
                            <h2 class="choose-option">Productos</h2>
                        </div>

                        <div class="form-group botones">
                            <button class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar" name="Enviar">Agregar</button>
                            <button id="botonCancelarES" type="button" class="estado-cancelar" style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

