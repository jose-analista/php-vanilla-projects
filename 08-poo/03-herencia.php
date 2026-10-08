<?php

/*
|--------------------------------------------------------------------------
| 03-herencia.php
|--------------------------------------------------------------------------
| Herencia en PHP
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - extends
| - Visibilidad protected
| - parent::__construct()
| - parent:: para reutilizar métodos del padre
| - Sobrescritura de métodos (override)
| - static::class
| - Clases y métodos abstractos
| - final
| - Polimorfismo con arrays de objetos
| - instanceof, get_parent_class() e is_subclass_of()
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Clase padre
// -------------------------------------------------------------------------
// Las propiedades son protected: las clases hijas pueden usarlas,
// pero desde fuera de la jerarquía siguen siendo inaccesibles.

class Empleado
{
    public function __construct(
        protected string $nombre,
        protected float $salarioBase
    ) {
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function calcularSalario(): float
    {
        return $this->salarioBase;
    }

    // static::class devuelve la clase REAL del objeto (Empleado,
    // Desarrollador, Gerente...), no la clase donde está escrito el método.

    public function descripcion(): string
    {
        return $this->nombre . " (" . static::class . ")";
    }

    // final: las clases hijas NO pueden sobrescribir este método

    final public function formatear(float $monto): string
    {
        return "$" . number_format($monto, 0, ",", ".");
    }
}


// -------------------------------------------------------------------------
// 2. Clase hija con extends
// -------------------------------------------------------------------------
// Desarrollador hereda todo lo de Empleado y agrega lo suyo.
// Si la hija define su propio constructor, debe llamar al del padre
// con parent::__construct().

class Desarrollador extends Empleado
{
    private const BONO = 100000;

    public function __construct(
        string $nombre,
        float $salarioBase,
        private string $lenguaje
    ) {
        parent::__construct($nombre, $salarioBase);
    }

    public function getLenguaje(): string
    {
        return $this->lenguaje;
    }

    // Sobrescritura: mismo nombre y firma que el método del padre.
    // parent::calcularSalario() reutiliza el cálculo original.

    public function calcularSalario(): float
    {
        return parent::calcularSalario() + self::BONO;
    }

    public function descripcion(): string
    {
        return parent::descripcion() . " - Lenguaje: " . $this->lenguaje;
    }
}


// -------------------------------------------------------------------------
// 3. Otra clase hija
// -------------------------------------------------------------------------

class Gerente extends Empleado
{
    private const BONO_POR_PERSONA = 50000;

    private array $equipo = [];

    public function agregarEmpleado(Empleado $empleado): static
    {
        $this->equipo[] = $empleado;

        return $this;
    }

    public function cantidadEquipo(): int
    {
        return count($this->equipo);
    }

    public function calcularSalario(): float
    {
        return parent::calcularSalario()
            + self::BONO_POR_PERSONA * count($this->equipo);
    }

    public function descripcion(): string
    {
        return parent::descripcion()
            . " - Equipo de " . count($this->equipo) . " personas";
    }
}


// -------------------------------------------------------------------------
// 4. Clase abstracta
// -------------------------------------------------------------------------
// - No se puede instanciar con new
// - Puede tener métodos abstractos: las hijas están OBLIGADAS a implementarlos
// - Puede tener métodos normales ya implementados

abstract class Figura
{
    abstract public function area(): float;

    abstract public function perimetro(): float;

    public function describir(): string
    {
        return static::class
            . " - Área: " . $this->area()
            . " - Perímetro: " . $this->perimetro();
    }
}


class Circulo extends Figura
{
    public function __construct(private float $radio)
    {
    }

    public function area(): float
    {
        return round(M_PI * $this->radio ** 2, 2);
    }

    public function perimetro(): float
    {
        return round(2 * M_PI * $this->radio, 2);
    }
}


class Rectangulo extends Figura
{
    public function __construct(
        private float $base,
        private float $altura
    ) {
    }

    public function area(): float
    {
        return $this->base * $this->altura;
    }

    public function perimetro(): float
    {
        return 2 * ($this->base + $this->altura);
    }
}


// -------------------------------------------------------------------------
// 5. Clase final
// -------------------------------------------------------------------------
// Una clase final no se puede heredar.

final class Configuracion
{
    public const VERSION = "1.0";
}

// Esto daría un error:
// class ConfiguracionNueva extends Configuracion {}

// Esto también daría un error, porque Figura es abstracta:
// $figura = new Figura();


// -------------------------------------------------------------------------
// 6. Crear los objetos
// -------------------------------------------------------------------------

$base = new Empleado("Pedro", 900000);

$dev1 = new Desarrollador("Ana", 1200000, "PHP");

$dev2 = new Desarrollador("Luis", 1300000, "Python");

$gerente = new Gerente("Marta", 2000000);

$gerente->agregarEmpleado($dev1)->agregarEmpleado($dev2);


// -------------------------------------------------------------------------
// 7. Polimorfismo
// -------------------------------------------------------------------------
// Un array de tipo Empleado puede contener cualquier hija de Empleado.
// Cada objeto responde con SU versión de calcularSalario() y descripcion().

$empleados = [$base, $dev1, $dev2, $gerente];

$planilla = [];

foreach ($empleados as $empleado) {

    $planilla[] = [
        "descripcion" => $empleado->descripcion(),
        "salario"     => $empleado->formatear($empleado->calcularSalario()),
    ];
}

$totalPlanilla = array_sum(
    array_map(fn(Empleado $e) => $e->calcularSalario(), $empleados)
);


// -------------------------------------------------------------------------
// 8. Figuras
// -------------------------------------------------------------------------

$figuras = [

    new Circulo(5),

    new Rectangulo(4, 6),
];

$descripcionesFiguras = array_map(
    fn(Figura $figura) => $figura->describir(),
    $figuras
);


// -------------------------------------------------------------------------
// 9. Consultar la jerarquía
// -------------------------------------------------------------------------

$devEsEmpleado = $dev1 instanceof Empleado;

$devEsGerente = $dev1 instanceof Gerente;

$empleadoEsDev = $base instanceof Desarrollador;

$clasePadre = get_parent_class($dev1);

$esSubclase = is_subclass_of($dev1, Empleado::class);


// -------------------------------------------------------------------------
// 10. Función auxiliar para mostrar resultados
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

    <title>Herencia PHP</title>

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

        table {

            width: 100%;

            border-collapse: collapse;
        }

        th,
        td {

            padding: 8px;

            text-align: left;

            border-bottom: 1px solid #ddd;
        }

        td.numero,
        th.numero {

            text-align: right;
        }

        code {

            background: #eee;

            padding: 2px 6px;

            border-radius: 4px;
        }

    </style>

</head>

<body>


<h1>Herencia PHP</h1>


<!-- ================================================================= -->
<!-- 11. Planilla (polimorfismo) -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Empleados</h2>

    <p>
        Cada objeto calcula su salario con su propia versión
        de <code>calcularSalario()</code>.
    </p>

    <table>

        <thead>
            <tr>
                <th>Empleado</th>
                <th class="numero">Salario</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($planilla as $fila): ?>

                <tr>
                    <td><?= htmlspecialchars($fila["descripcion"]) ?></td>
                    <td class="numero"><?= htmlspecialchars($fila["salario"]) ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>

        <tfoot>
            <tr>
                <th>Total planilla</th>
                <th class="numero">
                    <?= htmlspecialchars($base->formatear($totalPlanilla)) ?>
                </th>
            </tr>
        </tfoot>

    </table>

</div>


<!-- ================================================================= -->
<!-- 12. Figuras (clase abstracta) -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Figuras (clase abstracta)</h2>

    <ul>

        <?php foreach ($descripcionesFiguras as $descripcion): ?>

            <li><?= htmlspecialchars($descripcion) ?></li>

        <?php endforeach; ?>

    </ul>

</div>


<!-- ================================================================= -->
<!-- 13. Jerarquía -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Consultar la jerarquía</h2>

    <ul>
        <li>
            ¿Un Desarrollador es un Empleado?
            <strong><?= si_no($devEsEmpleado) ?></strong>
        </li>
        <li>
            ¿Un Desarrollador es un Gerente?
            <strong><?= si_no($devEsGerente) ?></strong>
        </li>
        <li>
            ¿Un Empleado es un Desarrollador?
            <strong><?= si_no($empleadoEsDev) ?></strong>
        </li>
        <li>
            <code>get_parent_class()</code> de Desarrollador:
            <strong><?= htmlspecialchars($clasePadre) ?></strong>
        </li>
        <li>
            <code>is_subclass_of()</code>:
            <strong><?= si_no($esSubclase) ?></strong>
        </li>
        <li>
            Versión de la clase final:
            <strong><?= Configuracion::VERSION ?></strong>
        </li>
    </ul>

</div>

</body>

</html>