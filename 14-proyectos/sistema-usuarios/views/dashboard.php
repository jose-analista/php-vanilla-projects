<?php

use App\Auth;

$user = Auth::user();
?>
<div class="card">
    <h1>Hola, <?= e($user['nombre']) ?></h1>
    <p class="muted">
        <?= e($user['email']) ?> ·
        <span class="badge badge-<?= e($user['rol']) ?>"><?= e($user['rol']) ?></span>
    </p>
    <p>Miembro desde el <?= e(date('d-m-Y', strtotime($user['creado_en']))) ?>.</p>
    <a class="btn btn-secondary" href="/perfil">Editar mi perfil</a>
</div>

<?php if ($stats !== null): ?>
    <div class="stats">
        <div class="stat"><strong><?= $stats['total'] ?></strong><span class="muted">Usuarios</span></div>
        <div class="stat"><strong><?= $stats['activos'] ?></strong><span class="muted">Activos</span></div>
        <div class="stat"><strong><?= $stats['admins'] ?></strong><span class="muted">Administradores</span></div>
    </div>
    <a class="btn" href="/usuarios">Administrar usuarios</a>
<?php endif; ?>
