<nav class="full-box navbar-info">

    <?php if ($_SESSION['permiso'] == "Cliente") { ?>
        <div class="left-itemshea">
            <div class="profile">
                <img src="<?php echo SERVERURL; ?>vistas/img/avatar.png" alt="Avatar">
                <span class="profile-name"><?= $_SESSION['nombre_usuario'] ?></span>
            </div>
        </div>
        <div class="right-itemshea">
            <!-- Navegación de productos -->
            <a href="<?= SERVERURL; ?>homeCliente">
                <button class="botonesHeader"> Productos </button>
            </a>
            <!-- Agendar citas -->
            <a href="<?= SERVERURL; ?>agendarCita">
                <button class="botonesHeader"> Agendar Citas </button>
            </a>
            <!-- Contactanos -->
            <a href="<?= SERVERURL; ?>contactanos">
                <button class="botonesHeader"> Contactanos </button>
            </a>
        </div>
    <?php } ?>

    <div class="left-items">
        <a href="#" class="float-left show-nav-lateral">
            <i class="fas fa-exchange-alt"></i>
        </a>
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