<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-ensamble/ensamble.css">

<main class="full-box main-container">
    <?php include "./vistas/inc/NavLateral.php"; ?>
    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">
        <div class="page-content">
            <div class="tile-container">

                <!-- Formulario para agregar ensamble -->
                <div class="choose-option">
                    <h2 style='color: #0053A9'> Agregar ensamble</h2>
                </div>

                <form class="formularioAjax content" action="<?php echo SERVERURL; ?>ajax/ensambleAjax.php"
                    method="POST" data-form="save">
                    <div class="añadir_cleinte-form">
                        <div class="form-group">
                            <p class="titulos_form">Orden de Producción</p>
                            <input type="number" name="OrdenProduccion" class="login_nombreUsuario" required>
                        </div>
                        <div class="form-group">
                            <p class="titulos_form">Cantidad de Producción</p>
                            <input type="number" name="CantidadProduccion" class="login_password" required>
                        </div>

                        <div class="gestionarProducto">
                            <div class="choose-option">
                                <h2 style='color: #0053A9'>Productos del ensamble</h2>
                            </div>
                            <div class="choose-option">
                                <p>A cada producto agrega la cantidad y si esta o no pendiente</p>
                            </div>
                            <div class="filter-container">
                                <input type="text" class="form-control" id="filterInput"
                                    placeholder="Buscar producto...">
                            </div>
                            <div class="table-responsive">
                                <table id="alertTable" class="table table-striped">
                                    <thead>
                                        <tr>       
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Pendiente</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once "./controladores/ensambleControlador.php";
                                        $insEnsamble = new ensambleControlador();
                                        echo $insEnsamble->enlistarProductoControlador();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination" id="paginationContainer"></div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="botones">
                            <button id="AgregarEnsamble" class="estado-enviar" style="cursor: pointer"
                                title="Enviar">Agregar</button>
                            <button id="botonCancelar" type="button" class="estado-cancelar" style="cursor: pointer"
                                title="Cancelar" name="Cancelar">Cancelar</button>
                        </div>
                        <input type="hidden" id="datosTabla" name="datosTabla">
                    </div>
                </form>
            </div>
        </div>

    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/ensamble-script/ensamble.js"></script>
<script src="<?php echo SERVERURL; ?>vistas/js/ensamble-script/cancelarBtn.js" type="module"></script>

