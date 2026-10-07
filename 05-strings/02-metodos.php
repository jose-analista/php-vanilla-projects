<?php

/*
|--------------------------------------------------------------------------
| 02 - Métodos y funciones para Strings
|--------------------------------------------------------------------------
| En PHP los strings se manipulan principalmente mediante funciones.
|
| En este archivo practicaremos:
|
| - strlen()
| - strtoupper()
| - strtolower()
| - ucfirst()
| - lcfirst()
| - ucwords()
| - trim()
| - ltrim()
| - rtrim()
| - str_replace()
| - str_ireplace()
| - strpos()
| - stripos()
| - strrpos()
| - substr()
| - substr_replace()
| - str_contains()
| - str_starts_with()
| - str_ends_with()
| - explode()
| - implode()
| - str_repeat()
| - str_pad()
| - strrev()
| - strcmp()
| - strcasecmp()
| - sprintf()
| - number_format()
|--------------------------------------------------------------------------
*/


// 1. strlen()
// Obtiene la cantidad de caracteres.

$texto = "Hola mundo";

echo "Longitud: "
    . strlen($texto)
    . PHP_EOL;


// 2. strtoupper()
// Convierte el texto a mayúsculas.

$texto = "hola mundo";

echo strtoupper($texto)
    . PHP_EOL;


// 3. strtolower()
// Convierte el texto a minúsculas.

$texto = "HOLA MUNDO";

echo strtolower($texto)
    . PHP_EOL;


// 4. ucfirst()
// Convierte la primera letra a mayúscula.

$texto = "php";

echo ucfirst($texto)
    . PHP_EOL;


// 5. lcfirst()
// Convierte la primera letra a minúscula.

$texto = "PHP";

echo lcfirst($texto)
    . PHP_EOL;


// 6. ucwords()
// Convierte la primera letra de cada palabra.

$texto = "analista programador php";

echo ucwords($texto)
    . PHP_EOL;


// 7. trim()
// Elimina espacios al principio y al final.

$nombre = "   José   ";

$nombre = trim($nombre);

echo "[" . $nombre . "]"
    . PHP_EOL;


// 8. ltrim()
// Elimina espacios del lado izquierdo.

$texto = "   Hola";

echo "[" . ltrim($texto) . "]"
    . PHP_EOL;


// 9. rtrim()
// Elimina espacios del lado derecho.

$texto = "Hola   ";

echo "[" . rtrim($texto) . "]"
    . PHP_EOL;


// 10. str_replace()
// Reemplaza un texto.

$texto = "Estoy aprendiendo JavaScript.";

$texto = str_replace(
    "JavaScript",
    "PHP",
    $texto
);

echo $texto . PHP_EOL;


// 11. Reemplazar varios valores

$texto = "PHP Python JavaScript";

$texto = str_replace(
    ["PHP", "Python", "JavaScript"],
    ["Laravel", "Django", "React"],
    $texto
);

echo $texto . PHP_EOL;


// 12. str_ireplace()
// Igual que str_replace(), pero ignora mayúsculas/minúsculas.

$texto = "Estoy aprendiendo PHP.";

$texto = str_ireplace(
    "php",
    "Laravel",
    $texto
);

echo $texto . PHP_EOL;


// 13. strpos()
// Busca la posición de un texto.

$texto = "Estoy aprendiendo PHP.";

$posicion = strpos(
    $texto,
    "PHP"
);

if ($posicion !== false) {

    echo "PHP encontrado en posición: "
        . $posicion
        . PHP_EOL;
}


// 14. stripos()
// Busca ignorando mayúsculas/minúsculas.

$texto = "Estoy aprendiendo PHP.";

$posicion = stripos(
    $texto,
    "php"
);

if ($posicion !== false) {

    echo "PHP encontrado."
        . PHP_EOL;
}


// 15. strrpos()
// Busca la última aparición.

$texto = "PHP es backend. PHP también se utiliza con Laravel.";

$posicion = strrpos(
    $texto,
    "PHP"
);

echo "Última posición de PHP: "
    . $posicion
    . PHP_EOL;


// 16. substr()
// Extrae una parte del texto.

$texto = "Analista Programador";

$parte = substr(
    $texto,
    0,
    8
);

