<?php

/*
|--------------------------------------------------------------------------
| 04 - Funciones para trabajar con arrays
|--------------------------------------------------------------------------
| PHP incluye muchas funciones para manipular arrays.
|
| En este archivo aprenderemos:
|
| - count()
| - in_array()
| - array_search()
| - array_keys()
| - array_values()
| - array_merge()
| - array_slice()
| - array_splice()
| - array_push()
| - array_pop()
| - array_shift()
| - array_unshift()
| - sort()
| - rsort()
| - asort()
| - arsort()
| - ksort()
| - krsort()
| - array_reverse()
| - array_unique()
| - array_sum()
| - min()
| - max()
| - range()
|--------------------------------------------------------------------------
*/


// 1. count()
/*
|--------------------------------------------------------------------------
| count() devuelve la cantidad de elementos de un array.
|--------------------------------------------------------------------------
*/

$lenguajes = [
    "PHP",
    "Python",
    "JavaScript",
    "Java"
];

echo "Cantidad de lenguajes: "
    . count($lenguajes)
    . PHP_EOL;


// 2. in_array()
/*
|--------------------------------------------------------------------------
| in_array() verifica si un valor existe dentro de un array.
|--------------------------------------------------------------------------
*/

if (in_array("PHP", $lenguajes)) {

    echo "PHP está en el array."
        . PHP_EOL;
}


// 3. in_array() con comparación estricta

$numeros = [
    10,
    20,
    30
];

if (in_array(10, $numeros, true)) {

    echo "El número 10 existe."
        . PHP_EOL;
}


// 4. array_search()
/*
|--------------------------------------------------------------------------
| array_search() devuelve la posición o clave donde encontró el valor.
|--------------------------------------------------------------------------
*/

$posicion = array_search(
    "JavaScript",
    $lenguajes
);

if ($posicion !== false) {

    echo "JavaScript está en la posición: "
        . $posicion
        . PHP_EOL;
}


// 5. array_keys()

$usuario = [

    "nombre" => "José",
    "edad" => 25,
    "profesion" => "Analista Programador",
    "ciudad" => "Santiago"

];

$claves = array_keys($usuario);

echo PHP_EOL;
echo "CLAVES"
    . PHP_EOL;

print_r($claves);


// 6. array_values()

$valores = array_values($usuario);

echo "VALORES"
    . PHP_EOL;

print_r($valores);


// 7. array_merge()

$frontend = [
    "HTML",
    "CSS",
    "JavaScript"
];

$backend = [
    "PHP",
    "Laravel",
    "MySQL"
];

$tecnologias = array_merge(
    $frontend,
    $backend
);

echo PHP_EOL;
echo "TECNOLOGÍAS"
    . PHP_EOL;

print_r($tecnologias);


// 8. array_merge() con arrays asociativos

$datosPersonales = [

    "nombre" => "José",
    "edad" => 25

];

$datosProfesionales = [

    "profesion" => "Analista Programador",
    "experiencia" => "PHP"

];

$datos = array_merge(
    $datosPersonales,
    $datosProfesionales
);

print_r($datos);


// 9. array_slice()
/*
|--------------------------------------------------------------------------
| array_slice() obtiene una parte del array sin modificar el original.
|--------------------------------------------------------------------------
*/

$numeros = [
    10,
    20,
    30,
    40,
    50
];

$parte = array_slice(
    $numeros,
    1,
    3
);

echo PHP_EOL;
echo "PARTE DEL ARRAY"
    . PHP_EOL;

print_r($parte);

echo "ARRAY ORIGINAL"
    . PHP_EOL;

print_r($numeros);


// 10. array_slice() desde una posición

$parte = array_slice(
    $numeros,
    2
);

print_r($parte);


// 11. array_splice()
/*
|--------------------------------------------------------------------------
| array_splice() elimina y/o reemplaza elementos.
|
| A diferencia de array_slice(), modifica el array original.
|--------------------------------------------------------------------------
*/

$numeros = [
    10,
    20,
    30,
    40,
    50
];

array_splice(
    $numeros,
    1,
    2
);

echo PHP_EOL;
echo "ARRAY DESPUÉS DE ELIMINAR"
    . PHP_EOL;

print_r($numeros);


// 12. array_splice() agregando elementos

$numeros = [
    10,
    20,
    50
];

array_splice(
    $numeros,
    2,
    0,
    [30, 40]
);

echo "ARRAY DESPUÉS DE AGREGAR"
    . PHP_EOL;

print_r($numeros);


// 13. array_push()
/*
|--------------------------------------------------------------------------
| Agrega uno o más elementos al final.
|--------------------------------------------------------------------------
*/

