<?php
require_once "../../librerias/dompdf/autoload.inc.php";

require_once "../../config/APP.php";

use Dompdf\Dompdf;

// Verificar si se han recibido los datos del formulario
if (isset($_POST['fechaEntrega']) && isset($_POST['fechaDevolucion']) && isset($_POST['tiempoAlquiler'])) {
    // Obtener los valores del formulario
    $fechaEntrega = $_POST['fechaEntrega'];
    $fechaDevolucion = $_POST['fechaDevolucion'];
    $tiempoAlquiler = $_POST['tiempoAlquiler'];
    $nombreCliente = $_POST['nombreCliente'];
    $cedulaCliente = $_POST['cedulaCliente'];
    $nombreProducto = $_POST['nombreProducto'];

    ob_start(); // Iniciar el almacenamiento en el búfer

    // Crear el contenido HTML del contrato con los valores del formulario
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Contrato de Alquiler</title>
        <!-- Estilos CSS para cambiar el tamaño y la fuente del texto -->
        <style>
            body {
                font-family: Arial, sans-serif;
                /* Cambia la fuente del texto */
                margin: 0cm 0.4cm 0.5cm 0.5cm;
                text-align: justify;
                /* Alinea el texto justificado */

            }

            h1 {
                font-size: 10pt;
                /* Tamaño de fuente reducido para el encabezado */
                margin-bottom: 50px;
                margin-left: 510px;
                margin-right: 0px;
            }

            p {
                font-size: 8.5pt;
                /* Cambia el tamaño del texto a 12 puntos */

            }
            
            .linea{
              margin-left: 0px;
              margin-bottom: 0px;
              height: 0px;
              margin-right: 1px;
            }



            .huella-container {
                border: 1px solid black;
                width: 80px;
                height: 90px;
                text-align: center;
                margin-bottom: 10px;
                margin-left: 510px;
            }

            .elemento {
               width: 0%;
                margin-bottom: 10px;
                margin-left: 0px;
                margin-top: 0px;
                margin-right: 2px;
                text-align: left;
                float: left;

            }
            .elemento1 {
                width: 0%;
                margin-bottom: 10px;
                margin-left: 110px;
                margin-top: 0px;
                margin-right: 0%;
                text-align: left;
                float: left;

            }
            .elemento2 {
              width: 0%;
                margin-bottom: 10px;
                margin-left: 170px;
                margin-top: 0px;
                margin-right: 0%;
                text-align: left;
                float: left;
            }
            .elemento3 {
              width: 0%;
                margin-bottom: 10px;
                margin-left: 200px;
                margin-top: 0px;
                margin-right: 2px;
                text-align: left;
                float: left;

            }

            #logoAMU {
                width: 200px;
                /* Establece el ancho de la imagen */
                height: auto;
                /* La altura se ajusta automáticamente */
                margin-right: 20px;
                /* Ajusta el margen derecho para separar la imagen del texto */
                float: left;
                /* Hace que la imagen flote a la izquierda */
               
            }

            .informacion-container {
                margin: 50px;
                text-align: center;

            }
        </style>
    </head>

    <body>

        <img id="logoAMU" src="<?php echo SERVERURL; ?>vistas/img/logoAMU.jpg" alt="Logo de la empresa">

        <h1>Contrato de Arrendamiento</h1>
        <p>
        Yo, <?=$nombreCliente?> , mayor de edad, vecino de esta ciudad, identificado como aparece al pie de mi firma,
        actuando en nombre propio manifiesto pagar la suma de  _____________________________________________________________________ ($______________) MONEDA CORRIENTE,
        en sus oficinas de la ciudad de PALMIRA en razón al alquiler según contrato N° 0413 realizado al señor(a) <?=$nombreCliente?> identificado con documento de identidad <?= $cedulaCliente?>,
        expedida en PALMIRA, el día en que AYUDAS MÉDICAS UNIVERSALES o quien represente sus derechos o a quien esta designe, llene los espacios en blanco de acuerdo con la carta de instrucciones
        adjunta al presente pagaré, será así mismo la fecha de vencimiento, es decir el día ____ del mes de ____________ del _______. SEGUNDO: que en caso de cobro judicial correrán por mi cuenta todas las costas 
        y los gastos de cobranzas. Los honorarios de abogados lo estimamos en un quince por ciento (15%) de las sumas adeudadas de capital e intereses para cobro extrajudicial, y en cobro judicial en un veinticinco por ciento (25%)
        de las sumas adeudadas de capital e intereses. TERCERO: que, en caso de mora en el pago de la obligación, reconoceré al acreedor intereses moratorios liquidados a la tasa máxima vigente permitida por la ley. CUARTO: que estará a mi cargo, 
        el valor toral del impuesto de timbre gravare el presente documento.



        </p>
        <p>Para constancia se firma en la ciudad de PALMIRA a los días <?=$fechaEntrega?>.</p>
        <p>DEUDOR</p>


        <div class='huella-container'>
            <!-- Aquí el espacio para que la persona ponga su huella -->
        </div>

        <div class='linea'>
        <p>_________________  </p>
        </div>

        <div class="elemento">
            <p>Firma</p>
        </div>
        <div class='linea'>
        <p>_________________  </p>
        </div>

        <div class="elemento1">
            <p>Identificacion</p>
        </div>
        <div class='linea'>
        <p>_________________  </p>
        </div>
        
        <div class="elemento2">
            <p>Direccion</p>
        </div>
        <div class='linea'>
        <p>_________________  </p>
        </div>
        <div class="elemento3">
            <p>Telefono</p>
        </div>

        <div class='informacion-container'>
            <p>INFORMACIÓN: Carrera 27 # 31 -32 Teléfono 602 2871300 Cel.: 3006137041 </p>
            <p>impreso: <?= $fechaEntrega ?>
        </div>



    </body>

    </html>
    <?php

    $html = ob_get_clean(); // Obtener el contenido del búfer y limpiar el búfer

    $dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Establecer el tamaño del papel y la orientación (retrato)
    $dompdf->render();
    $dompdf->stream("contrato_alquiler_" . date('Y-m-d') . ".pdf", array("Attachment" => true));
} else {
    echo "Error: No se han recibido los datos del formulario.";
}
?>