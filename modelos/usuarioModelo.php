<?php
require_once "mainModel.php";

class usuarioModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarUsuarioModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO usuario(cedula,nombre_usuario,contrasena,telefono,email,estado,permiso) 
        VALUES(:Cedula,:NombreUsuario,:Contrasena,:Telefono,:Email,:Estado,:Permiso)");

        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":NombreUsuario", $datos['NombreUsuario']);
        $sql->bindParam(":Contrasena", $datos['Contrasena']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Email", $datos['Email']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Permiso", $datos['Permiso']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para eliminar un usuario
    protected static function eliminarUsuarioModelo($cedula)
    {
        $sql = mainModel::conectarBD()->prepare("DELETE FROM usuario WHERE cedula = :Cedula");
        
        $sql->bindParam(":Cedula", $cedula);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos de un usuario
    protected static function datosUsuarioModelo($cedula)
    {   
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM usuario WHERE cedula = :Cedula");
        $sql->bindParam(":Cedula", $cedula);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    //Modelo para actualizar los datos del usuario
    protected static function actualizarUsuarioModelo($datos)
    {   
        $sql = mainModel::conectarBD()->prepare("UPDATE usuario SET cedula = :Cedula, 
        nombre_usuario = :Usuario, contrasena = :Contrasena, telefono = :Telefono, email = :Email, 
        estado = :Estado, permiso = :Permiso WHERE cedula = :CedulaOld");
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Contrasena", $datos['Contrasena']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Email", $datos['Email']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Permiso", $datos['Permiso']);
        $sql->bindParam(":CedulaOld", $datos['CedulaOld']);
        $sql->execute();
        return $sql;
    } //Fin del modelo
}
