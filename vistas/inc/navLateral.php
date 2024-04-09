<nav class="navLateral">
    <div class="profile">
        <img src="<?php echo SERVERURL; ?>vistas/img/avatar.png" alt="Avatar">
        <span class="profile-name"><?= $_SESSION['nombre_usuario'] ?></span>
    </div>
    <div class="divider"></div>
    <ul class="menu">
        <li>
            <a href="<?= SERVERURL; ?>home">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/logoAMU.png" alt="Menu Image">
                Home
            </a>
        </li>
        <li>
            <?php if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador"){ ?>
            <a href="<?= SERVERURL; ?>homeI">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png" alt="Menu Image">
                Inventario
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?= SERVERURL; ?>homeP">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/produccion.png"
                            alt="Submenu Image">
                        Producción de prendas quirurgicas
                    </a>
                </li>
                <li>
                    <?php
                        $var = "Movilidad y Recuperación";
                    ?>    
                    <a data-categoria="movilidad" href="<?= SERVERURL; ?>productos?variable=<?php echo $var; ?>">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/movilidad.png"
                            alt="Submenu Image">
                        Movilidad y recuperaciones
                    </a>
                </li>
                <li>
                    <?php
                        $var = "Muebles Hospitalarios";
                    ?>    
                    <a data-categoria="movilidad" href="<?= SERVERURL; ?>productos?variable=<?php echo $var; ?>">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/mueble.png"
                            alt="Submenu Image">
                        Muebles hospitalarios
                    </a>
                </li>
                <li>
                    <?php
                        $var = "Línea Respiratoria";
                    ?>    
                    <a data-categoria="movilidad" href="<?= SERVERURL; ?>productos?variable=<?php echo $var; ?>">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/respiratorio.png"
                            alt="Submenu Image">
                        Linea respiratoria
                    </a>
                </li>
                <li>
                    <?php
                        $var = "Colchones y Colchonetas";
                    ?>    
                    <a data-categoria="movilidad" href="<?= SERVERURL; ?>productos?variable=<?php echo $var; ?>"> 
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/colchones.png"
                            alt="Submenu Image">
                        Colchones y colchonetas
                    </a>
                </li>
                <li>
                    <?php
                        $var = "Prendas Quirurgicas";
                    ?>    
                    <a data-categoria="movilidad" href="<?= SERVERURL; ?>productos?variable=<?php echo $var; ?>"> 
                        <img class="submenu-image" src="./vistas/img/prendas.png"
                            alt="Submenu Image">
                        Prendas quirurgicas
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>

        <?php if ($_SESSION['permiso'] == "Taller"){ ?>
        <li>
            <a href="<?= SERVERURL; ?>homeOTT">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png" alt="Menu Image">
                Inventario
            </a>
            <ul class="submenu">
                <li>
                    <a href="#">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/ensamble.png"
                            alt="Submenu Image">
                        Materia Prima
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/corte.png"
                            alt="Submenu Image">
                        Prendas Cortadas
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/devolucion.png"
                            alt="Submenu Image">
                        Devolución por Defectos
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/prendas.png"
                            alt="Submenu Image">
                        Prendas quirurgicas
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Master"){ ?>
        <li>
            <a href="<?= SERVERURL; ?>homeT">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png" alt="Menu Image">
                Control de Talleres
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?= SERVERURL; ?>homeOT">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Taller 1
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>homeOT">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Taller 2
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>homeOT">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Taller 3
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>homeOT">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Taller 4
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>homeOT">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Taller 5
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>homeOT">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Taller 6
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>homeOT">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Taller 7
                    </a>
                </li>
            </ul>
        </li> 
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Taller" ){ ?>
        <li>
            <a href="<?= SERVERURL; ?>homeN">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/notificaciones.png" alt="Menu Image">
                Notificaciones
            </a>
            <ul class="submenu">
                <?php if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Taller"){ ?>
                <li>
                    <a href="#">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png"
                            alt="Submenu Image">
                        Inventario
                    </a>
                </li>
                <?php } ?>
                <?php if ($_SESSION['permiso'] == "Master"){ ?>
                <li>
                    <a href="#">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                            alt="Submenu Image">
                        Talleres
                    </a>
                </li>
                <?php } ?>
            </ul>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Master"){ ?>
        <li>
            <a href="#">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/registro.png" alt="Menu Image">
                Registro Entrada y Salida
            </a>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Master"){ ?>
        <li>
            <a href="#">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/alquiler.png" alt="Menu Image">
                Alquiler Productos
            </a>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Master"){ ?>    
        <li>
            <a href="#">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/control.png" alt="Menu Image">
                Control de Alquileres
            </a>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Master"){ ?>
        <li>
            <a href="#">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/citas.png" alt="Menu Image">
                Citas
            </a>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Produccion"){ ?>
        <li>
            <a href="#">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png" alt="Menu Image">
                Registro de Producción
            </a>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Master"){ ?>
        <li>
            <a href="#">
                <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/produccion.png" alt="Menu Image">
                Control de producción
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>