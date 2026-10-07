<?php

/*
|--------------------------------------------------------------------------
| 04 - Funciones anónimas
|--------------------------------------------------------------------------
| Una función anónima es una función que no tiene un nombre.
|
| En lugar de declarar:
|
| function sumar() {}
|
| podemos guardar la función en una variable:
|
| $sumar = function () {};
|
| Las funciones anónimas son muy utilizadas en:
|
| - array_map()
| - array_filter()
| - array_reduce()
| - Callbacks
| - Closures
| - Procesamiento de datos
|--------------------------------------------------------------------------
*/


// 1. Función anónima básica

$saludar = function () {
    echo "Hola desde una función anónima."
        . PHP_EOL;
};

$saludar();


// 2. Función anónima con parámetro

$saludarUsuario = function (string $nombre) {
    echo "Hola, " . $nombre . "!"
        . PHP_EOL;
};

$saludarUsuario("José");
$saludarUsuario("Ana");


// 3. Función anónima con retorno

$sumar = function (int $a, int $b): int {
    return $a + $b;
};

$resultado = $sumar(10, 20);

echo "Resultado: "
    . $resultado
    . PHP_EOL;


// 4. Función anónima con varios parámetros

$calcularTotal = function (
    float $precio,
    int $cantidad
): float {

    return $precio * $cantidad;
};

$total = $calcularTotal(
    15000,
    3
);

echo "Total: $"
    . $total
    . PHP_EOL;


// 5. Guardar diferentes funciones en variables

$sumar = function (int $a, int $b): int {
    return $a + $b;
};

$restar = function (int $a, int $b): int {
    return $a - $b;
};

$multiplicar = function (int $a, int $b): int {
    return $a * $b;
};

echo "Suma: "
    . $sumar(20, 10)
    . PHP_EOL;

echo "Resta: "
    . $restar(20, 10)
    . PHP_EOL;

echo "Multiplicación: "
    . $multiplicar(20, 10)
    . PHP_EOL;


// 6. Función anónima como argumento

function ejecutarOperacion(
    int $a,
    int $b,
    callable $operacion
): int {

    return $operacion($a, $b);
}

$sumar = function (int $a, int $b): int {
    return $a + $b;
};

$resultado = ejecutarOperacion(
    10,
    5,
    $sumar
);

echo "Resultado: "
    . $resultado
    . PHP_EOL;


// 7. Callback

/*
|--------------------------------------------------------------------------
| Un callback es una función que se entrega a otra función
| para que esta pueda ejecutarla.
|--------------------------------------------------------------------------
*/

function procesarNumero(
    int $numero,
    callable $callback
): void {

    $resultado = $callback($numero);

    echo "Resultado: "
        . $resultado
        . PHP_EOL;
}

procesarNumero(
    10,
    function (int $numero): int {
        return $numero * 2;
    }
);


// 8. Función anónima dentro de un array

$operaciones = [

    "sumar" => function (int $a, int $b): int {
        return $a + $b;
    },

    "restar" => function (int $a, int $b): int {
        return $a - $b;
    },

    "multiplicar" => function (int $a, int $b): int {
        return $a * $b;
    }

];

echo "Suma: "
    . $operaciones["sumar"](10, 5)
    . PHP_EOL;

echo "Resta: "
    . $operaciones["restar"](10, 5)
    . PHP_EOL;

echo "Multiplicación: "
    . $operaciones["multiplicar"](10, 5)
    . PHP_EOL;


// 9. Función anónima con use()

/*
|--------------------------------------------------------------------------
| use() permite utilizar una variable externa dentro de una Closure.
|--------------------------------------------------------------------------
*/

$nombre = "José";

$saludar = function () use ($nombre) {

    echo "Hola, " . $nombre . "!"
        . PHP_EOL;
};

$saludar();


// 10. use() con varias variables

$nombre = "José";
$profesion = "Analista Programador";

$presentar = function () use (
    $nombre,
    $profesion
) {

    echo "Nombre: "
        . $nombre
        . PHP_EOL;

    echo "Profesión: "
        . $profesion
        . PHP_EOL;
};

$presentar();


// 11. Capturar una variable por referencia

$contador = 0;

$incrementar = function () use (&$contador) {

    $contador++;
};

$incrementar();
$incrementar();
$incrementar();

echo "Contador: "
    . $contador
    . PHP_EOL;


// 12. array_map()

/*
|--------------------------------------------------------------------------
| array_map()
|
| Ejecuta una función sobre cada elemento de un array.
|--------------------------------------------------------------------------
*/

$numeros = [
    1,
    2,
    3,
    4,
    5
];

$dobles = array_map(
    function (int $numero): int {
        return $numero * 2;
    },
    $numeros
);

print_r($dobles);


// 13. array_map() con strings

$nombres = [
    "jose",
    "ana",
    "pedro"
];

$nombresMayuscula = array_map(
    function (string $nombre): string {
        return strtoupper($nombre);
    },
    $nombres
);

print_r($nombresMayuscula);


// 14. array_filter()

/*
|--------------------------------------------------------------------------
| array_filter()
|
| Permite filtrar elementos de un array.
|
| La función debe devolver:
|
| true  -> conservar elemento
| false -> eliminar elemento
|--------------------------------------------------------------------------
*/

