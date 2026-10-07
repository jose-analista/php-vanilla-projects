<?php

/*
|--------------------------------------------------------------------------
| 01 - Variables
|--------------------------------------------------------------------------
| En PHP las variables comienzan con el símbolo "$".
| No es necesario declarar previamente el tipo de dato.
|--------------------------------------------------------------------------
*/

// String
$nombre = "José";

// Integer
$edad = 25;

// Float
$altura = 1.75;

// Boolean
$esProgramador = true;

// Null
$lenguajeSecundario = null;


// Mostrar variables
echo "Nombre: " . $nombre . PHP_EOL;
echo "Edad: " . $edad . " años" . PHP_EOL;
echo "Altura: " . $altura . " metros" . PHP_EOL;
echo "Es programador: " . ($esProgramador ? "Sí" : "No") . PHP_EOL;
echo "Lenguaje secundario: " . ($lenguajeSecundario ?? "No definido") . PHP_EOL;


// Modificar una variable
$edad = 26;

echo "Nueva edad: " . $edad . PHP_EOL;


// Variable con cálculo
$anioActual = 2026;
$anioNacimiento = 2000;

$edadCalculada = $anioActual - $anioNacimiento;

echo "Edad calculada: " . $edadCalculada . " años" . PHP_EOL;


// Constante
define("LENGUAJE", "PHP");

echo "Lenguaje principal: " . LENGUAJE . PHP_EOL;