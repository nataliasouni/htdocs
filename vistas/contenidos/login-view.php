<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title> Inicio de Sesion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Sweet Alerts V8.13.0 CSS file -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">

  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-login/login.css">

  <!-- Sweet Alert V8.13.0 JS file-->
  <script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.min.js"></script>

</head>

<body>
  <div class="container">
    <div class="form-container sign-in-container">
      <!-- Contenido de tu formulario de inicio de sesión aquí -->
      <form id="loginform" action="" method="POST">
        <div class="imagen">
          <img src="<?php echo SERVERURL; ?>vistas/img/logoAMU.png" alt="Logo de AMU"
            class="imagen-verticalmente-centrada">
        </div>
        <label id="nombre" for="usuario" class="titulos">Nombre de usuario</label>
        <input type="text" placeholder=" " autocomplete="off" id="usuario" name="usuario" class="login_nombreUsuario"
          required>
        <label for="password" class="titulos">Contraseña</label>
        <input type="password" placeholder=" " autocomplete="off" id="password" name="password" class="login_password"
          required>

        <div class="centrados">
          <button class="login_botonIngresar" type="submit" style="cursor: pointer" title="Ingresar"
            name="Ingresar">Iniciar Sesion</button>
        </div>
      </form>
      <div class="centrados">
          <a href="recuperarContra">¿Olvidaste tu contraseña?</a>
          <p> </p>
          <p> </p>
          <button class="ghost" id="signUp" onclick="location.href='registroCliente'">Registrarse</button>
        </div>
    </div>
  </div>
  
  </div>


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
          return `<span style="transition-delay:${index * 100}ms">${letter}</span>`
        }).join("");
    })
  </script>