<?php
class vistasModelo
{
  //Modelo obtener vistas
  protected static function obtener_vistas_modelo($vistas)
  {
    $listaBlanca = [
      "home",
      "homeP",
      "homeN",
      "homeI",
      "homeT",
      "homeOT",
      "homeOTT",
      "usuarios",
      "agregarUsuario",
      "agendarCita",
      "agregarAlquiler",
      "agregarEnsamble",
      "agregarEntradaRES",
      "agregarInsumo",
      "agregarProducto",
      "agregarTrabajador",
      "alquilerProductos",
      "detallesEnsamble",
      "detallesInsumo",
      "detallesProducto",
      "detallesUsuario",
      "editarEnsamble",
      "editarInsumo",
      "editarProducto",
      "editarProductoEnsamble",
      "editarRegistro",
      "editarTrabajador",
      "editarusuario",
      "ensambleM",
      "homeGT",
      "insumos",
      "produccion",
      "productos",
      "registroES",
      "trabajadores",
      "produccionMaster",
      "editarProduccion",
      "detallesProduccion",
      "notificaciones",
      "prendasQuirurgicas",
      "devolucionDefectos",
      "ensambleTaller",
      "agregarEnsambleTaller",
      "enviarEnsambleTaller",
      "agregarPrenda",
      "editarPrenda",
      "detallesPrenda",
      "prendasCortadas",
      "agregarPrendaCortada",
      "editarPrendaCortada",
      "detallesPrendaCortada",
      "devolucionPorDefecto",
      "agregarDevolucion",
      "editarDevolucion",
      "detallesDevolucion",
      "editarProductosAlquiler",
      "agregarProductosAlquiler",
      "controlAlquileres",
      "visualizarAlquiler",
      "agendarCitas", 
      "prendasQuirurgicasI"

    ];

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
    } elseif ($vistas == "productosHomepage") {
      $contenido = "productosHomepage";
    } elseif ($vistas == "productosHomepageCategorias") {
      $contenido = "productosHomepageCategorias";
    } elseif ($vistas == "detallesProductosHome") {
      $contenido = "detallesProductosHome";
    } elseif ($vistas == "login") {
      $contenido = "login";
    } elseif ($vistas == "agendarCita") {
      $contenido = "agendarCita";
    } elseif ($vistas == "recuperarContra") {
      $contenido = "recuperarContra";
    } elseif ($vistas == "registroCliente") {
      $contenido = "registroCliente";
    } else {
      $contenido = "404";
    }
    return $contenido;
  }
}
