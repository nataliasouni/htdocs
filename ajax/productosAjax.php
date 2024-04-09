<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['idNormal']) || isset($_POST['productoUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/productoControlador.php";
    $objProducto = new productoControlador();

    //Agregar usuario
    if (isset($_POST['idNormal'])) {
        echo  $objProducto->agregarProductoControlador();
    }

    //Actualizar usuario
    if(isset($_POST['productoUpdate'])){
        echo $objProducto->actualizarProductoControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}