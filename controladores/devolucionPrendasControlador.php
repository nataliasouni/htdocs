<?php
if ($peticionAjax) {
  require_once "../modelos/devolucionPrendasModelo.php";
} else {
  require_once "./modelos/devolucionPrendasModelo.php";
}

class devolucionPrendasControlador extends devolucionPrendasModelo
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
        "Texto" => "No has llenado todos los campos para el registro de una nueva devolución por defecto.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Comprobar que no hay un producto con el mismo ID
    $checkId = mainModel::consultaSimple("SELECT id FROM devolucionprendas WHERE id = '$id'");
    if ($checkId->rowCount() > 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Ya existe una devolución por defecto registrada con el mismo código.",
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
    $agregarPrenda = devolucionPrendasModelo::agregarPrendasModelo($datosAgregarPrenda);

    if ($agregarPrenda->rowCount() == 1) {
      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Insumo registrado",
        "Texto" => "Se ha completado el registro de la devolución por defecto.",
        "Tipo" => "success",
        "Url" => SERVERURL . "devolucionPorDefecto"
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No hemos podido registrar la devolución por defecto.",
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
    $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM devolucionprendas ORDER BY id ASC";
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

        $contador++;
      }
    } else {
      $tabla .= '<tr><td colspan="10">No hay registros de devoluciones por defecto</td></tr>';
    }

    return $tabla;
  }


  public function datosPrendaControlador($id)
  {
    $id = mainModel::decryption($id);
    $id = mainModel::limpiarCadena($id);

    return devolucionPrendasModelo::datosPrendaModelo($id);
  } //Fin del controlador

  //Inicio del controlador
  public function actualizarPrendaControlador()
  {
    // Recibir el ID del producto a actualizar
    $id = mainModel::decryption($_POST['prendaUpdate']);
    $id = mainModel::limpiarCadena($id);

    // Verificar si el producto existe
    $checKId = mainModel::consultaSimple("SELECT * FROM devolucionprendas WHERE id = $id");

    // Comprobar si el producto no existe
    if ($checKId->rowCount() <= 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "La devolución por defecto que intentas actualizar no se encuentra registrado en el sistema",
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
        "Texto" => "No has realizado ningún cambio en la información de la devolución por defecto.",
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
        "Texto" => "Por favor, completa todos los campos para actualizar la devolución por defecto.",
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
    $actualizarPrenda = devolucionPrendasModelo::actualizarPrendaModelo($datosActualizarPrenda);

    // Comprobar si la actualización fue exitosa
    if ($actualizarPrenda->rowCount() == 1) {
      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Éxito",
        "Texto" => "Se ha actualizado la devolución por defecto correctamente.",
        "Tipo" => "success",
        "Url" => SERVERURL . "devolucionPorDefecto"// Utilizar la URL con la variable incluida
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "Hubo un problema al actualizar la devolución por defecto.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  }


  public function enlistarPrenda2Controlador()
{
    // Prepara la consulta SQL para obtener el nombre de la prenda, la sumatoria de las prendas defectuosas y la descripción de cada prenda
    $consulta = "
        SELECT 
            pq.nombre AS nombre_prenda,
            SUM(p.prendasdefectuosas) AS total_defectuosas,
            pq.descripcion AS descripcion_prenda
        FROM 
            produccion p
        JOIN 
            prendasquirurgicas pq ON p.idprenda = pq.id
        GROUP BY 
            pq.id, pq.nombre, pq.descripcion
        ORDER BY 
            pq.id ASC
    ";
    
    // Realiza la consulta en la base de datos
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
            $tabla .= '<tr>';
            $tabla .= '<td>' . $contador . '</td>' .
                '<td>' . $rows['nombre_prenda'] . '</td>' .
                '<td>' . $rows['descripcion_prenda'] . '</td>'.
                '<td>' . $rows['total_defectuosas'] . '</td>' ;
            $tabla .= '</tr>';

            $contador++;
        }
    } else {
        $tabla .= '<tr><td colspan="4">No hay registros</td></tr>';
    }

    return $tabla;
}



public function cantidadRegistrosDPControlador()
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadTrabajadores = devolucionPrendasModelo::cantidadRegistrosDPModelo();

        // Devuelve la cantidad de registros
        return $cantidadTrabajadores;
        
    }


}