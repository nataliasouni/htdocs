<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-citas/agendarCitas.css">

<main class="full-box main-container">
    <!-- Incluir la barra header -->
    <?php include "./vistas/inc/headerInicio.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

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