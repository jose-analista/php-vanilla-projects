<?php

/*
|--------------------------------------------------------------------------
| 02 - Arrays asociativos
|--------------------------------------------------------------------------
| Los arrays asociativos utilizan claves personalizadas en lugar de
| índices numéricos.
|
| Ejemplo:
|
| $usuario = [
|     "nombre" => "José",
|     "edad" => 25
| ];
|
| Podemos acceder utilizando la clave:
|
| $usuario["nombre"]
|
| Este tipo de array es muy utilizado para representar:
|
| - Usuarios
| - Productos
| - Clientes
| - Configuraciones
| - Respuestas de APIs
| - Registros de bases de datos
|--------------------------------------------------------------------------
*/


// 1. Crear un array asociativo

$usuario = [
    "nombre" => "José",
    "edad" => 25,
    "profesion" => "Analista Programador",
    "ciudad" => "Santiago"
];

print_r($usuario);


// 2. Acceder a valores mediante claves

echo "Nombre: "
    . $usuario["nombre"]
    . PHP_EOL;

echo "Edad: "
    . $usuario["edad"]
    . PHP_EOL;

echo "Profesión: "
    . $usuario["profesion"]
    . PHP_EOL;


// 3. Modificar valores

$usuario["edad"] = 26;

$usuario["ciudad"] = "Concepción";

echo PHP_EOL;
echo "Usuario modificado:"
    . PHP_EOL;

print_r($usuario);


// 4. Agregar nuevas claves

$usuario["email"] = "jose@example.com";

$usuario["telefono"] = "+56912345678";

print_r($usuario);


// 5. Eliminar una clave

unset($usuario["telefono"]);

echo PHP_EOL;
echo "Después de eliminar teléfono:"
    . PHP_EOL;

print_r($usuario);


// 6. Recorrer claves y valores

echo PHP_EOL;
echo "DATOS DEL USUARIO"
    . PHP_EOL;
echo "-----------------"
    . PHP_EOL;

foreach (
    $usuario as $clave => $valor
) {

    echo $clave
        . ": "
        . $valor
        . PHP_EOL;
}


// 7. Obtener solamente las claves

$claves = array_keys($usuario);

echo PHP_EOL;
echo "CLAVES"
    . PHP_EOL;

print_r($claves);


// 8. Obtener solamente los valores

$valores = array_values($usuario);

echo "VALORES"
    . PHP_EOL;

print_r($valores);


// 9. Verificar si existe una clave

if (array_key_exists("email", $usuario)) {

    echo "La clave email existe."
        . PHP_EOL;

} else {

    echo "La clave email no existe."
        . PHP_EOL;
}


// 10. Verificar con isset()

if (isset($usuario["email"])) {

    echo "El email está definido."
        . PHP_EOL;

}


// 11. Diferencia entre isset() y array_key_exists()

$datos = [
    "nombre" => "José",
    "email" => null
];

if (isset($datos["email"])) {

    echo "isset(): el email tiene un valor."
        . PHP_EOL;

} else {

    echo "isset(): email no definido o es null."
        . PHP_EOL;
}

if (array_key_exists("email", $datos)) {

    echo "array_key_exists(): la clave email existe."
        . PHP_EOL;
}


// 12. Buscar una clave

$claveBuscada = array_search(
    "José",
    $usuario
);

if ($claveBuscada !== false) {

    echo "José está en la clave: "
        . $claveBuscada
        . PHP_EOL;
}


// 13. Buscar un valor

if (in_array(
    "Santiago",
    $usuario,
    true
)) {

    echo "Santiago está dentro del array."
        . PHP_EOL;
}


// 14. Combinar arrays

$datosPersonales = [
    "nombre" => "José",
    "edad" => 25
];

$datosProfesionales = [
    "profesion" => "Analista Programador",
    "experiencia" => "PHP"
];

$datosCompletos = array_merge(
    $datosPersonales,
    $datosProfesionales
);

echo PHP_EOL;
echo "DATOS COMPLETOS"
    . PHP_EOL;

print_r($datosCompletos);


// 15. Sobrescribir claves con array_merge()

$datos1 = [
    "nombre" => "José",
    "ciudad" => "Santiago"
];

$datos2 = [
    "ciudad" => "Concepción",
    "profesion" => "Programador"
];

$resultado = array_merge(
    $datos1,
    $datos2
);

print_r($resultado);


// 16. Extraer un valor con null coalescing

$email = $usuario["email"]
    ?? "Sin email";

echo "Email: "
    . $email
    . PHP_EOL;


// 17. Crear array con compact()

$nombre = "José";
$edad = 25;
$profesion = "Analista Programador";

$usuario = compact(
    "nombre",
    "edad",
    "profesion"
);

echo PHP_EOL;
echo "USUARIO CON COMPACT()"
    . PHP_EOL;

print_r($usuario);


// 18. Extraer variables con extract()

$datos = [
    "nombre" => "José",
    "edad" => 25
];

extract($datos);

echo "Nombre: "
    . $nombre
    . PHP_EOL;

echo "Edad: "
    . $edad
    . PHP_EOL;


// 19. Contar elementos

$cantidad = count($usuario);

echo "Cantidad de datos: "
    . $cantidad
    . PHP_EOL;


// 20. Comprobar si un array está vacío

$carrito = [];

if (empty($carrito)) {

    echo "El carrito está vacío."
        . PHP_EOL;
}


// 21. Ordenar por valores

$precios = [
    "Notebook" => 500000,
    "Mouse" => 15000,
    "Teclado" => 30000
];

asort($precios);

echo PHP_EOL;
echo "PRECIOS DE MENOR A MAYOR"
    . PHP_EOL;

print_r($precios);


