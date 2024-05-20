<?php
if ($peticionAjax) {
  require_once "../modelos/trabajadoresModelo.php";
} else {
  require_once "./modelos/trabajadoresModelo.php";
}

class trabajadorControlador extends trabajadoresModelo
{
    //Inicio del controlador
    public function agregarTrabajadorControlador()
    {
      //Controlador para agregar usuario
      $cedula = mainModel::limpiarCadena($_POST['cedula']);
      $trabajador = mainModel::limpiarCadena($_POST['nombreTrabajador']);
      $telefono = mainModel::limpiarCadena($_POST['telefono']);
      
      //Verificar si hay campos vacios
      if ($cedula == "" || $trabajador == "" || $telefono == "" ) {
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
      $checkCc = mainModel::consultaSimple("SELECT cedula FROM trabajadores WHERE cedula = '$cedula'");
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
  
  
  
  
  
      $datosAgregarTrabajador = [
        "cedula" => $cedula,
        "nombreTrabajador" => $trabajador, 
        "estado" => "si",
        "telefono" => $telefono 
        
      ];
  
      $agregarTrabajador = trabajadoresModelo::agregarTrabajadorModelo($datosAgregarTrabajador);
  
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
  public function enlistarTrabajadorControlador()
  {
    $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM trabajadores ORDER BY cedula ASC";
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
                    <td>' . $rows['cedula'] . '</td>' .
                    '<td>' . $rows['nombre'] . '</td>' .
                    '<td>' . $rows['telefono'] . '</td>' .
                    '<td>' . ($rows['estado'] == "si" ? "Habilitado" : "Deshabilitado") . '</td>';

        //Botones
        if ($rows['cedula'] != 1) {
          $tabla .= '<td>
                            <button onclick="window.location.href = \'' . SERVERURL . 'editarTrabajador/' . mainModel::encryption($rows['cedula']) . '\';" class="estado-editar button_js btn-editar" type="button" title="Editar" name="Editar"><img src="./vistas/img/lapiz.png"></img></button>
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
  public function datosTrabajadorControlador($cedula)
  {
    $cedula = mainModel::decryption($cedula);
    $cedula = mainModel::limpiarCadena($cedula);

    return trabajadoresModelo::datosTrabajadorModelo($cedula);
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
    if ($cedulaNueva == "" || $trabajador == "" || $telefono == "" ) {
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

    $actualizarTrabajador = trabajadoresModelo::actualizarTrabajadorModelo($datosActualizarTrabajador);

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


  public function cantidadTrabajadoresControlador()
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadTrabajadores = trabajadoresModelo::cantidadTrabajadoresModelo();

        // Devuelve la cantidad de registros
        return $cantidadTrabajadores;
        
    }
}
