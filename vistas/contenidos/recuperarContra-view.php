<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>

    <!-- Sweet Alerts V8.13.0 CSS file -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">

    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-recuperarContra/recuperarContra.css">

    <!-- Sweet Alert V8.13.0 JS file-->
    <script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="form-container sign-in-container">
        <a href="homePage">
        <div class="imagen2">
        <img id="cerrar" src="<?php echo SERVERURL; ?>vistas/img/cerrar.png" alt="cerrar">
        </div>
        </a>

            <form id="loginform" action="" method="POST">
                <img src="/vistas/img/logoAMU2.png" alt="Logo de AMU" class="imagen-verticalmente-centrada"">
                <p class="titulos">Ingresa tu email para recibir tu nueva contraseña:</p>
                <input class="correo" type="text" name="email" >
                <button  class="correo_solicitar"  style="cursor: pointer" title="Solicitar"
                    name="Solicitar">Solicitar</button>
                    <p> </p>
                    <button id="correo_volver" type="button" onclick="location.href='login'">Volver</button>
            </form>
        </div>
    </div>

<?php
    if (isset($_POST['email'])) {
        require_once "./controladores/loginControlador.php";
        $insLogin = new loginControlador();
        echo $insLogin->cambiarContraseñaControlador();
    }
?>