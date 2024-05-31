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

            <?php
            // Verificar si $_GET['variable'] está definida y no está vacía
                if (isset($_GET['variable']) && !empty($_GET['variable'])) {
                // Obtener el valor de $_GET['variable']
                    $var = $_GET['variable'];
                } else {
                // Si $_GET['variable'] no está definida o está vacía, mostrar un mensaje de error o manejar el caso según sea necesario
                echo "La variable 'variable' no está definida en la URL.";
                }
            ?>

            <!-- Content -->
            <div class="tile-container">
                <a href="<?= SERVERURL; ?>ensambleTaller/taller?variable=<?= $var; ?>">
                <?php
                require_once "./controladores/talleresControlador.php";
                $talleresControladorD = new talleresControlador();
                $cantidadRegistrosD = $talleresControladorD->cantidadEnsambleTallerControlador($var);
                ?> 
                <div class="card">
                    <div class="card-content">
                        <div class="content-img">
                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/ensamble.png"
                                alt="Ensamble">
                        </div>
                        <div class="card-details">
                            <h2 class="card-title">Ensamble</h2>
                            <p class="card-description">Descripción</p>
                            <div class="registradas"><?php echo $cantidadRegistrosD; ?> Registradas</div>
                        </div>
                    </div>
                </div>
                </a>

                <a href="<?= SERVERURL; ?>devolucionDefectos/taller?variable=<?= $var; ?>">
                <?php
                require_once "./controladores/talleresControlador.php";
                $talleresControladorD = new talleresControlador();
                $cantidadRegistrosD = $talleresControladorD->cantidadPrendasDefectuosasControlador($var);
                ?> 
                <div class="card">
                    <div class="card-content">
                        <div class="content-img">
                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/devolucion.png"
                                alt="Devolucion">
                        </div>
                        <div class="card-details">
                            <h2 class="card-title">Devolución por defectos</h2>
                            <p class="card-description">Descripción
                            </p>
                            <div class="registradas"><?php echo $cantidadRegistrosD; ?> Registradas</div>
                        </div>
                    </div>
                </div>
                </a>

                <a href="<?= SERVERURL; ?>prendasQuirurgicas/taller?variable=<?= $var; ?>">
                <?php
                require_once "./controladores/talleresControlador.php";
                $talleresControladorQ = new talleresControlador();
                $cantidadRegistrosQ = $talleresControladorQ->cantidadPrendasQuirurgicasControlador($var);
                ?> 
                <div class="card">
                    <div class="card-content">
                        <div class="content-img">
                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/devolucion.png"
                                alt="Devolucion">
                        </div>
                        <div class="card-details">
                            <h2 class="card-title">Prendas quirurgicas</h2>
                            <p class="card-description">Descripción
                            </p>
                            <div class="registradas"><?php echo $cantidadRegistrosQ; ?> Registradas</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
    </section>
</main>