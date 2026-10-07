<?php

/*
|--------------------------------------------------------------------------
| 03 - Arrays multidimensionales
|--------------------------------------------------------------------------
| Un array multidimensional es un array que contiene otros arrays.
|
| Ejemplo:
|
| $usuarios = [
|     [
|         "nombre" => "José",
|         "edad" => 25
|     ],
|     [
|         "nombre" => "Ana",
|         "edad" => 30
|     ]
| ];
|
| Este tipo de estructura es muy utilizada para representar:
|
| - Usuarios
| - Clientes
| - Productos
| - Ventas
| - Proyectos
| - Resultados de bases de datos
| - Respuestas de APIs
|--------------------------------------------------------------------------
*/


// 1. Array bidimensional básico

$usuarios = [

    [
        "nombre" => "José",
        "edad" => 25
    ],

    [
        "nombre" => "Ana",
        "edad" => 30
    ],

    [
        "nombre" => "Pedro",
        "edad" => 28
    ]

];

print_r($usuarios);


// 2. Acceder a un elemento

echo "Primer usuario: "
    . $usuarios[0]["nombre"]
    . PHP_EOL;

echo "Segundo usuario: "
    . $usuarios[1]["nombre"]
    . PHP_EOL;


// 3. Acceder a diferentes propiedades

echo "Edad de José: "
    . $usuarios[0]["edad"]
    . PHP_EOL;


// 4. Modificar un elemento

$usuarios[0]["edad"] = 26;

$usuarios[1]["nombre"] = "Ana María";

echo PHP_EOL;
echo "Usuarios modificados:"
    . PHP_EOL;

print_r($usuarios);


// 5. Agregar un nuevo usuario

$usuarios[] = [

    "nombre" => "Carlos",
    "edad" => 35

];

print_r($usuarios);


// 6. Recorrer con foreach

echo PHP_EOL;
echo "LISTA DE USUARIOS"
    . PHP_EOL;
echo "-----------------"
    . PHP_EOL;

foreach ($usuarios as $usuario) {

    echo "Nombre: "
        . $usuario["nombre"]
        . PHP_EOL;

    echo "Edad: "
        . $usuario["edad"]
        . PHP_EOL;

    echo "-----------------"
        . PHP_EOL;
}


// 7. Obtener índice y datos

foreach (
    $usuarios as $indice => $usuario
) {

    echo "Usuario #" . ($indice + 1)
        . ": "
        . $usuario["nombre"]
        . PHP_EOL;
}


// 8. Array con productos

$productos = [

    [
        "id" => 1,
        "nombre" => "Notebook",
        "precio" => 500000,
        "stock" => 10
    ],

    [
        "id" => 2,
        "nombre" => "Mouse",
        "precio" => 15000,
        "stock" => 25
    ],

    [
        "id" => 3,
        "nombre" => "Teclado",
        "precio" => 30000,
        "stock" => 15
    ]

];

echo PHP_EOL;
echo "PRODUCTOS"
    . PHP_EOL;
echo "---------"
    . PHP_EOL;

foreach ($productos as $producto) {

    echo "ID: "
        . $producto["id"]
        . PHP_EOL;

    echo "Producto: "
        . $producto["nombre"]
        . PHP_EOL;

    echo "Precio: $"
        . $producto["precio"]
        . PHP_EOL;

    echo "Stock: "
        . $producto["stock"]
        . PHP_EOL;

    echo "----------------"
        . PHP_EOL;
}


// 9. Calcular valor del stock

$valorStock = 0;

foreach ($productos as $producto) {

    $valorStock +=
        $producto["precio"]
        * $producto["stock"];
}

echo "Valor total del stock: $"
    . $valorStock
    . PHP_EOL;


// 10. Buscar un producto

$idBuscado = 2;

foreach ($productos as $producto) {

    if ($producto["id"] === $idBuscado) {

        echo PHP_EOL;
        echo "Producto encontrado: "
            . $producto["nombre"]
            . PHP_EOL;

        break;
    }
}


// 11. Modificar un producto

foreach ($productos as &$producto) {

    if ($producto["id"] === 3) {

        $producto["precio"] = 35000;
        $producto["stock"] = 20;
    }
}

