# 07 - Sesiones

Ejercicios de **sesiones en PHP**: cómo mantener datos del usuario entre páginas y cómo construir un flujo básico de inicio y cierre de sesión.

## Archivos

| Archivo | Descripción |
|---|---|
| `session.php` | Manejo básico de sesiones con `session_start()` y `$_SESSION` |
| `login.php` | Formulario de login con validación y `password_verify()` |
| `logout.php` | Cierre de sesión: limpia y destruye la sesión |

## Qué se aprende

- Iniciar una sesión con `session_start()`
- Guardar y leer datos con `$_SESSION`
- Validar un formulario de login
- Verificar contraseñas con `password_hash()` y `password_verify()`
- Mostrar mensajes de error genéricos para no revelar qué dato falló
- Cerrar sesión con `session_unset()` y `session_destroy()`

## Cómo ejecutar

Desde la raíz del repositorio:

```bash
php -S localhost:8000
```

Luego abre en el navegador:

```
http://localhost:8000/07-sesiones/login.php
```

## Cuenta de prueba

| Campo | Valor |
|---|---|
| Email | `jose@email.com` |
| Contraseña | `Clave1234` |

> Es un usuario de ejemplo definido en el código. En un proyecto real los usuarios se guardan en una base de datos (ver `10-bases-datos`).

## Flujo

1. El usuario entra a `login.php` e ingresa su email y contraseña.
2. Se validan los datos y se verifican las credenciales.
3. Si son correctas, se guarda la información del usuario en `$_SESSION`.
4. El usuario cierra sesión desde `logout.php`, que destruye la sesión.

## Buenas prácticas

- Llamar a `session_start()` antes de cualquier salida HTML
- Escapar toda salida con `htmlspecialchars()`
- No devolver nunca la contraseña al navegador
- Regenerar el ID de sesión al iniciar sesión con `session_regenerate_id(true)`
- Destruir la sesión por completo al cerrar sesión

## Autor

**José Calderón** — Analista Programador

- GitHub: [jose-analista](https://github.com/jose-analista)