<?php
if ($peticionAjax) {
  require_once "../modelos/productosModelo.php";
} else {
  require_once "./modelos/productosModelo.php";
}

class productoControlador extends productosModelo
{
  //Inicio del controlador
  public function agregarProductoControlador()
  {
    // Controlador para agregar producto
    $id = mainModel::limpiarCadena($_POST['idNormal']);
    $nombre = mainModel::limpiarCadena($_POST['Nombre']);
    $descripcion = mainModel::limpiarCadena($_POST['Descripcion']);
    $categoria = mainModel::limpiarCadena($_POST['Categoria']);
    $cantidad = mainModel::limpiarCadena($_POST['Cantidad']);
    $alquiler = mainModel::limpiarCadena($_POST['Alquiler']);
    // Verificar si se envió una imagen
    $imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : null;

    // Verificar si hay campos vacíos
    if ($id == "" || $nombre == "" || $descripcion == "" || $categoria == "" || $cantidad == "" || $alquiler == "" || !$imagen) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No has llenado todos los campos para el registro de un nuevo producto.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Verificar que la categoría sea válida
    switch ($categoria) {
      case "Movilidad y Recuperación":
      case "Muebles Hospitalarios":
      case "Línea Respiratoria":
      case "Colchones y Colchonetas":
      case "Prendas Quirurgicas":
        break;
      default:
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => 'La opción del campo "Categoría" no es válida.',
          "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }

    // Comprobar que no hay un producto con el mismo ID
    $checkId = mainModel::consultaSimple("SELECT Id FROM productos WHERE Id = '$id'");
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

    // Procesar la imagen
    $identificadorImagen = uniqid();
    $nombreArchivo = $imagen['name'];
    $rutaArchivo = $imagen['tmp_name'];

    $directorioArchivosImg = "../src/imagenes/productos";
    $ruta = $directorioArchivosImg . '/' . $identificadorImagen . "-" . $nombreArchivo;

    // Mover la imagen al directorio de destino
    if (!move_uploaded_file($rutaArchivo, $ruta)) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Hubo un problema al cargar la imagen del producto.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    // Datos para agregar el producto
    $datosAgregarProducto = [
      "idNormal" => $id,
      "Estado" => "si",
      "Nombre" => $nombre,
      "Descripcion" => $descripcion,
      "Categoria" => $categoria,
      "Cantidad" => $cantidad,
      "Alquiler" => $alquiler,
      "Imagen" => $identificadorImagen . "-" . $nombreArchivo,
    ];

    // Agregar el producto al modelo
    $agregarProducto = productosModelo::agregarProductoModelo($datosAgregarProducto);

    if ($agregarProducto->rowCount() == 1) {

      $var = $categoria;


      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Producto registrado",
        "Texto" => "Se ha completado el registro del producto.",
        "Tipo" => "success",
        "Url" => SERVERURL . "productos?variable=$var"// Utilizar la URL con la variable incluida
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No hemos podido registrar el producto.",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }
  } // Fin del controlador

  //Inicio del controlador
  public function enlistarProductoControlador($categoria)
  {
    // Prepara la consulta SQL para seleccionar solo los productos de la categoría especificada
    $consulta = "SELECT * FROM productos WHERE Categoria = :categoria ORDER BY Id ASC";
    $conexion = mainModel::conectarBD();
    $datos = $conexion->prepare($consulta);
    $datos->bindParam(':categoria', $categoria);
    $datos->execute();
    $total = $datos->rowCount();
    $tabla = '';

    if ($total >= 1) {
      $contador = 1;
      while ($rows = $datos->fetch()) {
        // Filas
        $estadoProducto = $rows['Estado'] == "si" ? "Habilitada" : "Deshabilitada";
        $claseFila = $rows['Estado'] == "si" ? "" : "deshabilitado";

        $tabla .= '<tr class="' . $claseFila . '">';
        $tabla .= '<td>' . $rows['Id'] . '</td>' .
          '<td>' . $rows['Nombre'] . '</td>' .
          '<td>' . $rows['Descripcion'] . '</td>' .
          '<td>' . $rows['Categoria'] . '</td>' .
          '<td>' . $rows['Cantidad'] . '</td>' .
          '<td>' . $rows['Alquiler'] . '</td>' .
          '<td>' . $estadoProducto . '</td>';

        if ($rows['Imagen'] == "") {
          $tabla .= '<td>' . 'Imagen no disponible' . '</td>';
        } else {
          $tabla .= '<td>' . '<img src="' . SERVERURL . 'src/imagenes/productos/' . $rows['Imagen'] . '"
                 style="max-width: 100px; height: auto;">' . '</td>';
        }

        $tabla .= '<td>
                <button onclick="window.location.href = \'' . SERVERURL . 'editarProducto/' .
          mainModel::encryption($rows['Id']) . '\';" class="estado-editar button_js btn-editar" 
                type="button" title="Editar" name="Editar"> 
                <img src="./vistas/img/editar.png"></img>
                </button>
                <button onclick="window.location.href = \'' . SERVERURL . 'detallesProducto/' .
          mainModel::encryption($rows['Id']) . '\';" class="estado-detalles button_js btn-detalles" 
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


  public function datosProductoControlador($id)
  {
    $id = mainModel::decryption($id);
    $id = mainModel::limpiarCadena($id);

    return productosModelo::datosProductoModelo($id);
  } //Fin del controlador

  //Inicio del controlador
  public function actualizarProductoControlador()
  {
    // Recibir el ID del producto a actualizar
    $id = mainModel::decryption($_POST['productoUpdate']);
    $id = mainModel::limpiarCadena($id);

    // Verificar si el producto existe
    $checKId = mainModel::consultaSimple("SELECT * FROM productos WHERE Id = $id");

    // Comprobar si el producto no existe
    if ($checKId->rowCount() <= 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "El ensamble que intentas actualizar no se encuentra registrado en el sistema",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    } else {

      $datos = $checKId->fetch();

    }

    // Obtener los datos del formulario
    $idNuevo = mainModel::limpiarCadena($_POST['Id']);
    $nombre = mainModel::limpiarCadena($_POST['NombreUp']);
    $descripcion = mainModel::limpiarCadena($_POST['DescripcionUp']);
    $categoria = mainModel::limpiarCadena($_POST['CategoriaUp']);
    $cantidad = mainModel::limpiarCadena($_POST['CantidadUp']);
    $alquiler = mainModel::limpiarCadena($_POST['AlquilerUp']);
    $estado = mainModel::limpiarCadena($_POST['EstadoUp']);

    // Verificar si se ha enviado una nueva imagen
    $imagen = isset($_FILES['ImagenUp']) ? $_FILES['ImagenUp'] : null;

    // Verificar si se han realizado cambios en los datos del producto
    if (
      $idNuevo == $datos['Id'] &&
      $nombre == $datos['Nombre'] &&
      $descripcion == $datos['Descripcion'] &&
      $categoria == $datos['Categoria'] &&
      $cantidad === $datos['Cantidad'] &&
      $alquiler == $datos['Alquiler'] &&
      $estado == $datos['Estado'] &&
      empty($imagen['name']) // Verificar si no se ha enviado una nueva imagen
    ) {
      // No se han realizado cambios en la información del producto
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Atención",
        "Texto" => "No has realizado ningún cambio en la información del producto.",
        "Tipo" => "warning"
      ];
      echo json_encode($alerta);
      exit();
    }


    // Verificar que no haya campos vacíos
    if ($idNuevo == "" || $nombre == "" || $descripcion == "" || $categoria == "" || $cantidad == "" || $alquiler == "" || !$imagen) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Error",
        "Texto" => "Por favor, completa todos los campos para actualizar el producto.",
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

    // Verificar que la categoría sea válida
    switch ($categoria) {
      case "Movilidad y Recuperación":
      case "Muebles Hospitalarios":
      case "Línea Respiratoria":
      case "Colchones y Colchonetas":
      case "Prendas Quirurgicas":
        break;
      default:
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Error",
          "Texto" => 'La opción seleccionada en "Categoría" no es válida.',
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

    // Procesar la nueva imagen si se ha enviado
    if (!empty($imagen['name'])) {
      $identificadorImagen = uniqid();
      $nombreArchivo = $imagen['name'];
      $rutaTemporal = $imagen['tmp_name'];
      $rutaDestino = "../src/imagenes/productos/" . $identificadorImagen . "-" . $nombreArchivo;

      try {
        // Mover la imagen al directorio de destino
        if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
          throw new Exception("Hubo un problema al cargar la imagen del producto.");
        }

        // Si la imagen se ha movido correctamente, actualizar el campo de imagen en la base de datos
        $imagenProducto = $identificadorImagen . "-" . $nombreArchivo;
      } catch (Exception $e) {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Error",
          "Texto" => $e->getMessage(),
          "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
      }
    } else {
      try {
        // Si no se proporciona una nueva imagen, mantener la imagen existente
        $imagenProducto = $datos['Imagen']; // Suponiendo que 'Imagen' es el campo de la imagen en tu base de datos
      } catch (Exception $e) {
        $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Error",
          "Texto" => "Hubo un problema al cargar la imagen del producto existente.",
          "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
      }
    }

    // Datos para actualizar el producto
    $datosActualizarProducto = [
      "Id" => $idNuevo,
      "NombreUp" => $nombre,
      "DescripcionUp" => $descripcion,
      "CategoriaUp" => $categoria,
      "CantidadUp" => $cantidad,
      "AlquilerUp" => $alquiler,
      "EstadoUp" => $estado,
      "ImagenUp" => $imagenProducto, // Usar la nueva imagen o mantener la existente
      "idOld" => $datos['Id']
    ];

    // Llama a la función del modelo para actualizar el producto
    $actualizarProducto = productosModelo::actualizarProductoModelo($datosActualizarProducto);

    $var = $categoria;

    // Comprobar si la actualización fue exitosa
    if ($actualizarProducto->rowCount() == 1) {
      $alerta = [
        "Alerta" => "redireccionarUser",
        "Titulo" => "Éxito",
        "Texto" => "Se ha actualizado el producto correctamente.",
        "Tipo" => "success",
        "Url" => SERVERURL . "productos?variable=$var"// Utilizar la URL con la variable incluida
      ];
      echo json_encode($alerta);
      exit();
    } else {
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

}
