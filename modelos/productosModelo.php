<?php
require_once "mainModel.php";

class productosModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarProductoModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO productos(Id,Nombre,Descripcion,Categoria,Cantidad,Alquiler,Estado,Imagen) 
        VALUES(:Id,:Nombre,:Descripcion,:Categoria,:Cantidad,:Alquiler,:Estado,:Imagen)");

        $sql->bindParam(":Id", $datos['idNormal']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Categoria", $datos['Categoria']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Alquiler", $datos['Alquiler']);
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
    Descripcion = :Descripcion, Categoria = :Categoria, Cantidad = :Cantidad, Alquiler = :Alquiler, 
    Estado = :Estado, Imagen = :Imagen WHERE Id = :Id");
    
    $sql->bindParam(":Nombre", $datos['NombreUp']);
    $sql->bindParam(":Descripcion", $datos['DescripcionUp']);
    $sql->bindParam(":Categoria", $datos['CategoriaUp']);
    $sql->bindParam(":Cantidad", $datos['CantidadUp']);
    $sql->bindParam(":Alquiler", $datos['AlquilerUp']);
    $sql->bindParam(":Estado", $datos['EstadoUp']);
    $sql->bindParam(":Imagen", $datos['ImagenUp']);
    $sql->bindParam(":Id", $datos['Id']);
    
    if($sql->execute()) {
        return $sql; // Retorna la sentencia preparada
    } else {
        return false; // Retorna false si hubo un error en la ejecución
    }
}

}
