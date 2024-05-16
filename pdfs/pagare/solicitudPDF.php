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
                margin-top: 2%;

                margin-bottom: 50px;

                text-align: center;

            }

            h2 {
                font-size: 10pt;
                /* Tamaño de fuente reducido para el encabezado */
                margin-top: 10%;

                margin-bottom: 20px;

                text-align: center;

            }

            p {
                font-size: 8.5pt;
                /* Cambia el tamaño del texto a 12 puntos */
                text-align: justify;
                margin: 0;
                /* Elimina el margen predeterminado de los párrafos */
                line-height: 1.2;
                /* Establece la altura de línea para controlar el espaciado entre líneas */


            }







            .huella-container {
                border: 1px solid black;
                width: 80px;
                height: 90px;
                text-align: center;
                margin-top: 10px;
                margin-bottom: 0%;
                margin-left: 450px;
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
                margin-bottom: 0px;
                margin-left: 120px;
                margin-top: 0px;
                margin-right: 0%;
                text-align: left;
                float: left;

            }

            .elemento2 {
                width: 0%;
                margin-bottom: 0px;
                margin-left: 120px;
                margin-top: 0px;
                margin-right: 0%;
                text-align: left;
                float: left;
            }

            .elemento3 {
                width: 0%;
                margin-bottom: 0px;
                margin-left: 100px;
                margin-top: 0px;
                margin-right: 2px;
                text-align: left;
                float: left;

            }

            .elemento4 {
                width: 30%;
                margin-bottom: 0px;
                margin-left: 100px;
                margin-top: 10px;
                margin-right: 50px;
                text-align: left;
                float: left;

            }


            .deudor {
                margin-bottom: 0%;
                height: 0%;
            }

            .informacion-container {
                width: 500px;
                margin-top: 0px;
                margin-left: 200px;
                margin-right: 200px;

                text-align: center;

            }
            .impreso{
                margin-top: 10%;
                text-align: center;
                margin-left: 38%;
                
            }

        
        </style>
    </head>

    <body>



        <h1>PAGARÉ A LA ORDEN No. 0413
            PARA EL CONTRATO DE ALQUILER No. 0413
        </h1>
        <p>
            Yo, <?= $nombreCliente ?> , mayor de edad, vecino de esta ciudad, identificado como aparece al pie de mi firma,
            actuando en nombre propio manifiesto pagar la suma de
            _____________________________________________________________________ ($______________) MONEDA CORRIENTE,
            en sus oficinas de la ciudad de PALMIRA en razón al alquiler según contrato N° 0413 realizado al señor(a)
            <?= $nombreCliente ?> identificado con documento de identidad <?= $cedulaCliente ?>,
            expedida en PALMIRA, el día en que AYUDAS MÉDICAS UNIVERSALES o quien represente sus derechos o a quien esta
            designe, llene los espacios en blanco de acuerdo con la carta de instrucciones
            adjunta al presente pagaré, será así mismo la fecha de vencimiento, es decir el día ____ del mes de ____________
            del _______. SEGUNDO: que en caso de cobro judicial correrán por mi cuenta todas las costas
            y los gastos de cobranzas. Los honorarios de abogados lo estimamos en un quince por ciento (15%) de las sumas
            adeudadas de capital e intereses para cobro extrajudicial, y en cobro judicial en un veinticinco por ciento
            (25%)
            de las sumas adeudadas de capital e intereses. TERCERO: que, en caso de mora en el pago de la obligación,
            reconoceré al acreedor intereses moratorios liquidados a la tasa máxima vigente permitida por la ley. CUARTO:
            que estará a mi cargo,
            el valor toral del impuesto de timbre gravare el presente documento.



        </p>
        <br>
        <p>Para constancia se firma en la ciudad de PALMIRA a los días <?= $fechaEntrega ?>.</p>
        <br>
        <div class="deudor">
            <p>DEUDOR</p>
        </div>

        <div class='huella-container'>
            <!-- Aquí el espacio para que la persona ponga su huella -->
        </div>


        <div class="elemento">
            <p>__________________</p>
            <p>Firma</p>
        </div>


        <div class="elemento1">
            <p>_________________</p>
            <p>Identificacion</p>
        </div>


        <div class="elemento2">
            <p>______________</p>
            <p>Direccion</p>
        </div>

        <div class="elemento3">
            <p>______________</p>
            <p>Telefono</p>
        </div>

        <div class="elemento4">

            <p>Huella índice derecho</p>
        </div>




        <h2>CARTA DE INSTRUCCIONES PARA DILIGENCIAR EL PAGARÉ N° 0413</h2>

        <p>Señores</p>
        <p> AYUDAS MÉDICAS UNIVERSALES</p>
        <p>Palmira</p>
        <br>


        <p>
            Yo,  <?= $nombreCliente ?> identificado como aparece al pie de mi firma, actuando en nombre propio;
            autorizo a AYUDAS MÉDICAS UNIVERSALES para que haciendo uso de las facultades conferidas por el artículo 622 del
            Código de Comercio,
            llene los espacios que se han dejado en blanco en el pagaré N° 0413 que se acompaña en esta carta, para lo cual
            deberá ceñirse a las siguientes instrucciones:
            <br>
            <br>

            1. El pagare podrá ser llenado por AYUDAS MÉDICAS UNIVERSALES, en caso de mora o incumplimiento de una o
            cualquiera de las obligaciones a mi cargo y a favor de la misma, sin importar el origen de la naturaleza de
            ella(s), en caso de embargo por cualquier causa o inicio del procedimiento de liquidación obligatoria. 2. El
            valor del pagaré que de acuerdo con las instrucciones aquí impartidas llene AYUDAS MÉDICAS UNIVERSALES, será
            igual al monto de las sumas que este adeudándoles por concepto de capital y/o intereses de mora. 3. La fecha de
            vencimiento será aquella en que sean llenados los espacios dejados en blanco y serán exigibles inmediatamente
            todas las obligaciones todas las obligaciones en el contenidas a mi cargo, sin necesidad de que se me requiera
            judicial o extrajudicial para su cumplimiento. 4. El lugar de pago del título será la ciudad de PALMIRA en las
            oficinas AYUDAS MÉDICAS UNIVERSALES. 5. El documento así llenado presta merito ejecutivo, pudiendo AYUDAS
            MÉDICAS UNIVERSALES exigir su pago por la vía judicial, sin perjuicio de las demás acciones que pudiera tener.
            6. Las presentes instrucciones se imparten de conformidad con lo dispuesto con el artículo 622 del Código de
            Comercio y para todos los efectos allí previstos.
            <br>
            <br>
            Para constancia se firma en la ciudad de PALMIRA a los días <?= $fechaEntrega ?>
            <br>
            <br>
            DEUDOR



        </p>

        <div class='huella-container'>
            <!-- Aquí el espacio para que la persona ponga su huella -->
        </div>


        <div class="elemento">
            <p>__________________</p>
            <p>Firma</p>
        </div>


        <div class="elemento1">
            <p>_________________</p>
            <p>Identificacion</p>
        </div>


        <div class="elemento2">
            <p>______________</p>
            <p>Direccion</p>
        </div>

        <div class="elemento3">
            <p>______________</p>
            <p>Telefono</p>
        </div>

        <div class="elemento4">

            <p>Huella índice derecho</p>
        </div>

        <div class = "impreso">
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