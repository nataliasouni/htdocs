<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <div class="banner">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img1.jpg" alt="Primera imagen">
                            <div class="carousel-caption">
                                <h3>A.M.U(Ayudas Medicas Universales)</h3>
                                <h4>Hacemos más fácil tu vivir</h4>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img2.jpg" alt="Segunda imagen">
                            <div class="carousel-caption">
                                <h3>A.M.U(Ayudas Medicas Universales)</h3>
                                <h4>Hacemos más fácil tu vivir</h4>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img3.jpg" alt="Tercera imagen">
                            <div class="carousel-caption">
                                <h3>A.M.U(Ayudas Medicas Universales)</h3>
                                <h4>Hacemos más fácil tu vivir</h4> 
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img4.jpg" alt="Cuarta imagen">
                            <div class="carousel-caption">
                                <h3>A.M.U(Ayudas Medicas Universales)</h3>
                                <h4>Hacemos más fácil tu vivir</h4>
                            </div>
                        </div>
                        <!-- Agrega más imágenes aquí -->
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>

            <div class="choose-option">
                <h2 style='color: #0053A9'>Elegir opción</h2>
            </div>

            <!-- Content -->
            <div class="tile-container">
                <?php
                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") {
                    require_once "./controladores/notificacionesControlador.php";
                    $prendasControlador = new notificacionesControlador();
                    $cantidadAlertas = $prendasControlador->cantidadAlertas();
                    ?>
                    <a href="<?= SERVERURL; ?>homeN">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/notificaciones.png"
                                        alt="Notificaciones">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Notificaciones</h2>
                                    <p class="card-description">Aquí podrás ver tus notificaciones respecto al inventario y
                                        producción</p>
                                    <div class="registradas"><?php echo $cantidadAlertas; ?> Alertas</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Taller") {
                    ?>
                    <a href="<?= SERVERURL; ?>solicitarInsumosTalleres">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/ensamble.png"
                                        alt="Notificaciones">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Solicitar materia prima</h2>
                                    <p class="card-description">Aquí podrás solicitar insumos </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Taller") {
                    ?>
                    <a href="<?= SERVERURL; ?>homeOTT">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png"
                                        alt="Inventario">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Inventario</h2>
                                    <p class="card-description">Aquí podrás encontrar información de tus insumos y producciones
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") {
                    ?>
                    <a href="<?= SERVERURL; ?>homeI">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png"
                                        alt="Inventario">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Inventario</h2>
                                    <p class="card-description">Aquí podrás los diferentes productos disponibles en tu
                                        tienda
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master") {
                    ?>
                    <a href="<?= SERVERURL; ?>homeT">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                                        alt="Control de Talleres">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Control de Talleres</h2>
                                    <p class="card-description">Aquí podrás ver el material de los talleres que actualmente
                                        tienen disponible
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") {
                    ?>
                    <a href="<?= SERVERURL; ?>homeGT">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/obrero.png"
                                        alt="Control de Trabajadores">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Control de Trabajadores</h2>
                                    <p class="card-description">Aquí podrás llevar el seguimiento de los trabajadores
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") {
                    require_once "./controladores/alquilerproductosControlador.php";
                    $produccionControlador = new alquilerproductosControlador();
                    $cantidadRegistros = $produccionControlador->cantidadpalquilerControlador();
                    ?>
                    <a href="<?= SERVERURL; ?>alquilerProductos">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/alquiler.png"
                                        alt="Alquiler de productos">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Alquiler de productos</h2>
                                    <p class="card-description">Aquí podrás llevar el proceso de alquiler
                                        de los productos de tu tienda
                                    </p>
                                    <div class="registradas"> <?php echo $cantidadRegistros; ?> Registradas</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") {
                    ?>
                    <a href="<?= SERVERURL; ?>homeAlquileres">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/control.png"
                                        alt="Control de Alquleres">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Control de Alquiler</h2>
                                    <p class="card-description">Aqui podrás llevar el proceso de alquiler en tu tienda
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") {
                    ?>
                    <a href="https://calendar.google.com/calendar/u/0/r" target="_blank">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/cita.png" alt="Cita">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Citas</h2>
                                    <p class="card-description">Aquí podrás ver las citas agendadas</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master") {
                    require_once "./controladores/produccionControlador.php";
                    $produccionControlador = new produccionControlador();
                    $cantidadRegistros = $produccionControlador->cantidadRegistrosProduccionControlador();
                    ?>
                    <a href="<?= SERVERURL; ?>produccionMaster">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/produccion.png"
                                        alt="Control de Producción">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Control de producción</h2>
                                    <p class="card-description">Aqui podrás llevar el control de la producción de los
                                        trabajadores
                                        actuales
                                    </p>
                                    <div class="registradas"> <?php echo $cantidadRegistros; ?> Registradas </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Produccion") {
                    ?>
                    <a href="<?= SERVERURL; ?>produccion">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/registro.png"
                                        alt="Registro de produccion">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Registro de Producción</h2>
                                    <p class="card-description">Aqui podrás subir la producción de los trabajadores 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Cliente") {
                    ?>
                    <a href="<?= SERVERURL; ?>agendarCitas">
                        <div class="card">
                            <div class="card-content">
                                <div class="content-img">
                                    <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/cita.png"
                                        alt="Registro de produccion">
                                </div>
                                <div class="card-details">
                                    <h2 class="card-title">Agendamiento de citas</h2>
                                    <p class="card-description">Aquí podrás registrar tus citas con la doctora Diana
                                    </p>
                                    <div class="registradas"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
    </section>
</main>