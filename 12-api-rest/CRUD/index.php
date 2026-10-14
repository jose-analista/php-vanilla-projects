<?php
declare(strict_types=1);

/**
 * API REST de usuarios — 12-api-rest/CRUD/index.php
 *
 * GET    ?id=1                 -> un usuario
 * GET    ?page=1&limit=20&q=ab -> listado paginado con búsqueda
 * POST                         -> crear   (JSON o form-data)
 * PUT    ?id=1                 -> reemplazar (nombre y email obligatorios)
 * PATCH  ?id=1                 -> actualizar parcialmente
 * DELETE ?id=1                 -> eliminar
 */

// ───────────── Configuración ─────────────
const ALLOWED_ORIGIN = '*';      // en producción: 'https://tudominio.cl'
const MAX_LIMIT      = 100;
const DEFAULT_LIMIT  = 20;

// ───────────── Cabeceras ─────────────
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: ' . ALLOWED_ORIGIN);
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// ───────────── Helpers de respuesta ─────────────
function respond(int $code, array $payload): never
{
    http_response_code($code);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function success(array $extra = [], int $code = 200): never
{
    respond($code, ['status' => 'success'] + $extra);
}

function fail(int $code, string $message, array $errors = []): never
{
    $payload = ['status' => 'error', 'message' => $message];
    if ($errors) {
        $payload['errors'] = $errors;
    }
    respond($code, $payload);
}

// ───────────── Helpers de entrada ─────────────
function getBody(): array
{
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    if (stripos($contentType, 'application/json') !== false) {
        $raw  = file_get_contents('php://input');
        $data = json_decode($raw ?: '', true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            fail(400, 'El cuerpo de la petición no es un JSON válido');
        }
        return $data;
    }

    return $_POST; // form-data / x-www-form-urlencoded
}

/**
 * Valida y normaliza los datos de un usuario.
 * $partial = true (PATCH): solo valida los campos presentes.
 * @return array{0: array<string,string>, 1: array<string,string>} [datos limpios, errores]
 */
function validateUser(array $input, bool $partial = false): array
{
    $clean  = [];
    $errors = [];

    if (!$partial || array_key_exists('nombre', $input)) {
        $nombre = trim((string)($input['nombre'] ?? ''));
        $len    = mb_strlen($nombre);
        if ($len < 2 || $len > 100) {
            $errors['nombre'] = 'El nombre debe tener entre 2 y 100 caracteres';
        } else {
            $clean['nombre'] = $nombre;
        }
    }

    if (!$partial || array_key_exists('email', $input)) {
        $email = mb_strtolower(trim((string)($input['email'] ?? '')));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
            $errors['email'] = 'El email no es válido';
        } else {
            $clean['email'] = $email;
        }
    }

    if ($partial && !$clean && !$errors) {
        $errors['body'] = 'Envía al menos un campo: nombre o email';
    }

    return [$clean, $errors];
}

function findUser(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare(
        'SELECT id, nombre, email, imagen, creado_en FROM usuarios WHERE id = :id LIMIT 1'
    );
    $stmt->execute([':id' => $id]);
    return $stmt->fetch() ?: null;
}

function requireId(?int $id): int
{
    if (!$id || $id < 1) {
        fail(400, 'ID de usuario requerido y válido en la URL (?id=X)');
    }
    return $id;
}

// ───────────── Conexión ─────────────
// OJO: require (no require_once) para que siempre devuelva el $pdo
$pdo = require __DIR__ . '/../../11-crud/usuarios-crud/config/conexion.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$method = $_SERVER['REQUEST_METHOD'];
$id     = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;

// ───────────── Rutas ─────────────
try {
    switch ($method) {

        case 'GET':
            if ($id) {
                $user = findUser($pdo, $id);
                $user ? success(['data' => $user]) : fail(404, 'Usuario no encontrado');
            }

            $page   = max(1, (int)($_GET['page'] ?? 1));
            $limit  = min(MAX_LIMIT, max(1, (int)($_GET['limit'] ?? DEFAULT_LIMIT)));
            $offset = ($page - 1) * $limit;
            $q      = trim((string)($_GET['q'] ?? ''));

            $where  = '';
            $params = [];
            if ($q !== '') {
                $where = 'WHERE nombre LIKE :q OR email LIKE :q';
                $params[':q'] = '%' . addcslashes($q, '%_\\') . '%';
            }

            $count = $pdo->prepare("SELECT COUNT(*) FROM usuarios $where");
            $count->execute($params);
            $total = (int)$count->fetchColumn();

            $stmt = $pdo->prepare(
                "SELECT id, nombre, email, imagen, creado_en
                 FROM usuarios $where
                 ORDER BY id DESC
                 LIMIT :limit OFFSET :offset"
            );
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            success([
                'data' => $stmt->fetchAll(),
                'meta' => [
                    'page'        => $page,
                    'limit'       => $limit,
                    'total'       => $total,
                    'total_pages' => (int)ceil($total / $limit),
                ],
            ]);

        case 'POST':
            [$data, $errors] = validateUser(getBody());
            if ($errors) {
                fail(422, 'Datos inválidos', $errors);
            }

            $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)');
            $stmt->execute([':nombre' => $data['nombre'], ':email' => $data['email']]);

            $newId = (int)$pdo->lastInsertId();
            header("Location: ?id=$newId");
            success(['message' => 'Usuario creado', 'data' => findUser($pdo, $newId)], 201);

        case 'PUT':
        case 'PATCH':
            $id = requireId($id);
            if (!findUser($pdo, $id)) {
                fail(404, 'Usuario no encontrado');
            }

            [$data, $errors] = validateUser(getBody(), partial: $method === 'PATCH');
            if ($errors) {
                fail(422, 'Datos inválidos', $errors);
            }

            // SET dinámico: solo con columnas permitidas por validateUser()
            $sets   = [];
            $params = [':id' => $id];
            foreach ($data as $column => $value) {
                $sets[]            = "$column = :$column";
                $params[":$column"] = $value;
            }

            $stmt = $pdo->prepare('UPDATE usuarios SET ' . implode(', ', $sets) . ' WHERE id = :id');
            $stmt->execute($params);

            success(['message' => 'Usuario actualizado', 'data' => findUser($pdo, $id)]);

        case 'DELETE':
            $id   = requireId($id);
            $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = :id');
            $stmt->execute([':id' => $id]);

            $stmt->rowCount() > 0
                ? success(['message' => 'Usuario eliminado'])
                : fail(404, 'Usuario no encontrado');

        default:
            header('Allow: GET, POST, PUT, PATCH, DELETE, OPTIONS');
            fail(405, 'Método no permitido');
    }
} catch (PDOException $e) {
    // 23000 = violación de restricción (p. ej. email duplicado con UNIQUE)
    if ($e->getCode() === '23000') {
        fail(409, 'Ya existe un usuario con ese email');
    }
    error_log('[API usuarios] ' . $e->getMessage()); // al log, no al cliente
    fail(500, 'Error interno del servidor');
} catch (Throwable $e) {
    error_log('[API usuarios] ' . $e->getMessage());
    fail(500, 'Error interno del servidor');
}