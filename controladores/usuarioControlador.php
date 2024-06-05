<?php
if ($peticionAjax) {
  require_once "../modelos/usuarioModelo.php";
} else {
  require_once "./modelos/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
  //Inicio del controlador
  public function agregarUsuarioControlador()
  {
    //Controlador para agregar usuario
    $cedula = mainModel::limpiarCadena($_POST['cedulaNormal']);
    $usuario = mainModel::limpiarCadena($_POST['usuario']);
    $password1 = mainModel::limpiarCadena($_POST['contrasena1']);
    $password2 = mainModel::limpiarCadena($_POST['contrasena2']);
    $telefono = mainModel::limpiarCadena($_POST['telefono']);
    $email = mainModel::limpiarCadena($_POST['email']);
    $permisos = mainModel::limpiarCadena($_POST['permisos']);

    //Verificar si hay campos vacios
    if ($cedula == "" || $usuario == "" || $password1 == "" || $password2 == "" || $permisos == "" || $telefono == "" || $email == "") {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No has llenado todos los campos para el registro de un nuevo usuario.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    //Verificar formatos de los datos del usuario
    if ($permisos == "") {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Tienes que escojer uno de los permisos para continuar con el registro de un nuevo usuario.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    } else if (mainModel::verificarDatos("[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}", $email)) {
      $alerta = array(
        "Alerta" => "html",
        "Titulo" => "La dirección de correo electrónico ingresada no coincide con el formato solicitado",
        "Texto" => "
                - Debe tener el formato nombre@dominio.com o nombre@dominio.com.co.<br>
                - El nombre del correo puede contener letras mayúsculas y minúsculas, números, puntos (.), guiones bajos (_), porcentajes (%), signos más (+) y guiones (-).<br>
                - El dominio puede contener letras mayúsculas y minúsculas, números y guiones (-).<br>
                - El dominio debe tener al menos una extensión de dos o más letras, como .com, .org, .net, etc.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }

    //Comprobar que no hay un usuario con la misma CC
    $checkCc = mainModel::consultaSimple("SELECT cedula FROM usuario WHERE cedula = '$cedula'");
    if ($checkCc->rowCount() > 0) {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Ya existe un usuario registrado con el número de cédula que quieres usar para el registro de este nuevo usuario.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }

    //Comprobar que no hay un usuario con el mismo nombre de usuario
    $checkUser = mainModel::consultaSimple("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = '$usuario'");

    if ($checkUser->rowCount() > 0) {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "El nombre de usuario no se encuentra disponible.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }

    $checkUser = mainModel::consultaSimple("SELECT telefono FROM usuario WHERE telefono = '$telefono'");

    if ($checkUser->rowCount() > 0) {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "El teléfono no se encuentra disponible.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }

    //Comprobar email
    if ($email != "") {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $checkEmail = mainModel::consultaSimple("SELECT email FROM usuario WHERE email = '$email'");

        if ($checkEmail->rowCount() > 0) {
          $alerta = array(
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "Ya existe un usuario registrado con el email que estas ingresando.",
            "Tipo" => "error"
          );
          echo json_encode($alerta);
          exit();
        }
      } else {
        $alerta = array(
          "Alerta" => "simple",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "El email ingresado no es válido.",
          "Tipo" => "error"
        );
        echo json_encode($alerta);
        exit();
      }
    }

    //Comprobar claves
    if ($password1 != $password2) {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Las contraseñas ingresadas no coinciden.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    } else {
      $clave = mainModel::encryption($password1);
    }

    //Comprobar permisos
    switch ($permisos) {
      case "Master":
      case "Administrador":
      case "Taller":
      case "Produccion":
        break;
      default:
        $alerta = array(
          "Alerta" => "simple",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => 'La opción del campo "Permisos" no es válida.',
          "Tipo" => "error"
        );
        echo json_encode($alerta);
        exit();
    }

    $datosAgregarUsuario = [
      "Cedula" => $cedula,
      "Estado" => "si",
      "NombreUsuario" => $usuario,
      "Contrasena" => $clave,
      "Permiso" => $permisos,
      "Telefono" => $telefono,
      "Email" => $email
    ];

    $agregarUsuario = usuarioModelo::agregarUsuarioModelo($datosAgregarUsuario);

    if ($agregarUsuario->rowCount() == 1) {
      $alerta = array(
        "Alerta" => "redireccionarUser",
        "Titulo" => "Usuario registrado",
        "Texto" => "Se ha completado el registro del usuario.",
        "Tipo" => "success",
        "Url" => SERVERURL . "usuarios"
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
  public function enlistarUsuarioControlador()
  {
    $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario ORDER BY cedula ASC";
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
          '<td>' . $rows['nombre_usuario'] . '</td>' .
          '<td>' . mainModel::decryption($rows['contrasena']) . '</td>' .
          '<td>' . $rows['telefono'] . '</td>' .
          '<td>' . $rows['email'] . '</td>' .
          '<td>' . $rows['permiso'] . '</td>' .
          '<td>' . ($rows['estado'] == "si" ? "Habilitada" : "Deshabilitada") . '</td>';

        //Botones
        if ($rows['cedula'] != 1) {
          $imagenEstado = ($rows['estado'] == "si") ? "habilitado.jpeg" : "deshabilitado.jpeg";

          $tabla .= '<td>

                        <button onclick="window.location.href = \'' . SERVERURL . 'editarusuario/' .
                          mainModel::encryption($rows['cedula']) . '\';" class="estado-editar button_js btn-editar" 
                        type="button" title="Editar" name="Editar"> 
                        <img src="./vistas/img/editar.png"></img>
                        </button>
                        <button onclick="window.location.href = \'' . SERVERURL . 'detallesUsuario/' .
                          mainModel::encryption($rows['cedula']) . '\';" class="estado-detalles button_js btn-detalles" 
                        type="button" title="detalles" name="detalles"> 
                        <img src="./vistas/img/detalles.png"></img>
                        </button>
                        <button class="estado-usuario button_js btn-estado-usuario">
                        <img src="./vistas/img/' . $imagenEstado . '" alt="">
                        </button>
                        
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

  //Inicio del controlador - OPCION NO HABILITADA
  public function eliminarUsuarioControlador()
  {

    //Recibiendo datos
    $cedulaDelete = mainModel::decryption($_POST['cedulaDelete']);
    $cedulaDelete = mainModel::limpiarCadena($cedulaDelete);

    //Comprobar usuarios principales
    if ($cedulaDelete == 1) {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Usuarios principales del sistema",
        "Texto" => "No puedes eliminar este usuario.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }

    //Comprobar usuario en la bd
    $checkUsuario = mainModel::consultaSimple("SELECT cedula FROM usuario WHERE cedula = '$cedulaDelete'");
    if ($checkUsuario->rowCount() <= 0) {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "El usuario que quieres eliminar no existe en el sistema.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }

    //Comprobar privilegios de master
    session_start(['name' => 'AMU']);

    if (isset($_SESSION['permiso']) != "Master") {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No tienes los permisos necesarios para realizar esta acción.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }

    $eliminarUsuario = usuarioModelo::eliminarUsuarioModelo($cedulaDelete);

    if ($eliminarUsuario->rowCount() == 1) {
      $alerta = array(
        "Alerta" => "recargar",
        "Titulo" => "Usuario eliminado",
        "Texto" => "Se ha eliminado el usuario del sistema.",
        "Tipo" => "success"
      );
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No hemos podido eliminar el usuario, inténtelo nuevamente",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }
  } //Fin del controlador

  //Inicio del controlador
  public function datosUsuarioControlador($cedula)
  {
    $cedula = mainModel::decryption($cedula);
    $cedula = mainModel::limpiarCadena($cedula);

    return usuarioModelo::datosUsuarioModelo($cedula);
  } //Fin del controlador

  //Inicio del controlador
  public function actualizarUsuarioControlador()
  {
    //Recibiendo Identificador unico
    $cedula = mainModel::decryption($_POST['usuarioUpdate']);
    $cedula = mainModel::limpiarCadena($cedula);

    //Comprobar existencia del usuario
    $checKCedula = mainModel::consultaSimple("SELECT * FROM usuario WHERE cedula = $cedula");

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
    $cedulaNueva = mainModel::limpiarCadena($_POST['cedula']);
    $usuario = mainModel::limpiarCadena($_POST['usuarioUp']);
    $nuevaContrasena1 = mainModel::limpiarCadena($_POST['nuevaContrasena1Up']);
    $nuevaContrasena2 = mainModel::limpiarCadena($_POST['nuevaContrasena2Up']);
    $telefono = mainModel::limpiarCadena($_POST['telefonoUp']);
    $email = mainModel::limpiarCadena($_POST['emailUp']);
    $estado = mainModel::limpiarCadena($_POST['estado']);
    $permisos = mainModel::limpiarCadena($_POST['permisosUp']);

    //Comprobar si han habido cambios
    if ($cedulaNueva == $datos['cedula'] && $usuario == $datos['nombre_usuario'] && $telefono == $datos['telefono'] && $email == $datos['email'] && $estado == $datos['estado'] && $permisos == $datos['permiso']) {
      if ($nuevaContrasena1 == "" || $nuevaContrasena2 == "") {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Atención",
          "Texto" => "No has realizado ningún cambio en la información del usuario.",
          "Tipo" => "warning"
        ];
        echo json_encode($alerta);
        exit();
      }
    }

    //Comprobar campos vacios
    if ($cedulaNueva == "" || $usuario == "" || $permisos == "" || $telefono == "" || $email == "") {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No has llenado todos los campos para la actualización de datos del usuario.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    if ($email != $datos['email']) {
      if (mainModel::verificarDatos("[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}", $email)) {
        $alerta = array(
          "Alerta" => "html",
          "Titulo" => "La dirección de correo electrónico ingresada no coincide con el formato solicitado",
          "Texto" => "
                - Debe tener el formato nombre@dominio.com o nombre@dominio.com.co.<br>
                - El nombre del correo puede contener letras mayúsculas y minúsculas, números, puntos (.), guiones bajos (_), porcentajes (%), signos más (+) y guiones (-).<br>
                - El dominio puede contener letras mayúsculas y minúsculas, números y guiones (-).<br>
                - El dominio debe tener al menos una extensión de dos o más letras, como .com, .org, .net, etc.",
          "Tipo" => "error"
        );
        echo json_encode($alerta);
        exit();
      }
    }

    //Comprobar email
    if ($email != $datos['email']) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $checkEmail = mainModel::consultaSimple("SELECT email FROM usuario WHERE email = '$email'");

        if ($checkEmail->rowCount() > 0) {
          $alerta = array(
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "Ya existe un usuario registrado con el email que estas ingresando para la actualización de datos del usuario.",
            "Tipo" => "error"
          );
          echo json_encode($alerta);
          exit();
        }
      } else {
        $alerta = array(
          "Alerta" => "simple",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "El email ingresado no es válido.",
          "Tipo" => "error"
        );
        echo json_encode($alerta);
        exit();
      }
    }

    //Comprobar claves
    if ($nuevaContrasena1 != "" && $nuevaContrasena2 != "") {
      if ($nuevaContrasena1 != $nuevaContrasena2) {
        $alerta = array(
          "Alerta" => "simple",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "Las contraseñas ingresadas no coinciden.",
          "Tipo" => "error"
        );
        echo json_encode($alerta);
        exit();
      } else {
        $claveUpdate = mainModel::encryption($nuevaContrasena1);
      }
    } else {
      $claveUpdate = $datos['contrasena'];
    }

    //Comprobar permisos
    switch ($permisos) {
      case "Master":
      case "Administrador":
      case "Taller":
      case "Produccion":
        break;
      default:
        $alerta = array(
          "Alerta" => "simple",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => 'La opción del campo "Permisos" no es válida.',
          "Tipo" => "error"
        );
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
    $datosActualizarUsuario = [
      "Cedula" => $cedulaNueva,
      "Usuario" => $usuario,
      "Contrasena" => $claveUpdate,
      "Telefono" => $telefono,
      "Email" => $email,
      "Estado" => $estado,
      "Permiso" => $permisos,
      "CedulaOld" => $datos['cedula']
    ];

    $actualizarUsuario = usuarioModelo::actualizarUsuarioModelo($datosActualizarUsuario);

    if ($actualizarUsuario->rowCount() == 1) {
      $alerta = array(
        "Alerta" => "redireccionarUser",
        "Titulo" => "Usuario actualizado",
        "Texto" => "Se ha completado la actualizacion de datos del usuario.",
        "Tipo" => "success",
        "Url" => SERVERURL . "usuarios"
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
