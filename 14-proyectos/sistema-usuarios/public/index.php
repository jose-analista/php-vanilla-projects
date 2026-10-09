<?php
declare(strict_types=1);

use App\AppLogger;
use App\Config;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ProfileController;
use App\Controllers\UserController;
use App\Http;
use App\Router;
use App\Session;

require dirname(__DIR__) . '/vendor/autoload.php';

Config::load(dirname(__DIR__));
date_default_timezone_set(Config::get('APP_TIMEZONE', 'America/Santiago'));

// Cabeceras de seguridad básicas
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: same-origin');

Session::start();

$router = new Router();

// Públicas
$router->get('/', [DashboardController::class, 'home']);
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/registro', [AuthController::class, 'showRegister']);
$router->post('/registro', [AuthController::class, 'register']);
$router->post('/logout', [AuthController::class, 'logout']);

// Usuario autenticado
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/perfil', [ProfileController::class, 'show']);
$router->post('/perfil', [ProfileController::class, 'update']);

// Administración de usuarios (solo admin)
$router->get('/usuarios', [UserController::class, 'index']);
$router->get('/usuarios/crear', [UserController::class, 'create']);
$router->post('/usuarios', [UserController::class, 'store']);
$router->get('/usuarios/{id}/editar', [UserController::class, 'edit']);
$router->post('/usuarios/{id}/editar', [UserController::class, 'update']);
$router->post('/usuarios/{id}/eliminar', [UserController::class, 'destroy']);

try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (Throwable $e) {
    AppLogger::get()->error($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
    Http::abort(500, Config::debug() ? $e->getMessage() : 'Ocurrió un error interno. Inténtalo más tarde.');
}
