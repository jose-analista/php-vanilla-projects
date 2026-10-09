<?php
declare(strict_types=1);

namespace App;

use App\Repositories\UserRepository;
use PDOException;

final class Auth
{
    private const MAX_ATTEMPTS = 5;
    private const LOCK_SECONDS = 300;

    private static ?array $user = null;

    /** Intenta iniciar sesión. Devuelve true si las credenciales son correctas. */
    public static function attempt(string $email, string $password): bool
    {
        $repo = new UserRepository();
        $user = $repo->findByEmail($email);

        // Se verifica siempre una contraseña para que el tiempo de respuesta sea similar
        // exista o no el usuario.
        $hash  = $user['password_hash'] ?? password_hash('sin-usuario', PASSWORD_DEFAULT);
        $valid = password_verify($password, $hash);

        if ($user === null || !$valid || (int)$user['activo'] !== 1) {
            $_SESSION['_attempts'] = ($_SESSION['_attempts'] ?? 0) + 1;
            if ($_SESSION['_attempts'] >= self::MAX_ATTEMPTS) {
                $_SESSION['_locked_until'] = time() + self::LOCK_SECONDS;
                $_SESSION['_attempts']     = 0;
            }
            return false;
        }

        // Re-hash si el algoritmo por defecto de PHP cambió
        if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) {
            $repo->updatePassword((int)$user['id'], $password);
        }

        self::login($user);
        return true;
    }

    public static function login(array $user): void
    {
        session_regenerate_id(true); // evita fijación de sesión
        unset($_SESSION['_attempts'], $_SESSION['_locked_until']);
        $_SESSION['user_id'] = (int)$user['id'];

        unset($user['password_hash']);
        self::$user = $user;
    }

    public static function logout(): void
    {
        // Se vacía la sesión y se cambia el ID (sin destruirla, para poder mostrar mensajes flash)
        $_SESSION = [];
        session_regenerate_id(true);
        self::$user = null;
    }

    /** Segundos que faltan para poder reintentar (0 si no está bloqueado). */
    public static function lockedFor(): int
    {
        return max(0, (int)($_SESSION['_locked_until'] ?? 0) - time());
    }

    public static function user(): ?array
    {
        if (self::$user === null && isset($_SESSION['user_id'])) {
            try {
                $user = (new UserRepository())->find((int)$_SESSION['user_id']);
            } catch (PDOException) {
                return null; // BD no disponible: se trata como sin sesión, sin cerrarla
            }

            if ($user === null || (int)$user['activo'] !== 1) {
                self::logout();
                return null;
            }
            self::$user = $user;
        }

        return self::$user;
    }

    public static function id(): ?int
    {
        $user = self::user();
        return $user ? (int)$user['id'] : null;
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function isAdmin(): bool
    {
        return (self::user()['rol'] ?? '') === 'admin';
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            Flash::set('info', 'Inicia sesión para continuar.');
            Http::redirect('/login');
        }
    }

    public static function requireAdmin(): void
    {
        self::requireLogin();
        if (!self::isAdmin()) {
            Http::abort(403, 'No tienes permiso para ver esta página.');
        }
    }
}
