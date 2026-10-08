<?php

/*
|--------------------------------------------------------------------------
| procesar.php
|--------------------------------------------------------------------------
| Procesar los datos de formulario.php
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - Separar el formulario del procesamiento
| - $_SERVER["REQUEST_METHOD"]
| - header() y exit
| - $_POST
| - trim()
| - htmlspecialchars()
| - filter_var()
| - in_array()
| - Funciones para limpiar datos
| - Validación básica
| - Mostrar errores
| - Mostrar datos recibidos
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Solo aceptar peticiones POST
// -------------------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: formulario.php");

    exit;
}


// -------------------------------------------------------------------------
// 2. Función para limpiar datos
// -------------------------------------------------------------------------

function limpiar(string $valor): string
{
    return trim($valor);
}


// -------------------------------------------------------------------------
// 3. Variables iniciales
// -------------------------------------------------------------------------

$ciudadesValidas = [
    "Santiago",
    "Valparaiso",
    "Concepcion",
    "Temuco"
];

$lenguajesValidos = [
    "PHP",
    "Python",
    "JavaScript"
];

$errores = [];


// -------------------------------------------------------------------------
// 4. Obtener datos del formulario
// -------------------------------------------------------------------------

$nombre = limpiar($_POST["nombre"] ?? "");

$email = limpiar($_POST["email"] ?? "");

$edad = limpiar($_POST["edad"] ?? "");

$profesion = limpiar($_POST["profesion"] ?? "");

$ciudad = limpiar($_POST["ciudad"] ?? "");

$lenguaje = limpiar($_POST["lenguaje"] ?? "");

$mensaje = limpiar($_POST["mensaje"] ?? "");


// Checkbox
$aceptaTerminos = isset(
    $_POST["terminos"]
);


// -------------------------------------------------------------------------
// 5. Validar nombre
// -------------------------------------------------------------------------

if ($nombre === "") {

    $errores[] = "El nombre es obligatorio.";

} elseif (strlen($nombre) < 3) {

    $errores[] = "El nombre debe tener al menos 3 caracteres.";
}


// -------------------------------------------------------------------------
// 6. Validar email
// -------------------------------------------------------------------------

if ($email === "") {

    $errores[] = "El email es obligatorio.";

} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $errores[] = "El email no es válido.";
}


// -------------------------------------------------------------------------
// 7. Validar edad
// -------------------------------------------------------------------------

if ($edad === "") {

    $errores[] = "La edad es obligatoria.";

} elseif (!is_numeric($edad)) {

    $errores[] = "La edad debe ser numérica.";

} elseif ($edad < 18 || $edad > 100) {

    $errores[] = "La edad debe estar entre 18 y 100 años.";
}


// -------------------------------------------------------------------------
// 8. Validar profesión
// -------------------------------------------------------------------------

if ($profesion === "") {

    $errores[] = "La profesión es obligatoria.";
}


// -------------------------------------------------------------------------
// 9. Validar ciudad
// -------------------------------------------------------------------------

if ($ciudad === "") {

    $errores[] = "Debes seleccionar una ciudad.";

} elseif (!in_array($ciudad, $ciudadesValidas, true)) {

    $errores[] = "La ciudad seleccionada no es válida.";
}


// -------------------------------------------------------------------------
// 10. Validar lenguaje
// -------------------------------------------------------------------------

if ($lenguaje === "") {

    $errores[] = "Debes seleccionar un lenguaje.";

} elseif (!in_array($lenguaje, $lenguajesValidos, true)) {

    $errores[] = "El lenguaje seleccionado no es válido.";
}


// -------------------------------------------------------------------------
// 11. Validar mensaje
// -------------------------------------------------------------------------

if ($mensaje === "") {

    $errores[] = "El mensaje es obligatorio.";

} elseif (strlen($mensaje) < 10) {

    $errores[] = "El mensaje debe tener al menos 10 caracteres.";
}


// -------------------------------------------------------------------------
// 12. Validar términos
// -------------------------------------------------------------------------

if (!$aceptaTerminos) {

    $errores[] = "Debes aceptar los términos.";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Procesar formulario</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            max-width: 700px;

            margin: 40px auto;

            padding: 20px;

            background: #f4f4f4;
        }

        .caja {

            background: white;

            padding: 25px;

            border-radius: 10px;
        }

        .errores {

            background: #ffe5e5;

            padding: 15px;

            margin-bottom: 20px;

            border-radius: 5px;
        }

        .exito {

            background: #e5ffe9;

            padding: 15px;

            margin-bottom: 20px;

            border-radius: 5px;
        }

        a.boton {

            display: inline-block;

            margin-top: 20px;

            padding: 12px 20px;

            border-radius: 5px;

            background: #222;

            color: white;

            text-decoration: none;
        }

    </style>

</head>

<body>


<h1>Resultado del formulario</h1>


<div class="caja">


<?php

// -------------------------------------------------------------------------
// 13. Mostrar errores
// -------------------------------------------------------------------------

if (!empty($errores)):

?>

    <div class="errores">

        <strong>Se encontraron errores:</strong>

        <ul>

            <?php foreach ($errores as $error): ?>

                <li>
                    <?= htmlspecialchars($error) ?>
                </li>

            <?php endforeach; ?>

        </ul>

    </div>

    <a
        class="boton"
        href="formulario.php"
    >
        Volver al formulario
    </a>

<?php

// -------------------------------------------------------------------------
// 14. Mostrar datos recibidos
// -------------------------------------------------------------------------

else:

?>

    <div class="exito">

        <strong>Formulario procesado correctamente.</strong>

        <p>
            Bienvenido,
            <?= htmlspecialchars($nombre) ?>.
        </p>

    </div>

    <h2>Datos recibidos</h2>

    <p>
        <strong>Nombre:</strong>
        <?= htmlspecialchars($nombre) ?>
    </p>

    <p>
        <strong>Email:</strong>
        <?= htmlspecialchars($email) ?>
    </p>

    <p>
        <strong>Edad:</strong>
        <?= htmlspecialchars($edad) ?>
    </p>

    <p>
        <strong>Profesión:</strong>
        <?= htmlspecialchars($profesion) ?>
    </p>

    <p>
        <strong>Ciudad:</strong>
        <?= htmlspecialchars($ciudad) ?>
    </p>

    <p>
        <strong>Lenguaje:</strong>
        <?= htmlspecialchars($lenguaje) ?>
    </p>

    <p>
        <strong>Mensaje:</strong>
        <?= nl2br(htmlspecialchars($mensaje)) ?>
    </p>

    <a
        class="boton"
        href="formulario.php"
    >
        Enviar otro formulario
    </a>

<?php

endif;

?>


</div>

</body>

</html>