unset($producto);

echo PHP_EOL;
echo "PRODUCTOS ACTUALIZADOS"
    . PHP_EOL;

print_r($productos);


// 12. Eliminar un elemento

unset($productos[1]);

echo PHP_EOL;
echo "Después de eliminar un producto:"
    . PHP_EOL;

print_r($productos);


// 13. Reindexar después de eliminar

$productos = array_values($productos);

echo PHP_EOL;
echo "Después de reindexar:"
    . PHP_EOL;

print_r($productos);


// 14. Array de clientes con proyectos

$clientes = [

    [
        "id" => 1,
        "nombre" => "Empresa A",

        "proyectos" => [
            "Sistema CRM",
            "Sitio web"
        ]
    ],

    [
        "id" => 2,
        "nombre" => "Empresa B",

        "proyectos" => [
            "Aplicación móvil",
            "API REST",
            "Dashboard"
        ]
    ]

];

echo PHP_EOL;
echo "CLIENTES Y PROYECTOS"
    . PHP_EOL;
echo "--------------------"
    . PHP_EOL;

foreach ($clientes as $cliente) {

    echo "Cliente: "
        . $cliente["nombre"]
        . PHP_EOL;

    echo "Proyectos:"
        . PHP_EOL;

    foreach (
        $cliente["proyectos"]
        as $proyecto
    ) {

        echo "- "
            . $proyecto
            . PHP_EOL;
    }

    echo "--------------------"
        . PHP_EOL;
}


// 15. Array con tres niveles

$empresa = [

    "nombre" => "Caytech",

    "departamentos" => [

        "desarrollo" => [

            "empleados" => [

                "José",
                "Ana",
                "Pedro"

            ]

        ],

        "soporte" => [

            "empleados" => [

                "Carlos",
                "Laura"

            ]

        ]

    ]

];

echo PHP_EOL;
echo "EMPRESA"
    . PHP_EOL;

echo "Nombre: "
    . $empresa["nombre"]
    . PHP_EOL;

echo "Desarrolladores:"
    . PHP_EOL;

foreach (
    $empresa["departamentos"]["desarrollo"]["empleados"]
    as $empleado
) {

    echo "- "
        . $empleado
        . PHP_EOL;
}


// 16. Array de ventas

$ventas = [

    [
        "id" => 1,
        "cliente" => "José",
        "producto" => "Notebook",
        "cantidad" => 1,
        "precio" => 500000
    ],

    [
        "id" => 2,
        "cliente" => "Ana",
        "producto" => "Mouse",
        "cantidad" => 2,
        "precio" => 15000
    ],

    [
        "id" => 3,
        "cliente" => "Pedro",
        "producto" => "Teclado",
        "cantidad" => 3,
        "precio" => 30000
    ]

];

echo PHP_EOL;
echo "VENTAS"
    . PHP_EOL;
echo "------"
    . PHP_EOL;

$totalVentas = 0;

foreach ($ventas as $venta) {

    $subtotal =
        $venta["cantidad"]
        * $venta["precio"];

    $totalVentas += $subtotal;

    echo "Cliente: "
        . $venta["cliente"]
        . PHP_EOL;

    echo "Producto: "
        . $venta["producto"]
        . PHP_EOL;

    echo "Subtotal: $"
        . $subtotal
        . PHP_EOL;

    echo "----------------"
        . PHP_EOL;
}

echo "TOTAL VENTAS: $"
    . $totalVentas
    . PHP_EOL;


// 17. Buscar una venta por ID

$idBuscado = 2;

$ventaEncontrada = null;

foreach ($ventas as $venta) {

    if ($venta["id"] === $idBuscado) {

        $ventaEncontrada = $venta;

        break;
    }
}

if ($ventaEncontrada !== null) {

    echo PHP_EOL;
    echo "VENTA ENCONTRADA"
        . PHP_EOL;

    print_r($ventaEncontrada);

} else {

    echo "Venta no encontrada."
        . PHP_EOL;
}


// 18. Filtrar manualmente productos con stock

$productos = [

    [
        "nombre" => "Notebook",
        "stock" => 10
    ],

    [
        "nombre" => "Mouse",
        "stock" => 0
    ],

    [
        "nombre" => "Teclado",
        "stock" => 5
    ]

];

