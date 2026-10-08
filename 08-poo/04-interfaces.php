<?php

/*
|--------------------------------------------------------------------------
| 04-interfaces.php
|--------------------------------------------------------------------------
| Interfaces en PHP
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - interface
| - implements
| - Implementar varias interfaces
| - Constantes en interfaces
| - Interfaces que extienden otras interfaces
| - Usar interfaces como tipo de parámetro
| - Inyección de dependencias
| - instanceof con interfaces
| - class_implements() e interface_exists()
| - Polimorfismo
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Interfaz básica
// -------------------------------------------------------------------------
// Una interfaz es un CONTRATO: define qué métodos debe tener una clase,
// pero no cómo funcionan.
//
// - Solo contiene firmas de métodos (sin cuerpo) y constantes
// - Todos los métodos son public
// - No se puede instanciar con new

interface Pagable
{
    public function pagar(float $monto): string;
}


// -------------------------------------------------------------------------
// 2. Interfaz con constante
// -------------------------------------------------------------------------

interface Descontable
{
    public const DESCUENTO_MAXIMO = 30;

    public function aplicarDescuento(float $monto): float;
}


// -------------------------------------------------------------------------
// 3. Función auxiliar de formato
// -------------------------------------------------------------------------

function formato(float $monto): string
{
    return "$" . number_format($monto, 0, ",", ".");
}


// -------------------------------------------------------------------------
// 4. Clases que implementan interfaces
// -------------------------------------------------------------------------
// implements obliga a la clase a definir TODOS los métodos del contrato.
// Si falta alguno, PHP lanza un error fatal.

class Efectivo implements Pagable
{
    public function pagar(float $monto): string
    {
        return "Pagado " . formato($monto) . " en efectivo.";
    }
}


class Transferencia implements Pagable
{
    public function pagar(float $monto): string
    {
        return "Pagado " . formato($monto) . " por transferencia.";
    }
}


// Una clase puede implementar VARIAS interfaces, separadas por coma

class TarjetaCredito implements Pagable, Descontable
{
    private const DESCUENTO = 10;

    public function pagar(float $monto): string
    {
        return "Pagado " . formato($monto) . " con tarjeta de crédito.";
    }

    public function aplicarDescuento(float $monto): float
    {
        // Nunca superar el máximo definido en la interfaz
        $porcentaje = min(self::DESCUENTO, self::DESCUENTO_MAXIMO);

        return $monto - ($monto * $porcentaje / 100);
    }
}


// -------------------------------------------------------------------------
// 5. Interfaces que extienden otras interfaces
// -------------------------------------------------------------------------
// NotificableUrgente hereda el contrato de Notificable y agrega uno más.
// La clase que la implemente debe cumplir con AMBOS.

interface Notificable
{
    public function enviar(string $mensaje): string;
}


interface NotificableUrgente extends Notificable
{
    public function enviarUrgente(string $mensaje): string;
}


class Email implements Notificable
{
    public function enviar(string $mensaje): string
    {
        return "Email: " . $mensaje;
    }
}


class Sms implements NotificableUrgente
{
    public function enviar(string $mensaje): string
    {
        return "SMS: " . $mensaje;
    }

    public function enviarUrgente(string $mensaje): string
    {
        return "SMS URGENTE: " . $mensaje;
    }
}


// -------------------------------------------------------------------------
// 6. Interfaz como tipo de parámetro
// -------------------------------------------------------------------------
// La función acepta CUALQUIER objeto que cumpla el contrato Pagable.
// No le importa cuál es la clase concreta: eso es polimorfismo.

function procesarPago(Pagable $metodo, float $monto): string
{
    return $metodo->pagar($monto);
}


// -------------------------------------------------------------------------
// 7. Inyección de dependencias
// -------------------------------------------------------------------------
// Tienda no crea sus propios métodos de pago ni notificadores:
// los recibe desde fuera, y solo exige que cumplan una interfaz.
// Así se puede cambiar el pago o la notificación sin tocar esta clase.

class Tienda
{
    public function __construct(
        private Pagable $metodoPago,
        private Notificable $notificador
    ) {
    }

    public function comprar(float $monto): array
    {
        $mensajes = [];

        // Si el método de pago además es Descontable, aplicamos el descuento
        if ($this->metodoPago instanceof Descontable) {

            $original = $monto;

            $monto = $this->metodoPago->aplicarDescuento($monto);

            $mensajes[] = "Descuento aplicado: " . formato($original)
                . " → " . formato($monto);
        }

        $mensajes[] = $this->metodoPago->pagar($monto);

        // Si el notificador soporta urgentes y la compra es grande, lo usamos
        if ($monto > 100000 && $this->notificador instanceof NotificableUrgente) {

            $mensajes[] = $this->notificador->enviarUrgente("Compra grande realizada.");

        } else {

            $mensajes[] = $this->notificador->enviar("Compra realizada.");
        }

        return $mensajes;
    }
}


// -------------------------------------------------------------------------
// 8. Esto daría error
// -------------------------------------------------------------------------

// No se puede instanciar una interfaz:
// $pago = new Pagable();

// Una clase que no implementa todo el contrato da un error fatal:
// class Cheque implements Pagable {}


// -------------------------------------------------------------------------
// 9. Probar los métodos de pago
// -------------------------------------------------------------------------

$metodos = [

    new Efectivo(),

    new Transferencia(),

    new TarjetaCredito(),
];

$resultadosPago = [];

foreach ($metodos as $metodo) {

    $resultadosPago[] = procesarPago($metodo, 50000);
}


// -------------------------------------------------------------------------
// 10. Probar la tienda con distintas combinaciones
// -------------------------------------------------------------------------

$tienda1 = new Tienda(new TarjetaCredito(), new Sms());

$compra1 = $tienda1->comprar(200000);

$tienda2 = new Tienda(new Efectivo(), new Email());

$compra2 = $tienda2->comprar(30000);


// -------------------------------------------------------------------------
// 11. Consultar interfaces
// -------------------------------------------------------------------------

$tarjeta = new TarjetaCredito();

$sms = new Sms();

$tarjetaEsPagable = $tarjeta instanceof Pagable;

$tarjetaEsDescontable = $tarjeta instanceof Descontable;

$efectivoEsDescontable = (new Efectivo()) instanceof Descontable;

// Una clase que implementa una interfaz hija también cumple la interfaz padre
$smsEsNotificable = $sms instanceof Notificable;

$interfacesTarjeta = array_values(class_implements($tarjeta));

$interfacesSms = array_values(class_implements($sms));

$existePagable = interface_exists("Pagable");

$existeInventada = interface_exists("Inventada");


// -------------------------------------------------------------------------
// 12. Función auxiliar para mostrar resultados
// -------------------------------------------------------------------------

function si_no(bool $valor): string
{
    return $valor ? "Sí" : "No";
}

function lista(array $elementos): string
{
    $html = "<ul>";

    foreach ($elementos as $elemento) {

        $html .= "<li>" . htmlspecialchars($elemento) . "</li>";
    }

    return $html . "</ul>";
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

    <title>Interfaces PHP</title>

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


<h1>Interfaces PHP</h1>


<!-- ================================================================= -->
<!-- 13. Polimorfismo con Pagable -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Polimorfismo con Pagable</h2>

    <p>
        La misma función <code>procesarPago()</code> funciona con
        cualquier clase que implemente <code>Pagable</code>.
    </p>

    <?= lista($resultadosPago) ?>

</div>


<!-- ================================================================= -->
<!-- 14. Tienda -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Inyección de dependencias</h2>

    <p>
        <strong>Tienda con TarjetaCredito + Sms</strong>
        (compra de <?= formato(200000) ?>):
    </p>

    <?= lista($compra1) ?>

    <p>
        <strong>Tienda con Efectivo + Email</strong>
        (compra de <?= formato(30000) ?>):
    </p>

    <?= lista($compra2) ?>

</div>


<!-- ================================================================= -->
<!-- 15. Consultas -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Consultar interfaces</h2>

    <ul>
        <li>
            ¿TarjetaCredito es Pagable?
            <strong><?= si_no($tarjetaEsPagable) ?></strong>
        </li>
        <li>
            ¿TarjetaCredito es Descontable?
            <strong><?= si_no($tarjetaEsDescontable) ?></strong>
        </li>
        <li>
            ¿Efectivo es Descontable?
            <strong><?= si_no($efectivoEsDescontable) ?></strong>
        </li>
        <li>
            ¿Sms es Notificable (interfaz padre)?
            <strong><?= si_no($smsEsNotificable) ?></strong>
        </li>
        <li>
            ¿Existe la interfaz Pagable?
            <strong><?= si_no($existePagable) ?></strong>
        </li>
        <li>
            ¿Existe la interfaz Inventada?
            <strong><?= si_no($existeInventada) ?></strong>
        </li>
        <li>
            Constante de la interfaz:
            <code>Descontable::DESCUENTO_MAXIMO</code> =
            <strong><?= Descontable::DESCUENTO_MAXIMO ?>%</strong>
        </li>
    </ul>

    <p><strong>Interfaces que implementa TarjetaCredito:</strong></p>

    <?= lista($interfacesTarjeta) ?>

    <p><strong>Interfaces que implementa Sms:</strong></p>

    <?= lista($interfacesSms) ?>

</div>

</body>

</html>