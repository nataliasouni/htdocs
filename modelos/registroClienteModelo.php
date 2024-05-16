<?php
require_once "mainModel.php";

class registroClienteModelo extends mainModel
{
    protected static function registrarClienteModelo($datos)
    {
        

        // Preparar la consulta SQL
        $sql = self::conectarBD()->prepare("INSERT INTO usuario (cedula, nombre_usuario, contrasena, telefono, email, permiso, estado) VALUES (:cedula, :nombre_usuario, :contrasena, :telefono, :email, 'Cliente', 'si')");

        // Bind parameters
        $sql->bindParam(":cedula", $datos['cedula']);
        $sql->bindParam(":nombre_usuario", $datos['nombre_usuario']);
        $sql->bindParam(":contrasena", $datos['contrasena']); // Usar la contraseña encriptada
        $sql->bindParam(":telefono", $datos['telefono']);
        $sql->bindParam(":email", $datos['email']);

        // Execute query
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
}














