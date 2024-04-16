<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-alquiler/agregarAlquiler.css">

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
                    <form  action="<?php echo SERVERURL; ?>ajax/registroESAjax.php" method="POST" data-form="save">
                    <div class="añadir_cleinte-form">    
                    <div class="form-group">
                            <p class="titulos_form">ID</p>
                            <input type="text" name="ID" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fecha de Alquiler</p>
                            <input type="text" name="fechaAlquiler" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fecha de Entrega</p>
                            <input type="text" name="fechaEntrega" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Tiempo de alquiler</p>
                            <input type="text" name="tiempoAlquiler" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Total a Pagar</p>
                            <input type="text" name="totalPagar" class="login_nombreUsuario" required>
                        </div>
                        </div>
                        

                        <div class="Productos-group">
                        <div class="choose-option">
                            <h2 style='color: #0053A9'>Productos</h2>
                        </div>
                        <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar Producto...">
                        </div>
                        <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Producto</th>
                                <th>Detalles</th>
                                <th>Cantidad</th>
                                <th>Precio Alquiler</th>
                                <th>Deposito</th>
                                <th class="editar">Opciones</th>
                            </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php

                                ?>
                            </tbody>
                        </table>

                        <div class="Cliente-group">
                        <div class="choose-option">
                            <h2 style='color: #0053A9'>Informacion del Cliente</h2>
                        </div>
                        <div class="añadir_cliente-form">
                        <div class="form-group">
                            <p class="titulos_form">Nombre del Cliente</p>
                            <input type="text" name="nombreCliente" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Cedula </p>
                            <input type="text" name="cedulaCliente" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fotocopia Cedula</p>
                            <input type="text" name="fotocopiaCedula" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Fotocopia de Recibo</p>
                            <input type="text" name="fotocopiaRecibo" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Direccion</p>
                            <input type="text" name="direccion" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Telefono</p>
                            <input type="text" name="telefono" class="login_nombreUsuario" required>
                        </div>
                        </div>

                        
                        <div class="Cliente-group">
                        <div class="choose-option">
                        <h2 style='color: #0053A9'>Referencias Personales</h2>
                        </div>
                        <div class="referenciasPersonales1-form">
                        <div class="ref-group">
                            <p class="titulos_form">Nombre del Referente 1</p>
                            <input type="text" name="nombreReferencia1" class="login_nombreUsuario" required>
                        </div>
                        <div class="refTel-group">
                            <p class="tituloT_form">Telefono </p>
                            <input type="text" name="telefonoReferencia1" class="login_nombreUsuario" required>
                        </div>
                        </div>

                        <div class="referenciasPersonales2-form">
                        <div class="ref-group">
                            <p class="titulos_form">Nombre del Referente 2</p>
                            <input type="text" name="nombreReferencia2" class="login_nombreUsuario" required>
                        </div>
                        <div class="refTel-group">
                            <p class="tituloT_form">Telefono </p>
                            <input type="text" name="telefonoReferencia2" class="login_nombreUsuario" required>
                        </div>
                        </div>

                        <div class="Cliente-group">
                        <div class="choose-option">
                            <h2 style='color: #0053A9'>Contrato y Pagare</h2>
                        </div>




                        <div class="form-group botones">
                            <button class="estado-enviar" type="submit" style="cursor: pointer" title="Enviar" name="Enviar">Agregar</button>
                            <button id="botonCancelarES" type="button" class="estado-cancelar" style="cursor: pointer" title="Cancelar" name="Cancelar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

