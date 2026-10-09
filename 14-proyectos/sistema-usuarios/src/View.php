<?php
declare(strict_types=1);

namespace App;

final class View
{
    private const VIEWS = __DIR__ . '/../views';

    /** Renderiza views/{$view}.php dentro de views/layout.php */
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        ob_start();
        require self::VIEWS . '/' . $view . '.php';
        $content = ob_get_clean();

        require self::VIEWS . '/layout.php';
    }
}
