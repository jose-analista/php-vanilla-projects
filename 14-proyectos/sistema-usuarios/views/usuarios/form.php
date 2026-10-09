<?php $editing = $usuario !== null; ?>
<div class="card narrow">
    <h1><?= $editing ? 'Editar usuario' : 'Nuevo usuario' ?></h1>

    <form method="post" action="<?= e($action) ?>" novalidate>
        <?= csrf_field() ?>

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= e($old['nombre']) ?>" required autofocus>
        <?= field_error($errors, 'nombre') ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" required>
        <?= field_error($errors, 'email') ?>

        <label for="password">Contraseña<?= $editing ? ' (opcional)' : '' ?></label>
        <input type="password" id="password" name="password" autocomplete="new-password" <?= $editing ? '' : 'required' ?>>
        <?= field_error($errors, 'password') ?>
        <small class="muted"><?= $editing ? 'Déjala en blanco para no cambiarla. ' : '' ?>Mínimo 8 caracteres, con letras y números.</small>

        <label for="rol">Rol</label>
        <select id="rol" name="rol">
            <option value="usuario" <?= $old['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
            <option value="admin" <?= $old['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
        </select>
        <?= field_error($errors, 'rol') ?>

        <label class="check">
            <input type="checkbox" name="activo" value="1" <?= !empty($old['activo']) ? 'checked' : '' ?>>
            Cuenta activa
        </label>

        <p>
            <button class="btn" type="submit"><?= $editing ? 'Guardar cambios' : 'Crear usuario' ?></button>
            <a class="btn btn-secondary" href="/usuarios">Cancelar</a>
        </p>
    </form>
</div>
