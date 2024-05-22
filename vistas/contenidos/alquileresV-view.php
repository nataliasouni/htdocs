<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-alquiler/alquiler.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Alquileres Vencidos</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar Producto...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Numero de Alquiler</th>
                                <th>Nombre del cliente </th>
                                <th>Codigo del Producto </th>
                                <th>Nombre del Producto</th>
                                <th>Fecha de Entrega</th>
                                <th>Fecha de Devolucion</th>
                                <th>Tiempo Restante</th>
                                <th>Estado</th>
                                <th class="editar">Opciones</th>

                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            require_once "./controladores/alquilerControlador.php";
                            $insProducto = new alquilerControlador();
                            echo $insProducto->enlistaralquilerVencidoControlador();

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

<script src="<?php echo SERVERURL; ?>vistas/js/alquiler-script/alquilerProductos.js"></script>