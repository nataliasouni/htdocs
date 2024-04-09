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

                    <div class="detallesUs">
                        <form class="detallesU">
                            <input type="hidden" name="usuarioUpdate" value="<?= $pagina[1] ?>" disabled>
                            <div class="añadir_cleinte-form">
                                <div class="form-group">
                                    <p class="titulos_form">Cédula</p>
                                    <input type="text" name="cedula" class="login_nombreUsuario"
                                        value="<?= $campos['cedula'] ?>" required disabled>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Nombre de Usuario</p>
                                    <input type="text" name="usuarioUp" class="login_password"
                                        value="<?= $campos['nombre_usuario'] ?>" required disabled>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Contraseña</p>
                                    <input type="text" name="nuevaContrasena1Up" class="login_password"
                                        value="<?= $campos['contrasena'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Permisos</p>
                                    <select name="permisosUp" class="selectform permisos" required disabled>
                                        <option value="Master" <?php if ($campos['permiso'] == "Master")
                                            echo "selected"; ?>>
                                            Master</option>
                                        <option value="Administrador" <?php if ($campos['permiso'] == "Administrador")
                                            echo "selected"; ?>>Administrador</option>
                                        <option value="Taller" <?php if ($campos['permiso'] == "Taller")
                                            echo "selected"; ?>>
                                            Taller</option>
                                        <option value="Produccion" <?php if ($campos['permiso'] == "Produccion")
                                            echo "selected"; ?>>Produccion</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Email</p>
                                    <input type="text" name="emailUp" class="login_password" value="<?= $campos['email'] ?>"
                                        required disabled>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Telefono</p>
                                    <input type="text" name="telefonoUp" class="login_password"
                                        value="<?= $campos['telefono'] ?>" required disabled>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Estado de la cuenta:</p>
                                    <select name="estado" class="selectform area" required disabled>
                                        <option value="si" <?php if ($campos['estado'] == "si")
                                            echo "selected"; ?>>Habilitada
                                        </option>
                                        <option value="no" <?php if ($campos['estado'] == "no")
                                            echo "selected"; ?>>Deshabilitada
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="boton">
                            <a href="<?= SERVERURL; ?>usuarios"><button class="estado-volver" style="cursor: pointer" title="Volver" name="Volver">Volver</button></a>
                        </div>
                    </div>
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