<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Tecnica - Soporte Tecnico</title>

    <link rel="stylesheet" href="css/style.css">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/css/uikit.min.css" />
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit-icons.min.js"></script>

</head>
<body style="padding-top: 70px; padding-right: 450px; padding-left: 450px;">
    <div class="uk-container-xsmall uk-align-center">
        <div class="uk-card uk-card-default uk-animation-toggle uk-animation-fade">
            <div class="uk-card-media-top">
                <div class="uk-cover-container uk-height-medium">
                    <video src="upload\Logo.mp4" autoplay muted playsinline
                        uk-cover></video>
                </div>
            </div>
            <div class="uk-card-body">
                <center>
                    <h3>Ficha Tecnica <p class="uk-article-meta">Sistema de Soporte Tecnico</p></h3>
                </center>
                <form action="view/check.php" enctype="multipart/form-data" method="post">
                    <div class="js-upload uk-placeholder uk-text-center">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle">Adjunte el archivo AF-9 soltandolo aqui o </span>
                        <div uk-form-custom>
                            <input type="file" name="fileExcel" id="fileExcel" oninput="javascript:alert('El AF-9 se subio con Exito');">
                            <span class="uk-link">seleccione uno</span>
                        </div>
                    </div>

                    <div class="js-upload js-upload-img uk-placeholder uk-text-center">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle">Adjunte la fotografia del Acta Individual soltandolo aqui o </span>
                        <div uk-form-custom>
                            <input type="file" name="fileImagen" id="fileImagen" oninput="javascript:alert('La foto del Acta se subio con Exito');">
                            <span class="uk-link">seleccione uno</span>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <textarea class="uk-textarea" rows="5" placeholder="Observaciones Adicionales:" name="txtObservaciones"
                            maxlength="100"></textarea>
                    </div>
                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Crear Ficha</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>