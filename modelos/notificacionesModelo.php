<?php
require_once "mainModel.php";

class notificacionesModelo extends mainModel
{
    // Función para obtener los productos con poca cantidad en la base de datos desde la base de datos
    public function obtenerProductosModelo() {
        $sql = self::conectarBD()->prepare("SELECT id, nombre, categoria, cantidad, fecha, hora FROM productos WHERE cantidad <= 5");
        // Ejecutar la consulta
        $sql->execute();
        // Obtener los resultados de la consulta
        $datosProductos = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $datosProductos[] = $row;;
        }
        return $datosProductos;
    }


    public function cantidadProductosModelo() {
        $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM productos WHERE cantidad <= 5");

        // Ejecutar la consulta
        $sql->execute();

        // Obtener el resultado de la consulta
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        // Devolver la cantidad de registros
        return $resultado['total'];
    }

}