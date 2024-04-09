<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'>Usuarios</h2>
                </div>

                <div class="gestionarCliente">
                    <div class="filter-container">
                        <input type="text" class="form-control" id="filterInput" placeholder="Buscar usuario...">
                    </div>
                    <table id="alertTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Cédula</th>
                                <th>Nombre de usuario</th>
                                <th>Contraseña</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Permiso</th>
                                <th>Estado</th>
                                <th class="editar"></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            require_once "./controladores/usuarioControlador.php";
                            $insUsuario = new usuarioControlador();
                            echo $insUsuario->enlistarUsuarioControlador();
                            ?>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationContainer">
                            <!-- Aquí se insertará dinámicamente la paginación -->
                        </ul>
                    </nav>
                    <div class="text-center">
                        <button class="btn btn-primary" onclick="location.href='./agregarUsuario'">Agregar Usuario</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