$frutas = [
    "Manzana",
    "Pera"
];

array_push(
    $frutas,
    "Naranja",
    "Plátano"
);

print_r($frutas);


// 14. Agregar con []

$frutas[] = "Uva";

print_r($frutas);


// 15. array_pop()
/*
|--------------------------------------------------------------------------
| Elimina y devuelve el último elemento.
|--------------------------------------------------------------------------
*/

$ultimaFruta = array_pop($frutas);

echo "Fruta eliminada: "
    . $ultimaFruta
    . PHP_EOL;

print_r($frutas);


// 16. array_shift()
/*
|--------------------------------------------------------------------------
| Elimina y devuelve el primer elemento.
|--------------------------------------------------------------------------
*/

$primeraFruta = array_shift($frutas);

echo "Primera fruta eliminada: "
    . $primeraFruta
    . PHP_EOL;

print_r($frutas);


// 17. array_unshift()
/*
|--------------------------------------------------------------------------
| Agrega elementos al principio.
|--------------------------------------------------------------------------
*/

array_unshift(
    $frutas,
    "Manzana",
    "Pera"
);

print_r($frutas);


// 18. sort()
/*
|--------------------------------------------------------------------------
| Ordena valores de menor a mayor.
| Reindexa las claves numéricas.
|--------------------------------------------------------------------------
*/

$numeros = [
    50,
    10,
    40,
    20,
    30
];

sort($numeros);

echo PHP_EOL;
echo "ORDEN ASCENDENTE"
    . PHP_EOL;

print_r($numeros);


// 19. rsort()

rsort($numeros);

echo "ORDEN DESCENDENTE"
    . PHP_EOL;

print_r($numeros);


// 20. asort()
/*
|--------------------------------------------------------------------------
| Ordena por valores manteniendo las claves.
|--------------------------------------------------------------------------
*/

$precios = [

    "Notebook" => 500000,
    "Mouse" => 15000,
    "Teclado" => 30000

];

asort($precios);

echo PHP_EOL;
echo "PRECIOS ASCENDENTES"
    . PHP_EOL;

print_r($precios);


// 21. arsort()

arsort($precios);

echo "PRECIOS DESCENDENTES"
    . PHP_EOL;

print_r($precios);


// 22. ksort()
/*
|--------------------------------------------------------------------------
| Ordena por las claves.
|--------------------------------------------------------------------------
*/

ksort($precios);

echo PHP_EOL;
echo "ORDEN POR CLAVE"
    . PHP_EOL;

print_r($precios);


// 23. krsort()

krsort($precios);

echo "CLAVES DESCENDENTES"
    . PHP_EOL;

print_r($precios);


// 24. array_reverse()

$numeros = [
    1,
    2,
    3,
    4,
    5
];

$invertidos = array_reverse($numeros);

echo PHP_EOL;
echo "ARRAY INVERTIDO"
    . PHP_EOL;

print_r($invertidos);


// 25. array_unique()
/*
|--------------------------------------------------------------------------
| Elimina valores duplicados.
|--------------------------------------------------------------------------
*/

$tecnologias = [

    "PHP",
    "Laravel",
    "PHP",
    "MySQL",
    "Laravel",
    "JavaScript"

];

$unicas = array_unique(
    $tecnologias
);

echo PHP_EOL;
echo "SIN DUPLICADOS"
    . PHP_EOL;

print_r($unicas);


// 26. array_sum()

$ventas = [
    10000,
    25000,
    50000,
    15000
];

$total = array_sum($ventas);

echo PHP_EOL;
echo "Total ventas: $"
    . $total
    . PHP_EOL;


// 27. min() y max()

$notas = [
    5.5,
    6.8,
    4.2,
    7.0,
    3.9
];

echo "Nota mínima: "
    . min($notas)
    . PHP_EOL;

echo "Nota máxima: "
    . max($notas)
    . PHP_EOL;


// 28. range()
/*
|--------------------------------------------------------------------------
| range() genera un array de valores.
|--------------------------------------------------------------------------
*/

$numeros = range(
    1,
    10
);

echo PHP_EOL;
echo "NÚMEROS DEL 1 AL 10"
    . PHP_EOL;

print_r($numeros);


// 29. range() con saltos

$pares = range(
    2,
    20,
    2
);

echo "NÚMEROS PARES"
    . PHP_EOL;

print_r($pares);


// 30. array_fill()
/*
|--------------------------------------------------------------------------
| array_fill() crea un array con una cantidad determinada de elementos.
|--------------------------------------------------------------------------
*/

