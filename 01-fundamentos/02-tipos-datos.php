<?php

/*
|--------------------------------------------------------------------------
| 02 - Tipos de datos
|--------------------------------------------------------------------------
| PHP utiliza diferentes tipos de datos para almacenar información.
|
| Tipos principales:
| - String  → texto
| - Integer → números enteros
| - Float   → números decimales
| - Boolean → true / false
| - Array   → colecciones de datos
| - Null    → ausencia de valor
| - Object  → objetos
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. STRING
// -------------------------------------------------------------------------

$nombre = "José Calderón";
$lenguaje = 'PHP';

echo "Nombre: " . $nombre . PHP_EOL;
echo "Lenguaje: " . $lenguaje . PHP_EOL;


// -------------------------------------------------------------------------
// 2. INTEGER
// -------------------------------------------------------------------------

$edad = 25;
$experiencia = 2;

echo "Edad: " . $edad . PHP_EOL;
echo "Experiencia: " . $experiencia . " años" . PHP_EOL;


// -------------------------------------------------------------------------
// 3. FLOAT
// -------------------------------------------------------------------------

$precio = 19990.50;
$altura = 1.75;

echo "Precio: $" . $precio . PHP_EOL;
echo "Altura: " . $altura . " metros" . PHP_EOL;


// -------------------------------------------------------------------------
// 4. BOOLEAN
// -------------------------------------------------------------------------

$esProgramador = true;
$buscandoTrabajo = true;

echo "Es programador: " . ($esProgramador ? "Sí" : "No") . PHP_EOL;
echo "Está buscando trabajo: " . ($buscandoTrabajo ? "Sí" : "No") . PHP_EOL;


// -------------------------------------------------------------------------
// 5. ARRAY
// -------------------------------------------------------------------------

$lenguajes = ["PHP", "Python", "JavaScript", "Java"];

echo "Primer lenguaje: " . $lenguajes[0] . PHP_EOL;
echo "Segundo lenguaje: " . $lenguajes[1] . PHP_EOL;


// -------------------------------------------------------------------------
// 6. ARRAY ASOCIATIVO
// -------------------------------------------------------------------------

$programador = [
    "nombre" => "José",
    "edad" => 25,
    "lenguaje" => "PHP"
];

echo "Nombre: " . $programador["nombre"] . PHP_EOL;
echo "Lenguaje: " . $programador["lenguaje"] . PHP_EOL;


// -------------------------------------------------------------------------
// 7. NULL
// -------------------------------------------------------------------------

$proyectoActual = null;

echo "Proyecto actual: ";

if ($proyectoActual === null) {
    echo "No definido" . PHP_EOL;
} else {
    echo $proyectoActual . PHP_EOL;
}


// -------------------------------------------------------------------------
// 8. VAR_DUMP()
// -------------------------------------------------------------------------
// var_dump() muestra el tipo de dato y su valor.
// Es muy útil durante la depuración.

echo PHP_EOL . "Información de los tipos de datos:" . PHP_EOL;

var_dump($nombre);
var_dump($edad);
var_dump($precio);
var_dump($esProgramador);
var_dump($lenguajes);
var_dump($proyectoActual);


// -------------------------------------------------------------------------
// 9. TYPE CASTING
// -------------------------------------------------------------------------
// Podemos convertir un tipo de dato en otro.

$numeroTexto = "100";

echo PHP_EOL . "Valor original:" . PHP_EOL;
var_dump($numeroTexto);

$numero = (int) $numeroTexto;

echo "Después de convertir a integer:" . PHP_EOL;
var_dump($numero);


// -------------------------------------------------------------------------
// 10. TYPE CHECKING
// -------------------------------------------------------------------------

echo PHP_EOL . "Comprobación de tipos:" . PHP_EOL;

var_dump(is_string($nombre));
var_dump(is_int($edad));
var_dump(is_float($precio));
var_dump(is_bool($esProgramador));
var_dump(is_array($lenguajes));
var_dump(is_null($proyectoActual));