<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-talleres/ensambleTaller.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <p></p>
                    <h2 style='color: #0053A9' id="titulo">Ensambles</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar registro...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Orden de producción</th>
                                <th>Contenido del ensamble</th>
                                <th>Cantidad(PE)</th>
                                <th>Prendas cortadas</th>
                                <th>Cantidad(PC)</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php

                            $cedula = $_SESSION['cedula'];

                            require_once "./controladores/talleresControlador.php";
                            $insEnsamble = new talleresControlador();
                            echo $insEnsamble->enlistarEnsambleTallerControlador($cedula);
                            // Llamar a la función para enlistar productos con la categoría proporcionada
                            
                            ?>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationContainer">
                            <!-- Aquí se insertará dinámicamente la paginación -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</main>


<script src="<?php echo SERVERURL; ?>vistas/js/taller-script/ensambleTaller.js"></script>