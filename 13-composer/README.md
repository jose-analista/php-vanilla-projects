# 13 · Composer

Guía completa de **Composer**, el gestor de dependencias de PHP: instalación en Ubuntu, creación de un proyecto, autoload PSR-4, librerías recomendadas para un analista programador y buenas prácticas para el repositorio.

## Índice

1. [¿Qué es Composer?](#qué-es-composer)
2. [Requisitos](#requisitos)
3. [Instalación en Ubuntu](#instalación-en-ubuntu)
4. [Estructura de la carpeta](#estructura-de-la-carpeta)
5. [Crear el proyecto](#crear-el-proyecto)
6. [Comandos principales](#comandos-principales)
7. [Autoload PSR-4](#autoload-psr-4)
8. [Librerías recomendadas](#librerías-recomendadas)
9. [Instalar las librerías base](#instalar-las-librerías-base)
10. [Ejemplos de uso](#ejemplos-de-uso)
11. [Scripts de calidad de código](#scripts-de-calidad-de-código)
12. [Buenas prácticas con Git](#buenas-prácticas-con-git)
13. [Problemas frecuentes](#problemas-frecuentes)
14. [Qué se aprende en esta carpeta](#qué-se-aprende-en-esta-carpeta)

---

## ¿Qué es Composer?

Composer es a PHP lo que `npm` es a JavaScript o `pip` a Python. Permite:

- Instalar librerías externas con un solo comando (desde [Packagist](https://packagist.org)).
- Fijar las versiones exactas que usa el proyecto (`composer.lock`).
- Cargar tus propias clases sin escribir `require` en cada archivo (autoload).

## Requisitos

- Ubuntu (o cualquier Linux/macOS/WSL)
- PHP 8.1 o superior (probado con PHP 8.3)
- Composer 2.x
- Git, `curl` y `unzip`

## Instalación en Ubuntu

### 1. PHP y extensiones necesarias

```bash
sudo apt update
sudo apt install -y php-cli php-mbstring php-xml php-curl php-zip php-mysql php-gd php-intl unzip curl git
php -v
```

### 2. Composer

Se usa el instalador oficial, no el paquete `composer` de `apt`, porque suele traer una versión antigua.

```bash
cd ~
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```

Antes de ejecutar el instalador, verifica su hash SHA-384 con el que aparece en
[getcomposer.org/download](https://getcomposer.org/download/) (copia el comando completo de esa página). Luego:

```bash
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
composer -V
```

## Estructura de la carpeta

```
13-composer/
├── composer.json      # Definición del proyecto y dependencias
├── composer.lock      # Versiones exactas instaladas (se sube a Git)
├── vendor/            # Librerías instaladas (NO se sube a Git)
├── src/               # Clases propias (namespace App\)
├── .env.example       # Plantilla de variables de entorno
├── .gitignore
└── index.php          # Punto de entrada de ejemplo
```

> Ajusta este árbol a los archivos reales de tu carpeta.

## Crear el proyecto

```bash
cd ~/Escritorio/php-vanilla-projects/13-composer
composer init
```

`composer init` hace preguntas interactivas: nombre del paquete (`jose-analista/composer-demo`), descripción, tipo de proyecto y versión mínima de PHP (`>=8.1`).

Si ya existe un `composer.json` (por ejemplo, al clonar el repositorio), solo instala lo definido:

```bash
composer install
```

## Comandos principales

| Comando | Qué hace |
|---|---|
| `composer init` | Crea un `composer.json` de forma interactiva |
| `composer require vendor/paquete` | Instala una librería y la agrega a `composer.json` |
| `composer require --dev vendor/paquete` | Instala una librería solo para desarrollo |
| `composer install` | Instala lo indicado en `composer.lock` |
| `composer update` | Actualiza las librerías según las versiones permitidas |
| `composer remove vendor/paquete` | Desinstala una librería |
| `composer dump-autoload` | Regenera el autoload (útil al crear clases nuevas) |
| `composer show` | Lista los paquetes instalados |
| `composer outdated` | Muestra paquetes con versiones nuevas disponibles |
| `composer validate` | Comprueba que `composer.json` esté bien formado |
| `composer audit` | Busca vulnerabilidades conocidas en las dependencias |

## Autoload PSR-4

En `composer.json` se indica qué namespace corresponde a qué carpeta:

```json
{
    "name": "jose-analista/composer-demo",
    "require": {
        "php": ">=8.1"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

Después de modificar la sección `autoload`, ejecuta:

```bash
composer dump-autoload
```

### Clase propia de ejemplo

`src/Saludo.php`

```php
<?php
declare(strict_types=1);

namespace App;

class Saludo
{
    public function __construct(private string $nombre) {}

    public function decir(): string
    {
        return "Hola, {$this->nombre}";
    }
}
```

`index.php`

```php
<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Saludo;

echo (new Saludo('José'))->decir();
```

Ejecutar:

```bash
php -S localhost:8000
# abrir http://localhost:8000
```

## Librerías recomendadas

### Producción (`composer require`)

| Librería | Para qué sirve |
|---|---|
| `vlucas/phpdotenv` | Variables de entorno (`.env`) para credenciales de BD |
| `monolog/monolog` | Logs de errores y actividad |
| `guzzlehttp/guzzle` | Consumir otras APIs (cliente HTTP) |
| `firebase/php-jwt` | Autenticación con tokens JWT en una API REST |
| `nikic/fast-route` | Router para rutas limpias como `/usuarios/1` |
| `respect/validation` | Validación de datos más completa |
| `nesbot/carbon` | Manejo de fechas y horas |
| `ramsey/uuid` | Generar IDs únicos (UUID) |
| `phpmailer/phpmailer` | Envío de correos |
| `phpoffice/phpspreadsheet` | Leer y generar archivos Excel |
| `dompdf/dompdf` | Generar PDF desde HTML |

### Solo desarrollo (`composer require --dev`)

| Librería | Para qué sirve |
|---|---|
| `phpunit/phpunit` | Pruebas automáticas |
| `phpstan/phpstan` | Análisis estático: detecta errores sin ejecutar el código |
| `squizlabs/php_codesniffer` | Revisa el estilo de código (PSR-12) |
| `filp/whoops` | Pantalla de errores legible mientras desarrollas |

## Instalar las librerías base

Set base recomendado para el repositorio:

```bash
composer require vlucas/phpdotenv monolog/monolog guzzlehttp/guzzle firebase/php-jwt nikic/fast-route respect/validation nesbot/carbon

composer require --dev phpunit/phpunit phpstan/phpstan squizlabs/php_codesniffer filp/whoops
```

Las demás se agregan cuando se necesiten:

```bash
composer require phpmailer/phpmailer
composer require phpoffice/phpspreadsheet
composer require dompdf/dompdf
composer require ramsey/uuid
```

Verificar:

```bash
composer show
composer validate
```

## Ejemplos de uso

### Variables de entorno con phpdotenv

`.env` (no se sube a Git)

```
DB_HOST=localhost
DB_NAME=mi_base
DB_USER=root
DB_PASS=secreto
```

```php
<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo $_ENV['DB_HOST'];
```

### Logs con Monolog

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('app');
$log->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::WARNING));

$log->warning('Intento de login fallido', ['email' => 'ana@mail.cl']);
```

### Fechas con Carbon

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Carbon\Carbon;

echo Carbon::now('America/Santiago')->format('d-m-Y H:i');
echo Carbon::parse('2026-12-25')->diffForHumans();
```

### Consumir una API con Guzzle

```php
<?php
require __DIR__ . '/vendor/autoload.php';

$client = new GuzzleHttp\Client(['timeout' => 5]);
$res    = $client->get('https://jsonplaceholder.typicode.com/users/1');

$usuario = json_decode((string)$res->getBody(), true);
echo $usuario['name'];
```

## Scripts de calidad de código

Agrega esta sección a `composer.json`:

```json
"scripts": {
    "test": "phpunit",
    "stan": "phpstan analyse src --level=5",
    "cs": "phpcs --standard=PSR12 src"
}
```

Uso:

```bash
composer test
composer stan
composer cs
```

## Buenas prácticas con Git

- **No subas `vendor/`.** Cualquiera lo regenera con `composer install`.
- **Sí sube `composer.json` y `composer.lock`** para que todos usen las mismas versiones.
- **Nunca subas `.env`** con credenciales; sube un `.env.example` de muestra.
- Usa `composer install` en producción y reserva `composer update` para actualizar a propósito.

`.gitignore`

```
/vendor/
.env
*.log
```

Primer commit:

```bash
git add composer.json composer.lock .gitignore .env.example src/ index.php
git commit -m "Agrega Composer y dependencias base"
```

## Problemas frecuentes

| Error | Causa y solución |
|---|---|
| `composer: command not found` | Composer no está en el PATH. Repite el `sudo mv composer.phar /usr/local/bin/composer`. |
| `Class "App\Saludo" not found` | Falta regenerar el autoload: `composer dump-autoload`. |
| `requires ext-mbstring` / `ext-xml` | Falta una extensión de PHP: `sudo apt install php-mbstring php-xml`. |
| `Your requirements could not be resolved` | La librería pide otra versión de PHP o de otra dependencia. Revisa `composer why-not vendor/paquete`. |
| `Permission denied` al instalar | No uses `sudo` con `composer require`; revisa los permisos de la carpeta del proyecto. |

## Qué se aprende en esta carpeta

- Instalar PHP y Composer en Ubuntu.
- Entender `composer.json`, `composer.lock` y `vendor/`.
- Instalar y quitar dependencias, de producción y de desarrollo.
- Usar autoload PSR-4 con namespaces propios.
- Aplicar librerías reales: variables de entorno, logs, fechas, HTTP y JWT.
- Dejar un repositorio limpio y reproducible.

## Siguiente paso

➡️ **14-proyectos**: aplicar todo lo aprendido en proyectos completos.