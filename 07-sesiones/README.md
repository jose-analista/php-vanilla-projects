# 07 - Sesiones

Ejercicios de **sesiones en PHP**: cómo mantener datos del usuario entre páginas y cómo construir un flujo básico de inicio y cierre de sesión.

## Contenido

- [Archivos](#archivos)
- [Qué se aprende](#qué-se-aprende)
- [Cómo ejecutar](#cómo-ejecutar)
- [Cuenta de prueba](#cuenta-de-prueba)
- [Qué es una sesión](#qué-es-una-sesión)
- [Cómo funcionan por dentro](#cómo-funcionan-por-dentro)
- [Funciones principales](#funciones-principales)
- [Flujo del login](#flujo-del-login)
- [Proteger una página](#proteger-una-página)
- [Seguridad y buenas prácticas](#seguridad-y-buenas-prácticas)
- [Sesiones vs cookies](#sesiones-vs-cookies)
- [Limitaciones](#limitaciones)

## Archivos

| Archivo | Descripción |
|---|---|
| `session.php` | Manejo básico de sesiones: contador de visitas, guardar y borrar datos en `$_SESSION` |
| `login.php` | Formulario de login con validación y `password_verify()` |
| `logout.php` | Cierre de sesión: limpia los datos, borra la cookie y destruye la sesión |

## Qué se aprende

- Iniciar una sesión con `session_start()`
- Guardar y leer datos con `$_SESSION`
- Validar un formulario de login
- Verificar contraseñas con `password_hash()` y `password_verify()`
- Mostrar mensajes de error genéricos para no revelar qué dato falló
- Cerrar sesión con `session_unset()` y `session_destroy()`
- Proteger páginas privadas

## Cómo ejecutar

Desde la raíz del repositorio:

```bash
php -S localhost:8000
```

Luego abre en el navegador:

```
http://localhost:8000/07-sesiones/login.php
http://localhost:8000/07-sesiones/session.php
```

## Cuenta de prueba

| Campo | Valor |
|---|---|
| Email | `jose@email.com` |
| Contraseña | `Clave1234` |

> Es un usuario de ejemplo definido en el código. En un proyecto real los usuarios se guardan en una base de datos (ver `10-bases-datos`).

## Qué es una sesión

HTTP no tiene memoria: cada petición llega al servidor como si fuera la primera. Si inicias sesión en `login.php` y luego abres otra página, el servidor no sabe por sí solo que eres la misma persona.

Las sesiones resuelven eso: permiten **guardar datos del usuario en el servidor** y recordarlos entre páginas.

## Cómo funcionan por dentro

1. **El navegador pide una página** y el código llama a `session_start()`.
2. **PHP crea una sesión nueva**: genera un ID aleatorio y crea en el servidor un archivo temporal asociado a ese ID. Ahí vivirá `$_SESSION`.
3. **PHP envía el ID al navegador en una cookie** llamada `PHPSESSID`.
4. **En cada petición siguiente** el navegador devuelve esa cookie. `session_start()` la lee, encuentra el archivo y carga los datos en `$_SESSION`.

Los datos viven en el servidor y el navegador solo guarda el ID. Por eso se pueden guardar ahí cosas como el usuario logueado, pero también por eso hay que proteger el ID.

## Funciones principales

| Función | Qué hace |
|---|---|
| `session_start()` | Crea la sesión o recupera la existente. Siempre antes de cualquier HTML |
| `$_SESSION` | Array donde guardas y lees datos: `$_SESSION["nombre"] = "José";` |
| `isset($_SESSION["x"])` | Comprueba si un dato existe |
| `unset($_SESSION["x"])` | Borra un solo dato |
| `session_id()` | Devuelve el ID de la sesión actual |
| `session_regenerate_id(true)` | Cambia el ID por uno nuevo, descartando el viejo |
| `session_unset()` | Vacía todos los datos de `$_SESSION` |
| `session_destroy()` | Destruye la sesión en el servidor |

## Flujo del login

1. El usuario entra a `login.php` e ingresa su email y contraseña.
2. Se validan los datos y se verifican las credenciales.
3. Si son correctas, se regenera el ID de sesión y se guarda el usuario en `$_SESSION`:

   ```php
   session_regenerate_id(true);

   $_SESSION["usuario"] = $email;
   ```

4. El usuario cierra sesión desde `logout.php`, que ejecuta tres pasos:
   - Vacía los datos de `$_SESSION`
   - Borra la cookie de sesión del navegador
   - Destruye la sesión en el servidor

   Los tres son necesarios: con solo `session_destroy()` la cookie vieja seguiría en el navegador.

## Proteger una página

Cualquier página privada empieza así:

```php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
```

Si no hay usuario en la sesión, se redirige al login. Esa es la base de todo sistema de acceso.

## Seguridad y buenas prácticas

- **Llamar a `session_start()` antes de cualquier salida HTML.** La cookie viaja en las cabeceras HTTP y no se pueden enviar después de que ya salió contenido; si no, aparece el error *headers already sent*.
- **Regenerar el ID al iniciar sesión** con `session_regenerate_id(true)`. Evita la fijación de sesión, un ataque donde alguien le da a la víctima un ID que él ya conoce y entra con él cuando ella inicia sesión.
- **Destruir la sesión por completo al cerrar sesión.** Si quedan la cookie o los datos, la sesión podría reutilizarse.
- **Guardar poco en `$_SESSION`.** Un identificador o el email, nunca la contraseña ni datos sensibles.
- **Escapar toda salida** con `htmlspecialchars()`.
- **No devolver nunca la contraseña** al navegador.
- **Usar mensajes de error genéricos** en el login ("Email o contraseña incorrectos").

## Sesiones vs cookies

| | Cookie | Sesión |
|---|---|---|
| Dónde se guardan los datos | En el navegador | En el servidor |
| Quién puede verlos o modificarlos | El usuario | Solo el servidor |
| Qué viaja al navegador | Los datos completos | Solo el ID de sesión |
| Uso típico | Preferencias sin riesgo (tema claro u oscuro) | Autenticación y datos del usuario |

## Limitaciones

Por defecto PHP guarda las sesiones en archivos temporales y caducan tras un tiempo de inactividad (la limpieza suele ser a los 24 minutos, según la configuración). En proyectos más grandes se guardan en base de datos o en Redis.

## Autor

**José Calderón** — Analista Programador

- GitHub: [jose-analista](https://github.com/jose-analista)