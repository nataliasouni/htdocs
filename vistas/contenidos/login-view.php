<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title> Inicio de Sesion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Sweet Alerts V8.13.0 CSS file -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">

  <!-- Sweet Alert V8.13.0 JS file-->
  <script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.min.js"></script>

  <!-- CSS login -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-login/estiloslogin.css">

</head>

  <body>
    <div class="container">
        <div class="form-container sign-in-container">
            <!-- Contenido de tu formulario de inicio de sesión aquí -->
            <form id="loginform" action="" method="POST">
            <label for="usuario" class="titulos">Nombre de usuario</label>
            <input type="text" placeholder=" " autocomplete="off" id="usuario" name="usuario" class="login_nombreUsuario" required>
            <label for="password" class="titulos">Contraseña</label>
            <input type="password" placeholder=" " autocomplete="off" id="password" name="password" class="login_password" required>
            <a href="#">¿Olvidaste tu contraseña?</a>
                <button class="login_botonIngresar" type="submit" style="cursor: pointer" title="Ingresar" name="Ingresar">Iniciar Sesion</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <!-- Contenido del panel de registro aquí -->
                    <img src="<?php echo SERVERURL; ?>vistas/img/logoAMU.png" alt="Logo de AMU" style="width: 300px; height: auto;">
                    <p>Regístrate con nosotros</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const botonRegistrar = document.getElementById('signUp');
        const botonIngresar = document.getElementById('signIn');
        const contenedor = document.querySelector('.container');

    </script>
  <!-- Instancia del LoginControlador -->
  <?php
  if (isset($_POST['usuario']) && isset($_POST['password'])) {
    require_once "./controladores/loginControlador.php";
    $insLogin = new loginControlador();
    echo $insLogin->iniciarSesionControlador();
  }
  ?>

  <script>
    const labels = document.querySelectorAll("label");
    labels.forEach((label) => {
      label.innerHTML = label.innerText
        .split("")
        .map((letter, index) => {
          return `<span style="transition-delay:${index*100}ms">${letter}</span>`
        }).join("");
    })
  </script>

