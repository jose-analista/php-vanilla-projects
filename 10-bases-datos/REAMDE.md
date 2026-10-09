# Módulo 11: CRUD Completo de Usuarios con Soporte de Imágenes

Este proyecto implementa una aplicación web completa para la gestión de usuarios (CRUD: *Create, Read, Update, Delete*) desarrollada en PHP nativo, PDO para la persistencia de datos en MySQL/MariaDB y Bootstrap 5 para el diseño de interfaz en modo oscuro.

---

## 📁 Estructura del Módulo

```text
11-crud/usuarios-crud/
├── config/
│   └── conexion.php      # Configuración de conexión PDO a MySQL
├── uploads/              # Directorio de almacenamiento de imágenes
├── crear.php             # Formulario e inserción de nuevos usuarios con avatar
├── editar.php            # Formulario y actualización de datos e imagen de perfil
├── eliminar.php          # Eliminación de usuario y borrado físico de su imagen
├── index.php             # Listado de usuarios con tabla responsiva y vista previa de foto
└── README.md             # Documentación del módulo
✨ Características Principales
Listado General (index.php): Muestra la información de los usuarios en una tabla adaptativa con badges, avatares circulares y acciones rápidas.

Creación (crear.php): Permite registrar usuarios validando correo electrónico único y subida de archivos de imagen (jpg, jpeg, png, webp).

Edición (editar.php): Permite actualizar información personal y reemplazar la imagen de perfil, eliminando la versión previa del disco.

Eliminación (eliminar.php): Elimina el registro de la base de datos y realiza la limpieza del archivo físico almacenado en uploads/.

Seguridad: Uso de Prepared Statements contra inyección SQL y sanitización de salida HTML mediante htmlspecialchars().

🗄️ Esquema de Base de Datos
El módulo trabaja sobre la tabla usuarios configurada en el módulo de bases de datos:

SQL
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    imagen VARCHAR(255) NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
🚀 Requisitos e Instalación
PHP: >= 8.0

Servidor Web: Apache / Nginx (XAMPP, LAMP, Laragon) con extensión pdo_mysql activa.

Base de Datos: MySQL / MariaDB.

Pasos para ejecutar:
Asegúrate de haber ejecutado la creación de la tabla ejecutando:

Bash
php 10-bases-datos/06-crear-tabla.php
Verifica la configuración de acceso en 11-crud/usuarios-crud/config/conexion.php:

PHP
$host     = '127.0.0.1';
$dbname   = 'mi_base_datos';
$user     = 'root';
$password = '';
Sirve el proyecto con el servidor embebido de PHP o a través de Apache (XAMPP):

Bash
# Opción CLI embebido
php -S 127.0.0.1:8000 -t 11-crud/usuarios-crud/
Accede desde tu navegador web a http://127.0.0.1:8000.