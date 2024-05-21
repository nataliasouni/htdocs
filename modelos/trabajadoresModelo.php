<?php
require_once "mainModel.php";

class trabajadoresModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarTrabajadorModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO trabajadores(cedula,nombre,telefono,estado) 
        VALUES(:cedula,:nombreTrabajador,:telefono,:estado)");

        $sql->bindParam(":cedula", $datos['cedula']);
        $sql->bindParam(":nombreTrabajador", $datos['nombreTrabajador']);
        $sql->bindParam(":telefono", $datos['telefono']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para eliminar un usuario
    protected static function eliminarTrabajadorModelo($cedula)
    {
        $sql = mainModel::conectarBD()->prepare("DELETE FROM trabajadores WHERE cedula = :Cedula");
        
        $sql->bindParam(":Cedula", $cedula);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos de un usuario
    protected static function datosTrabajadorModelo($cedula)
    {   
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM trabajadores WHERE cedula = :Cedula");
        $sql->bindParam(":Cedula", $cedula);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    //Modelo para actualizar los datos del usuario
    protected static function actualizarTrabajadorModelo($datos)
    {   
        $sql = mainModel::conectarBD()->prepare("UPDATE trabajadores SET cedula = :Cedula, nombre = :Trabajador, telefono = :Telefono, estado = :Estado  WHERE cedula = :CedulaOld");
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Trabajador", $datos['Trabajador']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":CedulaOld", $datos['CedulaOld']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    public function cantidadTrabajadoresModelo() {
        $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM trabajadores");

        // Ejecutar la consulta
        $sql->execute();

        // Obtener el resultado de la consulta
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        // Devolver la cantidad de registros
        return $resultado['total'];
    }
}
