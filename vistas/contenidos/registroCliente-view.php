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
        <form action="#" method="POST">
            <img src="<?php echo SERVERURL; ?>vistas/img/logoAMU2.png" alt="Logo de AMU" class="imagen-verticalmente-centrada" >
            
            <p>Nombre de usuario</p>
            <input type="text" name="nombre_usuario" placeholder="">
            <p>Cedula</p>
            <input type="text" name="cedula" placeholder="">
            <p>Correo electrónico</p>
            <input type="text" name="email" placeholder="">
            <p>Telefono</p>
            <input type="text" name="telefono" placeholder="">
            <p>Contraseña</p>
            <input type="password" name="contrasena" placeholder="">
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



