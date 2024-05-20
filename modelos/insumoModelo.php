<?php
require_once "mainModel.php";

class insumoModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarInsumoModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO insumos(IdInsumo,Nombre,Descripcion,Cantidad,Estado) 
        VALUES(:IdInsumo,:Nombre,:Descripcion, :Cantidad,:Estado)");

        $sql->bindParam(":IdInsumo", $datos['idInsumo']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos de un insumo
    protected static function datosInsumoModelo($Id)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM insumos WHERE IdInsumo = :IdInsumo");
        $sql->bindParam(":IdInsumo", $Id);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    //Modelo para actualizar los datos del usuario
    protected static function actualizarInsumoModelo($datos){   

    $sql = mainModel::conectarBD()->prepare("UPDATE insumos SET Nombre = :Nombre, 
    Descripcion = :Descripcion, Cantidad = :Cantidad, 
    Estado = :Estado WHERE IdInsumo = :IdInsumo");
    
    $sql->bindParam(":Nombre", $datos['NombreUp']);
    $sql->bindParam(":Descripcion", $datos['DescripcionUp']);
    $sql->bindParam(":Cantidad", $datos['CantidadUp']);
    $sql->bindParam(":Estado", $datos['EstadoUp']);
    $sql->bindParam(":IdInsumo", $datos['IdInsumo']);
    
    if($sql->execute()) {
        return $sql; // Retorna la sentencia preparada
    } else {
        return false; // Retorna false si hubo un error en la ejecución
    }
}

public function cantidadInsumosModelo() {
    $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM insumos");

    // Ejecutar la consulta
    $sql->execute();

    // Obtener el resultado de la consulta
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    // Devolver la cantidad de registros
    return $resultado['total'];
}
}
