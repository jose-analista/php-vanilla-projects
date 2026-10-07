<?php

/*
|--------------------------------------------------------------------------
| 01 - Strings
|--------------------------------------------------------------------------
| Los strings representan textos en PHP.
|
| En este archivo aprenderemos:
|
| - Crear strings
| - Concatenar textos
| - Interpolar variables
| - strlen()
| - strtolower()
| - strtoupper()
| - ucfirst()
| - ucwords()
| - trim()
| - ltrim()
| - rtrim()
| - str_replace()
| - str_contains()
| - str_starts_with()
| - str_ends_with()
| - strpos()
| - substr()
| - explode()
| - implode()
| - str_repeat()
| - str_pad()
| - sprintf()
| - number_format()
| - nl2br()
| - Strings multilínea
|--------------------------------------------------------------------------
*/


// 1. String básico

$nombre = "José";

echo $nombre . PHP_EOL;


// 2. String con comillas simples

$lenguaje = 'PHP';

echo $lenguaje . PHP_EOL;


// 3. String con comillas dobles

$mensaje = "Estoy aprendiendo PHP.";

echo $mensaje . PHP_EOL;


// 4. Concatenar strings

$nombre = "José";
$profesion = "Analista Programador";

echo $nombre . " - " . $profesion . PHP_EOL;


// 5. Concatenación con .=

$texto = "Hola";

$texto .= " José";
$texto .= ", estás aprendiendo PHP.";

echo $texto . PHP_EOL;


// 6. Interpolación de variables

$nombre = "José";
$edad = 25;

echo "Mi nombre es $nombre y tengo $edad años."
    . PHP_EOL;


// 7. Interpolación con llaves

$nombre = "José";

echo "Hola {$nombre}, bienvenido."
    . PHP_EOL;


// 8. Caracteres especiales

echo "Primera línea\nSegunda línea"
    . PHP_EOL;

echo "Nombre:\tJosé"
    . PHP_EOL;


// 9. Longitud de un string

$texto = "Analista Programador";

echo "Cantidad de caracteres: "
    . strlen($texto)
    . PHP_EOL;


// 10. Convertir a minúsculas

$texto = "PHP ES MUY UTIL";

echo strtolower($texto)
    . PHP_EOL;


// 11. Convertir a mayúsculas

$texto = "php es muy util";

echo strtoupper($texto)
    . PHP_EOL;


// 12. Primera letra en mayúscula

$nombre = "jose";

echo ucfirst($nombre)
    . PHP_EOL;


// 13. Primera letra de cada palabra

$nombreCompleto = "jose calderon cayunao";

echo ucwords($nombreCompleto)
    . PHP_EOL;


// 14. trim()
/*
|--------------------------------------------------------------------------
| trim() elimina espacios al principio y al final.
|--------------------------------------------------------------------------
*/

$nombre = "   José   ";

$nombre = trim($nombre);

echo "Nombre: [" . $nombre . "]"
    . PHP_EOL;


// 15. ltrim()

$texto = "   Hola";

echo "[" . ltrim($texto) . "]"
    . PHP_EOL;


// 16. rtrim()

$texto = "Hola   ";

echo "[" . rtrim($texto) . "]"
    . PHP_EOL;


// 17. Reemplazar texto

$mensaje = "Estoy aprendiendo JavaScript.";

$mensaje = str_replace(
    "JavaScript",
    "PHP",
    $mensaje
);

echo $mensaje . PHP_EOL;


// 18. Reemplazar varios elementos

$texto = "PHP, Python, JavaScript";

$texto = str_replace(
    ["PHP", "Python"],
    ["Laravel", "Django"],
    $texto
);

echo $texto . PHP_EOL;


// 19. str_contains()
/*
|--------------------------------------------------------------------------
| Verifica si un string contiene determinado texto.
|--------------------------------------------------------------------------
*/

$mensaje = "Bienvenido al sistema Caytech.";

if (str_contains($mensaje, "Caytech")) {

    echo "El mensaje contiene Caytech."
        . PHP_EOL;
}


