<?php

/*
|--------------------------------------------------------------------------
| 05 - Operador Match
|--------------------------------------------------------------------------
| match está disponible desde PHP 8.
|
| A diferencia de switch:
| - match devuelve un valor.
| - Utiliza comparación estricta (===).
| - No necesita break.
| - Puede utilizar múltiples condiciones.
| - Debe tener un caso que coincida o un default.
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. MATCH BÁSICO
// -------------------------------------------------------------------------

$opcion = 2;

$mensaje = match ($opcion) {

    1 => "Crear usuario",
    2 => "Editar usuario",
    3 => "Eliminar usuario",
    default => "Opción no válida"

};

echo $mensaje . PHP_EOL;


// -------------------------------------------------------------------------
// 2. MATCH CON STRINGS
// -------------------------------------------------------------------------

$rol = "admin";

$permisos = match ($rol) {

    "admin" => "Acceso completo",
    "editor" => "Puede editar contenido",
    "usuario" => "Acceso estándar",
    default => "Rol no reconocido"

};

echo "Permisos: " . $permisos . PHP_EOL;


// -------------------------------------------------------------------------
// 3. COMPARACIÓN ESTRICTA
// -------------------------------------------------------------------------

$valor = 1;

$resultado = match ($valor) {

    1 => "El valor es un integer",
    "1" => "El valor es un string",
    true => "El valor es boolean",
    default => "Otro tipo de dato"

};

echo $resultado . PHP_EOL;


// -------------------------------------------------------------------------
// 4. MATCH CON CÓDIGOS HTTP
// -------------------------------------------------------------------------

$codigo = 200;

$estado = match ($codigo) {

    200 => "OK",
    201 => "Creado",
    400 => "Solicitud incorrecta",
    401 => "No autorizado",
    403 => "Acceso prohibido",
    404 => "Recurso no encontrado",
    500 => "Error interno del servidor",
    default => "Código desconocido"

};

echo "Estado HTTP: " . $estado . PHP_EOL;


// -------------------------------------------------------------------------
// 5. MÚLTIPLES VALORES
// -------------------------------------------------------------------------
// Puedes asociar varios valores al mismo resultado.

$dia = "sábado";

$tipoDia = match ($dia) {

    "lunes",
    "martes",
    "miércoles",
    "jueves",
    "viernes" => "Día laboral",

    "sábado",
    "domingo" => "Fin de semana",

    default => "Día no válido"

};

echo $tipoDia . PHP_EOL;


// -------------------------------------------------------------------------
// 6. MATCH CON EXPRESIONES
// -------------------------------------------------------------------------

$edad = 25;

$categoria = match (true) {

    $edad < 13 => "Niño",
    $edad < 18 => "Adolescente",
    $edad < 65 => "Adulto",
    default => "Adulto mayor"

};

echo "Categoría: " . $categoria . PHP_EOL;


// -------------------------------------------------------------------------
// 7. MATCH CON OPERADORES
// -------------------------------------------------------------------------

$nota = 6.2;

$resultado = match (true) {

    $nota >= 6.0 => "Excelente",
    $nota >= 4.0 => "Aprobado",
    default => "Reprobado"

};

echo "Resultado: " . $resultado . PHP_EOL;


// -------------------------------------------------------------------------
// 8. MATCH CON ESTADOS
// -------------------------------------------------------------------------

$estadoPedido = "enviado";

$mensajePedido = match ($estadoPedido) {

    "pendiente" => "El pedido está pendiente.",
    "pagado" => "El pedido fue pagado.",
    "preparando" => "El pedido está siendo preparado.",
    "enviado" => "El pedido fue enviado.",
    "entregado" => "El pedido fue entregado.",
    "cancelado" => "El pedido fue cancelado.",
    default => "Estado desconocido."

};

echo $mensajePedido . PHP_EOL;


// -------------------------------------------------------------------------
// 9. MATCH DENTRO DE UNA FUNCIÓN
// -------------------------------------------------------------------------

function obtenerRol(string $rol): string
{
    return match ($rol) {

        "admin" => "Administrador",
        "editor" => "Editor",
        "usuario" => "Usuario",
        default => "Invitado"

    };
}

echo obtenerRol("admin") . PHP_EOL;
echo obtenerRol("editor") . PHP_EOL;
echo obtenerRol("usuario") . PHP_EOL;
echo obtenerRol("otro") . PHP_EOL;


// -------------------------------------------------------------------------
// 10. MATCH CON DATOS INGRESADOS
// -------------------------------------------------------------------------

$opcionUsuario = readline(
    "Selecciona una opción (1-3): "
);

$opcionUsuario = (int) $opcionUsuario;

$respuesta = match ($opcionUsuario) {

    1 => "Has seleccionado Clientes.",
    2 => "Has seleccionado Proyectos.",
    3 => "Has seleccionado Ventas.",
    default => "Opción no válida."

};

echo $respuesta . PHP_EOL;


// -------------------------------------------------------------------------
// 11. MATCH CON ARRAY
// -------------------------------------------------------------------------

$usuario = [
    "nombre" => "José",
    "rol" => "admin"
];

$mensajeUsuario = match ($usuario["rol"]) {

    "admin" => "El usuario tiene acceso administrativo.",
    "editor" => "El usuario puede editar contenido.",
    "usuario" => "El usuario tiene acceso estándar.",
    default => "El usuario no tiene permisos."

};

echo $mensajeUsuario . PHP_EOL;


// -------------------------------------------------------------------------
// 12. MATCH VS SWITCH
// -------------------------------------------------------------------------

$rol = "admin";

// SWITCH:
//
// switch ($rol) {
//     case "admin":
//         $mensaje = "Administrador";
//         break;
//
//     case "editor":
//         $mensaje = "Editor";
//         break;
//
//     default:
//         $mensaje = "Usuario";
// }


// Con MATCH:

$mensaje = match ($rol) {

    "admin" => "Administrador",
    "editor" => "Editor",
    default => "Usuario"

};

echo "Resultado con match: " . $mensaje . PHP_EOL;


// -------------------------------------------------------------------------
// 13. EJEMPLO PRÁCTICO: MÉTODO HTTP
// -------------------------------------------------------------------------

$metodo = "POST";

$accion = match ($metodo) {

    "GET" => "Obtener información",
    "POST" => "Crear información",
    "PUT" => "Actualizar información",
    "PATCH" => "Modificar parcialmente",
    "DELETE" => "Eliminar información",
    default => "Método no permitido"

};

echo "Acción: " . $accion . PHP_EOL;


// -------------------------------------------------------------------------
// 14. EJEMPLO PRÁCTICO: RESPUESTA DE UNA API
// -------------------------------------------------------------------------

$codigoRespuesta = 404;

$respuestaApi = match ($codigoRespuesta) {

    200 => [
        "success" => true,
        "message" => "Solicitud exitosa"
    ],

    201 => [
        "success" => true,
        "message" => "Recurso creado"
    ],

    400 => [
        "success" => false,
        "message" => "Solicitud incorrecta"
    ],

    401 => [
        "success" => false,
        "message" => "No autorizado"
    ],

    404 => [
        "success" => false,
        "message" => "Recurso no encontrado"
    ],

    default => [
        "success" => false,
        "message" => "Error desconocido"
    ]

};

print_r($respuestaApi);