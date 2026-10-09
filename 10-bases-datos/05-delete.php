<?php

// Requerimos el archivo de conexión PDO
$pdo = require_once __DIR__ . '/01-conexion-pdo.php';

try {
    echo "--- Eliminación de registros con PDO ---\n";

    // ID del registro que se desea eliminar
    $idUsuarioAEliminar = 1;

    // Sentencia SQL preparada
    $sql = "DELETE FROM usuarios WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // Ejecutamos la consulta pasando el parámetro
    $stmt->execute([
        ':id' => $idUsuarioAEliminar
    ]);

    // rowCount() devuelve la cantidad de filas eliminadas
    $filasAfectadas = $stmt->rowCount();

    if ($filasAfectadas > 0) {
        echo "Usuario con ID {$idUsuarioAEliminar} eliminado correctamente.\n";
        echo "Filas eliminadas: {$filasAfectadas}\n";
    } else {
        echo "No se eliminó ningún registro. (Es posible que el ID {$idUsuarioAEliminar} no exista).\n";
    }

} catch (PDOException $e) {
    echo "Error al eliminar el registro: " . $e->getMessage() . "\n";
}