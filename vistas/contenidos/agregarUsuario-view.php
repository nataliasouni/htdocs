<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-usuario/usuario.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'> Agregar usuario</h2>
                </div>

                <form class="formularioAjax content" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save">

                <div class="añadir_cleinte-form">
                    <div class="form-group">
                    <p class="titulos_form">Cédula</p>
                    <input type="number" name="cedulaNormal" class="login_nombreUsuario" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Nombre de Usuario</p>
                    <input type="text" name="usuario" class="login_password" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Contraseña</p>
                    <input type="text" name="contrasena1" class="login_password" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Permisos</p>
                    <select name="permisos" class="selectform permisos" required>
                        <option value="" selected>Seleccionar permisos</option>
                        <option value="Master">Master</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Taller">Taller</option>
                        <option value="Produccion">Produccion</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Repita la contraseña</p>
                    <input type="text" name="contrasena2" class="login_password" required>
                    </div>
                    <!-- Opciones de area : Solicitante y receptor -->
                    <div class="form-group">
                    <p class="titulos_form">Email</p>
                    <input type="text" name="email" class="login_password" required>
                    </div>
                    <div class="form-group">
                    <p class="titulos_form">Telefono</p>
                    <input type="number" name="telefono" class="login_password" required>
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

<script src="<?php echo SERVERURL; ?>vistas/js/usuario-script/usuario.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/usuario-script/cancelarBtn.js" type="module"></script>