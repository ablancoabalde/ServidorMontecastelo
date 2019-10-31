<?php

// Funciones get para obtener el nombre en cualquier lugar
function getName() {
    // Comprobamos si contiene algo la caja de texto
    if (isset($_POST['txtNewName'])) {
        // Con trim elemininamos cualquier espacio metido a más.
        $nombre = trim($_POST['txtNewName']);
        // función para pasar el nombre a minúsculas
        $nombre = strtolower($nombre);
        // función para pasar la primera letra de la palabra a mayúsculas 
        $nombre = ucfirst($nombre);
        return $nombre;
    }
}

function getPassword() {
    if (isset($_POST['txtNewPassword'])) {
        $password = trim($_POST['txtNewPassword']);
        return $password;
    }
}

function getRePassword() {

    if (isset($_POST['txtRePassword'])) {
        $repassword = trim($_POST['txtRePassword']);
        return $repassword;
    }
}

// función para comprobar que el nombre cumple las condiciones para ser guardado, le pasamo el nombre
function setCorrectName($nombre) {

    // Expresión regular /^[a-zA-Z0-9_-]{4,12}$/ letras Mayúsculas y minúsculas, números y guiones (bajos y altos),
    $expRegular = "/^[a-zA-Z0-9_-]{4,12}$/";
    // Si la expresión comprueba que el nombre está correcto y llama a la función comprobar password, si no muestra un mensaje de que error
    if (preg_match($expRegular, $nombre)) {
        // llamada a la función
        setPassword(getPassword(), getRePassword());
    } else {
        ?>
        <h4>Su nombre contiene caracteres especiales no validos.</h4>
        <button type = 'button' onclick = 'functionReturn()'>Atras</button>

        <script>
            function functionReturn() {
                location.replace("http://localhost/Boletin2/Ejercicio3.php")
            }
        </script>
        <?php
    }
}

// función para comprobar que la password cumple las condiciones para ser guardado, le pasamo las contraseñas
function setPassword($password, $repassword) {
    // Expresión regular ^.{6,}$ minímo 6 caracteres.
    $expRegular = "/^.{6,}$/";
    // Si la expresión comprueba que el nombre está correcto y llama a la función comprobar password, si no muestra un mensaje de que error
    if (preg_match($expRegular, $password) && preg_match($expRegular, $repassword) && ($password == $repassword)) {
        setExistFile(getName());
    } else {
        ?>
        <h4>Error en la contraseña.</h4>
        <button type = 'button' onclick = 'functionReturn()'>Atras</button>

        <script>
            function functionReturn() {
                location.replace("http://localhost/Boletin2/Ejercicio3.php")
            }
        </script>
        <?php
    }
}

// función para comprobar si una carpeta Existe, le pasamo el nombre
function setExistFile($nombre) {
    // Guardamos la ruta en una variable.
    $carpetaOrigen = 'imagenes/';
    // Comprobamos si la ruta de la carpeta no existe, con ruta de la carpeta + nombre 
    if (!file_exists($carpetaOrigen . $nombre)) {
        // La función mkdir (ruta,número octal especifica los permisos de lectura y escritura de la carpeta) crea un directorio especificado por un nombre de ruta.
        // octal 0600 Lectura y escritura para el propietario, nada para los demás
        // octal 0644 Lectura y escritura para el propietario, nada para los demás
        // octal 0755 Lectura y escritura para el propietario, nada para los demás
        // octal 0750 Lectura y escritura para el propietario, nada para los demás
        // octal 0777 Acceso más amplio posible.
        // Creamos la carpeta y en su interior un fichero password.txt
        mkdir($carpetaOrigen . $nombre, 0777);
        $rutaCarpeta = 'imagenes/' . $nombre;
        setSaveTxt($rutaCarpeta, getPassword());
        echo "<h4>Carpeta creada para el nuevo usuario: " . $nombre . ".</h4>";
        ?>

        <button type = 'button' onclick = 'functionReturn()'>Atras</button>

        <script>
            function functionReturn() {
                location.replace("http://localhost/Boletin2/Ejercicio3.php")
            }
        </script>
        <?php
    } else {
        ?>
        <h4>El usuario ya existe.</h4>
        <button type = 'button' onclick = 'functionReturn()'>Atras</button>

        <script>
            function functionReturn() {
                location.replace("http://localhost/Boletin2/Ejercicio3.php")
            }
        </script>
        <?php
    }
}

// función que crea y guarda la password en un archivo txt
function setSaveTxt($rutaCarpeta, $password) {
    // fopen, abre y si existe el txt y si no lo crea con el nombre especificado
    // le pasamos la ruta donde crear /imagenes/nombreEscrito/nombreEscrito.txt
    // la W es el modo, en este caso es escritura. todo se almacena en una variable
    // para luego operar con este archivo y añadirle texto
    $archivo = fopen($rutaCarpeta . "/" . getName() . ".txt", "w");
    // fwrte escribe en el archivo, lo que le indiquemos en este caso,
    //  la password
    if (fwrite($archivo, $password)) {
        echo "Se ha ejecutado correctamente";
    } else {
        ?>
        <h4>Ha habido un problema al crear el archivo.</h4>
        <button type = 'button' onclick = 'functionReturn()'>Atras</button>

        <script>
            function functionReturn() {
                location.replace("http://localhost/Boletin2/Ejercicio3.php")
            }
        </script>
        <?php
    }

// Cerramos el txt
    fclose($archivo);
}

setCorrectName(getName());
?>
