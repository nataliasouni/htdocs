<nav class="full-box navbar-info">
    <?php if ($_SESSION['permiso'] == "Cliente") { ?>
        <!-- Aquí puedes agregar contenido específico para el cliente si es necesario -->
    <?php } ?>

    <div class="left-items">
        <a href="#" class="float-left show-nav-lateral">
            <i class="fas fa-exchange-alt"></i>
        </a>
        <?php
        $homePages = [
            '/home',
            '/path-to-homepage2',
            '/path-to-homepage3'
            // Agrega más rutas según sea necesario
        ];
        
        // Verificar si la URL actual no está en la lista de páginas restringidas
        if (!in_array($_SERVER['REQUEST_URI'], $homePages)) { ?>
            <a href="javascript:void(0)" id="back-button" class="float-left">
                <i id="volver" class="fas fa-chevron-left"></i>
            </a>
            <a href="javascript:void(0)" id="forward-button" class="float-left">
                <i id="adelantar" class="fas fa-chevron-right"></i>
            </a>
        <?php } ?>
    </div>

    <div class="right-items">
        <?php if ($_SESSION['permiso'] == "Master") { ?>
            <a href="<?= SERVERURL; ?>usuarios">
                <i class="fas fa-user-cog"></i>
            </a>
        <?php } ?>
        <a href="#" class="btn-exit-system">
            <i class="fas fa-power-off"></i>
        </a>
    </div>
</nav>

<?php include "./vistas/inc/logOut.php" ?>
<script src="<?php echo SERVERURL; ?>vistas/js/nav.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Botón de retroceso
    var backButton = document.getElementById('back-button');
    var forwardButton = document.getElementById('forward-button');

    backButton.addEventListener('click', function() {
        if (history.length > 1) { // Verifica si hay más de un elemento en el historial
            history.back();
        }
    });

    forwardButton.addEventListener('click', function() {
        history.forward();
    });
});
</script>
