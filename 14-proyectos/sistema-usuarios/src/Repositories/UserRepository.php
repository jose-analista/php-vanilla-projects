<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Database;
use PDO;

final class UserRepository
{
    private const COLUMNS = 'id, nombre, email, rol, activo, creado_en';

    private PDO $db;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db ?? Database::connection();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT ' . self::COLUMNS . ' FROM usuarios WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);

        return $stmt->fetch() ?: null;
    }

    /** Incluye password_hash: solo para autenticación. */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT ' . self::COLUMNS . ', password_hash FROM usuarios WHERE email = :email LIMIT 1'
        );
        $stmt->execute([':email' => $email]);

        return $stmt->fetch() ?: null;
    }

    public function passwordHash(int $id): ?string
    {
        $stmt = $this->db->prepare('SELECT password_hash FROM usuarios WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $hash = $stmt->fetchColumn();

        return $hash === false ? null : (string)$hash;
    }

    public function emailExists(string $email, ?int $exceptId = null): bool
    {
        $stmt = $this->db->prepare('SELECT id FROM usuarios WHERE email = :email AND id <> :id LIMIT 1');
        $stmt->execute([':email' => $email, ':id' => $exceptId ?? 0]);

        return $stmt->fetchColumn() !== false;
    }

    /** @return array<int, array<string, mixed>> */
    public function paginate(string $q, int $limit, int $offset): array
    {
        [$where, $params] = $this->where($q);

        $stmt = $this->db->prepare(
            'SELECT ' . self::COLUMNS . " FROM usuarios $where ORDER BY id DESC LIMIT :limit OFFSET :offset"
        );
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function count(string $q = ''): int
    {
        [$where, $params] = $this->where($q);

        $stmt = $this->db->prepare("SELECT COUNT(*) FROM usuarios $where");
        $stmt->execute($params);

        return (int)$stmt->fetchColumn();
    }

    /** @return array{total: int, activos: int, admins: int} */
    public function stats(): array
    {
        $row = $this->db->query(
            'SELECT COUNT(*) AS total,
                    COALESCE(SUM(activo = 1), 0) AS activos,
                    COALESCE(SUM(rol = \'admin\'), 0) AS admins
             FROM usuarios'
        )->fetch();

        return [
            'total'   => (int)$row['total'],
            'activos' => (int)$row['activos'],
            'admins'  => (int)$row['admins'],
        ];
    }

    public function create(string $nombre, string $email, string $password, string $rol = 'usuario', bool $activo = true): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO usuarios (nombre, email, password_hash, rol, activo)
             VALUES (:nombre, :email, :hash, :rol, :activo)'
        );
        $stmt->execute([
            ':nombre' => $nombre,
            ':email'  => $email,
            ':hash'   => password_hash($password, PASSWORD_DEFAULT),
            ':rol'    => $rol,
            ':activo' => $activo ? 1 : 0,
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, string $nombre, string $email, string $rol, bool $activo): void
    {
        $stmt = $this->db->prepare(
            'UPDATE usuarios SET nombre = :nombre, email = :email, rol = :rol, activo = :activo WHERE id = :id'
        );
        $stmt->execute([
            ':nombre' => $nombre,
            ':email'  => $email,
            ':rol'    => $rol,
            ':activo' => $activo ? 1 : 0,
            ':id'     => $id,
        ]);
    }

    public function updateProfile(int $id, string $nombre): void
    {
        $stmt = $this->db->prepare('UPDATE usuarios SET nombre = :nombre WHERE id = :id');
        $stmt->execute([':nombre' => $nombre, ':id' => $id]);
    }

    public function updatePassword(int $id, string $password): void
    {
        $stmt = $this->db->prepare('UPDATE usuarios SET password_hash = :hash WHERE id = :id');
        $stmt->execute([':hash' => password_hash($password, PASSWORD_DEFAULT), ':id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM usuarios WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }

    /** @return array{0: string, 1: array<string, string>} */
    private function where(string $q): array
    {
        if ($q === '') {
            return ['', []];
        }

        $like = '%' . addcslashes($q, '%_\\') . '%';

        // Con EMULATE_PREPARES desactivado no se puede repetir un parámetro con nombre
        return ['WHERE nombre LIKE :q1 OR email LIKE :q2', [':q1' => $like, ':q2' => $like]];
    }
}