echo $parte . PHP_EOL;


// 17. substr() desde una posición

$texto = "Analista Programador";

echo substr(
    $texto,
    9
) . PHP_EOL;


// 18. substr() desde el final

$archivo = "documento.pdf";

$extension = substr(
    $archivo,
    -3
);

echo "Extensión: "
    . $extension
    . PHP_EOL;


// 19. substr_replace()
// Reemplaza una parte específica.

$texto = "Hola mundo";

$texto = substr_replace(
    $texto,
    "PHP",
    5,
    5
);

echo $texto . PHP_EOL;


// 20. str_contains()
// Verifica si contiene determinado texto.

$texto = "PHP es un lenguaje backend.";

if (str_contains($texto, "backend")) {

    echo "El texto contiene backend."
        . PHP_EOL;
}


// 21. str_starts_with()
// Verifica cómo comienza el texto.

$url = "https://ejemplo.com";

if (str_starts_with($url, "https://")) {

    echo "La URL utiliza HTTPS."
        . PHP_EOL;
}


// 22. str_ends_with()
// Verifica cómo termina.

$archivo = "foto.jpg";

if (str_ends_with($archivo, ".jpg")) {

    echo "Es una imagen JPG."
        . PHP_EOL;
}


// 23. explode()
// Divide un string y genera un array.

$lenguajes = "PHP,Python,JavaScript";

$array = explode(
    ",",
    $lenguajes
);

print_r($array);


// 24. explode() con espacios

$nombreCompleto = "José Calderón Cayunao";

$nombres = explode(
    " ",
    $nombreCompleto
);

print_r($nombres);


// 25. implode()
// Convierte un array en string.

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


// 26. str_repeat()
// Repite un texto.

echo str_repeat(
    "-",
    30
) . PHP_EOL;


// 27. str_pad()
// Completa un string.

$codigo = "25";

echo str_pad(
    $codigo,
    5,
    "0",
    STR_PAD_LEFT
) . PHP_EOL;


// 28. strrev()
// Invierte un string.

$texto = "PHP";

echo strrev($texto)
    . PHP_EOL;


// 29. strcmp()
// Compara dos strings.

$a = "PHP";
$b = "PHP";

$resultado = strcmp(
    $a,
    $b
);

if ($resultado === 0) {

    echo "Los textos son iguales."
        . PHP_EOL;
}


// 30. Comparar strings diferentes

$a = "PHP";
$b = "Python";

$resultado = strcmp(
    $a,
    $b
);

if ($resultado !== 0) {

    echo "Los textos son diferentes."
        . PHP_EOL;
}


// 31. strcasecmp()
// Compara ignorando mayúsculas/minúsculas.

$a = "PHP";
$b = "php";

if (
    strcasecmp($a, $b) === 0
) {

    echo "Los textos son iguales."
        . PHP_EOL;
}


// 32. sprintf()
// Construye strings con variables.

$nombre = "José";
$profesion = "Analista Programador";

$mensaje = sprintf(
    "Hola, soy %s y soy %s.",
    $nombre,
    $profesion
);

echo $mensaje . PHP_EOL;


// 33. sprintf() con números

$producto = "Notebook";
$precio = 500000;

$mensaje = sprintf(
    "Producto: %s | Precio: $%d",
    $producto,
    $precio
);

echo $mensaje . PHP_EOL;


// 34. number_format()
// Formatea números.

$precio = 1250000;

$precioFormateado = number_format(
    $precio,
    0,
    ",",
    "."
);

echo "Precio: $"
    . $precioFormateado
    . PHP_EOL;


// 35. Normalizar texto

$texto = "   HOLA MUNDO   ";

$texto = trim($texto);
$texto = strtolower($texto);
$texto = ucfirst($texto);

echo $texto . PHP_EOL;


// 36. Crear un slug

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


// 37. Limpiar múltiples espacios

$texto = "PHP     Laravel      MySQL";

$texto = preg_replace(
    "/\s+/",
    " ",
    trim($texto)
);

echo $texto . PHP_EOL;


// 38. Extraer usuario y dominio

$email = "jose@gmail.com";

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


// 39. Validar dominio

$email = "jose@gmail.com";

