<?php

/*
|--------------------------------------------------------------------------
| 04 - Break y Continue
|--------------------------------------------------------------------------
| break    -> termina completamente el bucle.
| continue -> salta la iteración actual y continúa con la siguiente.
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. BREAK CON FOR
// -------------------------------------------------------------------------

echo "Break con for:" . PHP_EOL;

for ($i = 1; $i <= 10; $i++) {

    if ($i === 6) {
        break;
    }

    echo $i . PHP_EOL;
}


// -------------------------------------------------------------------------
// 2. CONTINUE CON FOR
// -------------------------------------------------------------------------

echo PHP_EOL . "Continue con for:" . PHP_EOL;

for ($i = 1; $i <= 10; $i++) {

    if ($i === 5) {
        continue;
    }

    echo $i . PHP_EOL;
}


// -------------------------------------------------------------------------
// 3. SALTAR NÚMEROS PARES
// -------------------------------------------------------------------------

echo PHP_EOL . "Solo números impares:" . PHP_EOL;

for ($i = 1; $i <= 10; $i++) {

    if ($i % 2 === 0) {
        continue;
    }

    echo $i . PHP_EOL;
}


// -------------------------------------------------------------------------
// 4. BREAK CON WHILE
// -------------------------------------------------------------------------

echo PHP_EOL . "Break con while:" . PHP_EOL;

$contador = 1;

while ($contador <= 10) {

    echo $contador . PHP_EOL;

    if ($contador === 5) {
        break;
    }

    $contador++;
}


// -------------------------------------------------------------------------
// 5. CONTINUE CON WHILE
// -------------------------------------------------------------------------

echo PHP_EOL . "Continue con while:" . PHP_EOL;

$contador = 0;

while ($contador < 10) {

    $contador++;

    if ($contador === 5) {
        continue;
    }

    echo $contador . PHP_EOL;
}


// -------------------------------------------------------------------------
// 6. FOREACH CON CONTINUE
// -------------------------------------------------------------------------

$usuarios = [
    "José",
    "Ana",
    "Pedro",
    "María"
];

echo PHP_EOL . "Usuarios excepto Pedro:" . PHP_EOL;

foreach ($usuarios as $usuario) {

    if ($usuario === "Pedro") {
        continue;
    }

    echo $usuario . PHP_EOL;
}


// -------------------------------------------------------------------------
// 7. FOREACH CON BREAK
// -------------------------------------------------------------------------

echo PHP_EOL . "Buscar usuario:" . PHP_EOL;

foreach ($usuarios as $usuario) {

    echo "Revisando: " . $usuario . PHP_EOL;

    if ($usuario === "Pedro") {

        echo "Usuario encontrado." . PHP_EOL;

        break;
    }
}


// -------------------------------------------------------------------------
// 8. BUSCAR UN PRODUCTO
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

$productoBuscado = "Mouse";

echo PHP_EOL . "Buscando producto: " . $productoBuscado . PHP_EOL;

foreach ($productos as $producto) {

    if ($producto["nombre"] !== $productoBuscado) {
        continue;
    }

    echo "Producto encontrado." . PHP_EOL;
    echo "Precio: $" . $producto["precio"] . PHP_EOL;

    break;
}


// -------------------------------------------------------------------------
// 9. FILTRAR PRODUCTOS
// -------------------------------------------------------------------------

echo PHP_EOL . "Productos sobre $20.000:" . PHP_EOL;

foreach ($productos as $producto) {

    if ($producto["precio"] <= 20000) {
        continue;
    }

    echo $producto["nombre"] . ": $" . $producto["precio"] . PHP_EOL;
}


// -------------------------------------------------------------------------
// 10. BREAK EN BUCLES ANIDADOS
// -------------------------------------------------------------------------

echo PHP_EOL . "Break en bucles anidados:" . PHP_EOL;

for ($i = 1; $i <= 3; $i++) {

    for ($j = 1; $j <= 5; $j++) {

        echo "i = $i, j = $j" . PHP_EOL;

        if ($j === 3) {
            break;
        }
    }
}


// -------------------------------------------------------------------------
// 11. CONTINUE EN BUCLES ANIDADOS
// -------------------------------------------------------------------------

echo PHP_EOL . "Continue en bucles anidados:" . PHP_EOL;

for ($i = 1; $i <= 3; $i++) {

    for ($j = 1; $j <= 5; $j++) {

        if ($j === 3) {
            continue;
        }

        echo "i = $i, j = $j" . PHP_EOL;
    }
}


// -------------------------------------------------------------------------
// 12. BREAK 2
// -------------------------------------------------------------------------
// break 2 permite salir de dos niveles de bucles.

echo PHP_EOL . "Break 2:" . PHP_EOL;

for ($i = 1; $i <= 3; $i++) {

    for ($j = 1; $j <= 5; $j++) {

        echo "i = $i, j = $j" . PHP_EOL;

        if ($i === 2 && $j === 2) {
            break 2;
        }
    }
}


// -------------------------------------------------------------------------
// 13. CONTINUE 2
// -------------------------------------------------------------------------
// continue 2 salta a la siguiente iteración del bucle externo.

echo PHP_EOL . "Continue 2:" . PHP_EOL;

for ($i = 1; $i <= 3; $i++) {

    for ($j = 1; $j <= 3; $j++) {

        if ($j === 2) {
            continue 2;
        }

        echo "i = $i, j = $j" . PHP_EOL;
    }
}


// -------------------------------------------------------------------------
// 14. EJEMPLO PRÁCTICO
// -------------------------------------------------------------------------

$usuarios = [
    [
        "nombre" => "José",
        "activo" => true
    ],
    [
        "nombre" => "Ana",
        "activo" => false
    ],
    [
        "nombre" => "Pedro",
        "activo" => true
    ]
];

echo PHP_EOL . "Usuarios activos:" . PHP_EOL;

foreach ($usuarios as $usuario) {

    if (!$usuario["activo"]) {
        continue;
    }

    echo "- " . $usuario["nombre"] . PHP_EOL;
}