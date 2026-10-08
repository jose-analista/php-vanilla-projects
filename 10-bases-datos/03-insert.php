<?php

// Requerimos el archivo de conexión PDO
$pdo = require_once __DIR__ . '/01-conexion-pdo.php';

try {
    echo "--- 1. Insertar un solo registro con Prepared Statement ---\n";

    $sql = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
    $stmt = $pdo->prepare($sql);

    // Datos a insertar
    $nuevoUsuario = [
        ':nombre' => 'Carlos Mendoza',
        ':email'  => 'carlos.mendoza@example.com'
    ];

    // Ejecutamos la inserción
    if ($stmt->execute($nuevoUsuario)) {
        $idInsertado = $pdo->lastInsertId();
        echo "Usuario insertado correctamente con el ID: {$idInsertado}\n";
    }

    echo "\n--- 2. Inserción múltiple usando Transacciones ---\n";

    $nuevosUsuarios = [
        ['nombre' => 'Ana Gómez', 'email' => 'ana.gomez@example.com'],
        ['nombre' => 'Luis Martínez', 'email' => 'luis.martinez@example.com'],
        ['nombre' => 'Sofía Torres', 'email' => 'sofia.torres@example.com'],
    ];

    // Iniciar transacción
    $pdo->beginTransaction();

    $sqlBatch = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
    $stmtBatch = $pdo->prepare($sqlBatch);

    foreach ($nuevosUsuarios as $usuario) {
        $stmtBatch->execute([
            ':nombre' => $usuario['nombre'],
            ':email'  => $usuario['email']
        ]);
        echo "Insertado: {$usuario['nombre']} (ID: " . $pdo->lastInsertId() . ")\n";
    }

    // Confirmar cambios si todo salió bien
    $pdo->commit();
    echo "Transacción completada con éxito.\n";

} catch (PDOException $e) {
    // Si algo falla durante la transacción, revertimos los cambios
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
        echo "Transacción revertida debido a un error.\n";
    }

    echo "Error al insertar registro: " . $e->getMessage() . "\n";
}