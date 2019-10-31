<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2</title>
    </head>
    <body>
        <form action="">
            <p>Tabla del:
                <input type="text" name="txtNum"> </input>
                <input type="submit" value="Multiplicar"> </input>
            </p>

        </form>

        <?php
        // Guardamos la variable introducida en la caja de texto
        $txtValue = $_GET["txtNum"];

        /* Hacemos un bucle que valla del 1 al 10, para mostrarlos 
         * por pantalla y usarlo para multiplicarlo por el número recibido.
         */
        for ($i = 1; $i <= 10; $i++) {

            echo $i . " * " . $txtValue . " = " . ($i * $txtValue);
            echo "<br>";
        }
        ?>

    </body>
</html>
