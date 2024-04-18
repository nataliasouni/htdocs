<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-registroES/registroES.css">
<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Registro Entrada y Salida</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar registro...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                            
                                <th>Cédula</th>
                                <th>Nombre del trabajador</th>
                                <th>Fecha</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
                                <th>Horas trabajadas</th>
                                <th class="editar">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            require_once "./controladores/registroESControlador.php";
                            $insregistroES = new registroESControlador();
                            echo $insregistroES->enlistarRegistroESControlador();
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
                            <button class="btn btn-primary" onclick="location.href='./agregarEntradaRES'">Registrar Entrada</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo SERVERURL; ?>vistas/js/registroES-script/registroES.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/registroES-script/botonCancelarES.js" type="module"></script>