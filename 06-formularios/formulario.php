<?php

/*
|--------------------------------------------------------------------------
| formulario.php
|--------------------------------------------------------------------------
| Formularios HTML + PHP
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - Crear formularios HTML
| - method="GET"
| - method="POST"
| - $_GET
| - $_POST
| - $_SERVER
| - isset()
| - empty()
| - trim()
| - htmlspecialchars()
| - Validación básica
| - Mantener valores del formulario
| - Mostrar mensajes
| - Select
| - Radio buttons
| - Checkboxes
| - Textarea
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Variables iniciales
// -------------------------------------------------------------------------

$nombre = "";
$email = "";
$edad = "";
$profesion = "";
$ciudad = "";
$mensaje = "";

$lenguaje = "";

$aceptaTerminos = false;

$errores = [];
$enviado = false;


// -------------------------------------------------------------------------
// 2. Detectar si el formulario fue enviado
// -------------------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $enviado = true;


    // ---------------------------------------------------------------------
    // 3. Obtener datos del formulario
    // ---------------------------------------------------------------------

    $nombre = trim($_POST["nombre"] ?? "");

    $email = trim($_POST["email"] ?? "");

    $edad = trim($_POST["edad"] ?? "");

    $profesion = trim($_POST["profesion"] ?? "");

    $ciudad = trim($_POST["ciudad"] ?? "");

    $lenguaje = trim($_POST["lenguaje"] ?? "");

    $mensaje = trim($_POST["mensaje"] ?? "");


    // Checkbox
    $aceptaTerminos = isset(
        $_POST["terminos"]
    );


    // ---------------------------------------------------------------------
    // 4. Validar nombre
    // ---------------------------------------------------------------------

    if ($nombre === "") {

        $errores[] = "El nombre es obligatorio.";

    } elseif (strlen($nombre) < 3) {

        $errores[] = "El nombre debe tener al menos 3 caracteres.";
    }


    // ---------------------------------------------------------------------
    // 5. Validar email
    // ---------------------------------------------------------------------

    if ($email === "") {

        $errores[] = "El email es obligatorio.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errores[] = "El email no es válido.";
    }


    // ---------------------------------------------------------------------
    // 6. Validar edad
    // ---------------------------------------------------------------------

    if ($edad === "") {

        $errores[] = "La edad es obligatoria.";

    } elseif (!is_numeric($edad)) {

        $errores[] = "La edad debe ser numérica.";

    } elseif ($edad < 18 || $edad > 100) {

        $errores[] = "La edad debe estar entre 18 y 100 años.";
    }


    // ---------------------------------------------------------------------
    // 7. Validar profesión
    // ---------------------------------------------------------------------

    if ($profesion === "") {

        $errores[] = "La profesión es obligatoria.";
    }


    // ---------------------------------------------------------------------
    // 8. Validar ciudad
    // ---------------------------------------------------------------------

    if ($ciudad === "") {

        $errores[] = "Debes seleccionar una ciudad.";
    }


    // ---------------------------------------------------------------------
    // 9. Validar lenguaje
    // ---------------------------------------------------------------------

    if ($lenguaje === "") {

        $errores[] = "Debes seleccionar un lenguaje.";
    }


    // ---------------------------------------------------------------------
    // 10. Validar mensaje
    // ---------------------------------------------------------------------

    if ($mensaje === "") {

        $errores[] = "El mensaje es obligatorio.";

    } elseif (strlen($mensaje) < 10) {

        $errores[] = "El mensaje debe tener al menos 10 caracteres.";
    }


    // ---------------------------------------------------------------------
    // 11. Validar términos
    // ---------------------------------------------------------------------

    if (!$aceptaTerminos) {

        $errores[] = "Debes aceptar los términos.";
    }
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

    <title>Formulario PHP</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            max-width: 700px;

            margin: 40px auto;

            padding: 20px;

            background: #f4f4f4;
        }

        form {

            background: white;

            padding: 25px;

            border-radius: 10px;
        }

        label {

            display: block;

            margin-top: 15px;

            margin-bottom: 5px;

            font-weight: bold;
        }

        input,
        select,
        textarea {

            width: 100%;

            padding: 10px;

            box-sizing: border-box;

            border: 1px solid #ccc;

            border-radius: 5px;
        }

        textarea {

            min-height: 120px;

            resize: vertical;
        }

        button {

            margin-top: 20px;

            padding: 12px 20px;

            border: none;

            border-radius: 5px;

            cursor: pointer;

            background: #222;

            color: white;
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

        .radio-group,
        .checkbox-group {

            margin-top: 10px;
        }

        .radio-group label,
        .checkbox-group label {

            display: inline;

            font-weight: normal;
        }

    </style>

</head>

<body>


<h1>Formulario PHP</h1>

<p>
    Ejemplo de formulario procesado con PHP.
</p>


<?php

// -------------------------------------------------------------------------
// 12. Mostrar errores
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

<?php

endif;


// -------------------------------------------------------------------------
// 13. Mostrar mensaje de éxito
// -------------------------------------------------------------------------

if ($enviado && empty($errores)):

?>

    <div class="exito">

        <strong>Formulario enviado correctamente.</strong>

        <p>
            Bienvenido,
            <?= htmlspecialchars($nombre) ?>.
        </p>

    </div>

<?php

endif;

?>


<form
    method="POST"
    action=""
>


    <!-- ============================================================= -->
    <!-- 14. Nombre -->
    <!-- ============================================================= -->

    <label for="nombre">
        Nombre
    </label>

    <input
        type="text"
        id="nombre"
        name="nombre"
        value="<?= htmlspecialchars($nombre) ?>"
        placeholder="Ingresa tu nombre"
    >


    <!-- ============================================================= -->
    <!-- 15. Email -->
    <!-- ============================================================= -->

    <label for="email">
        Email
    </label>

    <input
        type="email"
        id="email"
        name="email"
        value="<?= htmlspecialchars($email) ?>"
        placeholder="usuario@email.com"
    >


    <!-- ============================================================= -->
    <!-- 16. Edad -->
    <!-- ============================================================= -->

    <label for="edad">
        Edad
    </label>

    <input
        type="number"
        id="edad"
        name="edad"
        value="<?= htmlspecialchars($edad) ?>"
        min="18"
        max="100"
        placeholder="25"
    >


    <!-- ============================================================= -->
    <!-- 17. Profesión -->
    <!-- ============================================================= -->

    <label for="profesion">
        Profesión
    </label>

    <input
        type="text"
        id="profesion"
        name="profesion"
        value="<?= htmlspecialchars($profesion) ?>"
        placeholder="Analista Programador"
    >


    <!-- ============================================================= -->
    <!-- 18. Select -->
    <!-- ============================================================= -->

    <label for="ciudad">
        Ciudad
    </label>

    <select
        id="ciudad"
        name="ciudad"
    >

        <option value="">
            Selecciona una ciudad
        </option>

        <option
            value="Santiago"
            <?= $ciudad === "Santiago" ? "selected" : "" ?>
        >
            Santiago
        </option>

        <option
            value="Valparaiso"
            <?= $ciudad === "Valparaiso" ? "selected" : "" ?>
        >
            Valparaíso
        </option>

        <option
            value="Concepcion"
            <?= $ciudad === "Concepcion" ? "selected" : "" ?>
        >
            Concepción
        </option>

        <option
            value="Temuco"
            <?= $ciudad === "Temuco" ? "selected" : "" ?>
        >
            Temuco
        </option>

    </select>


    <!-- ============================================================= -->
    <!-- 19. Radio buttons -->
    <!-- ============================================================= -->

    <label>
        Lenguaje favorito
    </label>

    <div class="radio-group">

        <input
            type="radio"
            id="php"
            name="lenguaje"
            value="PHP"
            <?= $lenguaje === "PHP" ? "checked" : "" ?>
        >

        <label for="php">
            PHP
        </label>


        <input
            type="radio"
            id="python"
            name="lenguaje"
            value="Python"
            <?= $lenguaje === "Python" ? "checked" : "" ?>
        >

        <label for="python">
            Python
        </label>


        <input
            type="radio"
            id="javascript"
            name="lenguaje"
            value="JavaScript"
            <?= $lenguaje === "JavaScript" ? "checked" : "" ?>
        >

        <label for="javascript">
            JavaScript
        </label>

    </div>


    <!-- ============================================================= -->
    <!-- 20. Textarea -->
    <!-- ============================================================= -->

    <label for="mensaje">
        Mensaje
    </label>

    <textarea
        id="mensaje"
        name="mensaje"
        placeholder="Escribe tu mensaje..."
    ><?= htmlspecialchars($mensaje) ?></textarea>


    <!-- ============================================================= -->
    <!-- 21. Checkbox -->
    <!-- ============================================================= -->

    <div class="checkbox-group">

        <input
            type="checkbox"
            id="terminos"
            name="terminos"
            value="1"
            <?= $aceptaTerminos ? "checked" : "" ?>
        >

        <label for="terminos">
            Acepto los términos y condiciones
        </label>

    </div>


    <!-- ============================================================= -->
    <!-- 22. Botón -->
    <!-- ============================================================= -->

    <button type="submit">
        Enviar formulario
    </button>


</form>


<?php

// -------------------------------------------------------------------------
// 23. Mostrar datos enviados
// -------------------------------------------------------------------------

if ($enviado && empty($errores)):

?>

    <hr>

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
        <?= htmlspecialchars($mensaje) ?>
    </p>

<?php

endif;

?>

</body>

</html>