<?php

require_once 'carta.php';
require_once 'barajaEsp.php';
require_once 'barajaFra.php';

$carta1 = new Carta(1, "oros");
$carta2 = new Carta(2, "treboles");
//print $carta1->toString($carta1, "esp");

// Objeto baraja por defecto
$baraja = new BarajaEsp();

// Objeto BarajaEsp con la condición false( quiere decir que no mete 8 y 9
$baraja2 = new BarajaEsp(false);
$baraja2->crearbaraja();

// Llamada al Metodo barajar
//$baraja2->barajar();

// Llamada al Metodo sigCarta, la cual muestra la carta de la siguiente posición
// de la baraja
for ($i = 0; $i < 4; $i++) {
    print $baraja2->sigCarta();
}

// Llamada al Metodo repartirCartas la cual se le pasa una cantidad de cartas a
// repartir
print $baraja2->repartirCartas(5);

// Llamada al Metodo cartasRepartidas muestra las cartas que han salido
// tanto las cartas del metodo sigCarta, como del metodo repartiCartas
print $baraja2->cartasRepartidas();

// Llamada al Metodo mostrarbaraja muestra todas las cartas restantes de la baraja
print $baraja2->mostrarbaraja();

// Llamada al Metodo cartasDispo indica en número la cantidad de cartas que hay en la baraja
print $baraja2->cartasDispo();

// Objeto BarajaFra crea la baraja sin ninguna condicón
$baraja3 = new BarajaFra();
$baraja3->crearbaraja();

// Llamada al Metodo barajar
$baraja3->barajar();

// Llamada al Metodo devolver Cartas
for ($i = 0; $i < 2; $i++) {
    print $baraja3->sigCarta();
}

print $baraja3->repartirCartas(5);

print $baraja3->cartasRepartidas();

print $baraja3->mostrarbaraja();

print $baraja3->cartasDispo();


// Objeto BarajaEsp con la condición true mete 8 y 9
$baraja4 = new BarajaEsp(true);
$baraja4->crearbaraja();

$baraja4->barajar();

for ($i = 0; $i < 4; $i++) {
    print $baraja4->sigCarta();
}
print $baraja4->repartirCartas(3);

print $baraja4->cartasRepartidas();

print $baraja4->mostrarbaraja();

print $baraja4->cartasDispo();

// Llamada al metodo compare se le pasan 2 barajas y nos indica si son de la misma clase
$baraja->compare($baraja2, $baraja3);
$baraja->compare($baraja2, $baraja4);

