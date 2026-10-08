# 08 - Programación Orientada a Objetos (POO)

Ejercicios de **POO en PHP**: clases y objetos, encapsulamiento, herencia, clases abstractas, interfaces y traits.

## Contenido

- [Archivos](#archivos)
- [Cómo ejecutar](#cómo-ejecutar)
- [Clases y objetos](#clases-y-objetos)
- [Encapsulamiento](#encapsulamiento)
- [Herencia](#herencia)
- [Clases abstractas](#clases-abstractas)
- [Interfaces](#interfaces)
- [Traits](#traits)
- [Herencia vs interfaces vs traits](#herencia-vs-interfaces-vs-traits)
- [Polimorfismo](#polimorfismo)
- [Buenas prácticas](#buenas-prácticas)

## Archivos

| Archivo | Descripción |
|---|---|
| `01-clases.php` | Clases, objetos, constructor, visibilidad, `readonly`, `static` y `__toString()` |
| `02-herencia.php` | `extends`, `protected`, `parent::`, sobrescritura y clases abstractas |
| `03-interfaces.php` | `interface`, `implements` y polimorfismo |
| `04-traits.php` | `trait`, `use` y resolución de conflictos |

> Ajusta esta tabla si tus archivos tienen otros nombres.

## Cómo ejecutar

Desde la raíz del repositorio:

```bash
php -S localhost:8000
```

Luego abre en el navegador, por ejemplo:

```
http://localhost:8000/08-poo/01-clases.php
```

## Clases y objetos

Una **clase** es un molde. Un **objeto** es una copia creada a partir de ese molde con `new`.

```php
class Persona
{
    public string $nombre;
    public int $edad;

    public function __construct(string $nombre, int $edad)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function saludar(): string
    {
        return "Hola, me llamo {$this->nombre}.";
    }
}

$persona = new Persona("José", 30);

echo $persona->saludar();
```

| Concepto | Descripción |
|---|---|
| Propiedad | Variable que pertenece al objeto |
| Método | Función que pertenece al objeto |
| `$this` | Referencia al objeto actual |
| `__construct()` | Se ejecuta automáticamente al hacer `new` |
| `->` | Accede a propiedades y métodos de un objeto |
| `::` | Accede a constantes y miembros `static` de una clase |

### Promoción de propiedades (PHP 8)

Declarar la visibilidad en el constructor crea la propiedad y le asigna el valor:

```php
class Producto
{
    public function __construct(
        public readonly string $nombre,
        public readonly float $precio
    ) {
    }
}
```

`readonly` permite asignar la propiedad una sola vez; después no se puede cambiar.

## Encapsulamiento

Consiste en ocultar los datos internos y controlar cómo se modifican.

| Visibilidad | Acceso |
|---|---|
| `public` | Desde cualquier lugar |
| `protected` | Desde la clase y sus clases hijas |
| `private` | Solo desde la propia clase |

```php
class CuentaBancaria
{
    private float $saldo = 0;

    public function depositar(float $monto): bool
    {
        if ($monto <= 0) {
            return false;
        }

        $this->saldo += $monto;

        return true;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}
```

El saldo no se puede cambiar directamente: solo a través de los métodos, que aplican las reglas.

## Herencia

Una clase hija puede **heredar** las propiedades y métodos de una clase padre con `extends`, y reutilizar su código.

```php
class Animal
{
    public function __construct(protected string $nombre)
    {
    }

    public function hablar(): string
    {
        return "{$this->nombre} hace un sonido.";
    }
}

class Perro extends Animal
{
    // Sobrescribe el método del padre
    public function hablar(): string
    {
        return "{$this->nombre} dice: ¡Guau!";
    }

    public function jugar(): string
    {
        return "{$this->nombre} juega con la pelota.";
    }
}

class Gato extends Animal
{
    public function hablar(): string
    {
        // Reutiliza el método del padre y le agrega algo
        return parent::hablar() . " Miau.";
    }
}
```

| Concepto | Descripción |
|---|---|
| `extends` | La clase hija hereda de la clase padre |
| `protected` | Visible en la clase padre y en las hijas |
| `parent::` | Llama a un método o constructor del padre |
| Sobrescritura | La hija redefine un método del padre |
| `final` | Impide heredar de una clase o sobrescribir un método |

Una clase solo puede heredar de **una** clase padre.

La herencia expresa una relación "es un": un `Perro` **es un** `Animal`. Si la relación no es esa, probablemente no conviene usar herencia.

## Clases abstractas

Una clase `abstract` no se puede instanciar. Sirve como base para otras y puede obligar a las hijas a implementar ciertos métodos.

```php
abstract class Figura
{
    // Las hijas DEBEN implementarlo
    abstract public function area(): float;

    // Método común ya implementado
    public function describir(): string
    {
        return "Esta figura tiene un área de " . $this->area();
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
}

// $figura = new Figura();  // Error: no se puede instanciar una clase abstracta
```

## Interfaces

Una **interfaz** define un contrato: qué métodos debe tener una clase, pero no cómo funcionan. No contiene código ni propiedades, solo firmas de métodos y constantes.

```php
interface Pagable
{
    public function pagar(float $monto): string;
}

class TarjetaCredito implements Pagable
{
    public function pagar(float $monto): string
    {
        return "Pagado $monto con tarjeta de crédito.";
    }
}

class Transferencia implements Pagable
{
    public function pagar(float $monto): string
    {
        return "Pagado $monto por transferencia.";
    }
}
```

Una clase puede implementar **varias** interfaces, separadas por coma:

```php
class Pedido implements Pagable, JsonSerializable
{
    // Debe implementar los métodos de ambas interfaces
}
```

Una interfaz puede extender otra con `extends`.

```php
$metodo = new TarjetaCredito();

var_dump($metodo instanceof Pagable);  // true
```

| Concepto | Descripción |
|---|---|
| `interface` | Define el contrato (solo firmas) |
| `implements` | La clase se compromete a cumplir el contrato |
| Métodos | Siempre `public` y sin cuerpo |
| `instanceof` | Comprueba si un objeto es de una clase o implementa una interfaz |
| Múltiples | Una clase puede implementar varias interfaces |

La interfaz expresa una relación "puede hacer": una `TarjetaCredito` **puede** pagar.

## Traits

Un **trait** es un conjunto de métodos y propiedades que se puede **reutilizar en varias clases** sin usar herencia. Resuelve el problema de que una clase solo puede tener un padre.

```php
trait Registrable
{
    private array $registros = [];

    public function registrar(string $mensaje): void
    {
        $this->registros[] = date("H:i:s") . " - " . $mensaje;
    }

    public function getRegistros(): array
    {
        return $this->registros;
    }
}

class Usuario
{
    use Registrable;
}

class Pedido
{
    use Registrable;
}

$usuario = new Usuario();

$usuario->registrar("Usuario creado");
```

`Usuario` y `Pedido` no tienen relación entre sí, pero ambos reciben la funcionalidad de registro.

### Varios traits y conflictos

Una clase puede usar varios traits. Si dos traits tienen un método con el mismo nombre, hay que resolver el conflicto:

```php
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

class Persona
{
    use Hablar, Educado {
        Educado::saludar insteadof Hablar;   // Usa el de Educado
        Hablar::saludar as saludoInformal;   // Alias para el otro
    }
}
```

### Métodos abstractos en un trait

Un trait puede exigir que la clase que lo usa implemente un método:

```php
trait Describible
{
    abstract public function getNombre(): string;

    public function describir(): string
    {
        return "Este objeto se llama " . $this->getNombre();
    }
}
```

| Concepto | Descripción |
|---|---|
| `trait` | Bloque de código reutilizable |
| `use` | Incluye el trait dentro de una clase |
| `insteadof` | Elige qué método usar cuando hay conflicto |
| `as` | Crea un alias o cambia la visibilidad de un método |
| Instanciar | Un trait **no** se puede instanciar directamente |

## Herencia vs interfaces vs traits

| | Herencia | Interfaz | Trait |
|---|---|---|---|
| Palabra clave | `extends` | `implements` | `use` |
| Contiene código | Sí | No (solo firmas) | Sí |
| Cantidad por clase | Solo una | Varias | Varios |
| Relación | "es un" | "puede hacer" | "reutiliza código" |
| Sirve para | Jerarquías de clases | Definir contratos | Compartir código entre clases sin relación |
| Se puede instanciar | Sí (la clase padre normal) | No | No |

Se pueden combinar: una clase puede heredar de un padre, implementar interfaces y usar traits al mismo tiempo.

```php
class Pedido extends Documento implements Pagable
{
    use Registrable;
}
```

## Polimorfismo

Permite tratar objetos distintos de la misma forma, siempre que compartan una clase padre o una interfaz.

```php
function procesarPago(Pagable $metodo, float $monto): string
{
    return $metodo->pagar($monto);
}

echo procesarPago(new TarjetaCredito(), 50000);
echo procesarPago(new Transferencia(), 50000);
```

La función no necesita saber qué tipo de pago recibe, solo que cumple el contrato `Pagable`.

## Buenas prácticas

- Usar nombres de clase en `PascalCase` y un archivo por clase
- Declarar propiedades como `private` y exponerlas con métodos solo cuando haga falta
- Usar `protected` solo cuando las clases hijas realmente lo necesiten
- Tipar propiedades, parámetros y retornos
- Preferir interfaces y composición antes que cadenas largas de herencia
- Usar herencia solo cuando la relación sea realmente "es un"
- Usar traits para compartir código sin relación entre clases, sin abusar de ellos
- Marcar con `final` las clases que no deben ser extendidas
- Usar `readonly` en datos que no deben cambiar

## Autor

**José Calderón** — Analista Programador

- GitHub: [jose-analista](https://github.com/jose-analista)