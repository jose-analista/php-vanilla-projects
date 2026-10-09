# Módulo 11: CRUD Completo de Usuarios con Subida de Imágenes

Este proyecto implementa una aplicación web completa para la gestión de usuarios (CRUD: *Create, Read, Update, Delete*) desarrollada en PHP nativo, PDO para la persistencia de datos en MySQL/MariaDB y Bootstrap 5 para el diseño de interfaz en modo oscuro.

---

## 📁 Estructura del Módulo

```text
11-crud/usuarios-crud/
├── config/
│   └── conexion.php      # Configuración de conexión PDO a MySQL
├── uploads/              # Directorio de almacenamiento de imágenes (se crea dinámicamente)
├── crear.php             # Formulario e inserción de nuevos usuarios con avatar
├── editar.php            # Formulario y actualización de datos e imagen de perfil
├── eliminar.php          # Eliminación de usuario y borrado físico de su imagen
├── index.php             # Listado de usuarios con tabla responsiva y vista previa de foto
└── README.md             # Documentación del módulo