# PHP Projects

Repositorio de ejercicios y proyectos prácticos desarrollados con **PHP**, orientados al aprendizaje progresivo de programación backend, desarrollo web y construcción de aplicaciones conectadas a bases de datos.

Este repositorio reúne desde los fundamentos del lenguaje hasta proyectos prácticos que aplican conceptos utilizados en el desarrollo de software, incluyendo gestión de usuarios, clientes y ventas.

## 🛠️ Tecnologías

- **PHP:** lógica de programación y desarrollo backend.
- **MySQL / MariaDB:** almacenamiento y gestión de datos.
- **HTML5:** estructura de páginas web.
- **CSS3:** diseño y presentación de interfaces.
- **JavaScript:** interactividad en el navegador.
- **PDO / MySQLi:** acceso a bases de datos.
- **Composer:** gestión de dependencias.
- **Git / GitHub:** control de versiones y publicación de proyectos.
- **HTTP / JSON:** comunicación e intercambio de datos mediante APIs REST.

## 📚 Contenido del repositorio

El contenido está organizado por módulos para facilitar el aprendizaje y la consulta del código.

| Directorio | Descripción |
|---|---|
| `01-fundamentos/` | Sintaxis, variables, tipos de datos y operadores. |
| `02-control-flujo/` | Condicionales, estructuras de decisión y bucles. |
| `03-funciones/` | Declaración de funciones, parámetros, retornos y reutilización de código. |
| `04-arrays/` | Arrays indexados, asociativos y multidimensionales. |
| `05-strings/` | Manipulación de cadenas, búsqueda y transformación de texto. |
| `06-formularios/` | Formularios HTML, recepción de datos y validación. |
| `07-sesiones/` | Manejo de sesiones y persistencia temporal de información. |
| `08-poo/` | Programación Orientada a Objetos, clases, objetos, herencia y encapsulamiento. |
| `09-excepciones/` | Manejo de errores mediante excepciones y bloques `try/catch`. |
| `10-bases-datos/` | Conexión, consultas y operaciones con bases de datos. |
| `11-crud/` | Operaciones para crear, consultar, actualizar y eliminar registros. |
| `12-api-rest/` | Desarrollo e integración de servicios web y respuestas JSON. |
| `13-composer/` | Gestión de dependencias y organización del código PHP. |
| `14-proyectos/` | Aplicación práctica de los conocimientos mediante proyectos completos. |

## 🚀 Proyectos prácticos

Dentro de `14-proyectos/` se encuentran proyectos que permiten aplicar los conceptos estudiados en escenarios similares a los de una aplicación real.

### API de clientes — `api-clientes/`

Proyecto orientado a la gestión de clientes mediante una API.

Conceptos que se pueden trabajar:

- Recepción y procesamiento de solicitudes HTTP.
- Intercambio de información en formato JSON.
- Operaciones CRUD.
- Validación de datos.
- Conexión con bases de datos.
- Separación de responsabilidades entre componentes.

### Sistema de usuarios — `sistema-usuarios/`

Proyecto orientado a la administración de usuarios en una aplicación web.

Conceptos que se pueden trabajar:

- Registro e inicio de sesión.
- Validación de formularios.
- Manejo de sesiones.
- Gestión de usuarios.
- Seguridad en el tratamiento de contraseñas.
- Acceso a recursos según la autenticación.

### Sistema de ventas — `sistema-ventas/`

Proyecto orientado a la gestión de operaciones comerciales mediante una aplicación web.

Conceptos que se pueden trabajar:

- Administración de productos.
- Registro de ventas.
- Gestión de clientes.
- Persistencia de información.
- Consultas y reportes.
- Operaciones CRUD.
- Integración entre la lógica de negocio y la base de datos.

> Los módulos y funcionalidades específicas de cada proyecto dependen de su implementación actual.

## 💻 Requisitos

Para ejecutar los ejercicios y proyectos se recomienda disponer de:

- PHP 8.x o una versión compatible con el proyecto.
- Composer.
- Git.
- MySQL o MariaDB para los proyectos que utilizan bases de datos.
- Un navegador web.
- Un editor de código, como Visual Studio Code.

