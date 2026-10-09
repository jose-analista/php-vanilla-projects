<?php
$pdo = require_once __DIR__ . '/config/conexion.php';

try {
    $stmt = $pdo->query("SELECT id, nombre, email, imagen, creado_en FROM usuarios ORDER BY id DESC");
    $usuarios = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es" class="h-100" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100 bg-dark text-light">
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fa-solid fa-users me-2"></i>Gestión de Usuarios</h2>
            <a href="crear.php" class="btn btn-success"><i class="fa-solid fa-user-plus me-1"></i>Nuevo Usuario</a>
        </div>

        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET['mensaje']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="card shadow-sm border-secondary">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Registro</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($usuarios)): ?>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                                        <td>
                                            <?php if (!empty($usuario['imagen']) && file_exists(__DIR__ . '/' . $usuario['imagen'])): ?>
                                                <img src="<?= htmlspecialchars($usuario['imagen']) ?>" alt="Avatar" class="rounded-circle object-fit-cover" width="45" height="45">
                                            <?php else: ?>
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <i class="fa-solid fa-user text-light"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                                        <td><?= htmlspecialchars($usuario['creado_en']) ?></td>
                                        <td class="text-end">
                                            <a href="editar.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-outline-warning me-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="eliminar.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Deseas eliminar este usuario y su imagen?');">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No hay usuarios registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>