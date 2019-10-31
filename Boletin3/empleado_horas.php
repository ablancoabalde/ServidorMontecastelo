<?php

require_once 'empleado.php';
require_once 'comparar.php';

class empleado_horas extends empleado implements comparar {

    private $salarioHora = 8;

    // Función que devuelve el salario mensual del trabajador
    function salarioMes() {

        return $this->getCantidadHoras() * $this->salarioHora;
    }

    // Función que incrementa el salario del trabajador
    function incrementarSalario($aumetoSalario) {

        $this->salarioHora += (($aumetoSalario / 100) * $this->salarioHora);
    }

    // Función que devuelve la frase correcta dependiendo de que empleado haya trabajado más.
    function getComparaEmpHoras($empleado1, $empleado2) {
        if (min($empleado1->getCantidadhoras(), $empleado2->getCantidadhoras())) {

            return "El empleado " . $empleado1->getNombre() . " ha trabajado " . $this->getRestar($empleado1->getCantidadhoras(), $empleado2->getCantidadhoras()) .
                    " horas más que el empleado " . $empleado2->getNombre();
        } else {

            return "El empleado " . $empleado2->getNombre() . " ha trabajado " . $this->getRestar($empleado1->getCantidadhoras(), $empleado2->getCantidadhoras()) .
                    " horas más que el empleado " . $empleado1->getNombre();
        }
    }

    // Función que devuelve el valor absoluto del resultado
    function getRestar($num1, $num2) {

        return abs($num1 - $num2);
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
