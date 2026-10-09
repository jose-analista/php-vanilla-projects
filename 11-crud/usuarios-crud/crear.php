<?php
$pdo = require_once __DIR__ . '/config/conexion.php';
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $rutaImagen = null;

    if (empty($nombre) || empty($email)) {
        $error = "Todos los campos obligatorios deben ser completados.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Formato de email inválido.";
    } else {
        // Procesar subida de imagen
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
                    $rutaImagen = 'uploads/' . $nombreImagen;
                }
            } else {
                $error = "Formato de imagen no permitido. Usa JPG, PNG o WEBP.";
            }
        }

        if (!$error) {
            try {
                $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, imagen) VALUES (:nombre, :email, :imagen)");
                $stmt->execute([
                    ':nombre' => $nombre,
                    ':email'  => $email,
                    ':imagen' => $rutaImagen
                ]);

                header("Location: index.php?mensaje=Usuario creado correctamente");
                exit;
            } catch (PDOException $e) {
                $error = "Error al guardar el usuario: " . $e->getMessage();
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
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container my-5" style="max-width: 600px;">
        <div class="card border-secondary shadow">
            <div class="card-header bg-black text-light">
                <h4 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Crear Nuevo Usuario</h4>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="crear.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen de Perfil</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i>Cancelar</a>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-1"></i>Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>