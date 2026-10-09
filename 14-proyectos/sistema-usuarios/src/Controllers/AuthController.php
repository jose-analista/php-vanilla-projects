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
use PDOException;

final class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            Http::redirect('/dashboard');
        }
        $this->renderLogin('', []);
    }

    public function login(): void
    {
        $this->verifyCsrf();

        $email    = mb_strtolower($this->input('email'));
        $password = $this->input('password', false);

        $wait = Auth::lockedFor();
        if ($wait > 0) {
            $this->renderLogin($email, ['general' => "Demasiados intentos fallidos. Espera $wait segundos."]);
            return;
        }

        if (Auth::attempt($email, $password)) {
            AppLogger::get()->info('Inicio de sesión correcto', ['email' => $email]);
            Flash::set('success', 'Bienvenido/a, ' . Auth::user()['nombre'] . '.');
            Http::redirect('/dashboard');
        }

        AppLogger::get()->warning('Inicio de sesión fallido', [
            'email' => $email,
            'ip'    => $_SERVER['REMOTE_ADDR'] ?? 'cli',
        ]);
        $this->renderLogin($email, ['general' => 'Credenciales incorrectas o cuenta inactiva.']);
    }

    public function showRegister(): void
    {
        if (Auth::check()) {
            Http::redirect('/dashboard');
        }
        $this->renderRegister(['nombre' => '', 'email' => ''], []);
    }

    public function register(): void
    {
        $this->verifyCsrf();

        $nombre   = $this->input('nombre');
        $email    = mb_strtolower($this->input('email'));
        $password = $this->input('password', false);
        $confirm  = $this->input('password_confirm', false);
        $repo     = new UserRepository();

        $errors = array_filter([
            'nombre'           => Validator::nombre($nombre),
            'email'            => Validator::email($email),
            'password'         => Validator::password($password),
            'password_confirm' => $password !== $confirm ? 'Las contraseñas no coinciden.' : null,
        ]);

        if (!isset($errors['email']) && $repo->emailExists($email)) {
            $errors['email'] = 'Ya existe una cuenta con ese email.';
        }

        if ($errors) {
            $this->renderRegister(['nombre' => $nombre, 'email' => $email], $errors);
            return;
        }

        try {
            $id = $repo->create($nombre, $email, $password, 'usuario');
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') { // email duplicado (condición de carrera)
                $this->renderRegister(['nombre' => $nombre, 'email' => $email], ['email' => 'Ya existe una cuenta con ese email.']);
                return;
            }
            throw $e;
        }

        AppLogger::get()->info('Usuario registrado', ['id' => $id, 'email' => $email]);
        Auth::login($repo->find($id));
        Flash::set('success', 'Cuenta creada correctamente. ¡Bienvenido/a!');
        Http::redirect('/dashboard');
    }

    public function logout(): void
    {
        $this->verifyCsrf();
        Auth::logout();
        Flash::set('success', 'Sesión cerrada.');
        Http::redirect('/login');
    }

    private function renderLogin(string $email, array $errors): void
    {
        View::render('auth/login', ['title' => 'Iniciar sesión', 'old' => ['email' => $email], 'errors' => $errors]);
    }

    private function renderRegister(array $old, array $errors): void
    {
        View::render('auth/register', ['title' => 'Crear cuenta', 'old' => $old, 'errors' => $errors]);
    }
}
