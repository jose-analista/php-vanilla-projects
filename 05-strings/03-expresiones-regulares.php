<?php

/*
|--------------------------------------------------------------------------
| 03 - Expresiones regulares
|--------------------------------------------------------------------------
| Las expresiones regulares permiten buscar y validar patrones de texto.
|
| En PHP utilizamos principalmente:
|
| - preg_match()
| - preg_match_all()
| - preg_replace()
| - preg_split()
|
| Conceptos importantes:
|
| ^       Inicio del texto
| $       Final del texto
| .       Cualquier carácter
| \d      Dígito
| \D      No dígito
| \w      Letra, número o _
| \s      Espacio
| +       Uno o más
| *       Cero o más
| ?       Cero o uno
| {n}     Exactamente n veces
| {n,m}   Entre n y m veces
| []      Conjunto de caracteres
| ()      Grupo
| |       O
|
|--------------------------------------------------------------------------
*/


// 1. Buscar una palabra

$texto = "Estoy aprendiendo PHP.";

if (preg_match("/PHP/", $texto)) {

    echo "PHP fue encontrado."
        . PHP_EOL;
}


// 2. Buscar ignorando mayúsculas/minúsculas
/*
|--------------------------------------------------------------------------
| La letra "i" al final hace que la búsqueda ignore mayúsculas.
|--------------------------------------------------------------------------
*/

$texto = "Estoy aprendiendo php.";

if (preg_match("/php/i", $texto)) {

    echo "PHP fue encontrado."
        . PHP_EOL;
}


// 3. Buscar un número

$texto = "Mi edad es 25 años.";

if (preg_match("/25/", $texto)) {

    echo "El número 25 existe."
        . PHP_EOL;
}


// 4. Buscar cualquier número

$texto = "Mi edad es 25 años.";

if (preg_match("/\d+/", $texto)) {

    echo "El texto contiene un número."
        . PHP_EOL;
}


// 5. Obtener el número encontrado

$texto = "Mi edad es 25 años.";

preg_match(
    "/\d+/",
    $texto,
    $resultado
);

echo "Número encontrado: "
    . $resultado[0]
    . PHP_EOL;


// 6. Buscar varios números

$texto = "Productos: 10, 25 y 50 unidades.";

preg_match_all(
    "/\d+/",
    $texto,
    $resultados
);

echo PHP_EOL;
echo "NÚMEROS ENCONTRADOS"
    . PHP_EOL;

print_r($resultados[0]);


// 7. Buscar palabras específicas

$texto = "PHP Laravel MySQL";

if (
    preg_match(
        "/Laravel/",
        $texto
    )
) {

    echo "Laravel encontrado."
        . PHP_EOL;
}


// 8. Buscar PHP o Python
/*
|--------------------------------------------------------------------------
| El operador | significa "o".
|--------------------------------------------------------------------------
*/

$texto = "Estoy aprendiendo Python.";

if (
    preg_match(
        "/PHP|Python/",
        $texto
    )
) {

    echo "PHP o Python encontrado."
        . PHP_EOL;
}


// 9. Buscar palabras al inicio
/*
|--------------------------------------------------------------------------
| ^ representa el inicio.
|--------------------------------------------------------------------------
*/

$texto = "PHP es un lenguaje backend.";

if (
    preg_match(
        "/^PHP/",
        $texto
    )
) {

    echo "El texto comienza con PHP."
        . PHP_EOL;
}


// 10. Buscar palabras al final
/*
|--------------------------------------------------------------------------
| $ representa el final.
|--------------------------------------------------------------------------
*/

$archivo = "documento.pdf";

if (
    preg_match(
        "/\.pdf$/",
        $archivo
    )
) {

    echo "El archivo es PDF."
        . PHP_EOL;
}


// 11. Validar solamente números

$codigo = "12345";

if (
    preg_match(
        "/^\d+$/",
        $codigo
    )
) {

    echo "El código contiene solamente números."
        . PHP_EOL;
}


// 12. Validar solamente letras

$nombre = "Jose";

if (
    preg_match(
        "/^[a-zA-Z]+$/",
        $nombre
    )
) {

    echo "El nombre contiene solamente letras."
        . PHP_EOL;
}


// 13. Validar letras y espacios

