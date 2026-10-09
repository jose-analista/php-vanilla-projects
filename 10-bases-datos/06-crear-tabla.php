<?php

// Requerimos el archivo de conexión PDO
$pdo = require_once __DIR__ . '/01-conexion-pdo.php';

try {
    echo "--- Creación de Tabla en MySQL con PDO ---\n";

    // Sentencia SQL DDL para crear la tabla si no existe (incluyendo el campo imagen)
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        imagen VARCHAR(255) NULL,
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    // Para sentencias DDL (CREATE, DROP, ALTER) se utiliza exec() ya que no devuelven un conjunto de datos
    $pdo->exec($sql);

    echo "La tabla 'usuarios' ha sido creada o ya existía en la base de datos.\n";

} catch (PDOException $e) {
    echo "Error al crear la tabla: " . $e->getMessage() . "\n";
}