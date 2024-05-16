<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-insumo/insumo.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Insumos</h2>
                </div>

                <div class="gestionarProducto">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar producto...">
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
                                    require_once "./controladores/insumoControlador.php";
                                    $insInsumo = new insumoControlador();
                                    echo $insInsumo->enlistarInsumoControlador();
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="pagination" id="paginationContainer"></div>
                    <div class="text-center">
                        <button class="btn btn-primary"
                            onclick="location.href='./agregarInsumo'">Agregar
                            Insumo</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/insumo-script/insumo.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/insumo-script/cancelarBtn.js" type="module"></script>