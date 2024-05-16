<?php
if ($peticionAjax) {
    require_once "../modelos/talleresModelo.php";
} else {
    require_once "./modelos/talleresModelo.php";
}

class talleresControlador extends talleresModelo
{
    public function enlistarPrendasQControlador($nombre)
    {
        $consulta = "SELECT p.fecha, p.idPrenda, p.prendasquirurgicas, t.nombre_usuario AS nombre_taller
                 FROM produccion p
                 JOIN usuario t ON p.idtaller = t.cedula
                 WHERE t.nombre_usuario = :nombre ORDER BY p.fecha DESC";
        $conexion = mainModel::conectarBD();
        $datos = $conexion->prepare($consulta);
        $datos->bindParam(':nombre', $nombre);
        $datos->execute();
        $total = $datos->rowCount();
        $tabla = '';

        if ($total >= 1) {
            while ($rows = $datos->fetch()) {
                $idPrenda = $rows['idPrenda'];
                // Consulta para obtener el nombre de la prenda correspondiente al ID de prenda
                $consultaPrenda = "SELECT nombre FROM prendasQuirurgicas WHERE id = :idPrenda";
                $stmt = $conexion->prepare($consultaPrenda);
                $stmt->bindParam(':idPrenda', $idPrenda);
                $stmt->execute();
                $nombrePrenda = $stmt->fetchColumn();

                $tabla .= '<tr>';
                $tabla .= '<td>' . $rows['fecha'] . '</td>';
                // Mostrar el nombre de la prenda en lugar del ID de prenda
                $tabla .= '<td>' . $nombrePrenda . '</td>';
                $tabla .= '<td>' . $rows['prendasquirurgicas'] . '</td>';
                $tabla .= '</tr>';
            }
        } else {
            $tabla .= '<tr><td colspan="4">No hay registros en el taller seleccionado</td></tr>';
        }

        return $tabla;
    }

    public function enlistarDefectuosasControlador($nombre)
    {
        $consulta = "SELECT p.fecha, p.idPrenda, p.prendasdefectuosas, t.nombre_usuario AS nombre_taller
                 FROM produccion p
                 JOIN usuario t ON p.idtaller = t.cedula
                 WHERE t.nombre_usuario = :nombre ORDER BY p.fecha DESC"
        ;
        $conexion = mainModel::conectarBD();
        $datos = $conexion->prepare($consulta);
        $datos->bindParam(':nombre', $nombre);
        $datos->execute();
        $total = $datos->rowCount();
        $tabla = '';

        if ($total >= 1) {
            while ($rows = $datos->fetch()) {
                $idPrenda = $rows['idPrenda'];
                // Consulta para obtener el nombre de la prenda correspondiente al ID de prenda
                $consultaPrenda = "SELECT nombre FROM prendasQuirurgicas WHERE id = :idPrenda";
                $stmt = $conexion->prepare($consultaPrenda);
                $stmt->bindParam(':idPrenda', $idPrenda);
                $stmt->execute();
                $nombrePrenda = $stmt->fetchColumn();

                $tabla .= '<tr>';
                $tabla .= '<td>' . $rows['fecha'] . '</td>';
                // Mostrar el nombre de la prenda en lugar del ID de prenda
                $tabla .= '<td>' . $nombrePrenda . '</td>';
                $tabla .= '<td>' . $rows['prendasdefectuosas'] . '</td>';
                $tabla .= '</tr>';
            }
        } else {
            $tabla .= '<tr><td colspan="4">No hay registros en el taller seleccionado</td></tr>';
        }

        return $tabla;
    }

