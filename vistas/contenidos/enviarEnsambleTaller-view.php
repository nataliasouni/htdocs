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
        <!-- Incluir la barra lateral -->
        <?php include "./vistas/inc/NavLateral.php"; ?>

        <?php include "./vistas/inc/header.php"; ?>

        <section class="full-box page-content">

            <div class="page-content">

                <!-- Content -->
                
                    <div class="choose-option">
                    <?php
                    // Verificar si $_GET['variable'] está definida y no está vacía
                    if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                        // Obtener el valor de $_GET['variable']
                        $Nombre = $_GET['variable'];
                        
                        echo '<h2 id="nombreTaller">'. $Nombre . '</h2>';
                    }
                    ?>
                    <p></p>
                        <h2 style='color: #0053A9'>Informacion del ensamble</h2>
                    </div>

                    <form action="#" method="POST">
                        <input type="hidden" name="idEnsambleUp1" value="<?= $pagina[1] ?>">

                        <div class="añadir_producto-form">
                            <div class="form-group">
                                <p class="titulos_form">Orden de Producción</p>
                                <input type="text" name="OrdenProduccionUp1" value="<?= $campos['ensamble_id'] ?>"
                                    class="login_nombreUsuario" disabled>
                                <input type="hidden" name="OrdenProduccionUp2" value="<?= $campos['ensamble_id'] ?>"
                                    class="login_nombreUsuario" >
                                        <?php
                                        // Verificar si $_GET['variable'] está definida y no está vacía
                                        if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                                            // Obtener el valor de $_GET['variable']
                                            $Nombre = $_GET['variable'];
                                        }
                                        ?>
                                        <input type="hidden" name="nombretaller" value="<?php echo isset($Nombre) ? $Nombre : ''; ?>" class="login_nombreUsuario">

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
                                            // Obtener los productos asociados a este ensamble
                                            $productosEnsamble = $insEnsambleControlador->obtenerProductosEnsambleControlador($campos['ensamble_id'] ?? 0);
                                            while ($producto = $productosEnsamble->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $producto['Id'] ?>
                                                        <input type="hidden" name="IdProducto[<?= $producto['Id'] ?>]"
                                                            value="<?= $producto['Id'] ?>" disabled>
                                                    </td>
                                                    <td>
                                                        <?= $producto['Nombre'] ?>
                                                    </td>
                                                    <!-- Agrega campos de entrada para la cantidad y el estado pendiente -->
                                                    <td><input type="number" name="CantidadUp[<?= $producto['Id'] ?>]"
                                                            value="<?= $producto['cantidad'] ?>" class="producto_cantidad"
                                                            disabled></td>
                                                    <td>
                                                        <select class="selectform area"
                                                            name="PendienteUp[<?= $producto['Id'] ?>]" disabled>
                                                            <option value="Si" <?php if ($producto['Pendiente'] == "Si") {
                                                                echo "selected";
                                                            } ?>>Está Pendiente</option>
                                                            <option value="No" <?php if ($producto['Pendiente'] == "No") {
                                                                echo "selected";
                                                            } ?>>No está pendiente</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>   
                                </div>
                                <div class="pagination" id="paginationContainer"></div>
                            </div>

                            <div class="gestionarProducto">
                                <div class="choose-option">
                                    <h2 style='color: #0053A9'>Productos a enviar</h2>
                                </div>
                                <div class="choose-option">
                                    
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Obtener los productos asociados a este ensamble
                                            $productosEnsamble = $insEnsambleControlador->obtenerProductosEnsambleControlador($campos['ensamble_id'] ?? 0);
                                            while ($producto = $productosEnsamble->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $producto['Id'] ?>
                                                        <input type="hidden" name="IdProducto[<?= $producto['Id'] ?>]" value="<?= $producto['Id'] ?>">
                                                    </td>
                                                    <td>
                                                        <?= $producto['Nombre'] ?>
                                                    </td>
                                                    <!-- Agrega campos de entrada para la cantidad y el estado pendiente -->
                                                    <td><input type="number" name="NuevaCantidad[<?= $producto['Id'] ?>]" class="producto_cantidad"required>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>   
                                </div>
                                <div class="pagination" id="paginationContainer"></div>
                            </div>
                            <div class="gestionarProducto">
                                <div class="choose-option">
                                    <h2 style='color: #0053A9'>Prendas Cortadas</h2>
                                </div>
                                <div class="choose-option">
                                    
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once "./controladores/prendasCControlador.php";
                                            $prendasControlador = new prendasCControlador();
                                            $prendas = $prendasControlador->obtenerPrendasCortadasControlador();
                                            while ($producto = $prendas->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $producto['id'] ?>
                                                        <input type="hidden" name="IdPrenda[<?= $producto['id'] ?>]" value="<?= $producto['id'] ?>" disabled>
                                                    </td>
                                                    <td>
                                                        <?= $producto['Nombre'] ?>
                                                    </td>
                                                    <!-- Agrega campos de entrada para la cantidad y el estado pendiente -->
                                                    <td><input type="number" name="CantidadPrendaUp[<?= $producto['id'] ?>]" value="<?= $producto['Cantidad'] ?>" class="producto_cantidad" disabled></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>   
                                </div>
                                <div class="pagination" id="paginationContainer"></div>
                            </div>
                            <div class="gestionarProducto">
                                <div class="choose-option">
                                    <h2 style='color: #0053A9'>Prendas a enviar</h2>
                                </div>
                                <div class="choose-option">
                                    
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once "./controladores/prendasCControlador.php";
                                            $prendasControlador = new prendasCControlador();
                                            $prendas = $prendasControlador->obtenerPrendasCortadasControlador();
                                            while ($producto = $prendas->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $producto['id'] ?>
                                                        <input type="hidden" name="IdPrenda1[]" value="<?= $producto['id'] ?>" >

                                                    </td>
                                                    <td>
                                                        <?= $producto['Nombre'] ?>
                                                    </td>
                                                    <!-- Agrega campos de entrada para la cantidad y el estado pendiente -->
                                                    <td><input type="number" name="CantidadPrendaUp1[<?= $producto['id'] ?>]" required></td>


                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>   
                                </div>
                                <div class="pagination" id="paginationContainer"></div>
                            </div>
                        </div>
                        <div class="boton">
                        <button id="enviar" title="Enviar" class="estado-volver" name="enviarDatos" type="submit">Enviar</button>   
                    </form>
                    <a onclick="window.history.back();"><button class="estado-volver" title="Volver"
                                name="Volver">Volver</button></a>
                                </div>
                </div>
                <?php
        ?>

    <?php
    if(isset($_POST['enviarDatos'])) {
        // Procesar los datos del formulario
        require_once "./controladores/talleresControlador.php";
        $controlador = new talleresControlador();
        $controlador->actualizarPrendasEnviadasControlador($_POST);
    }
    ?>



        </section>

    </main>

    <script src="<?php echo SERVERURL; ?>vistas/js/producto-script/producto.js"></script>

    <script src="<?php echo SERVERURL; ?>vistas/js/producto-script/cancelarEdicion.js" type="module"></script>

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