<?php
if ($peticionAjax) {
    require_once "../modelos/produccionModelo.php";
} else {
    require_once "./modelos/produccionModelo.php";
}

class produccionControlador extends produccionModelo {

    // Método para registrar la producción
    public function registrarProduccion() {
        
        $cedulatrabajador = mainModel::limpiarCadena($_POST['cedulatrabajador']);
        $idtaller = mainModel::limpiarCadena($_POST['idtaller']);
        $fecha = mainModel::limpiarCadena($_POST['fecha']);
        $prendasquirurgicas = mainModel::limpiarCadena($_POST['prendasquirurgicas']);
        $prendasdefectuosas = mainModel::limpiarCadena($_POST['prendasdefectuosas']);

        // Comprobar campos vacíos
        if ($cedulatrabajador == "" ||$idtaller == "" || $fecha == "" || $prendasquirurgicas == "" ||$prendasdefectuosas == ""  ) {
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

        if (!ctype_digit($prendasquirurgicas)) {
            echo "<script>
                Swal.fire({
                    title: 'Ocurrió un error inesperado',
                    text: 'Has ingresado un valor invalido en el apartado de las prendas quirurgicas',
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

        if (!ctype_digit($prendasdefectuosas)) {
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
            "idtaller"=> $idtaller,
            "fecha" => $fecha, 
            "prendasquirurgicas" => $prendasquirurgicas, 
            "prendasdefectuosas"=> $prendasdefectuosas
        ];

        if (produccionModelo::registrarProduccionModelo( $datos )) {
            
            echo "<script>
            Swal.fire({
                title: 'Proceso exitoso',
                text: 'Se ha registrado la produccion',
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
    public function cargarNombresYCedulasTrabajadores() {
        $produccionModelo = new ProduccionModelo();
        $datosTrabajadores = $produccionModelo->obtenerNombresYCedulasTrabajadoresModelo();
        
        foreach ($datosTrabajadores as $nombre => $cedula) {
            echo "<option value='$cedula'>$nombre </option>";
        }
    }

    // Método para cargar los nombres e ids de los talleres en el ComboBox
    public function cargarNombresIdTalleres() {
        $produccionModelo = new ProduccionModelo();
        $datosTalleres = $produccionModelo->obtenerNombresIdTalleresModelo();

        foreach ($datosTalleres as $nombre => $id) {
        echo "<option value='$id'>$nombre</option>";
        }
    }
}




