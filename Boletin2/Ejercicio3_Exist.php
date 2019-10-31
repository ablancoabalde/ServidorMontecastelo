<?php
// Funciones get para obtener el nombre en cualquier lugar
setSearchFile(getName());

function getRutaEnlace() {
    $enlaceActual = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $enlaceActual;
}

function getName() {
    // Comprobamos si contiene algo la caja de texto

    if (isset($_GET['txtName'])) {
        // Con trim elemininamos cualquier espacio metido a más.
        $nombre = trim($_GET['txtName']);
        // función para pasar el nombre a minúsculas
        $nombre = strtolower($nombre);
        // función para pasar la primera letra de la palabra a mayúsculas 
        $nombre = ucfirst($nombre);

        return $nombre;
    }
}

function getPassword() {
    if (isset($_GET['txtPassword'])) {
        $password = trim($_GET['txtPassword']);
        return $password;
    }
}

function getRutaCarpeta() {
    return 'imagenes/' . getName();
}

// función para buscar carpeta usuario, le pasamo el nombre
function setSearchFile($oNombre) {
    // Guardamos la ruta en una variable.
    $carpetaOrigen = 'imagenes/';
    // Comprobamos si la ruta de la carpeta no existe, con ruta de la carpeta + nombre 
    if (file_exists($carpetaOrigen . $oNombre)) {

        $nombreArchivo = $oNombre . ".txt";
        $passwordTxt = getReadTxt($nombreArchivo);
        setPassword($passwordTxt);
    } else {
        echo "<h4>El usuario no encontrado.</h4>";
    }
}

// función que leera el txt
function getReadTxt($nombreArchivo) {


    $rutaCarpeta = getRutaCarpeta() . "/" . $nombreArchivo;
    // abrimos el archivo y le indicamos el modo lectura
    $fp = fopen($rutaCarpeta, "r");
    // feof lee linea por linea el txt
    while (!feof($fp)) {
        $linea = fgets($fp);
    }
    fclose($fp);
    return trim($linea);
}

// función que comprobará si la contraseña introducida es igual a la del txt
function setPassword($passwordTxt) {
    if ($passwordTxt == getPassword()) {
        ?><html>
            <head>
                <meta charset="UTF-8">

                <title>Ejercicio 3</title>
                <link rel="stylesheet" href="css/myCss.css" type="text/css">
            </head>
            <body>
                <form enctype="multipart/form-data" action="Ejercicio3_new_imagenes.php" method="post">

                    <h2>Imagenes de   
                        <?php echo getName();
                        ?></h2>

                    <?php
                    // Guardamos la ruta de la carpeta en una variable
                    $directory = getRutaCarpeta();
                    // a función dir()leerá la carpeta  y nos retornará un Array de la clase Directory.
                    $dirint = dir($directory);
                    //  la variable $archivo tendrá la información de cada archivo de la carpeta,hasta que retorne false que parara de leer
                    while (($archivo = $dirint->read()) !== false) {
                        // preg_match — Realiza una comparación con una expresión regular y si la encuentra la muestra la imagen
                        // usamos el delimitador ‘i’ no se diferencian mayúsculas y minúsculas.
                        if (preg_match("/gif/i", $archivo) || preg_match("/jpg/i", $archivo) || preg_match("/png/i", $archivo)) {

                            echo '<img src="' . $directory . "/" . $archivo . '"   width="20%"
                             height="20%" style="margin: 3px;">';
                        }
                    }
                    $dirint->close();
                    ?>
                    <!-- Variables ocultar para pasarle el nombre y la ruta de regreso -->
                    <input type="hidden" name="nameUsuario" value="<?php echo getName() ?>" />
                    <input type="hidden" name="rutaEnlace" value="<?php echo getRutaEnlace() ?>" />

                    <h4>Añadir más imagenes:</h4>

                    <div class="txtsBox">
                        <label for="imagen1">Imagen 1:</label>  
                        <input id="imagen1" name="imagen1" type="file" >
                        <label for="imagen2">Imagen 2:</label>  
                        <input id="imagen2" name="imagen2" type="file" >
                        <label for="imagen3">Imagen 3:</label>  
                        <input id="imagen3" name="imagen3" type="file" >

                    </div>
                    <div class="buttonBox">
                        <input type="submit" value="Enviar">
                    </div>

                </form>

            </body>
        </html>

        <?php
    } else {
        ?>

        <h4>Contraseña incorrecta.</h4>
        <!-- botón con su función asociada para volver a la pagina de inicio-->
        <button type='button' onclick='functionReturn()'>Atras</button>

        <script>
            function functionReturn() {
                location.replace("http://localhost/Boletin2/Ejercicio3.php")
            }
        </script>
        <?php
    }
}
?>

<button type='button' onclick='functionReturn()'>Atras</button>

<script>
    function functionReturn() {
        location.replace("http://localhost/Boletin2/Ejercicio3.php")
    }
</script>