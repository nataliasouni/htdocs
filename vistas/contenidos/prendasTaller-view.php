<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-talleres/devolucionDefectos.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9' id="titulo">Prendas Defectuosas</h2>
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
                                    // Obtener el valor de $_GET['variable']
                                    $cedula = $_SESSION['cedula'];
                                    // Llamar a la función para enlistar productos con la categoría proporcionada
                                    require_once "./controladores/talleresControlador.php";
                                    $insTaller = new talleresControlador();
                                    echo $insTaller->enlistarDefectuosasTallerControlador($cedula);
                                ?>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationContainer">
                            <!-- Aquí se insertará dinámicamente la paginación -->
                        </ul>
                    </nav>
                    <div class="d-flex justify-content-end">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/taller-script/devolucionDefectos.js"></script>