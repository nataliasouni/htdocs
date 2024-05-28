<?php
if ($peticionAjax) {
    require_once "../modelos/produccionModelo.php";
} else {
    require_once "./modelos/produccionModelo.php";
}

class produccionControlador extends produccionModelo
{


    // Método para registrar la producción
    public function registrarProduccion()
    {

        $cedulatrabajador = mainModel::limpiarCadena($_POST['cedulatrabajador']);
        $idtaller = mainModel::limpiarCadena($_POST['idtaller']);
        $fecha = mainModel::limpiarCadena($_POST['fecha']);
        $idPrenda = mainModel::limpiarCadena($_POST['idPrenda']);
        $totalprendasquirurgicas = mainModel::limpiarCadena($_POST['totalprendasquirurgicas']);
        $totalprendasdefectuosas = mainModel::limpiarCadena($_POST['totalprendasdefectuosas']);

        // Comprobar campos vacíos
        if ($cedulatrabajador == "" || $idtaller == "" || $fecha == "" || $idPrenda == "" || $totalprendasquirurgicas == "" || $totalprendasdefectuosas == "") {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'No has llenado todos los campos para completar el registro',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "produccion';
                }
            })
          </script>";
            exit();
        }

        if (!ctype_digit($idPrenda)) {
            echo "<script>
                Swal.fire({
                    title: 'Ocurrió un error inesperado',
                    text: 'Has ingresado un valor inválido en el apartado de las prendas quirúrgicas',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '" . SERVERURL . "produccion';
                    }
                })
            </script>";
            exit();
        }

        if (!ctype_digit($totalprendasquirurgicas)) {
            echo "<script>
                Swal.fire({
                    title: 'Ocurrió un error inesperado',
                    text: 'Has ingresado un valor inválido en el apartado de las prendas quirúrgicas',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '" . SERVERURL . "produccion';
                    }
                })
            </script>";
            exit();
        }

        if (!ctype_digit($totalprendasdefectuosas)) {
            echo "<script>
                Swal.fire({
                    title: 'Ocurrió un error inesperado',
                    text: 'Has ingresado un valor invalido en el apartado de las prendas defectuosas',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '" . SERVERURL . "produccion';
                    }
                })
            </script>";
            exit();
        }

        $checkCc = mainModel::consultaSimple("SELECT cedulatrabajador, fecha FROM produccion WHERE cedulatrabajador = '$cedulatrabajador' AND fecha = '$fecha' ");

        if ($checkCc->rowCount() > 0) {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'La produccion de este trabajador para la fecha " . $_POST['fecha'] . " ya ha sido registrada',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "produccion';
                }
            })
          </script>";
            exit();
        }

        $datos = [
            "cedulatrabajador" => $cedulatrabajador,
            "idtaller" => $idtaller,
            "fecha" => $fecha,
            "idPrenda" => $idPrenda,
            "totalprendasquirurgicas" => $totalprendasquirurgicas,
            "totalprendasdefectuosas" => $totalprendasdefectuosas
        ];

        produccionModelo::actualizarPrendasModelo($datos);
        //produccionModelo::prendasTallerModelo($datos);
        if (produccionModelo::registrarProduccionModelo($datos)) {

            echo "<script>
            Swal.fire({
                title: 'Proceso exitoso',
                text: 'Se ha registrado la producción',
                type: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "produccion';
                }
            })
          </script>";
            exit();

        } else {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'Por favor intentelo de nuevo o mas tarde',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "produccion';
                }
            })
           </script>";
            exit();
        }
    }

    // Método para cargar los nombres y las cedulas de los trabajadores en el ComboBox
    public function cargarNombresYCedulasTrabajadores()
    {
        $produccionModelo = new ProduccionModelo();
        $datosTrabajadores = $produccionModelo->obtenerNombresYCedulasTrabajadoresModelo();

        foreach ($datosTrabajadores as $nombre => $cedula) {
            echo "<option value='$cedula'>$nombre </option>";
        }
    }

    // Método para cargar los nombres e ids de los talleres en el ComboBox
    public function cargarNombresIdTalleres()
    {
        $produccionModelo = new ProduccionModelo();
        $datosTalleres = $produccionModelo->obtenerNombresIdTalleresModelo();

        foreach ($datosTalleres as $nombre_usuario => $cedula) {
            echo "<option value='$cedula'>$nombre_usuario</option>";
        }
    }

    // Método para cargar los nombres e ids de las prendas en el ComboBox
    public function cargarNombresIdPrendas()
    {
        $produccionModelo = new ProduccionModelo();
        $datosPrendas = $produccionModelo->obtenerNombresIdPrendasQuirurgicas();

        foreach ($datosPrendas as $nombre => $id) {
            echo "<option value='$id'>$nombre</option>";
        }
    }




    public function generarTablaProduccion()
    {
        // Consulta SQL para obtener los datos necesarios de la tabla producción y realizar los joins con las tablas relacionadas
        $consulta = "SELECT p.id, p.fecha, t.nombre AS nombre_trabajador, tall.nombre_usuario AS nombre_taller, pq.nombre AS prenda_elaborada, p.prendasquirurgicas AS cantidad_prendas, p.prendasdefectuosas AS prendas_defectuosas
        FROM produccion p
        INNER JOIN trabajadores t ON p.cedulatrabajador = t.cedula
        INNER JOIN usuario tall ON p.idtaller = tall.cedula
        INNER JOIN prendasquirurgicas pq ON p.idprenda = pq.id
        ORDER BY p.id DESC";

        // Ejecutar la consulta y obtener los datos
        $conexion = mainModel::conectarBD();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = count($datos);
        $tabla = '';

        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $fila) {
                // Construir cada fila de la tabla con los datos obtenidos
                $tabla .= '<tr>';
                $tabla .= '<td>' . $fila['nombre_trabajador'] . '</td>';
                $tabla .= '<td>' . $fila['nombre_taller'] . '</td>';
                $tabla .= '<td>' . $fila['fecha'] . '</td>';
                $tabla .= '<td>' . $fila['prenda_elaborada'] . '</td>';
                $tabla .= '<td>' . $fila['cantidad_prendas'] . '</td>';
                $tabla .= '<td>' . $fila['prendas_defectuosas'] . '</td>';
                $tabla .= '</tr>';

                $contador++;
            }
        } else {
            $tabla .= '<tr><td colspan="6">No hay registros en la tabla</td></tr>';
        }

        return $tabla; // Devolver la tabla construida
    }


    public function datosProduccionControlador($id)
    {

        $id = mainModel::decryption($id);
        $id = mainModel::limpiarCadena($id);

        return produccionModelo::datosProduccionTrabajadorModelo($id);
    } //Fin del controlador



    public function actualizarProduccionControlador()
    {
        //Recibiendo Identificador unico

        $id = mainModel::decryption($_POST['idUpdate']);
        $id = mainModel::limpiarCadena($id);


        //Comprobar existencia del usuario
        $checKid = mainModel::consultaSimple("SELECT * FROM produccion WHERE id = $id");

        if ($checKid->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La produccion que intentas editar no se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $checKid->fetch();
        }

        //Obtener valores del form

        $prendasquirurgicas = mainModel::limpiarCadena($_POST['prendasquirurgicas']);
        $prendasdefectuosas = mainModel::limpiarCadena($_POST['prendasdefectuosas']);


        //Comprobar si han habido cambios
        if ($prendasquirurgicas == $datos['prendasquirurgicas'] && $prendasdefectuosas == $datos['prendasdefectuosas']) {

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
        if ($prendasquirurgicas == "" || $prendasdefectuosas == "") {
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
        $datosActualizarProduccion = [
            "id" => $datos['id'],
            "prendasquirurgicas" => $prendasquirurgicas,
            "prendasdefectuosas" => $prendasdefectuosas

        ];

        $actualizarProduccion = produccionModelo::actualizarProduccionModelo($datosActualizarProduccion);

        if ($actualizarProduccion->rowCount() == 1) {
            $alerta = array(
                "Alerta" => "redireccionarUser",
                "Titulo" => "Usuario actualizado",
                "Texto" => "Se ha completado la actualizacion de datos del registro.",
                "Tipo" => "success",
                "Url" => SERVERURL . "produccionMaster"
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



    public function cantidadRegistrosProduccionControlador()
    {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadRegistros = produccionModelo::cantidadRegistrosProduccionModelo();

        // Devuelve la cantidad de registros
        return $cantidadRegistros;
        
    }

}




