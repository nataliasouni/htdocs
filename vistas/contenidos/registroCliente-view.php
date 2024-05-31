<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Sweet Alerts V8.13.0 CSS file -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">

  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-registroCliente/registroCliente.css">

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

        <form action="#" method="POST">
            <img id="amu" src="<?php echo SERVERURL; ?>vistas/img/logoAMU.png" alt="Logo de AMU" class="imagen-verticalmente-centrada" >
            
            <p>Nombre de usuario</p>
            <input type="text" name="nombre_usuario" placeholder="" required>
            <p>Cédula</p>
            <input type="text" name="cedula" placeholder=""required>
            <p>Correo electrónico</p>
            <input type="text" name="email" placeholder=""required>
            <p>Teléfono</p>
            <input type="text" name="telefono" placeholder=""required>
            <p>Contraseña</p>
            <input type="password" name="contrasena" placeholder=""required>
            <p> </p>
            <button id="registrarse" type="submit">Registrarse</button>
        </form>
        <button id="btnIniciarSesion" type="button" onclick="location.href='login'">Iniciar sesión</button>
    </div>
</div>



    <!-- Instancia del RegistroClienteControlador -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['cedula']) && isset($_POST['nombre_usuario'])  && isset($_POST['contrasena']) && isset($_POST['telefono']) && isset($_POST['email']) ) {
            require_once "./controladores/registroClienteControlador.php";
            $registroClienteControlador = new registroClienteControlador();
            echo $registroClienteControlador->registroClienteControlador();
        }
    }
    ?>



