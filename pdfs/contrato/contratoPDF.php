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

                margin-bottom: 60px;

                text-align: center;
            }

            h2 {
                font-size: 10pt;
                /* Tamaño de fuente reducido para el encabezado */
                margin-top: 10%;

                margin-bottom: 20px;

                text-align: center;

            }

            h3 {
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
                margin-bottom: 10px;
                margin-left: 450px;
            }

            .firma-container {
                text-align: center;
                margin-bottom: 0px;

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

                margin-left: 38%;
                text-align: center;

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



            .impreso {
                margin-top: 10%;
                text-align: center;
                margin-left: 38%;

            }

            .impreso2 {
                margin-top: 0%;
               
                text-align: center;
                margin-left: 38%;

            }
        </style>
    </head>

    <body>

        <img id="logoAMU" src="<?php echo SERVERURL; ?>vistas/img/logoAMU.jpg" alt="Logo de la empresa">

        <h1>Contrato de Arrendamiento</h1>
        <p>Entre los suscritos AYUDAS MÉDICAS UNIVERSALES identificada con NIT. 6386949-2 y representada legalmente por el
            señor WILLIAM FERNANDO VASQUEZ VELASCO
            identificado con documento de identidad 6386949 de PALMIRA, adelante se denomina como ARRENDADOR. Y
            <?= $nombreCliente ?> identificado(a) con C.C. o NIT. N°. <?= $cedulaCliente ?> y
            representado legalmente por el señor(a) <?= $nombreCliente ?> con cédula de ciudadanía N° <?= $cedulaCliente ?>
            de CIUDAD y quien en el presente contrato se denominará el
            ARRENDATARIO, hemos celebrado el siguiente contrato de arrendamiento; PRIMERO: a partir de hoy
            <?= $fechaEntrega ?> el ARRENDADOR hace entrega real y material a el ARRENDATARIO
            de los siguientes artículos: <?= $nombreProducto ?>; SEGUNDO: el término del contrato será pasado el periodo
            abajo estipulado a partir de la fecha de su firma una vez se haga devolución
            de los artículos y cancelado el total de la obligación por parte del arrendatario; y el valor del arrendamiento
            es de PRECIO, por un período de <?= $tiempoAlquiler ?> días.
            TERCERO: el ARRENDATARIO está obligado a devolver o cancelar el arrendamiento del siguiente período anticipando
            el primer día del nuevo período causado;
            CUARTO: el incumplimiento del pago se considera como violación del contrato por parte del ARRENDATARIO y se
            establece una cláusula penal de \$3000 diarios,
            y el ARRENDADOR puede exigir de inmediato la entrega del artículo. QUINTO: el contrato se considerará prorrogado
            por un tiempo igual, si pasados los primeros
            cinco días de vencido el contrato no se ha devuelto el artículo. SEXTO: el contrato será prorrogable por
            periodos iguales mientras el artículo este en poder del
            ARRENDATARIO y estará en la obligación de devolver el artículo y cancelar los períodos causados cuando el
            ARRENDADOR así lo crea conveniente.
            SÉPTIMO: el arrendatario dedicará el artículo para uso personal y no podrá darle destinación distinta a la
            estipulada, ni ceder el pago de esta obligación;
            cualquier reparación que el ARRENDATARIO hiciese en el artículo será por cuenta de estos y quedará de propiedad
            del ARRENDADOR.
            OCTAVA: el arrendatario deberá dejar como depósito la suma de \$50000, para cubrir los daños que se puedan
            presentar,
            ya que se consideran ellos los responsables de dichos daños por ser quienes están en posesión y uso del
            artículo.
            NOVENO: en caso de pérdida o daño parcial o total del artículo el ARRENDATARIO responderá por su valor, cuyo
            valor comercial es de \$550000.
            DIEZ: si el contrato se ha prorrogado hasta por seis periodos el depósito inicial cubrirá el mantenimiento del
            artículo. ONCE:
            el arrendatario garantizará el estricto cumplimiento de todas y cada una de las obligaciones aquí contraídas;
            además de comprometer su responsabilidad personal y
            solidaria, así como bienes de cualquier naturaleza que posean todos de manera limitada, constituirán a favor de
            la entidad acreedora la siguiente garantía específica:
            sueldos, prestaciones sociales, primas, bonificaciones, emolumentos, compensaciones, etc., a que tiene derecho
            como trabajadores, socios, etc.
            DOCE: en caso que durante el plazo señalado para el cumplimiento de la obligación se pactase cualquier prorroga,
            esta no podrá interpretarse
            como una renovación de las obligaciones y por lo tanto subsistirán durante ella, todos y cada uno de los
            compromisos que en este contrato estamos pactando de forma solidaria,
            pues por razón de tal prorroga, ninguna de las cláusulas pactadas en este instrumento sufrirá deterioro, ni
            modificación alguna.
            TRECE: “Autorizo a WILLIAM FERNANDO VASQUEZ VELASCO, AYUDAS MÉDICAS UNIVERSALES, CORFYSER y/o a quién represente
            sus derechos u ostente en el futuro la calidad de acreedor
            para que la información suministrada en el presente documento sea consultada, verificada y reporte por terceras
            personas incluyendo las entidades financieras,
            bases de datos o cualquiera otra con los mismos fines, pagos o incumplimientos, igualmente para que la misma sea
            usada y puesta en circulación con fines estrictamente
            comerciales, contractuales, crediticios y financieros a las diferentes centrales de riesgo a nivel nacional o
            internacional, reportando y actualizando
            mis comportamientos de pago o incumplimiento. CATORCE: autorizo a WILLIAM FERNANDO VASQUEZ VELASCO, AYUDAS
            MÉDICAS UNIVERSALES, CORFYSER y/o a quién represente sus
            derechos para que vía mensaje de texto, mail, marcación virtual (llamado con grabación automática), entre otros,
            se me notifique o comunique cualquier tipo de información
            o estado financiero con respecto a las obligaciones contraídas, información comercial, publicidad de los
            productos y servicios creados o logrados mediante convenios con
            otras entidades comerciales, constitución en mora, etc., ajustando a lo previsto en la LEY 527 de 1.999 y los
            decretos que la actualicen o modifiquen, por la cual se
            define y reglamenta el acceso y uso de los mensajes de datos. QUINCE: en caso de MORA se pagarán intereses a la
            tasa legal vigente mensual sin perjuicio de las acciones
            legales de la entidad acreedora. La mora en el pago de uno o más meses producirá la extinción del contrato y la
            entidad acreedora podrá exigir el pago total de la deuda,
            la devolución del artículo, así como los costos y costas por los honorarios de abogado los cuales se estiman en
            un quince por ciento (15%) de las sumas adeudadas
            de capital e intereses para cobro extrajudicial, y en cobro judicial en un veinticinco por ciento (25%) de las
            sumas adeudadas de capital e intereses por cobranza
            judicial y extrajudicial, si a ello se diere lugar; los cuales serán exigibles con la sola presencia de la
            respectiva demanda o por la primera gestión de cobro que
            dicho abogado realice. DIECISEIS: para todos los efectos legales y extrajudiciales a que este contrato pueda dar
            un lugar, declaramos desde ahora excusado su propuesta
            y como TITULO VALOR que es y por lo mismo tener calidad de instrumento negociable que habla el artículo 821 del
            código de comercio; no requiere cobranza,
            ni notificación de la sesión que de él pudiere hacerse a terceros. El ARRENDATARIO acepta las condiciones
            expuestas en el presente contrato y el retiro del producto
            por parte del ARRENDADOR sin notificación alguna al presentar mora de más de 60 días en la cancelación del canon
            de arrendamiento pactado. Para constancia se firma
            en la ciudad de Palmira, a los <?= $fechaEntrega ?>.
        </p>


        <div class='huella-container'>
            <!-- Aquí el espacio para que la persona ponga su huella -->
        </div>


        <div class='firma-container'>
            <p>Firma Arrendatario: _____________________ C.C. _____________________________ Huella índice derecho </p>
        </div>

        <div class="informacion-container">

        </div>
        <br>

        <p style="text-align : center">INFORMACIÓN: Carrera 27 # 31 -32 Teléfono 602 2871300 Cel.: 3006137041</p>



        <div class="impreso2">
           
            <p>impreso: <?= $fechaEntrega ?>
        </div>


        <h2>PAGARÉ A LA ORDEN No. 0413
            PARA EL CONTRATO DE ALQUILER No. 0413
        </h2>
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




        <h3>CARTA DE INSTRUCCIONES PARA DILIGENCIAR EL PAGARÉ N° 0413</h3>

        <p>Señores</p>
        <p> AYUDAS MÉDICAS UNIVERSALES</p>
        <p>Palmira</p>
        <br>


        <p>
            Yo, <?= $nombreCliente ?> identificado como aparece al pie de mi firma, actuando en nombre propio;
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

        <div class="impreso">
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