$valores = array_fill(
    0,
    5,
    0
);

echo PHP_EOL;
echo "ARRAY RELLENADO"
    . PHP_EOL;

print_r($valores);


// 31. array_column()
/*
|--------------------------------------------------------------------------
| array_column() obtiene una columna específica de un array
| multidimensional.
|--------------------------------------------------------------------------
*/

$usuarios = [

    [
        "id" => 1,
        "nombre" => "José",
        "email" => "jose@example.com"
    ],

    [
        "id" => 2,
        "nombre" => "Ana",
        "email" => "ana@example.com"
    ],

    [
        "id" => 3,
        "nombre" => "Pedro",
        "email" => "pedro@example.com"
    ]

];

$nombres = array_column(
    $usuarios,
    "nombre"
);

echo PHP_EOL;
echo "NOMBRES"
    . PHP_EOL;

print_r($nombres);


// 32. array_column() obteniendo IDs

$ids = array_column(
    $usuarios,
    "id"
);

echo "IDS"
    . PHP_EOL;

print_r($ids);


// 33. array_column() usando una clave

$usuariosPorId = array_column(
    $usuarios,
    null,
    "id"
);

echo PHP_EOL;
echo "USUARIOS INDEXADOS POR ID"
    . PHP_EOL;

print_r($usuariosPorId);


// 34. array_chunk()
/*
|--------------------------------------------------------------------------
| Divide un array en grupos.
|--------------------------------------------------------------------------
*/

$numeros = range(
    1,
    10
);

$grupos = array_chunk(
    $numeros,
    3
);

echo PHP_EOL;
echo "GRUPOS"
    . PHP_EOL;

print_r($grupos);


// 35. array_combine()

$campos = [
    "nombre",
    "edad",
    "profesion"
];

$valores = [
    "José",
    25,
    "Analista Programador"
];

$usuario = array_combine(
    $campos,
    $valores
);

echo PHP_EOL;
echo "USUARIO"
    . PHP_EOL;

print_r($usuario);


// 36. array_flip()

$roles = [

    "admin" => "Administrador",
    "editor" => "Editor",
    "usuario" => "Usuario"

];

$rolesInvertidos = array_flip(
    $roles
);

echo PHP_EOL;
echo "ROLES INVERTIDOS"
    . PHP_EOL;

print_r($rolesInvertidos);


// 37. Ejemplo práctico: buscar productos

$productos = [

    [
        "id" => 1,
        "nombre" => "Notebook",
        "precio" => 500000
    ],

    [
        "id" => 2,
        "nombre" => "Mouse",
        "precio" => 15000
    ],

    [
        "id" => 3,
        "nombre" => "Teclado",
        "precio" => 30000
    ]

];

$idsProductos = array_column(
    $productos,
    "id"
);

$idBuscado = 2;

$posicion = array_search(
    $idBuscado,
    $idsProductos,
    true
);

if ($posicion !== false) {

    echo PHP_EOL;
    echo "PRODUCTO ENCONTRADO"
        . PHP_EOL;

    print_r($productos[$posicion]);

} else {

    echo "Producto no encontrado."
        . PHP_EOL;
}


// 38. Ejemplo práctico: estadísticas

$ventas = [
    100000,
    250000,
    150000,
    300000,
    200000
];

$total = array_sum($ventas);

$cantidad = count($ventas);

$promedio = $total / $cantidad;

echo PHP_EOL;
echo "ESTADÍSTICAS DE VENTAS"
    . PHP_EOL;
echo "----------------------"
    . PHP_EOL;

echo "Cantidad: "
    . $cantidad
    . PHP_EOL;

echo "Total: $"
    . $total
    . PHP_EOL;

echo "Promedio: $"
    . $promedio
    . PHP_EOL;

echo "Mínimo: $"
    . min($ventas)
    . PHP_EOL;

echo "Máximo: $"
    . max($ventas)
    . PHP_EOL;


// 39. Ejemplo práctico: inventario

$inventario = [

    "Notebook" => 10,
    "Mouse" => 25,
    "Teclado" => 15,
    "Monitor" => 5

];

echo PHP_EOL;
echo "INVENTARIO"
    . PHP_EOL;
echo "----------"
    . PHP_EOL;

foreach (
    $inventario as $producto => $stock
) {

    echo $producto
        . ": "
        . $stock
        . " unidades"
        . PHP_EOL;
}


// 40. Verificar inventario

foreach (
    $inventario as $producto => $stock
) {

    if ($stock <= 5) {

        echo "Stock bajo: "
            . $producto
            . PHP_EOL;
    }
}