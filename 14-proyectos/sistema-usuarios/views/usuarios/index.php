<?php

use App\Auth;

$qs = static fn (int $p): string => '?' . http_build_query(['q' => $q, 'page' => $p]);
?>
<div class="card">
    <h1>Usuarios <span class="muted">(<?= (int)$total ?>)</span></h1>

    <div class="toolbar">
        <form method="get" action="/usuarios">
            <input type="search" name="q" value="<?= e($q) ?>" placeholder="Buscar por nombre o email">
            <button class="btn btn-secondary" type="submit">Buscar</button>
        </form>
        <a class="btn" href="/usuarios/crear">+ Nuevo usuario</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Estado</th><th>Creado</th><th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= (int)$u['id'] ?></td>
                    <td><?= e($u['nombre']) ?></td>
                    <td><?= e($u['email']) ?></td>
                    <td><span class="badge badge-<?= e($u['rol']) ?>"><?= e($u['rol']) ?></span></td>
                    <td>
                        <?php if ((int)$u['activo'] === 1): ?>
                            <span class="badge badge-on">Activo</span>
                        <?php else: ?>
                            <span class="badge badge-off">Inactivo</span>
                        <?php endif; ?>
                    </td>
                    <td><?= e(date('d-m-Y', strtotime($u['creado_en']))) ?></td>
                    <td>
                        <div class="actions">
                            <a class="btn btn-secondary btn-sm" href="/usuarios/<?= (int)$u['id'] ?>/editar">Editar</a>
                            <?php if ((int)$u['id'] !== Auth::id()): ?>
                                <form method="post" action="/usuarios/<?= (int)$u['id'] ?>/eliminar"
                                      onsubmit="return confirm('¿Eliminar este usuario? Esta acción no se puede deshacer.');">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$usuarios): ?>
                <tr><td colspan="7" class="muted">No se encontraron usuarios.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pages > 1): ?>
        <nav class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <?php if ($i === $page): ?>
                    <span class="current"><?= $i ?></span>
                <?php else: ?>
                    <a href="<?= e($qs($i)) ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </nav>
    <?php endif; ?>
</div>
