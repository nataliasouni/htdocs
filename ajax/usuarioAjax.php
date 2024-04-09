<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['cedulaNormal']) || isset($_POST['cedulaDelete']) || isset($_POST['usuarioUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/usuarioControlador.php";
    $objUsuario = new usuarioControlador();

    //Agregar usuario
    if (isset($_POST['cedulaNormal'])) {
        echo $objUsuario->agregarUsuarioControlador();
    }

    //Eliminar usuario
    if(isset($_POST['cedulaDelete'])){
        echo $objUsuario->eliminarUsuarioControlador();
    }

    //Actualizar usuario
    if(isset($_POST['usuarioUpdate'])){
        echo $objUsuario->actualizarUsuarioControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
