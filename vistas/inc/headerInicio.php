<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/homepage.css">

<nav class="full-box navbar-infohead">
    <div class="left-itemshea">
        <!-- Inicio de sesión -->
        <a id="inicioSesion" type="button" onclick="location.href='login'">
            <i class="fas fa-user"></i> Iniciar sesión
        </a>
    </div>
    <div class="right-itemshea">
        <!-- Navegación de productos -->
        <button id="botonProductos" onclick="location.href='homePage'" class="botonesHeader"> Productos </button>
        <!-- Agendar citas -->
        <button id="botonCitaH" onclick="location.href='agendarCita'" class="botonesHeader"> Agendar Citas </button>
        <!-- Contactanos -->
        <button id="botonContactanos" onclick="location.href='contactanos'" class="botonesHeader"> Contactanos </button>
    </div>
    
</nav>
