<?php

/*
|--------------------------------------------------------------------------
| 01 - Arrays
|--------------------------------------------------------------------------
| Un array permite almacenar múltiples valores dentro de una misma
| variable.
|
| En PHP existen diferentes formas de trabajar con arrays:
|
| - Arrays indexados
| - Arrays asociativos
| - Arrays multidimensionales
|
| Los arrays son fundamentales para trabajar con datos provenientes
| de formularios, bases de datos y APIs.
|--------------------------------------------------------------------------
*/


// 1. Crear un array indexado

$lenguajes = [
    "PHP",
    "Python",
    "JavaScript",
    "Java"
];

print_r($lenguajes);


// 2. Acceder a un elemento

echo "Primer lenguaje: "
    . $lenguajes[0]
    . PHP_EOL;

echo "Segundo lenguaje: "
    . $lenguajes[1]
    . PHP_EOL;


// 3. Modificar un elemento

$lenguajes[1] = "C#";

echo "Lenguajes modificados:"
    . PHP_EOL;

print_r($lenguajes);


// 4. Agregar un elemento

$lenguajes[] = "C++";

print_r($lenguajes);


// 5. Agregar varios elementos

$lenguajes[] = "Go";
$lenguajes[] = "Kotlin";

print_r($lenguajes);


// 6. Contar elementos

$cantidad = count($lenguajes);

echo "Cantidad de lenguajes: "
    . $cantidad
    . PHP_EOL;


// 7. Recorrer un array con for

echo PHP_EOL;
echo "RECORRIDO CON FOR"
    . PHP_EOL;
echo "-----------------"
    . PHP_EOL;

for (
    $i = 0;
    $i < count($lenguajes);
    $i++
) {

    echo $i . ": "
        . $lenguajes[$i]
        . PHP_EOL;
}


// 8. Recorrer un array con foreach

echo PHP_EOL;
echo "RECORRIDO CON FOREACH"
    . PHP_EOL;
echo "---------------------"
    . PHP_EOL;

foreach ($lenguajes as $lenguaje) {

    echo "- "
        . $lenguaje
        . PHP_EOL;
}


// 9. Obtener índice y valor

echo PHP_EOL;
echo "ÍNDICE Y VALOR"
    . PHP_EOL;

foreach (
    $lenguajes as $indice => $lenguaje
) {

    echo "Índice: "
        . $indice
        . " | Lenguaje: "
        . $lenguaje
        . PHP_EOL;
}


// 10. Verificar si existe un índice

if (isset($lenguajes[0])) {

    echo PHP_EOL;
    echo "El índice 0 existe."
        . PHP_EOL;
}


// 11. Verificar si existe un valor

if (in_array("PHP", $lenguajes)) {

    echo "PHP está dentro del array."
        . PHP_EOL;
}


// 12. Array con números

$numeros = [
    10,
    20,
    30,
    40,
    50
];

echo PHP_EOL;
echo "NÚMEROS"
    . PHP_EOL;

foreach ($numeros as $numero) {

    echo $numero
        . PHP_EOL;
}


// 13. Sumar elementos

$suma = array_sum($numeros);

echo "Suma: "
    . $suma
    . PHP_EOL;


// 14. Promedio

$promedio = $suma / count($numeros);

echo "Promedio: "
    . $promedio
    . PHP_EOL;


// 15. Mínimo y máximo

echo "Mínimo: "
    . min($numeros)
    . PHP_EOL;

echo "Máximo: "
    . max($numeros)
    . PHP_EOL;


// 16. Ordenar un array

$notas = [
    5.5,
    6.8,
    4.2,
    7.0,
    3.9
];

sort($notas);

echo PHP_EOL;
echo "NOTAS ORDENADAS"
    . PHP_EOL;

print_r($notas);


// 17. Ordenar de mayor a menor

rsort($notas);

echo "NOTAS DESCENDENTES"
    . PHP_EOL;

print_r($notas);


// 18. Array asociativo

/*
|--------------------------------------------------------------------------
| Un array asociativo utiliza claves personalizadas.
|--------------------------------------------------------------------------
*/

$usuario = [
    "nombre" => "José",
    "edad" => 25,
    "profesion" => "Analista Programador",
    "ciudad" => "Santiago"
];

echo PHP_EOL;
echo "USUARIO"
    . PHP_EOL;

echo "Nombre: "
    . $usuario["nombre"]
    . PHP_EOL;

echo "Edad: "
    . $usuario["edad"]
    . PHP_EOL;

echo "Profesión: "
    . $usuario["profesion"]
    . PHP_EOL;

echo "Ciudad: "
    . $usuario["ciudad"]
    . PHP_EOL;


// 19. Modificar un array asociativo

$usuario["edad"] = 26;