## 📥 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/jose-analista/php-projects.git
```

### 2. Acceder al directorio

```bash
cd php-projects
```

### 3. Verificar la instalación de PHP

```bash
php -v
```

### 4. Verificar Composer

```bash
composer --version
```

### 5. Verificar Git

```bash
git --version
```

## ▶️ Ejecución

### Ejecutar un archivo PHP

Desde la terminal, ingresar al directorio correspondiente y ejecutar el archivo deseado:

```bash
php archivo.php
```

### Ejecutar una aplicación web

Desde el directorio que contiene el archivo de entrada de la aplicación:

```bash
php -S localhost:8000
```

Abrir el siguiente enlace en el navegador:

http://localhost:8000

**Importante:** algunos proyectos requieren configuración adicional, como una base de datos, variables de entorno o dependencias instaladas con Composer. Consultar las instrucciones de cada proyecto antes de ejecutarlo.

## 🗄️ Bases de datos

Los proyectos que necesitan persistencia de datos pueden utilizar MySQL o MariaDB.

Para conectarse a una base de datos desde PHP se recomienda PDO, ya que permite utilizar consultas preparadas y gestionar errores mediante excepciones.

Ejemplo básico de conexión:

```php
<?php

$host = 'localhost';
$dbname = 'mi_base_datos';
$username = 'usuario';
$password = 'contraseña';

try {
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

    echo 'Conexión exitosa';

} catch (PDOException $e) {
    error_log($e->getMessage());
    echo 'No fue posible conectar con la base de datos.';
}
```

Este ejemplo es únicamente demostrativo. En aplicaciones reales, las credenciales deben mantenerse fuera del código público y no deben exponerse los detalles internos de los errores a los usuarios.

## 🔐 Buenas prácticas

Durante el desarrollo de los ejercicios y proyectos se busca reforzar las siguientes prácticas:

- Validar los datos recibidos desde formularios y solicitudes HTTP.
- Utilizar consultas preparadas para reducir el riesgo de inyección SQL.
- Aplicar `password_hash()` y `password_verify()` para las contraseñas.
- Escapar los datos antes de mostrarlos en HTML cuando corresponda.
- Gestionar errores y excepciones de forma controlada.
- Separar la lógica de negocio del acceso a datos cuando sea apropiado.
- Evitar publicar contraseñas, claves API y credenciales.
- Utilizar Git para registrar los cambios y mantener un historial del desarrollo.
- Documentar los requisitos necesarios para ejecutar cada proyecto.

## 🎯 Objetivos de aprendizaje

Este repositorio busca fortalecer y demostrar conocimientos en:

- Fundamentos y lógica de programación.
- Desarrollo backend con PHP.
- Programación Orientada a Objetos.
- Manipulación y validación de datos.
- Formularios y sesiones.
- Conexión y operaciones con bases de datos.
- Desarrollo de aplicaciones CRUD.
- Creación e integración de APIs REST.
- Gestión de dependencias con Composer.
- Organización, mantenimiento y documentación del código.
- Aplicación de buenas prácticas de desarrollo de software.

## 🗺️ Ruta de aprendizaje

La estructura del repositorio permite avanzar progresivamente:

1. **Fundamentos:** comprender la sintaxis, los tipos de datos y las estructuras de control.
2. **Programación modular:** desarrollar funciones y trabajar con arrays y cadenas.
3. **Desarrollo web:** procesar formularios y administrar sesiones.
4. **Programación Orientada a Objetos:** organizar el código mediante clases y objetos.
5. **Persistencia de datos:** conectar PHP con bases de datos y desarrollar operaciones CRUD.
6. **Servicios web:** crear APIs REST e intercambiar información mediante JSON.
7. **Herramientas profesionales:** utilizar Composer y Git.
8. **Proyectos integradores:** aplicar los conocimientos en sistemas de usuarios, clientes y ventas.

## 👨‍💻 Perfil profesional

**Analista Programador | Desarrollo de Software**

Este repositorio forma parte de mi portafolio técnico y refleja mi aprendizaje continuo en PHP y desarrollo backend. Su objetivo es demostrar conocimientos mediante ejercicios organizados, código práctico y proyectos que permiten explorar la construcción de aplicaciones web y sistemas de gestión.

## 📌 Próximas mejoras

- Ampliar las pruebas y validaciones de los ejercicios.
- Incorporar documentación individual en los proyectos.
- Fortalecer la arquitectura y separación de responsabilidades.
- Implementar pruebas automatizadas.
- Mejorar el manejo de errores y registros de actividad.
- Profundizar en seguridad web y autenticación.
- Desarrollar nuevos proyectos con PHP, MySQL y Composer.
- Explorar Laravel para la construcción de aplicaciones web más completas.

---

**Autor:** José Calderón  
**Rol:** Analista Programador  
**Repositorio:** [php-projects](https://github.com/jose-analista/php-projects)
