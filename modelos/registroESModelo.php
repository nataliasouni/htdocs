<?php
require_once "mainModel.php";

class registroESModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarRegistroESModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO registroentradasalida(cedula,fecha,horaEntrada,horaSalida,horasTrabajadas) 
        VALUES(:cedula,:fecha,:horaEntrada,:horaSalida,:horasTrabajadas)");

        $sql->bindParam(":cedula", $datos['cedula']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":horaEntrada", $datos['horaEntrada']);
        $sql->bindParam(":horaSalida", $datos['horaSalida']);
        $sql->bindParam(":horasTrabajadas", $datos['horasTrabajadas']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para eliminar un usuario
    protected static function eliminarRegistroESModelo($cedula)
    {
        $sql = mainModel::conectarBD()->prepare("DELETE FROM trabajadores WHERE cedula = :Cedula");
        
        $sql->bindParam(":Cedula", $cedula);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos de un usuario
    protected static function datosRegistroESModelo($id)
    {   
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM  registroentradasalida WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    // Modelo para actualizar los datos del usuario
    protected static function actualizarRegistroESModelo($datos)
    {   
        $sql = mainModel::conectarBD()->prepare("UPDATE registroentradasalida SET  cedula = :cedula, fecha = :fecha, horaEntrada = :horaEntrada, horaSalida = :horaSalida, horasTrabajadas = :horasTrabajadas  WHERE id = :id");
        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":cedula", $datos['cedula']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":horaEntrada", $datos['horaEntrada']);
        $sql->bindParam(":horaSalida", $datos['horaSalida']);
        $sql->bindParam(":horasTrabajadas", $datos['horasTrabajadas']);
        $sql->execute();
        return $sql;
    }
    // Fin del modelo
}