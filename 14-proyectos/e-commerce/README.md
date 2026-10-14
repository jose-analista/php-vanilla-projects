# E-Commerce con PHP y Composer

Proyecto de desarrollo de una aplicación de comercio electrónico utilizando **PHP puro y Composer**, orientado a practicar programación backend, organización del código, gestión de dependencias y construcción de funcionalidades habituales en una tienda online, sin utilizar frameworks como Laravel o Symfony.

El objetivo es aplicar conceptos de desarrollo web mediante una estructura organizada, modular y mantenible, utilizando PHP, Composer y tecnologías web complementarias.

## 🛠️ Tecnologías

- **PHP 8.x:** lógica de negocio y procesamiento del lado del servidor.
- **Composer:** gestión de dependencias y carga automática de clases mediante PSR-4.
- **MySQL / MariaDB:** almacenamiento de productos, usuarios y pedidos, si el proyecto utiliza persistencia.
- **PDO:** acceso a bases de datos mediante consultas preparadas.
- **HTML5:** estructura de las páginas.
- **CSS3:** estilos y diseño de interfaces.
- **JavaScript:** interactividad del lado del cliente.
- **Git / GitHub:** control de versiones y documentación del proyecto.

> Este proyecto utiliza PHP puro. Composer es un administrador de dependencias y autoloading, no un framework.

## 🎯 Objetivos del proyecto

- Comprender cómo estructurar una aplicación PHP sin depender de un framework.
- Utilizar Composer para administrar bibliotecas y dependencias.
- Implementar autoloading de clases mediante PSR-4.
- Separar la lógica de negocio, el acceso a datos y la presentación.
- Practicar operaciones CRUD.
- Desarrollar funcionalidades propias de un comercio electrónico.
- Aplicar buenas prácticas de validación, seguridad y mantenimiento.
- Construir una base técnica que permita evolucionar el proyecto en el futuro.

## 🛍️ Funcionalidades previstas

Las siguientes funcionalidades representan el alcance que puede desarrollar una tienda online. Su disponibilidad efectiva depende de la implementación actual del proyecto.

### Catálogo de productos

- Listado de productos.
- Visualización de detalles.
- Precio, descripción e imágenes.
- Organización por categorías.
- Búsqueda y filtrado de productos.
- Control de disponibilidad y stock.

### Carrito de compras

- Agregar productos al carrito.
- Modificar cantidades.
- Eliminar productos.
- Calcular subtotales y total.
- Validar disponibilidad antes de confirmar un pedido.
- Mantener el carrito durante la navegación mediante sesiones.

### Usuarios

- Registro de clientes.
- Inicio y cierre de sesión.
- Gestión de información básica del usuario.
- Almacenamiento seguro de contraseñas.
- Separación de funcionalidades públicas y privadas.

### Pedidos

- Registro de pedidos.
- Detalle de productos y cantidades.
- Cálculo de importes en el servidor.
- Estados del pedido.
- Historial de compras.
- Asociación de pedidos con clientes.

### Administración

- Crear, consultar, actualizar y eliminar productos.
- Administrar categorías.
- Revisar pedidos.
- Actualizar el stock.
- Gestionar información del catálogo.

### Pagos

La integración con una pasarela de pagos puede incorporarse como una etapa posterior. Los pagos reales requieren un proveedor, credenciales seguras, validación de notificaciones y verificación del estado de las transacciones en el servidor.

## 📁 Estructura del proyecto

Una posible organización para desarrollar el proyecto con PHP puro y Composer es la siguiente:

```text
e-commerce/
│
├── public/
│   ├── index.php
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
│
├── src/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   ├── Repositories/
│   └── Database/
│
├── templates/
│   ├── layouts/
│   ├── products/
│   ├── cart/
│   ├── auth/
│   └── orders/
│
├── config/
│   └── database.php
│
├── routes/
│   └── web.php
│
├── database/
│   └── schema.sql
│
├── tests/
│
├── vendor/
│
├── .env.example
├── .gitignore
├── composer.json
├── composer.lock
└── README.md
```

**Descripción de los directorios:**

