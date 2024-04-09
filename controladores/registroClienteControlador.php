<?php
if ($peticionAjax) {
    require_once "../modelos/registroClienteModelo.php";
} else {
    require_once "./modelos/registroClienteModelo.php";
}
class registroClienteControlador extends registroClienteModelo
{
    // Controlador para registrar un nuevo cliente
    public function registroClienteControlador()
    {
        $cedula = mainModel::limpiarCadena($_POST['cedula']);
        $nombre_usuario = mainModel::limpiarCadena($_POST['nombre_usuario']);
        $contrasena = mainModel::limpiarCadena($_POST['contrasena']);
        $telefono = mainModel::limpiarCadena($_POST['telefono']);
        $email = mainModel::limpiarCadena($_POST['email']);

        // Comprobar campos vacíos
        if ($nombre_usuario == "" || $cedula == "" || $email == "" || $telefono == "" || $contrasena == "") {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'No has llenado todos los campos para completar el registro',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "registroCliente';
                }
            })
          </script>";
            exit();
        }

        if (!ctype_digit($cedula)) {
            echo "<script>
                Swal.fire({
                    title: 'Ocurrió un error inesperado',
                    text: 'Has ingresado un valor invalido en el apartado de la cedula',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '" . SERVERURL . "registroCliente';
                    }
                })
            </script>";
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                Swal.fire({
                    title: 'Ocurrió un error inesperado',
                    text: 'El correo electrónico ingresado es inválido',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '" . SERVERURL . "registroCliente';
                    }
                })
            </script>";
            exit();
        }
        

        if (!ctype_digit($telefono)) {
            echo "<script>
                Swal.fire({
                    title: 'Ocurrió un error inesperado',
                    text: 'Has ingresado un valor invalido en el apartado del telefono',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '" . SERVERURL . "registroCliente';
                    }
                })
            </script>";
            exit();
        }

        // Comprobar que no hay un cliente con el mismo nombre de usuario
        $checkCc = mainModel::consultaSimple("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = '$nombre_usuario'");

        if ($checkCc->rowCount() > 0) {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'El nombre de usuario ya se encuentra registrado en el sistema, intenta con uno diferente',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "registroCliente';
                }
            })
          </script>";
        exit();
        }

        

        // Comprobar que no hay un cliente con la misma CC
        $checkCc = mainModel::consultaSimple("SELECT cedula FROM usuario WHERE cedula = '$cedula'");

        if ($checkCc->rowCount() > 0) {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'El numero de cedula ya se encuentra registrado en el sistema',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "registroCliente';
                }
            })
          </script>";
        exit();
        }

        
        

        // Comprobar que no hay un cliente con el mismo correo
        $checkCc = mainModel::consultaSimple("SELECT email FROM usuario WHERE email = '$email'");

        if ($checkCc->rowCount() > 0) {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'El correo electronico ya se encuentra registrado en el sistema',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "registroCliente';
                }
            })
          </script>";
        exit();
        }

        // Comprobar que no hay un cliente con el numero de telefono
        $checkCc = mainModel::consultaSimple("SELECT telefono FROM usuario WHERE telefono = '$telefono'");

        if ($checkCc->rowCount() > 0) {
            echo "<script>
            Swal.fire({
                title: 'Ocurrió un error inesperado',
                text: 'El numero de telefono ya se encuentra registrado en el sistema',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '" . SERVERURL . "registroCliente';
                }
            })
          </script>";
        exit();
        }

        $contrasena = mainModel::encryption($contrasena);
        // Preparar datos para el registro
        $datos = [
            "cedula" => $cedula, // Cambiado de "Cedula" a "cedula"
            "nombre_usuario" => $nombre_usuario, // Cambiado de "NombreDeUsuario" a "nombreDeUsuario"
            "contrasena" => $contrasena, // Cambiado de "Contrasena" a "contrasena"
            "telefono" => $telefono, // Cambiado de "Telefono" a "telefono"
            "email" => $email // Cambiado de "CorreoElectronico" a "correoElectronico"
        ];

        // Intentar registrar al nuevo cliente
        if (registroClienteModelo::registrarClienteModelo($datos)) {
            
            echo "<script>
            Swal.fire({
                title: 'Se ha registrado con exito',
                text: 'Ahora podras ingresar al sistema con tus datos personales',
                type: 'success',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false,
              }).then((result) => {
                if (result.value) {
                  window.location.href = '" . SERVERURL . "login';
                }
              });
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
                    window.location.href = '" . SERVERURL . "registroCliente';
                }
            })
           </script>";
        exit();
        }
    }
}

