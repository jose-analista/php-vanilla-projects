<?php

/*
|--------------------------------------------------------------------------
| logout.php
|--------------------------------------------------------------------------
| Cerrar sesión
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - session_start()
| - $_SESSION
| - session_unset()
| - session_destroy()
| - session_get_cookie_params()
| - setcookie()
| - header() y exit
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Iniciar la sesión
// -------------------------------------------------------------------------
// Para poder destruir una sesión primero hay que recuperarla.

session_start();


// -------------------------------------------------------------------------
// 2. Vaciar los datos de la sesión
// -------------------------------------------------------------------------

$_SESSION = [];

session_unset();


// -------------------------------------------------------------------------
// 3. Eliminar la cookie de sesión del navegador
// -------------------------------------------------------------------------
// Sin este paso, el navegador seguiría enviando el ID de la sesión vieja.

if (ini_get("session.use_cookies")) {

    $parametros = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 42000,
        $parametros["path"],
        $parametros["domain"],
        $parametros["secure"],
        $parametros["httponly"]
    );
}


// -------------------------------------------------------------------------
// 4. Destruir la sesión en el servidor
// -------------------------------------------------------------------------

session_destroy();


// -------------------------------------------------------------------------
// 5. Redirigir al login
// -------------------------------------------------------------------------

header("Location: login.php");

exit;