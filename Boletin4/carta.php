<?php

class Carta {

    private $numero;
    private $palo;
    private $barajaEsp = array();
    private static $numBarEsp = 12;
    private static $numBarFra = 13;
    private $barajaFra = array();

    // Sobrecarga metodo mágico constructor
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

    //ahora declaro una serie de métodos constructores que aceptan diversos números de parámetros
    // Constructor Crea la baraja francesa
    function __construct0() {
        // Baraja Francesa
        $matrizPalos = array("corazones", "diamantes", "picas", "treboles");
        foreach ($matrizPalos as $valor) {
            for ($i = 1; $i <= self::$numBarFra; $i++) {
                $this->barajaFra[] = new Carta($i, $valor);
            }
        }
    }

    // Constructor crea baraja española, recibe una $condición booleana que
    // indica si queremos introducir 8 y 9 en la baraja
    function __construct1($condicion) {
        // Baraja Española
        if ($condicion) {
            $matrizPalos = array("oros", "bastos", "espadas", "copas");
            // Bucle recorre la matrizPalos y le pasa el valor de esta al metodo,
            // llenarBaraja y la $condicion. Lo hago distino a la francesa, por cambiar.
            foreach ($matrizPalos as $valor) {
                $this->llenarBaraja($valor, $condicion);
            }
        } else {
            $matrizPalos = array("oros", "bastos", "espadas", "copas");
            foreach ($matrizPalos as $valor) {
                $this->llenarBaraja($valor, $condicion);
            }
        }
    }

    // función que almacena en un array barajaEsp los obj carta y según la 
    // condición puede ir con 8 y 9 o sin ellos
    function llenarBaraja($valor, $condicion) {
        
        // Si es true introduce 8 y 9 si no, no
        if ($condicion) {
            for ($i = 1; $i <= self::$numBarEsp; $i++) {
                $this->barajaEsp[] = new Carta($i, $valor);
            }
        } else {
            for ($i = 1; $i <= self::$numBarEsp; $i++) {
                if ($i != 8 and $i != 9) {
                    $this->barajaEsp[] = new Carta($i, $valor);
                }
            }
        }
    }

    function __construct2($numero, $palo) {
        // Carta individual
        $this->numero = $numero;
        $this->palo = $palo;
    }

    function getNumero() {
        return $this->numero;
    }

    function getPalo() {
        return $this->palo;
    }

    function getBarajaEsp() {
        return $this->barajaEsp;
    }

    function getBarajaFra() {
        return $this->barajaFra;
    }
    
    // función toString que recibe el objeto Carta y tipo( Se refiere si viene 
    // de la baraja española o de la francesa
    function toString(Carta $obj, $tipo) {

        if ($tipo == "esp") {

            $value = $obj->getPalo() . $obj->getNumero();
            return "  <img src=\"BarajaEsp/$value.png\" alt=\"$value\" title=\"$value\" width=\"140\" height=\"180\">";
        } else {
            $value = $obj->getPalo() . $obj->getNumero();

            return "  <img src=\"BarajaFra/$value.png\" alt=\"$value\" title=\"$value\" width=\"140\" height=\"180\">";
        }
    }

}
