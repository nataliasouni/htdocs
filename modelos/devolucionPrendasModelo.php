<?php
require_once "mainModel.php";

class devolucionPrendasModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarPrendasModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO devolucionprendas(id,Nombre,Descripcion,Cantidad,Estado) 
        VALUES(:id,:Nombre,:Descripcion,:Cantidad,:Estado)");

        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos de un insumo
    protected static function datosPrendaModelo($Id)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM devolucionprendas WHERE id = :id");
        $sql->bindParam(":id", $Id);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    //Modelo para actualizar los datos del usuario
    protected static function actualizarPrendaModelo($datos){   

    $sql = mainModel::conectarBD()->prepare("UPDATE devolucionprendas SET Nombre = :Nombre, 
    Descripcion = :Descripcion, Cantidad = :Cantidad, 
    Estado = :Estado WHERE id = :id");
    
    $sql->bindParam(":Nombre", $datos['NombreUp']);
    $sql->bindParam(":Descripcion", $datos['DescripcionUp']);
    $sql->bindParam(":Cantidad", $datos['CantidadUp']);
    $sql->bindParam(":Estado", $datos['EstadoUp']);
    $sql->bindParam(":id", $datos['idPrenda']);
    
    if($sql->execute()) {
        return $sql; // Retorna la sentencia preparada
    } else {
        return false; // Retorna false si hubo un error en la ejecución
    }
}

public function cantidadRegistrosDPModelo() {
    // Preparar la consulta SQL para contar la cantidad de registros
    $sql = mainModel::conectarBD()->prepare("
        SELECT COUNT(*) AS cantidad_registros
        FROM (
            SELECT 
                pq.nombre AS nombre_prenda,
                SUM(p.prendasdefectuosas) AS total_defectuosas,
                pq.descripcion AS descripcion_prenda
            FROM 
                produccion p
            JOIN 
                prendasquirurgicas pq ON p.idprenda = pq.id
            GROUP BY 
                pq.id, pq.nombre, pq.descripcion
        ) AS subconsulta
    ");

    // Ejecutar la consulta
    $sql->execute();

    // Obtener el resultado de la consulta
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    // Devolver la cantidad de registros
    return $resultado['cantidad_registros'];
}


}
