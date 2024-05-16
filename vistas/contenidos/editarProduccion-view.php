<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-produccionMaster/produccionMaster.css">
<?php
// Verificar permisos de usuario
if ($_SESSION['permiso'] != "Master") {
    $insLoginControlador->forzarCierreSesionControlador();
    exit();
}

require_once "./controladores/produccionControlador.php";
$insProduccionControlador = new produccionControlador();

// Obtener datos del registroES
$datosProduccion = $insProduccionControlador->datosProduccionControlador($pagina[1]);


if ($datosProduccion->rowCount() == 1) {
    $campos = $datosProduccion->fetch();
?>

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>
    
    <?php include "./vistas/inc/header.php"; ?>
    
    <section class="full-box page-content">
        <div class="page-content">
            <!-- Content  -->
            <div class="tile-container">
                <div class="choose-option">
                    <h2 style='color: #0053A9'>Editar produccion</h2>
                </div>

                <form class="formularioAjax content campo"  method="POST" action="<?php echo SERVERURL; ?>ajax/produccionMAjax.php" data-form="update">
                    <input type="hidden" name="idUpdate" value="<?= $pagina[1] ?>">
                    
                    <div class="añadir_cleinte-form">
                        <div class="form-group">
                            <p class="titulos_form">Nombre del trabajador</p>
                            <input type="text" name="id" class="login_nombreUsuario" value="<?= $campos['nombre_trabajador'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Taller</p>
                            <input type="text" name="cedulaUp" class="login_nombreUsuario" value="<?= $campos['nombre_taller'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fecha</p>
                            <input type="text" name="fechaUp" class="login_password" value="<?= $campos['fecha'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Prenda elaborada</p>
                            <input type="text" name="horaEntradaUp" class="login_password" value="<?= $campos['prenda_elaborada'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Cantidad de prendas</p>
                            <input type="number" name="prendasquirurgicas" class="login_password" value="<?= $campos['prendasquirurgicas'] ?>" required min="0" inputmode="numeric">
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Prendas defectuosas</p>
                            <input type="number" name="prendasdefectuosas" class="login_password" value="<?= $campos['prendasdefectuosas'] ?>" required min="0" inputmode="numeric">
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

<script src="<?php echo SERVERURL; ?>vistas/js/produccionMaster-script/cancelarEdicionProduccionM.js" type="module"></script>

<?php
} else {
?>

<!DOCTYPE html>
<html>
<head>
    <title>No hay datos que mostrar de la produccion</title>
    <!-- Css editar usuarios - Usuario no encontrado -->
</head>
<body>
    <div class="container">
        <div class="message">
            <h2>No hay datos que mostrar</h2>
            <p>No se encontraron registros de produccion.</p>
        </div>
    </div>
</body>
</html>

<?php
}
?>
