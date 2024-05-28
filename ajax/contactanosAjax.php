<?php
require_once "../config/SERVER.php";
require_once "../config/conexion.php";
require_once "../vendor/PHPMailer.php"; // Ruta real donde se encuentra PHPMailer.php
require_once "../vendor/SMTP.php"; // Ruta real donde se encuentra PHPMailer.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Dirección de correo electrónico a la que se enviará la notificación
    $destinatario = 'dianacarolinarodriguezcalle@gmail.com';

    // Configurar PHPMailer
    $mail = new PHPMailer(true); // True para habilitar excepciones

    try {
        // Configurar el servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dianacarolinarodriguezcalle@gmail.com'; // Tu dirección de correo electrónico de Gmail
        $mail->Password = 'ffqudepmgstnkvgg'; // Tu contraseña de Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configurar remitente y destinatario
        $mail->setFrom($email, $nombre);
        $mail->addAddress($destinatario);

        // Asunto y cuerpo del correo electrónico
        $asunto = 'Mensaje de contacto de ' . $nombre;
        $cuerpoMensaje = "
            <html>
            <head>
                <title>$asunto</title>
            </head>
            <body style='font-family: Arial, sans-serif;'>
                <div style='background-color: #f4f4f4; padding: 20px;'>
                    <h2 style='color: #333;'>¡Hola!</h2>
                    <p style='color: #333;'>Has recibido un mensaje de contacto desde el formulario de tu sitio web:</p>
                    <ul style='list-style-type: none; padding: 0;'>
                        <li><strong>Nombre:</strong> $nombre</li>
                        <li><strong>Correo electrónico:</strong> $email</li>
                        <li><strong>Mensaje:</strong></li>
                    </ul>
                    <div style='background-color: #fff; border: 1px solid #ccc; padding: 10px;'>
                        <p>$mensaje</p>
                    </div>
                </div>
            </body>
            </html>
        ";

        // Configurar correo electrónico como HTML
        $mail->isHTML(true);

        // Establecer asunto y cuerpo del correo electrónico
        $mail->Subject = $asunto;
        $mail->Body = $cuerpoMensaje;

        // Enviar el correo electrónico
        $mail->send();

        // Éxito al enviar el correo electrónico
        echo json_encode(array('status' => 'success', 'message' => 'Mensaje enviado correctamente.'));
    } catch (Exception $e) {
        // Error al enviar el correo electrónico
        echo json_encode(array('status' => 'error', 'message' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.'));
    }
} else {
    // Si no se ha enviado el formulario de manera correcta
    echo json_encode(array('status' => 'error', 'message' => 'Error al procesar el formulario.'));
}
?>
