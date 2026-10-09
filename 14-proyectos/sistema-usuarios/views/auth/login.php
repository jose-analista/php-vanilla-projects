<div class="card narrow">
    <h1>Iniciar sesión</h1>

    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-error"><?= e($errors['general']) ?></div>
    <?php endif; ?>

    <form method="post" action="/login" novalidate>
        <?= csrf_field() ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" autocomplete="email" required autofocus>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" autocomplete="current-password" required>

        <p><button class="btn" type="submit">Entrar</button></p>
    </form>

    <p class="muted">¿No tienes cuenta? <a href="/registro">Regístrate</a></p>
</div>