// 22. Ordenar por valores de mayor a menor

arsort($precios);

echo "PRECIOS DE MAYOR A MENOR"
    . PHP_EOL;

print_r($precios);


// 23. Ordenar por claves

ksort($precios);

echo "ORDENADOS POR PRODUCTO"
    . PHP_EOL;

print_r($precios);


// 24. Ordenar claves de forma descendente

krsort($precios);

echo "CLAVES DESCENDENTES"
    . PHP_EOL;

print_r($precios);


// 25. array_flip()

/*
|--------------------------------------------------------------------------
| array_flip()
|
| Intercambia claves y valores.
|--------------------------------------------------------------------------
*/

$roles = [
    "admin" => "Administrador",
    "editor" => "Editor",
    "usuario" => "Usuario"
];

$rolesInvertidos = array_flip($roles);

echo PHP_EOL;
echo "ROLES INVERTIDOS"
    . PHP_EOL;

print_r($rolesInvertidos);


// 26. array_combine()

/*
|--------------------------------------------------------------------------
| array_combine()
|
| Crea un array asociativo utilizando un array como claves
| y otro como valores.
|--------------------------------------------------------------------------
*/

$claves = [
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
    $claves,
    $valores
);

echo PHP_EOL;
echo "USUARIO CON ARRAY_COMBINE()"
    . PHP_EOL;

print_r($usuario);


// 27. array_unique()

$tecnologias = [
    "PHP",
    "Laravel",
    "PHP",
    "MySQL",
    "Laravel",
    "JavaScript"
];

$tecnologiasUnicas =
    array_unique($tecnologias);

echo PHP_EOL;
echo "TECNOLOGÍAS SIN DUPLICADOS"
    . PHP_EOL;

print_r($tecnologiasUnicas);


// 28. array_values() después de eliminar elementos

$numeros = [
    0 => 10,
    1 => 20,
    2 => 30,
    3 => 40
];

unset($numeros[1]);

echo PHP_EOL;
echo "ARRAY CON ÍNDICE ELIMINADO"
    . PHP_EOL;

print_r($numeros);

$numeros = array_values($numeros);

echo "ÍNDICES REORDENADOS:"
    . PHP_EOL;

print_r($numeros);


// 29. Array asociativo multidimensional

$clientes = [

    [
        "id" => 1,
        "nombre" => "José",
        "email" => "jose@example.com",
        "activo" => true
    ],

    [
        "id" => 2,
        "nombre" => "Ana",
        "email" => "ana@example.com",
        "activo" => false
    ],

    [
        "id" => 3,
        "nombre" => "Pedro",
        "email" => "pedro@example.com",
        "activo" => true
    ]

];

echo PHP_EOL;
echo "CLIENTES"
    . PHP_EOL;
echo "--------"
    . PHP_EOL;

foreach ($clientes as $cliente) {

    echo "ID: "
        . $cliente["id"]
        . PHP_EOL;

    echo "Nombre: "
        . $cliente["nombre"]
        . PHP_EOL;

    echo "Email: "
        . $cliente["email"]
        . PHP_EOL;

    echo "Activo: "
        . ($cliente["activo"]
            ? "Sí"
            : "No")
        . PHP_EOL;

    echo "----------------"
        . PHP_EOL;
}


// 30. Buscar cliente por ID

$idBuscado = 2;

$clienteEncontrado = null;

foreach ($clientes as $cliente) {

    if ($cliente["id"] === $idBuscado) {

        $clienteEncontrado = $cliente;

        break;
    }
}

if ($clienteEncontrado !== null) {

    echo PHP_EOL;
    echo "CLIENTE ENCONTRADO"
        . PHP_EOL;

    print_r($clienteEncontrado);

} else {

    echo "Cliente no encontrado."
        . PHP_EOL;
}


// 31. Modificar datos dentro de un array multidimensional

foreach ($clientes as &$cliente) {

    if ($cliente["id"] === 2) {

        $cliente["activo"] = true;
    }
}

unset($cliente);

echo PHP_EOL;
echo "CLIENTES ACTUALIZADOS"
    . PHP_EOL;

print_r($clientes);


// 32. Ejemplo práctico: configuración

$configuracion = [

    "app" => [
        "nombre" => "Caytech",
        "version" => "1.0.0",
        "modo" => "desarrollo"
    ],

    "database" => [
        "host" => "localhost",
        "puerto" => 3306,
        "base_datos" => "caytech"
    ],

    "usuario" => [
        "nombre" => "José",
        "rol" => "admin"
    ]

];

echo PHP_EOL;
echo "CONFIGURACIÓN"
    . PHP_EOL;
echo "-------------"
    . PHP_EOL;

echo "Aplicación: "
    . $configuracion["app"]["nombre"]
    . PHP_EOL;

echo "Versión: "
    . $configuracion["app"]["version"]
    . PHP_EOL;

echo "Base de datos: "
    . $configuracion["database"]["base_datos"]
    . PHP_EOL;

echo "Usuario: "
    . $configuracion["usuario"]["nombre"]
    . PHP_EOL;


// 33. Ejemplo práctico: respuesta de una API

$respuestaApi = [

    "success" => true,

    "message" => "Usuarios encontrados",

    "data" => [

        [
            "id" => 1,
            "nombre" => "José"
        ],

        [
            "id" => 2,
            "nombre" => "Ana"
        ]

    ]

];

if ($respuestaApi["success"]) {

    echo PHP_EOL;
    echo $respuestaApi["message"]
        . PHP_EOL;

    foreach (
        $respuestaApi["data"]
        as $usuario
    ) {

        echo "ID: "
            . $usuario["id"]
            . " | Nombre: "
            . $usuario["nombre"]
            . PHP_EOL;
    }
}