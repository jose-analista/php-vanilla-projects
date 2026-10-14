<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

$pdo = require_once __DIR__ . '/../../11-crud/usuarios-crud/config/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

try {
    if ($id) {
        $stmt = $pdo->prepare("SELECT id, nombre, email, imagen, creado_en FROM usuarios WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            echo json_encode(['status' => 'success', 'data' => $usuario], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado'], JSON_PRETTY_PRINT);
        }
    } else {
        $stmt = $pdo->query("SELECT id, nombre, email, imagen, creado_en FROM usuarios ORDER BY id DESC");
        $usuarios = $stmt->fetchAll();

        echo json_encode(['status' => 'success', 'data' => $usuarios], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_PRETTY_PRINT);
}