<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-registroES/registroES.css">
<?php
// Verificar permisos de usuario
if ($_SESSION['permiso'] != "Master") {
    $insLoginControlador->forzarCierreSesionControlador();
    exit();
}

require_once "./controladores/registroESControlador.php";
$insRegistroESControlador = new registroESControlador();

// Obtener datos del registroES
$datosRegistroES = $insRegistroESControlador->datosRegistroESControlador($pagina[1]);

if ($datosRegistroES->rowCount() == 1) {
    $campos = $datosRegistroES->fetch();
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
                    <h2 style='color: #0053A9'>Editar registro</h2>
                </div>

                <form class="formularioAjax content campo" action="<?php echo SERVERURL; ?>ajax/registroESAjax.php" method="POST" data-form="update">
                    <input type="hidden" name="idUpdate" value="<?= $pagina[1] ?>">
                    
                    <div class="añadir_cleinte-form">
                        <div class="form-group">
                            <p class="titulos_form">ID</p>
                            <input type="number" name="id" class="login_nombreUsuario" value="<?= $campos['id'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Cédula</p>
                            <input type="text" name="cedulaUp" class="login_nombreUsuario" value="<?= $campos['cedula'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fecha</p>
                            <input type="text" name="fechaUp" class="login_password" value="<?= $campos['fecha'] ?>" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Hora de Entrada</p>
                            <input type="text" name="horaEntradaUp" class="login_password" value="<?= $campos['horaEntrada'] ?>" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Hora de Salida</p>
                            <input type="text" name="horaSalidaUp" class="login_password" value="<?= $campos['horaSalida'] ?>" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Horas Trabajadas</p>
                            <input type="text" name="horasTrabajadasUp" class="login_password" value="<?= $campos['horasTrabajadas'] ?>" required>
                        </div>
                    </div>

                    <div class="botones">
                        <button id="btnActualizar" class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar" name="Enviar">Actualizar</button>
                        <button id="cancelarEdicionRegistro" type="button" class="estado-cancelar" style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/registroES-script/cancelarEdicionES.js" type="module"></script>

<?php
} else {
?>

<!DOCTYPE html>
<html>
<head>
    <title>No hay datos que mostrar de usuarios</title>
    <!-- Css editar usuarios - Usuario no encontrado -->
</head>
<body>
    <div class="container">
        <div class="message">
            <h2>No hay datos que mostrar</h2>
            <p>No se encontraron registros para este usuario.</p>
        </div>
    </div>
</body>
</html>

<?php
}
?>
