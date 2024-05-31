<?php
if ($peticionAjax) {
  require_once "../modelos/alquilerproductosModelo.php";
} else {
  require_once "./modelos/alquilerproductosModelo.php";
}

class alquilerproductosControlador extends alquilerproductosModelo
{
  //Inicio del controlador
  public function agregaralquilerproductosControlador()
  {
    //Controlador para agregar usuario
    $codigoProducto = mainModel::limpiarCadena($_POST['codigoProducto']);
    $nombreProducto = mainModel::limpiarCadena($_POST['nombreProducto']);
    $detallesProducto = mainModel::limpiarCadena($_POST['detallesProducto']);
    $precio15Dias = mainModel::limpiarCadena($_POST['precio15Dias']);
    $precio30Dias = mainModel::limpiarCadena($_POST['precio30Dias']);
    $precioDeposito = mainModel::limpiarCadena($_POST['precioDeposito']);


    //Verificar si hay campos vacios
    if ($codigoProducto == "" || $nombreProducto == "" || $detallesProducto == "" || $precio15Dias == "" || $precio30Dias == "" || $precioDeposito == "") {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No has llenado todos los campos para el registro de un nuevo producto .",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    }

    //Verificar formatos de los datos del usuario


    //Comprobar que no hay un usuario con la misma CC
    $checkCc = mainModel::consultaSimple("SELECT id FROM alquilerproductos WHERE id = '$codigoProducto'");
    if ($checkCc->rowCount() > 0) {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "Ya existe un producto registrado con el codigo que quieres usar para el registro de este nuevo codigo.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }


    $datosAgregarProductoAlquiler = [
      "codigoProducto" => $codigoProducto,
      "nombreProducto" => $nombreProducto,
      "detallesProducto" => $detallesProducto,
      "precio15Dias" => $precio15Dias,
      "precio30Dias" => $precio30Dias,
      "precioDeposito" => $precioDeposito,
      "estado" => "si",

    ];

    $AgregarProductoAlquiler = alquilerProductosModelo::agregarProductoModelo($datosAgregarProductoAlquiler);

    if ($AgregarProductoAlquiler->rowCount() == 1) {
      $alerta = array(
        "Alerta" => "redireccionarUser",
        "Titulo" => "Producto registrado",
        "Texto" => "Se ha completado el registro del producto.",
        "Tipo" => "success",
        "Url" => SERVERURL . "alquilerProductos"
      );
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No hemos podido registrar el producto",
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
        if ($rows['estado'] == 'si') {
          //Filas
          $tabla .= '<tr>
                          <td>' . $contador . '</td>
                          <td>' . $rows['id'] . '</td>' .
            '<td>' . $rows['nombreproducto'] . '</td>' .
            '<td>' . $rows['detalles'] . '</td>' .
            '<td>$' . $rows['alquiler15dias'] . '</td>' .
            '<td>$' . $rows['alquiler30dias'] . '</td>' .
            '<td>$' . $rows['deposito'] . '</td>';

          //Botones
          if ($rows['id'] != 0) {
            $tabla .= '<td>
                                  <button onclick="window.location.href = \'' . SERVERURL . 'editarProductosAlquiler/' . mainModel::encryption($rows['id']) . '\';" class="estado-editar button_js btn-editar" type="button" title="Editar" name="Editar"><img src="./vistas/img/lapiz.png"></img></button>
                                  <button onclick="window.location.href = \'' . SERVERURL . 'agregarAlquiler/' . mainModel::encryption($rows['id']) . '\';" class="estado-editar button_js btn-editar" type="button" title="Editar" name="Editar"><img src="./vistas/img/contrato.png"></img></button>
                              </td>';
          }

          $tabla .= '</tr>';
          $contador++;
        }
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

    return alquilerProductosModelo::datosalquilerproductoModelo($id);
  } //Fin del controlador
  //Inicio del controlador
  public function actualizarProductosAlquilerControlador()
  {
    //Recibiendo Identificador unico
    $codigoProducto = mainModel::decryption($_POST['productoAlquilerUpdate']);
    $codigoProducto = mainModel::limpiarCadena($codigoProducto);

    //Comprobar existencia del usuario
    $checKCedula = mainModel::consultaSimple("SELECT * FROM alquilerproductos WHERE id = $codigoProducto");

    if ($checKCedula->rowCount() <= 0) {
      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "EL producto que intentas editar no se encuentra registrado en el sistema",
        "Tipo" => "error"
      ];
      echo json_encode($alerta);
      exit();
    } else {
      $datos = $checKCedula->fetch();
    }

    //Obtener valores del form
    $codigo = mainModel::limpiarCadena($_POST['codigoUp']);
    $nombre = mainModel::limpiarCadena($_POST['nombreUp']);
    $detalles = mainModel::limpiarCadena($_POST['detallesProducto']);
    $precio15Dias = mainModel::limpiarCadena($_POST['precio15Dias']);
    $precio30Dias = mainModel::limpiarCadena($_POST['precio30Dias']);
    $precioDeposito = mainModel::limpiarCadena($_POST['precioDeposito']);

    //Comprobar si han habido cambios
    if ($codigo == $datos['id'] && $nombre == $datos['nombreproducto'] && $detalles == $datos['detalles'] && $precio15Dias == $datos['alquiler15dias'] 
    && $precio30Dias == $datos['alquiler30dias'] && $precioDeposito == $datos['deposito']) {

      $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Atención",
        "Texto" => "No has realizado ningún cambio en la información del producto.",
        "Tipo" => "warning"
      ];
      echo json_encode($alerta);
      exit();

    }









    //Array de datos para la actualizacion de datos
    $datosActualizarProducto = [
      "id" => $codigo,
      "nombreproducto" => $nombre,
      "detalles" => $detalles,
      "alquiler15dias" => $precio15Dias,
      "alquiler30dias" => $precio30Dias,
      "deposito" => $precioDeposito,
    ];

    $ActualizarProducto = alquilerProductosModelo::actualizarProductoModelo($datosActualizarProducto);

    if ($ActualizarProducto->rowCount() == 1) {
      $alerta = array(
        "Alerta" => "redireccionarUser",
        "Titulo" => "Usuario actualizado",
        "Texto" => "Se ha completado la actualizacion de datos del producto.",
        "Tipo" => "success",
        "Url" => SERVERURL . "alquilerProductos"
      );
      echo json_encode($alerta);
      exit();
    } else {
      $alerta = array(
        "Alerta" => "simple",
        "Titulo" => "Ocurrió un error inesperado",
        "Texto" => "No se ha podido completar la actualización de los datos del producto.",
        "Tipo" => "error"
      );
      echo json_encode($alerta);
      exit();
    }
  } //Fin del controlador

  public function cantidadpalquilerControlador()
  {
      // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
      $cantidadRegistros = alquilerproductosModelo::cantidadPalquilerModelo();

      // Devuelve la cantidad de registros
      return $cantidadRegistros;
      
  }

}

