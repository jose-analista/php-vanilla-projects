<?php

// Requerimos el archivo de conexión PDO creado anteriormente
$pdo = require_once __DIR__ . '/01-conexion-pdo.php';

try {
    echo "--- 1. Consulta SELECT simple (fetch / fetchAll) ---\n";
    
    // Consulta para obtener todos los registros de una tabla (ej. 'usuarios')
    $sql = "SELECT id, nombre, email, creado_en FROM usuarios";
    $stmt = $pdo->query($sql);
    
    $usuarios = $stmt->fetchAll();

    if (empty($usuarios)) {
        echo "No se encontraron usuarios.\n";
    } else {
        foreach ($usuarios as $usuario) {
            echo "ID: {$usuario['id']} | Nombre: {$usuario['nombre']} | Email: {$usuario['email']}\n";
        }
    }

    echo "\n--- 2. Consulta SELECT con Prepared Statements (parámetros nombrados) ---\n";
    
    $idBuscado = 1;
    $sqlConParametros = "SELECT id, nombre, email FROM usuarios WHERE id = :id LIMIT 1";
    
    $stmtPrepared = $pdo->prepare($sqlConParametros);
    $stmtPrepared->execute([':id' => $idBuscado]);
    
    $usuarioEncontrado = $stmtPrepared->fetch();

    if ($usuarioEncontrado) {
        echo "Usuario encontrado (ID {$idBuscado}): {$usuarioEncontrado['nombre']} ({$usuarioEncontrado['email']})\n";
    } else {
        echo "No se encontró ningún usuario con el ID {$idBuscado}.\n";
    }

} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage() . "\n";
}