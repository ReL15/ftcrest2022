<?php
require_once __DIR__ . '../../vendor/autoload.php';

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

$direccionExcel = $_POST['txtExcel'];
$direccionImagen = $_POST['txtImagen'];
$comentarios = $_POST['txtComentario'];

$docExcel = IOFactory::load($direccionExcel);

# Seleccion de Hojas
$totalHojas = $docExcel->getSheetCount();
$hojaActual = $docExcel->getSheet(0);

$numeroFila = $hojaActual->getHighestDataRow();
$letra = $hojaActual->getHighestColumn();

$alumno = $hojaActual->getCellByColumnAndRow('3', '9');

$centroescolar = $hojaActual->getCellByColumnAndRow('3', '10');
$codigoCE = $hojaActual->getCellByColumnAndRow('8', '9');
$CE = $centroescolar.' - '. $codigoCE;

$sede = $hojaActual->getCellByColumnAndRow('3', '12');
$lugarfecha = $hojaActual->getCellByColumnAndRow('3', '21');
$observaciones = $hojaActual->getCellByColumnAndRow('3', '23');
$descripcion = $hojaActual->getCellByColumnAndRow('3', '26');
$marca = $hojaActual->getCellByColumnAndRow('6', '26');
$serie = $hojaActual->getCellByColumnAndRow('8', '26');

if ($marca != 'HP'){
    $proveedor = 'PBS';
} else {
    $proveedor = 'STB';
}

$pdf = new \Mpdf\Mpdf();

$pdf->useSubstitutions=false;
$pdf->setAutoTopMargin = 'stretch';
$pdf->SetDisplayMode('fullpage');

$pdf->SetDefaultBodyCSS('background', "url('". $direccionImagen ."')");
$pdf->SetDefaultBodyCSS('background-image-resize', 6);

$cuerpo = '
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br>
    <table class="uk-table" border=1 style="border: black 1cm solid; width: 30px; background-color: black; font-family: "Poppins", sans-serif;">
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>FECHA Y LUGAR</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $lugarfecha .'</td>
        </tr>
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>MARCA Y MODELO</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $descripcion .'</td>
        </tr>
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>SERIE</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $serie .'</td>
        </tr>
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>DETALLES DEL C.E.</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $centroescolar.' - '. $codigoCE .'</td>
        </tr>
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>SEDE</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $sede .'</td>
        </tr>
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>ALUMNO</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $alumno .'</td>
        </tr>
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>PROVEEDOR</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $proveedor .'</td>
        </tr>
        <tr>
            <td style="border: black 1cm solid; width: 4cm; background-color: white;"><b>OBSERVACIONES</b></td>
            <td style="border: black 1cm solid; width: 6cm; background-color: white;">'. $observaciones .'. '. $comentarios .'</td>
        </tr>
    </table>
';

$stylesheet = file_get_contents('..\css\style.css');
$pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$pdf->WriteHTML($cuerpo, 2);

$pdf->Output('acta_portada.pdf', 'D');
header("Location: ./");
die();
?>
