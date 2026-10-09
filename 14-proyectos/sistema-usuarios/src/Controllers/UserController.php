<?php
declare(strict_types=1);

namespace App\Controllers;

use App\AppLogger;
use App\Auth;
use App\Flash;
use App\Http;
use App\Repositories\UserRepository;
use App\Validator;
use App\View;

/** CRUD de usuarios: solo para administradores. */
final class UserController extends Controller
{
    private const PER_PAGE = 10;

    private UserRepository $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function index(): void
    {
        Auth::requireAdmin();

        $q     = trim((string)($_GET['q'] ?? ''));
        $total = $this->repo->count($q);
        $pages = max(1, (int)ceil($total / self::PER_PAGE));
        $page  = min($pages, max(1, (int)($_GET['page'] ?? 1)));

        View::render('usuarios/index', [
            'title'    => 'Usuarios',
            'usuarios' => $this->repo->paginate($q, self::PER_PAGE, ($page - 1) * self::PER_PAGE),
            'q'        => $q,
            'page'     => $page,
            'pages'    => $pages,
            'total'    => $total,
        ]);
    }

    public function create(): void
    {
        Auth::requireAdmin();
        $this->form(null, ['nombre' => '', 'email' => '', 'rol' => 'usuario', 'activo' => true], []);
    }

    public function store(): void
    {
        Auth::requireAdmin();
        $this->verifyCsrf();

        $data     = $this->formData();
        $password = $this->input('password', false);

        $errors = array_filter([
            'nombre'   => Validator::nombre($data['nombre']),
            'email'    => Validator::email($data['email']),
            'rol'      => Validator::rol($data['rol']),
            'password' => Validator::password($password),
        ]);
        if (!isset($errors['email']) && $this->repo->emailExists($data['email'])) {
            $errors['email'] = 'Ya existe un usuario con ese email.';
        }

        if ($errors) {
            $this->form(null, $data, $errors);
            return;
        }

        $id = $this->repo->create($data['nombre'], $data['email'], $password, $data['rol'], $data['activo']);
        AppLogger::get()->info('Usuario creado por admin', ['id' => $id, 'admin' => Auth::id()]);
        Flash::set('success', 'Usuario creado correctamente.');
        Http::redirect('/usuarios');
    }

    public function edit(string $id): void
    {
        Auth::requireAdmin();
        $usuario = $this->findOrFail($id);

        $this->form($usuario, [
            'nombre' => $usuario['nombre'],
            'email'  => $usuario['email'],
            'rol'    => $usuario['rol'],
            'activo' => (int)$usuario['activo'] === 1,
        ], []);
    }

    public function update(string $id): void
    {
        Auth::requireAdmin();
        $this->verifyCsrf();
        $usuario = $this->findOrFail($id);
        $userId  = (int)$usuario['id'];

        $data     = $this->formData();
        $password = $this->input('password', false);

        $errors = array_filter([
            'nombre' => Validator::nombre($data['nombre']),
            'email'  => Validator::email($data['email']),
            'rol'    => Validator::rol($data['rol']),
        ]);
        if ($password !== '' && ($error = Validator::password($password))) {
            $errors['password'] = $error;
        }
        if (!isset($errors['email']) && $this->repo->emailExists($data['email'], $userId)) {
            $errors['email'] = 'Ya existe un usuario con ese email.';
        }
        // Evita que el admin se deje a sí mismo sin acceso
        if ($userId === Auth::id() && ($data['rol'] !== 'admin' || !$data['activo'])) {
            $errors['rol'] = 'No puedes quitarte el rol de administrador ni desactivar tu propia cuenta.';
        }

        if ($errors) {
            $this->form($usuario, $data, $errors);
            return;
        }

        $this->repo->update($userId, $data['nombre'], $data['email'], $data['rol'], $data['activo']);
        if ($password !== '') {
            $this->repo->updatePassword($userId, $password);
        }

        AppLogger::get()->info('Usuario actualizado por admin', ['id' => $userId, 'admin' => Auth::id()]);
        Flash::set('success', 'Usuario actualizado correctamente.');
        Http::redirect('/usuarios');
    }

    public function destroy(string $id): void
    {
        Auth::requireAdmin();
        $this->verifyCsrf();
        $usuario = $this->findOrFail($id);
        $userId  = (int)$usuario['id'];

        if ($userId === Auth::id()) {
            Flash::set('error', 'No puedes eliminar tu propia cuenta.');
            Http::redirect('/usuarios');
        }

        $this->repo->delete($userId);
        AppLogger::get()->warning('Usuario eliminado', ['id' => $userId, 'admin' => Auth::id()]);
        Flash::set('success', 'Usuario eliminado.');
        Http::redirect('/usuarios');
    }

    private function findOrFail(string $id): array
    {
        $usuario = ctype_digit($id) ? $this->repo->find((int)$id) : null;
        if ($usuario === null) {
            Http::abort(404, 'El usuario no existe.');
        }

        return $usuario;
    }

    /** @return array{nombre: string, email: string, rol: string, activo: bool} */
    private function formData(): array
    {
        return [
            'nombre' => $this->input('nombre'),
            'email'  => mb_strtolower($this->input('email')),
            'rol'    => $this->input('rol'),
            'activo' => isset($_POST['activo']),
        ];
    }

    private function form(?array $usuario, array $old, array $errors): void
    {
        View::render('usuarios/form', [
            'title'   => $usuario ? 'Editar usuario' : 'Nuevo usuario',
            'usuario' => $usuario,
            'old'     => $old,
            'errors'  => $errors,
            'action'  => $usuario ? '/usuarios/' . $usuario['id'] . '/editar' : '/usuarios',
        ]);
    }
}
