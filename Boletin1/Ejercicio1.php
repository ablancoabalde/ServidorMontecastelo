
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <?php
        $matrizNum = array(4, 2, 8, 6);

        // Muestra los valores de la matriz separados por comas
        echo "Los valores introducidos son: " . implode(",", $matrizNum) . " ";
        echo "<br>";
        // Suma el valor de todos los números y los muestra por pantalla
        echo "La suma de los valores es: " . array_sum($matrizNum) . ".";
        echo "<br>";
        // Realiza la media del valor total y la muestra por pantalla
        echo "La media de los valores es: " . array_sum($matrizNum) / count($matrizNum) . ".";
        echo "<br>";
        // Muestra el valor más grande de la matriz
        echo "El valor más grande es: " . max($matrizNum) . ".";
        echo "<br>";
        // Muestra el valor más pequeño de la matriz
        echo "El valor más pequeño es: " . min($matrizNum) . ".";
        ?>
    </body>
</html>



