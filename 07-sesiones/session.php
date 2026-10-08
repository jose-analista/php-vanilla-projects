<?php

/*
|--------------------------------------------------------------------------
| session.php
|--------------------------------------------------------------------------
| Sesiones en PHP
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - session_start()
| - $_SESSION
| - session_id()
| - isset()
| - unset()
| - $_SERVER["REQUEST_METHOD"]
| - $_POST
| - Guardar datos entre páginas
| - Contador de visitas
| - Reiniciar la sesión
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Iniciar la sesión
// -------------------------------------------------------------------------
// session_start() debe llamarse ANTES de cualquier salida HTML.
// Crea una sesión nueva o recupera la que el navegador ya tiene.

session_start();


// -------------------------------------------------------------------------
// 2. Contador de visitas
// -------------------------------------------------------------------------
// $_SESSION es un array que se conserva entre peticiones.
// Si la clave no existe, la creamos en 0 y luego sumamos 1.

if (!isset($_SESSION["visitas"])) {

    $_SESSION["visitas"] = 0;
}

$_SESSION["visitas"]++;


// -------------------------------------------------------------------------
// 3. Variables iniciales
// -------------------------------------------------------------------------

$mensaje = "";


// -------------------------------------------------------------------------
// 4. Procesar acciones del formulario
// -------------------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $accion = $_POST["accion"] ?? "";


    // ---------------------------------------------------------------------
    // 5. Guardar el nombre en la sesión
    // ---------------------------------------------------------------------

    if ($accion === "guardar") {

        $nombre = trim($_POST["nombre"] ?? "");

        if ($nombre === "") {

            $mensaje = "Escribe un nombre para guardarlo.";

        } else {

            $_SESSION["nombre"] = $nombre;

            $mensaje = "Nombre guardado en la sesión.";
        }
    }


    // ---------------------------------------------------------------------
    // 6. Borrar solo el nombre
    // ---------------------------------------------------------------------

    if ($accion === "borrar") {

        unset($_SESSION["nombre"]);

        $mensaje = "Nombre eliminado de la sesión.";
    }


    // ---------------------------------------------------------------------
    // 7. Reiniciar el contador
    // ---------------------------------------------------------------------

    if ($accion === "reiniciar") {

        $_SESSION["visitas"] = 0;

        $mensaje = "Contador reiniciado.";
    }
}


// -------------------------------------------------------------------------
// 8. Leer datos de la sesión
// -------------------------------------------------------------------------

$visitas = $_SESSION["visitas"];

$nombreGuardado = $_SESSION["nombre"] ?? "";

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sesiones PHP</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            max-width: 600px;

            margin: 40px auto;

            padding: 20px;

            background: #f4f4f4;
        }

        .caja {

            background: white;

            padding: 25px;

            margin-bottom: 20px;

            border-radius: 10px;
        }

        label {

            display: block;

            margin-bottom: 5px;

            font-weight: bold;
        }

        input {

            width: 100%;

            padding: 10px;

            box-sizing: border-box;

            border: 1px solid #ccc;

            border-radius: 5px;
        }

        button {

            margin-top: 10px;

            padding: 10px 18px;

            border: none;

            border-radius: 5px;

            cursor: pointer;

            background: #222;

            color: white;
        }

        button.secundario {

            background: #888;
        }

        .mensaje {

            background: #e5ffe9;

            padding: 15px;

            margin-bottom: 20px;

            border-radius: 5px;
        }

        code {

            background: #eee;

            padding: 2px 6px;

            border-radius: 4px;
        }

    </style>

</head>

<body>


<h1>Sesiones PHP</h1>


<?php

// -------------------------------------------------------------------------
// 9. Mostrar mensaje
// -------------------------------------------------------------------------

if ($mensaje !== ""):

?>

    <div class="mensaje">
        <?= htmlspecialchars($mensaje) ?>
    </div>

<?php

endif;

?>


<!-- ================================================================= -->
<!-- 10. Estado de la sesión -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Estado de la sesión</h2>

    <p>
        <strong>ID de sesión:</strong>
        <code><?= htmlspecialchars(session_id()) ?></code>
    </p>

    <p>
        <strong>Visitas en esta sesión:</strong>
        <?= $visitas ?>
    </p>

    <p>
        <strong>Nombre guardado:</strong>

        <?php if ($nombreGuardado !== ""): ?>

            <?= htmlspecialchars($nombreGuardado) ?>

        <?php else: ?>

            (ninguno)

        <?php endif; ?>
    </p>

    <p>
        Recarga la página y verás que el contador sigue sumando.
    </p>

</div>


<!-- ================================================================= -->
<!-- 11. Guardar nombre -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Guardar un dato</h2>

    <form
        method="POST"
        action=""
    >

        <input
            type="hidden"
            name="accion"
            value="guardar"
        >

        <label for="nombre">
            Nombre
        </label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?= htmlspecialchars($nombreGuardado) ?>"
            placeholder="Ingresa tu nombre"
        >

        <button type="submit">
            Guardar en la sesión
        </button>

    </form>

</div>


<!-- ================================================================= -->
<!-- 12. Acciones -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Acciones</h2>

    <form
        method="POST"
        action=""
    >

        <input
            type="hidden"
            name="accion"
            value="borrar"
        >

        <button
            type="submit"
            class="secundario"
        >
            Borrar nombre
        </button>

    </form>

    <form
        method="POST"
        action=""
    >

        <input
            type="hidden"
            name="accion"
            value="reiniciar"
        >

        <button
            type="submit"
            class="secundario"
        >
            Reiniciar contador
        </button>

    </form>

    <p>
        <a href="logout.php">Cerrar sesión por completo</a>
    </p>

</div>

</body>

</html>