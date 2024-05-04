<?php
require_once "../../config/APP.php";

session_start(['name' => 'AMU']);

switch ($_SESSION['permiso']) {
    case "Master":
    case "Administrador":
        break;
    default:
        session_unset();
        session_destroy();
        header("Location: " . SERVERURL);
        break;
}

ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Contrato</title>
    <!-- Links bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>pdfs/contrato/contratoPDF.css">
</head>

<body>
    <?php
    require_once "../../config/conexion.php";

    $sql = $conexion->prepare("SELECT * FROM cliente ORDER BY id_cliente ASC");
    $sql->execute();
    $clientes = $sql->fetchAll();

    $fecha = date('d/m/Y');
    ?>

    <h1 class="tituloPDF">
        <img src="<?= SERVERURL ?>vistas/img/logoamu.png" alt="Logo de la empresa" style="height: 2em; vertical-align: middle;">
        Listado de Clientes - <?= $fecha ?>
    </h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Item</th>
                <th>Cedula / Nit</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Producto de interes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $key => $cliente) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $cliente['cedula_cliente']; ?></td>
                    <td><?php echo $cliente['nombre_cliente']; ?></td>
                    <td><?php echo $cliente['tipo_cliente']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $cliente['telefono']; ?></td>
                    <td><?php echo $cliente['productos_de_interes']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Scripts bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$html = ob_get_clean();
/* echo $html; */

require_once "../../librerias/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'Landscape');

$dompdf->render();

$dompdf->stream("contrato.pdf", array("Attachment" => true));


?>