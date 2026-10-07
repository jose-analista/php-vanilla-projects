## 📝 Formularios

Los ejercicios de formularios están en la carpeta `06-formularios/` y muestran el flujo completo: enviar datos, validarlos y procesarlos.

| Archivo | Descripción |
|---------|-------------|
| `formulario.php` | Formulario HTML que envía los datos por `POST` |
| `validacion.php` | Validación y limpieza de los datos recibidos |
| `procesar.php` | Procesamiento y visualización de los datos validados |

### ▶️ Cómo ejecutarlo

1. Desde la raíz del repositorio, iniciar el servidor integrado:

```bash
   php -S localhost:8000
```

2. Abrir en el navegador:

```text
   http://localhost:8000/06-formularios/formulario.php
```

3. Completar el formulario y enviarlo. Los datos se procesan en `procesar.php`.

### 💡 Conceptos que se practican

* Envío de datos con `POST`
* Variable superglobal `$_POST`
* Validación de campos vacíos, formato de correo y longitud
* Sanitización con `htmlspecialchars()` y `filter_var()`
* Mensajes de error en el formulario