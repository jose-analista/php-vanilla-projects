<?php
declare(strict_types=1);

/** Escapa texto para imprimirlo de forma segura en HTML. */
function e(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Campo oculto con el token CSRF para los formularios. */
function csrf_field(): string
{
    return App\Csrf::field();
}

/** Mensaje de error de un campo de formulario (o cadena vacía). */
function field_error(array $errors, string $key): string
{
    return isset($errors[$key])
        ? '<div class="field-error">' . e($errors[$key]) . '</div>'
        : '';
}
