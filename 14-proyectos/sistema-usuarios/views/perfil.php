<?php

use App\Auth;

$user = Auth::user();
?>
<div class="card narrow">
    <h1>Mi perfil</h1>

    <form method="post" action="/perfil" novalidate>
        <?= csrf_field() ?>

        <label>Email</label>
        <input type="email" value="<?= e($user['email']) ?>" disabled>

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= e($old['nombre']) ?>" required>
        <?= field_error($errors, 'nombre') ?>

        <h2 style="margin-top:1.5rem">Cambiar contraseña</h2>
        <p class="muted">Déjalo en blanco si no quieres cambiarla.</p>

        <label for="current_password">Contraseña actual</label>
        <input type="password" id="current_password" name="current_password" autocomplete="current-password">
        <?= field_error($errors, 'current_password') ?>

        <label for="new_password">Nueva contraseña</label>
        <input type="password" id="new_password" name="new_password" autocomplete="new-password">
        <?= field_error($errors, 'new_password') ?>

        <label for="new_password_confirm">Repite la nueva contraseña</label>
        <input type="password" id="new_password_confirm" name="new_password_confirm" autocomplete="new-password">
        <?= field_error($errors, 'new_password_confirm') ?>

        <p><button class="btn" type="submit">Guardar cambios</button></p>
    </form>
</div>
