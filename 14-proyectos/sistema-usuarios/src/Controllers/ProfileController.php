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

final class ProfileController extends Controller
{
    public function show(): void
    {
        Auth::requireLogin();
        $this->render(['nombre' => Auth::user()['nombre']], []);
    }

    public function update(): void
    {
        Auth::requireLogin();
        $this->verifyCsrf();

        $id          = (int)Auth::id();
        $nombre      = $this->input('nombre');
        $current     = $this->input('current_password', false);
        $newPassword = $this->input('new_password', false);
        $confirm     = $this->input('new_password_confirm', false);
        $repo        = new UserRepository();

        $errors = array_filter(['nombre' => Validator::nombre($nombre)]);

        if ($newPassword !== '') {
            $hash = $repo->passwordHash($id);
            if ($hash === null || !password_verify($current, $hash)) {
                $errors['current_password'] = 'La contraseña actual no es correcta.';
            }
            if ($error = Validator::password($newPassword)) {
                $errors['new_password'] = $error;
            }
            if ($newPassword !== $confirm) {
                $errors['new_password_confirm'] = 'Las contraseñas no coinciden.';
            }
        }

        if ($errors) {
            $this->render(['nombre' => $nombre], $errors);
            return;
        }

        $repo->updateProfile($id, $nombre);
        if ($newPassword !== '') {
            $repo->updatePassword($id, $newPassword);
            AppLogger::get()->info('Contraseña cambiada', ['id' => $id]);
        }

        Flash::set('success', 'Perfil actualizado.');
        Http::redirect('/perfil');
    }

    private function render(array $old, array $errors): void
    {
        View::render('perfil', ['title' => 'Mi perfil', 'old' => $old, 'errors' => $errors]);
    }
}