    public function cargarTallerControlador()
    {
        $tallerModelo = new talleresModelo();
        $talleres = $tallerModelo->obtenerTalleresModelo();

        foreach ($talleres as $taller) {
            $nombre = $taller['nombre_usuario'];
            $var = $nombre;

            echo '<a href="' . SERVERURL . 'homeOT?variable=' . $var . '">';
            echo '<div class="card">';
            echo '<div class="card-content">';
            echo '<div class="content-img">';
            echo '<img class="card-image" src="' . SERVERURL . 'vistas/img/talleres.png" alt="Taller1">';
            echo '</div>';
            echo '<div class="card-details">';
            echo '<h2 class="card-title">' . $nombre . '</h2>';
            echo '<p class="card-description">Descripción</p>';
            echo '<div class="registradas">Registradas</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }

    }

    public function cargarTallerNavControlador()
    {
        $tallerModelo = new talleresModelo();
        $talleres = $tallerModelo->obtenerTalleresModelo();

        foreach ($talleres as $taller) {
            $nombre = $taller['nombre_usuario'];
            $var = $nombre;

            echo '<li>';
            echo '<a href="' . SERVERURL . 'homeOT?variable=' . $var . '">';
            echo '<img class="submenu-image" src="' . SERVERURL . 'vistas/img/talleres.png" alt="Submenu Image">';
            echo $nombre;
            echo '</a>';
            echo '</li>';

        }
    }


    public function enlistarEnsambleControlador($Nombre)
    {
        $consulta = "SELECT p.id, p.ensamble_id, GROUP_CONCAT(e.Nombre SEPARATOR '<br>') as nombre_productos, SUM(p.cantidad) as total_cantidad, en.CantidadProduccion as cantidad_produccion, en.Estado as Estado
             FROM producto_ensamble p
             INNER JOIN productose e ON p.producto_id = e.Id
             INNER JOIN ensamble en ON p.ensamble_id = en.OrdenProdccion
             WHERE en.Estado = 'Si'
             GROUP BY p.ensamble_id
             ORDER BY p.ensamble_id ASC";

        $conexion = mainModel::conectarBD();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = count($datos);
        $tabla = '';

        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $rows) {

                $estadoProducto = $rows['Estado'] == "Si" ? "Habilitada" : "Deshabilitada";
                $claseFila = $rows['Estado'] == "Si" ? "" : "deshabilitado";

                $tabla .= '<tr class="' . $claseFila . '">';


                // Imprimir el ID del ensamble en la primera columna
                $tabla .= '<td>' . $rows['ensamble_id'] . '</td>';
                // Imprimir el nombre de los productos en una sola celda
                $tabla .= '<td>' . $rows['cantidad_produccion'] . '</td>';
                // Imprimir la cantidad de producción en la siguiente columna
                $tabla .= '<td>' . $rows['nombre_productos'] . '</td>';
                // Imprimir la suma total de la cantidad de productos en la última columna
                $tabla .= '<td>' . $rows['total_cantidad'] . '</td>';
                // Cerrar la fila actual
                $tabla .= '<td>
            <button onclick="window.location.href = \'' . SERVERURL . 'enviarEnsambleTaller/' .
                    mainModel::encryption($rows['id']) . '?variable=' . $Nombre . '\' ;" class="estado-detalles button_js btn-detalles" 
            type="button" title="Agregar" name="detalles"> 
            <img src="./vistas/img/Agregar.png"></img>
            </button>       
        </td>';
                $tabla .= '</tr>';
                $contador++;
            }
        } else {
            $tabla .= '<tr><td colspan="4">No hay registros en el sistema</td></tr>';
        }

