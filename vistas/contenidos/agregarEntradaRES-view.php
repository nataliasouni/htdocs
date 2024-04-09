<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-registroES/registroES.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'> Agregar Entrada</h2>
                </div>

                <form class="formularioAjax content" action="<?php echo SERVERURL; ?>ajax/registroESAjax.php" method="POST" data-form="save">

                <div class="añadir_cleinte-form">
                    <div class="form-group">
                    <p class="titulos_form">Cédula</p>
                    <input type="text" name="cedulaA" class="login_nombreUsuario" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Fecha</p>
                    <input type="text" name="fecha" class="login_password" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Hora de entrada</p>
                    <input type="text" name="horaEntrada" class="login_password" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Hora de salida</p>
                    <input type="text" name="horaSalida" class="login_password" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Horas trabajadas</p>
                    <input type="text" name="horasTrabajadas" class="login_password" required>
                    </div>   
                    

                    <div class="botones">
                    <button class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar" name="Enviar">Agregar</button>
                    <button id="botonCancelarES" type="button" class="estado-cancelar" style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button>
                    </div>
                </div>
            </form>
               
            </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/registroES-script/registroES.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/registroES-script/botonCancelarES.js" type="module"></script>