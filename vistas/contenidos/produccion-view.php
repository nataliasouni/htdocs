<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>
    <?php include "./vistas/inc/header.php"; ?>

    <!-- Sweet Alerts V8.13.0 CSS file -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">

    <!-- Sweet Alert V8.13.0 JS file-->
    <script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-produccion/produccion.css">

    <section class="full-box page-content">
        <div class="page-content">
            <div class="choose-option">
                <h2>Producción</h2>
                <div class="page-content">
                    <div class="containerCompleto">
                        <div class="centrados">
                            <form action="" method="POST"> <!-- Formulario -->
                                <label class="titulos" id="seleccionar">Seleccione un trabajador para ingresar la cantidad elaborada:</label>
                                <select id="cedulatrabajador" name="cedulatrabajador">
                                    <!-- Aquí se cargarán los nombres de los trabajadores desde el controlador -->
                                    <?php
                                    require_once "./controladores/produccionControlador.php";
                                    $produccionControlador = new produccionControlador();
                                    
                                    echo $produccionControlador->cargarNombresYCedulasTrabajadores();
                                    ?>
                                </select>
                                <label class="titulos" id="seleccionar">Seleccione el taller asociado con la producción:</label>
                                <select id="idtaller" name="idtaller">
                                    <!-- Aquí se cargarán los nombres de los talleres desde el controlador -->
                                    <?php
                                    echo $produccionControlador->cargarNombresIdTalleres();
                                    ?>
                                </select>
                                <p> </p>
                                <label for="fecha" id="fec">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" required>
                                <p> </p>
                                <label class="titulos" id="seleccionarPrenda">Seleccione el tipo de prenda producida:</label>
                                <select id="idPrenda" name="idPrenda">
                                    <!-- Aquí se cargarán los nombres de los talleres desde el controlador -->
                                    <?php
                                    echo $produccionControlador->cargarNombresIdPrendas();
                                    ?>
                                </select>
                                <p> </p>
                                <div class="input-button-container">
                                    <label class="titulos" id="pr" >Ingrese las prendas quirúrgicas elaboradas: </label>
                                    <input name="totalprendasquirurgicas"id="totalprendasquirurgicas" type="number" placeholder=" " autocomplete="off" id="produccion" name="produccion" required min="0" inputmode="numeric"> 
                                    <div >
                                        <label class="titulos" id="pre" >Ingrese las prendas defectuosas encontradas: </label>
                                        <input name="totalprendasdefectuosas" id="totalprendasdefectuosas" type="number" placeholder=" " autocomplete="off" id="otraProduccion" name="otraProduccion" required min="0" inputmode="numeric">
                                    </div>
                                </div>
                                <button id="ingresarP" type="submit">Ingresar Producción</button>
                                <button id="cancelar" type="button" onclick="window.location.href = 'home'">Cancelar</button>
                            </form> <!-- Fin del formulario -->
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Procesar los datos del formulario si se envían
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['cedulatrabajador'], $_POST['idtaller'], $_POST['fecha'], $_POST['idPrenda'],$_POST['totalprendasquirurgicas'], $_POST['totalprendasdefectuosas'])) {
                require_once "./controladores/produccionControlador.php";
                $produccionControlador = new produccionControlador();
                echo $produccionControlador->registrarProduccion();
            }
        }
        ?>

        
        
    </section>
</main>





