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
                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador" ) {
                        require_once "./controladores/notificacionesControlador.php";
                        $prendasControlador = new notificacionesControlador();
                        $cantidadRegistrosProductos = $prendasControlador->cantidadProductosControlador();
                    ?>
                <a href="<?= SERVERURL; ?>notificaciones">
                <div class="card">
                    <div class="card-content">
                        <div class="content-img">
                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png"
                        alt="Inventario">
                        </div>
                        <div class="card-details">
                            <h2 class="card-title">Inventario</h2>
                            <p class="card-description">Descripción</p>
                            <div class="registradas"><?php echo $cantidadRegistrosProductos; ?> Alertas</div>
                        </div>
                    </div>
                </div>
                </a>
                <?php
                }
                ?>
                <?php
                if ($_SESSION['permiso'] == "Master") {
                        require_once "./controladores/notificacionesControlador.php";
                        $prendasControlador = new notificacionesControlador();
                        $cantidadRegistrosAlertas = $prendasControlador->cantidadInsumosTallerControlador();
                    ?>
                <a href="<?= SERVERURL; ?>notificacionesTaller">
                <div class="card">
                    <div class="card-content">
                        <div class="content-img">
                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                                alt="Talleres">
                        </div>
                        <div class="card-details">
                            <h2 class="card-title">Talleres</h2>
                            <p class="card-description">Aquí podrás ver la info de todos los talleres</p>
                            <div class="registradas"><?php echo $cantidadRegistrosAlertas; ?> Alertas</div>
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
                <div class="card">
                    <div class="card-content">
                        <div class="content-img">
                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/Inventario.png"
                                alt="Inventario">
                        </div>
                        <div class="card-details">
                            <h2 class="card-title">Inventario</h2>
                            <p class="card-description">Descripcion</p>
                            <div class="registradas">Registradas</div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                
            </div>
    </section>
</main>