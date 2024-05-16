<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-notificaciones/notificaciones.css">

    <section class="full-box page-content">
        <div class="page-content">
        <?php
            require_once "./controladores/notificacionesControlador.php";
            $notificaconesControlador = new notificacionesControlador();
            echo $notificaconesControlador->cargarProductosModelo();
        ?>
        </div>
    </section>
</main>

