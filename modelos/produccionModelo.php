<?php
require_once "mainModel.php";

class ProduccionModelo extends mainModel{

    protected static function actualizarPrendasModelo($datos) {
        // Actualizar la cantidad de prendas quirúrgicas
        $sql = self::conectarBD()->prepare("SELECT id, cantidadDisponible FROM prendasquirurgicas WHERE id = :idPrenda");
        $sql->bindParam(":idPrenda", $datos['idPrenda']);
        $sql->execute();
        $prenda = $sql->fetch(PDO::FETCH_ASSOC);
        $nuevaCantidad = $prenda['cantidadDisponible'] + $datos['totalprendasquirurgicas'];
        $sql = self::conectarBD()->prepare("UPDATE prendasquirurgicas SET cantidadDisponible = :nuevaCantidad WHERE id = :idPrenda");
        $sql->bindParam(":nuevaCantidad", $nuevaCantidad);
        $sql->bindParam(":idPrenda", $datos['idPrenda']);

        if ($sql->execute())  {
            return true; // La actualización fue exitosa
        } else {
            return false; // Hubo un error al actualizar
        }
        
    }

    protected static function prendasTallerModelo($datos) {
        // Actualizar la cantidad de prendas en los talleres
        $sql = self::conectarBD()->prepare("SELECT id, totalPrendasQuirurgicas, totalPrendasDefectuosas FROM taller WHERE id = :idtaller");
        $sql->bindParam(":idtaller", $datos['idtaller']);
        $sql->execute();
        $Taller = $sql->fetch(PDO::FETCH_ASSOC);
        $nuevaCantidadPQ = $Taller['totalPrendasQuirurgicas'] + $datos['totalprendasquirurgicas'];
        $nuevaCantidadPD = $Taller['totalPrendasDefectuosas'] + $datos['totalprendasdefectuosas'];
        
        $sql = self::conectarBD()->prepare("UPDATE taller SET totalPrendasQuirurgicas = :nuevaCantidadPQ, totalPrendasDefectuosas = :nuevaCantidadPD WHERE id = :idtaller");
        $sql->bindParam(":nuevaCantidadPQ", $nuevaCantidadPQ);
        $sql->bindParam(":nuevaCantidadPD", $nuevaCantidadPD);
        $sql->bindParam(":idtaller", $datos['idtaller']);
        
        if ($sql->execute())  {
            return true; // La actualización fue exitosa
        } else {
            return false; // Hubo un error al actualizar
        }
        
    }

    // Función para registrar la producción en la base de datos
    protected static function registrarProduccionModelo($datos) {
        // Preparar la consulta SQL
        $sql = self::conectarBD()->prepare("INSERT INTO produccion (cedulatrabajador,idtaller ,fecha, idPrenda,prendasquirurgicas,prendasdefectuosas) VALUES (:cedulatrabajador,:idtaller ,:fecha, :idPrenda,:totalprendasquirurgicas,:totalprendasdefectuosas)");
        // Bind parameters
        $sql->bindParam(":cedulatrabajador", $datos['cedulatrabajador']);
        $sql->bindParam(":idtaller", $datos['idtaller']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":idPrenda", $datos['idPrenda']);
        $sql->bindParam(":totalprendasquirurgicas", $datos['totalprendasquirurgicas']);
        $sql->bindParam(":totalprendasdefectuosas", $datos['totalprendasdefectuosas']); 
        //////////////////////////////////////////////

        if ($sql->execute()) {
            return true; // La actualización fue exitosa
        } else {
            return false; // Hubo un error al actualizar
        }
         
        
    }

    // Función para obtener los nombres y cédulas de los trabajadores desde la base de datos
    public function obtenerNombresYCedulasTrabajadoresModelo() {
    $sql = self::conectarBD()->prepare("SELECT nombre, cedula FROM trabajadores WHERE estado = 'si'");
    // Ejecutar la consulta
    $sql->execute();
    // Obtener los resultados de la consulta
    $datosTrabajadores = array();
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $datosTrabajadores[$row['nombre']] = $row['cedula'];
    }
    return $datosTrabajadores;
    }

    // Función para obtener los nombres y los id de los talleres desde la base de datos
    public function obtenerNombresIdTalleresModelo() {
        $sql = self::conectarBD()->prepare("SELECT cedula, nombre_usuario 
        FROM usuario 
        WHERE estado = 'si' 
        AND permiso = 'Taller' ");
        // Ejecutar la consulta
        $sql->execute();
        // Obtener los resultados de la consulta
        $nombresTalleres = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $nombresTalleres[$row['nombre_usuario']] = $row['cedula'];
    }
    return $nombresTalleres;
    }


    // Función para obtener los nombres y los id de las prendasQuirurgicas desde la base de datos
    public function obtenerNombresIdPrendasQuirurgicas() {
        $sql = self::conectarBD()->prepare("SELECT id,nombre FROM prendasQuirurgicas");
        // Ejecutar la consulta
        $sql->execute();
        // Obtener los resultados de la consulta
        $PrendasQuirurgicas = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $PrendasQuirurgicas[$row['nombre']] = $row['id'];
    }
    return $PrendasQuirurgicas;
    }

    public static function datosProduccionModelo($id)
    {   
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM  produccion WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;

    } //Fin del modelo


    public static function datosProduccionTrabajadorModelo($id)
    {   
        $sql = mainModel::conectarBD()->prepare("
        SELECT p.*,t.nombre AS nombre_trabajador,ta.nombre AS nombre_taller , pr.nombre AS prenda_elaborada
        FROM produccion p
        INNER JOIN trabajadores t ON p.cedulatrabajador = t.cedula 
        INNER JOIN taller ta ON p.idtaller = ta.id 
        INNER JOIN prendasquirurgicas pr ON p.idprenda = pr.id 
        WHERE p.id = :id 
        ");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    protected static function actualizarProduccionModelo($datos)
    {   
        $sql = mainModel::conectarBD()->prepare("UPDATE produccion SET  prendasquirurgicas = :prendasquirurgicas, prendasdefectuosas = :prendasdefectuosas  WHERE id = :id");
        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":prendasquirurgicas", $datos['prendasquirurgicas']);
        $sql->bindParam(":prendasdefectuosas", $datos['prendasdefectuosas']);
        $sql->execute();
        return $sql;
    }
    // Fin del modelo
} 








