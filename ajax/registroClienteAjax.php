<?php
$peticionAjax = true;
require_once "../config/APP.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asegúrate de que los campos necesarios están presentes en la solicitud
    if (isset($_POST['token']) && isset($_POST['nombreUsuario']) && isset($_POST['documentoIdentidad']) && isset($_POST['correoElectronico']) && isset($_POST['telefono']) && isset($_POST['contrasena'])) {
        // Instancia del controlador de registro
        require_once "../controladores/registroClienteControlador.php";
        $objRegistro = new registroClienteControlador();

        // Llama a la función correspondiente para procesar el registro del cliente
        echo $objRegistro->registroClienteControlador();
    } else {
        // Si algún campo requerido no está presente, devuelve un mensaje de error
        echo "Error: Campos incompletos";
    }
} else {
    // Si no es una solicitud POST, redirige a la página principal
    header("location:" . SERVERURL);
    exit();
}
