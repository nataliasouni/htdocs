<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>
    <?php include "./vistas/inc/header.php"; ?>

    <!-- Sweet Alerts V8.13.0 CSS file -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">

    <!-- Sweet Alert V8.13.0 JS file-->
    <script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-insumosTaller/insumoTaller.css">

    <section class="full-box page-content">
    <div class="page-content">
        <div class="choose-option">
            <h2>Solicitar insumos</h2>
            <div class="page-content">
                <div class="containerCompleto">
                    <div class="centrados">
                        <form action="" method="POST"> <!-- Formulario -->
                            <div class="input-button-container">
                                <label class="titulos" id="pr">Ingrese los materiales que desea solicitar a AMU:</label>
                                <textarea name="insumosTalleres" id="insumosTalleres" placeholder="Ejemplo: Agujas(10), Velcro(10)..." required></textarea>
                                <input type="hidden" name="cedula" value="<?php echo $_SESSION['cedula']; ?>">
                            </div>
                            <button id="ingresarP" type="submit">Enviar</button>
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
            if (isset($_POST['insumosTalleres'], $_POST['cedula'])) {
                require_once "./controladores/talleresControlador.php";
                $talleresControlador = new talleresControlador();
                echo $talleresControlador->insumosTalleresControlador();
            }
        }
        ?>

        
        
    </section>
</main>