$nombre = "Jose Calderon";

if (
    preg_match(
        "/^[a-zA-Z ]+$/",
        $nombre
    )
) {

    echo "Nombre válido."
        . PHP_EOL;
}


// 14. Validar letras, números y guion bajo

$usuario = "jose_25";

if (
    preg_match(
        "/^[a-zA-Z0-9_]+$/",
        $usuario
    )
) {

    echo "Usuario válido."
        . PHP_EOL;
}


// 15. Validar longitud

$usuario = "jose123";

if (
    preg_match(
        "/^[a-zA-Z0-9_]{4,20}$/",
        $usuario
    )
) {

    echo "Usuario válido."
        . PHP_EOL;
}


// 16. Validar código de 6 dígitos

$codigo = "123456";

if (
    preg_match(
        "/^\d{6}$/",
        $codigo
    )
) {

    echo "Código válido."
        . PHP_EOL;
}


// 17. Validar teléfono chileno básico
/*
|--------------------------------------------------------------------------
| Ejemplo:
|
| +56912345678
|
| El patrón permite:
|
| +56
| 9
| 8 dígitos
|--------------------------------------------------------------------------
*/

$telefono = "+56912345678";

if (
    preg_match(
        "/^\+569\d{8}$/",
        $telefono
    )
) {

    echo "Teléfono válido."
        . PHP_EOL;
}


// 18. Validar email

$email = "jose@gmail.com";

if (
    preg_match(
        "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
        $email
    )
) {

    echo "Email válido."
        . PHP_EOL;
}


// 19. Validar URL

$url = "https://www.ejemplo.com";

if (
    preg_match(
        "/^https?:\/\/.+$/",
        $url
    )
) {

    echo "URL válida."
        . PHP_EOL;
}


// 20. Validar extensión de archivo

$archivo = "imagen.jpg";

if (
    preg_match(
        "/\.(jpg|jpeg|png|gif)$/i",
        $archivo
    )
) {

    echo "Imagen válida."
        . PHP_EOL;
}


// 21. Obtener extensión

$archivo = "documento.pdf";

preg_match(
    "/\.([a-zA-Z0-9]+)$/",
    $archivo,
    $resultado
);

if (!empty($resultado)) {

    echo "Extensión: "
        . $resultado[1]
        . PHP_EOL;
}


// 22. Obtener todos los emails

$texto = "
Contactos:
jose@gmail.com
ana@gmail.com
pedro@hotmail.com
";

preg_match_all(
    "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/",
    $texto,
    $emails
);

echo PHP_EOL;
echo "EMAILS ENCONTRADOS"
    . PHP_EOL;

print_r($emails[0]);


// 23. Obtener todos los números

$texto = "Notebook $500000, Mouse $15000, Teclado $30000.";

preg_match_all(
    "/\d+/",
    $texto,
    $numeros
);

echo PHP_EOL;
echo "NÚMEROS"
    . PHP_EOL;

print_r($numeros[0]);


// 24. Obtener palabras

$texto = "PHP Laravel MySQL";

preg_match_all(
    "/[a-zA-Z]+/",
    $texto,
    $palabras
);

echo PHP_EOL;
echo "PALABRAS"
    . PHP_EOL;

print_r($palabras[0]);


// 25. preg_replace()
/*
|--------------------------------------------------------------------------
| Permite reemplazar patrones.
|--------------------------------------------------------------------------
*/

$texto = "Mi teléfono es 912345678.";

$texto = preg_replace(
    "/\d/",
    "*",
    $texto
);

echo $texto . PHP_EOL;


// 26. Eliminar números

$texto = "Producto123";

$texto = preg_replace(
    "/\d+/",
    "",
    $texto
);

echo $texto . PHP_EOL;


// 27. Eliminar caracteres especiales

$texto = "Hola!!! ¿Cómo estás?";

$texto = preg_replace(
    "/[^a-zA-Z0-9\s]/",
    "",
    $texto
);

echo $texto . PHP_EOL;


// 28. Limpiar espacios múltiples

$texto = "PHP     Laravel       MySQL";

$texto = preg_replace(
    "/\s+/",
    " ",
    $texto
);

echo $texto . PHP_EOL;


// 29. Limpiar texto

