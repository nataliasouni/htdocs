<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-citas/agendarCitas.css">

<main class="full-box main-container">
    <!-- Incluir la barra header -->
    <?php include "./vistas/inc/headerInicio.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <div class="banner">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img1.jpg" alt="Primera imagen">
                            <div class="carousel-caption">
                                <h5>Título de la primera imagen</h5>
                                <p>Descripción de la primera imagen.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img2.jpg" alt="Segunda imagen">
                            <div class="carousel-caption">
                                <h5>Título de la segunda imagen</h5>
                                <p>Descripción de la segunda imagen.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img3.jpg" alt="Tercera imagen">
                            <div class="carousel-caption">
                                <h5>Título de la tercera imagen</h5>
                                <p>Descripción de la tercera imagen.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SERVERURL; ?>vistas/img/img4.jpg" alt="Cuarta imagen">
                            <div class="carousel-caption">
                                <h5>Título de la cuarta imagen</h5>
                                <p>Descripción de la cuarta imagen.</p>
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
        </diV>



        <div class="content-cita">
            <?php if (isset($_SESSION['permiso'])) { // Verificar si se ha iniciado sesión ?>
                <a href="<?= SERVERURL; ?>generarCita">
                    <div class="card">
                        <img class="card-imgcita" src="<?php echo SERVERURL; ?>vistas/img/cita.png" alt="Agendar citas">
                        <h2>Agendar cita</h2>
                    </div>
                </a>
            <?php } else { // Si no se ha iniciado sesión, redirigir a la página de inicio de sesión ?>
                <a href="<?= SERVERURL; ?>login">
                    <div class="card">
                        <img class="card-imgcita" src="<?php echo SERVERURL; ?>vistas/img/cita.png" alt="Agendar citas">
                        <h2>Agendar cita</h2>
                    </div>
                </a>
            <?php } ?>
            <?php if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == "Cliente") { ?>
                <a href="<?= SERVERURL; ?>ensambleM">
                    <div class="card">
                        <img class="card-imgcita" src="<?php echo SERVERURL; ?>vistas/img/conCita.png"
                            alt="Consultar citas">
                        <h2>Consultar cita</h2>
                    </div>
                </a>
            <?php } ?>
        </div>
        </div>




    </section>

    <?php include "./vistas/inc/footerHome.php"; ?>

</main>