<?php
declare(strict_types=1);

namespace App;

final class Http
{
    public static function redirect(string $path): never
    {
        header('Location: ' . $path);
        exit;
    }

    public static function abort(int $code, string $message): never
    {
        http_response_code($code);
        View::render('error', [
            'title'   => "Error $code",
            'code'    => $code,
            'message' => $message,
        ]);
        exit;
    }
}
