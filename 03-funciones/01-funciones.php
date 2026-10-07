<?php

/*
|--------------------------------------------------------------------------
| 01 - Funciones
|--------------------------------------------------------------------------
| Una función es un bloque de código reutilizable que permite organizar
| una tarea específica.
|
| Ventajas:
| - Evita repetir código.
| - Mejora la organización.
| - Facilita el mantenimiento.
| - Permite reutilizar lógica.
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. FUNCIÓN BÁSICA
// -------------------------------------------------------------------------

function saludar()
{
    echo "Hola, bienvenido a PHP." . PHP_EOL;
}

saludar();


// -------------------------------------------------------------------------
// 2. FUNCIÓN CON PARÁMETRO
// -------------------------------------------------------------------------

function saludarUsuario($nombre)
{
    echo "Hola, " . $nombre . "!" . PHP_EOL;
}

saludarUsuario("José");
saludarUsuario("Ana");


// -------------------------------------------------------------------------
// 3. VARIOS PARÁMETROS
// -------------------------------------------------------------------------

function presentarUsuario($nombre, $profesion)
{
    echo "Nombre: " . $nombre . PHP_EOL;
    echo "Profesión: " . $profesion . PHP_EOL;
}

presentarUsuario(
    "José",
    "Analista Programador"
);


// -------------------------------------------------------------------------
// 4. FUNCIÓN CON RETORNO
// -------------------------------------------------------------------------

function sumar($a, $b)
{
    return $a + $b;
}

$resultado = sumar(10, 20);

echo "Resultado: " . $resultado . PHP_EOL;


// -------------------------------------------------------------------------
// 5. RETORNAR STRING
// -------------------------------------------------------------------------

function obtenerMensaje()
{
    return "PHP es un lenguaje de programación backend.";
}

$mensaje = obtenerMensaje();

echo $mensaje . PHP_EOL;


// -------------------------------------------------------------------------
// 6. RETORNAR BOOLEAN
// -------------------------------------------------------------------------

function esMayorDeEdad($edad)
{
    return $edad >= 18;
}

$edad = 25;

if (esMayorDeEdad($edad)) {

    echo "Es mayor de edad." . PHP_EOL;

} else {

    echo "Es menor de edad." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 7. PARÁMETRO CON VALOR POR DEFECTO
// -------------------------------------------------------------------------

function saludarConCiudad($nombre, $ciudad = "Santiago")
{
    echo $nombre . " vive en " . $ciudad . "." . PHP_EOL;
}

saludarConCiudad("José");

saludarConCiudad(
    "Ana",
    "Concepción"
);


// -------------------------------------------------------------------------
// 8. TIPADO DE PARÁMETROS
// -------------------------------------------------------------------------
// Podemos indicar qué tipo de dato esperamos recibir.

function multiplicar(int $a, int $b)
{
    return $a * $b;
}

$resultado = multiplicar(5, 4);

echo "Multiplicación: " . $resultado . PHP_EOL;


// -------------------------------------------------------------------------
// 9. TIPADO DEL VALOR DE RETORNO
// -------------------------------------------------------------------------

function dividir(float $a, float $b): float
{
    return $a / $b;
}

$resultado = dividir(10, 2);

echo "División: " . $resultado . PHP_EOL;


// -------------------------------------------------------------------------
// 10. FUNCIÓN CON STRING TIPADO
// -------------------------------------------------------------------------

function obtenerNombreCompleto(
    string $nombre,
    string $apellido
): string {

    return $nombre . " " . $apellido;
}

$nombreCompleto = obtenerNombreCompleto(
    "José",
    "Calderón"
);

echo "Nombre completo: " . $nombreCompleto . PHP_EOL;


// -------------------------------------------------------------------------
// 11. FUNCIÓN CON CONDICIONAL
// -------------------------------------------------------------------------

function evaluarNota(float $nota): string
{
    if ($nota >= 6.0) {

        return "Excelente";

    } elseif ($nota >= 4.0) {

        return "Aprobado";

    }

    return "Reprobado";
}

echo "Resultado: " . evaluarNota(6.2) . PHP_EOL;


// -------------------------------------------------------------------------
// 12. FUNCIÓN QUE TRABAJA CON ARRAYS
// -------------------------------------------------------------------------

function mostrarLenguajes(array $lenguajes): void
{
    foreach ($lenguajes as $lenguaje) {

        echo "- " . $lenguaje . PHP_EOL;
    }
}

$lenguajes = [
    "PHP",
    "Python",
    "JavaScript",
    "Java"
];

mostrarLenguajes($lenguajes);


// -------------------------------------------------------------------------
// 13. FUNCIÓN QUE RETORNA UN ARRAY
// -------------------------------------------------------------------------

function obtenerUsuario(): array
{
    return [
        "nombre" => "José",
        "rol" => "admin",
        "activo" => true
    ];
}

$usuario = obtenerUsuario();

echo "Usuario: " . $usuario["nombre"] . PHP_EOL;
echo "Rol: " . $usuario["rol"] . PHP_EOL;


// -------------------------------------------------------------------------
// 14. VARIOS RETORNOS POSIBLES
// -------------------------------------------------------------------------

function obtenerDescuento(float $total): float
{
    if ($total >= 100000) {

        return $total * 0.20;

    }

    if ($total >= 50000) {

        return $total * 0.10;
    }

    return 0;
}

$descuento = obtenerDescuento(120000);

echo "Descuento: $" . $descuento . PHP_EOL;


// -------------------------------------------------------------------------
// 15. FUNCIÓN PARA CALCULAR TOTAL
// -------------------------------------------------------------------------

function calcularTotal(
    float $precio,
    int $cantidad
): float {

    return $precio * $cantidad;
}

$total = calcularTotal(15000, 3);

echo "Total: $" . $total . PHP_EOL;


// -------------------------------------------------------------------------
// 16. FUNCIÓN CON VARIOS TIPOS DE PARÁMETROS
// -------------------------------------------------------------------------

function crearUsuario(
    string $nombre,
    int $edad,
    string $rol = "usuario"
): array {

    return [
        "nombre" => $nombre,
        "edad" => $edad,
        "rol" => $rol
    ];
}

$usuario = crearUsuario(
    "José",
    25,
    "admin"
);

print_r($usuario);


// -------------------------------------------------------------------------
// 17. FUNCIÓN VOID
// -------------------------------------------------------------------------
// void significa que la función no devuelve ningún valor.

function mostrarSeparador(): void
{
    echo str_repeat("-", 40) . PHP_EOL;
}

mostrarSeparador();

echo "Contenido del sistema" . PHP_EOL;

mostrarSeparador();


// -------------------------------------------------------------------------
// 18. FUNCIÓN PARA VALIDAR EMAIL
// -------------------------------------------------------------------------

function validarEmail(string $email): bool
{
    return filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    ) !== false;
}

$email = "jose@example.com";

if (validarEmail($email)) {

    echo "Email válido." . PHP_EOL;

} else {

    echo "Email inválido." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 19. FUNCIÓN CON OPERADOR MATCH
// -------------------------------------------------------------------------

function obtenerNombreRol(string $rol): string
{
    return match ($rol) {

        "admin" => "Administrador",
        "editor" => "Editor",
        "usuario" => "Usuario",

        default => "Invitado"
    };
}

echo obtenerNombreRol("admin") . PHP_EOL;
echo obtenerNombreRol("editor") . PHP_EOL;


// -------------------------------------------------------------------------
// 20. EJEMPLO PRÁCTICO
// -------------------------------------------------------------------------

function calcularPrecioFinal(
    float $precio,
    int $cantidad,
    float $iva = 0.19
): float {

    $subtotal = $precio * $cantidad;

    $impuesto = $subtotal * $iva;

    return $subtotal + $impuesto;
}

$precioFinal = calcularPrecioFinal(
    10000,
    3
);

echo PHP_EOL;
echo "Precio final con IVA: $" . $precioFinal . PHP_EOL;