<?php

/*
|--------------------------------------------------------------------------
| 04 - Entrada de datos
|--------------------------------------------------------------------------
| PHP puede recibir información desde diferentes fuentes.
|
| En este ejercicio trabajaremos con:
| - Entrada desde la terminal
| - readline()
| - Conversión de tipos
| - Validación básica
| - Valores por defecto
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. RECIBIR TEXTO DESDE LA TERMINAL
// -------------------------------------------------------------------------

$nombre = readline("Ingresa tu nombre: ");

echo "Hola, " . $nombre . "!" . PHP_EOL;


// -------------------------------------------------------------------------
// 2. RECIBIR UN NÚMERO
// -------------------------------------------------------------------------

$edad = readline("Ingresa tu edad: ");

$edad = (int) $edad;

echo "Tu edad es: " . $edad . " años." . PHP_EOL;


// -------------------------------------------------------------------------
// 3. REALIZAR UN CÁLCULO CON DATOS INGRESADOS
// -------------------------------------------------------------------------

$anioActual = 2026;

$anioNacimiento = readline("Ingresa tu año de nacimiento: ");
$anioNacimiento = (int) $anioNacimiento;

$edadCalculada = $anioActual - $anioNacimiento;

echo "Tu edad aproximada es: " . $edadCalculada . " años." . PHP_EOL;


// -------------------------------------------------------------------------
// 4. RECIBIR UN NÚMERO DECIMAL
// -------------------------------------------------------------------------

$precio = readline("Ingresa el precio del producto: ");

$precio = (float) $precio;

echo "Precio ingresado: $" . $precio . PHP_EOL;


// -------------------------------------------------------------------------
// 5. REALIZAR UNA OPERACIÓN
// -------------------------------------------------------------------------

$cantidad = readline("Ingresa la cantidad: ");
$cantidad = (int) $cantidad;

$total = $precio * $cantidad;

echo "Total: $" . $total . PHP_EOL;


// -------------------------------------------------------------------------
// 6. RECIBIR UNA RESPUESTA SÍ / NO
// -------------------------------------------------------------------------

$respuesta = readline("¿Tienes experiencia en PHP? (si/no): ");

$respuesta = strtolower(trim($respuesta));

$tieneExperiencia = $respuesta === "si";

echo "¿Tiene experiencia?: ";
var_dump($tieneExperiencia);


// -------------------------------------------------------------------------
// 7. VALIDACIÓN BÁSICA
// -------------------------------------------------------------------------

$edadUsuario = readline("Ingresa nuevamente tu edad: ");
$edadUsuario = (int) $edadUsuario;

if ($edadUsuario >= 18) {

    echo "Puedes continuar." . PHP_EOL;

} else {

    echo "Debes ser mayor de edad." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 8. VALOR POR DEFECTO
// -------------------------------------------------------------------------

$ciudad = readline("Ingresa tu ciudad (presiona Enter para omitir): ");

$ciudad = trim($ciudad);

if ($ciudad === "") {
    $ciudad = "Santiago";
}

echo "Ciudad: " . $ciudad . PHP_EOL;


// -------------------------------------------------------------------------
// 9. VALIDAR SI EL VALOR ES NUMÉRICO
// -------------------------------------------------------------------------

$numero = readline("Ingresa un número: ");

if (is_numeric($numero)) {

    $numero = (float) $numero;

    echo "Número válido: " . $numero . PHP_EOL;

} else {

    echo "El valor ingresado no es un número." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 10. MOSTRAR EL TIPO DE DATO
// -------------------------------------------------------------------------

$valor = readline("Ingresa cualquier valor: ");

echo "Valor recibido: " . $valor . PHP_EOL;

echo "Tipo de dato:" . PHP_EOL;

var_dump($valor);