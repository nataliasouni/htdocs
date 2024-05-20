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

        public function cantidadPrendasQuirurgicasModelo($nombreTaller) {
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
        


        public function cantidadPrendasDefectuosasModelo($nombreTaller) {
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
}