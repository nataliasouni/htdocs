<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

        <!-- Sweet Alerts V8.13.0 CSS file -->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">

        <!-- Sweet Alert V8.13.0 JS file-->
        <script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-notificaciones/notificacionesTaller.css">

    <section class="full-box page-content">
        <div class="page-content">
        <?php
            require_once "./controladores/notificacionesControlador.php";
            $notificaconesControlador = new notificacionesControlador();
            echo $notificaconesControlador->insumosTaller();
        ?>
        </div>
    </section>
</main>