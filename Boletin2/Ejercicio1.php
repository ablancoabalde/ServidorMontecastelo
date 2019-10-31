<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
        <!--        Estilo para la creación de la tabla-->
        <style>            
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
                text-align: left;    
            }
        </style>
    </head>
    <body>
        <h2>Escribe un programa PHP que, para cada número del 1 al 10:</h2>
        <h3>a. Invoque una función que muestre si el número es un número par o impar(1 puntos)</h3>
        <?php

        // Funcíon que comprueba si es par o impar
        function setParImpar() {

            $matrizPar = array();
            $matrizImpar = array();

            // Bucle para comprobar en este caso los números del  1 al 10
            for ($i = 1; $i <= 11; $i++) {
                // Sí el resto del número es 0 entonces el valor es Par en caso contrario es Impar
                if ($i % 2 == 0) {
                    array_push($matrizPar, $i);
                } else {
                    array_push($matrizImpar, $i);
                }
            }

            // Esta condición es para si se diera el caso de que una matriz es más larga que otra,
            // pues con la función array_pad agregamos posiciones al array menor, con valor vacío pero
            // podriamos poner cualquier valor ya sea número o texto.
            if (count($matrizPar) < count($matrizImpar)) {
                // Array_pad( matriz que llenaremos, tamaño que le daremos a más, y lo que queremos que agregue);
                $matrizPar = array_pad($matrizPar, count($matrizImpar), "");
            } else {
                $matrizImpar = array_pad($matrizImpar, count($matrizPar), "");
            }

            echo "<table>";
            echo "<tr>";
            echo "  <th> Par  </th>";
            echo "  <th> Impar </th>";
            echo "</tr>";
            // Genereramos filas a las tablas según valores tenga el array.
            for ($i = 0; $i < count($matrizPar); $i++) {
                echo "<tr >  <td>" . $matrizPar[$i] . "</td> <td>" . $matrizImpar[$i] . "</td>  </tr>";
            }

            echo "</table>";
        }

        setParImpar();
        ?>

        <h3>b. Invoque una función que muestre si el número es un número primo. (1 punto)</h3>

        <?php
        $matrizPrimo = array();
        $matrizNoprimo = array();

        // Bucle para comprobar en este caso los números del  2(primer número primo) al 10
        for ($i = 2; $i <= 10; $i++) {
            // Llamada a la función getPrimo pasandole el valor con la devolución de un booleano.
            if (getPrimo($i)) {
                array_push($matrizPrimo, $i);
            } else {
                array_push($matrizNoprimo, $i);
            }
        }

        // Esta condición es para si se diera el caso de que una matriz es más larga que otra,
        // pues con la función array_pad agregamos posiciones al array menor, con valor vacío pero
        // podriamos poner cualquier valor ya sea número o texto.
        if (count($matrizPrimo) < count($matrizNoprimo)) {
            // Array_pad( matriz que llenaremos, tamaño que le daremos a más, y lo que queremos que agregue);
            $matrizPrimo = array_pad($matrizPrimo, count($matrizNoprimo), "");
        } else {
            $matrizNoprimo = array_pad($matrizNoprimo, count($matrizPrimo), "");
        }

        // Función para ver si es primo
        function getPrimo($num) {
            // Variable auxiliar para comprobar si es primo
            $contador = 0;
            // Bucle que parte desde la primera opción 2 y el número que le llega.
            // Cualquier número primo es aquel que se divide por 1 y por sí mismo
            for ($i = 2; $i <= $num; $i++) {
                // Comprobamos de que si el resto del número recibido, divido entre los distintos valores es 0, suma 1
                if ($num % $i == 0) {
                    $contador++;
                }
            }
            // Tras recorrer todo el bucle si el contador es superior a 1, quiere decir que el número
            // tiene más de 1 divisor en este caso, porque estamos obviando dividir entre 1, pues el valor no es primo
            // de lo contrario el valor es primo
            if ($contador > 1) {
                return false;
            } else {
                return true;
            }
        }

        echo "<table>";
        echo "<tr>";
        echo "  <th> Primo  </th>";
        echo "  <th> No primo </th>";
        echo "</tr>";
        for ($i = 0; $i < sizeof($matrizPrimo); $i++) {
            echo "<tr >  <td>" . $matrizPrimo[$i] . "</td> <td>" . $matrizNoprimo[$i] . "</td>  </tr>";
        }
        echo "</table>";
        ?>

        <h3>c. Muestre esta información en una tabla HTML. (0.5 puntos)</h3>



    </body>
</html>