        return $tabla; // Devolver la tabla construida
    }
    public function enlistarEnsamblePrendasControlador($nombre)
    {
        // Obtener el ID del taller utilizando el nombre proporcionado
        $conexion = mainModel::conectarBD();
        $sqlTaller = $conexion->prepare("SELECT id FROM taller WHERE nombre = :nombre");
        $sqlTaller->bindParam(':nombre', $nombre);
        $sqlTaller->execute();
        $resultadoTaller = $sqlTaller->fetch(PDO::FETCH_ASSOC);
        $idTaller = $resultadoTaller['id'];
    
        // Consulta para seleccionar los datos relacionados con el taller especificado por su ID
        $consulta = "SELECT te.ensamble_id, 
                            GROUP_CONCAT(p.Nombre SEPARATOR '<br>') as contenido_ensamble, 
                            GROUP_CONCAT(te.cantidadproductose SEPARATOR '<br>') as cantidad_producto_ensamble, 
                            GROUP_CONCAT(pc.Nombre SEPARATOR '<br>') as prendas_cortadas_nombre,
                            GROUP_CONCAT(te.cantidadprendascortadas SEPARATOR '<br>') as cantidad_prendas_cortadas
                     FROM taller_ensamble_prendas te
                     INNER JOIN productose p ON te.productose_id = p.Id
                     LEFT JOIN prendascortadas pc ON te.prendascortadas_id = pc.Id
                     WHERE te.idTaller = :idTaller
                     AND te.cantidadproductose > 0
                     GROUP BY te.ensamble_id
                     ORDER BY te.ensamble_id ASC";
    
        $sql = $conexion->prepare($consulta);
        $sql->bindParam(':idTaller', $idTaller);
        $sql->execute();
        $datos = $sql->fetchAll();
        $total = count($datos);
        $tabla = '';
    
        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr>';
    
                // Imprimir el ID del ensamble en la primera columna
                $tabla .= '<td>' . $rows['ensamble_id'] . '</td>';
                // Imprimir el contenido del ensamble (nombres de los productos) en la segunda columna
                $tabla .= '<td>' . $rows['contenido_ensamble'] . '</td>';
                // Imprimir los nombres de las prendas cortadas en la tercera columna
                $tabla .= '<td>' . $rows['cantidad_producto_ensamble'] . '</td>';
                // Imprimir los nombres de las prendas cortadas en la tercera columna
                $tabla .= '<td>' . $rows['prendas_cortadas_nombre'] . '</td>';
                // Imprimir las cantidades de las prendas cortadas en la cuarta columna
                $tabla .= '<td>' . $rows['cantidad_prendas_cortadas'] . '</td>';
                // Imprimir la cantidad de productos del ensamble en la quinta columna
    
                // Imprimir botones u opciones en la sexta columna
                // Cerrar la fila actual
                $tabla .= '</tr>';
                $contador++;
            }
        } else {
            $tabla .= '<tr><td colspan="5">No hay registros en el sistema para este taller</td></tr>';
        }
    
        return $tabla; // Devolver la tabla construida
    }
    

    public function actualizarPrendasEnviadasControlador($datos)
    {
        // Recibe los datos del formulario
        $nombreTaller = $datos['nombretaller'];
        $nuevaCantidadProducto = $datos['NuevaCantidad'];
        $cantidadPrendaUp = $datos['CantidadPrendaUp1'];
        $idProducto = $datos['IdProducto'];
        $nuevaCantidadProducto = $datos['NuevaCantidad'];
        $ordenProduccion = $datos['OrdenProduccionUp2'];

        foreach ($idProducto as $id => $productoId) {
            $sql2 = mainModel::conectarBD()->prepare("SELECT id, cantidad FROM producto_ensamble WHERE ensamble_id = :ensamble_id AND producto_id = :producto_id");
            $sql2->bindParam(':ensamble_id', $ordenProduccion);
            $sql2->bindParam(':producto_id', $productoId);
            $sql2->execute();
            $resultado2 = $sql2->fetch(PDO::FETCH_ASSOC);

            $nuevaCantidadProductoEnsamble = intval($resultado2['cantidad']) - intval($nuevaCantidadProducto[$id]);

            if ($nuevaCantidadProductoEnsamble < 0) {
                // La resta resulta en un valor negativo, muestra la alerta
                echo "<script>
                    Swal.fire({
                        title: 'Ocurrió un error inesperado',
                        text: 'La cantidad ingresada para el producto excede la cantidad disponible.',
                        type: 'error',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = '" . SERVERURL . "enviarEnsambleTaller/" . mainModel::encryption($resultado2['id']) . "?variable=" . $nombreTaller . "';
                        }
                    });
                </script>";
                exit();
            }
        }

        foreach ($cantidadPrendaUp as $id => $cantidad) {
            $cantidad = intval($cantidad);
            $idProducto = $datos['IdProducto'];
            $nuevaCantidadProducto = $datos['NuevaCantidad'];
            $ordenProduccion = $datos['OrdenProduccionUp2'];

            $sql = mainModel::conectarBD()->prepare("SELECT cantidad, Nombre FROM prendascortadas WHERE id = :IdPrenda1");
            $sql->bindParam(':IdPrenda1', $id);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);

            // Calcular la nueva cantidad después de la actualización
            $nuevaCantidad = intval($resultado['cantidad']) - intval($cantidad);
            if ($nuevaCantidad < 0) {
                // La resta resulta en un valor negativo, muestra la alerta
                echo "<script>
                    Swal.fire({
                        title: 'Ocurrió un error inesperado',
                        text: 'La cantidad ingresada para el producto excede la cantidad disponible.',
                        type: 'error',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = '" . SERVERURL . "enviarEnsambleTaller/" . mainModel::encryption($resultado2['id']) . "?variable=" . $nombreTaller . "';
                        }
                    });
                </script>";
                exit();
            }
        }

        foreach ($idProducto as $id => $productoId) {

            $ordenProduccion = $datos['OrdenProduccionUp2'];

            $sql2 = mainModel::conectarBD()->prepare("SELECT id, cantidad FROM producto_ensamble WHERE ensamble_id = :ensamble_id AND producto_id = :producto_id");
            $sql2->bindParam(':ensamble_id', $ordenProduccion);
            $sql2->bindParam(':producto_id', $id);
            $sql2->execute();
            $resultado2 = $sql2->fetch(PDO::FETCH_ASSOC);

            $nuevaCantidadProductoEnsamble = intval($resultado2['cantidad']) - intval($nuevaCantidadProducto[$id]);

            $sqlProductoEnsamble = mainModel::conectarBD()->prepare("UPDATE producto_ensamble SET cantidad = :cantidad WHERE ensamble_id = :ensamble_id AND producto_id = :producto_id");
            $sqlProductoEnsamble->bindParam(':cantidad', $nuevaCantidadProductoEnsamble);
            $sqlProductoEnsamble->bindParam(':ensamble_id', $ordenProduccion);
            $sqlProductoEnsamble->bindParam(':producto_id', $id);
            $sqlProductoEnsamble->execute();
        }

        foreach ($cantidadPrendaUp as $id => $cantidad) {

            $sql = mainModel::conectarBD()->prepare("SELECT cantidad, Nombre FROM prendascortadas WHERE id = :IdPrenda1");
            $sql->bindParam(':IdPrenda1', $id);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);

            $nuevaCantidad = intval($resultado['cantidad']) - intval($cantidad);

            $sqlPrendasCortadas = mainModel::conectarBD()->prepare("UPDATE prendascortadas SET cantidad = :cantidad WHERE id = :id");
            $sqlPrendasCortadas->bindParam(':cantidad', $nuevaCantidad);
            $sqlPrendasCortadas->bindParam(':id', $id);
            $sqlPrendasCortadas->execute();
        }

        $this->insertarDatos($datos);
    }




    public function insertarDatos($datos)
    {
    // Recibe los datos del formulario
    $nombreTaller = $datos['nombretaller'];
    $nuevaCantidadProducto = $datos['NuevaCantidad'];
    $cantidadPrendaUp = $datos['CantidadPrendaUp1'];
    $idProducto = $datos['IdProducto'];
    $nuevaCantidadProducto = $datos['NuevaCantidad'];
    $ordenProduccion = $datos['OrdenProduccionUp2'];

    // Obtener el id del taller
    $sqlTaller = mainModel::conectarBD()->prepare("SELECT id FROM taller WHERE nombre = :nombreTaller");
    $sqlTaller->bindParam(':nombreTaller', $nombreTaller);
    $sqlTaller->execute();
    $resultadoTaller = $sqlTaller->fetch(PDO::FETCH_ASSOC);
    $idTaller = $resultadoTaller['id'];

    // Obtener las longitudes de los arrays
    $cantidadPrendaUpLength = count($cantidadPrendaUp);
    $idProductoLength = count($idProducto);

    // Determinar cuál es mayor
    if ($cantidadPrendaUpLength >= $idProductoLength) {
        // Si $cantidadPrendaUp es mayor o igual, utilizar su longitud en el bucle
        $maxLength = $cantidadPrendaUpLength;
    } else {
        // Si $idProducto es mayor, utilizar su longitud en el bucle
        $maxLength = $idProductoLength;
    }
    // Insertar nuevos registros
    for ($i = 0; $i < $maxLength; $i++) {

        if ($cantidadPrendaUpLength >= $idProductoLength) {

            if($idProductoLength< $i){ 

                $sqlInsert = mainModel::conectarBD()->prepare("INSERT INTO taller_ensamble_prendas (idTaller, ensamble_id, productose_id, cantidadproductose, prendascortadas_id, cantidadprendascortadas) VALUES (:idTaller, :ensamble_id, NULL, NULL, :prendascortadas_id, :cantidadprendascortadas)");
                $sqlInsert->bindParam(':idTaller', $idTaller);
                $sqlInsert->bindParam(':ensamble_id', $ordenProduccion);
                $sqlInsert->bindParam(':prendascortadas_id', $i);
                $sqlInsert->bindParam(':cantidadprendascortadas', $cantidadPrendaUp[$i]);
                $sqlInsert->execute();

                }else{

                    $sqlInsert = mainModel::conectarBD()->prepare("INSERT INTO taller_ensamble_prendas (idTaller, ensamble_id, productose_id, cantidadproductose, prendascortadas_id, cantidadprendascortadas) VALUES (:idTaller, :ensamble_id, :productose_id, :cantidadproductose, :prendascortadas_id, :cantidadprendascortadas)");
                    $sqlInsert->bindParam(':idTaller', $idTaller);
                    $sqlInsert->bindParam(':ensamble_id', $ordenProduccion);
                    $sqlInsert->bindParam(':productose_id', $i);
                    $sqlInsert->bindParam(':cantidadproductose', $nuevaCantidadProducto[$i]);
                    $sqlInsert->bindParam(':prendascortadas_id', $i);
                    $sqlInsert->bindParam(':cantidadprendascortadas', $cantidadPrendaUp[$i]);
                    $sqlInsert->execute();

                }

        } 

        if ($idProductoLength > $cantidadPrendaUpLength) {

            if($cantidadPrendaUpLength< $i){ 

                $sqlInsert = mainModel::conectarBD()->prepare("INSERT INTO taller_ensamble_prendas (idTaller, ensamble_id, productose_id, cantidadproductose, prendascortadas_id, cantidadprendascortadas) VALUES (:idTaller, :ensamble_id, :productose_id, :cantidadproductose, NULL, NULL)");
                $sqlInsert->bindParam(':idTaller', $idTaller);
                $sqlInsert->bindParam(':ensamble_id', $ordenProduccion);
                $sqlInsert->bindParam(':productose_id', $i);
                $sqlInsert->bindParam(':cantidadproductose', $nuevaCantidadProducto[$i]);
                $sqlInsert->execute();

                }else{

                    $sqlInsert = mainModel::conectarBD()->prepare("INSERT INTO taller_ensamble_prendas (idTaller, ensamble_id, productose_id, cantidadproductose, prendascortadas_id, cantidadprendascortadas) VALUES (:idTaller, :ensamble_id, :productose_id, :cantidadproductose, :prendascortadas_id, :cantidadprendascortadas)");
                    $sqlInsert->bindParam(':idTaller', $idTaller);
                    $sqlInsert->bindParam(':ensamble_id', $ordenProduccion);
                    $sqlInsert->bindParam(':productose_id', $i);
                    $sqlInsert->bindParam(':cantidadproductose', $nuevaCantidadProducto[$i]);
                    $sqlInsert->bindParam(':prendascortadas_id', $i);
                    $sqlInsert->bindParam(':cantidadprendascortadas', $cantidadPrendaUp[$i]);
                    $sqlInsert->execute();

                }

            } 


        
    }

    // Mostrar mensaje de éxito
    echo "<script>
            Swal.fire({
                title: 'Se ha registrado con éxito',
                text: 'Has enviado materia prima',
                type: 'success',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "ensambleTaller/taller?variable=" . $nombreTaller . "';
                }
            });
        </script>";
    exit();
    }





}