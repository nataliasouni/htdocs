<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['cedulaA']) || isset($_POST['cedulaDelete']) || isset($_POST['idUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/registroESControlador.php";
    $objRegistroES = new registroESControlador();

    //Agregar
    if (isset($_POST['cedulaA'])) {
        echo $objRegistroES->agregarRegistroESControlador();
    }

    //Eliminar 
    if(isset($_POST['cedulaDelete'])){
        echo $objRegistroES->eliminarTrabajadorControlad();
    }

    //Actualizar 
    if(isset($_POST['idUpdate'])){
        echo $objRegistroES->actualizarRegistroESControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
?>