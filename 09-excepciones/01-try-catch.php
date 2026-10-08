<?php

/*
|--------------------------------------------------------------------------
| 01-try-catch.php
|--------------------------------------------------------------------------
| Manejo de excepciones con try, catch y finally
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - try y catch
| - throw
| - Exception y Error
| - Throwable
| - getMessage(), getCode(), getLine(), getFile()
| - Varios bloques catch
| - Capturar varios tipos en un solo catch (|)
| - finally
| - Relanzar una excepción
| - Encadenar excepciones con getPrevious()
| - Excepciones incorporadas de PHP
| - Jerarquía de excepciones
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Funciones de apoyo
// -------------------------------------------------------------------------
// throw "lanza" una excepción: detiene la ejecución normal y salta
// al catch más cercano que sepa manejar ese tipo de error.

function dividir(float $a, float $b): float
{
    if ($b == 0) {

        throw new InvalidArgumentException("No se puede dividir por cero.", 100);
    }

    return $a / $b;
}


function sumar(int $a, int $b): int
{
    return $a + $b;
}


// -------------------------------------------------------------------------
// 2. try y catch básico
// -------------------------------------------------------------------------
// - try:   código que puede fallar
// - catch: qué hacer si falla
//
// Cuando se lanza la excepción, el resto del bloque try NO se ejecuta.

$seccion1 = [];

try {

    $seccion1[] = "10 / 2 = " . dividir(10, 2);

    $seccion1[] = "10 / 0 = " . dividir(10, 0);

    // Esta línea nunca se ejecuta, porque la anterior lanzó una excepción
    $seccion1[] = "Esta línea no se ejecuta";

} catch (InvalidArgumentException $e) {

    $seccion1[] = "Error capturado: " . $e->getMessage();
}

$seccion1[] = "El programa continúa después del catch.";


// -------------------------------------------------------------------------
// 3. Información de la excepción
// -------------------------------------------------------------------------
// Todas las excepciones tienen los mismos métodos para consultar el error.

$seccion2 = [];

try {

    dividir(5, 0);

} catch (Exception $e) {

    $seccion2[] = "Clase: " . get_class($e);

    $seccion2[] = "Mensaje: " . $e->getMessage();

    $seccion2[] = "Código: " . $e->getCode();

    $seccion2[] = "Archivo: " . basename($e->getFile());

    $seccion2[] = "Línea: " . $e->getLine();
}


// -------------------------------------------------------------------------
// 4. Varios catch
// -------------------------------------------------------------------------
// PHP revisa los catch de arriba hacia abajo y usa el primero que coincida.
// Por eso van primero los más específicos y al final los más generales.
//
// - catch (A | B): captura cualquiera de los dos tipos
// - catch (Throwable): captura cualquier excepción o error

$casos = [

    "Sin error" => fn() => sumar(2, 3),

    "División por cero" => fn() => intdiv(10, 0),

    "Argumento inválido" => fn() => dividir(1, 0),

    "Tipo incorrecto" => fn() => sumar("abc", 2),

    "Valor no permitido" => fn() => str_repeat("a", -1),

    "JSON inválido" => fn() => json_decode("{malo", false, 512, JSON_THROW_ON_ERROR),
];

$seccion3 = [];

foreach ($casos as $nombre => $caso) {

    try {

        $resultado = $caso();

        $seccion3[] = "$nombre → OK, resultado: " . json_encode($resultado);

    } catch (DivisionByZeroError $e) {

        $seccion3[] = "$nombre → DivisionByZeroError: " . $e->getMessage();

    } catch (TypeError | ValueError $e) {

        $seccion3[] = "$nombre → " . get_class($e) . ": " . $e->getMessage();

    } catch (JsonException $e) {

        $seccion3[] = "$nombre → JsonException: " . $e->getMessage();

    } catch (InvalidArgumentException $e) {

        $seccion3[] = "$nombre → InvalidArgumentException: " . $e->getMessage();

    } catch (Throwable $e) {

        $seccion3[] = "$nombre → Otro error: " . $e->getMessage();
    }
}


// -------------------------------------------------------------------------
// 5. finally
// -------------------------------------------------------------------------
// El bloque finally se ejecuta SIEMPRE: haya error o no, e incluso
// si el try o el catch tienen un return. Sirve para limpiar recursos
// (cerrar archivos, conexiones, etc.).

function procesarConFinally(bool $falla, array &$log): string
{
    try {

        $log[] = "Dentro del try";

        if ($falla) {

            throw new RuntimeException("Algo falló");
        }

        return "Resultado correcto";

    } catch (RuntimeException $e) {

        $log[] = "Dentro del catch: " . $e->getMessage();

        return "Resultado con error";

    } finally {

        $log[] = "Dentro del finally (siempre se ejecuta)";
    }
}

$seccion4 = [];

$seccion4[] = "--- Sin error ---";

$resultadoA = procesarConFinally(false, $seccion4);

$seccion4[] = "Devuelve: " . $resultadoA;

$seccion4[] = "--- Con error ---";

$resultadoB = procesarConFinally(true, $seccion4);

$seccion4[] = "Devuelve: " . $resultadoB;


// -------------------------------------------------------------------------
// 6. Relanzar y encadenar excepciones
// -------------------------------------------------------------------------
// Una capa puede capturar un error técnico y lanzar otro más claro,
// guardando el original como "anterior" (tercer parámetro).
// Así no se pierde la causa real.

function buscarEnBaseDeDatos(int $id): array
{
    throw new RuntimeException("Conexión rechazada por el servidor");
}

function cargarUsuario(int $id): array
{
    try {

        return buscarEnBaseDeDatos($id);

    } catch (RuntimeException $e) {

        throw new Exception("No se pudo cargar el usuario #$id", 500, $e);
    }
}

$seccion5 = [];

try {

    cargarUsuario(7);

} catch (Exception $e) {

    $seccion5[] = "Mensaje: " . $e->getMessage();

    $seccion5[] = "Código: " . $e->getCode();

    $anterior = $e->getPrevious();

    if ($anterior !== null) {

        $seccion5[] = "Causa original: " . $anterior->getMessage()
            . " (" . get_class($anterior) . ")";
    }
}


// -------------------------------------------------------------------------
// 7. Jerarquía de excepciones
// -------------------------------------------------------------------------
// Todo lo que se puede lanzar implementa la interfaz Throwable y
// pertenece a una de dos ramas:
//
// - Exception: errores que el programa puede esperar y manejar
// - Error:     errores internos de PHP (tipos incorrectos, división por cero...)

$seccion6 = [];

$seccion6[] = "InvalidArgumentException → "
    . implode(" → ", array_values(class_parents("InvalidArgumentException")));

$seccion6[] = "DivisionByZeroError → "
    . implode(" → ", array_values(class_parents("DivisionByZeroError")));

$seccion6[] = "JsonException → "
    . implode(" → ", array_values(class_parents("JsonException")));

$seccion6[] = "Exception implementa: "
    . implode(", ", array_values(class_implements("Exception")));


// -------------------------------------------------------------------------
// 8. Excepción sin capturar
// -------------------------------------------------------------------------
// Si nadie captura la excepción, PHP detiene el programa con un
// "Fatal error: Uncaught ...". Descomenta la siguiente línea para verlo:

// dividir(1, 0);


// -------------------------------------------------------------------------
// 9. Secciones para mostrar
// -------------------------------------------------------------------------

$secciones = [

    [
        "titulo"      => "try y catch básico",
        "descripcion" => "Al lanzarse la excepción, el try se interrumpe y salta al catch.",
        "lineas"      => $seccion1,
    ],

    [
        "titulo"      => "Información de la excepción",
        "descripcion" => "Métodos para consultar el error capturado.",
        "lineas"      => $seccion2,
    ],

    [
        "titulo"      => "Varios catch",
        "descripcion" => "Cada error se captura con el catch que le corresponde.",
        "lineas"      => $seccion3,
    ],

    [
        "titulo"      => "finally",
        "descripcion" => "Se ejecuta siempre, incluso cuando hay return.",
        "lineas"      => $seccion4,
    ],

    [
        "titulo"      => "Relanzar y encadenar",
        "descripcion" => "La excepción nueva conserva la causa original con getPrevious().",
        "lineas"      => $seccion5,
    ],

    [
        "titulo"      => "Jerarquía",
        "descripcion" => "De qué clases heredan algunas excepciones de PHP.",
        "lineas"      => $seccion6,
    ],
];

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>try y catch PHP</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            max-width: 800px;

            margin: 40px auto;

            padding: 20px;

            background: #f4f4f4;
        }

        .caja {

            background: white;

            padding: 20px 25px;

            margin-bottom: 20px;

            border-radius: 10px;
        }

        .descripcion {

            color: #666;

            font-size: 14px;
        }

        li {

            margin-bottom: 6px;
        }

    </style>

</head>

<body>


<h1>try y catch PHP</h1>


<?php

// -------------------------------------------------------------------------
// 10. Mostrar cada sección
// -------------------------------------------------------------------------

foreach ($secciones as $indice => $seccion):

?>

    <div class="caja">

        <h2>
            <?= $indice + 1 ?>.
            <?= htmlspecialchars($seccion["titulo"]) ?>
        </h2>

        <p class="descripcion">
            <?= htmlspecialchars($seccion["descripcion"]) ?>
        </p>

        <ul>

            <?php foreach ($seccion["lineas"] as $linea): ?>

                <li><?= htmlspecialchars($linea) ?></li>

            <?php endforeach; ?>

        </ul>

    </div>

<?php

endforeach;

?>

</body>

</html>