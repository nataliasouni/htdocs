<?php
if ($peticionAjax) {
    require_once "../modelos/registroESModelo.php";
} else {
    require_once "./modelos/registroESModelo.php";
}

class registroESControlador extends registroESModelo
{
    //Inicio del controlador
    public function agregarRegistroESControlador()
    {
        //Controlador para agregar usuario
        $cedula = mainModel::limpiarCadena($_POST['cedulaA']);
        $fecha = mainModel::limpiarCadena($_POST['fecha']);
        $horaEntrada = mainModel::limpiarCadena($_POST['horaEntrada']);
        $horaSalida = mainModel::limpiarCadena($_POST['horaSalida']);
        $horasTrabajadas = 0;

        // Calcular horas trabajadas en segundos
        $horaEntradaUnix = strtotime($horaEntrada);
        $horaSalidaUnix = strtotime($horaSalida);
        $segundosTrabajados = $horaSalidaUnix - $horaEntradaUnix;



        //Verificar si hay campos vacios
        if ($cedula == "" || $fecha == "" || $horaEntrada == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos para el registro de un nuevo usuario.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Verificar si la hora de salida está vacía antes de realizar la comparación
        if (!empty($horaSalida)) {
            // Convertir horas a formato Unix
            $horaSalidaUnix = strtotime($horaSalida);

            // Convertir segundos a horas y redondear hacia arriba
            $horasTrabajadas = ceil($segundosTrabajados / 3600);


            //Verificar si la hora de salida es menor o igual que la hora de entrada
            if ($horaSalidaUnix <= $horaEntradaUnix) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error en las horas",
                    "Texto" => "La hora de salida debe ser mayor que la hora de entrada.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }





        $datosRegistroESModelo = [
            "cedula" => $cedula,
            "fecha" => $fecha,
            "horaEntrada" => $horaEntrada,
            "horaSalida" => $horaSalida,
            "horasTrabajadas" => $horasTrabajadas,
        ];

        $agregarRegistroES = registroESModelo::agregarRegistroESModelo($datosRegistroESModelo);


        if ($agregarRegistroES->rowCount() == 1) {
            $alerta = array(
                "Alerta" => "redireccionarUser",
                "Titulo" => "Registro Realizado",
                "Texto" => "Se ha completado el registro.",
                "Tipo" => "success",
                "Url" => SERVERURL . "registroES"
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
    } //Fin del controlador

    //Inicio del controlador
    public function enlistarRegistroESControlador()
    {
        $consulta = "
            SELECT SQL_CALC_FOUND_ROWS 
                r.id,
                t.cedula,
                t.nombre,
                r.fecha,
                r.horaEntrada,
                r.horaSalida,
                r.horasTrabajadas
            FROM trabajadores_registros AS t
            INNER JOIN registroentradasalida AS r ON t.cedula = r.cedula
            GROUP BY r.id DESC";

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
                           
                            <td>' . $rows['cedula'] . '</td>' .
                    '<td>' . $rows['nombre'] . '</td>' .
                    '<td>' . $rows['fecha'] . '</td>' .
                    '<td>' . $rows['horaEntrada'] . '</td>' .
                    '<td>' . $rows['horaSalida'] . '</td>' .
                    '<td>' . $rows['horasTrabajadas'] . '</td>';

                //Botones
                if ($rows['cedula'] != 1) {
                    $tabla .= '<td>
                                    <button onclick="window.location.href = \'' . SERVERURL . 'editarRegistro/' . mainModel::encryption($rows['id']) . '\';" class="estado-editar button_js btn-editar" type="button" title="Editar" name="Editar"><img src="./vistas/img/lapiz.png"></img></button>
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
    public function datosRegistroESControlador($id)
    {
        $id = mainModel::decryption($id);
        $id = mainModel::limpiarCadena($id);

        return registroESModelo::datosRegistroESModelo($id);
    } //Fin del controlador


    // Método para cargar los nombres y las cedulas de los trabajadores en el ComboBox
    public function cargarNombresYCedulasTrabajadores()
    {
        $registroESModelo = new registroESModelo();
        $datosTrabajadores = $registroESModelo->obtenerNombresYCedulasTrabajadoresModelo();

        foreach ($datosTrabajadores as $nombre => $cedula) {
            echo "<option value='$cedula'>$nombre </option>";
        }
    }

    //Inicio del controlador
    public function actualizarRegistroESControlador()
    {
        //Recibiendo Identificador unico

        $id = mainModel::decryption($_POST['idUpdate']);
        $id = mainModel::limpiarCadena($id);


        //Comprobar existencia del usuario
        $checKid = mainModel::consultaSimple("SELECT * FROM registroentradasalida WHERE id = $id");




        if ($checKid->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "EL usuario que intentas editar no se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $checKid->fetch();
        }

        //Obtener valores del form
        $cedulaNueva = mainModel::limpiarCadena($_POST['cedulaUp']);
        $fecha = mainModel::limpiarCadena($_POST['fechaUp']);
        $horaEntrada = mainModel::limpiarCadena($_POST['horaEntradaUp']);
        $horaSalida = mainModel::limpiarCadena($_POST['horaSalidaUp']);



        //Comprobar si han habido cambios
        if ($cedulaNueva == $datos['cedula'] && $fecha == $datos['fecha'] && $horaEntrada == $datos['horaEntrada'] && $horaSalida == $datos['horaSalida']) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Atención",
                "Texto" => "No has realizado ningún cambio en la información del registro.",
                "Tipo" => "warning"
            ];
            echo json_encode($alerta);
            exit();

        }
        //Comprobar campos vacios
        if ($cedulaNueva == "" || $fecha == "" || $horaEntrada == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos para la actualización de datos del registro.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Calcular horas trabajadas en segundos
        $horaEntradaUnix = strtotime($horaEntrada);
        $horaSalidaUnix = strtotime($horaSalida);
        $segundosTrabajados = $horaSalidaUnix - $horaEntradaUnix;


        //Verificar si la hora de salida está vacía antes de realizar la comparación
        if (!empty($horaSalida)) {
            // Convertir horas a formato Unix
            $horaSalidaUnix = strtotime($horaSalida);

            // Convertir segundos a horas y redondear hacia arriba
            $horasTrabajadas = ceil($segundosTrabajados / 3600);


            //Verificar si la hora de salida es menor o igual que la hora de entrada
            if ($horaSalidaUnix <= $horaEntradaUnix) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error en las horas",
                    "Texto" => "La hora de salida debe ser mayor que la hora de entrada.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }





        //Array de datos para la actualizacion de datos
        $datosActualizarRegistroES = [
            "id" => $datos['id'],
            "cedula" => $cedulaNueva,
            "fecha" => $fecha,
            "horaEntrada" => $horaEntrada,
            "horaSalida" => $horaSalida,
            "horasTrabajadas" => $horasTrabajadas

        ];

        $actualizarRegistroES = registroESModelo::actualizarRegistroESModelo($datosActualizarRegistroES);

        if ($actualizarRegistroES->rowCount() == 1) {
            $alerta = array(
                "Alerta" => "redireccionarUser",
                "Titulo" => "Usuario actualizado",
                "Texto" => "Se ha completado la actualizacion de datos del registro.",
                "Tipo" => "success",
                "Url" => SERVERURL . "registroES"
            );
            echo json_encode($alerta);
            exit();
        } else {
            $alerta = array(
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido completar la actualización de los datos del registro.",
                "Tipo" => "error"
            );
            echo json_encode($alerta);
            exit();
        }
    } //Fin del controlador


    public function cantidadRegistrosESControlador()
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadRegistrosES = registroESModelo::cantidadRegistrosESModelo();

        // Devuelve la cantidad de registros
        return $cantidadRegistrosES;
        
    }
}
