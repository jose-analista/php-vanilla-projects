<?php

// Requerimos el archivo de conexión PDO
$pdo = require_once __DIR__ . '/01-conexion-pdo.php';

try {
    echo "--- Actualización de registros con PDO ---\n";

    // Datos a actualizar
    $idUsuario     = 1;
    $nuevoNombre   = 'Carlos Mendoza Actualizado';
    $nuevoEmail    = 'carlos.mendoza.updated@example.com';

    // Sentencia SQL preparada
    $sql = "UPDATE usuarios 
            SET nombre = :nombre, 
                email = :email 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // Ejecución pasando los parámetros
    $stmt->execute([
        ':nombre' => $nuevoNombre,
        ':email'  => $nuevoEmail,
        ':id'     => $idUsuario
    ]);

    // rowCount() retorna la cantidad de filas que realmente fueron modificadas
    $filasAfectadas = $stmt->rowCount();

    if ($filasAfectadas > 0) {
        echo "Usuario con ID {$idUsuario} actualizado correctamente.\n";
        echo "Filas modificadas: {$filasAfectadas}\n";
    } else {
        echo "No se realizaron cambios. (Es posible que el ID {$idUsuario} no exista o los datos sean idénticos).\n";
    }

} catch (PDOException $e) {
    echo "Error al actualizar el registro: " . $e->getMessage() . "\n";
}