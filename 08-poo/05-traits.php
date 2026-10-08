<?php

/*
|--------------------------------------------------------------------------
| 05-traits.php
|--------------------------------------------------------------------------
| Traits en PHP
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - trait
| - use
| - Propiedades y métodos en un trait
| - Usar varios traits en una clase
| - Resolver conflictos: insteadof y as
| - Cambiar la visibilidad de un método con as
| - Métodos abstractos en un trait
| - Propiedades static en un trait
| - Traits que usan otros traits
| - Traits junto con interfaces
| - class_uses(), trait_exists() y method_exists()
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Trait básico
// -------------------------------------------------------------------------
// Un trait es un bloque de código reutilizable. Sirve para compartir
// métodos y propiedades entre clases que NO tienen relación de herencia.
//
// - No se puede instanciar con new
// - No es un tipo: instanceof no funciona con traits
// - Una clase puede usar varios traits

trait Registrable
{
    private array $registros = [];

    public function registrar(string $mensaje): void
    {
        $this->registros[] = (count($this->registros) + 1) . ". " . $mensaje;
    }

    public function getRegistros(): array
    {
        return $this->registros;
    }
}


// -------------------------------------------------------------------------
// 2. Trait con método abstracto
// -------------------------------------------------------------------------
// El trait exige que la clase que lo use implemente getNombre().
// Así puede usar ese método dentro de su propio código.

trait Describible
{
    abstract public function getNombre(): string;

    public function describir(): string
    {
        return static::class . ": " . $this->getNombre();
    }
}


// -------------------------------------------------------------------------
// 3. Trait con propiedad static
// -------------------------------------------------------------------------
// Cada clase que use el trait recibe su PROPIA copia de la propiedad
// static: el contador de Usuario es independiente del de Pedido.

trait Contador
{
    private static int $instancias = 0;

    protected static function incrementar(): void
    {
        self::$instancias++;
    }

    public static function total(): int
    {
        return self::$instancias;
    }
}


// -------------------------------------------------------------------------
// 4. Trait que usa otro trait
// -------------------------------------------------------------------------

trait Auditable
{
    use Registrable;

    public function auditar(string $accion): void
    {
        $this->registrar("AUDITORÍA: " . $accion);
    }
}


// -------------------------------------------------------------------------
// 5. Traits junto con interfaces
// -------------------------------------------------------------------------
// La interfaz define el contrato (y sí sirve como tipo).
// El trait aporta el código reutilizable.

interface Identificable
{
    public function getNombre(): string;
}


// -------------------------------------------------------------------------
// 6. Clases que usan traits
// -------------------------------------------------------------------------
// use dentro de la clase incluye el código del trait,
// como si estuviera escrito directamente en ella.

class Usuario implements Identificable
{
    use Registrable, Describible, Contador;

    public function __construct(private string $nombre)
    {
        self::incrementar();

        $this->registrar("Usuario creado: " . $nombre);
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
}


// Pedido no tiene relación con Usuario, pero comparte funcionalidad.
// Registrable le llega a través de Auditable.

class Pedido
{
    use Auditable, Contador;

    public function __construct(private int $numero)
    {
        self::incrementar();

        $this->registrar("Pedido creado: #" . $numero);

        $this->auditar("alta del pedido #" . $numero);
    }
}


// -------------------------------------------------------------------------
// 7. Conflicto entre traits
// -------------------------------------------------------------------------
// Si dos traits tienen un método con el mismo nombre, PHP da error
// a menos que se indique cuál usar:
//
// - insteadof: elige qué método se usa
// - as:        crea un alias para el método descartado

trait Hablar
{
    public function saludar(): string
    {
        return "Hola";
    }
}


trait Educado
{
    public function saludar(): string
    {
        return "Buenos días";
    }
}


class Recepcionista
{
    use Hablar, Educado {

        Educado::saludar insteadof Hablar;

        Hablar::saludar as saludoInformal;
    }
}


// -------------------------------------------------------------------------
// 8. Cambiar la visibilidad con as
// -------------------------------------------------------------------------
// El método limpiar() es public en el trait, pero en Formulario
// se vuelve protected: solo se usa desde dentro de la clase.

trait Utilidades
{
    public function limpiar(string $texto): string
    {
        return trim($texto);
    }
}


class Formulario
{
    use Utilidades {

        limpiar as protected;
    }

    public function procesar(string $texto): string
    {
        return strtoupper($this->limpiar($texto));
    }
}


// -------------------------------------------------------------------------
// 9. Esto daría error
// -------------------------------------------------------------------------

// No se puede instanciar un trait:
// $registro = new Registrable();

// limpiar() ahora es protected, no se puede llamar desde fuera:
// (new Formulario())->limpiar("  hola  ");


// -------------------------------------------------------------------------
// 10. Probar Usuario y Pedido
// -------------------------------------------------------------------------

$usuario1 = new Usuario("Ana");

$usuario2 = new Usuario("Luis");

$usuario3 = new Usuario("Marta");

$usuario1->registrar("Inició sesión");

$pedido1 = new Pedido(1001);

$pedido2 = new Pedido(1002);

$pedido1->auditar("pedido enviado");

$registrosUsuario = $usuario1->getRegistros();

$registrosPedido = $pedido1->getRegistros();

$descripcionUsuario = $usuario1->describir();

$totalUsuarios = Usuario::total();

$totalPedidos = Pedido::total();


// -------------------------------------------------------------------------
// 11. Probar el conflicto y la visibilidad
// -------------------------------------------------------------------------

$recepcionista = new Recepcionista();

$saludoFormal = $recepcionista->saludar();

$saludoInformal = $recepcionista->saludoInformal();

$formulario = new Formulario();

$textoProcesado = $formulario->procesar("   hola mundo   ");


// -------------------------------------------------------------------------
// 12. Consultar traits
// -------------------------------------------------------------------------

$traitsUsuario = array_values(class_uses($usuario1));

$traitsPedido = array_values(class_uses($pedido1));

$existeTrait = trait_exists("Registrable");

$existeInventado = trait_exists("Inventado");

$tieneMetodo = method_exists($pedido1, "registrar");

// instanceof NO sirve con traits: un trait no es un tipo
$esRegistrable = $usuario1 instanceof Registrable;

// Con la interfaz sí funciona
$esIdentificable = $usuario1 instanceof Identificable;


// -------------------------------------------------------------------------
// 13. Funciones auxiliares para mostrar resultados
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

    <title>Traits PHP</title>

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


<h1>Traits PHP</h1>


<!-- ================================================================= -->
<!-- 14. Código compartido -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Código compartido entre clases</h2>

    <p>
        <code>Usuario</code> y <code>Pedido</code> no están relacionadas,
        pero las dos usan <code>Registrable</code>.
    </p>

    <p><strong>Registros del usuario Ana:</strong></p>

    <?= lista($registrosUsuario) ?>

    <p><strong>Registros del pedido #1001:</strong></p>

    <?= lista($registrosPedido) ?>

    <p>
        <strong>Describible:</strong>
        <?= htmlspecialchars($descripcionUsuario) ?>
    </p>

</div>


<!-- ================================================================= -->
<!-- 15. Propiedad static -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Propiedad static en un trait</h2>

    <p>
        Cada clase tiene su propio contador, aunque vengan del mismo trait.
    </p>

    <ul>
        <li>
            Usuarios creados:
            <strong><?= $totalUsuarios ?></strong>
        </li>
        <li>
            Pedidos creados:
            <strong><?= $totalPedidos ?></strong>
        </li>
    </ul>

</div>


<!-- ================================================================= -->
<!-- 16. Conflicto y visibilidad -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Conflictos y visibilidad</h2>

    <ul>
        <li>
            <code>saludar()</code> (Educado gana con insteadof):
            <strong><?= htmlspecialchars($saludoFormal) ?></strong>
        </li>
        <li>
            <code>saludoInformal()</code> (alias de Hablar):
            <strong><?= htmlspecialchars($saludoInformal) ?></strong>
        </li>
        <li>
            <code>Formulario::procesar()</code> usa el método protected:
            <strong><?= htmlspecialchars($textoProcesado) ?></strong>
        </li>
    </ul>

</div>


<!-- ================================================================= -->
<!-- 17. Consultas -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Consultar traits</h2>

    <ul>
        <li>
            ¿Existe el trait Registrable?
            <strong><?= si_no($existeTrait) ?></strong>
        </li>
        <li>
            ¿Existe el trait Inventado?
            <strong><?= si_no($existeInventado) ?></strong>
        </li>
        <li>
            ¿Pedido tiene el método registrar()?
            <strong><?= si_no($tieneMetodo) ?></strong>
        </li>
        <li>
            ¿Usuario <code>instanceof</code> Registrable (trait)?
            <strong><?= si_no($esRegistrable) ?></strong>
        </li>
        <li>
            ¿Usuario <code>instanceof</code> Identificable (interfaz)?
            <strong><?= si_no($esIdentificable) ?></strong>
        </li>
    </ul>

    <p><strong>Traits que usa Usuario (class_uses):</strong></p>

    <?= lista($traitsUsuario) ?>

    <p><strong>Traits que usa Pedido (class_uses):</strong></p>

    <?= lista($traitsPedido) ?>

</div>

</body>

</html>