$texto = "   PHP     Laravel!!!   ";

$texto = trim($texto);

$texto = preg_replace(
    "/\s+/",
    " ",
    $texto
);

echo $texto . PHP_EOL;


// 30. preg_split()
/*
|--------------------------------------------------------------------------
| Divide un texto utilizando una expresión regular.
|--------------------------------------------------------------------------
*/

$texto = "PHP, Laravel; MySQL | Docker";

$partes = preg_split(
    "/[,;|]/",
    $texto
);

print_r($partes);


// 31. preg_split() eliminando espacios

$texto = "PHP, Laravel; MySQL | Docker";

$partes = preg_split(
    "/\s*[,;|]\s*/",
    $texto
);

echo PHP_EOL;
echo "TECNOLOGÍAS"
    . PHP_EOL;

print_r($partes);


// 32. Validar contraseña básica

$password = "Abc12345";

if (
    preg_match(
        "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
        $password
    )
) {

    echo "Contraseña válida."
        . PHP_EOL;
}


// 33. Contraseña con mayúscula y número

$password = "Jose1234";

if (
    preg_match(
        "/^(?=.*[A-Z])(?=.*\d).{8,}$/",
        $password
    )
) {

    echo "La contraseña cumple los requisitos."
        . PHP_EOL;
}


// 34. Detectar palabras prohibidas

$mensaje = "Este comentario contiene spam.";

$palabrasProhibidas = [
    "spam",
    "fraude",
    "estafa"
];

$patron = implode(
    "|",
    $palabrasProhibidas
);

if (
    preg_match(
        "/" . $patron . "/i",
        $mensaje
    )
) {

    echo "Se detectó una palabra prohibida."
        . PHP_EOL;
}


// 35. Reemplazar palabras prohibidas

$mensaje = "Este mensaje contiene spam.";

$mensaje = preg_replace(
    "/spam/i",
    "***",
    $mensaje
);

echo $mensaje . PHP_EOL;


// 36. Validar código de producto

$codigoProducto = "PROD-12345";

if (
    preg_match(
        "/^PROD-\d{5}$/",
        $codigoProducto
    )
) {

    echo "Código de producto válido."
        . PHP_EOL;
}


// 37. Validar código de cliente

$codigoCliente = "CLI-001";

if (
    preg_match(
        "/^CLI-\d{3}$/",
        $codigoCliente
    )
) {

    echo "Código de cliente válido."
        . PHP_EOL;
}


// 38. Extraer códigos de productos

$texto = "
Productos:
PROD-12345
PROD-54321
PROD-98765
";

preg_match_all(
    "/PROD-\d{5}/",
    $texto,
    $productos
);

echo PHP_EOL;
echo "CÓDIGOS ENCONTRADOS"
    . PHP_EOL;

print_r($productos[0]);


// 39. Extraer hashtags

$texto = "Aprendiendo #PHP #Laravel #Backend";

preg_match_all(
    "/#[a-zA-Z0-9_]+/",
    $texto,
    $hashtags
);

echo PHP_EOL;
echo "HASHTAGS"
    . PHP_EOL;

print_r($hashtags[0]);


// 40. Extraer menciones

$texto = "Hola @jose y @ana";

preg_match_all(
    "/@[a-zA-Z0-9_]+/",
    $texto,
    $menciones
);

echo PHP_EOL;
echo "MENCIONES"
    . PHP_EOL;

print_r($menciones[0]);


// 41. Validar fecha básica

$fecha = "2026-10-07";

if (
    preg_match(
        "/^\d{4}-\d{2}-\d{2}$/",
        $fecha
    )
) {

    echo "Formato de fecha válido."
        . PHP_EOL;
}


// 42. Validar hora básica

$hora = "19:30";

if (
    preg_match(
        "/^\d{2}:\d{2}$/",
        $hora
    )
) {

    echo "Formato de hora válido."
        . PHP_EOL;
}


// 43. Normalizar un nombre de usuario

$usuario = "  Jose_Calderon123  ";

$usuario = trim($usuario);

$usuario = preg_replace(
    "/[^a-zA-Z0-9_]/",
    "",
    $usuario
);

echo "Usuario limpio: "
    . $usuario
    . PHP_EOL;


// 44. Generar slug más limpio

