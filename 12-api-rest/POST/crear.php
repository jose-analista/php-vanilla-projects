<?php
declare(strict_types=1);

/**
 * POST -> crea un usuario (JSON o form-data)
 * Body: { "nombre": "Ana Pérez", "email": "ana@mail.cl" }
 */

const ALLOWED_ORIGIN = '*'; // en producción: 'https://tudominio.cl'

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: ' . ALLOWED_ORIGIN);
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('X-Content-Type-Options: nosniff');

function respond(int $code, array $payload): never
{
    http_response_code($code);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function fail(int $code, string $message, array $errors = []): never
{
    $payload = ['status' => 'error', 'message' => $message];
    if ($errors) {
        $payload['errors'] = $errors;
    }
    respond($code, $payload);
}

// Preflight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST, OPTIONS');
    fail(405, 'Método no permitido. Usa POST.');
}

// Leer el cuerpo según el Content-Type
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if (stripos($contentType, 'application/json') !== false) {
    $input = json_decode(file_get_contents('php://input') ?: '', true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($input)) {
        fail(400, 'El cuerpo de la petición no es un JSON válido.');
    }
} else {
    $input = $_POST; // form-data / x-www-form-urlencoded
}

// Validación
$nombre = trim((string)($input['nombre'] ?? ''));
$email  = mb_strtolower(trim((string)($input['email'] ?? '')));
$errors = [];

if ($nombre === '') {
    $errors['nombre'] = 'El nombre es obligatorio.';
} elseif (mb_strlen($nombre) < 2 || mb_strlen($nombre) > 100) {
    $errors['nombre'] = 'El nombre debe tener entre 2 y 100 caracteres.';
}

if ($email === '') {
    $errors['email'] = 'El email es obligatorio.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
    $errors['email'] = 'El formato del correo electrónico es inválido.';
}

if ($errors) {
    fail(422, 'Datos inválidos.', $errors);
}

// Conexión (require, no require_once, para que siempre devuelva $pdo)
$pdo = require __DIR__ . '/../../11-crud/usuarios-crud/config/conexion.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

try {
    $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)');
    $stmt->execute([':nombre' => $nombre, ':email' => $email]);

    $id = (int)$pdo->lastInsertId();

    header("Location: ?id=$id");
    respond(201, [
        'status'  => 'success',
        'message' => 'Usuario creado correctamente.',
        'data'    => ['id' => $id, 'nombre' => $nombre, 'email' => $email],
    ]);
} catch (PDOException $e) {
    // 23000 = restricción violada (email duplicado si la columna es UNIQUE)
    if ($e->getCode() === '23000') {
        fail(409, 'Ya existe un usuario con ese email.');
    }
    error_log('[crear usuario] ' . $e->getMessage()); // al log, no al cliente
    fail(500, 'Error interno del servidor.');
}