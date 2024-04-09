<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['idInsumo']) || isset($_POST['insumoUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/insumoControlador.php";
    $objInsumo = new insumoControlador();

    //Agregar usuario
    if (isset($_POST['idInsumo'])) {
        echo  $objInsumo->agregarInsumoControlador();
    }

    //Actualizar usuario
    if(isset($_POST['insumoUpdate'])){
        echo $objInsumo->actualizarInsumoControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}