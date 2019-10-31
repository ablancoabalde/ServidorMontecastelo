<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2 Función</title>

    </head>
    <body>

        <?php
        // Guardamos en una variable el valor escrito en el txtNumber del formulario
        $num = $_POST['txtNumber'];
        echo "<p> Número recibido del formulario " . $num . "</p>";

        // Functión que recibe 2 valores, el valor del número introducido por teclado 
        // y la función que va a desempeñar ( es una forma para sobrecargar una funcíon en PHP)
        // ya sea una raíz, cubo o una suma.
        function getAritmetica($num, $funcion) {

            switch ($funcion) {
                case "raiz":
                    return sqrt($num);

                case "cubo":
                    return pow($num, 3);
                case "suma":
                    return $num += $num;
            }
        }
        ?>

        <h3>a. Invoque una función para que devuelva la raíz cuadrada de ese número.</h3>
        <?php
        
        echo "La raíz cuadrada del número " . $num . " es " . getAritmetica($num, "raiz");
        ?>

        <h3>b. Invoque una función para que devuelva el cubo de ese número. (0.5 puntos)</h3>

        <?php
        echo "El cubo del número " . $num . " es " . getAritmetica($num, "cubo");
        ?>

        <h3>c. Invoque una función que reciba por referencia el número y lo modifique.
            Que pinte el número antes y después de entrar en la función (1.5 puntos)</h3>

        <?php
        echo "La suma del número " . $num . " es " . getAritmetica($num, "suma");
        ?>


    </body>
</html>
