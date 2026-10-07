<?php

/*
|--------------------------------------------------------------------------
| 02 - Parámetros y argumentos
|--------------------------------------------------------------------------
| Los parámetros permiten enviar información a una función.
|
| Parámetro:
| Es la variable que recibe la función.
|
| Argumento:
| Es el valor que enviamos al llamar a la función.
|
| Ejemplo:
|
| function saludar($nombre) // $nombre = parámetro
| {
|     echo "Hola " . $nombre;
| }
|
| saludar("José"); // "José" = argumento
|--------------------------------------------------------------------------
*/


// 1. Un parámetro
function saludar($nombre)
{
    echo "Hola, " . $nombre . "!" . PHP_EOL;
}

saludar("José");
saludar("Ana");


// 2. Dos parámetros
function sumar($numero1, $numero2)
{
    echo "Suma: " . ($numero1 + $numero2) . PHP_EOL;
}

sumar(10, 20);
sumar(50, 30);


// 3. Varios parámetros
function presentar(
    $nombre,
    $profesion,
    $edad
) {
    echo "Nombre: " . $nombre . PHP_EOL;
    echo "Profesión: " . $profesion . PHP_EOL;
    echo "Edad: " . $edad . PHP_EOL;
}

presentar(
    "José",
    "Analista Programador",
    25
);


// 4. Parámetros con tipos
function multiplicar(int $a, int $b)
{
    return $a * $b;
}

$resultado = multiplicar(5, 10);

echo "Multiplicación: " . $resultado . PHP_EOL;


// 5. Parámetros string
function crearSaludo(string $nombre, string $ciudad): string
{
    return "Hola " . $nombre . ", eres de " . $ciudad . ".";
}

echo crearSaludo(
    "José",
    "Santiago"
) . PHP_EOL;


// 6. Parámetro booleano
function mostrarEstado(bool $activo)
{
    if ($activo) {
        echo "El usuario está activo." . PHP_EOL;
    } else {
        echo "El usuario está inactivo." . PHP_EOL;
    }
}

mostrarEstado(true);
mostrarEstado(false);


// 7. Parámetro array
function mostrarProductos(array $productos)
{
    foreach ($productos as $producto) {
        echo "- " . $producto . PHP_EOL;
    }
}

$productos = [
    "Notebook",
    "Mouse",
    "Teclado",
    "Monitor"
];

mostrarProductos($productos);


// 8. Parámetro con valor por defecto
function configurarUsuario(
    string $nombre,
    string $rol = "usuario"
) {
    echo "Nombre: " . $nombre . PHP_EOL;
    echo "Rol: " . $rol . PHP_EOL;
}

configurarUsuario("José");

configurarUsuario(
    "Ana",
    "administrador"
);


// 9. Varios parámetros con valores por defecto
function conectarSistema(
    string $host = "localhost",
    int $puerto = 3306,
    string $usuario = "root"
) {
    echo "Host: " . $host . PHP_EOL;
    echo "Puerto: " . $puerto . PHP_EOL;
    echo "Usuario: " . $usuario . PHP_EOL;
}

conectarSistema();

conectarSistema(
    "192.168.1.100",
    3307,
    "admin"
);


// 10. Parámetros opcionales
function calcularDescuento(
    float $precio,
    float $descuento = 0
): float {

    return $precio - ($precio * $descuento);
}

echo "Precio: $" .
    calcularDescuento(100000) .
    PHP_EOL;

echo "Precio con descuento: $" .
    calcularDescuento(100000, 0.10) .
    PHP_EOL;


// 11. Parámetros por referencia
/*
|--------------------------------------------------------------------------
| Por defecto, PHP trabaja con una copia del valor.
|
| Con "&" podemos modificar directamente la variable original.
|--------------------------------------------------------------------------
*/

function aumentarValor(int &$numero)
{
    $numero++;
}

$numero = 10;

aumentarValor($numero);

echo "Número después de la función: "
    . $numero . PHP_EOL;


// 12. Modificar un array por referencia
function agregarProducto(array &$productos, string $producto)
{
    $productos[] = $producto;
}

$productos = [
    "Notebook",
    "Mouse"
];

agregarProducto(
    $productos,
    "Teclado"
);

print_r($productos);