$usuario["experiencia"] = "PHP";

print_r($usuario);


// 20. Recorrer array asociativo

echo PHP_EOL;
echo "DATOS DEL USUARIO"
    . PHP_EOL;

foreach (
    $usuario as $clave => $valor
) {

    echo $clave
        . ": "
        . $valor
        . PHP_EOL;
}


// 21. Verificar si existe una clave

if (array_key_exists("email", $usuario)) {

    echo "El email existe."
        . PHP_EOL;

} else {

    echo "El email no existe."
        . PHP_EOL;
}


// 22. Agregar una clave

$usuario["email"] = "jose@example.com";

echo "Email: "
    . $usuario["email"]
    . PHP_EOL;


// 23. Eliminar un elemento

unset($usuario["ciudad"]);

echo PHP_EOL;
echo "Usuario después de eliminar ciudad:"
    . PHP_EOL;

print_r($usuario);


// 24. Array multidimensional

/*
|--------------------------------------------------------------------------
| Un array multidimensional es un array que contiene otros arrays.
|--------------------------------------------------------------------------
*/

$usuarios = [

    [
        "nombre" => "José",
        "edad" => 25,
        "rol" => "admin"
    ],

    [
        "nombre" => "Ana",
        "edad" => 30,
        "rol" => "editor"
    ],

    [
        "nombre" => "Pedro",
        "edad" => 28,
        "rol" => "usuario"
    ]

];

echo PHP_EOL;
echo "USUARIOS"
    . PHP_EOL;

foreach ($usuarios as $usuario) {

    echo "Nombre: "
        . $usuario["nombre"]
        . PHP_EOL;

    echo "Rol: "
        . $usuario["rol"]
        . PHP_EOL;

    echo "----------------"
        . PHP_EOL;
}


// 25. Acceder directamente a un array multidimensional

echo "Primer usuario: "
    . $usuarios[0]["nombre"]
    . PHP_EOL;

echo "Segundo usuario: "
    . $usuarios[1]["nombre"]
    . PHP_EOL;


// 26. Modificar un array multidimensional

$usuarios[0]["rol"] = "superadmin";

echo PHP_EOL;
echo "Usuario actualizado:"
    . PHP_EOL;

print_r($usuarios[0]);


// 27. Array dentro de otro array

$empresa = [

    "nombre" => "Caytech",

    "tecnologias" => [
        "PHP",
        "Laravel",
        "MySQL",
        "JavaScript"
    ]

];

echo PHP_EOL;
echo "EMPRESA"
    . PHP_EOL;

echo "Nombre: "
    . $empresa["nombre"]
    . PHP_EOL;

echo "Tecnologías:"
    . PHP_EOL;

foreach (
    $empresa["tecnologias"]
    as $tecnologia
) {

    echo "- "
        . $tecnologia
        . PHP_EOL;
}


// 28. Array vacío

$proyectos = [];

$proyectos[] = "Sistema CRM";
$proyectos[] = "API REST";
$proyectos[] = "Aplicación Android";

echo PHP_EOL;
echo "PROYECTOS"
    . PHP_EOL;

print_r($proyectos);


// 29. Array con diferentes tipos

$datos = [
    "José",
    25,
    1.75,
    true,
    null
];

echo PHP_EOL;
echo "TIPOS DE DATOS"
    . PHP_EOL;

foreach ($datos as $dato) {

    var_dump($dato);
}


// 30. Comprobar si un array está vacío

$carrito = [];

if (empty($carrito)) {

    echo PHP_EOL;
    echo "El carrito está vacío."
        . PHP_EOL;
}


// 31. Limpiar un array

$numeros = [
    10,
    20,
    30
];

$numeros = [];

echo "Array limpiado:"
    . PHP_EOL;

print_r($numeros);


// 32. Ejemplo práctico: carrito de compras

$carrito = [

    [
        "producto" => "Notebook",
        "precio" => 500000,
        "cantidad" => 1
    ],

    [
        "producto" => "Mouse",
        "precio" => 15000,
        "cantidad" => 2
    ],

    [
        "producto" => "Teclado",
        "precio" => 30000,
        "cantidad" => 1
    ]

];

$total = 0;

echo PHP_EOL;
echo "CARRITO DE COMPRA"
    . PHP_EOL;
echo "-----------------"
    . PHP_EOL;

foreach ($carrito as $producto) {

    $subtotal =
        $producto["precio"]
        * $producto["cantidad"];

    $total += $subtotal;

    echo "Producto: "
        . $producto["producto"]
        . PHP_EOL;

    echo "Subtotal: $"
        . $subtotal
        . PHP_EOL;

    echo "-----------------"
        . PHP_EOL;
}

echo "TOTAL: $"
    . $total
    . PHP_EOL;