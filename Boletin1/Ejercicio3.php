<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <form action="">

            <input type="submit" value="Colocar Minas"> </input>

        </form>

        <?php
        $pared = "|";
        $asterisco = "*";
        $punto = ".";
        $matriz [][] = array();
        $posicionesBombas = array();

        // Genero 2 bucles para llenar todas las posiciones de la matriz con puntos.
        for ($i = 1; $i <= 20; $i++) {
            for ($j = 1; $j <= 20; $j++) {

                $matriz [$i][$j] = $punto;
            }
        }
        /*
         *  Creo otro bucle limite 10, para que se creen
         *  10 posiciones e intercambien los puntos por asteriscos
         */
        for ($k = 0; $k <= 9; $k++) {
            $numAzar1 = rand(1, 20);
            $numAzar2 = rand(1, 20);

            $matriz [$numAzar1][$numAzar2] = $asterisco;
            $posicionesBombas[] = $numAzar1 . " " . $numAzar2;
        }
        // Genero 2 bucles para pintar el tablero con sus bombas
        for ($i = 0; $i <= 20; $i++) {
            echo $i . " ";
            for ($j = 1; $j <= 20; $j++) {
                /* 
                 * Condición para pintar los números de la 
                 * parte superior del tablero cuándo es la primera fila
                 * si no, pinta el tablero normal
                 */
                if ($i == 0) {
                    echo "" . $j . " ";
                } else {
                    echo $pared . " " . $matriz[$i][$j] . " ";
                }
            }
            echo $pared . "<br>";
        }
        /*
         *  Indica las posiciones de las bombas y con la pos indica
         * que bomba es; 
         */
        $pos = 1;
        foreach ($posicionesBombas as $value) {

            echo "Posición de la bomba " . $pos . " :" . $value;
            echo "<br>";
            $pos++;
        }
        ?>

    </body>
</html>
