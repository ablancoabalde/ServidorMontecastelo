<?php

require_once 'carta.php';
require_once 'baraja.php';

class BarajaEsp extends Baraja {

    const numeroCartas = 40;
    const numeroCartas8y9 = 48;
    // variable constante pues en la clase BarajaEsp, la baraja va a ser de tipo esp
    const tipoBaraja = "esp";

    private $barajaEsp = array();
    private $posCarta = 0;
    // Variable $condicion indica con True si queremos 8 y 9 en la baraja y false
    // para que las omita
    private $condicion;
    // La variable $numCartas dependerá de la condición, pues si contiene 8 y 9
    // serán 48 cartas de lo contrario serán 40
    public static $numCartas;

    function __construct() {

        //obtengo un array con los parámetros enviados a la función
        $params = func_get_args();

        //saco el número de parámetros que estoy recibiendo
        $num_params = func_num_args();

        //cada constructor de un número dado los parámetros tendrá un nombre de función        
        //atendiendo al siguiente modelo __construct1() __construct2()...
        $funcion_constructor = '__construct' . $num_params;

        //compruebo si hay un constructor con ese número de parámetros
        if (method_exists($this, $funcion_constructor)) {
            //si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    // Construye un objeto de la clase BarajaEsp con la una condíción
    function __construct1($condicion) {
        $this->condicion = $condicion;
    }

    // Función en la que se crea la baraja según $condición y setea la baraja
    // recibida en su propio arrayBaraja y setea el valor de $numCartas
    public function crearBaraja() {

        $condicion = $this->getCondicion();
        if ($condicion) {
            $carta = new Carta($condicion);
            $this->barajaEsp = $carta->getBarajaEsp();
            $this->setNumCartas(self::numeroCartas8y9);
        } else {
            $carta = new Carta($condicion);
            $this->barajaEsp = $carta->getBarajaEsp();
            $this->setNumCartas(self::numeroCartas);
        }
    }

    function getBarajaEsp() {
        return $this->barajaEsp;
    }

    function getPosCarta() {
        return $this->posCarta;
    }

    function setBarajaEsp($barajaEsp) {
        $this->barajaEsp = $barajaEsp;
    }

    function setPosCarta($posCarta) {
        $this->posCarta = $posCarta;
    }

    static function setNumCartas($numCartas) {
        self::$numCartas = $numCartas;
    }

    function getCondicion() {
        return $this->condicion;
    }

    function setCondicion($condicion) {
        $this->condicion = $condicion;
    }

    // Función barajar mezcla la posición de las cartas de manera aleatoria
    function barajar() {
        $array = $this->getBarajaEsp();
        // Función que mezcla el array.
        shuffle($array);
        $this->setBarajaEsp($array);
    }

    // Función que modifica la posición y muestra la carta siguiente almacenada en 
    // array $barajaEsp
    function sigCarta() {
        // Obtenemos la posición en la que se encuentra
        $posicion = $this->getPosCarta();

        // Condición de sí la posicíon( La cantidad de cartas que he sacado) es
        // mayor igual que la cantidad de cartas que hay
        if ($posicion >= self::$numCartas) {
            return "<h2> No hay más cartas </h2>";
        } else {
            // ($this->getBarajaEsp()[0]) esto es una objeto Carta por eso puede llamar al metodo toString()
            // es igual que $carta->toString()
            // El metodo toString de carta.php necesita 2 parametros el objeto Carta y el tipo de baraja si es esp o fra
            // $this->getBarajaEsp()[$posicion] esto es igual que  $barajaEsp[$posicion que queramos coger]
            $img = $this->getBarajaEsp()[0]->toString($this->getBarajaEsp()[$posicion], self::tipoBaraja);
        }
        // Al sacar una carta sumamos 1 a la posición inicial y lo seteamos
        $posicion++;
        $this->setPosCarta($posicion);
        return $img;
    }

    // Función que devuelve las cartas que quedan en la baraja, el calculo se
    // hace desde otra función pues la uso a lo largo del programa y así no repito código
    function cartasDispo() {

        return "<h2> Quedan " . $this->calcCartasDispo() . " cartas en la baraja </h2>";
    }

    // Función que calcula las cartar disponibles el total de cartas en la baraja
    // menos la posición(yo puse posición pero la variable se puede llamar cartasSacadas)
    function calcCartasDispo() {

        $calculo = self::$numCartas - $this->getPosCarta();

        return $calculo;
    }

    // Función que recibe un número de cartas que se quieran repartir
    // recuperamos la $posicion por si ya hubieran salido cartas, si es así 
    // reparte desde la última posicion de la última carta de lo contrario siempre
    // empezaría desde la primera carta de la baraja
    function repartirCartas($nCartas) {
        $posicion = $this->getPosCarta();
        // Condición que si el número de cartas que se le pide es mayor 
        // a la cartas en la baraja disponibles delvuelve un mensaje
        if ($nCartas > $this->calcCartasDispo()) {
            print "<h2>No quedan " . $nCartas . " cartas en la baraja para repartir </h2>";
        } else {
            print "<h2>Repartidas </h2>";
            // $i en este caso es 1 porque queramos sacar X cartas que enviemos de 1 a X
            // ejemp: Queremos sacar 5 cartas de 1 a 5 son 5 vueltas de 0 a 5 son 6 vueltas
            // que tambien se puede poner desde 0 sin problema siempre que nos acordemos de $nCartas
            // restarle 1
            for ($i = 1; $i <= $nCartas; $i++) {
                print $this->getBarajaEsp()[0]->toString($this->getBarajaEsp()[$posicion], self::tipoBaraja);
                $posicion ++;
            }
        }

        $this->setPosCarta($posicion);
    }

    // Función que muestra todas las cartas que ya han salido
    function cartasRepartidas() {
        $posicionNueva = 0;

        // Si no han salido cartas imprime mensaje
        if ($this->calcCartasDispo() == self::$numCartas) {
            print "<h2>No han salido cartas de la baraja</h2>";
        } else {
            print "<h2>Salieron </h2>";
            // i$ en este caso es el valor de la $posición si hubieramos sacado 5, pues sería 5
            // lleva el -1 porque la $posición es 0, lo que hacemos en este caso es que $posicionNueva
            // vaya aumentando su valor hasta llegar al valor de $posicion-1
            for ($i = ($this->getPosCarta() - 1); $posicionNueva <= $i;) {

                print $this->getBarajaEsp()[0]->toString($this->getBarajaEsp()[$posicionNueva], self::tipoBaraja);
                $posicionNueva ++;
            }

            // Otra forma de hacerlo
//            $posicion=($this->getPosCarta() - 1);
//            for ($i = 0; $i <= $posicion;$i++) {
//
//                print $this->getBarajaEsp()[0]->toString($this->getBarajaEsp()[$i], self::tipoBaraja);
//           
//            }
        }
    }

    // Función que muestra todas las cartas de la baraja menos las sacadas
    function mostrarbaraja() {
        print "<h2>Toda la baraja menos las sacadas</h2>";
        $posicion = $this->getPosCarta();

        // Obtenemos la $posición en la que se encuentra el $barajaEsp
        // $this->calcCartasDispo() es el valor de las cartas que quedan en la baraja        
        for ($i = 0; $i < $this->calcCartasDispo(); $i++) {

            print $this->getBarajaEsp()[0]->toString($this->getBarajaEsp()[$posicion], self::tipoBaraja);
            $posicion ++;
        }
    }

}
