<?php
require_once "../../librerias/dompdf/vendor/autoload.php"; // Incluye el autoloader de Composer

use Dompdf\Dompdf;

// Verificar si se han recibido los datos del formulario
if(isset($_POST['fechaEntrega']) && isset($_POST['fechaDevolucion']) && isset($_POST['tiempoAlquiler'])) {
    // Obtener los valores del formulario
    $fechaEntrega = $_POST['fechaEntrega'];
    $fechaDevolucion = $_POST['fechaDevolucion'];
    $tiempoAlquiler = $_POST['tiempoAlquiler'];
    // Otros datos necesarios...

    // Crear el contenido HTML del contrato con los valores del formulario
    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Contrato de Alquiler</title>
        <!-- Aquí puedes agregar estilos CSS si es necesario -->
    </head>
    <body>
        <h1>Contrato de Alquiler</h1>
        <p>Fecha de Entrega: $fechaEntrega</p>
        <p>Fecha de Devolución: $fechaDevolucion</p>
        <p>Tiempo de Alquiler: $tiempoAlquiler días</p>
        <!-- Otros datos necesarios... -->

        <!-- Puedes agregar más contenido HTML según sea necesario -->

    </body>
    </html>
    ";

    // Crear una instancia de Dompdf
    $dompdf = new Dompdf();

    // Cargar el contenido HTML en Dompdf
    $dompdf->loadHtml($html);

    // Renderizar el PDF
    $dompdf->render();

    // Generar el nombre del archivo PDF (puedes personalizarlo según tus necesidades)
    $filename = 'contrato_alquiler_' . date('Y-m-d') . '.pdf';

    // Enviar el PDF al navegador para descargar
    $dompdf->stream($filename);
} else {
    
    echo "Error: No se han recibido los datos del formulario.";

}
?>