<?php
require_once "mainModel.php";

class loginModelo extends mainModel
{
    //Modelo para iniciar sesion
    protected static function iniciarSesionModelo($datos){
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM usuario
        WHERE nombre_usuario=:Usuario AND contrasena=:Clave");
        
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->execute();
        return $sql;
    }
}
