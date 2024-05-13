<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['idUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/produccionControlador.php";
    $objRegistroES = new produccionControlador();

    //Actualizar 
    if(isset($_POST['idUpdate'])){
        echo $objRegistroES->actualizarProduccionControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
?>