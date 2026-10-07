<?php

/*
|--------------------------------------------------------------------------
| 01 - Condicionales
|--------------------------------------------------------------------------
| Las estructuras condicionales permiten ejecutar código dependiendo
| de si una condición es verdadera o falsa.
|
| Principales estructuras:
| - if
| - else
| - elseif
| - Operadores de comparación
| - Operadores lógicos
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. IF
// -------------------------------------------------------------------------

$edad = 25;

if ($edad >= 18) {
    echo "Es mayor de edad." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 2. IF + ELSE
// -------------------------------------------------------------------------

$edad = 16;

if ($edad >= 18) {

    echo "Puede ingresar." . PHP_EOL;

} else {

    echo "No puede ingresar." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 3. IF + ELSEIF + ELSE
// -------------------------------------------------------------------------

$nota = 6.2;

if ($nota >= 6.0) {

    echo "Excelente resultado." . PHP_EOL;

} elseif ($nota >= 4.0) {

    echo "Aprobado." . PHP_EOL;

} else {

    echo "Reprobado." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 4. VARIAS CONDICIONES
// -------------------------------------------------------------------------

$edad = 25;
$tieneDocumento = true;

if ($edad >= 18 && $tieneDocumento) {

    echo "Puede ingresar al sistema." . PHP_EOL;

} else {

    echo "No puede ingresar al sistema." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 5. OPERADOR OR
// -------------------------------------------------------------------------

$esAdministrador = false;
$esModerador = true;

if ($esAdministrador || $esModerador) {

    echo "Tiene permisos de administración." . PHP_EOL;

} else {

    echo "No tiene permisos suficientes." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 6. OPERADOR NOT
// -------------------------------------------------------------------------

$estaBloqueado = false;

if (!$estaBloqueado) {

    echo "La cuenta está habilitada." . PHP_EOL;

} else {

    echo "La cuenta está bloqueada." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 7. COMPARACIÓN ESTRICTA
// -------------------------------------------------------------------------

$rol = "admin";

if ($rol === "admin") {

    echo "Usuario administrador." . PHP_EOL;

} else {

    echo "Usuario estándar." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 8. CONDICIÓN CON NÚMEROS
// -------------------------------------------------------------------------

$saldo = 50000;
$precio = 35000;

if ($saldo >= $precio) {

    echo "Compra aprobada." . PHP_EOL;

} else {

    echo "Saldo insuficiente." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 9. CONDICIONES ANIDADAS
// -------------------------------------------------------------------------

$edad = 25;
$tieneCuenta = true;

if ($edad >= 18) {

    echo "Es mayor de edad." . PHP_EOL;

    if ($tieneCuenta) {

        echo "Tiene una cuenta registrada." . PHP_EOL;

    } else {

        echo "No tiene una cuenta registrada." . PHP_EOL;
    }

} else {

    echo "Es menor de edad." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 10. CONDICIONES CON STRINGS
// -------------------------------------------------------------------------

$usuario = "jose";
$clave = "1234";

if ($usuario === "jose" && $clave === "1234") {

    echo "Inicio de sesión correcto." . PHP_EOL;

} else {

    echo "Usuario o contraseña incorrectos." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 11. OPERADOR TERNARIO
// -------------------------------------------------------------------------

$edad = 20;

$mensaje = $edad >= 18
    ? "Mayor de edad"
    : "Menor de edad";

echo $mensaje . PHP_EOL;


// -------------------------------------------------------------------------
// 12. NULL COALESCENTE
// -------------------------------------------------------------------------

$nombre = null;

$nombreMostrar = $nombre ?? "Usuario invitado";

echo "Bienvenido: " . $nombreMostrar . PHP_EOL;


// -------------------------------------------------------------------------
// 13. CONDICIÓN CON is_numeric()
// -------------------------------------------------------------------------

$valor = "150";

if (is_numeric($valor)) {

    echo "El valor es numérico." . PHP_EOL;

} else {

    echo "El valor no es numérico." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 14. EJEMPLO PRÁCTICO
// -------------------------------------------------------------------------

$edad = 25;
$tieneExperiencia = true;
$puedeTrabajar = false;

if ($edad >= 18 && $tieneExperiencia) {

    if ($puedeTrabajar) {

        echo "Cumple los requisitos y puede comenzar a trabajar." . PHP_EOL;

    } else {

        echo "Cumple los requisitos, pero actualmente no puede trabajar." . PHP_EOL;
    }

} else {

    echo "No cumple los requisitos." . PHP_EOL;
}