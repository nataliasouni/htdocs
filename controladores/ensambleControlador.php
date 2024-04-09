<?php
if (isset($peticionAjax) && $peticionAjax == false) {
    require_once "./modelos/ensambleModelo.php";
} else {
    require_once "../modelos/ensambleModelo.php";
}

class ensambleControlador extends ensambleModelo
{
    //Inicio del controlador
    public function agregarEnsambleControlador()
    {
        // Obtener datos del ensamble principal
        $OrdenProduccion = mainModel::limpiarCadena($_POST['OrdenProduccion']);
        $CantidadProduccion = mainModel::limpiarCadena($_POST['CantidadProduccion']);

        // Obtener datos de los productos
        $productos = isset($_POST['datosTabla']) ? json_decode($_POST['datosTabla'], true) : [];

        // Verificar que se hayan proporcionado datos de productos
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

        // Iterar sobre los productos asociados al ensamble
        foreach ($productos as $producto) {
            $idProducto = $producto['Id'];
            $cantidadProducto = $producto['cantidad'];
            $estadoProducto = $producto['Pendiente'];

            // Actualizar la cantidad total del producto en la tabla productose
            if ($estadoProducto == 'No') {
                $actualizacionExitosa = ensambleModelo::actualizarCantidadTotalProducto($idProducto, $cantidadProducto);


                // Verificar si ocurrió algún error durante la actualización
                if (!$actualizacionExitosa) {
                    // Manejar el error
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Error",
                        "Texto" => "No se pudo actualizar la cantidad total del producto $idProducto.",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
        }


        foreach ($productos as $producto) {
            $idProducto = $producto['Id'];
            $cantidadProducto = $producto['cantidad'];

            // Verificar si la cantidad del producto es menor o igual a 0
            if ($cantidadProducto <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error",
                    "Texto" => "La cantidad del producto $idProducto no puede ser menor o igual a 0.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        // Verificar si hay campos vacíos
        if ($OrdenProduccion == "" || $CantidadProduccion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos para el registro de un nuevo ensamble.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobar que no hay un ensamble con el mismo ID
        $checkId = mainModel::consultaSimple("SELECT OrdenProdccion FROM ensamble WHERE OrdenProdccion = '$OrdenProduccion'");
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

        // Verificar que la cantidad sea mayor que 0
        if ($CantidadProduccion < 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error en la cantidad",
                "Texto" => "La cantidad no puede ser menor que 0.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Datos para agregar el ensamble principal
        $datosAgregarEnsamble = [
            "OrdenProdccion" => $OrdenProduccion,
            "CantidadProduccion" => $CantidadProduccion,
            "Estado" => "Si"
        ];

        // Agregar el ensamble principal al modelo
        $agregarEnsamble = ensambleModelo::agregarEnsambleModelo($datosAgregarEnsamble);

        // Verificar si el ensamble principal se agregó correctamente
        if ($agregarEnsamble->rowCount() == 1) {
            // Agregar los productos asociados al ensamble
            foreach ($productos as $producto) {
                $datosProducto = [
                    "ensamble_id" => $OrdenProduccion,
                    "producto_id" => $producto['Id'],
                    "cantidad" => $producto['cantidad'],
                    "Pendiente" => $producto['Pendiente'] // Aquí se usa 'Pendiente' en lugar de 'Pendiente'
                ];
                ensambleModelo::agregarProductosModelo($datosProducto);
            }

            $alerta = [
                "Alerta" => "redireccionarUser",
                "Titulo" => "Ensamble registrado",
                "Texto" => "Se ha completado el registro del ensamble.",
                "Tipo" => "success",
                "Url" => SERVERURL . "ensambleM"
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
    } //Fin del controlador 

    public function enlistarProductoControlador()
    {
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM productose ORDER BY Id ASC";
        $conexion = mainModel::conectarBD();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $tabla = '';

        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $rows) {
                //Filas
                $tabla .= '<tr>
                    <td name="Id">' . $rows['Id'] . '</td>' .
                    '<td name="Nombre">' . $rows['Nombre'] . '</td>' .
                    '<td><input type="number" name="cantidad[]" class="cantidad" required></td>' .
                    '<td>
                    <select class="pendiente" name="Pendiente[]">
                    <option value="Si") {
                        echo "selected";
                    } ?>Esta pendiente</option>
                    <option value="No") {
                        echo "selected";
                    } ?>No esta Pendiente</option>
                    </select>
                </td>';
                $tabla .= '</tr>';
                $contador++;
            }
        } else {
            $tabla .= '<tr><td colspan="10">No hay registros en el sistema</td></tr>';
        }

        return $tabla; // Devolver la tabla construida
    }

    public function datosProductoControlador($id)
    {
        $id = mainModel::decryption($id);
        $id = mainModel::limpiarCadena($id);

        return ensambleModelo::datosProductoModelo($id);
    } //Fin del controlador

    public function datosEnsambleControlador($id)
    {
        $id = mainModel::decryption($id);
        $id = mainModel::limpiarCadena($id);

        return ensambleModelo::datosEnsamblePModelo($id);
    } //Fin del controlador

    public function enlistarEnsambleControlador()
    {
        $consulta = "SELECT p.id, p.ensamble_id, GROUP_CONCAT(e.Nombre SEPARATOR '<br>') as nombre_productos, SUM(p.cantidad) as total_cantidad, en.CantidadProduccion as cantidad_produccion, en.Estado as Estado
                     FROM producto_ensamble p
                     INNER JOIN productose e ON p.producto_id = e.Id
                     INNER JOIN ensamble en ON p.ensamble_id = en.OrdenProdccion
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
                $tabla .= '<td>' . $rows['id'] . '</td>';
                // Imprimir el ID del ensamble en la primera columna
                $tabla .= '<td>' . $rows['ensamble_id'] . '</td>';
                // Imprimir el nombre de los productos en una sola celda
                $tabla .= '<td>' . $rows['cantidad_produccion'] . '</td>';
                // Imprimir la cantidad de producción en la siguiente columna
                $tabla .= '<td>' . $estadoProducto . '</td>';
                // Imprimir la cantidad de producción en la siguiente columna
                $tabla .= '<td>' . $rows['nombre_productos'] . '</td>';
                // Imprimir la suma total de la cantidad de productos en la última columna
                $tabla .= '<td>' . $rows['total_cantidad'] . '</td>';
                // Cerrar la fila actual
                $tabla .= '<td>
                <button onclick="window.location.href = \'' . SERVERURL . 'editarEnsamble/' .
                    mainModel::encryption($rows['id']) . '\';" class="estado-editar button_js btn-editar" 
                type="button" title="Editar" name="Editar"> 
                <img src="./vistas/img/editar.png"></img>
                </button>
                <button onclick="window.location.href = \'' . SERVERURL . 'detallesEnsamble/' .
                    mainModel::encryption($rows['id']) . '\';" class="estado-detalles button_js btn-detalles" 
                type="button" title="detalles" name="detalles"> 
                <img src="./vistas/img/detalles.png"></img>
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

    public function obtenerProductosEnsambleControlador($idEnsamble)
    {
        $productosEnsamble = ensambleModelo::obtenerProductosEnsambleModelo($idEnsamble);
        return $productosEnsamble;
    }

    public function actualizarEnsambleControlador()
    {
        // Recibir el ID del producto_ensamble a actualizar
        if (!isset($_POST['idEnsambleUp'])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "No se proporcionó el ID del ensamble a actualizar.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $id = mainModel::decryption($_POST['idEnsambleUp']);
        $id = mainModel::limpiarCadena($id);

        // Obtener los datos del formulario del ensamble (sin actualizarlos)
        if (!isset($_POST['OrdenProduccionUp']) || !isset($_POST['CantidadPUp']) || !isset($_POST['EstadoUp'])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "Se deben proporcionar todos los campos del ensamble.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $OrdenProduccion = mainModel::limpiarCadena($_POST['OrdenProduccionUp']);
        $CantidadProduccion = mainModel::limpiarCadena($_POST['CantidadPUp']);
        $Estado = mainModel::limpiarCadena($_POST['EstadoUp']);

        // Verificar si se han realizado cambios en el ensamble
        $datosEnsambleActual = mainModel::consultaSimple("SELECT * FROM ensamble WHERE OrdenProdccion = $OrdenProduccion");
        $datosEnsambleNuevo = [
            "OrdenProdccion" => $OrdenProduccion,
            "CantidadProduccion" => $CantidadProduccion,
            "Estado" => $Estado,
            "OrdenProduccionUp" => $OrdenProduccion
        ];

        if ($datosEnsambleActual->rowCount() == 1) {
            $datosEnsambleActual = $datosEnsambleActual->fetch(PDO::FETCH_ASSOC);

            if ($datosEnsambleActual['CantidadProduccion'] == $CantidadProduccion && $datosEnsambleActual['Estado'] == $Estado) {

                // Verificar si se han realizado cambios en los productos asociados al ensamble
                $productosActualizados = false; // Inicializamos la variable a false
                $numeroProductos = count($_POST['IdProducto']);
                foreach ($_POST['IdProducto'] as $key => $idProducto) {
                    $productoActual = mainModel::consultaSimple("SELECT * FROM producto_ensamble WHERE ensamble_id = $OrdenProduccion AND producto_id = $idProducto");
                    $productoNuevo = [
                        "ensamble_id" => $OrdenProduccion,
                        "producto_id" => $idProducto,
                        "cantidad" => $_POST['CantidadUp'][$key],
                        "Pendiente" => $_POST['PendienteUp'][$key],
                        "idEnsambleUp" => $id
                    ];

                    if ($productoActual->rowCount() == 1) {
                        $productoActual = $productoActual->fetch(PDO::FETCH_ASSOC);

                        // Verificar si la cantidad nueva es diferente de la cantidad actual en la base de datos
                        if ($productoActual['cantidad'] != $productoNuevo['cantidad'] || $productoActual['Pendiente'] != $productoNuevo['Pendiente']) {
                            $productosActualizados = true; // Si hay un cambio, actualizamos la variable a true
                            break; // Salimos del bucle, ya que se detectó un cambio
                        }
                    } else {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Advertencia",
                            "Texto" => "El producto con ID $idProducto no se encuentra en la base de datos.",
                            "Tipo" => "warning"
                        ];
                        echo json_encode($alerta);
                        exit(); // Terminamos la ejecución ya que encontramos un problema
                    }
                }

                if (!$productosActualizados) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Advertencia",
                        "Texto" => "No se realizaron cambios en el ensamble ni en los productos asociados.",
                        "Tipo" => "warning"
                    ];
                    echo json_encode($alerta);
                    exit();
                }

            }
        }


        // Validar que las cantidades no sean menores que 0
        if ($CantidadProduccion < 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "La cantidad de producción no puede ser menor que 0.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Actualizar el ensamble
        $datosEnsamble = [
            "OrdenProdccion" => $OrdenProduccion,
            "CantidadProduccion" => $CantidadProduccion,
            "Estado" => $Estado,
            "OrdenProduccionUp" => $OrdenProduccion
        ];

        $actualizarEnsamble = ensambleModelo::actualizarEnsamble($datosEnsamble);

        if (!$actualizarEnsamble) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error",
                "Texto" => "Hubo un problema al actualizar el ensamble.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Iterar sobre los productos asociados al ensamble y actualizarlos
        foreach ($_POST['IdProducto'] as $key => $idProducto) {
            $producto = [
                "ensamble_id" => $OrdenProduccion,
                "producto_id" => $idProducto,
                "cantidad" => $_POST['CantidadUp'][$key],
                "Pendiente" => $_POST['PendienteUp'][$key],
                "idEnsambleUp" => $id
            ];

            // Inicializar la variable $cantidadAnterior
            $cantidadAnterior = null;

            // Realizar la consulta para obtener la cantidad anterior del producto
            $consultaProducto = mainModel::consultaSimple("SELECT * FROM producto_ensamble WHERE ensamble_id = $OrdenProduccion AND producto_id = $idProducto");

            // Verificar si la consulta fue exitosa y si devuelve al menos una fila
            if ($consultaProducto !== false && $consultaProducto->rowCount() > 0) {
                // Obtener la cantidad anterior del producto
                $resultado = $consultaProducto->fetch(PDO::FETCH_ASSOC);
                $cantidadAnterior = $resultado['cantidad'];
                $pendienteAnterior = $resultado['Pendiente'];
                // Continuar con el resto del código
            }

            $pendienteNuevo = $_POST['PendienteUp'][$key];

            if ($pendienteAnterior == 'No') {
                if ($cantidadAnterior !== null) {
                    $cambioCantidad = $_POST['CantidadUp'][$key] - $cantidadAnterior;
                    if ($cambioCantidad > 0) {
                        $actualizarCantidadTotal = mainModel::consultaSimple("UPDATE productose SET cantidadTotal = cantidadTotal + $cambioCantidad WHERE id = $idProducto");
                    } elseif ($cambioCantidad < 0) {
                        $actualizarCantidadTotal = mainModel::consultaSimple("UPDATE productose SET cantidadTotal = cantidadTotal - " . abs($cambioCantidad) . " WHERE id = $idProducto");
                    }
                }
            }

            if ($pendienteAnterior == 'Si' && $pendienteNuevo == 'No') {
                $actualizacionExitosa = ensambleModelo::actualizarCantidadTotalProducto($idProducto, $cantidadAnterior);
            }


            // Actualizar la cantidad del producto del ensamble
            $actualizarProducto = ensambleModelo::actualizarProductoEnsamble($producto);

            // Verificar si hubo algún error en la actualización del producto
            if (!$actualizarProducto) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error",
                    "Texto" => "Hubo un problema al actualizar el producto.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        // Si se llega aquí, significa que la actualización de los productos fue exitosa
        $alerta = [
            "Alerta" => "redireccionarUser",
            "Titulo" => "Éxito",
            "Texto" => "Se ha actualizado el ensamble correctamente.",
            "Tipo" => "success",
            "Url" => SERVERURL . "ensambleM"
        ];
        echo json_encode($alerta);
        exit();
    }


}
