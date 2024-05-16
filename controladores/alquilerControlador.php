<?php
if ($peticionAjax) {
    require_once "../modelos/alquilerModelo.php";
} else {
    require_once "./modelos/alquilerModelo.php";
}

class alquilerControlador extends alquilerModelo
{
    //Inicio del controlador
    public function agregaralquilerControlador()
    {
        //Controlador para agregar usuario
        $numeroalquiler = mainModel::limpiarCadena($_POST['numeroAlquiler']);
        $fechaentrega = mainModel::limpiarCadena($_POST['fechaEntrega']);
        $fechadevolucion = mainModel::limpiarCadena($_POST['fechaDevolucion']);
        $tiempodias = mainModel::limpiarCadena($_POST['tiempoAlquiler']);
        $id = mainModel::limpiarCadena($_POST['idProducto']);
        $nombrecliente = mainModel::limpiarCadena($_POST['nombreCliente']);
        $cedulacliente = mainModel::limpiarCadena($_POST['cedulaCliente']);
        $fotocopiacedula = isset($_FILES['fotocopiaC']) ? $_FILES['fotocopiaC'] : null;
        $fotocopiarecibo = isset($_FILES['fotocopiaR']) ? $_FILES['fotocopiaR'] : null;
        $direccion = mainModel::limpiarCadena($_POST['Direccion']);
        $telefono = mainModel::limpiarCadena($_POST['Telefono']);
        $nombreref1 = mainModel::limpiarCadena($_POST['nombreReferencia1']);
        $nombreref2 = mainModel::limpiarCadena($_POST['nombreReferencia2']);
        $telefonoref1 = mainModel::limpiarCadena($_POST['telefonoReferencia1']);
        $telefonoref2 = mainModel::limpiarCadena($_POST['telefonoReferencia2']);
        $contratopagare = isset($_FILES['Contrato']) ? $_FILES['Contrato'] : null;
        $totalpagar = mainModel::limpiarCadena($_POST['totalPagar']);


        //Verificar si hay campos vacios
        if (
            $numeroalquiler == "" || $fechaentrega == "" || $fechadevolucion == "" || $tiempodias == "" || $nombrecliente == "" || $cedulacliente == ""
            || $fotocopiacedula == "" || $fotocopiarecibo == "" || $telefono == "" || $direccion == "" || $nombreref1 == "" || $nombreref2 == "" || $telefonoref1 == ""
            || $telefonoref2 == "" || $contratopagare == "" || $totalpagar == "" || $id == ""
        ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos para el registro de un nuevo trabajador.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Verificar formatos de los datos del usuario


        //Comprobar que no hay un usuario con la misma CC
        $checkCc = mainModel::consultaSimple("SELECT numeroalquiler FROM alquiler WHERE numeroalquiler = '$numeroalquiler'");
        if ($checkCc->rowCount() > 0) {
            $alerta = array(
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Ya existe un trabajador registrado con el número de cédula que quieres usar para el registro de este nuevo trabajador.",
                "Tipo" => "error"
            );
            echo json_encode($alerta);
            exit();
        }

        // Procesar la imagen
        $identificadorCedula = uniqid();
        $nombreArchivo1 = $fotocopiacedula['name'];
        $rutaArchivo1 = $fotocopiacedula['tmp_name'];

        $directorioArchivosC = "../src/alquiler/cedula";
        $ruta1 = $directorioArchivosC . '/' . $identificadorCedula . "-" . $nombreArchivo1;

        // Mover la imagen al directorio de destino
        if (!move_uploaded_file($rutaArchivo1, $ruta1)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Hubo un problema al cargar la imagen del producto.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $identificadorRecibo = uniqid();
        $nombreArchivo2 = $fotocopiarecibo['name'];
        $rutaArchivo2 = $fotocopiarecibo['tmp_name'];

        $directorioArchivosR = "../src/alquiler/recibo";
        $ruta2 = $directorioArchivosR . '/' . $identificadorRecibo . "-" . $nombreArchivo2;

        // Mover la imagen al directorio de destino
        if (!move_uploaded_file($rutaArchivo2, $ruta2)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Hubo un problema al cargar la imagen del producto.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $identificadorCon = uniqid();
        $nombreArchivo3 = $contratopagare['name'];
        $rutaArchivo3 = $contratopagare['tmp_name'];

        $directorioArchivosCon = "../src/alquiler/contrato";
        $ruta3 = $directorioArchivosCon . '/' . $identificadorCon . "-" . $nombreArchivo3;

        // Mover la imagen al directorio de destino
        if (!move_uploaded_file($rutaArchivo3, $ruta3)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Hubo un problema al cargar la imagen del producto.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        $datosAgregarAlquiler = [
            "numeroAlquiler" => $numeroalquiler,
            "fechaentrega" => $fechaentrega,
            "fechadevolucion" => $fechadevolucion,
            "tiempodias" => $tiempodias,
            "id" => $id,
            "nombrecliente" => $nombrecliente,
            "cedulacliente" => $cedulacliente,
            "fotocopiacedula" => $identificadorCedula . "-" . $nombreArchivo1,
            "fotocopiarecibo" => $identificadorRecibo . "-" . $nombreArchivo2,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "nombreref1" => $nombreref1,     
            "telefonoref1" => $telefonoref1,
            "nombreref2" => $nombreref2,
            "telefonoref2" => $telefonoref2,
            "contratopagare" => $identificadorCon . "-" . $nombreArchivo3,
            "totalpagar" => $totalpagar,


        ];

        $agregarTrabajador = alquilerModelo::agregarAlquilerModelo($datosAgregarAlquiler);

        if ($agregarTrabajador->rowCount() == 1) {
            $alerta = array(
                "Alerta" => "redireccionarUser",
                "Titulo" => "Trabajador registrado",
                "Texto" => "Se ha completado el registro del trabajador.",
                "Tipo" => "success",
                "Url" => SERVERURL . "alquilerProductos"
            );
            echo json_encode($alerta);
            exit();
        } else {
            $alerta = array(
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar el usuario",
                "Tipo" => "error"
            );
            echo json_encode($alerta);
            exit();
        }
    }

    //Fin del controlador

//Inicio del controlador
public function enlistaralquilerControlador()
{
    // Consulta SQL para obtener los datos de la tabla alquiler
    $consulta = "SELECT a.numeroalquiler, a.nombrecliente, ap.id AS id, ap.nombreproducto AS nombre_producto, a.fechaentrega, a.fechadevolucion 
    FROM alquiler a
    JOIN alquilerproductos ap ON a.id = ap.id
    ORDER BY a.numeroalquiler ASC";
    
    // Conexión a la base de datos
    $conexion = mainModel::conectarBD();
    
    // Ejecutar la consulta y obtener los datos
    $datos = $conexion->query($consulta);
    $datos = $datos->fetchAll();
    
    // Contar el total de filas encontradas
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    
    // Inicializar variable para construir la tabla HTML
    $tabla = '';

    // Comprobar si se encontraron filas
    if ($total >= 1) {
        $contador = 1; // Inicializar contador de filas
        // Iterar sobre los datos obtenidos
        foreach ($datos as $rows) {
            // Calcular el tiempo restante en días
            $fechaDevolucion = new DateTime($rows['fechadevolucion']);
            $fechaActual = new DateTime();
            $diferencia = $fechaDevolucion->diff($fechaActual);
            $tiempoRestante = $diferencia->days + 1;
            // Filas de la tabla HTML
            $tabla .= '<tr>
                            <td>' . $contador . '</td>
                            <td>' . $rows['numeroalquiler'] . '</td>' .
                            '<td>' . $rows['nombrecliente'] . '</td>' .
                            '<td>' . $rows['id'] . '</td>' .
                            '<td>' . $rows['nombre_producto'] . '</td>' .
                            '<td>' . $rows['fechaentrega'] . '</td>' .
                            '<td>' . $rows['fechadevolucion'] . '</td>' .
                            '<td>' . $tiempoRestante +1 .'</td>';
            // Botones (si es necesario)
            if ($rows['id'] != 0) {
                $tabla .= '<td>
                              <button onclick="window.location.href = \'' . SERVERURL . 'visualizarAlquiler/' . mainModel::encryption($rows['numeroalquiler']) . '\';" class="estado-editar button_js btn-editar" type="button" title="Editar" name="Editar"><img src="./vistas/img/detalles.png"></img></button>
                          </td>';
            }
            $tabla .= '</tr>';
            $contador++; // Incrementar contador de filas
        }
    } else {
        // Mensaje si no se encontraron registros
        $tabla .= '<tr><td colspan="6">No hay registros en el sistema</td></tr>';
    }

    // Cerrar la tabla HTML
    $tabla .= '</tbody>
                </table>';

    // Devolver la tabla HTML generada
    return $tabla;
} //Fin del controlador



    //Inicio del controlador
    public function datosalquilerControlador($numeroalquiler)
    {
        $numeroalquiler = mainModel::decryption($numeroalquiler);
        $numeroalquiler = mainModel::limpiarCadena($numeroalquiler);

        return alquilerModelo::datosalquilerModelo($numeroalquiler);
    } //Fin del controlador

    //Inicio del controlador
    public function actualizarTrabajadorControlador()
    {
        //Recibiendo Identificador unico
        $cedula = mainModel::decryption($_POST['trabajadorUpdate']);
        $cedula = mainModel::limpiarCadena($cedula);

        //Comprobar existencia del usuario
        $checKCedula = mainModel::consultaSimple("SELECT * FROM trabajadores WHERE cedula = $cedula");

        if ($checKCedula->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "EL usuario que intentas editar no se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $checKCedula->fetch();
        }

        //Obtener valores del form
        $cedulaNueva = mainModel::limpiarCadena($_POST['cedulaUp']);
        $trabajador = mainModel::limpiarCadena($_POST['trabajadorUp']);
        $telefono = mainModel::limpiarCadena($_POST['telefonoUp']);
        $estado = mainModel::limpiarCadena($_POST['estado']);

        //Comprobar si han habido cambios
        if ($cedulaNueva == $datos['cedula'] && $trabajador == $datos['nombre'] && $telefono == $datos['telefono'] && $estado == $datos['estado']) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Atención",
                "Texto" => "No has realizado ningún cambio en la información del trabajador.",
                "Tipo" => "warning"
            ];
            echo json_encode($alerta);
            exit();

        }

        //Comprobar campos vacios
        if ($cedulaNueva == "" || $trabajador == "" || $telefono == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos para la actualización de datos del trabajador.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }





        //Comprobar estado
        switch ($estado) {
            case "si":
            case "no":
                break;
            default:
                $alerta = array(
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => 'La opción del campo "Estado" no es válida.',
                    "Tipo" => "error"
                );
                echo json_encode($alerta);
                exit();
        }

        //Array de datos para la actualizacion de datos
        $datosActualizarTrabajador = [
            "Cedula" => $cedulaNueva,
            "Trabajador" => $trabajador,
            "Telefono" => $telefono,
            "Estado" => $estado,
            "CedulaOld" => $datos['cedula']
        ];

        $actualizarTrabajador = alquilerModelo::actualizarAlquilerModelo($datosActualizarTrabajador);

        if ($actualizarTrabajador->rowCount() == 1) {
            $alerta = array(
                "Alerta" => "redireccionarUser",
                "Titulo" => "Usuario actualizado",
                "Texto" => "Se ha completado la actualizacion de datos del usuario.",
                "Tipo" => "success",
                "Url" => SERVERURL . "trabajadores"
            );
            echo json_encode($alerta);
            exit();
        } else {
            $alerta = array(
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido completar la actualización de los datos del usuario.",
                "Tipo" => "error"
            );
            echo json_encode($alerta);
            exit();
        }
    } //Fin del controlador
}
