<?php

#FIXME: Subida de Archivos

#TODO: Subida de Imagenes
$dirImagen = '../upload';
$fileImagen = $_FILES['fileImagen']['name'];
$tmpfileImagen = $_FILES['fileImagen']['tmp_name'];
$nombreImagen = basename($fileImagen);

$ubicacion = move_uploaded_file($tmpfileImagen, "$dirImagen/$fileImagen");
$ubicacionImagen = "$dirImagen/$fileImagen";

if ($ubicacion) {
    #echo 'El Archivo se subio Correctamente';
} else {
    #echo 'El Archivo no se Subio';
}

#TODO: Subida de Excel
$dirExcel = '../upload';
$fileExcel = $_FILES['fileExcel']['name'];
$tmpfileExcel = $_FILES['fileExcel']['tmp_name'];
$archivoExcel = basename($fileExcel);

if (move_uploaded_file($tmpfileExcel, "$dirExcel/$fileExcel")) {
    #echo 'El Archivo se subio Correctamente';
} else {
    #echo 'El Archivo no se Subio';
}

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

$direccionExcel = "$dirExcel/$fileExcel";
$comentarios = $_POST['txtObservaciones'];

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Tecnica - Soporte Tecnico</title>

    <link rel="stylesheet" href="../css/style.css">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit-icons.min.js"></script>

</head>
<body style="padding-top: 70px;">
    <div class="uk-container uk-align-center uk-container-small">
        <h3>Ficha Tecnica <p class="uk-article-meta">Sistema de Soporte Tecnico</p>
        </h3>
        <div class="uk-grid-divider uk-child-width-expand@s" uk-grid>
            <div>
                <dl class="uk-description-list" id="data">
                    <dt>Fecha y Lugar</dt>
                    <dd><?php echo $lugarfecha; ?></dd>
                    <dt>Detalles del Equipo</dt>
                    <dd><?php echo $descripcion; ?></dd>
                    <dt>Serie</dt>
                    <dd><?php echo $serie; ?></dd>
                    <dt>Sede</dt>
                    <dd><?php echo $sede; ?></dd>
                    <dt>Detalles del Centro Escolar</dt>
                    <dd><?php echo $centroescolar.' - '. $codigoCE; ?></dd>
                    <dt>Detalles del Alumno</dt>
                    <dd><?php echo $alumno; ?></dd>
                    <dt>Proveedor</dt>
                    <dd><?php echo $proveedor; ?></dd>
                    <dt>Observaciones</dt>
                    <dd><?php echo $observaciones .' - '. $comentarios; ?></dd>
                </dl>
            </div>
            <div>
                <center><img data-src="<?php echo $ubicacionImagen; ?>" alt="" uk-img></center>
            </div>
        </div>
        <hr class="uk-divider-icon">
        <form action="../report/pdf.php" method="post">

            <input hidden type="text" value="<?php echo $ubicacionImagen; ?>" name="txtImagen" id="txtImagen">
            <input hidden type="text" value="<?php echo "$dirExcel/$fileExcel"; ?>" name="txtExcel" id="txtExcel">
            <input hidden type="text" value="<?php echo $comentarios; ?>" name="txtComentario" id="txtComentario">
            <button type="submit" class="uk-button uk-button-primary uk-button-large uk-width-1-1" download="pega.pdf">Generar PDF</button>
        </form>
    </div>
</body>
</html>
