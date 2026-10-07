<?php

/*
|--------------------------------------------------------------------------
| 03 - Operadores
|--------------------------------------------------------------------------
| Los operadores permiten realizar cálculos, comparar valores
| y construir expresiones lógicas.
|
| Principales tipos:
| - Aritméticos
| - Asignación
| - Comparación
| - Incremento y decremento
| - Lógicos
| - Concatenación
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. OPERADORES ARITMÉTICOS
// -------------------------------------------------------------------------

$a = 10;
$b = 3;

echo "Suma: " . ($a + $b) . PHP_EOL;
echo "Resta: " . ($a - $b) . PHP_EOL;
echo "Multiplicación: " . ($a * $b) . PHP_EOL;
echo "División: " . ($a / $b) . PHP_EOL;
echo "Módulo: " . ($a % $b) . PHP_EOL;
echo "Potencia: " . ($a ** $b) . PHP_EOL;


// -------------------------------------------------------------------------
// 2. OPERADORES DE ASIGNACIÓN
// -------------------------------------------------------------------------

$saldo = 100;

$saldo += 50;
echo "Después de sumar: " . $saldo . PHP_EOL;

$saldo -= 20;
echo "Después de restar: " . $saldo . PHP_EOL;

$saldo *= 2;
echo "Después de multiplicar: " . $saldo . PHP_EOL;

$saldo /= 2;
echo "Después de dividir: " . $saldo . PHP_EOL;


// -------------------------------------------------------------------------
// 3. OPERADORES DE COMPARACIÓN
// -------------------------------------------------------------------------

$edad = 25;

var_dump($edad == 25);   // Igual en valor
var_dump($edad === 25);  // Igual en valor y tipo
var_dump($edad != 30);   // Diferente
var_dump($edad !== "25"); // Diferente en valor o tipo

var_dump($edad > 18);    // Mayor que
var_dump($edad < 30);    // Menor que
var_dump($edad >= 18);   // Mayor o igual
var_dump($edad <= 25);   // Menor o igual


// -------------------------------------------------------------------------
// 4. DIFERENCIA ENTRE == Y ===
// -------------------------------------------------------------------------

$numero = 10;
$texto = "10";

echo PHP_EOL . "Comparación ==:" . PHP_EOL;
var_dump($numero == $texto);

echo "Comparación ===:" . PHP_EOL;
var_dump($numero === $texto);


// -------------------------------------------------------------------------
// 5. INCREMENTO Y DECREMENTO
// -------------------------------------------------------------------------

$contador = 0;

$contador++;

echo PHP_EOL . "Contador: " . $contador . PHP_EOL;

$contador++;

echo "Contador: " . $contador . PHP_EOL;

$contador--;

echo "Contador: " . $contador . PHP_EOL;


// -------------------------------------------------------------------------
// 6. OPERADORES LÓGICOS
// -------------------------------------------------------------------------

$edad = 25;
$tieneDocumento = true;

$puedeIngresar = $edad >= 18 && $tieneDocumento;

echo PHP_EOL . "¿Puede ingresar?: ";
var_dump($puedeIngresar);


// AND
$esMayorDeEdad = true;
$tieneEntrada = true;

var_dump($esMayorDeEdad && $tieneEntrada);


// OR
$esAdministrador = false;
$esModerador = true;

var_dump($esAdministrador || $esModerador);


// NOT
$estaBloqueado = false;

var_dump(!$estaBloqueado);


// -------------------------------------------------------------------------
// 7. CONCATENACIÓN
// -------------------------------------------------------------------------

$nombre = "José";
$lenguaje = "PHP";

$mensaje = "Hola, soy " . $nombre . " y estoy aprendiendo " . $lenguaje . ".";

echo PHP_EOL . $mensaje . PHP_EOL;


// -------------------------------------------------------------------------
// 8. OPERADOR TERNARIO
// -------------------------------------------------------------------------

$edad = 25;

$mensaje = $edad >= 18
    ? "Es mayor de edad."
    : "Es menor de edad.";

echo $mensaje . PHP_EOL;


// -------------------------------------------------------------------------
// 9. OPERADOR NULL COALESCENTE
// -------------------------------------------------------------------------

$nombreUsuario = null;

$nombreMostrar = $nombreUsuario ?? "Usuario invitado";

echo "Nombre: " . $nombreMostrar . PHP_EOL;


// -------------------------------------------------------------------------
// 10. OPERADORES DE PRECEDENCIA
// -------------------------------------------------------------------------

$resultado = 10 + 5 * 2;

echo "Resultado: " . $resultado . PHP_EOL;

$resultadoConParentesis = (10 + 5) * 2;

echo "Resultado con paréntesis: " . $resultadoConParentesis . PHP_EOL;