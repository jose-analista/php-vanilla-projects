<?php
$pdo = require_once __DIR__ . '/config/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    try {
        // Consultar si tiene una imagen asociada para eliminar el archivo del servidor
        $stmtSelect = $pdo->prepare("SELECT imagen FROM usuarios WHERE id = :id LIMIT 1");
        $stmtSelect->execute([':id' => $id]);
        $usuario = $stmtSelect->fetch();

        if ($usuario && !empty($usuario['imagen']) && file_exists(__DIR__ . '/' . $usuario['imagen'])) {
            unlink(__DIR__ . '/' . $usuario['imagen']);
        }

        // Eliminar registro de la base de datos
        $stmtDelete = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmtDelete->execute([':id' => $id]);

        header("Location: index.php?mensaje=Usuario eliminado correctamente");
        exit;
    } catch (PDOException $e) {
        header("Location: index.php?error=No se pudo eliminar el usuario");
        exit;
    }
}

header("Location: index.php");
exit;