<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-trabajador/trabajador.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Trabajadores</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar trabajador...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Cédula</th>
                                <th>Nombre de Trabajador</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th class="editar">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            require_once "./controladores/trabajadorControlador.php";
                            $insTrabajador = new trabajadorControlador();
                            echo $insTrabajador->enlistarTrabajadorControlador();
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
                            <button class="btn btn-primary" onclick="location.href='./agregarTrabajador'">Agregar Trabajador</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo SERVERURL; ?>vistas/js/trabajador-script/trabajador.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/trabajador-script/botonCancelar.js" type="module"></script>