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


    public function cantidadPrendasQuirurgicasModelo($nombreTaller)
    {
        // Paso 1: Obtener la cédula del taller desde la tabla usuario
        $conexion = mainModel::conectarBD();
        $sqlCedula = $conexion->prepare("SELECT cedula FROM usuario WHERE nombre_usuario = :nombreTaller");
        $sqlCedula->bindParam(":nombreTaller", $nombreTaller, PDO::PARAM_STR);
        $sqlCedula->execute();
        $resultadoCedula = $sqlCedula->fetch(PDO::FETCH_ASSOC);

        // Verificar si se obtuvo una cédula
        if ($resultadoCedula && isset($resultadoCedula['cedula'])) {
            $cedulaTaller = $resultadoCedula['cedula'];

            // Paso 2: Contar los registros en la tabla produccion donde idtaller coincide con la cédula obtenida
            $sqlProduccion = $conexion->prepare("SELECT COUNT(*) AS total FROM produccion WHERE idtaller = :cedulaTaller");
            $sqlProduccion->bindParam(":cedulaTaller", $cedulaTaller, PDO::PARAM_STR);
            $sqlProduccion->execute();
            $resultadoProduccion = $sqlProduccion->fetch(PDO::FETCH_ASSOC);

            // Devolver la cantidad de registros
            return $resultadoProduccion['total'];
        } else {
            // Si no se encontró la cédula, devolver 0 o manejar el error apropiadamente
            return 0;
        }
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
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamble_taller(id, id_ensamble, id_taller) 
        VALUES(:id, :id_ensamble,:id_taller)");

        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":id_ensamble", $datos['id_ensamble']);
        $sql->bindParam(":id_taller", $datos['id_taller']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    protected static function agregarProductosModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamblet_productos(id_producto, id_ensamble, cantidadProducto, id_ensamblet) 
        VALUES(:id_producto,:id_ensamble,:cantidadProducto, :id_ensamblet)");

        $sql->bindParam(":id_producto", $datos['id_producto']);
        $sql->bindParam(":id_ensamble", $datos['id_ensamble']);
        $sql->bindParam(":cantidadProducto", $datos['cantidadProducto']);
        $sql->bindParam(":id_ensamblet", $datos['id_ensamblet']);
        $sql->execute();
        return $sql;
    }

    protected static function agregarPrendasModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO ensamblet_prendas(id_prenda, id_ensamble, cantidadPrenda, id_ensamblet) 
        VALUES(:id_prenda,:id_ensamble,:cantidadPrenda, :id_ensamblet)");

        $sql->bindParam(":id_prenda", $datos['id_prenda']);
        $sql->bindParam(":id_ensamble", $datos['id_ensamble']);
        $sql->bindParam(":cantidadPrenda", $datos['cantidadPrenda']);
        $sql->bindParam(":id_ensamblet", $datos['id_ensamblet']);
        $sql->execute();
        return $sql;
    }

    public function cantidadPrendasDefectuosasModelo($nombreTaller)
    {
        // Paso 1: Obtener la cédula del taller desde la tabla usuario
        $conexion = mainModel::conectarBD();
        $sqlCedula = $conexion->prepare("SELECT cedula FROM usuario WHERE nombre_usuario = :nombreTaller");
        $sqlCedula->bindParam(":nombreTaller", $nombreTaller, PDO::PARAM_STR);
        $sqlCedula->execute();
        $resultadoCedula = $sqlCedula->fetch(PDO::FETCH_ASSOC);

        // Verificar si se obtuvo una cédula
        if ($resultadoCedula && isset($resultadoCedula['cedula'])) {
            $cedulaTaller = $resultadoCedula['cedula'];

            // Paso 2: Contar los registros en la tabla produccion donde idtaller coincide con la cédula obtenida
            $sqlProduccion = $conexion->prepare("SELECT COUNT(*) AS total FROM produccion p WHERE idtaller = :cedulaTaller AND p.prendasdefectuosas > 0 ");
            $sqlProduccion->bindParam(":cedulaTaller", $cedulaTaller, PDO::PARAM_STR);
            $sqlProduccion->execute();
            $resultadoProduccion = $sqlProduccion->fetch(PDO::FETCH_ASSOC);

            // Devolver la cantidad de registros
            return $resultadoProduccion['total'];
        } else {
            // Si no se encontró la cédula, devolver 0 o manejar el error apropiadamente
            return 0;
        }
    }

    public function cantidadEnsamblesModelo($nombreTaller)
    {
        // Paso 1: Obtener la cédula del taller desde la tabla usuario
        $conexion = mainModel::conectarBD();
        $sqlCedula = $conexion->prepare("SELECT cedula FROM usuario WHERE nombre_usuario = :nombreTaller");
        $sqlCedula->bindParam(":nombreTaller", $nombreTaller, PDO::PARAM_STR);
        $sqlCedula->execute();
        $resultadoCedula = $sqlCedula->fetch(PDO::FETCH_ASSOC);

        // Verificar si se obtuvo una cédula
        if ($resultadoCedula && isset($resultadoCedula['cedula'])) {
            $cedulaTaller = $resultadoCedula['cedula'];

            // Paso 2: Contar los registros en la tabla produccion donde idtaller coincide con la cédula obtenida
            $sqlProduccion = $conexion->prepare("SELECT COUNT(*) AS total FROM ensamble_taller p WHERE id_taller = :cedulaTaller ");
            $sqlProduccion->bindParam(":cedulaTaller", $cedulaTaller, PDO::PARAM_STR);
            $sqlProduccion->execute();
            $resultadoProduccion = $sqlProduccion->fetch(PDO::FETCH_ASSOC);

            // Devolver la cantidad de registros
            return $resultadoProduccion['total'];
        } else {
            // Si no se encontró la cédula, devolver 0 o manejar el error apropiadamente
            return 0;
        }
    }
}