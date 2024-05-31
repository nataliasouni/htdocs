<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-trabajador/trabajador.css">
<?php


require_once "./controladores/trabajadorControlador.php";
$insTrabajadorControlador = new trabajadorControlador();

$datosTrabajador = $insTrabajadorControlador->datosTrabajadorControlador($pagina[1]);
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
                        <h2 style='color: #0053A9'>Editar trabajador</h2>
                    </div>
                
                    <form class="formularioAjax content campo" action="<?php echo SERVERURL; ?>ajax/trabajadorAjax.php" method="POST" data-form="update">
                    <input type="hidden" name="trabajadorUpdate" value="<?= $pagina[1] ?>">
                        <div class="añadir_cleinte-form">
                            <div class="form-group">
                                <p class="titulos_form">Cédula</p>
                                <input type="text" name="cedulaUp" class="login_nombreUsuario"
                                    value="<?= $campos['cedula'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Nombre de Trabajador</p>
                                <input type="text" name="trabajadorUp" class="login_password"
                                    value="<?= $campos['nombre'] ?>" required >
                            </div>

                            <div class="form-group">
                                <p class="titulos_form">Telefono</p>
                                <input type="number" name="telefonoUp" class="login_password" value="<?= $campos['telefono'] ?>"
                                    required >
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

    <script src="<?php echo SERVERURL; ?>vistas/js/trabajador-script/cancelarEdicion.js" type="module"></script>
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