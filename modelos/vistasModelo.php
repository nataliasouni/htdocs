<?php
class vistasModelo
{
  //Modelo obtener vistas
  protected static function obtener_vistas_modelo($vistas)
  {
    $listaBlanca = ["home", "homeP", "homeN", "homeI", "homeT", "homeOT", "homeOTT", "usuarios", "agregarUsuario"];

    if (in_array($vistas, $listaBlanca)) {
      if (is_file("./vistas/contenidos/" . $vistas . "-view.php")) {
        $contenido = "./vistas/contenidos/" . $vistas . "-view.php";
      } else {
        $contenido = "404";
      }
    //} elseif ($vistas == "login" || $vistas == "index") {
    //  $contenido = "login";
    } elseif ($vistas == "homePage" || $vistas == "index") {
      $contenido = "homePage";
    }elseif ($vistas == "login"){
      $contenido = "login";
    }elseif ($vistas == "agendarCita"){
      $contenido = "agendarCita";
    } else {
      $contenido = "404";
    }
    return $contenido;
  }
}
