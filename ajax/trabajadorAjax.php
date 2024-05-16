<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['cedula']) || isset($_POST['cedulaDelete']) || isset($_POST['trabajadorUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/trabajadorControlador.php";
    $objTrabajador = new trabajadorControlador();

    //Agregar trabajador
    if (isset($_POST['cedula'])) {
        echo $objTrabajador->agregarTrabajadorControlador();
    }


    //Actualizar trabajador
    if(isset($_POST['trabajadorUpdate'])){
        echo $objTrabajador->actualizarTrabajadorControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
