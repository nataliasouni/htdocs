<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['numeroAlquiler'])  ) {

    //Instancia del controlador de usuarios
    require_once "../controladores/alquilerControlador.php";
    $objAlquiler = new alquilerControlador();

    //Agregar trabajador
    if (isset($_POST['numeroAlquiler'])) {
        echo $objAlquiler->agregaralquilerControlador();
    }


} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
