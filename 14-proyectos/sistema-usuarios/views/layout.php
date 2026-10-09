<?php

use App\Auth;
use App\Config;
use App\Flash;

$appName = Config::get('APP_NAME', 'Sistema de Usuarios');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? $appName) ?> · <?= e($appName) ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="/"><?= e($appName) ?></a>
    <nav>
        <?php if (Auth::check()): ?>
            <a href="/dashboard">Dashboard</a>
            <?php if (Auth::isAdmin()): ?>
                <a href="/usuarios">Usuarios</a>
            <?php endif; ?>
            <a href="/perfil">Mi perfil</a>
            <form method="post" action="/logout">
                <?= csrf_field() ?>
                <button type="submit" class="link-btn">Salir</button>
            </form>
        <?php else: ?>
            <a href="/login">Iniciar sesión</a>
            <a href="/registro">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>

<main class="container">
    <?php foreach (Flash::pull() as $flash): ?>
        <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
    <?php endforeach; ?>

    <?= $content ?>
</main>

<footer>&copy; <?= date('Y') ?> <?= e($appName) ?></footer>
</body>
</html>
