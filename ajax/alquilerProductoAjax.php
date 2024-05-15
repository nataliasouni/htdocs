<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['codigoProducto']) || isset($_POST['cedulaDelete']) || isset($_POST['productoAlquilerUpdate'])) {

    //Instancia del controlador de usuarios
    require_once "../controladores/alquilerproductosControlador.php";
    $objProductoAlquiler = new alquilerproductosControlador();

    //Agregar trabajador
    if (isset($_POST['codigoProducto'])) {
        echo $objProductoAlquiler->agregaralquilerproductosControlador();
    }


    //Actualizar trabajador
    if(isset($_POST['productoAlquilerUpdate'])){
        echo $objProductoAlquiler->actualizarProductosAlquilerControlador();
    }
    
} else {
    session_start(['name' => 'AMU']);
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "");
    exit();
}
