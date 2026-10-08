<?php

// Configuración de la base de datos
$host     = 'localhost';
$dbname   = 'mi_base_datos';
$user     = 'root';
$password = '';
$charset  = 'utf8mb4';

// Data Source Name (DSN)
$dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

// Opciones de configuración de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // Retorna arreglos asociativos por defecto
    PDO::ATTR_EMULATE_PREPARES   => false,                 // Usa preparaciones reales de MySQL
];

try {
    // Creación de la instancia de PDO
    $pdo = new PDO($dsn, $user, $password, $options);

    echo "Conexión establecida con éxito a la base de datos '{$dbname}'.\n";

    // Retornamos la instancia para poder incluir este archivo en otros scripts
    return $pdo;

} catch (PDOException $e) {
    // En entornos de producción no se debe mostrar $e->getMessage() directamente al usuario final por seguridad
    echo "Error de conexión: " . $e->getMessage() . "\n";
    exit;
}