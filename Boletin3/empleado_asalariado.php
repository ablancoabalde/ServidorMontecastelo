<?php

require_once 'empleado.php';
require_once 'comparar.php';

class empleado_asalariado extends empleado implements comparar {

    private $numPagas = 14;
    private $salarioBase = 14000;

    // Función que devuelve el salario mensual del trabajador
    function salarioMes() {

        return $this->salarioBase / $this->numPagas;
    }

    // Función que incrementa el salario del trabajador
    function incrementarSalario($aumetoSalario) {

        $this->salarioBase += (($aumetoSalario / 100) * $this->salarioBase);
    }

    // Condición en la que comprueba de que clase es el objeto
    //"empleado_asalariado"; o "empleado_horas";, dependiendo de cuál sea
    // devuelve una frase u otra;
    function comparar($empleado) {
        if (get_class($empleado) == "empleado_horas") {
            return $this->getEmpleadoH();
        } else {
            return $this->getEmpleadoA();
        }
    }

}
