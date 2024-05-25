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

    public static function obtenerNotificacionesTallerModelo()
{
    // Preparar la consulta SQL para obtener las notificaciones del taller y los nombres de los usuarios
    $sql = mainModel::conectarBD()->prepare("
        SELECT nt.id, u.nombre_usuario, nt.insumos, nt.fecha, nt.hora, nt.estado 
        FROM notificaciones_taller nt
        INNER JOIN usuario u ON nt.cedula = u.cedula WHERE nt.estado = 'Si'
    ");

    // Ejecutar la consulta
    $sql->execute();

    // Obtener los resultados de la consulta
    $datosNotificaciones = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos de las notificaciones
    return $datosNotificaciones;
}

public function cantidadInsumosTallerModelo() {
    $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM notificaciones_taller WHERE estado= 'Si'");

    // Ejecutar la consulta
    $sql->execute();

    // Obtener el resultado de la consulta
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    // Devolver la cantidad de registros
    return $resultado['total'];
}

    public function cantidadAlertas() {
        // Conectar a la base de datos y preparar la primera consulta
        $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM productos WHERE cantidad <= 5");

        // Ejecutar la primera consulta
        $sql->execute();

        // Obtener el resultado de la primera consulta
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        // Conectar a la base de datos y preparar la segunda consulta
        $sql1 = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM notificaciones_taller WHERE estado= 'Si'");

        // Ejecutar la segunda consulta
        $sql1->execute();

        // Obtener el resultado de la segunda consulta
        $resultado1 = $sql1->fetch(PDO::FETCH_ASSOC);

        // Sumar los totales de ambas consultas
        $total = $resultado['total'] + $resultado1['total'];

        // Devolver la suma de los totales
        return $total;

    }


}