// 20. str_starts_with()

$url = "https://caytech.cl";

if (str_starts_with($url, "https")) {

    echo "La URL utiliza HTTPS."
        . PHP_EOL;
}


// 21. str_ends_with()

$email = "usuario@gmail.com";

if (str_ends_with($email, "@gmail.com")) {

    echo "El correo es Gmail."
        . PHP_EOL;
}


// 22. strpos()
/*
|--------------------------------------------------------------------------
| strpos() devuelve la posición donde aparece un texto.
|--------------------------------------------------------------------------
*/

$texto = "Estoy aprendiendo PHP.";

$posicion = strpos(
    $texto,
    "PHP"
);

if ($posicion !== false) {

    echo "PHP comienza en la posición: "
        . $posicion
        . PHP_EOL;
}


// 23. Buscar una palabra que no existe

$posicion = strpos(
    $texto,
    "Python"
);

if ($posicion === false) {

    echo "Python no fue encontrado."
        . PHP_EOL;
}


// 24. substr()
/*
|--------------------------------------------------------------------------
| Extrae una parte del string.
|--------------------------------------------------------------------------
*/

$texto = "Analista Programador";

$parte = substr(
    $texto,
    0,
    8
);

echo "Parte del texto: "
    . $parte
    . PHP_EOL;


// 25. substr() desde una posición

$texto = "Programador";

echo substr(
    $texto,
    3
) . PHP_EOL;


// 26. substr() con posición negativa

$texto = "programador.php";

echo substr(
    $texto,
    -3
) . PHP_EOL;


// 27. explode()
/*
|--------------------------------------------------------------------------
| Convierte un string en un array.
|--------------------------------------------------------------------------
*/

$lenguajes = "PHP,Python,JavaScript,Java";

$arrayLenguajes = explode(
    ",",
    $lenguajes
);

print_r($arrayLenguajes);


// 28. explode() con espacios

$nombreCompleto = "José Calderón Cayunao";

$nombres = explode(
    " ",
    $nombreCompleto
);

print_r($nombres);


// 29. implode()
/*
|--------------------------------------------------------------------------
| Convierte un array en un string.
|--------------------------------------------------------------------------
*/

$tecnologias = [
    "PHP",
    "Laravel",
    "MySQL"
];

$texto = implode(
    ", ",
    $tecnologias
);

echo $texto . PHP_EOL;


// 30. explode + implode

$texto = "PHP,Laravel,MySQL";

$tecnologias = explode(
    ",",
    $texto
);

$textoFinal = implode(
    " | ",
    $tecnologias
);

echo $textoFinal . PHP_EOL;


// 31. str_repeat()

echo str_repeat(
    "=",
    30
) . PHP_EOL;


// 32. str_pad()
/*
|--------------------------------------------------------------------------
| Agrega caracteres hasta alcanzar una longitud determinada.
|--------------------------------------------------------------------------
*/

$numero = "25";

echo str_pad(
    $numero,
    5,
    "0",
    STR_PAD_LEFT
) . PHP_EOL;


// 33. str_pad() a la derecha

$nombre = "José";

echo str_pad(
    $nombre,
    10,
    ".",
    STR_PAD_RIGHT
) . PHP_EOL;


// 34. sprintf()
/*
|--------------------------------------------------------------------------
| Permite construir strings usando valores.
|--------------------------------------------------------------------------
*/

$nombre = "José";
$edad = 25;

$mensaje = sprintf(
    "Mi nombre es %s y tengo %d años.",
    $nombre,
    $edad
);

echo $mensaje . PHP_EOL;


// 35. sprintf() con precios

$producto = "Notebook";
$precio = 500000;

$mensaje = sprintf(
    "Producto: %s | Precio: $%d",
    $producto,
    $precio
);

echo $mensaje . PHP_EOL;


// 36. number_format()
/*
|--------------------------------------------------------------------------
| Formatea números para mostrarlos como texto.
|--------------------------------------------------------------------------
*/

$precio = 500000;

echo number_format(
    $precio,
    0,
    ",",
    "."
) . PHP_EOL;


