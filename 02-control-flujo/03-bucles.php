<?php

/*
|--------------------------------------------------------------------------
| 03 - Bucles
|--------------------------------------------------------------------------
| Los bucles permiten repetir un bloque de código mientras se cumpla
| una determinada condición.
|
| Principales bucles:
| - for
| - while
| - do while
| - foreach
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. FOR
// -------------------------------------------------------------------------
// Se utiliza cuando conocemos aproximadamente cuántas veces
// queremos repetir una operación.

for ($i = 1; $i <= 5; $i++) {

    echo "Iteración: " . $i . PHP_EOL;
}


// -------------------------------------------------------------------------
// 2. FOR CONCREMENTANDO DE 2 EN 2
// -------------------------------------------------------------------------

echo PHP_EOL . "Números pares:" . PHP_EOL;

for ($i = 2; $i <= 10; $i += 2) {

    echo $i . PHP_EOL;
}


// -------------------------------------------------------------------------
// 3. FOR HACIA ATRÁS
// -------------------------------------------------------------------------

echo PHP_EOL . "Cuenta regresiva:" . PHP_EOL;

for ($i = 5; $i >= 1; $i--) {

    echo $i . PHP_EOL;
}


// -------------------------------------------------------------------------
// 4. WHILE
// -------------------------------------------------------------------------
// while repite el código mientras la condición sea verdadera.

$contador = 1;

echo PHP_EOL . "While:" . PHP_EOL;

while ($contador <= 5) {

    echo "Contador: " . $contador . PHP_EOL;

    $contador++;
}


// -------------------------------------------------------------------------
// 5. DO WHILE
// -------------------------------------------------------------------------
// do while ejecuta el código al menos una vez,
// incluso si la condición inicialmente es falsa.

$numero = 1;

echo PHP_EOL . "Do while:" . PHP_EOL;

do {

    echo "Número: " . $numero . PHP_EOL;

    $numero++;

} while ($numero <= 5);


// -------------------------------------------------------------------------
// 6. FOREACH CON ARRAY
// -------------------------------------------------------------------------
// foreach es especialmente útil para recorrer arrays.

$lenguajes = [
    "PHP",
    "Python",
    "JavaScript",
    "Java"
];

echo PHP_EOL . "Lenguajes:" . PHP_EOL;

foreach ($lenguajes as $lenguaje) {

    echo "- " . $lenguaje . PHP_EOL;
}


// -------------------------------------------------------------------------
// 7. FOREACH CON CLAVE Y VALOR
// -------------------------------------------------------------------------

$programador = [
    "nombre" => "José",
    "profesion" => "Analista Programador",
    "lenguaje" => "PHP",
    "experiencia" => 2
];

echo PHP_EOL . "Información:" . PHP_EOL;

foreach ($programador as $clave => $valor) {

    echo $clave . ": " . $valor . PHP_EOL;
}


// -------------------------------------------------------------------------
// 8. FOREACH CON ARRAY DE ARRAYS
// -------------------------------------------------------------------------

$usuarios = [
    [
        "nombre" => "José",
        "rol" => "admin"
    ],
    [
        "nombre" => "Ana",
        "rol" => "editor"
    ],
    [
        "nombre" => "Pedro",
        "rol" => "usuario"
    ]
];

echo PHP_EOL . "Usuarios:" . PHP_EOL;

foreach ($usuarios as $usuario) {

    echo "Nombre: " . $usuario["nombre"] . PHP_EOL;
    echo "Rol: " . $usuario["rol"] . PHP_EOL;
    echo PHP_EOL;
}


// -------------------------------------------------------------------------
// 9. BUCLE CON CONDICIÓN
// -------------------------------------------------------------------------

echo "Números pares:" . PHP_EOL;

for ($i = 1; $i <= 10; $i++) {

    if ($i % 2 === 0) {

        echo $i . PHP_EOL;
    }
}


// -------------------------------------------------------------------------
// 10. BUCLE ANIDADO
// -------------------------------------------------------------------------
// Un bucle puede contener otro bucle.

echo PHP_EOL . "Tabla de multiplicar:" . PHP_EOL;

for ($i = 1; $i <= 3; $i++) {

    for ($j = 1; $j <= 3; $j++) {

        echo $i . " x " . $j . " = " . ($i * $j) . PHP_EOL;
    }

    echo PHP_EOL;
}


// -------------------------------------------------------------------------
// 11. FOREACH MODIFICANDO VALORES
// -------------------------------------------------------------------------

$precios = [1000, 2000, 3000];

echo "Precios con IVA:" . PHP_EOL;

foreach ($precios as $precio) {

    $precioConIva = $precio * 1.19;

    echo "$" . $precioConIva . PHP_EOL;
}


// -------------------------------------------------------------------------
// 12. FOREACH POR REFERENCIA
// -------------------------------------------------------------------------
// El símbolo "&" permite modificar directamente los valores
// del array original.

$numeros = [1, 2, 3, 4, 5];

foreach ($numeros as &$numero) {

    $numero *= 2;
}

unset($numero);

echo PHP_EOL . "Array modificado:" . PHP_EOL;

foreach ($numeros as $numero) {

    echo $numero . PHP_EOL;
}


// -------------------------------------------------------------------------
// 13. BUCLE INFINITO CONTROLADO
// -------------------------------------------------------------------------

$contador = 1;

while (true) {

    echo "Contador: " . $contador . PHP_EOL;

    $contador++;

    if ($contador > 3) {

        break;
    }
}


// -------------------------------------------------------------------------
// 14. EJEMPLO PRÁCTICO
// -------------------------------------------------------------------------

$productos = [
    [
        "nombre" => "Teclado",
        "precio" => 25000
    ],
    [
        "nombre" => "Mouse",
        "precio" => 15000
    ],
    [
        "nombre" => "Monitor",
        "precio" => 120000
    ]
];

echo PHP_EOL . "Productos:" . PHP_EOL;

$total = 0;

foreach ($productos as $producto) {

    echo $producto["nombre"] . ": $" . $producto["precio"] . PHP_EOL;

    $total += $producto["precio"];
}

echo "Total: $" . $total . PHP_EOL;