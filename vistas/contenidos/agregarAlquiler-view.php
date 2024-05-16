<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-alquiler/agregarAlquiler.css">
<?php
if ($_SESSION['permiso'] != "Master") {
    $insLoginControlador->forzarCierreSesionControlador();
    exit();
}

require_once "./controladores/alquilerproductosControlador.php";
$insalquilerproductosControlador = new alquilerproductosControlador();

$datosalquilerproductos = $insalquilerproductosControlador->datosalquilerproductoControlador($pagina[1]);
if ($datosalquilerproductos->rowCount() == 1) {
    $campos = $datosalquilerproductos->fetch();
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
                        <h2 style='color: #0053A9'>Alquilar Producto</h2>
                    </div>

                    <div class="formularioAjax content">
                        <div class="choose-option">
                            <h2 style='color: #0053A9'> Alquiler </h2>
                            <form action="<?php echo SERVERURL; ?>ajax/alquilerAjax.php" method="POST" data-form="save"
                                id="formularioAlquiler">
                                <div class="añadir_alquiler-form">

                                    <div class="form-group">
                                        <p class="titulos_form">Numero de Contrato</p>
                                        <input type="number" name="numeroContrato" id="numeroContrato"
                                            class="login_nombreUsuario" required>
                                    </div>

                                    <div class="form-group">
                                        <p class="titulos_form">Fecha de Entrega</p>
                                        <input type="date" name="fechaEntrega" id="fechaEntrega" class="login_nombreUsuario"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <p class="titulos_form">Fecha de Devolucion</p>
                                        <input type="date" name="fechaDevolucion" id="fechaDevolucion"
                                            class="login_nombreUsuario" readonly>
                                    </div>
                                    <div class="form-group">
                                        <p class="titulos_form">Tiempo de alquiler</p>
                                        <select name="tiempoAlquiler" id="tiempoAlquiler" class="login_nombreUsuario"
                                            required>
                                            <option value="" disabled selected>Seleccionar duración </option>
                                            <option value="15">15 días</option>
                                            <option value="30">30 días</option>
                                            <option value="60">60 días</option>
                                            <option value="90">90 días</option>
                                        </select>
                                    </div>

                                </div>


                                <div class="Productos-group">

                                    <div class="choose-option">
                                        <h2 style='color: #0053A9'>Producto</h2>
                                    </div>

                                    <div class="añadir_producto-form">
                                        <div class="form-group">
                                            <p class="titulos_form">ID</p>
                                            <input type="text" name="idProducto" class="login_nombreUsuario"
                                                value="<?= $campos['id'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <p class="titulos_form">Nombre del Producto</p>
                                            <input type="text" name="nombreProducto" id="nombreProducto"
                                                class="login_password" value="<?= $campos['nombreproducto'] ?>" required
                                                oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');">
                                        </div>
                                        <div class="form-group">
                                            <p class="titulos_form">Detalles del Producto</p>
                                            <input type="text" name="trabajadorUp" class="login_password"
                                                value="<?= $campos['detalles'] ?>" required
                                                oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');">
                                        </div>
                                        <div class="form-group">
                                            <p class="titulos_form">Deposito</p>
                                            <input type="text" name="trabajadorUp" class="login_password"
                                                value="<?= $campos['deposito'] ?>" required
                                                oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');">
                                        </div>


                                        <div class="totalPagar">
                                            <p class="titulos_form">Total a Pagar</p>
                                            <input type="text" name="totalPagar" class="login_nombreUsuario" required>
                                        </div>
                                    </div>
                                </div>



                                <div class="Cliente-group">
                                    <div class="choose-option">
                                        <h2 style='color: #0053A9'>Informacion del Cliente</h2>
                                    </div>
                                    <div class="añadir_cliente-form">
                                        <div class="form-group">
                                            <p class="titulos_form">Nombre del Cliente</p>
                                            <input type="text" name="nombreCliente" id="nombreCliente"
                                                class="login_nombreUsuario" required>
                                        </div>
                                        <div class="form-group">
                                            <p class="titulos_form">Cedula </p>
                                            <input type="text" name="cedulaCliente" id="cedulaCliente"
                                                class="login_nombreUsuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Imagen" class="titulos_form">Fotocopia de la Cedula</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="Imagen"
                                                    name="fotocopiaCedula" accept="image/*" lang="es" required>
                                                <label class="custom-file-label" id="customFileLabel"
                                                    for="Imagen">Seleccionar
                                                    archivo...</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Imagen" class="titulos_form">Fotocopia del Recibo</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="Imagen"
                                                    name="fotocopiaRecibo" accept="image/*" lang="es" required>
                                                <label class="custom-file-label" id="customFileLabel"
                                                    for="Imagen">Seleccionar
                                                    archivo...</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p class="titulos_form">Direccion</p>
                                            <input type="text" name="Direccion" class="login_nombreUsuario" required>
                                        </div>
                                        <div class="form-group">
                                            <p class="titulos_form">Telefono</p>
                                            <input type="text" name="Telefono" class="login_nombreUsuario" required>
                                        </div>
                                    </div>


                                    <div class="Cliente-group">
                                        <div class="choose-option">
                                            <h2 style='color: #0053A9'>Referencias Personales</h2>
                                        </div>
                                        <div class="referenciasPersonales1-form">
                                            <div class="ref-group">
                                                <p class="titulos_form">Nombre del Referente 1</p>
                                                <input type="text" name="nombreReferencia1" class="login_nombreUsuario"
                                                    required>
                                            </div>
                                            <div class="refTel-group">
                                                <p class="tituloT_form">Telefono </p>
                                                <input type="text" name="telefonoReferencia1" class="login_nombreUsuario"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="referenciasPersonales2-form">
                                            <div class="ref-group">
                                                <p class="titulos_form">Nombre del Referente 2</p>
                                                <input type="text" name="nombreReferencia2" class="login_nombreUsuario"
                                                    required>
                                            </div>
                                            <div class="refTel-group">
                                                <p class="tituloT_form">Telefono </p>
                                                <input type="text" name="telefonoReferencia2" class="login_nombreUsuario"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="Cliente-group">
                                            <div class="contratoPagare">
                                                <h2 style='color: #0053A9'>Contrato y Pagare</h2>
                                            </div>

                                            <div class="form-group botones">
                                                <!-- Botón para generar el contrato -->
                                                <a class="contrato" style="cursor: pointer" title="Generar Contrato"
                                                    onclick="generarContrato()">Generar Contrato y Pagare</a>
                                                <!-- Botón para generar el pagaré -->

                                            </div>

                                            <div class="form-group">
                                                <label for="Imagen" class="titulos_form">Subir Contrato y Pagare</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Imagen"
                                                        name="contratoPagare" accept="image/*" lang="es" required>
                                                    <label class="custom-file-label" id="customFileLabel"
                                                        for="Imagen">Seleccionar
                                                        archivo...</label>
                                                </div>
                                            </div>






                                            <div class="form-group botones">
                                                <button class="estado-enviar" type="submit" style="cursor: pointer"
                                                    title="Enviar" name="Enviar">Agregar</button>
                                                <button id="botonCancelarAl" type="button" class="estado-cancelar"
                                                    style="cursor: pointer" title="Cancelar"
                                                    name="Cancelar">Cancelar</button>
                                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </main>


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
    <script src="<?php echo SERVERURL; ?>vistas/js/alquiler-script/alquiler.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/js/alquiler-script/botonCancelarAl.js" type="module"></script>

