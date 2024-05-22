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

    public function enlistarPrendasQTallerControlador($cedula)
    {
        $consulta = "SELECT p.fecha, p.idPrenda, p.prendasquirurgicas, t.cedula AS nombre_taller
                 FROM produccion p
                 JOIN usuario t ON p.idtaller = t.cedula
                 WHERE t.cedula = :cedula ORDER BY p.fecha DESC";
        $conexion = mainModel::conectarBD();
        $datos = $conexion->prepare($consulta);
        $datos->bindParam(':cedula', $cedula);
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
                 WHERE t.nombre_usuario = :nombre AND p.prendasdefectuosas> 0 ORDER BY p.fecha DESC"
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

    public function enlistarDefectuosasTallerControlador($cedula)
    {
        $consulta = "SELECT p.fecha, p.idPrenda, p.prendasdefectuosas, t.cedula AS nombre_taller
                 FROM produccion p
                 JOIN usuario t ON p.idtaller = t.cedula
                 WHERE cedula = :cedula AND p.prendasdefectuosas> 0 ORDER BY p.fecha DESC"
        ;
        $conexion = mainModel::conectarBD();
        $datos = $conexion->prepare($consulta);
        $datos->bindParam(':cedula', $cedula);
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

    public function enlistarEnsamblePrendasControlador($nombre)
    {
        // Obtener el ID del taller utilizando el nombre proporcionado
        $conexion = mainModel::conectarBD();
        $sqlTaller = $conexion->prepare("SELECT cedula FROM usuario WHERE nombre_usuario = :nombre_taller");
        $sqlTaller->bindParam(':nombre_taller', $nombre);
        $sqlTaller->execute();
        $resultadoTaller = $sqlTaller->fetch(PDO::FETCH_ASSOC);
        $idTaller = $resultadoTaller['cedula'];

        // Consulta para seleccionar los datos relacionados con el taller especificado por su ID
        $consulta = "SELECT 
        ep.id_ensamble,
        GROUP_CONCAT(DISTINCT CONCAT(pe.Nombre, ' (', ep.cantidadProducto, ')') SEPARATOR '<br>') AS contenido_ensamble,
        GROUP_CONCAT(DISTINCT CONCAT(pc.Nombre, ' (', pr.cantidadPrenda, ')') SEPARATOR '<br>') AS prendas_cortadas,
        (SELECT SUM(cantidadProducto) FROM ensamblet_productos WHERE id_ensamble = et.id_ensamble AND id_ensamblet = et.id) AS total_productos,
        (SELECT SUM(cantidadPrenda) FROM ensamblet_prendas WHERE id_ensamble = et.id_ensamble AND id_ensamblet = et.id) AS total_prendas
        FROM ensamble_taller et
        INNER JOIN ensamblet_productos ep ON ep.id_ensamble = et.id_ensamble
        INNER JOIN ensamblet_prendas pr ON ep.id_ensamble = pr.id_ensamble 
        INNER JOIN producto_ensamble p ON ep.id_producto = p.producto_id
        INNER JOIN productose pe ON p.producto_id = pe.Id
        LEFT JOIN prendascortadas pc ON pr.id_prenda = pc.id
        WHERE et.id_taller = :idTaller AND ep.id_ensamblet = et.id AND pr.id_ensamblet = et.id
        GROUP BY ep.id_ensamble
        ORDER BY ep.id_ensamble ASC
    ";


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
                $tabla .= '<td>' . $rows['id_ensamble'] . '</td>';
                // Imprimir el contenido del ensamble (nombres de los productos) en la segunda columna
                $tabla .= '<td>' . $rows['contenido_ensamble'] . '</td>';
                // Imprimir el total de productos
                $tabla .= '<td>' . $rows['total_productos'] . '</td>';
                // Imprimir las cantidades de los productos del ensamble en la tercera columna
                $tabla .= '<td>' . $rows['prendas_cortadas'] . '</td>';
                // Imprimir el total de prendas
                $tabla .= '<td>' . $rows['total_prendas'] . '</td>';
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

    public function enlistarEnsambleTallerControlador($cedula)
{
    // Obtener la conexión a la base de datos
    $conexion = mainModel::conectarBD();

    // Consulta para seleccionar los datos relacionados con el taller especificado por su ID
    $consulta = "SELECT 
        ep.id_ensamble,
        GROUP_CONCAT(DISTINCT CONCAT(pe.Nombre, ' (', ep.cantidadProducto, ')') SEPARATOR '<br>') AS contenido_ensamble,
        GROUP_CONCAT(DISTINCT CONCAT(pc.Nombre, ' (', pr.cantidadPrenda, ')') SEPARATOR '<br>') AS prendas_cortadas,
        (SELECT SUM(cantidadProducto) FROM ensamblet_productos WHERE id_ensamble = et.id_ensamble AND id_ensamblet = et.id) AS total_productos,
        (SELECT SUM(cantidadPrenda) FROM ensamblet_prendas WHERE id_ensamble = et.id_ensamble AND id_ensamblet = et.id) AS total_prendas
        FROM ensamble_taller et
        INNER JOIN ensamblet_productos ep ON ep.id_ensamble = et.id_ensamble
        INNER JOIN ensamblet_prendas pr ON ep.id_ensamble = pr.id_ensamble 
        INNER JOIN producto_ensamble p ON ep.id_producto = p.producto_id
        INNER JOIN productose pe ON p.producto_id = pe.Id
        LEFT JOIN prendascortadas pc ON pr.id_prenda = pc.id
        WHERE et.id_taller = :cedula AND ep.id_ensamblet = et.id AND pr.id_ensamblet = et.id
        GROUP BY ep.id_ensamble
        ORDER BY ep.id_ensamble ASC";

    // Preparar la consulta
    $sql = $conexion->prepare($consulta);
    // Asignar el valor del parámetro :cedula
    $sql->bindParam(':cedula', $cedula);
    // Ejecutar la consulta
    $sql->execute();
    // Obtener los datos
    $datos = $sql->fetchAll();
    $total = count($datos);
    $tabla = '';

    if ($total >= 1) {
        $contador = 1;
        foreach ($datos as $rows) {
            $tabla .= '<tr>';

            // Imprimir el ID del ensamble en la primera columna
            $tabla .= '<td>' . $rows['id_ensamble'] . '</td>';
            // Imprimir el contenido del ensamble (nombres de los productos) en la segunda columna
            $tabla .= '<td>' . $rows['contenido_ensamble'] . '</td>';
            // Imprimir el total de productos
            $tabla .= '<td>' . $rows['total_productos'] . '</td>';
            // Imprimir las cantidades de los productos del ensamble en la tercera columna
            $tabla .= '<td>' . $rows['prendas_cortadas'] . '</td>';
            // Imprimir el total de prendas
            $tabla .= '<td>' . $rows['total_prendas'] . '</td>';
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


    public function enlistarEnsambleControlador($Nombre)
    {
        // Consulta para obtener los ensambles que aún no están asociados al taller
        $consulta = "SELECT p.id, p.ensamble_id, GROUP_CONCAT(e.Nombre SEPARATOR '<br>') as nombre_productos, SUM(p.cantidad) as total_cantidad, en.CantidadProduccion as cantidad_produccion, en.Estado as Estado
         FROM producto_ensamble p
         INNER JOIN productose e ON p.producto_id = e.Id
         INNER JOIN ensamble en ON p.ensamble_id = en.OrdenProdccion
         WHERE en.Estado = 'Si' AND p.ensamble_id NOT IN (
             SELECT id_ensamble FROM ensamble_taller WHERE id_taller = (
                 SELECT cedula FROM usuario WHERE nombre_usuario = :Nombre
             )
         )
         GROUP BY p.ensamble_id
         ORDER BY p.ensamble_id ASC";

        $conexion = mainModel::conectarBD();
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':Nombre', $Nombre);
        $stmt->execute();
        $datos = $stmt->fetchAll();
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
            <button onclick="window.location.href = \'' . SERVERURL . 'enviarEnsamble/' .
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



    public function enlistarProductoControlador($idEnsamble)
    {
        $idEnsamble = mainModel::limpiarCadena($idEnsamble);

        $consulta = "SELECT SQL_CALC_FOUND_ROWS pe2.producto_id, pe.Nombre, pe2.cantidad
                 FROM producto_ensamble pe2
                 JOIN ensamble e ON e.OrdenProdccion = pe2.ensamble_id
                 JOIN productose pe ON pe.Id = pe2.producto_id
                 WHERE e.OrdenProdccion = :idEnsamble
                 ORDER BY pe.Id ASC;";
        $conexion = mainModel::conectarBD();
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':idEnsamble', $idEnsamble, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()")->fetchColumn();
        $tabla = '';

        if ($total >= 1) {
            foreach ($datos as $rows) {
                // Filas
                $tabla .= '<tr>
                <td name="IdProducto">' . htmlspecialchars($rows['producto_id']) . '</td>
                <td name="NombreProducto">' . htmlspecialchars($rows['Nombre']) . '</td>
                <td name="cantidadPr">' . htmlspecialchars($rows['cantidad']) . '</td>
                <td><input type="number" name="cantidadProducto[]" class="cantidadProducto" required></td>
            </tr>';
            }
        } else {
            $tabla .= '<tr><td colspan="10">No hay registros en el sistema</td></tr>';
        }

        return $tabla; // Devolver la tabla construida
    }

    public function cantidadPrendasQuirurgicasControlador($var)
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadprendasq = talleresModelo::cantidadPrendasQuirurgicasModelo($var);

        // Devuelve la cantidad de registros
        return $cantidadprendasq;

    }

    public function cantidadPrendasDefectuosasControlador($var)
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadprendasd = talleresModelo::cantidadPrendasDefectuosasModelo($var);

        // Devuelve la cantidad de registros
        return $cantidadprendasd;

    }

    public function cantidadEnsambleTallerControlador($var)
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadprendasd = talleresModelo::cantidadEnsamblesModelo($var);

        // Devuelve la cantidad de registros
        return $cantidadprendasd;

    }

    public function enlistarPrendasControlador()
    {
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM prendascortadas;";
        $conexion = mainModel::conectarBD();
        $datos = $conexion->query($consulta)->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()")->fetchColumn();
        $tabla = '';

        if ($total >= 1) {
            foreach ($datos as $rows) {
                //Filas
                $tabla .= '<tr>
                <td name="IdPrenda">' . htmlspecialchars($rows['id']) . '</td>
                <td name="NombrePrenda">' . htmlspecialchars($rows['Nombre']) . '</td>
                <td name="cantidadP">' . htmlspecialchars($rows['Cantidad']) . '</td>
                <td><input type="number" name="cantidadPrenda[]" class="cantidad" required></td>
            </tr>';
            }
        } else {
            $tabla .= '<tr><td colspan="10">No hay registros en el sistema</td></tr>';
        }

        return $tabla; // Devolver la tabla construida
    }

    public function agregarEnsambleControlador()
    {
        $idensamblet = mainModel::limpiarCadena($_POST['idEnsamblet']);
        $OrdenProduccion = mainModel::limpiarCadena($_POST['OrdenProduccion']);
        $nombreTaller = mainModel::limpiarCadena($_POST['nombreTaller']);
        $productos = isset($_POST['datosTablaProductos']) ? json_decode($_POST['datosTablaProductos'], true) : [];
        $prendas = isset($_POST['datosTablaPrendas']) ? json_decode($_POST['datosTablaPrendas'], true) : [];

        $consultaUsuario = "SELECT cedula FROM usuario WHERE nombre_usuario = :nombreTaller AND permiso = 'Taller'";
        $conexion = mainModel::conectarBD();
        $stmt = $conexion->prepare($consultaUsuario);
        $stmt->bindParam(':nombreTaller', $nombreTaller);
        $stmt->execute();
        $filaUsuario = $stmt->fetch();

        if (!$filaUsuario) {
            // Manejar el caso en que no se encuentre ningún usuario asociado al taller
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "No se encontró ningún usuario asociado al taller.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $idTaller = $filaUsuario['cedula'];

        if (empty($productos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "No se han proporcionado datos de productos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (empty($prendas)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "No se han proporcionado datos de prendas.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $checkId = mainModel::consultaSimple("SELECT id_ensamble FROM ensamble_taller WHERE id_ensamble = '$OrdenProduccion' AND id_taller = '$idTaller'");
        if ($checkId->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Ya existe un ensamble registrado con el mismo código.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        foreach ($productos as $producto) {
            $idProducto = $producto['Id'];
            $cantidadProducto = $producto['Cantidad'];

            // Verificar si la cantidad ingresada por el usuario es menor que la cantidad actual del producto en la tabla producto_ensamble
            $consultaCantidadProducto = "SELECT cantidad FROM producto_ensamble WHERE producto_id = :idProducto AND ensamble_id = :OrdenProduccion";
            $stmtCantidadProducto = $conexion->prepare($consultaCantidadProducto);
            $stmtCantidadProducto->bindParam(':idProducto', $idProducto);
            $stmtCantidadProducto->bindParam(':OrdenProduccion', $OrdenProduccion);
            $stmtCantidadProducto->execute();
            $filaCantidadProducto = $stmtCantidadProducto->fetch();

            if ($cantidadProducto < 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error",
                    "Texto" => "La cantidad del producto $idProducto debe ser un valor entre 0 y la cantidad actual en el ensamble.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if ($cantidadProducto > $filaCantidadProducto['cantidad']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error",
                    "Texto" => "La cantidad del producto $idProducto no puede ser mayor que la cantidad total actual del producto en el ensamble.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        foreach ($prendas as $prenda) {
            $idPrenda = $prenda['Id'];
            $cantidadPrenda = $prenda['Cantidad'];

            // Verificar si la cantidad ingresada por el usuario es menor que la cantidad actual del producto en la tabla producto_ensamble
            $consultaCantidadPrenda = "SELECT Cantidad FROM prendascortadas WHERE id = :idPrenda";
            $stmtCantidadPrenda = $conexion->prepare($consultaCantidadPrenda);
            $stmtCantidadPrenda->bindParam(':idPrenda', $idPrenda);
            $stmtCantidadPrenda->execute();
            $filaCantidadPrenda = $stmtCantidadPrenda->fetch();

            if ($cantidadPrenda < 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error",
                    "Texto" => "La cantidad del producto $idPrenda debe ser un valor entre 0 y la cantidad actual en el ensamble.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if ($cantidadPrenda > $filaCantidadPrenda['Cantidad']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error",
                    "Texto" => "La cantidad de la prenda $idPrenda no puede ser mayor que la cantidad total actual de la prenda.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        $actualizacionExitosa = true; // Variable para controlar si todas las actualizaciones son exitosas

        foreach ($productos as $producto) {
            $idProducto = $producto['Id'];
            $cantidadProducto = $producto['Cantidad'];

            // Verificar si la cantidad es cero
            if ($cantidadProducto == 0) {
                continue; // Saltar esta iteración del bucle y pasar a la siguiente
            }


            // Actualizar la cantidad total del producto en ensamble
            if (!talleresModelo::actualizarCantidadTotalProducto($idProducto, $cantidadProducto, $OrdenProduccion)) {
                $actualizacionExitosa = false;
                $mensajeError = "No se pudo actualizar la cantidad total del producto $idProducto.";
                break; // Salir del bucle en caso de error
            }
        }

        if ($actualizacionExitosa) {
            foreach ($prendas as $prenda) {
                $idPrenda = $prenda['Id'];
                $cantidadPrenda = $prenda['Cantidad'];

                // Verificar si la cantidad es cero
                if ($cantidadPrenda == 0) {
                    continue; // Saltar esta iteración del bucle y pasar a la siguiente
                }

                // Actualizar la cantidad total del producto en ensamble
                if (!talleresModelo::actualizarCantidadTotalPrenda($idPrenda, $cantidadPrenda)) {
                    $actualizacionExitosa = false;
                    $mensajeError = "No se pudo actualizar la cantidad total del prenda $idPrenda.";
                    break; // Salir del bucle en caso de error
                }
            }
        }

        if (!$actualizacionExitosa) {
            // Al menos una actualización falló, mostrar alerta
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => $mensajeError,
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datosAgregarEnsamble = [
            "id" => $idensamblet,
            "id_ensamble" => $OrdenProduccion,
            "id_taller" => $idTaller
        ];

        $agregarEnsamble = talleresModelo::agregarEnsambleModelo($datosAgregarEnsamble);

        if ($agregarEnsamble->rowCount() == 1) {
            foreach ($productos as $producto) {
                $datosProducto = [
                    "id_producto" => $producto['Id'],
                    "id_ensamble" => $OrdenProduccion,
                    "cantidadProducto" => $producto['Cantidad'],
                    "id_ensamblet" => $idensamblet
                ];
                talleresModelo::agregarProductosModelo($datosProducto);
            }

            foreach ($prendas as $prenda) {
                $datosPrendas = [
                    "id_prenda" => $prenda['Id'],
                    "id_ensamble" => $OrdenProduccion,
                    "cantidadPrenda" => $prenda['Cantidad'],
                    "id_ensamblet" => $idensamblet
                ];
                talleresModelo::agregarPrendasModelo($datosPrendas);
            }

            $alerta = [
                "Alerta" => "redireccionarUser",
                "Titulo" => "Ensamble registrado",
                "Texto" => "Se ha completado el registro del ensamble.",
                "Tipo" => "success",
                "Url" => SERVERURL . "ensambleTaller/taller?variable=" . $nombreTaller
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar el ensamble.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    }
}