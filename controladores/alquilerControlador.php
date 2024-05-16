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
        $fotocopiacedula = mainModel::limpiarCadena($_POST['fotocopiaCedula']);
        $fotocopiarecibo = mainModel::limpiarCadena($_POST['fotocopiaRecibo']);
        $direccion = mainModel::limpiarCadena($_POST['Direccion']);
        $telefono = mainModel::limpiarCadena($_POST['Telefono']);
        $nombreref1 = mainModel::limpiarCadena($_POST['nombreReferencia1']);
        $nombreref2 = mainModel::limpiarCadena($_POST['nombreReferencia2']);
        $telefonoref1 = mainModel::limpiarCadena($_POST['telefonoReferencia1']);
        $telefonoref2 = mainModel::limpiarCadena($_POST['telefonoReferencia2']);
        $contratopagare = mainModel::limpiarCadena($_POST['contratoPagare']);
        $totalpagar = mainModel::limpiarCadena($_POST['totalPagar']);


        //Verificar si hay campos vacios
        if ($numeroalquiler == "" || $fechaentrega == "" || $fechadevolucion == "" || $tiempodias == "" || $nombrecliente == "" || $cedulacliente == ""
        || $fotocopiacedula == "" || $fotocopiarecibo == "" || $telefono == "" || $direccion == "" || $nombreref1 == "" || $nombreref2 == "" || $telefonoref1 == ""
        || $telefonoref2 == "" || $contratopagare == "" || $totalpagar == "" || $id == "") {
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





        $datosAgregarAlquiler = [
            "numeroAlquiler" => $numeroalquiler,
            "fechaEntrega" => $fechaentrega,
            "fechaDevolucion" => $fechadevolucion,
            "tiempoAlquiler" => $tiempodias,
            "Id" => $id,
            "nombreCliente" =>  $nombrecliente,
            "cedulaCliente" => $cedulacliente,
            "fotocopiaCedula" => $fotocopiacedula ,
            "fotocopiaRecibo" => $fotocopiarecibo,
            "Direccion" => $direccion,
            "Telefono" => $telefono,
            "nombreRef1" => $nombreref1,
            "nombreRef2" =>  $nombreref2,
            "telefonoRef1" => $telefonoref1,
            "telefonoRef2" => $telefonoref2,
            "contratoPagare" => $contratopagare,
            "totalPagar" => $totalpagar,
    

        ];

        $agregarTrabajador = alquilerModelo::agregarAlquilerModelo($datosAgregarAlquiler);

        if ($agregarTrabajador->rowCount() == 1) {
            $alerta = array(
                "Alerta" => "redireccionarUser",
                "Titulo" => "Trabajador registrado",
                "Texto" => "Se ha completado el registro del trabajador.",
                "Tipo" => "success",
                "Url" => SERVERURL . "trabajadores"
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
    public function enlistaralquilerproductosControlador()
    {
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM alquilerproductos ORDER BY id ASC";
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
                    <td>' . $contador . '</td>
                    <td>' . $rows['nombreproducto'] . '</td>' .
                    '<td>' . $rows['detalles'] . '</td>' .
                    '<td>' . $rows['cantidad'] . '</td>' .
                    '<td>' . $rows['alquiler15dias'] . '</td>' .
                    '<td>' . $rows['alquiler30dias'] . '</td>' .
                    '<td>' . $rows['deposito'] . '</td>';

                //Botones
                //Botones
                if ($rows['id'] != 0) {
                    $tabla .= '<td>
                          <button onclick="window.location.href = \'' . SERVERURL . 'editarTrabajador/' . mainModel::encryption($rows['id']) . '\';" class="estado-editar button_js btn-editar" type="button" title="Editar" name="Editar"><img src="./vistas/img/lapiz.png"></img></button>
                          <button onclick="window.location.href = \'' . SERVERURL . 'agregarAlquiler/' . mainModel::encryption($rows['id']) . '\';" class="estado-editar button_js btn-editar" type="button" title="Editar" name="Editar"><img src="./vistas/img/contrato.png"></img></button>
                      </td>';
                }

                $tabla .= '
                    </tr>';
                $contador++;
            }
        } else {
            $tabla .= '<tr><td colspan="10">No hay registros en el sistema</td></tr>';
        }

        $tabla .= '</tbody>
            </table>';

        return $tabla;
    } //Fin del controlador




    //Inicio del controlador
    public function datosalquilerproductoControlador($id)
    {
        $id = mainModel::decryption($id);
        $id = mainModel::limpiarCadena($id);

        return alquilerModelo::datosalquilerproductoModelo($id);
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
