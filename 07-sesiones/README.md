# PHP Projects

Repositorio de ejercicios de **PHP vanilla** (sin frameworks), organizado por temas, para practicar desde los fundamentos hasta proyectos completos.

Cada archivo está comentado en español: al inicio explica qué se aprenderá y el código se divide en secciones numeradas.

## Requisitos

- PHP 8.3 o superior
- Git

Verifica tu versión de PHP:

```bash
php -v
```

## Cómo ejecutar los ejercicios

Clona el repositorio e inicia el servidor integrado de PHP:

```bash
git clone https://github.com/jose-analista/php-projects.git
cd php-projects
php -S localhost:8000
```

Luego abre el archivo que quieras en el navegador, por ejemplo:

```
http://localhost:8000/06-formularios/formulario.php
```

Para ejecutar un archivo directamente en la terminal (los que no usan HTML):

```bash
php 01-fundamentos/archivo.php
```

## Estructura

| Carpeta | Tema |
|---|---|
| `01-fundamentos` | Sintaxis, variables, tipos de datos y operadores |
| `02-control-flujo` | `if`, `switch`, `for`, `while`, `foreach` |
| `03-funciones` | Funciones, parámetros, retornos y tipado |
| `04-arrays` | Arrays indexados y asociativos, funciones de arrays |
| `05-strings` | Manipulación de texto y expresiones regulares |
| `06-formularios` | `GET`, `POST`, validación y sanitización de datos |
| `07-sesiones` | Sesiones, cookies y login |
| `08-poo` | Clases, objetos, herencia e interfaces |
| `09-excepciones` | `try`, `catch`, `finally` y excepciones propias |
| `10-bases-datos` | Conexión a bases de datos con PDO |
| `11-crud` | Crear, leer, actualizar y eliminar registros |
| `12-api-rest` | Creación de una API REST con respuestas JSON |
| `13-composer` | Dependencias y autoload con Composer |
| `14-proyectos` | Proyectos finales que integran todo lo anterior |

## Contenido destacado

### 06-formularios

- `formulario.php`: formulario completo con inputs, select, radio, checkbox y textarea.
- `procesar.php`: procesamiento de los datos enviados por el formulario.
- `validacion.php`: funciones de validación reutilizables.

### 07-sesiones

- `login.php`: login con validación y `password_verify()`.

## Buenas prácticas aplicadas

- Escapar toda salida con `htmlspecialchars()`
- Validar y limpiar los datos recibidos antes de usarlos
- Guardar contraseñas con `password_hash()` y verificarlas con `password_verify()`
- Mensajes de error genéricos en el login
- Funciones pequeñas con tipos de retorno

## Autor

**José Calderón** — Analista Programador

- GitHub: [jose-analista](https://github.com/jose-analista)