
<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-talleres/prendasQuirurgicas.css">
=======
<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-prendasQ/prendasQ.css">


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
                        
                        echo '<h2 id="nombreTaller">'. $Nombre . '</h2>';
                    }
                    ?>
                    <p></p>
                    <h2 style='color: #0053A9' id="titulo">Prendas Quirurgicas</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar registro...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                    <th>Fecha</th>
                                    <th>Tipo de prenda</th>
                                    <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php
                                // Verificar si $_GET['variable'] está definida y no está vacía
                                if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                                    // Obtener el valor de $_GET['variable']
                                    $Nombre = $_GET['variable'];
                                    
                                    // Llamar a la función para enlistar productos con la categoría proporcionada
                                    require_once "./controladores/talleresControlador.php";
                                    $insTaller = new talleresControlador();
                                    echo $insTaller->enlistarPrendasQControlador($Nombre);
                                } else {
                                    // Si $_GET['variable'] no está definida o está vacía, mostrar un mensaje de error o manejar el caso según sea necesario
                                    echo "La variable 'variable' no está definida en la URL.";
                                }
                                ?>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationContainer">
                            <!-- Aquí se insertará dinámicamente la paginación -->
                        </ul>
                    </nav>
                    <div class="d-flex justify-content-end">
                    <h2 style='color: #0053A9'>Prendas Quirurgicas</h2>
                </div>

                <div class="gestionarProducto">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar prenda...">
                    </div>
                    <div class="table-responsive">
                        <table id="alertTableProductos" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th class="editar">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once "./controladores/prendasControlador.php";
                                    $insPrendas = new prendasControlador();
                                    echo $insPrendas->enlistarPrendaControlador();
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="pagination" id="paginationContainer"></div>
                    <div class="text-center">
                        <button class="btn btn-primary"
                            onclick="location.href='./agregarPrenda'">Agregar
                            Prenda Quirurgica</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>



<script src="<?php echo SERVERURL; ?>vistas/js/taller-script/prendaQuirurgica.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/prendasQ-script/prendasQ.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/prendasQ-script/cancelarBtn.js" type="module"></script>

