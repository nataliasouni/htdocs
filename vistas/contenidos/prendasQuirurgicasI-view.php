<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-talleres/prendasQuirurgicas.css">
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
                    <h2 style='color: #0053A9' id="titulo">Prendas Quirurgicas</h2>
                </div>

                <div class="gestionarCliente">
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
<script src="<?php echo SERVERURL; ?>vistas/js/prendasQ-script/cancelarBtn.js" type="module"></script>

