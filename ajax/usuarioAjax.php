<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['cedula']) || isset($_POST['cedulaDelete']) || isset($_POST['usuarioCedulaUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/usuarioControlador.php";
    $objUsuario = new usuarioControlador();

    //Agregar usuario
    if (isset($_POST['usuario'])) {
        echo $objUsuario->agregarUsuarioControlador();
    }

    //Eliminar usuario
    if(isset($_POST['cedulaDelete'])){
        echo $objUsuario->eliminarUsuarioControlador();
    }

    //Actualizar usuario
    if(isset($_POST['usuarioCedulaUpdate'])){
        echo $objUsuario->actualizarUsuarioControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
