<link rel="icon" href="<?= SERVERURL ?>vistas/img/logoAMU.png" type="image/x-icon">
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="icon" href="<?= SERVERURL ?>vistas/img/logoAMU.png" type="image/x-icon">
  <title></title>
  <?php include "./vistas/inc/link.php" ?>
</head>

<body>
  <?php
  $peticionAjax = false;
  require_once "./controladores/vistasControlador.php";
  $IV = new vistasControlador();

  $vistas = $IV->obtener_vistas_controlador();

  if ($vistas == "login" || $vistas == "404") {
    if ($vistas == "login") {
      session_start(['name' => 'AMU']);
      session_unset();
      session_destroy();
    }
    require_once "./vistas/contenidos/" . $vistas . "-view.php";
  } else {
    session_start(['name' => 'AMU']);

    $pagina = explode("/", $_GET['views']);

    require_once "./controladores/loginControlador.php";
    $insLoginControlador = new loginControlador();

    //Evitar el acceso a las paginas sin loguearse
    if (
      !isset ($_SESSION['token_amu']) ||
      !isset ($_SESSION['cedula']) ||
      !isset ($_SESSION['nombre_usuario']) ||
      !isset ($_SESSION['contrasena']) ||
      !isset ($_SESSION['telefono']) ||
      !isset ($_SESSION['email']) ||
      !isset ($_SESSION['permiso'])
    ) {
      echo $insLoginControlador->forzarCierreSesionControlador();
      exit();
    }

    //Imprimir la vista
    require_once $vistas;

  }
  ?>

  <script src="<?php echo SERVERURL; ?>vistas/js/nav.js"></script>
  <?php include "./vistas/inc/script.php"; ?>

</body>
</html>
