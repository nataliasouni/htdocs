<?php
require_once "mainModel.php";

class talleresModelo extends mainModel
{

    public function obtenerTalleresModelo()
    {
        $sql = self::conectarBD()->prepare("SELECT nombre_usuario FROM usuario WHERE estado = 'si'  AND permiso = 'Taller' ");
        // Ejecutar la consulta
        $sql->execute();
        // Obtener los resultados de la consulta
        $datosTaller = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $datosTaller[] = $row;
            ;
        }
        return $datosTaller;
    }

    public static function actualizarCantidadTotalProducto($idProducto, $cantidadProducto)
    {
        $queryActualizarCantidad = "UPDATE producto_ensamble SET cantidad = cantidad - :cantidadProducto WHERE producto_id = :idProducto";
        $conexion = mainModel::conectarBD();
        $actualizarCantidad = $conexion->prepare($queryActualizarCantidad);
        $actualizarCantidad->bindParam(':cantidadProducto', $cantidadProducto);
        $actualizarCantidad->bindParam(':idProducto', $idProducto);
        $actualizarCantidad->execute();

        return $actualizarCantidad->rowCount() === 1;
    }

    protected static function agregarEnsambleModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamble_taller(OrdenProdccion, CantidadProduccion, Estado) 
        VALUES(:OrdenProduccion,:CantidadProduccion,:Estado)");

        $sql->bindParam(":OrdenProduccion", $datos['OrdenProdccion']);
        $sql->bindParam(":CantidadProduccion", $datos['CantidadProduccion']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

}