| Directorio | Responsabilidad |
|---|---|
| `public/` | Punto de entrada y archivos públicos. |
| `src/Controllers/` | Recibir solicitudes y coordinar respuestas. |
| `src/Models/` | Representar entidades del dominio, si se utiliza este enfoque. |
| `src/Services/` | Contener reglas de negocio. |
| `src/Repositories/` | Centralizar consultas y operaciones de persistencia. |
| `src/Database/` | Gestionar la conexión y configuración de la base de datos. |
| `templates/` | Contener las vistas y plantillas HTML con PHP. |
| `config/` | Configuración de la aplicación. |
| `routes/` | Definir el enrutamiento, si se implementa un sistema propio. |
| `database/` | Scripts SQL de creación de tablas. |
| `tests/` | Pruebas automatizadas. |
| `vendor/` | Dependencias instaladas por Composer. |

Esta estructura es una propuesta de organización y debe ajustarse a los archivos que realmente existan en el repositorio.

## 📋 Requisitos

- PHP 8.x, compatible con las dependencias seleccionadas.
- Composer 2.x.
- MySQL o MariaDB, si se utiliza una base de datos.
- Extensión PDO y el controlador `pdo_mysql`, cuando corresponda.
- Git.
- Navegador web.
- Editor de código, como Visual Studio Code.

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/jose-analista/php-projects.git
```

### 2. Entrar al directorio del proyecto

Si el proyecto se encuentra dentro de `14-proyectos/e-commerce/`:

```bash
cd php-projects/14-proyectos/e-commerce
```

Ajusta la ruta según la ubicación real del repositorio.

### 3. Verificar PHP y Composer

```bash
php -v
composer --version
```

### 4. Instalar las dependencias

Si el proyecto contiene un archivo `composer.json`:

```bash
composer install
```

Este comando instala las dependencias declaradas y genera el autoload cuando corresponde.

Si todavía no existe `composer.json`, inicializa Composer:

```bash
composer init
```

Sigue las instrucciones de la terminal para definir los metadatos del proyecto.

### 5. Configurar la base de datos

Si el proyecto utiliza MySQL o MariaDB:

1. Crear una base de datos.
2. Ejecutar el script SQL del proyecto, si existe.
3. Configurar las credenciales de conexión.
4. Verificar que PHP tenga habilitado el controlador de base de datos requerido.

No publiques contraseñas ni credenciales reales en GitHub.

## 📦 Uso de Composer

Composer permite administrar dependencias y automatizar la carga de clases de PHP.

### Inicializar Composer

```bash
composer init
```

### Instalar una dependencia

```bash
composer require vendor/package
```

Reemplaza `vendor/package` por el paquete que realmente necesites.

### Instalar dependencias de un proyecto existente

```bash
composer install
```

### Actualizar dependencias

```bash
composer update
```

Este comando puede cambiar las versiones instaladas según las restricciones de `composer.json`. En proyectos existentes, utiliza `composer install` para respetar las versiones registradas en `composer.lock`.

### Validar la configuración

```bash
composer validate
```

### Regenerar el autoload

```bash
composer dump-autoload
```

## ⚙️ Configuración de autoload con PSR-4

Una configuración posible de `composer.json` para una aplicación organizada bajo el espacio de nombres `App\\` es:

```json
{
    "name": "jose-analista/e-commerce",
    "description": "Proyecto de comercio electrónico desarrollado con PHP puro y Composer",
    "type": "project",
    "require": {
        "php": "^8.2"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

La versión de PHP debe ajustarse a los requisitos reales del proyecto. Si necesitas bibliotecas adicionales, agrégalas mediante Composer.

Después de configurar el archivo:

```bash
composer dump-autoload
```

En el punto de entrada de la aplicación:

```php
<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
```

Este ejemplo supone que el archivo de entrada está ubicado en `public/index.php`.

## ▶️ Ejecutar la aplicación

Si existe `public/index.php`, inicia el servidor de desarrollo desde la raíz del proyecto:

```bash
php -S localhost:8000 -t public
```

Abre en el navegador:

http://localhost:8000

El servidor integrado de PHP está destinado al desarrollo y las pruebas locales, no a la publicación de una tienda en producción.

## 🗄️ Base de datos y persistencia

Si la aplicación utiliza MySQL o MariaDB, puede conectarse mediante PDO.

Ejemplo de conexión:

```php
<?php

$host = 'localhost';
$dbname = 'ecommerce';
$username = 'usuario';
$password = 'contraseña';

$pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
    $username,
    $password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);
```

En una implementación real, configura las credenciales mediante variables de entorno, gestiona las excepciones y evita exponer información sensible.

### Entidades que puede incluir el modelo de datos

- `users`: usuarios y clientes.
- `categories`: categorías del catálogo.
- `products`: productos y precios.
- `carts`: carritos persistentes, si se requieren.
- `cart_items`: productos y cantidades del carrito.
- `orders`: pedidos.
- `order_items`: detalle de los pedidos.
- `payments`: registros de pagos, si se integra una pasarela.

Las tablas deben definirse de acuerdo con los requisitos reales, las reglas del negocio y las necesidades de integridad de los datos.

## 🔐 Seguridad

La seguridad es especialmente importante en una aplicación que administra usuarios, pedidos y operaciones comerciales.

Buenas prácticas recomendadas:

- Utilizar consultas preparadas con PDO.
- Validar todos los datos recibidos del cliente en el servidor.
- Escapar correctamente los datos antes de mostrarlos en HTML.
- Almacenar contraseñas mediante `password_hash()`.
- Verificar contraseñas mediante `password_verify()`.
- Implementar protección CSRF en formularios que modifican datos.
- Verificar la autenticación y autorización de cada operación protegida.
- Validar precios, cantidades y stock en el servidor.
- No confiar en importes enviados desde JavaScript.
- Mantener las credenciales fuera del repositorio público.
- Utilizar HTTPS en producción.
- Evitar mostrar excepciones y detalles internos al usuario.
- Mantener actualizadas las dependencias.

## 🧪 Pruebas y calidad

Para mejorar la calidad del código, se recomienda incorporar progresivamente:

- Pruebas de funciones y reglas de negocio.
- Pruebas de validación de formularios.
- Pruebas de consultas y operaciones CRUD.
- Pruebas del cálculo de subtotales y totales.
- Pruebas de disponibilidad y actualización del stock.
- Pruebas de autenticación y permisos.
- Pruebas de integración de los procesos de compra.

Composer también permite incorporar herramientas de pruebas y análisis estático cuando el proyecto lo requiera.

## 🌱 Control de versiones

Para registrar los cambios realizados:

```bash
git status
git add .
git commit -m "Actualizar proyecto e-commerce"
git push
```

### Archivos que no deben publicarse

El archivo `.gitignore` debería excluir, según corresponda:

```gitignore
/vendor/
/.env
/.phpunit.cache/
/.phpunit.result.cache
*.log
```

No excluyas `composer.json` ni `composer.lock`: son importantes para documentar e instalar las dependencias del proyecto.

El archivo `.env.example` puede incluir nombres de variables y valores ficticios, nunca secretos reales.

## 📈 Posibles mejoras

- Catálogo con categorías, búsqueda y filtros.
- Carrito de compras con persistencia.
- Registro e inicio de sesión.
- Gestión de pedidos y estados.
- Panel de administración.
- Control de stock.
- Validaciones y mensajes de error consistentes.
- Pruebas automatizadas.
- Integración de una pasarela de pagos.
- Envío de correos transaccionales.
- Registro de eventos y errores.
- Documentación de endpoints si se incorpora una API REST.
- Preparación para despliegue en un entorno de producción.

## 👨‍💻 Perfil profesional

**José Calderón — Analista Programador**

Este proyecto forma parte de mi portafolio técnico y está orientado a demostrar conocimientos de PHP, Composer, desarrollo backend, acceso a datos y organización del código.

El objetivo es construir una aplicación práctica que permita aplicar los fundamentos de programación a un escenario comercial, priorizando la legibilidad, la seguridad y el mantenimiento del software.

## 📄 Licencia

Si deseas permitir la reutilización del código, puedes agregar una licencia, como MIT, después de definir las condiciones de uso del proyecto.

---

**Tecnologías principales:** PHP · Composer · MySQL/MariaDB · PDO · Git