// 13. Cantidad variable de argumentos
/*
|--------------------------------------------------------------------------
| El operador "..." permite recibir una cantidad variable de argumentos.
|--------------------------------------------------------------------------
*/

function sumarVarios(int ...$numeros): int
{
    return array_sum($numeros);
}

echo "Resultado: "
    . sumarVarios(10, 20, 30) .
    PHP_EOL;

echo "Resultado: "
    . sumarVarios(5, 10, 15, 20, 25) .
    PHP_EOL;


// 14. Función con parámetros variables
function mostrarNumeros(int ...$numeros): void
{
    foreach ($numeros as $numero) {
        echo "Número: " . $numero . PHP_EOL;
    }
}

mostrarNumeros(
    10,
    20,
    30,
    40
);


// 15. Parámetros nombrados
/*
|--------------------------------------------------------------------------
| Desde PHP 8 podemos indicar el nombre del parámetro.
|
| Esto mejora la legibilidad cuando una función tiene muchos parámetros.
|--------------------------------------------------------------------------
*/

function registrarUsuario(
    string $nombre,
    int $edad,
    string $rol
): void {

    echo "Nombre: " . $nombre . PHP_EOL;
    echo "Edad: " . $edad . PHP_EOL;
    echo "Rol: " . $rol . PHP_EOL;
}

registrarUsuario(
    nombre: "José",
    edad: 25,
    rol: "admin"
);


// 16. Parámetros nombrados en diferente orden
registrarUsuario(
    rol: "editor",
    nombre: "Ana",
    edad: 30
);


// 17. Parámetro nullable
/*
|--------------------------------------------------------------------------
| El símbolo "?" permite que un parámetro pueda recibir:
|
| - Un valor del tipo indicado.
| - null.
|--------------------------------------------------------------------------
*/

function mostrarTelefono(?string $telefono): void
{
    if ($telefono === null) {
        echo "No tiene teléfono registrado." . PHP_EOL;
        return;
    }

    echo "Teléfono: " . $telefono . PHP_EOL;
}

mostrarTelefono("+56912345678");
mostrarTelefono(null);


// 18. Parámetro con array asociativo
function mostrarUsuario(array $usuario): void
{
    echo "Nombre: "
        . $usuario["nombre"]
        . PHP_EOL;

    echo "Email: "
        . $usuario["email"]
        . PHP_EOL;
}

$usuario = [
    "nombre" => "José",
    "email" => "jose@example.com"
];

mostrarUsuario($usuario);


// 19. Validar parámetros dentro de una función
function dividirSeguro(
    float $numero1,
    float $numero2
): ?float {

    if ($numero2 === 0.0) {
        echo "Error: no se puede dividir por cero."
            . PHP_EOL;

        return null;
    }

    return $numero1 / $numero2;
}

$resultado = dividirSeguro(10, 2);

if ($resultado !== null) {
    echo "Resultado: " . $resultado . PHP_EOL;
}

dividirSeguro(10, 0);


// 20. Ejemplo práctico: producto
function crearProducto(
    string $nombre,
    float $precio,
    int $stock = 0,
    bool $activo = true
): array {

    return [
        "nombre" => $nombre,
        "precio" => $precio,
        "stock" => $stock,
        "activo" => $activo
    ];
}

$producto = crearProducto(
    nombre: "Notebook",
    precio: 599990,
    stock: 10,
    activo: true
);

echo PHP_EOL;
echo "PRODUCTO" . PHP_EOL;
echo "--------" . PHP_EOL;

print_r($producto);


// 21. Ejemplo práctico: calcular precio final
function calcularPrecioFinal(
    float $precio,
    int $cantidad,
    float $descuento = 0,
    float $iva = 0.19
): float {

    $subtotal = $precio * $cantidad;

    $descuentoTotal = $subtotal * $descuento;

    $subtotalConDescuento =
        $subtotal - $descuentoTotal;

    $impuesto =
        $subtotalConDescuento * $iva;

    return $subtotalConDescuento + $impuesto;
}

$total = calcularPrecioFinal(
    precio: 10000,
    cantidad: 3,
    descuento: 0.10,
    iva: 0.19
);

echo PHP_EOL;
echo "Total final: $" . $total . PHP_EOL;