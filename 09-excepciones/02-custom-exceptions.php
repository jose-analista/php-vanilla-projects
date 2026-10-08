<?php

// Definición de una excepción personalizada
class SaldoInsuficienteException extends Exception
{
    private float $saldoActual;

    public function __construct(string $message, float $saldoActual, int $code = 0, ?Throwable $previous = null)
    {
        $this->saldoActual = $saldoActual;
        parent::__construct($message, $code, $previous);
    }

    public function getSaldoActual(): float
    {
        return $this->saldoActual;
    }
}

// Ejemplo de uso
class CuentaBancaria
{
    private float $saldo;

    public function __construct(float $saldoInicial)
    {
        $this->saldo = $saldoInicial;
    }

    public function retirar(float $monto): void
    {
        if ($monto > $this->saldo) {
            throw new SaldoInsuficienteException(
                "Intento de retiro de \${$monto} supera el saldo disponible.",
                $this->saldo
            );
        }

        $this->saldo -= $monto;
        echo "Retiro exitoso. Nuevo saldo: \${$this->saldo}\n";
    }
}

// Prueba del manejo de la excepción
try {
    $cuenta = new CuentaBancaria(100.00);

    echo "Intentando retirar $50...\n";
    $cuenta->retirar(50.00);

    echo "Intentando retirar $80...\n";
    $cuenta->retirar(80.00);

} catch (SaldoInsuficienteException $e) {
    echo "\n[ERROR PERSONALIZADO]: " . $e->getMessage() . "\n";
    echo "Saldo actual en la cuenta: $" . $e->getSaldoActual() . "\n";
} catch (Exception $e) {
    echo "\n[ERROR GENERAL]: " . $e->getMessage() . "\n";
} finally {
    echo "Operación de transacción finalizada.\n";
}