<?php
require_once "mainModel.php";

class ensambleModelo extends mainModel
{
    //Modelo para agregar un usuario
    protected static function agregarEnsambleModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamble(OrdenProdccion, CantidadProduccion, Estado) 
        VALUES(:OrdenProduccion,:CantidadProduccion,:Estado)");

        $sql->bindParam(":OrdenProduccion", $datos['OrdenProdccion']);
        $sql->bindParam(":CantidadProduccion", $datos['CantidadProduccion']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para agregar una alerta
    protected static function agregarProductosModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO producto_ensamble(ensamble_id, producto_id, cantidad, Pendiente) 
        VALUES(:ensamble_id,:producto_id,:cantidad,:Pendiente)");

        $sql->bindParam(":ensamble_id", $datos['ensamble_id']);
        $sql->bindParam(":producto_id", $datos['producto_id']);
        $sql->bindParam(":cantidad", $datos['cantidad']);
        $sql->bindParam(":Pendiente", $datos['Pendiente']);
        $sql->execute();
        return $sql;
    }


    protected static function datosEnsambleModelo($OrdenProduccion)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM ensamble WHERE OrdenProduccion = :OrdenProduccion");
        $sql->bindParam(":OrdenProduccion", $OrdenProduccion);
        $sql->execute();
        return $sql;
    }

    protected static function datosEnsamblePModelo($id)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT *
            FROM producto_ensamble p
            INNER JOIN productose e ON p.producto_id = e.Id
            INNER JOIN ensamble en ON p.ensamble_id = en.OrdenProdccion
            WHERE p.id = :id"); // Corregido el campo de comparación
        $sql->bindParam(":id", $id); // Enlaza el parámetro correctamente
        $sql->execute();
        return $sql;
    }

    public static function obtenerProductosEnsambleModelo($idEnsamble)
    {
        $sql = mainModel::conectarBD()->prepare("
            SELECT p.*, e.*, en.*
            FROM producto_ensamble p
            INNER JOIN productose e ON p.producto_id = e.Id
            INNER JOIN ensamble en ON p.ensamble_id = en.OrdenProdccion
            WHERE p.ensamble_id = :idEnsamble
        ");
        $sql->bindParam(":idEnsamble", $idEnsamble);
        $sql->execute();
        return $sql;
    }


    protected static function datosProductoModelo($id)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM productose WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;
    }

    public static function actualizarCantidadTotalProducto($idProducto, $cantidadProducto)
    {
        $queryActualizarCantidad = "UPDATE productose SET cantidadTotal = cantidadTotal + :cantidadProducto WHERE Id = :idProducto";
        $conexion = mainModel::conectarBD();
        $actualizarCantidad = $conexion->prepare($queryActualizarCantidad);
        $actualizarCantidad->bindParam(':cantidadProducto', $cantidadProducto);
        $actualizarCantidad->bindParam(':idProducto', $idProducto);
        $actualizarCantidad->execute();

        return $actualizarCantidad->rowCount() === 1;
    }

    protected static function actualizarEnsamble($datos){
        $sql = mainModel::conectarBD()->prepare("UPDATE ensamble 
                                         SET OrdenProdccion = :OrdenProduccion, 
                                             CantidadProduccion = :CantidadProduccion, 
                                             Estado = :Estado 
                                         WHERE OrdenProdccion = :OrdenProduccionUp");
    
        $sql->bindParam(":OrdenProduccion", $datos['OrdenProdccion']);
        $sql->bindParam(":CantidadProduccion", $datos['CantidadProduccion']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":OrdenProduccionUp", $datos['OrdenProduccionUp']);
    
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
    


    protected static function actualizarProductoEnsamble($datos)
    {
        $sql = mainModel::conectarBD()->prepare("UPDATE producto_ensamble 
            SET cantidad = :cantidad, 
                Pendiente = :Pendiente
            WHERE ensamble_id = :idEnsambleUp
            AND producto_id = :IdProducto");

        $sql->bindParam(":cantidad", $datos['cantidad']);
        $sql->bindParam(":Pendiente", $datos['Pendiente']);
        $sql->bindParam(":idEnsambleUp", $datos['ensamble_id']); // Corregí el nombre de la clave
        $sql->bindParam(":IdProducto", $datos['producto_id']); // Corregí el nombre de la clave

        if ($sql->execute()) {
            return $sql;
        } else {
            return false;
        }
    }


}