// 37. Precio con formato

$precio = 1250000;

$precioFormateado = number_format(
    $precio,
    0,
    ",",
    "."
);

echo "Precio: $" . $precioFormateado
    . PHP_EOL;


// 38. String multilínea

$descripcion = <<<TEXTO
Este es un ejemplo de texto
multilínea utilizando PHP.
Podemos escribir varias líneas
dentro de un mismo string.
TEXTO;

echo $descripcion . PHP_EOL;


// 39. Validar string vacío

$nombre = "";

if ($nombre === "") {

    echo "El nombre está vacío."
        . PHP_EOL;
}


// 40. empty()

$nombre = "";

if (empty($nombre)) {

    echo "El nombre está vacío."
        . PHP_EOL;
}


// 41. String con espacios

$nombre = "   José   ";

$nombre = trim($nombre);

if ($nombre !== "") {

    echo "Nombre válido: "
        . $nombre
        . PHP_EOL;
}


// 42. Convertir entrada a minúsculas

$opcion = " PHP ";

$opcion = strtolower(
    trim($opcion)
);

if ($opcion === "php") {

    echo "Seleccionaste PHP."
        . PHP_EOL;
}


// 43. Normalizar un texto

$texto = "   HOLA MUNDO   ";

$texto = trim($texto);
$texto = strtolower($texto);
$texto = ucfirst($texto);

echo $texto . PHP_EOL;


// 44. Validar dominio de correo

$email = "usuario@gmail.com";

if (str_ends_with($email, "@gmail.com")) {

    echo "Correo Gmail válido."
        . PHP_EOL;
}


// 45. Extraer dominio de un correo

$email = "usuario@gmail.com";

$partes = explode(
    "@",
    $email
);

$usuario = $partes[0];
$dominio = $partes[1];

echo "Usuario: "
    . $usuario
    . PHP_EOL;

echo "Dominio: "
    . $dominio
    . PHP_EOL;


// 46. Extraer extensión de archivo

$archivo = "documento.pdf";

$partes = explode(
    ".",
    $archivo
);

$extension = end($partes);

echo "Extensión: "
    . $extension
    . PHP_EOL;


// 47. Buscar extensión

$archivo = "imagen.png";

if (str_ends_with($archivo, ".png")) {

    echo "Es una imagen PNG."
        . PHP_EOL;
}


// 48. Generar slug básico

$titulo = "Sistema de Gestión Empresarial";

$slug = strtolower(
    trim($titulo)
);

$slug = str_replace(
    " ",
    "-",
    $slug
);

echo "Slug: "
    . $slug
    . PHP_EOL;


// 49. Contar palabras

$descripcion = "Sistema web desarrollado con PHP y Laravel.";

$palabras = str_word_count(
    $descripcion
);

echo "Cantidad de palabras: "
    . $palabras
    . PHP_EOL;


// 50. Ejemplo práctico: limpiar formulario

$nombre = "   José Calderón   ";
$email = "  JOSE@GMAIL.COM  ";

$nombre = trim($nombre);
$email = strtolower(trim($email));

echo PHP_EOL;
echo "DATOS LIMPIOS"
    . PHP_EOL;
echo "-------------"
    . PHP_EOL;

echo "Nombre: "
    . $nombre
    . PHP_EOL;

echo "Email: "
    . $email
    . PHP_EOL;


// 51. Ejemplo práctico: validar búsqueda

$busqueda = "   php   ";

$busqueda = trim(
    strtolower($busqueda)
);

if ($busqueda !== "") {

    echo "Buscando: "
        . $busqueda
        . PHP_EOL;

} else {

    echo "La búsqueda está vacía."
        . PHP_EOL;
}


// 52. Ejemplo práctico: generar mensaje

$cliente = "Empresa A";
$proyecto = "Sistema CRM";
$estado = "En desarrollo";

$mensaje = sprintf(
    "Cliente: %s | Proyecto: %s | Estado: %s",
    $cliente,
    $proyecto,
    $estado
);

echo $mensaje . PHP_EOL;