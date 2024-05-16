<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['idPrenda']) || isset($_POST['prendaUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/devolucionPrendasControlador.php";
    $objPrenda = new devolucionPrendasControlador();

    //Agregar usuario
    if (isset($_POST['idPrenda'])) {
        echo  $objPrenda->agregarPrendaControlador();
    }

    //Actualizar usuario
    if(isset($_POST['prendaUpdate'])){
        echo $objPrenda->actualizarPrendaControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}