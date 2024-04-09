<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-ensamble/ensamble.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Ensamble Existente</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar usuario...">
                    </div>
                    <div class="table-responsive">
                        <table id="alertTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Orden de producción</th>
                                    <th>Cantidad por producción</th>
                                    <th>Estado</th>
                                    <th>Contenido</th>
                                    <th>Productos Total</th>
                                    <th class="editar">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once "./controladores/ensambleControlador.php";
                                    $insEnsamble = new ensambleControlador();
                                    echo $insEnsamble->enlistarEnsambleControlador();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination" id="paginationContainer"></div>
                    <div class="text-center">
                        <button class="btn btn-primary" onclick="location.href='./agregarEnsamble'">Agregar
                            Ensamble</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/ensamble-script/ensamble.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/ensamble-script/cancelarBtn.js" type="module"></script>