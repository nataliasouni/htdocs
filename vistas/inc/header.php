<nav class="full-box navbar-info">

    <?php if ($_SESSION['permiso'] == "Cliente") { ?>
        
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