if (str_ends_with($email, "@gmail.com")) {

    echo "El correo pertenece a Gmail."
        . PHP_EOL;
}


// 40. Validar búsqueda

$busqueda = "   PHP   ";

$busqueda = trim(
    strtolower($busqueda)
);

if ($busqueda !== "") {

    echo "Buscando: "
        . $busqueda
        . PHP_EOL;
}


// 41. Buscar una palabra

$descripcion = "Desarrollo de sistemas web con PHP y Laravel.";

if (str_contains($descripcion, "Laravel")) {

    echo "La descripción contiene Laravel."
        . PHP_EOL;
}


// 42. Extraer extensión de archivo

$archivo = "sistema-laravel.zip";

$posicion = strrpos(
    $archivo,
    "."
);

$extension = substr(
    $archivo,
    $posicion + 1
);

echo "Extensión: "
    . $extension
    . PHP_EOL;


// 43. Extraer nombre de archivo

$archivo = "sistema-laravel.zip";

$posicion = strrpos(
    $archivo,
    "."
);

$nombreArchivo = substr(
    $archivo,
    0,
    $posicion
);

echo "Nombre: "
    . $nombreArchivo
    . PHP_EOL;


// 44. Generar código de usuario

$nombre = "José";

$codigo = strtoupper(
    substr($nombre, 0, 3)
);

$codigo .= "001";

echo "Código: "
    . $codigo
    . PHP_EOL;


// 45. Procesar nombre de usuario

$nombre = "   jose calderon   ";

$nombre = trim($nombre);
$nombre = strtolower($nombre);
$nombre = ucwords($nombre);

echo "Nombre procesado: "
    . $nombre
    . PHP_EOL;


// 46. Procesar formulario

$nombre = "   José   ";
$email = " JOSE@GMAIL.COM ";
$ciudad = " santiago ";

$nombre = trim($nombre);
$email = strtolower(trim($email));
$ciudad = ucwords(
    strtolower(trim($ciudad))
);

echo PHP_EOL;
echo "FORMULARIO PROCESADO"
    . PHP_EOL;
echo "--------------------"
    . PHP_EOL;

echo "Nombre: "
    . $nombre
    . PHP_EOL;

echo "Email: "
    . $email
    . PHP_EOL;

echo "Ciudad: "
    . $ciudad
    . PHP_EOL;


// 47. Crear resumen de proyecto

$cliente = "Empresa A";
$proyecto = "Sistema CRM";
$estado = "En desarrollo";

$resumen = sprintf(
    "Cliente: %s | Proyecto: %s | Estado: %s",
    $cliente,
    $proyecto,
    $estado
);

echo PHP_EOL;
echo $resumen . PHP_EOL;


// 48. Construir una lista de tecnologías

$tecnologias = [
    "PHP",
    "Laravel",
    "MySQL",
    "Git",
    "Docker"
];

echo PHP_EOL;
echo "Tecnologías: "
    . implode(", ", $tecnologias)
    . PHP_EOL;


// 49. Buscar tecnología

$tecnologiaBuscada = "Laravel";

if (
    in_array(
        $tecnologiaBuscada,
        $tecnologias,
        true
    )
) {

    echo "Tecnología encontrada: "
        . $tecnologiaBuscada
        . PHP_EOL;
}


// 50. Ejemplo práctico final
/*
|--------------------------------------------------------------------------
| Procesamiento de un producto
|--------------------------------------------------------------------------
*/

$producto = [
    "nombre" => "   notebook lenovo   ",
    "categoria" => " tecnologia ",
    "precio" => 850000
];

$nombreProducto = trim(
    $producto["nombre"]
);

$nombreProducto = ucwords(
    strtolower($nombreProducto)
);

$categoria = trim(
    $producto["categoria"]
);

$categoria = ucfirst(
    strtolower($categoria)
);

$precio = number_format(
    $producto["precio"],
    0,
    ",",
    "."
);

echo PHP_EOL;
echo "PRODUCTO"
    . PHP_EOL;
echo "--------"
    . PHP_EOL;

echo "Nombre: "
    . $nombreProducto
    . PHP_EOL;

echo "Categoría: "
    . $categoria
    . PHP_EOL;

echo "Precio: $"
    . $precio
    . PHP_EOL;