<?php

function getRutaEnlace() {
    $enlaceActual = $_POST['rutaEnlace'];

    return $enlaceActual;
}

function setImage() {
    $nameUsuario = $_POST['nameUsuario'];
    // Variable con la cantidad de imagenes a subir
    $numImagenes = 3;

    // bucle para recorrer cada selector
    for ($i = 1; $i <= $numImagenes; $i++) {
        // variable que crea el name del selector html
        $txtNombre = 'imagen' . $i;

        // Si el nombre del archivo es distinto de ""
        if ($_FILES[$txtNombre]['name'] != "") {
            // Recuperamos el nombre de la imagen
            $nombreImagen = $_FILES[$txtNombre]['name'] . "<br>";
            // dividimos la cadena de texto por el punto para descartar la extensión que sea.
            $trozos = explode(".", $nombreImagen);
            // Se crea la ruta de la carpeta donde se guardará la imagen
            $rutaImagen = "imagenes/" . $nameUsuario . "/" . $trozos[0];

            // Usamos la extensión Fileinfo para comprobar que el tipo MIME
            //sea correcto (que sea una imagen)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            $ext = array_search(
                    finfo_file($finfo, $_FILES[$txtNombre]['tmp_name']), array('jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif')
            );
            // Si no es una imagen, acabamos
            if ($ext === false) {
                echo "Imagen " . $i . ' imagen no reconocida.' . "<br>";
            } else {
                // Renombramos y movemos la imagen recibida a su localización definitiva
                $res = move_uploaded_file($_FILES[$txtNombre]['tmp_name'], $rutaImagen . "." . $ext);
                echo "Imagen " . $i . ' subida correctamente.' . "<br>";
            }
        } else {
            switch ($_FILES[$txtNombre]['error']) {
                case UPLOAD_ERR_OK: // Todo correcto
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "Imagen " . $i . ' no se recibió el archivo.' . "<br>";
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "Imagen " . $i . ' tamaño del archivo demasiado grande.' . "<br>";
                    break;
                default:
                    echo "Imagen " . $i . ' error desconocido.' . "<br>";
                    break;
            }
        }
    }
}

setImage();
?>
<form action="<?php echo getRutaEnlace() ?>" method="post">
    <input type="submit" value="Atras">
</form>
