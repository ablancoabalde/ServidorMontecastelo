<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 4</title>
    </head>
    <body>
        <form action="Ejercicio4.php">

            <input type="submit" value="Ordenar"> </input>

        </form>

        <form action="Ejercicio4-Desordenar.php">

            <input type="submit" value="Barajar"> </input>

        </form>

        <?php
        $matrizPalos = array("Oros", "Bastos", "Espadas", "Copas");
        $matrizValorCarta = array();
        $matrizBaraja = array();
        $saltoLinea = 10;
        $salto = 0;
        // Creamos 2 arrays para crear una matriz con el nombre de las cartas
        foreach ($matrizPalos as $valor) {
            for ($i = 1; $i <= 10; $i++) {
                $matrizBaraja[] = $valor . $i;
            }
        }
        // Función que mezcla el array.
        shuffle($matrizBaraja);
        // Recorremos la matriz para visualizar las cartas
        foreach ($matrizBaraja as $value) {
            // Condición que hace que cada 10 cartas haga un salta de línea
            if ($salto == $saltoLinea) {
                $saltoLinea += 10;
                echo "<br>";
            }
            $salto++;
            print "  <img src=\"cartas/$value.jpg\" alt=\"$value\" title=\"$value\" width=\"140\" height=\"140\">";
        }
        ?>

    </body>
</html>


