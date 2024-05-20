<?php
require_once "mainModel.php";

class alquilerProductosModelo extends mainModel
{
    //Modelo para agrega
    protected static function agregarProductoModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO alquilerproductos(id,nombreproducto,detalles,alquiler15dias,alquiler30dias,deposito,estado) 
        VALUES(:id,:nombreProducto,:detalles,:alquiler15dias,:alquiler30dias,:deposito,:estado)");

        $sql->bindParam(":id", $datos['codigoProducto']);
        $sql->bindParam(":nombreProducto", $datos['nombreProducto']);
        $sql->bindParam(":detalles", $datos['detallesProducto']);
        $sql->bindParam(":alquiler15dias", $datos['precio15Dias']);
        $sql->bindParam(":alquiler30dias", $datos['precio30Dias']);
        $sql->bindParam(":deposito", $datos['precioDeposito']);
        $sql->bindParam(":estado", $datos['estado']);
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
    protected static function actualizarProductoModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("UPDATE alquilerproductos SET  id = :id, nombreproducto = :nombreproducto, detalles = :detalles, alquiler15dias = :alquiler15dias, alquiler30dias = :alquiler30dias, deposito = :deposito  WHERE id = :id");
        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":nombreproducto", $datos['nombreproducto']);
        $sql->bindParam(":detalles", $datos['detalles']);
        $sql->bindParam(":alquiler15dias", $datos['alquiler15dias']);
        $sql->bindParam(":alquiler30dias", $datos['alquiler30dias']);
        $sql->bindParam(":deposito", $datos['deposito']);
        $sql->execute();
        return $sql;
    }




}