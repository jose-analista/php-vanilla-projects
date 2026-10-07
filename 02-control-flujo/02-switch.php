<?php

/*
|--------------------------------------------------------------------------
| 02 - Switch
|--------------------------------------------------------------------------
| switch permite ejecutar diferentes bloques de código dependiendo
| del valor de una variable.
|
| También veremos:
| - case
| - break
| - default
| - múltiples cases
| - switch con strings
| - switch con números
| - match (PHP 8+)
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. SWITCH BÁSICO
// -------------------------------------------------------------------------

$dia = 2;

switch ($dia) {

    case 1:
        echo "Lunes" . PHP_EOL;
        break;

    case 2:
        echo "Martes" . PHP_EOL;
        break;

    case 3:
        echo "Miércoles" . PHP_EOL;
        break;

    default:
        echo "Día no válido." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 2. SWITCH CON STRINGS
// -------------------------------------------------------------------------

$rol = "admin";

switch ($rol) {

    case "admin":
        echo "Acceso completo." . PHP_EOL;
        break;

    case "editor":
        echo "Acceso de edición." . PHP_EOL;
        break;

    case "usuario":
        echo "Acceso estándar." . PHP_EOL;
        break;

    default:
        echo "Rol no reconocido." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 3. MÚLTIPLES CASES
// -------------------------------------------------------------------------

$dia = "sábado";

switch ($dia) {

    case "lunes":
    case "martes":
    case "miércoles":
    case "jueves":
    case "viernes":
        echo "Es un día laboral." . PHP_EOL;
        break;

    case "sábado":
    case "domingo":
        echo "Es fin de semana." . PHP_EOL;
        break;

    default:
        echo "Día no válido." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 4. SWITCH CON NÚMEROS
// -------------------------------------------------------------------------

$opcion = 3;

switch ($opcion) {

    case 1:
        echo "Crear usuario." . PHP_EOL;
        break;

    case 2:
        echo "Editar usuario." . PHP_EOL;
        break;

    case 3:
        echo "Eliminar usuario." . PHP_EOL;
        break;

    case 4:
        echo "Mostrar usuarios." . PHP_EOL;
        break;

    default:
        echo "Opción no válida." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 5. SWITCH CON MENÚ
// -------------------------------------------------------------------------

$opcion = 2;

echo PHP_EOL . "Menú del sistema:" . PHP_EOL;
echo "1. Clientes" . PHP_EOL;
echo "2. Proyectos" . PHP_EOL;
echo "3. Ventas" . PHP_EOL;
echo "4. Configuración" . PHP_EOL;

switch ($opcion) {

    case 1:
        echo "Has seleccionado Clientes." . PHP_EOL;
        break;

    case 2:
        echo "Has seleccionado Proyectos." . PHP_EOL;
        break;

    case 3:
        echo "Has seleccionado Ventas." . PHP_EOL;
        break;

    case 4:
        echo "Has seleccionado Configuración." . PHP_EOL;
        break;

    default:
        echo "Opción incorrecta." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 6. DEFAULT
// -------------------------------------------------------------------------

$estado = "desconocido";

switch ($estado) {

    case "activo":
        echo "El usuario está activo." . PHP_EOL;
        break;

    case "inactivo":
        echo "El usuario está inactivo." . PHP_EOL;
        break;

    case "bloqueado":
        echo "El usuario está bloqueado." . PHP_EOL;
        break;

    default:
        echo "Estado desconocido." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 7. SWITCH CON ENTRADA DEL USUARIO
// -------------------------------------------------------------------------

$opcionUsuario = readline(
    "Selecciona una opción (1-3): "
);

$opcionUsuario = (int) $opcionUsuario;

switch ($opcionUsuario) {

    case 1:
        echo "Has seleccionado PHP." . PHP_EOL;
        break;

    case 2:
        echo "Has seleccionado Python." . PHP_EOL;
        break;

    case 3:
        echo "Has seleccionado JavaScript." . PHP_EOL;
        break;

    default:
        echo "Opción no válida." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 8. SWITCH CON EXPRESIONES
// -------------------------------------------------------------------------

$edad = 25;

switch (true) {

    case $edad < 13:
        echo "Niño." . PHP_EOL;
        break;

    case $edad < 18:
        echo "Adolescente." . PHP_EOL;
        break;

    case $edad < 65:
        echo "Adulto." . PHP_EOL;
        break;

    default:
        echo "Adulto mayor." . PHP_EOL;
}


// -------------------------------------------------------------------------
// 9. MATCH
// -------------------------------------------------------------------------
// match está disponible desde PHP 8.
// A diferencia de switch, match devuelve un valor y utiliza
// comparación estricta.

$rol = "admin";

$mensaje = match ($rol) {

    "admin" => "Administrador",
    "editor" => "Editor",
    "usuario" => "Usuario",
    default => "Rol desconocido"

};

echo "Rol: " . $mensaje . PHP_EOL;


// -------------------------------------------------------------------------
// 10. MATCH CON NÚMEROS
// -------------------------------------------------------------------------

$codigo = 200;

$estadoHttp = match ($codigo) {

    200 => "OK",
    201 => "Creado",
    400 => "Solicitud incorrecta",
    401 => "No autorizado",
    403 => "Prohibido",
    404 => "No encontrado",
    500 => "Error del servidor",
    default => "Código desconocido"

};

echo "Estado HTTP: " . $estadoHttp . PHP_EOL;


// -------------------------------------------------------------------------
// 11. SWITCH VS IF
// -------------------------------------------------------------------------
// switch es conveniente cuando evaluamos una misma variable
// contra diferentes valores.
//
// if / elseif es más flexible cuando trabajamos con rangos
// o condiciones complejas.

$opcion = "clientes";

switch ($opcion) {

    case "clientes":
        echo "Módulo de clientes." . PHP_EOL;
        break;

    case "ventas":
        echo "Módulo de ventas." . PHP_EOL;
        break;

    case "proyectos":
        echo "Módulo de proyectos." . PHP_EOL;
        break;

    default:
        echo "Módulo no encontrado." . PHP_EOL;
}