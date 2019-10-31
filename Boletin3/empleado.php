<?php

abstract class empleado {

    private $nombre;
    private $apellidos;
    private $ss;
    private $cantidadHoras = 25;
    private $empleadoH = "empleado por horas";
    private $empleadoA = "empleado asalariado";

    // Sobrecarga metodo mágico constructor
    function __construct() {

        //obtengo un array con los parámetros enviados a la función
        $params = func_get_args();

        //saco el número de parámetros que estoy recibiendo
        $num_params = func_num_args();

        //cada constructor de un número dado de parámtros tendrá un nombre de función        
        //atendiendo al siguiente modelo __construct1() __construct2()...
        $funcion_constructor = '__construct' . $num_params;

        //compruebo si hay un constructor con ese número de parámetros
        if (method_exists($this, $funcion_constructor)) {
            //si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    //ahora declaro una serie de métodos constructores que aceptan diversos números de parámetros
    function __construct1($aumentoSalario) {
        // Llamada directa a la función incrementar salario.
        $this->incrementarSalario($aumentoSalario);
    }

    function __construct2($aumentoSalario, $cantidadHoras) {
        $this->cantidadHoras = $cantidadHoras;
        $this->incrementarSalario($aumentoSalario);
    }

    function __construct4($nombre, $apellidos, $ss, $aumentoSalario) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->ss = $ss;
        $this->incrementarSalario($aumentoSalario);
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getSS() {
        return $this->ss;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setSS($SS) {
        $this->ss = $SS;
    }

    function getCantidadHoras() {
        return $this->cantidadHoras;
    }

    function setCantidadHoras($cantidadHoras) {
        $this->cantidadHoras = $cantidadHoras;
    }
    
    function getEmpleadoH() {
        return $this->empleadoH;
    }

    function getEmpleadoA() {
        return $this->empleadoA;
    }

    
    // función mágica toString.
    public function __toString() {

        return $this->nombre . " " . $this->apellidos;
    }

    // Metodos Abstractos
    abstract protected function salarioMes();

    abstract protected function incrementarSalario($aumetoSalario);
}
