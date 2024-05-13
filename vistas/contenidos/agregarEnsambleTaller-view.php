<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-talleres/agregarEnsambleTaller.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                <?php
                    // Verificar si $_GET['variable'] está definida y no está vacía
                    if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                        // Obtener el valor de $_GET['variable']
                        $Nombre = $_GET['variable'];
                        
                        echo '<h2 style="color: #0053A9" id="nombreTaller">'. $Nombre . '</h2>';
                    }
                    ?>
                    <p></p>
                    <h2 style='color: #0053A9'>Ensambles Disponibles</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar ensamble...">
                    </div>
                    <div class="table-responsive">
                        <table id="alertTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Orden de producción</th>
                                    <th>Cantidad por producción</th>
                                    <th>Contenido</th>
                                    <th>Productos Total</th>
                                    <th class="editar">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                // Verificar si $_GET['variable'] está definida y no está vacía
                                if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                                    // Obtener el valor de $_GET['variable']
                                    $Nombre = $_GET['variable'];
                                    
                                    // Llamar a la función para enlistar productos con la categoría proporcionada
                                    require_once "./controladores/talleresControlador.php";
                                    $insEnsamble = new talleresControlador();
                                    echo $insEnsamble->enlistarEnsambleControlador($Nombre);
                                } else {
                                    // Si $_GET['variable'] no está definida o está vacía, mostrar un mensaje de error o manejar el caso según sea necesario
                                    echo "La variable 'variable' no está definida en la URL.";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination" id="paginationContainer"></div>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/taller-script/agregarEnsamble.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/taller-script/agregarEnsambleCancelarBtn.js" type="module"></script>