echo PHP_EOL;
echo "PRODUCTOS DISPONIBLES"
    . PHP_EOL;

foreach ($productos as $producto) {

    if ($producto["stock"] > 0) {

        echo "- "
            . $producto["nombre"]
            . PHP_EOL;
    }
}


// 19. Contar elementos internos

$clientes = [

    [
        "nombre" => "Empresa A",

        "proyectos" => [
            "Web",
            "CRM"
        ]
    ],

    [
        "nombre" => "Empresa B",

        "proyectos" => [
            "App",
            "API",
            "Dashboard"
        ]
    ]

];

foreach ($clientes as $cliente) {

    $cantidadProyectos =
        count($cliente["proyectos"]);

    echo PHP_EOL;

    echo $cliente["nombre"]
        . " tiene "
        . $cantidadProyectos
        . " proyectos."
        . PHP_EOL;
}


// 20. Matriz numérica

$matriz = [

    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]

];

echo PHP_EOL;
echo "MATRIZ"
    . PHP_EOL;

foreach ($matriz as $fila) {

    foreach ($fila as $valor) {

        echo $valor . " ";
    }

    echo PHP_EOL;
}


// 21. Modificar una matriz

$matriz[1][1] = 50;

echo PHP_EOL;
echo "MATRIZ MODIFICADA"
    . PHP_EOL;

foreach ($matriz as $fila) {

    foreach ($fila as $valor) {

        echo $valor . " ";
    }

    echo PHP_EOL;
}


// 22. Recorrer matriz con índices

echo PHP_EOL;
echo "MATRIZ CON ÍNDICES"
    . PHP_EOL;

foreach (
    $matriz as $fila => $valores
) {

    foreach (
        $valores as $columna => $valor
    ) {

        echo "Fila: "
            . $fila
            . " | Columna: "
            . $columna
            . " | Valor: "
            . $valor
            . PHP_EOL;
    }
}


// 23. Array multidimensional simulando una API

$respuestaApi = [

    "success" => true,

    "message" => "Productos encontrados",

    "data" => [

        [
            "id" => 1,
            "nombre" => "Notebook",
            "precio" => 500000
        ],

        [
            "id" => 2,
            "nombre" => "Mouse",
            "precio" => 15000
        ]

    ]

];

echo PHP_EOL;
echo "RESPUESTA API"
    . PHP_EOL;
echo "-------------"
    . PHP_EOL;

if ($respuestaApi["success"]) {

    echo $respuestaApi["message"]
        . PHP_EOL;

    foreach (
        $respuestaApi["data"]
        as $producto
    ) {

        echo "ID: "
            . $producto["id"]
            . " | "
            . $producto["nombre"]
            . " | $"
            . $producto["precio"]
            . PHP_EOL;
    }
}


// 24. Ejemplo práctico: sistema de proyectos

$proyectos = [

    [
        "id" => 1,
        "nombre" => "Sistema CRM",
        "cliente" => "Empresa A",
        "estado" => "En desarrollo",

        "tareas" => [
            "Diseñar base de datos",
            "Crear API",
            "Crear frontend"
        ]
    ],

    [
        "id" => 2,
        "nombre" => "Aplicación móvil",
        "cliente" => "Empresa B",
        "estado" => "Planificación",

        "tareas" => [
            "Diseñar interfaz",
            "Configurar Firebase"
        ]
    ]

];

echo PHP_EOL;
echo "SISTEMA DE PROYECTOS"
    . PHP_EOL;
echo "===================="
    . PHP_EOL;

foreach ($proyectos as $proyecto) {

    echo PHP_EOL;

    echo "Proyecto: "
        . $proyecto["nombre"]
        . PHP_EOL;

    echo "Cliente: "
        . $proyecto["cliente"]
        . PHP_EOL;

    echo "Estado: "
        . $proyecto["estado"]
        . PHP_EOL;

    echo "Tareas:"
        . PHP_EOL;

    foreach (
        $proyecto["tareas"]
        as $tarea
    ) {

        echo "- "
            . $tarea
            . PHP_EOL;
    }

    echo "--------------------"
        . PHP_EOL;
}