<?php
if ($peticionAjax) {
  require_once "../modelos/insumoModelo.php";
} else {
  require_once "./modelos/insumoModelo.php";
}

class insumoControlador extends insumoModelo
{
  //Inicio del controlador
  public function agregarInsumoControlador()
  {
    // Controlador para agregar producto
    $id = mainModel::limpiarCadena($_POST['idInsumo']);
    $nombre = mainModel::limpiarCadena($_POST['Nombre']);
    $descripcion = mainModel::limpiarCadena($_POST['Descripcion']);
    $cantidad = mainModel::limpiarCadena($_POST['Cantidad']);
    // Verificar si se envió una imagen

    // Verificar si hay campos vacíos
    if ($id == "" || $nombre == "" || $descripcion == "" || $cantidad == "") {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No has llenado todos los campos para el registro de un nuevo producto.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Comprobar que no hay un producto con el mismo ID
    $checkId = mainModel::consultaSimple("SELECT IdInsumo FROM insumos WHERE IdInsumo = '$id'");
    if ($checkId->rowCount() > 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Ya existe un producto registrado con el mismo código.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Verificar que la cantidad sea mayor que 0
    if ($cantidad < 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error en la cantidad",
        "Texto" => "La cantidad no puede ser menor que 0.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Datos para agregar el producto
    $datosAgregarInsumo = [
      "idInsumo" => $id,
      "Estado" => "si",
      "Nombre" => $nombre,
      "Descripcion" => $descripcion,
      "Cantidad" => $cantidad
    ];

    // Agregar el producto al modelo
    $agregarInsumo = insumoModelo::agregarInsumoModelo($datosAgregarInsumo);

    if ($agregarInsumo->rowCount() == 1) {
      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Insumo registrado",
        "Texto" => "Se ha completado el registro del insumo.",
        "Tipo" => "success",
        "Url" => SERVERURL . "insumos"
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No hemos podido registrar el insumo.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  } // Fin del controlador

  //Inicio del controlador
  public function enlistarInsumoControlador()
  {
    // Prepara la consulta SQL para seleccionar solo los productos de la categoría especificada
    $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM insumos ORDER BY IdInsumo ASC";
    $conexion = mainModel::conectarBD();
    $datos = $conexion->query($consulta);
    $datos = $datos->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $tabla = '';

    if ($total >= 1) {
      $contador = 1;
      foreach ($datos as $rows) {
        // Filas
        $estadoProducto = $rows['Estado'] == "si" ? "Habilitada" : "Deshabilitada";
        $claseFila = $rows['Estado'] == "si" ? "" : "deshabilitado";

        $tabla .= '<tr class="' . $claseFila . '">';
        $tabla .= '<td>' . $rows['IdInsumo'] . '</td>' .
          '<td>' . $rows['Nombre'] . '</td>' .
          '<td>' . $rows['Descripcion'] . '</td>' .
          '<td>' . $rows['Cantidad'] . '</td>' .
          '<td>' . $estadoProducto . '</td>';

        $tabla .= '<td>
                <button onclick="window.location.href = \'' . SERVERURL . 'editarInsumo/' .
          mainModel::encryption($rows['IdInsumo']) . '\';" class="estado-editar button_js btn-editar" 
                type="button" title="Editar" name="Editar"> 
                <img src="./vistas/img/editar.png"></img>
                </button>
                <button onclick="window.location.href = \'' . SERVERURL . 'detallesInsumo/' .
          mainModel::encryption($rows['IdInsumo']) . '\';" class="estado-detalles button_js btn-detalles" 
                type="button" title="detalles" name="detalles"> 
                <img src="./vistas/img/detalles.png"></img>
                </button>       
            </td>';
        $tabla .= '</tr>';
        $contador++;
      }
    } else {
      $tabla .= '<tr><td colspan="10">No hay registros en la categoría seleccionada</td></tr>';
    }

    return $tabla;
  }


  public function datosInsumoControlador($id)
  {
    $id = mainModel::decryption($id);
    $id = mainModel::limpiarCadena($id);

    return insumoModelo::datosInsumoModelo($id);
  } //Fin del controlador

  //Inicio del controlador
  public function actualizarInsumoControlador()
  {
    // Recibir el ID del producto a actualizar
    $id = mainModel::decryption($_POST['insumoUpdate']);
    $id = mainModel::limpiarCadena($id);

    // Verificar si el producto existe
    $checKId = mainModel::consultaSimple("SELECT * FROM insumos WHERE IdInsumo = $id");

    // Comprobar si el producto no existe
    if ($checKId->rowCount() <= 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "El insumo que intentas actualizar no se encuentra registrado en el sistema",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    } else {

      $datos = $checKId->fetch();

    }

    // Obtener los datos del formulario
    $idNuevo = mainModel::limpiarCadena($_POST['IdInsumo']);
    $nombre = mainModel::limpiarCadena($_POST['NombreUp']);
    $descripcion = mainModel::limpiarCadena($_POST['DescripcionUp']);
    $cantidad = mainModel::limpiarCadena($_POST['CantidadUp']);
    $estado = mainModel::limpiarCadena($_POST['EstadoUp']);


    // Verificar si se han realizado cambios en los datos del producto
    if (
      $idNuevo == $datos['IdInsumo'] &&
      $nombre == $datos['Nombre'] &&
      $descripcion == $datos['Descripcion'] &&    
      $cantidad === $datos['Cantidad'] &&
      $estado == $datos['Estado'] 
    ) {
      // No se han realizado cambios en la información del producto
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Atención",
        "Texto" => "No has realizado ningún cambio en la información del insumo.",
        "Tipo" => "warning"
      ];
      echo json_encode($alerta);
      exit();
    }


    // Verificar que no haya campos vacíos
    if ($idNuevo == "" || $nombre == "" || $descripcion == "" || $cantidad == "") {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "Por favor, completa todos los campos para actualizar el insumo.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Verificar que la cantidad sea mayor que 0
    if ($cantidad < 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error en la cantidad",
        "Texto" => "La cantidad no puede ser menor que 0.",
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

    // Datos para actualizar el producto
    $datosActualizarInsumo = [
      "IdInsumo" => $idNuevo,
      "NombreUp" => $nombre,
      "DescripcionUp" => $descripcion,
      "CantidadUp" => $cantidad,
      "EstadoUp" => $estado,
      "idOld" => $datos['IdInsumo']
    ];

    // Llama a la función del modelo para actualizar el producto
    $actualizarInsumo = insumoModelo::actualizarInsumoModelo($datosActualizarInsumo);

    // Comprobar si la actualización fue exitosa
    if ($actualizarInsumo->rowCount() == 1) {
      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Éxito",
        "Texto" => "Se ha actualizado el insumo correctamente.",
        "Tipo" => "success",
        "Url" => SERVERURL . "insumos"// Utilizar la URL con la variable incluida
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "Hubo un problema al actualizar el insumo.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  }

}
