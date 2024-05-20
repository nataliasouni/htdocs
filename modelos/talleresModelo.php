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

    public static function actualizarCantidadTotalProducto($idProducto, $cantidadProducto, $idEnsamble)
    {
        $queryActualizarCantidad = "UPDATE producto_ensamble SET cantidad = cantidad - :cantidadProducto WHERE producto_id = :idProducto AND ensamble_id = :idEnsamble";
        $conexion = mainModel::conectarBD();
        $actualizarCantidad = $conexion->prepare($queryActualizarCantidad);
        $actualizarCantidad->bindParam(':cantidadProducto', $cantidadProducto);
        $actualizarCantidad->bindParam(':idProducto', $idProducto);
        $actualizarCantidad->bindParam(':idEnsamble', $idEnsamble);
        $actualizarCantidad->execute();

        return $actualizarCantidad->rowCount() === 1;
    }

    public static function actualizarCantidadTotalPrenda($idPrenda, $cantidadPrenda)
    {
        $queryActualizarCantidad = "UPDATE prendascortadas SET Cantidad = Cantidad - :cantidadPrenda WHERE id = :idPrenda";
        $conexion = mainModel::conectarBD();
        $actualizarCantidad = $conexion->prepare($queryActualizarCantidad);
        $actualizarCantidad->bindParam(':cantidadPrenda', $cantidadPrenda);
        $actualizarCantidad->bindParam(':idPrenda', $idPrenda);
        $actualizarCantidad->execute();

        return $actualizarCantidad->rowCount() === 1;
    }


    protected static function agregarEnsambleModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamble_taller(id_ensamble, id_taller) 
        VALUES(:id_ensamble,:id_taller)");

        $sql->bindParam(":id_ensamble", $datos['id_ensamble']);
        $sql->bindParam(":id_taller", $datos['id_taller']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    protected static function agregarProductosModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamblet_productos(id_producto, id_ensamble, cantidadProducto) 
        VALUES(:id_producto,:id_ensamble,:cantidadProducto)");

        $sql->bindParam(":id_producto", $datos['id_producto']);
        $sql->bindParam(":id_ensamble", $datos['id_ensamble']);
        $sql->bindParam(":cantidadProducto", $datos['cantidadProducto']);
        $sql->execute();
        return $sql;
    }

    protected static function agregarPrendasModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamblet_prendas(id_prenda, id_ensamble, cantidadPrenda) 
        VALUES(:id_prenda,:id_ensamble,:cantidadPrenda)");

        $sql->bindParam(":id_prenda", $datos['id_prenda']);
        $sql->bindParam(":id_ensamble", $datos['id_ensamble']);
        $sql->bindParam(":cantidadPrenda", $datos['cantidadPrenda']);
        $sql->execute();
        return $sql;
    }

}