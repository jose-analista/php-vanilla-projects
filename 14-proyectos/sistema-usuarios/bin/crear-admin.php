<?php
declare(strict_types=1);

/**
 * Crea un usuario administrador desde la terminal.
 *
 * Uso:
 *   php bin/crear-admin.php "Nombre Apellido" correo@dominio.cl "Clave12345"
 *   composer admin -- "Nombre Apellido" correo@dominio.cl "Clave12345"
 */

use App\Config;
use App\Repositories\UserRepository;
use App\Validator;

if (PHP_SAPI !== 'cli') {
    exit("Este script solo se ejecuta desde la terminal.\n");
}

require dirname(__DIR__) . '/vendor/autoload.php';
Config::load(dirname(__DIR__));

[, $nombre, $email, $password] = $argv + [null, null, null, null];

if ($nombre === null || $email === null || $password === null) {
    fwrite(STDERR, "Uso: php bin/crear-admin.php \"Nombre\" correo@dominio.cl \"Contraseña\"\n");
    exit(1);
}

$email  = mb_strtolower(trim($email));
$errors = array_filter([
    Validator::nombre(trim($nombre)),
    Validator::email($email),
    Validator::password($password),
]);

if ($errors) {
    fwrite(STDERR, implode("\n", $errors) . "\n");
    exit(1);
}

$repo = new UserRepository();

if ($repo->emailExists($email)) {
    fwrite(STDERR, "Ya existe un usuario con el email $email\n");
    exit(1);
}

$id = $repo->create(trim($nombre), $email, $password, 'admin');
echo "Administrador creado (id $id): $email\n";
