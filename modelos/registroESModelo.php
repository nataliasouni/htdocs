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

// Función para obtener los nombres y cédulas de los trabajadores activos desde la base de datos
public function obtenerNombresYCedulasTrabajadoresModelo() {
    // Preparar la consulta SQL
    $sql = self::conectarBD()->prepare("SELECT nombre, cedula FROM trabajadores WHERE estado != 'no'");
    
    // Ejecutar la consulta
    $sql->execute();
    
    // Obtener los resultados de la consulta
    $datosTrabajadores = array();
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Almacenar los nombres y cédulas de los trabajadores en un array asociativo
        $datosTrabajadores[$row['nombre']] = $row['cedula'];
    }
    // Retornar el array con los nombres y cédulas de los trabajadores
    return $datosTrabajadores;
}

public function cantidadRegistrosESModelo() {
    $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM registroentradasalida");

    // Ejecutar la consulta
    $sql->execute();

    // Obtener el resultado de la consulta
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    // Devolver la cantidad de registros
    return $resultado['total'];
}

}