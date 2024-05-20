<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-usuario/usuario.css">

<?php
if ($_SESSION['permiso'] != "Master") {
    $insLoginControlador->forzarCierreSesionControlador();
    exit();
}

require_once "./controladores/usuarioControlador.php";
$insUsuarioControlador = new usuarioControlador();

$datosUsuario = $insUsuarioControlador->datosUsuarioControlador($pagina[1]);
if ($datosUsuario->rowCount() == 1) {
    $campos = $datosUsuario->fetch();
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
                        <h2 style='color: #0053A9'>Editar usuario</h2>
                    </div>
                
                    <form class="formularioAjax content campo" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update">
                    <input type="hidden" name="usuarioUpdate" value="<?= $pagina[1] ?>">
                        <div class="añadir_cleinte-form">
                            <div class="form-group">
                                <p class="titulos_form">Cédula</p>
                                <input type="text" name="cedula" class="login_nombreUsuario"
                                    value="<?= $campos['cedula'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Nombre de Usuario</p>
                                <input type="text" name="usuarioUp" class="login_password"
                                    value="<?= $campos['nombre_usuario'] ?>" required>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Nueva Contraseña</p>
                                <input type="text" name="nuevaContrasena1Up" class="login_password">
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Permisos</p>
                                <select name="permisosUp" class="selectform permisos" required>
                                    <option value="Master" <?php if ($campos['permiso'] == "Master") {
                                        echo "selected";
                                    } ?>>Master</option>
                                    <option value="Administrador" <?php if ($campos['permiso'] == "Administrador") {
                                        echo "selected";
                                    } ?>>Administrador</option>
                                    <option value="Taller" <?php if ($campos['permiso'] == "Taller") {
                                        echo "selected";
                                    } ?>>Taller</option>
                                    <option value="Produccion" <?php if ($campos['permiso'] == "Produccion") {
                                        echo "selected";
                                    } ?>>Produccion</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Repita la contraseña</p>
                                <input type="text" name="nuevaContrasena2Up" class="login_password">
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Email</p>
                                <input type="text" name="emailUp" class="login_password" value="<?= $campos['email'] ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Telefono</p>
                                <input type="number" name="telefonoUp" class="login_password" value="<?= $campos['telefono'] ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Estado de la cuenta:</p>
                                <select name="estado" class="selectform area" required>
                                    <option value="si" <?php if ($campos['estado'] == "si") {
                                        echo "selected";
                                    } ?>>Habilitada</option>
                                    <option value="no" <?php if ($campos['estado'] == "no") {
                                        echo "selected";
                                    } ?>>Deshabilitada</option>
                                </select>
                            </div>
                            <div class="botones">
                            <button id="btnActualizar" class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar" name="Enviar">Actualizar</button>
                            <button id="cancelarEdicionUsuario" type="button" class="estado-cancelar" style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button>
                            </div>
                        </div>
                    </form>

                </div>
        </section>
    </main>

    <script src="<?php echo SERVERURL; ?>vistas/js/usuario-script/cancelarEdicion.js" type="module"></script>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>No hay datos que mostrar de usuarios</title>
        <!-- Css editar usuarios - Usuario no encontrado -->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-usuarios/noEncontrado.css">
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