<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['token']) && isset($_POST['usuario'])) {
    //Instancia del controlador de login
    require_once "../controladores/loginControlador.php";
    $objLogin = new loginControlador();

    echo $objLogin->cierreSesionControlador();
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
