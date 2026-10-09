# Sistema de Usuarios

Aplicación web en **PHP 8 + MySQL + Composer** con registro, inicio de sesión, roles (administrador / usuario), perfil y CRUD de usuarios. Sin frameworks: router, vistas, autenticación y validación propios, con autoload PSR-4.

## Características

- Registro e inicio de sesión con contraseñas hasheadas (`password_hash` / `password_verify`).
- Roles: `admin` (administra usuarios) y `usuario` (ve su dashboard y edita su perfil).
- CRUD de usuarios para administradores, con búsqueda y paginación.
- Perfil: cambiar nombre y contraseña (pidiendo la contraseña actual).
- Protección contra los ataques más comunes:
  - **SQL Injection**: consultas preparadas con PDO.
  - **XSS**: toda salida HTML pasa por `e()` (`htmlspecialchars`).
  - **CSRF**: token en todos los formularios `POST`.
  - **Fijación de sesión**: `session_regenerate_id` al entrar y salir.
  - **Fuerza bruta**: bloqueo de 5 minutos tras 5 intentos fallidos (por sesión).
  - Cookies de sesión `HttpOnly` + `SameSite=Lax`.
- Logs de actividad con Monolog (`logs/app.log`).
- Variables de entorno con phpdotenv (`.env`).
- Pruebas con PHPUnit, análisis estático con PHPStan y estilo con PHP_CodeSniffer.

## Requisitos

- PHP 8.1 o superior con las extensiones `pdo_mysql` y `mbstring`
- MySQL 5.7+ o MariaDB 10.3+
- Composer 2.x

```bash
sudo apt install -y php-cli php-mbstring php-xml php-mysql unzip mysql-server
```

## Instalación

```bash
cd 14-proyectos/sistema-usuarios

# 1. Dependencias
composer install

# 2. Variables de entorno
cp .env.example .env
nano .env                      # usuario y contraseña de tu MySQL

# 3. Base de datos
mysql -u root -p < database/schema.sql

# 4. Primer administrador
composer admin -- "José Calderón" admin@mail.cl "Clave12345"

# 5. Iniciar el servidor
composer start                 # http://localhost:8000
```

> `composer admin` ejecuta `php bin/crear-admin.php`. Cambia el nombre, el email y la contraseña por los tuyos.

## Estructura

```
sistema-usuarios/
├── bin/
│   └── crear-admin.php          # Crea un administrador desde la terminal
├── database/
│   └── schema.sql               # Tabla usuarios
├── logs/                        # app.log (ignorado por Git)
├── public/                      # Única carpeta expuesta al servidor web
│   ├── index.php                # Front controller y rutas
│   ├── .htaccess                # Reescritura para Apache
│   └── css/style.css
├── src/
│   ├── Controllers/             # Auth, Dashboard, Profile, User
│   ├── Repositories/
│   │   └── UserRepository.php   # Consultas SQL (PDO)
│   ├── Auth.php                 # Login, logout, roles, bloqueo por intentos
│   ├── AppLogger.php            # Monolog
│   ├── Config.php               # Lectura del .env
│   ├── Csrf.php
│   ├── Database.php             # Conexión PDO
│   ├── Flash.php                # Mensajes de una sola vez
│   ├── Http.php                 # redirect() y abort()
│   ├── Router.php
│   ├── Session.php
│   ├── Validator.php
│   ├── View.php
│   └── helpers.php              # e(), csrf_field(), field_error()
├── tests/
│   └── ValidatorTest.php
├── views/                       # Plantillas PHP
│   ├── layout.php
│   ├── auth/  (login, register)
│   ├── usuarios/ (index, form)
│   ├── dashboard.php
│   ├── perfil.php
│   └── error.php
├── .env.example
├── .gitignore
├── composer.json
└── phpunit.xml
```

## Rutas

| Método | Ruta | Acceso | Descripción |
|---|---|---|---|
| GET | `/` | Público | Redirige a `/dashboard` o `/login` |
| GET / POST | `/login` | Público | Iniciar sesión |
| GET / POST | `/registro` | Público | Crear cuenta (rol `usuario`) |
| POST | `/logout` | Autenticado | Cerrar sesión |
| GET | `/dashboard` | Autenticado | Panel (con estadísticas si eres admin) |
| GET / POST | `/perfil` | Autenticado | Editar nombre y contraseña |
| GET | `/usuarios` | Admin | Listado con `?q=` y `?page=` |
| GET / POST | `/usuarios/crear`, `/usuarios` | Admin | Crear usuario |
| GET / POST | `/usuarios/{id}/editar` | Admin | Editar usuario |
| POST | `/usuarios/{id}/eliminar` | Admin | Eliminar usuario |

## Scripts de Composer

| Comando | Qué hace |
|---|---|
| `composer start` | Servidor de desarrollo en `localhost:8000` |
| `composer admin -- "Nombre" email "Clave"` | Crea un administrador |
| `composer test` | Ejecuta PHPUnit |
| `composer stan` | Análisis estático con PHPStan |
| `composer cs` | Revisa el estilo PSR-12 |

## Reglas de negocio

- El email es único y se guarda en minúsculas.
- La contraseña debe tener entre 8 y 72 caracteres, con letras y números (72 es el límite de bcrypt).
- Un administrador no puede eliminarse, desactivarse ni quitarse el rol a sí mismo, para no quedarse sin acceso.
- Las cuentas inactivas no pueden iniciar sesión, y si se desactiva una cuenta con sesión abierta, esta se cierra en la siguiente petición.

## Despliegue

- Apunta el *document root* del servidor a la carpeta `public/`, nunca a la raíz del proyecto.
- En `.env` usa `APP_DEBUG=false` y un usuario de MySQL con permisos limitados a esta base de datos.
- Sirve el sitio por HTTPS: la cookie de sesión se marca `Secure` automáticamente cuando detecta HTTPS.
- Si usas Apache, habilita `mod_rewrite` (el `.htaccess` de `public/` ya está incluido).

## Ideas para seguir

- Recuperación de contraseña por correo (`phpmailer/phpmailer`).
- Bloqueo de fuerza bruta en base de datos, por IP y por email, en vez de por sesión.
- Verificación de email al registrarse.
- API REST con JWT (`firebase/php-jwt`) reutilizando `UserRepository`.
- Pruebas de integración con una base de datos de prueba.

## Qué se aprende en este proyecto

- Arquitectura por capas (controladores, repositorio, vistas) sin framework.
- Autenticación y autorización con sesiones y roles.
- Seguridad web básica: SQLi, XSS, CSRF, fijación de sesión y hashing de contraseñas.
- Uso real de Composer: autoload PSR-4, `files`, scripts, dependencias de producción y de desarrollo.
