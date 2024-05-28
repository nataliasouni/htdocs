<?php

require_once "../config/SERVER.php";
require_once "../config/conexion.php";
require_once "../vendor/PHPMailer.php"; // Ruta real donde se encuentra PHPMailer.php
require_once "../vendor/SMTP.php"; // Ruta real donde se encuentra PHPMailer.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    //Funcion para generar la nueva contraseña
    function generarContrasena()
    {
        $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/";
        $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+";
        $password = "";
        while (!preg_match($patron, $password)) {
            $password = "";
            $longitudPassword = 12;
            for ($i = 0; $i < $longitudPassword; $i++) {
                $indice = random_int(0, strlen($caracteres) - 1);
                $password .= $caracteres[$indice];
            }
        }
        return $password;
    }

    //Funcion para encryptar contraseña
    function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    //Nueva contraseña generada
    $passwordCambiada = generarContrasena();

    //Nueva contraseña encryptada
    $passwordCambiadaEncryptada = encryption($passwordCambiada);

    $sql = $conexion->prepare("UPDATE usuario
    SET contrasena = :Contrasena
    WHERE email = :Correo
    ");
    $sql->bindParam(":Contrasena", $passwordCambiadaEncryptada);
    $sql->bindParam(":Correo", $_POST['correo']);
    $sql->execute();

    //Verificar si se hizo el cambio
    if ($sql->rowCount() == 1) {
        $correo = $_POST['correo'];
        $destinatario = $correo;
        $mail = new PHPMailer(true); // Lanza una excepción en caso de error
        $asunto = "Cambio de contraseña";
        $mensaje = '<html>
            <body style="background: #D8EAFF; padding:20px;">
                <div style="text-align: center;">
                </div>
                <h1 style="text-align: center; font-size: 20px; color: 002E63;">¡Se ha actualizado tu contraseña!</h1>
                <p style="text-align: center; margin: 15px; font-size: 15px;">Estimado usuario, Tu contraseña ha sido cambiada con éxito</p>
                <p style="text-align: center; margin: 15px; font-size: 15px;">A continuación, te proporcionamos tu nueva contraseña:</p>
                <div style="text-align: center; margin: 15px; font-size: 15px;">
                    <p style="display: inline;">contraseña: </p>
                    <p style="border: 1px solid black; background-color: white; display: inline-block; padding: 5px;">' . $passwordCambiada . '</p>
                </div>
                <p></p>
                <p style="text-align: center; margin: 15px; font-size: 15px;">Cualquier conflicto con tu inicio de sesión, comunícate al correo del equipo de soporte: correoSoporte@gmail.com</p>
                <p style="text-align: center; margin: 15px; font-size: 15px;">Saludos, Equipo de soporte</p>
            </body>
        </html>';
        $headers = "From: dianacarolinarodriguezcalle@gmail.com" . "\r\n" . "Reply-To:dianacarolinarodriguezcalle@gmail.com" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dianacarolinarodriguezcalle@gmail.com'; // Tu dirección de correo electrónico de Gmail
            $mail->Password = 'ffqudepmgstnkvgg'; // Tu contraseña de Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;            

            // Configuración del correo
            $mail->setFrom('dianacarolinarodriguezcalle@gmail.com', 'Tu Nombre');
            $mail->addAddress($destinatario);
            $mail->isHTML(true);
            $mail->Subject = 'Cambio de contraseña';
            $mail->Body = $mensaje;

            // Envío del correo
            $mail->send();

            $response = array('status' => 'success', 'message' => 'Acción completada con éxito');
            echo json_encode($response);
            exit();
        } catch (Exception $e) {
            $response = array('status' => 'error', 'message' => 'La acción no se ha completado correctamente: ' . $mail->ErrorInfo);
            echo json_encode($response);
            exit();
        }

    } else {
        $response = array('status' => 'error', 'message' => 'La accion no se ha completado correctamente');
        echo json_encode($response);
        exit();
    }
}
