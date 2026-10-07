<?php

/*
|--------------------------------------------------------------------------
| 03 - Retorno de funciones
|--------------------------------------------------------------------------
| La palabra "return" permite devolver un valor desde una función.
|
| Una función puede devolver:
|
| - string
| - int
| - float
| - bool
| - array
| - null
| - objetos
|
| También podemos indicar explícitamente el tipo de retorno.
|--------------------------------------------------------------------------
*/


// 1. Retornar un número
function sumar(int $a, int $b): int
{
    return $a + $b;
}

$resultado = sumar(10, 20);

echo "Resultado: " . $resultado . PHP_EOL;


// 2. Retornar un string
function obtenerMensaje(): string
{
    return "Bienvenido al sistema.";
}

$mensaje = obtenerMensaje();

echo $mensaje . PHP_EOL;


// 3. Retornar un booleano
function esMayorDeEdad(int $edad): bool
{
    return $edad >= 18;
}

if (esMayorDeEdad(25)) {
    echo "Es mayor de edad." . PHP_EOL;
} else {
    echo "Es menor de edad." . PHP_EOL;
}


// 4. Retornar un float
function calcularPromedio(
    float $nota1,
    float $nota2
): float {

    return ($nota1 + $nota2) / 2;
}

$promedio = calcularPromedio(6.0, 5.5);

echo "Promedio: " . $promedio . PHP_EOL;


// 5. Guardar el retorno en una variable
function calcularArea(float $base, float $altura): float
{
    return $base * $altura;
}

$area = calcularArea(10, 5);

echo "Área: " . $area . PHP_EOL;


// 6. Utilizar directamente el retorno
function multiplicar(int $a, int $b): int
{
    return $a * $b;
}

echo "Resultado: "
    . multiplicar(5, 8)
    . PHP_EOL;


// 7. Retorno con una condición
function evaluarNota(float $nota): string
{
    if ($nota >= 6.0) {
        return "Excelente";
    }

    if ($nota >= 4.0) {
        return "Aprobado";
    }

    return "Reprobado";
}

echo evaluarNota(6.5) . PHP_EOL;
echo evaluarNota(5.0) . PHP_EOL;
echo evaluarNota(3.5) . PHP_EOL;


// 8. Retorno temprano
/*
|--------------------------------------------------------------------------
| Una función puede finalizar inmediatamente usando return.
|--------------------------------------------------------------------------
*/

function validarEdad(int $edad): string
{
    if ($edad < 0) {
        return "Edad inválida.";
    }

    if ($edad < 18) {
        return "Menor de edad.";
    }

    return "Mayor de edad.";
}

echo validarEdad(25) . PHP_EOL;
echo validarEdad(15) . PHP_EOL;
echo validarEdad(-5) . PHP_EOL;


// 9. Retornar null
/*
|--------------------------------------------------------------------------
| Podemos utilizar ? para indicar que la función puede devolver:
|
| - El tipo indicado.
| - null.
|--------------------------------------------------------------------------
*/

function buscarUsuario(int $id): ?string
{
    if ($id === 1) {
        return "José";
    }

    return null;
}

$usuario = buscarUsuario(1);

if ($usuario !== null) {
    echo "Usuario encontrado: "
        . $usuario
        . PHP_EOL;
} else {
    echo "Usuario no encontrado."
        . PHP_EOL;
}

$usuario = buscarUsuario(99);

if ($usuario !== null) {
    echo "Usuario encontrado: "
        . $usuario
        . PHP_EOL;
} else {
    echo "Usuario no encontrado."
        . PHP_EOL;
}


// 10. Retornar un array
function obtenerLenguajes(): array
{
    return [
        "PHP",
        "Python",
        "JavaScript",
        "Java"
    ];
}

$lenguajes = obtenerLenguajes();

foreach ($lenguajes as $lenguaje) {
    echo "- " . $lenguaje . PHP_EOL;
}


// 11. Retornar un array asociativo
function obtenerUsuario(): array
{
    return [
        "id" => 1,
        "nombre" => "José",
        "rol" => "admin",
        "activo" => true
    ];
}

$usuario = obtenerUsuario();

echo "ID: "
    . $usuario["id"]
    . PHP_EOL;

echo "Nombre: "
    . $usuario["nombre"]
    . PHP_EOL;

echo "Rol: "
    . $usuario["rol"]
    . PHP_EOL;


// 12. Modificar el resultado después del retorno
function obtenerNombre(): string
{
    return "José Calderón";
}

$nombre = obtenerNombre();

$nombreMayuscula = strtoupper($nombre);

echo "Nombre: "
    . $nombreMayuscula
    . PHP_EOL;


// 13. Encadenar funciones
function obtenerPrecio(): float
{
    return 10000;
}

function aplicarIva(float $precio): float
{
    return $precio * 1.19;
}

