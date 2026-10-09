<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Csrf;
use App\Http;

abstract class Controller
{
    /** Corta la petición si el token CSRF del formulario no es válido. */
    protected function verifyCsrf(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Http::abort(419, 'El formulario expiró. Recarga la página e inténtalo de nuevo.');
        }
    }

    protected function input(string $key, bool $trim = true): string
    {
        $value = $_POST[$key] ?? '';
        if (!is_string($value)) {
            return '';
        }

        return $trim ? trim($value) : $value;
    }
}
