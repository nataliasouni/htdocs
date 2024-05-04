<?php
// Cargar la biblioteca Dompdf
require_once '../../librerias/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Crear opciones de configuración para Dompdf
$options = new Options();
$options->setIsRemoteEnabled(true); // Permitir cargar imágenes desde URL

// Crear una instancia de Dompdf con las opciones de configuración
$dompdf = new Dompdf($options);

// Generar el contenido HTML de la vista
ob_start();
?>

<h1>hola</h1>

<?php
$html = ob_get_clean();

// Cargar el HTML en Dompdf
$dompdf->loadHtml($html);

// Opcional: Establecer opciones de renderizado
$dompdf->setPaper('A4', 'portrait'); // Ajusta el tamaño y la orientación del papel según tus necesidades

// Renderizar el HTML a PDF
$dompdf->render();

// Establecer el nombre del archivo y las opciones de descarga
$filename = 'detalles_solicitud.pdf';
$options = [
  'Attachment' => true,
];

// Enviar el PDF generado para su descarga
$dompdf->stream($filename, $options);
?>