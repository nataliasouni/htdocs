<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/header.css">

<header class="navbar-infohead" id="navbar-infohead">
    <div class="container-header">
        <div class="logo-container">
            <a href="<?= SERVERURL; ?>homePage">
                <img src="<?= SERVERURL; ?>vistas/img/logoAMU.png" alt="Logo">
            </a>
        </div>
        <div class="menu-container">
            <a href="<?= SERVERURL; ?>homePage">Inicio</a>
            <ul>
                <li class="dropdown">
                    <a href="<?php echo SERVERURL; ?>productosHomepage" class="dropbtn">Productos</a>
                    <div class="dropdown-content">
                        <a href="<?php echo SERVERURL; ?>productosHomepage">Todos los Productos</a>
                        <?php
                        $var = "Movilidad y Recuperación";
                        ?>
                        <a href="<?= SERVERURL; ?>productosHomepageCategorias?variable=<?php echo $var; ?>">Movilidad Y
                            recuperación</a>
                        <?php
                        $var2 = "Muebles Hospitalarios";
                        ?>
                        <a href="<?= SERVERURL; ?>productosHomepageCategorias?variable=<?php echo $var2; ?>">Muebles
                            hospitalarios</a>
                        <?php
                        $var3 = "Línea Respiratoria";
                        ?>
                        <a href="<?= SERVERURL; ?>productosHomepageCategorias?variable=<?php echo $var3; ?>">Linea
                            Respiratoria</a>
                        <?php
                        $var4 = "Colchones y Colchonetas";
                        ?>
                        <a href="<?= SERVERURL; ?>productosHomepageCategorias?variable=<?php echo $var4; ?>">Colchones y
                            Colchonetas</a>
                    </div>
                </li>
            </ul>
            <a href="<?= SERVERURL; ?>agendarCita">Agendar Cita</a>
            <a href="<?= SERVERURL; ?>homePage#contacto">Contáctanos</a>
        </div>
        <div class="login-container">
            <!-- Inicio de sesión -->
            <a href="<?= SERVERURL; ?>login" class="login-button">
                <span>Iniciar Sesión</span>
                <img src="<?= SERVERURL; ?>vistas/img/iniciar-sesion.png" alt="Iniciar Sesión">
            </a>
        </div>
    </div>
</header>
