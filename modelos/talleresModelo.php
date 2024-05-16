<?php
require_once "mainModel.php";

class talleresModelo extends mainModel
{
    
    public function obtenerTalleresModelo() {
        $sql = self::conectarBD()->prepare("SELECT nombre_usuario FROM usuario WHERE estado = 'si'  AND permiso = 'Taller' ");
        // Ejecutar la consulta
        $sql->execute();
        // Obtener los resultados de la consulta
        $datosTaller = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $datosTaller[] = $row;;
        }
        return $datosTaller;
        }


}