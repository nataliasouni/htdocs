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
            <?php if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") { ?>
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
                            <img class="submenu-image" src="./vistas/img/prendas.png" alt="Submenu Image">
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
                    <a href="<?= SERVERURL; ?>ensambleDeTaller">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/ensamble.png"
                            alt="Submenu Image">
                        Ensambles
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>prendasTaller">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/devolucion.png"
                            alt="Submenu Image">
                        Devolución por Defectos
                    </a>
                </li>
                <li>
                    <a href="<?= SERVERURL; ?>prendasQTaller">
                        <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/prendas.png"
                            alt="Submenu Image">
                        Prendas quirurgicas
                    </a>
                </li>
            </ul>
        </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Taller") { ?>
            <li>
                <a href="<?= SERVERURL; ?>solicitarInsumosTalleres">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/ensamble.png" alt="Menu Image">
                    Solicitar materia prima
                </a>
            </li>

        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Master") { ?>
            <li>
                <a href="<?= SERVERURL; ?>homeT">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png" alt="Menu Image">
                    Control de Talleres
                </a>
                <ul class="submenu">
                    <?php
                    require_once "./controladores/talleresControlador.php";
                    $tallerControlador = new talleresControlador();
                    echo $tallerControlador->cargarTallerNavControlador();
                    ?>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador" ) { ?>
            <li>
                <a href="<?= SERVERURL; ?>homeN">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/notificaciones.png" alt="Menu Image">
                    Notificaciones
                </a>
                <ul class="submenu">
                    <?php if ($_SESSION['permiso'] == "Master" || $_SESSION['permiso'] == "Administrador") { ?>
                        <li>
                            <a href="<?= SERVERURL; ?>notificaciones">
                                <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png"
                                    alt="Submenu Image">
                                Inventario
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['permiso'] == "Master") { ?>
                        <li>
                            <a href="notificacionesTaller">
                                <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/talleres.png"
                                    alt="Submenu Image">
                                Talleres
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['permiso'] == "Taller") { ?>
                        <li>
                            <a href="#">
                                <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png"
                                    alt="Submenu Image">
                                Inventario
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Master") { ?>
            <li>
                <a href="<?= SERVERURL; ?>homeGT">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/obrero.png" alt="Menu Image">
                    Control de Trabajadores
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?= SERVERURL; ?>registroES">
                            <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/tiempo-extraordinario.png"
                                alt="Submenu Image">
                            Registro Entrada y Salida
                        </a>
                    </li>
                    <li>
                        <a href="<?= SERVERURL; ?>trabajadores">
                            <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/gestion-de-candidatos.png"
                                alt="Submenu Image">
                            Lista Trabajadores
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador") { ?>
            <li>
                <a href="<?= SERVERURL; ?>homeGT">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/obrero.png" alt="Menu Image">
                    Control de Trabajadores
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?= SERVERURL; ?>trabajadores">
                            <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/gestion-de-candidatos.png"
                                alt="Submenu Image">
                            Lista Trabajadores
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Master") { ?>
            <li>
                <a href="alquilerProductos">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/alquiler.png" alt="Menu Image">
                    Alquiler Productos
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Master") { ?>
            <li>
                <a href="homeAlquileres">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/control.png" alt="Menu Image">
                    Control de Alquileres
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?= SERVERURL; ?>controlAlquileres">
                            <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/alquiler-seguro.png"
                                alt="Submenu Image">
                            Alquileres Vigentes
                        </a>
                    </li>
                    <li>
                        <a href="<?= SERVERURL; ?>controlAlquileresTerminados">
                            <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/alquilerTerminado.png"
                                alt="Submenu Image">
                            Alquileres Terminados
                        </a>
                    </li>
                    <li>
                        <a href="<?= SERVERURL; ?>alquileresV">
                            <img class="submenu-image" src="<?php echo SERVERURL; ?>vistas/img/alquilar-archivo.png"
                                alt="Submenu Image">
                            Alquileres Vencidos
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Administrador" || $_SESSION['permiso'] == "Master") { ?>
            <li>
                <a href="https://calendar.google.com/calendar/u/0/r" target="_blank">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/citas.png" alt="Menu Image">
                    Citas
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Produccion") { ?>
            <li>
                <a href="<?= SERVERURL; ?>produccion">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/inventario.png" alt="Menu Image">
                    Registro de Producción
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Master") { ?>
            <li>
                <a href="<?= SERVERURL; ?>produccionMaster">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/produccion.png" alt="Menu Image">
                    Control de producción
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['permiso'] == "Cliente") { ?>
            <li>
                <a href="agendarCitas">
                    <img class="menu-image" src="<?php echo SERVERURL; ?>vistas/img/citas.png" alt="Menu Image">
                    Agendamiento de citas
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>