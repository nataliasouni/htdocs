
<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/homepage.css">

<nav class="full-box navbar-infohead">
            <div class="left-itemshea">
                <!-- Inicio de sesión -->
                
                <a type="button" onclick="href='login'">
                <i class="fas fa-user"></i>     Iniciar sesión
                    
                </a>
            </div>
            <div class="right-itemshea">
                    <!-- Navegación de productos -->
                <a href="<?= SERVERURL; ?>homePage">
                    <button class = "botonesHeader"> Productos </button>
                </a>
                    <!-- Agendar citas -->
                <a href="<?= SERVERURL; ?>agendarCita">
                    <button class = "botonesHeader"> Agendar Citas </button>
                </a>
                    <!-- Contactanos -->
                <a href="<?= SERVERURL; ?>contactanos">
                    <button class = "botonesHeader"> Contactanos </button>
                </a>
            </div>
        </nav>