$titulo = "Sistema Web PHP - Proyecto 2026";

$slug = strtolower(
    trim($titulo)
);

$slug = preg_replace(
    "/[^a-z0-9]+/",
    "-",
    $slug
);

$slug = trim(
    $slug,
    "-"
);

echo "Slug: "
    . $slug
    . PHP_EOL;


// 45. Función para validar email

function validarEmail(string $email): bool
{
    return preg_match(
        "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
        $email
    ) === 1;
}

$email = "usuario@gmail.com";

if (validarEmail($email)) {

    echo "Email válido."
        . PHP_EOL;
}


// 46. Función para validar usuario

function validarUsuario(string $usuario): bool
{
    return preg_match(
        "/^[a-zA-Z0-9_]{4,20}$/",
        $usuario
    ) === 1;
}

$usuario = "jose_25";

if (validarUsuario($usuario)) {

    echo "Usuario válido."
        . PHP_EOL;
}


// 47. Función para limpiar texto

function limpiarTexto(string $texto): string
{
    $texto = trim($texto);

    $texto = preg_replace(
        "/\s+/",
        " ",
        $texto
    );

    return $texto;
}

$texto = "   PHP     Laravel     MySQL   ";

echo limpiarTexto($texto)
    . PHP_EOL;


// 48. Ejemplo práctico: formulario

$nombre = "   José Calderón   ";
$email = " jose@gmail.com ";
$telefono = " +56912345678 ";
$usuario = " jose_25 ";

$nombre = limpiarTexto($nombre);
$email = limpiarTexto($email);
$telefono = limpiarTexto($telefono);
$usuario = limpiarTexto($usuario);

echo PHP_EOL;
echo "VALIDACIÓN DEL FORMULARIO"
    . PHP_EOL;
echo "-------------------------"
    . PHP_EOL;

echo "Nombre: "
    . $nombre
    . PHP_EOL;

if (validarEmail($email)) {

    echo "Email: válido"
        . PHP_EOL;

} else {

    echo "Email: inválido"
        . PHP_EOL;
}

if (validarUsuario($usuario)) {

    echo "Usuario: válido"
        . PHP_EOL;

} else {

    echo "Usuario: inválido"
        . PHP_EOL;
}

if (
    preg_match(
        "/^\+569\d{8}$/",
        $telefono
    )
) {

    echo "Teléfono: válido"
        . PHP_EOL;

} else {

    echo "Teléfono: inválido"
        . PHP_EOL;
}


// 49. Ejemplo práctico: extraer información de un texto

$texto = "
Cliente: José
Email: jose@gmail.com
Teléfono: +56912345678
Código: CLI-001
";

preg_match(
    "/Email:\s*([^\s]+)/",
    $texto,
    $emailEncontrado
);

preg_match(
    "/Teléfono:\s*(\+569\d{8})/",
    $texto,
    $telefonoEncontrado
);

preg_match(
    "/Código:\s*(CLI-\d{3})/",
    $texto,
    $codigoEncontrado
);

echo PHP_EOL;
echo "DATOS EXTRAÍDOS"
    . PHP_EOL;
echo "---------------"
    . PHP_EOL;

echo "Email: "
    . ($emailEncontrado[1] ?? "No encontrado")
    . PHP_EOL;

echo "Teléfono: "
    . ($telefonoEncontrado[1] ?? "No encontrado")
    . PHP_EOL;

echo "Código: "
    . ($codigoEncontrado[1] ?? "No encontrado")
    . PHP_EOL;


// 50. Ejemplo final: análisis de una descripción

$descripcion = "
Desarrollo de sistema web con PHP y Laravel.
Base de datos MySQL.
API REST.
Contacto: desarrollo@gmail.com
";

preg_match_all(
    "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/",
    $descripcion,
    $emails
);

preg_match_all(
    "/PHP|Laravel|MySQL|API REST/i",
    $descripcion,
    $tecnologias
);

echo PHP_EOL;
echo "ANÁLISIS"
    . PHP_EOL;
echo "--------"
    . PHP_EOL;

echo "Emails encontrados:"
    . PHP_EOL;

print_r($emails[0]);

echo "Tecnologías encontradas:"
    . PHP_EOL;

print_r($tecnologias[0]);