<?php
if ($peticionAjax) {
  require_once "../modelos/prendasCModelo.php";
} else {
  require_once "./modelos/prendasCModelo.php";
}

class prendasCControlador extends prendasCModelo
{
  //Inicio del controlador
  public function agregarPrendaControlador()
  {
    // Controlador para agregar producto
    $id = mainModel::limpiarCadena($_POST['idPrenda']);
    $nombre = mainModel::limpiarCadena($_POST['Nombre']);
    $descripcion = mainModel::limpiarCadena($_POST['Descripcion']);
    $cantidad = mainModel::limpiarCadena($_POST['Cantidad']);
    // Verificar si se envió una imagen

    // Verificar si hay campos vacíos
    if ($id == "" || $nombre == "" || $descripcion == "" || $cantidad == "") {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No has llenado todos los campos para el registro de una nueva prenda cortada.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Comprobar que no hay un producto con el mismo ID
    $checkId = mainModel::consultaSimple("SELECT id FROM prendascortadas WHERE id = '$id'");
    if ($checkId->rowCount() > 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Ya existe una prenda cortada registrada con el mismo código.",
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
    $datosAgregarPrenda = [
      "id" => $id,
      "Estado" => "si",
      "Nombre" => $nombre,
      "Descripcion" => $descripcion,
      "Cantidad" => $cantidad
    ];

    // Agregar el producto al modelo
    $agregarPrenda = prendasCModelo::agregarPrendasModelo($datosAgregarPrenda);

    if ($agregarPrenda->rowCount() == 1) {
      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Insumo registrado",
        "Texto" => "Se ha completado el registro de la prenda cortada.",
        "Tipo" => "success",
        "Url" => SERVERURL . "prendasCortadas"
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No hemos podido registrar la prenda cortada.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  } // Fin del controlador

  //Inicio del controlador
  public function enlistarPrendaControlador()
  {
    // Prepara la consulta SQL para seleccionar solo los productos de la categoría especificada
    $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM prendascortadas ORDER BY id ASC";
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
        $tabla .= '<td>' . $rows['id'] . '</td>' .
          '<td>' . $rows['Nombre'] . '</td>' .
          '<td>' . $rows['Descripcion'] . '</td>' .
          '<td>' . $rows['Cantidad'] . '</td>' .
          '<td>' . $estadoProducto . '</td>';

        $tabla .= '<td>
                <button onclick="window.location.href = \'' . SERVERURL . 'editarPrendaCortada/' .
          mainModel::encryption($rows['id']) . '\';" class="estado-editar button_js btn-editar" 
                type="button" title="Editar" name="Editar"> 
                <img src="./vistas/img/editar.png"></img>
                </button>
                <button onclick="window.location.href = \'' . SERVERURL . 'detallesPrendaCortada/' .
          mainModel::encryption($rows['id']) . '\';" class="estado-detalles button_js btn-detalles" 
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


  public function datosPrendaControlador($id)
  {
    $id = mainModel::decryption($id);
    $id = mainModel::limpiarCadena($id);

    return prendasCModelo::datosPrendaModelo($id);
  } //Fin del controlador

  //Inicio del controlador
  public function actualizarPrendaControlador()
  {
    // Recibir el ID del producto a actualizar
    $id = mainModel::decryption($_POST['prendaUpdate']);
    $id = mainModel::limpiarCadena($id);

    // Verificar si el producto existe
    $checKId = mainModel::consultaSimple("SELECT * FROM prendascortadas WHERE id = $id");

    // Comprobar si el producto no existe
    if ($checKId->rowCount() <= 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "La prenda cortada que intentas actualizar no se encuentra registrado en el sistema",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    } else {

      $datos = $checKId->fetch();

    }

    // Obtener los datos del formulario
    $idNuevo = mainModel::limpiarCadena($_POST['IdPrenda']);
    $nombre = mainModel::limpiarCadena($_POST['NombreUp']);
    $descripcion = mainModel::limpiarCadena($_POST['DescripcionUp']);
    $cantidad = mainModel::limpiarCadena($_POST['CantidadUp']);
    $estado = mainModel::limpiarCadena($_POST['EstadoUp']);


    // Verificar si se han realizado cambios en los datos del producto
    if (
      $idNuevo == $datos['id'] &&
      $nombre == $datos['Nombre'] &&
      $descripcion == $datos['Descripcion'] &&    
      $cantidad === $datos['Cantidad'] &&
      $estado == $datos['Estado'] 
    ) {
      // No se han realizado cambios en la información del producto
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Atención",
        "Texto" => "No has realizado ningún cambio en la información de la prenda cortada.",
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
        "Texto" => "Por favor, completa todos los campos para actualizar la prenda cortada.",
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
    $datosActualizarPrenda = [
      "idPrenda" => $idNuevo,
      "NombreUp" => $nombre,
      "DescripcionUp" => $descripcion,
      "CantidadUp" => $cantidad,
      "EstadoUp" => $estado,
      "idOld" => $datos['id']
    ];

    // Llama a la función del modelo para actualizar el producto
    $actualizarPrenda = prendasCModelo::actualizarPrendaModelo($datosActualizarPrenda);

    // Comprobar si la actualización fue exitosa
    if ($actualizarPrenda->rowCount() == 1) {
      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Éxito",
        "Texto" => "Se ha actualizado la prenda cortada correctamente.",
        "Tipo" => "success",
        "Url" => SERVERURL . "prendasCortadas"// Utilizar la URL con la variable incluida
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "Hubo un problema al actualizar la prenda cortada.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  }







  public function obtenerPrendasCortadasControlador()
  {
      $productosEnsamble = prendasCModelo::obtenerPrendaModelo();
      return $productosEnsamble;
  }


  public function cantidadPrendasCControlador()
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadPrendasC = prendasCModelo::cantidadPrendasCModelo();

        // Devuelve la cantidad de registros
        return $cantidadPrendasC;
        
    }

}