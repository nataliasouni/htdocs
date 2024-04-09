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
                    <h2 style='color: #0053A9'>Productos Disponibles Para Alquilar</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar Producto...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>ID</th>
                                <th>Nombre del Producto</th>
                                <th>Detalles</th>
                                <th>Cantidad</th>
                                <th>Alquiler 15 Dias</th>
                                <th>Alquiler 30 Dias</th>
                                <th>Deposito</th>
                                <th class="editar">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php

                            ?>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationContainer">
                            <!-- Aquí se insertará dinámicamente la paginación -->
                        </ul>
                    </nav>
                    <div class="d-flex justify-content-end">
                        <div class="mr-2">
                            <button class="btn btn-primary" onclick="location.href='./agregarAlquiler'">Alquilar Productos</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>