$precioFinal = aplicarIva(
    obtenerPrecio()
);

echo "Precio final: $"
    . $precioFinal
    . PHP_EOL;


// 14. Una función utilizando otra función
function obtenerSubtotal(
    float $precio,
    int $cantidad
): float {

    return $precio * $cantidad;
}

function calcularTotalConIva(
    float $precio,
    int $cantidad
): float {

    $subtotal = obtenerSubtotal(
        $precio,
        $cantidad
    );

    return $subtotal * 1.19;
}

$total = calcularTotalConIva(
    15000,
    3
);

echo "Total con IVA: $"
    . $total
    . PHP_EOL;


// 15. Retornar múltiples datos mediante un array
function obtenerDatosUsuario(): array
{
    $nombre = "José";
    $edad = 25;
    $profesion = "Analista Programador";

    return [
        "nombre" => $nombre,
        "edad" => $edad,
        "profesion" => $profesion
    ];
}

$datos = obtenerDatosUsuario();

echo PHP_EOL;
echo "DATOS DEL USUARIO" . PHP_EOL;
echo "-----------------" . PHP_EOL;

echo "Nombre: "
    . $datos["nombre"]
    . PHP_EOL;

echo "Edad: "
    . $datos["edad"]
    . PHP_EOL;

echo "Profesión: "
    . $datos["profesion"]
    . PHP_EOL;


// 16. Desestructurar un array retornado
function obtenerCoordenadas(): array
{
    return [
        10,
        20
    ];
}

[$x, $y] = obtenerCoordenadas();

echo PHP_EOL;
echo "X: " . $x . PHP_EOL;
echo "Y: " . $y . PHP_EOL;


// 17. Retornar resultados de una operación
function operaciones(
    float $a,
    float $b
): array {

    return [
        "suma" => $a + $b,
        "resta" => $a - $b,
        "multiplicacion" => $a * $b,
        "division" => $b != 0
            ? $a / $b
            : null
    ];
}

$resultados = operaciones(20, 5);

echo PHP_EOL;
echo "OPERACIONES" . PHP_EOL;
echo "------------" . PHP_EOL;

echo "Suma: "
    . $resultados["suma"]
    . PHP_EOL;

echo "Resta: "
    . $resultados["resta"]
    . PHP_EOL;

echo "Multiplicación: "
    . $resultados["multiplicacion"]
    . PHP_EOL;

echo "División: "
    . $resultados["division"]
    . PHP_EOL;


// 18. Retorno booleano para validaciones
function validarEmail(string $email): bool
{
    return filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    ) !== false;
}

$email = "jose@example.com";

if (validarEmail($email)) {
    echo PHP_EOL;
    echo "Email válido."
        . PHP_EOL;
} else {
    echo PHP_EOL;
    echo "Email inválido."
        . PHP_EOL;
}


// 19. Retorno de una función con match
function obtenerNombreRol(string $rol): string
{
    return match ($rol) {
        "admin" => "Administrador",
        "editor" => "Editor",
        "usuario" => "Usuario",
        default => "Invitado"
    };
}

echo "Rol: "
    . obtenerNombreRol("admin")
    . PHP_EOL;


// 20. Función void
/*
|--------------------------------------------------------------------------
| void indica que la función NO devuelve un valor.
|
| Se utiliza normalmente cuando la función solamente realiza una acción.
|--------------------------------------------------------------------------
*/

function mostrarSeparador(): void
{
    echo str_repeat("-", 40)
        . PHP_EOL;
}

mostrarSeparador();


// 21. Diferencia entre echo y return
/*
|--------------------------------------------------------------------------
| echo:
| Muestra directamente información.
|
| return:
| Devuelve información para poder utilizarla posteriormente.
|--------------------------------------------------------------------------
*/

function usarEcho(): void
{
    echo "Este mensaje fue mostrado directamente."
        . PHP_EOL;
}

function usarReturn(): string
{
    return "Este mensaje fue devuelto.";
}

usarEcho();

$mensaje = usarReturn();

echo $mensaje . PHP_EOL;


// 22. Ejemplo práctico: calcular precio final
function calcularPrecioFinal(
    float $precio,
    int $cantidad,
    float $descuento = 0,
    float $iva = 0.19
): float {

    $subtotal = $precio * $cantidad;

    $descuentoTotal =
        $subtotal * $descuento;

    $subtotalConDescuento =
        $subtotal - $descuentoTotal;

    $impuesto =
        $subtotalConDescuento * $iva;

    return $subtotalConDescuento
        + $impuesto;
}

$total = calcularPrecioFinal(
    precio: 10000,
    cantidad: 3,
    descuento: 0.10,
    iva: 0.19
);

echo PHP_EOL;
echo "RESUMEN DE COMPRA" . PHP_EOL;
echo "-----------------" . PHP_EOL;
echo "Total final: $" . $total . PHP_EOL;