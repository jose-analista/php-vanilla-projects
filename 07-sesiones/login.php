<?php

/*
|--------------------------------------------------------------------------
| login.php
|--------------------------------------------------------------------------
| Formulario de login con validación
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - Crear un formulario de login
| - $_SERVER["REQUEST_METHOD"]
| - $_POST
| - trim()
| - filter_var()
| - mb_strlen()
| - password_hash()
| - password_verify()
| - Funciones de validación
| - Mensajes de error genéricos (seguridad)
| - No repetir la contraseña en el HTML
| - Mantener el email en el formulario
| - htmlspecialchars()
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Usuario de ejemplo
// -------------------------------------------------------------------------
// En un proyecto real estos datos vienen de una base de datos (carpeta
// 10-bases-datos) y el hash ya está guardado. Aquí lo generamos solo
// para practicar.
//
// Contraseña de prueba: Clave1234

$usuarioRegistrado = [

    "email"    => "jose@email.com",

    "password" => password_hash("Clave1234", PASSWORD_DEFAULT),
];


// -------------------------------------------------------------------------
// 2. Validar email
// -------------------------------------------------------------------------
// Devuelve null si es válido o el mensaje de error.

function validarEmail(string $email): ?string
{
    if ($email === "") {

        return "El email es obligatorio.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        return "El email no es válido.";
    }

    return null;
}


// -------------------------------------------------------------------------
// 3. Validar contraseña
// -------------------------------------------------------------------------

function validarPassword(string $password): ?string
{
    if ($password === "") {

        return "La contraseña es obligatoria.";
    }

    if (mb_strlen($password) < 8) {

        return "La contraseña debe tener al menos 8 caracteres.";
    }

    return null;
}


// -------------------------------------------------------------------------
// 4. Variables iniciales
// -------------------------------------------------------------------------

$email = "";

$errores = [];

$loginCorrecto = false;


// -------------------------------------------------------------------------
// 5. Detectar si el formulario fue enviado
// -------------------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    // ---------------------------------------------------------------------
    // 6. Obtener datos del formulario
    // ---------------------------------------------------------------------
    // El email se limpia con trim(). La contraseña NO se modifica:
    // los espacios pueden ser parte de ella.

    $email = trim($_POST["email"] ?? "");

    $password = $_POST["password"] ?? "";


    // ---------------------------------------------------------------------
    // 7. Validar formato de los datos
    // ---------------------------------------------------------------------

    $errorEmail = validarEmail($email);

    if ($errorEmail !== null) {

        $errores["email"] = $errorEmail;
    }

    $errorPassword = validarPassword($password);

    if ($errorPassword !== null) {

        $errores["password"] = $errorPassword;
    }


    // ---------------------------------------------------------------------
    // 8. Verificar credenciales
    // ---------------------------------------------------------------------
    // Solo comprobamos las credenciales si el formato es correcto.

    if (empty($errores)) {

        $emailCorrecto = $email === $usuarioRegistrado["email"];

        $passwordCorrecta = password_verify(
            $password,
            $usuarioRegistrado["password"]
        );

        if ($emailCorrecto && $passwordCorrecta) {

            $loginCorrecto = true;

        } else {

            // Mensaje genérico: no revelamos si falló el email o la clave
            $errores["credenciales"] = "Email o contraseña incorrectos.";
        }
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

    <title>Login PHP</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            max-width: 400px;

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

        input {

            width: 100%;

            padding: 10px;

            box-sizing: border-box;

            border: 1px solid #ccc;

            border-radius: 5px;
        }

        input.invalido {

            border-color: #c0392b;
        }

        .mensaje-campo {

            color: #c0392b;

            font-size: 13px;

            margin-top: 5px;
        }

        button {

            width: 100%;

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

        .ayuda {

            font-size: 13px;

            color: #666;

            text-align: center;
        }

    </style>

</head>

<body>


<h1>Iniciar sesión</h1>


<?php

// -------------------------------------------------------------------------
// 9. Mostrar error de credenciales
// -------------------------------------------------------------------------

if (isset($errores["credenciales"])):

?>

    <div class="errores">

        <?= htmlspecialchars($errores["credenciales"]) ?>

    </div>

<?php

endif;


// -------------------------------------------------------------------------
// 10. Mostrar mensaje de éxito
// -------------------------------------------------------------------------

if ($loginCorrecto):

?>

    <div class="exito">

        <strong>Login correcto.</strong>

        <p>
            Bienvenido,
            <?= htmlspecialchars($email) ?>.
        </p>

    </div>

<?php

else:

?>


<form
    method="POST"
    action=""
>


    <!-- ============================================================= -->
    <!-- 11. Email -->
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
        class="<?= isset($errores["email"]) ? "invalido" : "" ?>"
    >

    <?php if (isset($errores["email"])): ?>

        <div class="mensaje-campo">
            <?= htmlspecialchars($errores["email"]) ?>
        </div>

    <?php endif; ?>


    <!-- ============================================================= -->
    <!-- 12. Contraseña -->
    <!-- ============================================================= -->
    <!-- No se pone value: nunca devolvemos la contraseña al navegador -->

    <label for="password">
        Contraseña
    </label>

    <input
        type="password"
        id="password"
        name="password"
        placeholder="Mínimo 8 caracteres"
        class="<?= isset($errores["password"]) ? "invalido" : "" ?>"
    >

    <?php if (isset($errores["password"])): ?>

        <div class="mensaje-campo">
            <?= htmlspecialchars($errores["password"]) ?>
        </div>

    <?php endif; ?>


    <!-- ============================================================= -->
    <!-- 13. Botón -->
    <!-- ============================================================= -->

    <button type="submit">
        Entrar
    </button>

    <p class="ayuda">
        Prueba: jose@email.com / Clave1234
    </p>


</form>


<?php

endif;

?>

</body>

</html>