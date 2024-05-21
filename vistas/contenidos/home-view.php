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

                            <div class="choose-option">
                                <h2 style='color: #0053A9'>Elegir opción</h2>
                            </div>

                            <!-- Content -->
                            <div class="tile-container">
                                <?php
                                if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") {
                                        require_once "./controladores/prendasControlador.php";
                                        $prendasControlador = new prendasControlador();
                                        $cantidadRegistrosProductos = $prendasControlador->cantidadPrendasQControlador();
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
                                                <p class="card-description">Aqui podrás ver tus notificaciones respecto al inventario y
                                                    producción</p>
                                                <div class="registradas">Alertas</div>
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
                                <a href="<?= SERVERURL; ?>homeN">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="content-img">
                                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/notificaciones.png"
                                                alt="Notificaciones">
                                        </div>
                                        <div class="card-details">
                                            <h2 class="card-title">Notificaciones</h2>
                                            <p class="card-description">Aqui podrás ver tus notificaciones respecto al inventario y
                                                producción</p>
                                            <div class="registradas">Registradas</div>
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
                                            <p class="card-description">Aqui podrás los diferentes productos disponibles en tu tienda
                                            </p>
                                            <div class="registradas">Registradas</div>
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
                                            <p class="card-description">Aqui podrás los diferentes productos disponibles en tu tienda
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
                                            <p class="card-description">Aqui podrás ver el materail de los talleres que actualmente
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
                                            <p class="card-description">Aqui podrás llevar el seguimiento de los trabajadores
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
                                <a href="<?= SERVERURL; ?>alquilerProductos">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="content-img">
                                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/alquiler.png"
                                                alt="Alquiler de productos">
                                        </div>
                                        <div class="card-details">
                                            <h2 class="card-title">Alquiler de productos</h2>
                                            <p class="card-description">Aqui podrás llevar el proceso de alquiler
                                                de producotos de tu tienda
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
                                            <div class="registradas">Registradas</div>
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
                            
                                <div class="card">
                                    <div class="card-content">
                                        <div class="content-img">
                                            <img class="card-image" src="<?php echo SERVERURL; ?>vistas/img/cita.png" alt="Cita">
                                        </div>
                                        <div class="card-details">
                                            <h2 class="card-title">Citas</h2>
                                            <p class="card-description">Aqui podrás ver las citas agendadas
                                            </p>
                                        </div>
                                    </div>
                                </div>
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
                                            <p class="card-description">Aqui podrás llevar el control de la produccion de los trabajadores
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
                                            <p class="card-description">Aqui podrás subir la producción de los trabajadores actuales
                                            </p>
                                            
                                            <div class="registradas">Registradas</div>
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
                                            <p class="card-description">Aqui podrás registrar tus citas con la doctora Diana
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