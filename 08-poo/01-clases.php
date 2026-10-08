<?php

/*
|--------------------------------------------------------------------------
| 01-clases.php
|--------------------------------------------------------------------------
| Clases y objetos en PHP
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - class
| - new
| - Propiedades
| - Métodos
| - $this
| - __construct()
| - Visibilidad: public, private
| - Getters y setters
| - Constructor con promoción de propiedades (PHP 8)
| - readonly
| - const
| - static
| - __toString()
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Clase básica
// -------------------------------------------------------------------------
// Una clase es un molde. Un objeto es una copia creada a partir de ese molde.
// Por convención, los nombres de clase usan PascalCase.

class Persona
{

    // ---------------------------------------------------------------------
    // 2. Propiedades
    // ---------------------------------------------------------------------
    // Son las variables que pertenecen al objeto.

    public string $nombre;

    public int $edad;


    // ---------------------------------------------------------------------
    // 3. Constructor
    // ---------------------------------------------------------------------
    // Se ejecuta automáticamente al crear el objeto con new.
    // $this se refiere al objeto actual.

    public function __construct(string $nombre, int $edad)
    {
        $this->nombre = $nombre;

        $this->edad = $edad;
    }


    // ---------------------------------------------------------------------
    // 4. Métodos
    // ---------------------------------------------------------------------
    // Son las funciones que pertenecen al objeto.

    public function saludar(): string
    {
        return "Hola, me llamo {$this->nombre} y tengo {$this->edad} años.";
    }

    public function esMayorDeEdad(): bool
    {
        return $this->edad >= 18;
    }
}


// -------------------------------------------------------------------------
// 5. Visibilidad y encapsulamiento
// -------------------------------------------------------------------------
// - public:  se puede usar desde cualquier lugar
// - private: solo se puede usar dentro de la propia clase
//
// Ocultar el saldo evita que alguien lo modifique directamente.
// Para cambiarlo hay que usar los métodos, que aplican las reglas.

class CuentaBancaria
{

    // Constante de clase: no cambia y se accede con ::
    public const MONEDA = "CLP";

    // Propiedad estática: pertenece a la clase, no a cada objeto
    private static int $totalCuentas = 0;

    private float $saldo = 0;


    // Promoción de propiedades (PHP 8):
    // declarar "private string $titular" en el constructor
    // crea la propiedad y le asigna el valor automáticamente.

    public function __construct(private string $titular)
    {
        self::$totalCuentas++;
    }


    // Getters: permiten LEER una propiedad privada

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }


    // Métodos que modifican el saldo aplicando reglas
    // Devuelven true si la operación se realizó y false si no.

    public function depositar(float $monto): bool
    {
        if ($monto <= 0) {

            return false;
        }

        $this->saldo += $monto;

        return true;
    }

    public function retirar(float $monto): bool
    {
        if ($monto <= 0 || $monto > $this->saldo) {

            return false;
        }

        $this->saldo -= $monto;

        return true;
    }


    // Método estático: se llama con la clase, sin crear un objeto

    public static function totalCuentas(): int
    {
        return self::$totalCuentas;
    }
}


// -------------------------------------------------------------------------
// 6. Propiedades readonly y __toString()
// -------------------------------------------------------------------------
// readonly: la propiedad se asigna una sola vez y luego no se puede cambiar.
// __toString(): define cómo se convierte el objeto a texto.

class Producto
{
    public function __construct(
        public readonly string $nombre,
        public readonly float $precio
    ) {
    }

    public function __toString(): string
    {
        return $this->nombre . " - $" . number_format($this->precio, 0, ",", ".");
    }
}


// -------------------------------------------------------------------------
// 7. Crear objetos con new
// -------------------------------------------------------------------------

$persona1 = new Persona("José", 30);

$persona2 = new Persona("Ana", 16);


// -------------------------------------------------------------------------
// 8. Usar propiedades y métodos con ->
// -------------------------------------------------------------------------

$saludo1 = $persona1->saludar();

$saludo2 = $persona2->saludar();

$mayor1 = $persona1->esMayorDeEdad();

$mayor2 = $persona2->esMayorDeEdad();


// Las propiedades public se pueden modificar directamente
$persona2->edad = 18;

$mayor2Despues = $persona2->esMayorDeEdad();


// -------------------------------------------------------------------------
// 9. Probar la cuenta bancaria
// -------------------------------------------------------------------------

$cuenta = new CuentaBancaria("José Calderón");

$cuenta->depositar(50000);

$retiroValido = $cuenta->retirar(20000);

$retiroInvalido = $cuenta->retirar(100000);

$cuentaExtra = new CuentaBancaria("Ana Pérez");

// Esto daría un error, porque $saldo es private:
// echo $cuenta->saldo;


// -------------------------------------------------------------------------
// 10. Probar el producto
// -------------------------------------------------------------------------

$producto = new Producto("Teclado mecánico", 45990);

// Esto daría un error, porque la propiedad es readonly:
// $producto->precio = 1000;


// -------------------------------------------------------------------------
// 11. Función auxiliar para mostrar resultados
// -------------------------------------------------------------------------

function si_no(bool $valor): string
{
    return $valor ? "Sí" : "No";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Clases y objetos PHP</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            max-width: 700px;

            margin: 40px auto;

            padding: 20px;

            background: #f4f4f4;
        }

        .caja {

            background: white;

            padding: 20px 25px;

            margin-bottom: 20px;

            border-radius: 10px;
        }

        code {

            background: #eee;

            padding: 2px 6px;

            border-radius: 4px;
        }

    </style>

</head>

<body>


<h1>Clases y objetos PHP</h1>


<!-- ================================================================= -->
<!-- 12. Persona -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Clase Persona</h2>

    <p><?= htmlspecialchars($saludo1) ?></p>

    <p><?= htmlspecialchars($saludo2) ?></p>

    <p>
        ¿<?= htmlspecialchars($persona1->nombre) ?> es mayor de edad?
        <strong><?= si_no($mayor1) ?></strong>
    </p>

    <p>
        ¿<?= htmlspecialchars($persona2->nombre) ?> es mayor de edad?
        <strong><?= si_no($mayor2) ?></strong>
        (después de cambiar su edad a <?= $persona2->edad ?>:
        <strong><?= si_no($mayor2Despues) ?></strong>)
    </p>

</div>


<!-- ================================================================= -->
<!-- 13. Cuenta bancaria -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Clase CuentaBancaria</h2>

    <p>
        <strong>Titular:</strong>
        <?= htmlspecialchars($cuenta->getTitular()) ?>
    </p>

    <p>
        <strong>Saldo:</strong>
        $<?= number_format($cuenta->getSaldo(), 0, ",", ".") ?>
        <?= CuentaBancaria::MONEDA ?>
    </p>

    <p>
        Retiro de $20.000: <strong><?= si_no($retiroValido) ?></strong>
    </p>

    <p>
        Retiro de $100.000 (sin saldo suficiente):
        <strong><?= si_no($retiroInvalido) ?></strong>
    </p>

    <p>
        Cuentas creadas: <strong><?= CuentaBancaria::totalCuentas() ?></strong>
    </p>

</div>


<!-- ================================================================= -->
<!-- 14. Producto -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Clase Producto</h2>

    <p>
        <!-- __toString() se ejecuta al usar el objeto como texto -->
        <?= htmlspecialchars((string) $producto) ?>
    </p>

</div>

</body>

</html>