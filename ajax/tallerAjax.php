<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['idEnsamblet'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/talleresControlador.php";
    $objEnsamble = new talleresControlador();

    //Agregar usuario
    if (isset($_POST['idEnsamblet'])) {
        echo  $objEnsamble->agregarEnsambleControlador();
    }
 
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}