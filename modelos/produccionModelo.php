<?php
require_once "mainModel.php";

class ProduccionModelo extends mainModel{
    // Función para registrar la producción en la base de datos
    protected static function registrarProduccionModelo($datos) {
        // Preparar la consulta SQL
        $sql = self::conectarBD()->prepare("INSERT INTO produccion (cedulatrabajador,idtaller ,fecha, prendasquirurgicas,prendasdefectuosas) VALUES (:cedulatrabajador,:idtaller ,:fecha, :prendasquirurgicas,:prendasdefectuosas)");
        // Bind parameters
        $sql->bindParam(":cedulatrabajador", $datos['cedulatrabajador']);
        $sql->bindParam(":idtaller", $datos['idtaller']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":prendasquirurgicas", $datos['prendasquirurgicas']);
        $sql->bindParam(":prendasdefectuosas", $datos['prendasdefectuosas']); 
        // Execute query
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para obtener los nombres y cédulas de los trabajadores desde la base de datos
    public function obtenerNombresYCedulasTrabajadoresModelo() {
    $sql = self::conectarBD()->prepare("SELECT nombre, cedula FROM trabajadores");
    // Ejecutar la consulta
    $sql->execute();
    // Obtener los resultados de la consulta
    $datosTrabajadores = array();
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $datosTrabajadores[$row['nombre']] = $row['cedula'];
    }
    return $datosTrabajadores;
}

    // Función para obtener los nombres y los id de los talleres desde la base de datos
    public function obtenerNombresIdTalleresModelo() {
        $sql = self::conectarBD()->prepare("SELECT id,nombre FROM taller");
        // Ejecutar la consulta
        $sql->execute();
        // Obtener los resultados de la consulta
        $nombresTalleres = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $nombresTalleres[$row['nombre']] = $row['id'];
    }
    return $nombresTalleres;
    }
} 








