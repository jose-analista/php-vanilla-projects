<?php

/*
|--------------------------------------------------------------------------
| 02-objetos.php
|--------------------------------------------------------------------------
| Trabajar con objetos en PHP
|--------------------------------------------------------------------------
| En este archivo aprenderemos:
|
| - Crear varios objetos de una misma clase
| - Objetos dentro de otros objetos
| - Arrays de objetos
| - array_filter(), array_map(), usort()
| - Los objetos se asignan por referencia
| - Pasar objetos a funciones
| - clone y __clone()
| - Comparar objetos: == y ===
| - instanceof, get_class() y ::class
| - Encadenar métodos (return $this)
| - stdClass y conversión entre array y objeto
|--------------------------------------------------------------------------
*/


// -------------------------------------------------------------------------
// 1. Clases de apoyo
// -------------------------------------------------------------------------

class Autor
{
    public function __construct(private string $nombre)
    {
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}


class Libro
{
    private bool $prestado = false;

    public function __construct(
        private string $titulo,
        private Autor $autor,
        private int $paginas
    ) {
    }


    // Getters

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getAutor(): Autor
    {
        return $this->autor;
    }

    public function getPaginas(): int
    {
        return $this->paginas;
    }

    public function estaPrestado(): bool
    {
        return $this->prestado;
    }


    // -----------------------------------------------------------------
    // 2. Encadenar métodos
    // -----------------------------------------------------------------
    // Si un método devuelve $this, se pueden llamar varios seguidos:
    // $libro->setTitulo("...")->prestar();

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function prestar(): static
    {
        $this->prestado = true;

        return $this;
    }

    public function devolver(): static
    {
        $this->prestado = false;

        return $this;
    }


    // -----------------------------------------------------------------
    // 3. __clone()
    // -----------------------------------------------------------------
    // clone hace una copia "superficial": las propiedades que son objetos
    // seguirían apuntando al MISMO objeto. __clone() se ejecuta sobre la
    // copia y permite clonar también esos objetos internos.

    public function __clone()
    {
        $this->autor = clone $this->autor;
    }
}


// -------------------------------------------------------------------------
// 4. Crear varios objetos
// -------------------------------------------------------------------------

$libro1 = new Libro("PHP Básico", new Autor("Ana Torres"), 220);

$libro2 = new Libro("POO en PHP", new Autor("Luis Rojas"), 340);

$libro3 = new Libro("Bases de datos", new Autor("Marta Soto"), 180);


// -------------------------------------------------------------------------
// 5. Arrays de objetos
// -------------------------------------------------------------------------

$biblioteca = [$libro1, $libro2, $libro3];

// Marcamos uno como prestado
$libro2->prestar();


// Filtrar: solo los libros disponibles
$disponibles = array_filter(
    $biblioteca,
    fn(Libro $libro) => !$libro->estaPrestado()
);

// Transformar: obtener solo los títulos
$titulos = array_map(
    fn(Libro $libro) => $libro->getTitulo(),
    $biblioteca
);

// Ordenar por cantidad de páginas (de menor a mayor)
$ordenados = $biblioteca;

usort(
    $ordenados,
    fn(Libro $a, Libro $b) => $a->getPaginas() <=> $b->getPaginas()
);

$titulosOrdenados = array_map(
    fn(Libro $libro) => $libro->getTitulo() . " (" . $libro->getPaginas() . " págs.)",
    $ordenados
);


// -------------------------------------------------------------------------
// 6. Los objetos se asignan por referencia
// -------------------------------------------------------------------------
// $libroB = $libroA NO crea una copia: ambas variables apuntan
// al mismo objeto.

$libroA = new Libro("Algoritmos", new Autor("Pedro Vega"), 400);

$libroB = $libroA;

$libroB->prestar();

$prestadoVistoDesdeA = $libroA->estaPrestado();


// -------------------------------------------------------------------------
// 7. Pasar objetos a funciones
// -------------------------------------------------------------------------
// Al pasar un objeto a una función, la función trabaja sobre el original.

function prestarLibro(Libro $libro): void
{
    $libro->prestar();
}

$libroC = new Libro("Redes", new Autor("Sofía Díaz"), 260);

prestarLibro($libroC);

$prestadoDespuesDeFuncion = $libroC->estaPrestado();


// -------------------------------------------------------------------------
// 8. Clonar objetos
// -------------------------------------------------------------------------
// clone crea un objeto nuevo e independiente.

$original = new Libro("Python Básico", new Autor("Carlos Ruiz"), 300);

$copia = clone $original;

$copia->setTitulo("Python Intermedio");

$copia->getAutor()->setNombre("Elena Mora");

// Gracias a __clone(), cambiar el autor de la copia
// no afecta al autor del original.

$tituloOriginal = $original->getTitulo();

$autorOriginal = $original->getAutor()->getNombre();

$tituloCopia = $copia->getTitulo();

$autorCopia = $copia->getAutor()->getNombre();


// -------------------------------------------------------------------------
// 9. Comparar objetos
// -------------------------------------------------------------------------
// ==  -> misma clase y mismos valores en las propiedades
// === -> exactamente la misma instancia

$autorX = new Autor("Ana Torres");

$autorY = new Autor("Ana Torres");

$autorZ = $autorX;

$igualesPorValor = $autorX == $autorY;

$mismaInstanciaXY = $autorX === $autorY;

$mismaInstanciaXZ = $autorX === $autorZ;


// -------------------------------------------------------------------------
// 10. instanceof, get_class() y ::class
// -------------------------------------------------------------------------

$esLibro = $libro1 instanceof Libro;

$esAutor = $libro1 instanceof Autor;

$nombreClase = get_class($libro1);

$nombreClase2 = Libro::class;


// -------------------------------------------------------------------------
// 11. Encadenar métodos
// -------------------------------------------------------------------------

$libroEncadenado = (new Libro("Borrador", new Autor("Ana Torres"), 100))
    ->setTitulo("Título definitivo")
    ->prestar()
    ->devolver()
    ->prestar();

$tituloEncadenado = $libroEncadenado->getTitulo();

$prestadoEncadenado = $libroEncadenado->estaPrestado();


// -------------------------------------------------------------------------
// 12. stdClass y conversión entre array y objeto
// -------------------------------------------------------------------------
// stdClass es un objeto genérico, sin clase propia.

$generico = new stdClass();

$generico->nombre = "José";

$generico->ciudad = "Santiago";

// Array -> objeto
$desdeArray = (object) [
    "producto" => "Teclado",
    "precio"   => 45990,
];

// Objeto -> array
$aArray = (array) $desdeArray;


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

