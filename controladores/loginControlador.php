<?php
if ($peticionAjax) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}

class loginControlador extends loginModelo
{
    //Controlador para iniciar sesion
    public function iniciarSesionControlador()
    {
        $usuario = mainModel::limpiarCadena($_POST['usuario']);
        $clave = mainModel::limpiarCadena($_POST['password']);


        //Comprobar campos vacios
        if ($usuario == "" || $clave == "") {
            echo "<script>
            Swal.fire({
                title: 'Ocurrio un error inesperado',
                text: 'No has llenado todos los campos para el ingreso al sistema.',
                type: 'warning',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    location.href = 'login';
                }
            })
            </script>";
            exit();
        }

        $clave = mainModel::encryption($clave);
        
        $datos = [
            "Usuario" => $usuario,
            "Clave" => $clave
        ];

        $datosLogin = loginModelo::iniciarSesionModelo($datos);

        if ($datosLogin->rowCount() == 1) {
            $datos = $datosLogin->fetch();
            if ($datos['estado'] == "no") {
                echo "<script>
                Swal.fire({
                    title: 'Cuenta deshabilitada',
                    text: 'Esta cuenta se encuentra deshabilitada y no puede acceder al sistema, contacte con el máster para su habilitación.',
                    type: 'error',
                    allowOutsideClick: false,
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'login';
                    }
                })
                </script>";
                exit();
            } else {
                session_start(['name' => 'AMU']);

                $_SESSION['cedula'] = $datos['cedula'];
                $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
                $_SESSION['contrasena'] = $datos['contrasena'];
                $_SESSION['telefono'] = $datos['telefono'];
                $_SESSION['email'] = $datos['email'];
                $_SESSION['permiso'] = $datos['permiso'];
                $_SESSION['token_amu'] = md5(uniqid(mt_rand(), true));

                return header("location:" . SERVERURL . "home");
            }
        } else {
            echo "<script>
            Swal.fire({
                title: 'Ocurrio un error inesperado',
                text: 'El nombre de usuario o la contraseña son incorrectos.',
                type: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'login';
                }
            })
            </script>";
            exit();
        }
    } //Fin del controlador

    //Controlador para forzar el cierre de sesion
    public function forzarCierreSesionControlador()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            return "<script> window.location.href='" . SERVERURL . "' </script>";
        } else {
            return header("Location:" . SERVERURL . "");
        }
    } //Fin del controlador

    //Controlador para el cierre de sesion
    public function cierreSesionControlador()
    {
        session_start(['name' => 'AMU']);
        $token = mainModel::decryption($_POST['token']);
        $usuario = mainModel::decryption($_POST['usuario']);

        if ($token == $_SESSION['token_amu'] && $usuario == $_SESSION['nombre_usuario']) {
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "redireccionar",
                "Url" => SERVERURL
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $alerta = array(
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo cerrar la sesión en el sistema",
                "Tipo" => "error"
            );
            echo json_encode($alerta);
            exit();
        }
    } //Fin del controlador

    //Controlador para cambiar de contraseña
    public function cambiarContraseñaControlador()
    {
        //Comprobar email
        $email = mainModel::limpiarCadena($_POST['email']);

        if ($email == "") {
            echo "<script>
                    Swal.fire({
                    title: 'Ocurrio un error inesperado',
                    text: 'No has ingresado un correo electronico',
                    type: 'warning',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            location.href = 'recuperarContra';
                        }
                        })
                    </script>";
            exit();
        }

        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $checkEmail = mainModel::consultaSimple("SELECT email FROM usuario WHERE email = '$email'");
                if ($checkEmail->rowCount() > 0) {
                    echo "<script>
                    Swal.fire({
                    title: 'Verifique su correo',
                    text: '¿El correo ingresado es correcto?: " . $_POST['email'] . "',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '" . SERVERURL . "ajax/emailContrasena.php', true);
                            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    var response = JSON.parse(xhr.responseText);
                                    if (response.status === 'success') {
                                        Swal.fire({
                                            title: 'Correo enviado',
                                            text: 'Se ha enviado su nueva contraseña al correo, puede llegar a tardar unos minutos',
                                            type: 'success',
                                            confirmButtonText: 'Aceptar',
                                            allowOutsideClick: false
                                        }).then((result) => {
                                            if (result.value) {
                                                location.href = 'login';
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Ocurrio un error inesperado',
                                            text: response.message,
                                            type: 'error',
                                            confirmButtonText: 'Aceptar',
                                            allowOutsideClick: false
                                        }).then((result) => {
                                            if (result.value) {
                                                location.href = 'recuperarContra';
                                            }
                                        });
                                    }
                                }
                            };
                            // Prepara los datos para enviarlos
                            var data = new FormData();
                            data.append('correo', '" . $_POST['email'] . "'); // Agrega aquí tus datos
                            xhr.send(data);
                        }
                    });
                    </script>";
                    exit();
                } else {
                    echo "<script>
                    Swal.fire({
                    title: 'Ocurrio un error inesperado',
                    text: 'El correo electronico ingresado no es valido',
                    type: 'error',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            location.href = 'recuperarContra';
                        }
                        })
                    </script>";
                    exit();
                }
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Ocurrio un error inesperado',
                    text: 'El correo electronico ingresado no es valido',
                    type: 'error',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.value) {
                        location.href = 'recuperarContra';
                    }
                    })
                </script>";
                exit();
            }
        }
    } //Fin del controlador
}
