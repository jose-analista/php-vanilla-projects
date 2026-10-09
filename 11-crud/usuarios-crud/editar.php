<?php
$pdo = require_once __DIR__ . '/config/conexion.php';
$error = null;
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit;
}

// Obtener los datos actuales del usuario
try {
    $stmt = $pdo->prepare("SELECT id, nombre, email, imagen FROM usuarios WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $rutaImagen = $usuario['imagen']; // Mantener la imagen previa por defecto

    if (empty($nombre) || empty($email)) {
        $error = "Todos los campos obligatorios deben ser completados.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Formato de email inválido.";
    } else {
        // Procesar nueva imagen si se subió alguna
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array(strtolower($extension), $extensionesPermitidas)) {
                $dirUploads = __DIR__ . '/uploads/';
                if (!is_dir($dirUploads)) {
                    mkdir($dirUploads, 0755, true);
                }

                $nombreImagen = uniqid('user_', true) . '.' . $extension;
                $destino = $dirUploads . $nombreImagen;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                    // Borrar imagen anterior si existía físicamente
                    if (!empty($usuario['imagen']) && file_exists(__DIR__ . '/' . $usuario['imagen'])) {
                        unlink(__DIR__ . '/' . $usuario['imagen']);
                    }
                    $rutaImagen = 'uploads/' . $nombreImagen;
                }
            } else {
                $error = "Formato de imagen no permitido. Usa JPG, PNG o WEBP.";
            }
        }

        if (!$error) {
            try {
                $stmt = $pdo->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, imagen = :imagen WHERE id = :id");
                $stmt->execute([
                    ':nombre' => $nombre,
                    ':email'  => $email,
                    ':imagen' => $rutaImagen,
                    ':id'     => $id
                ]);

                header("Location: index.php?mensaje=Usuario actualizado correctamente");
                exit;
            } catch (PDOException $e) {
                $error = "Error al actualizar usuario: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container my-5" style="max-width: 600px;">
        <div class="card border-secondary shadow">
            <div class="card-header bg-black text-light">
                <h4 class="mb-0"><i class="fa-solid fa-user-pen me-2"></i>Editar Usuario #<?= htmlspecialchars($usuario['id']) ?></h4>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="editar.php?id=<?= $id ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen de Perfil</label>
                        <?php if (!empty($usuario['imagen']) && file_exists(__DIR__ . '/' . $usuario['imagen'])): ?>
                            <div class="mb-2">
                                <img src="<?= htmlspecialchars($usuario['imagen']) ?>" alt="Avatar Actual" class="rounded object-fit-cover" width="80" height="80">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i>Cancelar</a>
                        <button type="submit" class="btn btn-warning"><i class="fa-solid fa-rotate me-1"></i>Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>