    <title>Objetos PHP</title>

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


<h1>Objetos PHP</h1>


<!-- ================================================================= -->
<!-- 14. Arrays de objetos -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Arrays de objetos</h2>

    <p><strong>Todos los títulos (array_map):</strong></p>

    <?= lista($titulos) ?>

    <p><strong>Solo los disponibles (array_filter):</strong></p>

    <?= lista(array_map(fn(Libro $l) => $l->getTitulo(), $disponibles)) ?>

    <p><strong>Ordenados por páginas (usort):</strong></p>

    <?= lista($titulosOrdenados) ?>

</div>


<!-- ================================================================= -->
<!-- 15. Referencias -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Objetos por referencia</h2>

    <p>
        <code>$libroB = $libroA;</code> y luego se presta
        <code>$libroB</code>.
        ¿<code>$libroA</code> quedó prestado?
        <strong><?= si_no($prestadoVistoDesdeA) ?></strong>
    </p>

    <p>
        Se presta un libro dentro de una función.
        ¿El original quedó prestado?
        <strong><?= si_no($prestadoDespuesDeFuncion) ?></strong>
    </p>

</div>


<!-- ================================================================= -->
<!-- 16. Clonar -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Clonar objetos</h2>

    <p>
        <strong>Original:</strong>
        <?= htmlspecialchars($tituloOriginal) ?>
        (<?= htmlspecialchars($autorOriginal) ?>)
    </p>

    <p>
        <strong>Copia:</strong>
        <?= htmlspecialchars($tituloCopia) ?>
        (<?= htmlspecialchars($autorCopia) ?>)
    </p>

</div>


<!-- ================================================================= -->
<!-- 17. Comparar -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Comparar objetos</h2>

    <p>
        Dos autores distintos con el mismo nombre:
    </p>

    <ul>
        <li>
            <code>==</code> (mismos valores):
            <strong><?= si_no($igualesPorValor) ?></strong>
        </li>
        <li>
            <code>===</code> (misma instancia):
            <strong><?= si_no($mismaInstanciaXY) ?></strong>
        </li>
    </ul>

    <p>
        Una variable asignada a la otra
        (<code>$autorZ = $autorX</code>), con <code>===</code>:
        <strong><?= si_no($mismaInstanciaXZ) ?></strong>
    </p>

</div>


<!-- ================================================================= -->
<!-- 18. Información de la clase -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Información de la clase</h2>

    <ul>
        <li>
            ¿<code>$libro1</code> es un Libro?
            <strong><?= si_no($esLibro) ?></strong>
        </li>
        <li>
            ¿<code>$libro1</code> es un Autor?
            <strong><?= si_no($esAutor) ?></strong>
        </li>
        <li>
            <code>get_class()</code>:
            <strong><?= htmlspecialchars($nombreClase) ?></strong>
        </li>
        <li>
            <code>Libro::class</code>:
            <strong><?= htmlspecialchars($nombreClase2) ?></strong>
        </li>
    </ul>

</div>


<!-- ================================================================= -->
<!-- 19. Encadenar métodos -->
<!-- ================================================================= -->

<div class="caja">

    <h2>Encadenar métodos</h2>

    <p>
        <strong>Título:</strong>
        <?= htmlspecialchars($tituloEncadenado) ?>
    </p>

    <p>
        <strong>¿Prestado?</strong>
        <?= si_no($prestadoEncadenado) ?>
    </p>

</div>


<!-- ================================================================= -->
<!-- 20. stdClass -->
<!-- ================================================================= -->

<div class="caja">

    <h2>stdClass y conversiones</h2>

    <p>
        <strong>stdClass:</strong>
        <?= htmlspecialchars($generico->nombre) ?>,
        <?= htmlspecialchars($generico->ciudad) ?>
    </p>

    <p>
        <strong>Array a objeto:</strong>
        <?= htmlspecialchars($desdeArray->producto) ?>
        - $<?= number_format($desdeArray->precio, 0, ",", ".") ?>
    </p>

    <p>
        <strong>Objeto a array:</strong>
        <code><?= htmlspecialchars(json_encode($aArray)) ?></code>
    </p>

</div>

</body>

</html>