<?php

require_once 'carta.php';
require_once 'barajaCartas.php';

abstract class Baraja implements BarajaCartas {

    // Metodos Abstractos
    abstract public function crearBaraja();

    // Función implementada de la interfaza BarajaCartas
    // Recibe 2 barajas, con el metodo get_class() nos dice la clase de la 
    // baraja las compara
    function compare($baraja1, $baraja2) {
        if (get_class($baraja1) == get_class($baraja2)) {
            echo '<h2>Las barajas son iguales</h2>';
        } else {
            echo '<h2>Las barajas no son iguales</h2>';
        }
    }

}
