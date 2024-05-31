<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-alquiler/detallesAlquiler.css">
<?php


require_once "./controladores/alquilerControlador.php";
$insalquilerControlador = new alquilerControlador();

$datosalquiler = $insalquilerControlador->datosalquilerControlador($pagina[1]);
if ($datosalquiler->rowCount() == 1) {
    $campos = $datosalquiler->fetch();
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
                        <h2 style='color: #0053A9'>Alquiler</h2>
                    </div>


                    <div class="choose-option">

                        <form class="formularioAjax content" action="<?php echo SERVERURL; ?>ajax/alquilerAjax.php"
                            method="POST" data-form="update" id="formularioContrato">
                            <input type="hidden" name="alquilerUp" value="<?= $pagina[1] ?>">
                            <div class="añadir_alquiler-form">

                                <div class="form-group">
                                    <p class="titulos_form">Estado del Alquiler</p>
                                    <select name="estado" class="login_nombreUsuario">
                                        <option value="En proceso">En proceso</option>
                                        <option value="Terminado">Terminado</option>
                                        <option value="Vencido">Vencido</option>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <p class="titulos_form">Numero de Contrato</p>
                                    <input type="number" name="alquilerUpdate" id="alquilerUpdate"
                                        class="login_nombreUsuario" value="<?= $campos['numeroalquiler'] ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <p class="titulos_form">Fecha de Entrega</p>
                                    <input type="date" name="fechaEntrega" id="fechaEntrega" class="login_nombreUsuario"
                                        value="<?= $campos['fechaentrega'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Fecha de Devolucion</p>
                                    <input type="date" name="fechaDevolucion" id="fechaDevolucion"
                                        class="login_nombreUsuario" value="<?= $campos['fechadevolucion'] ?>" readonly
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <p class="titulos_form">Tiempo de alquiler</p>
                                    <input type="text" name="tiempoAlquiler" id="tiempoAlquiler" class="login_nombreUsuario"
                                        value="<?= $campos['tiempodias'] ?>" readonly>

                                </div>

                            </div>


                            <div class="Productos-group">

                                <div class="choose-option">
                                    <h2 style='color: #0053A9'>Producto</h2>
                                </div>

                                <div class="añadir_producto-form">
                                    <div class="form-group">
                                        <p class="titulos_form">ID</p>
                                        <input type="number" name="idProducto" class="login_nombreUsuario"
                                            value="<?= $campos['id'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <p class="titulos_form">Nombre del Producto</p>
                                        <input type="text" name="nombreProducto" id="nombreProducto" class="login_password"
                                            value="<?= $campos['nombre_producto'] ?>" readonly
                                            oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');">
                                    </div>
                                    <div class="form-group">
                                        <p class="titulos_form">Detalles del Producto</p>
                                        <input type="text" name="trabajadorUp" class="login_password"
                                            value="<?= $campos['detalles_producto'] ?>" readonly
                                            oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');">
                                    </div>
                                    <div class="form-group">
                                        <p class="titulos_form">Deposito</p>
                                        <input type="text" name="deposito" class="login_password"
                                            value="<?= $campos['deposito_producto'] ?>" readonly
                                            oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');">
                                    </div>


                                    <div class="totalPagar">
                                        <p class="titulos_form">Total a Pagar</p>
                                        <input type="number" name="totalPagar" class="login_nombreUsuario"
                                            value="<?= $campos['totalpagar'] ?>" readonly>
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
                                            class="login_nombreUsuario" value="<?= $campos['nombrecliente'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <p class="titulos_form">Cedula </p>
                                        <input type="text" name="cedulaCliente" id="cedulaCliente"
                                            class="login_nombreUsuario" value="<?= $campos['cedulacliente'] ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <p class="titulos_form">Direccion</p>
                                        <input type="text" name="Direccion" id="Direccion" class="login_nombreUsuario"
                                            value="<?= $campos['direccion'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <p class="titulos_form">Telefono</p>
                                        <input type="text" name="Telefono" id="Telefono" class="login_nombreUsuario"
                                            value="<?= $campos['telefono'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="fotocopias">
                                    <div class="form-group">
                                        <label for="FotocopiaC" class="titulos_form">Fotocopia de la Cedula</label>
                                        <!-- Aquí agregamos la vista previa del PDF -->
                                        <embed src="<?= SERVERURL . 'src/alquiler/cedula/' . $campos['fotocopiacedula'] ?>"
                                            type="application/pdf" width="400" height="300" />
                                    </div>

                                    <div class="form-group">
                                        <label for="FotocopiaR" class="titulos_form">Fotocopia del Recibo</label>
                                        <embed src="<?= SERVERURL . 'src/alquiler/recibo/' . $campos['fotocopiarecibo'] ?>"
                                            type="application/pdf" width="400" height="300" />
                                    </div>

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
                                            value="<?= $campos['nombreref1'] ?>" readonly>
                                    </div>
                                    <div class="refTel-group">
                                        <p class="tituloT_form">Telefono </p>
                                        <input type="text" name="telefonoReferencia1" class="login_nombreUsuario"
                                            value="<?= $campos['telefonoref1'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="referenciasPersonales2-form">
                                    <div class="ref-group">
                                        <p class="titulos_form">Nombre del Referente 2</p>
                                        <input type="text" name="nombreReferencia2" class="login_nombreUsuario"
                                            value="<?= $campos['nombreref2'] ?>" readonly>
                                    </div>
                                    <div class="refTel-group">
                                        <p class="tituloT_form">Telefono </p>
                                        <input type="text" name="telefonoReferencia2" class="login_nombreUsuario"
                                            value="<?= $campos['telefonoref2'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="Cliente-group">
                                    <div class="contratoPagare">
                                        <h2 style='color: #0053A9'>Contrato y Pagare</h2>
                                    </div>


                                    <div class="form-group">
                                        <embed src="<?= SERVERURL . 'src/alquiler/contrato/' . $campos['contratopagare'] ?>"
                                            type="application/pdf" width="400" height="300" />
                                    </div>

                        </form>

                        <div class="boton">
                            <button class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar"
                                name="Enviar">Confirmar</button>
                            <a onclick="window.history.back();"><button class="estado-volver" title="Volver"
                                    name="Volver">Volver</button></a>
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

