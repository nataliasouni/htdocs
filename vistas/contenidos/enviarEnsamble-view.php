<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-talleres/enviarEnsambleTaller.css">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">
<script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.min.js"></script>
<?php

require_once "./controladores/ensambleControlador.php";
$insEnsambleControlador = new ensambleControlador();

$datosEnsamble = $insEnsambleControlador->datosEnsambleControlador($pagina[1]);
if ($datosEnsamble->rowCount() == 1) {
    $campos = $datosEnsamble->fetch();
    ?>

    <main class="full-box main-container">
        <?php include "./vistas/inc/NavLateral.php"; ?>
        <?php include "./vistas/inc/header.php"; ?>

        <section class="full-box page-content">
            <div class="page-content">
                <div class="tile-container">

                    <!-- Formulario para agregar ensamble -->
                    <div class="choose-option">
                        <h2 style='color: #0053A9'> Enviar ensamble</h2>
                    </div>

                    <form class="formularioAjax content" action="<?php echo SERVERURL; ?>ajax/ensambleAjax.php"
                        method="POST" data-form="save">
                        <div class="añadir_cleinte-form">
                            <div class="form-group">
                                <p class="titulos_form">Orden de Producción</p>
                                <input type="text" name="OrdenProduccion" value="<?= $campos['ensamble_id'] ?>"
                                    class="login_nombreUsuario" disabled>
                                <?php
                                // Verificar si $_GET['variable'] está definida y no está vacía
                                if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                                    // Obtener el valor de $_GET['variable']
                                    $Nombre = $_GET['variable'];
                                }
                                ?>
                                <input type="hidden" name="nombretaller"
                                    value="<?php echo isset($Nombre) ? $Nombre : ''; ?>" class="login_nombreUsuario">

                            </div>
                            <div class="form-group">
                                <p class="titulos_form">Cantidad de Producción</p>
                                <input type="number" value="<?= $campos['CantidadProduccion'] ?>" name="CantidadPUp1"
                                    class="login_password" disabled>
                            </div>

                            <div class="gestionarProducto">
                                <div class="choose-option">
                                    <h2 style='color: #0053A9'>Productos del ensamble</h2>
                                </div>
                                <div class="choose-option">
                                    <p>A cada producto agrega la cantidad que desea enviar, en caso de que no sea necesario ponga 0</p>
                                </div>
                                <div class="filter-container">
                                    <input type="text" class="form-control" id="filterInputP"
                                        placeholder="Buscar producto...">
                                </div>
                                <div class="table-responsive">
                                    <table id="alertTableP" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Cantidad disponible</th>
                                                <th>Cantidad a enviar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                   
                                            require_once "./controladores/talleresControlador.php";
                                            $insEnsamble = new talleresControlador();
                                            echo $insEnsamble->enlistarProductoControlador($campos['ensamble_id']);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination" id="paginationContainerP"></div>
                            </div>

                            <div class="gestionarProducto">
                                <div class="choose-option">
                                    <h2 style='color: #0053A9'>Prendas a enviar del ensamble</h2>
                                </div>
                                <div class="choose-option">
                                    <p>A cada prenda agrega la cantidad que desea enviar, en caso de que no sea necesario ponga 0</p>
                                </div>
                                <div class="filter-container">
                                    <input type="text" class="form-control" id="filterInputPr"
                                        placeholder="Buscar producto...">
                                </div>
                                <div class="table-responsive">
                                    <table id="alertTablePr" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Cantidad disponible</th>
                                                <th>Cantidad a enviar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once "./controladores/talleresControlador.php";
                                            $insEnsamble = new talleresControlador();
                                            echo $insEnsamble->enlistarPrendasControlador();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination" id="paginationContainerPr"></div>
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

    <script src="<?php echo SERVERURL; ?>vistas/js/taller-script/ensamble.js"></script>
    <script src="<?php echo SERVERURL; ?>vistas/js/ensamble-script/cancelarBtn.js" type="module"></script>

    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>No hay datos que mostrar del ensamble</title>
        <!-- Css editar usuarios - Usuario no encontrado -->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-usuarios/noEncontrado.css">
    </head>

    <body>
        <div class="container">
            <div class="message">
                <h2>No hay datos que mostrar</h2>
                <p>No se encontraron registros para este ensamble.</p>
            </div>
        </div>

        <?php
}
?>