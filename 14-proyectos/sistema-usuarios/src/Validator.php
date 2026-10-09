<?php
declare(strict_types=1);

namespace App;

/** Cada método devuelve un mensaje de error o null si el valor es válido. */
final class Validator
{
    public static function nombre(string $value): ?string
    {
        $length = mb_strlen($value);

        return ($length < 2 || $length > 100)
            ? 'El nombre debe tener entre 2 y 100 caracteres.'
            : null;
    }

    public static function email(string $value): ?string
    {
        return (!filter_var($value, FILTER_VALIDATE_EMAIL) || mb_strlen($value) > 150)
            ? 'Ingresa un email válido.'
            : null;
    }

    public static function password(string $value): ?string
    {
        if (strlen($value) < 8) {
            return 'La contraseña debe tener al menos 8 caracteres.';
        }
        if (strlen($value) > 72) {
            return 'La contraseña no puede superar los 72 caracteres.';
        }
        if (!preg_match('/[A-Za-z]/', $value) || !preg_match('/\d/', $value)) {
            return 'La contraseña debe incluir letras y números.';
        }

        return null;
    }

    public static function rol(string $value): ?string
    {
        return in_array($value, ['admin', 'usuario'], true) ? null : 'El rol no es válido.';
    }
}
