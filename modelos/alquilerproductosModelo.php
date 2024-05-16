<?php
require_once "mainModel.php";

class alquilerProductosModelo extends mainModel
{
    //Modelo para agrega
    protected static function agregarProductoModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO alquilerproductos(nombreproducto,detalles,cantidad,alquiler15dias,alquiler30dias,deposito) 
        VALUES(:cedula,:fecha,:horaEntrada,:horaSalida,:horasTrabajadas)");

        $sql->bindParam(":cedula", $datos['cedula']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":horaEntrada", $datos['horaEntrada']);
        $sql->bindParam(":horaSalida", $datos['horaSalida']);
        $sql->bindParam(":horasTrabajadas", $datos['horasTrabajadas']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos 
    protected static function datosalquilerproductoModelo($id)
    {   
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM  alquilerproductos WHERE id = :id");
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