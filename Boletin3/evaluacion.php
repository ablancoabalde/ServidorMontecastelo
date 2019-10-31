<?php

require_once 'empleado_asalariado.php';
require_once 'empleado_horas.php';
// Nombre de la clase, por si algún día se quiere cambiar
$empA = "empleado_asalariado";
$empH = "empleado_horas";
// Variables auxiliares para el forEach.
$contador = 0;
$valor;
// Objeto generico para hacer llamadas a los metodos.
$empleado = new $empH();
// Array de los empleados creados de diferentes formas.
$arrayEmpleados = array(
    $empleado1 = new $empA(8),
    $empleado2 = new $empH(2, 10),
    $empleado3 = new $empA(4),
    $empleado4 = new $empA("Lorena", "Garcia González", "123", 6),
    $empleado5 = new $empH(),
    $empleado6 = new $empH());

$empleado1->setNombre("Alberto");
$empleado1->setApellidos("Blanco Abalde");

$empleado2->setNombre("Pepe");
$empleado2->setApellidos("Abalde Blanco");

$empleado3->setNombre("Jose");
$empleado3->setApellidos("Blanco Abalde");

$empleado5->setNombre("Charlie");
$empleado5->setApellidos("Negro Abalde");
$empleado5->setCantidadHoras(15);

$empleado6->setNombre("Luis");
$empleado6->setApellidos("Fernandez Barroncas");
$empleado6->setCantidadHoras(12);

// MOSTRAR
// Función count para contar la cantidad de objetos que contiene el array empleados
echo "<h4>El total tenemos " . count($arrayEmpleados) . " empleados.</h4>";
// Bucle para recorrer el array
foreach ($arrayEmpleados as $value) {

    echo "El empleado " . $value . " es un " . $empleado->comparar($value) . " que cobra " . $value->salarioMes() . " euros.";
    echo "</br>";
    // Condición en la que comprueba de que clase es el objeto
    //"empleado_asalariado"; o "empleado_horas";
    //Si es así, añade 1 al contados, el primer empleado que encuentre
    // lo guarda en la variable $valor, para luego cuando encuentre el segundo empleado mande
    // el primero y el segundo y los compare, luego el segundo con el tercero si lo hubiera y sucesivamente
    // no está pensado para comparar el primero con el tercero, para eso llamamos la función fuera y le pasamos
    // los empleados que queramos.
    if (get_class($value) == $empH) {
        $contador++;
        if ($contador >= 2) {
            echo $empleado->getComparaEmpHoras($valor, $value);
            echo "</br>";
        }
        $valor = $value;
    }
}
echo "</br>";
echo $empleado->getComparaEmpHoras($empleado2, $empleado6);
