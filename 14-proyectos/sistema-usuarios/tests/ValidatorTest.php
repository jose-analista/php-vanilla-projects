<?php
declare(strict_types=1);

namespace Tests;

use App\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    public function testNombreValido(): void
    {
        $this->assertNull(Validator::nombre('Ana Pérez'));
    }

    public function testNombreMuyCortoOLargo(): void
    {
        $this->assertNotNull(Validator::nombre('A'));
        $this->assertNotNull(Validator::nombre(str_repeat('a', 101)));
    }

    #[DataProvider('emailsInvalidos')]
    public function testEmailInvalido(string $email): void
    {
        $this->assertNotNull(Validator::email($email));
    }

    public static function emailsInvalidos(): array
    {
        return [['sin-arroba'], ['a@'], ['@dominio.cl'], ['']];
    }

    public function testEmailValido(): void
    {
        $this->assertNull(Validator::email('ana@mail.cl'));
    }

    #[DataProvider('passwordsInvalidas')]
    public function testPasswordInvalida(string $password): void
    {
        $this->assertNotNull(Validator::password($password));
    }

    public static function passwordsInvalidas(): array
    {
        return [
            'muy corta'    => ['abc123'],
            'sin números'  => ['soloLetrasAqui'],
            'sin letras'   => ['1234567890'],
            'muy larga'    => [str_repeat('a1', 40)],
        ];
    }

    public function testPasswordValida(): void
    {
        $this->assertNull(Validator::password('Clave12345'));
    }

    public function testRol(): void
    {
        $this->assertNull(Validator::rol('admin'));
        $this->assertNull(Validator::rol('usuario'));
        $this->assertNotNull(Validator::rol('superadmin'));
    }
}
