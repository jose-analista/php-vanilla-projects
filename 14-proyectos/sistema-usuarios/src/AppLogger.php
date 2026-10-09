<?php
declare(strict_types=1);

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

final class AppLogger
{
    private static ?Logger $logger = null;

    public static function get(): Logger
    {
        if (self::$logger === null) {
            self::$logger = new Logger('sistema-usuarios');
            self::$logger->pushHandler(
                new StreamHandler(dirname(__DIR__) . '/logs/app.log', Level::Info)
            );
        }

        return self::$logger;
    }
}
