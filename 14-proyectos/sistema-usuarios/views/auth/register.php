<div class="card narrow">
    <h1>Crear cuenta</h1>

    <form method="post" action="/registro" novalidate>
        <?= csrf_field() ?>

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= e($old['nombre']) ?>" autocomplete="name" required autofocus>
        <?= field_error($errors, 'nombre') ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" autocomplete="email" required>
        <?= field_error($errors, 'email') ?>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" autocomplete="new-password" required>
        <?= field_error($errors, 'password') ?>
        <small class="muted">Mínimo 8 caracteres, con letras y números.</small>

        <label for="password_confirm">Repite la contraseña</label>
        <input type="password" id="password_confirm" name="password_confirm" autocomplete="new-password" required>
        <?= field_error($errors, 'password_confirm') ?>

        <p><button class="btn" type="submit">Registrarme</button></p>
    </form>

    <p class="muted">¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
</div>