$numeros = [
    1,
    2,
    3,
    4,
    5,
    6
];

$pares = array_filter(
    $numeros,
    function (int $numero): bool {
        return $numero % 2 === 0;
    }
);

print_r($pares);


// 15. Filtrar usuarios

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

$usuariosActivos = array_filter(
    $usuarios,
    function (array $usuario): bool {
        return $usuario["activo"] === true;
    }
);

print_r($usuariosActivos);


// 16. array_reduce()

/*
|--------------------------------------------------------------------------
| array_reduce()
|
| Permite reducir un array a un único resultado.
|--------------------------------------------------------------------------
*/

$numeros = [
    10,
    20,
    30,
    40
];

$total = array_reduce(
    $numeros,
    function (
        int $acumulador,
        int $numero
    ): int {

        return $acumulador + $numero;
    },
    0
);

echo "Total: "
    . $total
    . PHP_EOL;


// 17. array_reduce() para calcular un total

$productos = [
    [
        "nombre" => "Notebook",
        "precio" => 500000
    ],
    [
        "nombre" => "Mouse",
        "precio" => 15000
    ],
    [
        "nombre" => "Teclado",
        "precio" => 30000
    ]
];

$total = array_reduce(
    $productos,
    function (
        float $total,
        array $producto
    ): float {

        return $total + $producto["precio"];
    },
    0
);

echo "Total productos: $"
    . $total
    . PHP_EOL;


// 18. Funciones flecha

/*
|--------------------------------------------------------------------------
| Las funciones flecha se introdujeron en PHP 7.4.
|
| Sintaxis:
|
| fn($valor) => expresion
|
| Son una forma corta de escribir funciones anónimas.
|--------------------------------------------------------------------------
*/

$doblar = fn(int $numero): int => $numero * 2;

echo "Doble: "
    . $doblar(10)
    . PHP_EOL;


// 19. Función flecha con dos parámetros

$sumar = fn(
    int $a,
    int $b
): int => $a + $b;

echo "Suma: "
    . $sumar(10, 20)
    . PHP_EOL;


// 20. Función flecha con array_map()

$numeros = [
    1,
    2,
    3,
    4,
    5
];

$cuadrados = array_map(
    fn(int $numero): int => $numero ** 2,
    $numeros
);

print_r($cuadrados);


// 21. Función flecha con array_filter()

$mayoresDeEdad = [
    15,
    18,
    21,
    16,
    30,
    14
];

$resultado = array_filter(
    $mayoresDeEdad,
    fn(int $edad): bool => $edad >= 18
);

print_r($resultado);


// 22. Función flecha utilizando variables externas

$iva = 0.19;

/*
|--------------------------------------------------------------------------
| Las funciones flecha capturan automáticamente las variables externas
| por valor.
|--------------------------------------------------------------------------
*/

$calcularIva = fn(float $precio): float =>
    $precio * $iva;

echo "IVA: $"
    . $calcularIva(10000)
    . PHP_EOL;


// 23. Closure

/*
|--------------------------------------------------------------------------
| Una Closure es una función anónima que puede capturar variables
| del contexto exterior.
|--------------------------------------------------------------------------
*/

$descuento = 0.10;

$calcularDescuento = function (
    float $precio
) use ($descuento): float {

    return $precio * $descuento;
};

echo "Descuento: $"
    . $calcularDescuento(50000)
    . PHP_EOL;


// 24. Función que devuelve otra función

function crearMultiplicador(
    int $multiplicador
): Closure {

    return function (int $numero) use ($multiplicador): int {

        return $numero * $multiplicador;
    };
}

$duplicar = crearMultiplicador(2);

$triplicar = crearMultiplicador(3);

echo "Duplicar: "
    . $duplicar(10)
    . PHP_EOL;

echo "Triplicar: "
    . $triplicar(10)
    . PHP_EOL;


// 25. Ejemplo práctico: procesar productos

$productos = [
    [
        "nombre" => "Notebook",
        "precio" => 500000
    ],
    [
        "nombre" => "Mouse",
        "precio" => 15000
    ],
    [
        "nombre" => "Teclado",
        "precio" => 30000
    ]
];

$preciosConIva = array_map(
    fn(array $producto): array => [
        "nombre" => $producto["nombre"],
        "precio" => $producto["precio"] * 1.19
    ],
    $productos
);

echo PHP_EOL;
echo "PRODUCTOS CON IVA" . PHP_EOL;
echo "------------------" . PHP_EOL;

print_r($preciosConIva);


// 26. Ejemplo práctico: filtrar productos

$productosCaros = array_filter(
    $productos,
    fn(array $producto): bool =>
        $producto["precio"] >= 30000
);

echo PHP_EOL;
echo "PRODUCTOS SOBRE $30.000" . PHP_EOL;
echo "-----------------------" . PHP_EOL;

print_r($productosCaros);


// 27. Ejemplo práctico: total de productos

$total = array_reduce(
    $productos,
    fn(
        float $total,
        array $producto
    ): float =>
        $total + $producto["precio"],
    0
);

echo PHP_EOL;
echo "TOTAL: $" . $total . PHP_EOL;