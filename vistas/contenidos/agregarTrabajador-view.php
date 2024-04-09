<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-trabajador/trabajador.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'> Agregar Trabajador</h2>
                </div>

                <form class="formularioAjax content" action="<?php echo SERVERURL; ?>ajax/trabajadorAjax.php" method="POST" data-form="save">

                <div class="añadir_cleinte-form">
                    <div class="form-group">
                    <p class="titulos_form">Cédula</p>
                    <input type="text" name="cedula" class="login_nombreUsuario" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Nombre del trabajador</p>
                    <input type="text" name="nombreTrabajador" class="login_password" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Telefono</p>
                    <input type="text" name="telefono" class="login_password" required>
                    </div>
                    <div class="botones">
                    <button class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar" name="Enviar">Agregar</button>
                    <button id="botonCancelar" type="button" class="estado-cancelar" style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button>
                    </div>
                </div>
            </form>
               
            </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/trabajador-script/trabajador.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/trabajador-script/botonCancelar.js" type="module"></script>