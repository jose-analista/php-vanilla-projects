<?php
declare(strict_types=1);

namespace App;

use Dotenv\Dotenv;

final class Config
{
    /** Carga el archivo .env (si no existe, no falla). */
    public static function load(string $directory): void
    {
        Dotenv::createImmutable($directory)->safeLoad();
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return $_ENV[$key] ?? $default;
    }

    public static function debug(): bool
    {
        return filter_var(self::get('APP_DEBUG', 'false'), FILTER_VALIDATE_BOOLEAN);
    }
}
