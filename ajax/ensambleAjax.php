<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['OrdenProduccion']) || $_POST['idEnsambleUp']) {

    //Instancia del controlador de usuarios
    require_once "../controladores/ensambleControlador.php";
    $objEnsamble = new ensambleControlador();

    //Agregar usuario
    if (isset($_POST['OrdenProduccion'])) {
        echo  $objEnsamble->agregarEnsambleControlador();
    }

    //Agregar usuario
    if (isset($_POST['idEnsambleUp'])) {
        echo  $objEnsamble->actualizarEnsambleControlador();
    }

 
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}