<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/header.css">

<header class="navbar-infohead" id="navbar-infohead">
    <div class="container-header">
        <div class="logo-container">
            <a href="<?= SERVERURL; ?>homePage">
                <img src="<?= SERVERURL; ?>vistas/img/logoAMU.png" alt="Logo">
            </a>
        </div>
        <div class="menu-container">
            <select id="productos-dropdown">
                <option value="<?= SERVERURL; ?>homePage">Productos</option>
                <!-- Aquí puedes cargar dinámicamente las categorías de productos desde la base de datos -->
                <option value="#">Categoría 1</option>
                <option value="#">Categoría 2</option>
                <option value="#">Categoría 3</option>
            </select>
            <a href="<?= SERVERURL; ?>agendarCita">Agendar Cita</a>
            <a href="#contacto">Contáctanos</a>
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

