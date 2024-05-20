<?php
require_once "mainModel.php";

class productosModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarProductoModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO productos(Id,Nombre,Descripcion,Categoria,Cantidad,Estado,Imagen) 
        VALUES(:Id,:Nombre,:Descripcion,:Categoria,:Cantidad,:Estado,:Imagen)");

        $sql->bindParam(":Id", $datos['idNormal']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Categoria", $datos['Categoria']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para eliminar un usuario
    protected static function eliminarProductoModelo($Id)
    {
        $sql = mainModel::conectarBD()->prepare("DELETE FROM productos WHERE Id = :Id");

        $sql->bindParam(":Id", $Id);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos de un usuario
    protected static function datosProductoModelo($Id)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM productos WHERE Id = :Id");
        $sql->bindParam(":Id", $Id);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    //Modelo para actualizar los datos del usuario
    protected static function actualizarProductoModelo($datos)
{   
    $sql = mainModel::conectarBD()->prepare("UPDATE productos SET Nombre = :Nombre, 
    Descripcion = :Descripcion, Categoria = :Categoria, Cantidad = :Cantidad,
    Estado = :Estado, Imagen = :Imagen WHERE Id = :Id");
    
    $sql->bindParam(":Nombre", $datos['NombreUp']);
    $sql->bindParam(":Descripcion", $datos['DescripcionUp']);
    $sql->bindParam(":Categoria", $datos['CategoriaUp']);
    $sql->bindParam(":Cantidad", $datos['CantidadUp']);
    $sql->bindParam(":Estado", $datos['EstadoUp']);
    $sql->bindParam(":Imagen", $datos['ImagenUp']);
    $sql->bindParam(":Id", $datos['Id']);
    
    if($sql->execute()) {
        return $sql; // Retorna la sentencia preparada
    } else {
        return false; // Retorna false si hubo un error en la ejecución
    }
}



public function cantidadProductosModelo($categoria) {
    // Preparar la consulta SQL con un marcador de posición
    $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM productos WHERE categoria = :categoria");

    // Enlazar el valor de la variable $categoria al marcador de posición
    $sql->bindParam(":categoria", $categoria, PDO::PARAM_STR);

    // Ejecutar la consulta
    $sql->execute();

    // Obtener el resultado de la consulta
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    // Devolver la cantidad de registros
    return $resultado['total'];
}

}
