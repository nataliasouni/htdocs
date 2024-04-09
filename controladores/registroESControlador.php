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
        $horasTrabajadas= mainModel::limpiarCadena($_POST['horasTrabajadas']);


        //Verificar si hay campos vacios
        if ($cedula == "" || $fecha == "" || $horaEntrada == "" || $horaSalida == "" || $horasTrabajadas == "" ) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No has llenado todos los campos para el registro de un nuevo usuario.",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
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
            GROUP BY r.id ASC";
    
        $conexion = mainModel::conectarBD();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int)$total->fetchColumn();
        $tabla = '';
    
        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $rows) {
                //Filas
                $tabla .= '<tr>
                            <td>' . $contador . '</td>
                            <td>' . $rows['id'] . '</td>
                            <td>' . $rows['cedula'] . '</td>' .
                            '<td>' . $rows['nombre'] . '</td>' .
                            '<td>' . $rows['fecha'] . '</td>' .
                            '<td>' . $rows['horaEntrada'] . '</td>' .
                            '<td>' . $rows['horaSalida'] . '</td>' . 
                            '<td>' . $rows['horasTrabajadas'] . '</td>' ;
    
                //Botones
                if ($rows['id'] != 1) {
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
        $horasTrabajadas = mainModel::limpiarCadena($_POST['horasTrabajadasUp']);


        //Comprobar si han habido cambios
        if ($cedulaNueva == $datos['cedula'] && $fecha == $datos['fecha'] && $horaEntrada == $datos['horaEntrada'] && $horaSalida == $datos['horaSalida'] && $horasTrabajadas == $datos['horasTrabajadas'] ) {
            
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
        if ($cedulaNueva == "" || $fecha == "" || $horaEntrada == "" || $horaSalida == "" || $horasTrabajadas == "") {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No has llenado todos los campos para la actualización de datos del registro.",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
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
}
