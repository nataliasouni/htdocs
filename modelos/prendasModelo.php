<?php
require_once "mainModel.php";

class prendasModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarPrendasModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO prendasquirurgicas(id,nombre, descripcion,cantidadDisponible,Estado) 
        VALUES(:id,:nombre,:descripcion,:cantidadDisponible,:Estado)");

        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":cantidadDisponible", $datos['cantidadDisponible']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos de un insumo
    protected static function datosPrendaModelo($Id)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM prendasquirurgicas WHERE id = :id");
        $sql->bindParam(":id", $Id);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    //Modelo para actualizar los datos del usuario
    protected static function actualizarPrendaModelo($datos){   

    $sql = mainModel::conectarBD()->prepare("UPDATE prendasquirurgicas SET nombre = :nombre, 
    descripcion = :descripcion, cantidadDisponible = :cantidadDisponible, 
    Estado = :Estado WHERE id = :id");
    
    $sql->bindParam(":nombre", $datos['NombreUp']);
    $sql->bindParam(":descripcion", $datos['DescripcionUp']);
    $sql->bindParam(":cantidadDisponible", $datos['CantidadUp']);
    $sql->bindParam(":Estado", $datos['EstadoUp']);
    $sql->bindParam(":id", $datos['idPrenda']);
    
    if($sql->execute()) {
        return $sql; // Retorna la sentencia preparada
    } else {
        return false; // Retorna false si hubo un error en la ejecución
    }
}

}
