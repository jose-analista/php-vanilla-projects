
<?php

// declare(strict_types=1);

// Datos de demostración. Más adelante se conectarán con MySQL.
$productos = [
    [
        'id' => 1,
        'nombre' => 'Audífonos inalámbricos',
        'categoria' => 'Tecnología',
        'precio' => 24990,
        'anterior' => 32990,
        'imagen' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=700&q=85',
        'etiqueta' => 'Más vendido',
    ],
    [
        'id' => 2,
        'nombre' => 'Reloj minimalista',
        'categoria' => 'Accesorios',
        'precio' => 18990,
        'anterior' => 24990,
        'imagen' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=700&q=85',
        'etiqueta' => 'Oferta',
    ],
    [
        'id' => 3,
        'nombre' => 'Zapatillas urbanas',
        'categoria' => 'Moda',
        'precio' => 39990,
        'anterior' => null,
        'imagen' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&q=85',
        'etiqueta' => 'Nuevo',
    ],
    [
        'id' => 4,
        'nombre' => 'Mochila para notebook',
        'categoria' => 'Accesorios',
        'precio' => 27990,
        'anterior' => null,
        'imagen' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=700&q=85',
        'etiqueta' => null,
    ],
];

$categorias = [
    ['nombre' => 'Tecnología', 'icono' => '💻', 'descripcion' => 'Innovación para tu día'],
    ['nombre' => 'Moda', 'icono' => '👟', 'descripcion' => 'Tu estilo, tus reglas'],
    ['nombre' => 'Accesorios', 'icono' => '⌚', 'descripcion' => 'Detalles que destacan'],
    ['nombre' => 'Hogar', 'icono' => '🏠', 'descripcion' => 'Espacios que inspiran'],
];

function escapar(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

function pesos(int $valor): string
{
    return '$' . number_format($valor, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descubre productos, ofertas y novedades en nuestra tienda online. Compra fácil y encuentra tus favoritos.">

    <title>Caytech Store | Tienda online</title>

    <!-- Tailwind CSS mediante CDN: ideal para prototipos y desarrollo local. -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#1e1b4b'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        };
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: Inter, sans-serif; }
        .product-image { transition: transform .35s ease; }
        .product-card:hover .product-image { transform: scale(1.06); }
        .product-card { transition: box-shadow .25s ease, transform .25s ease; }
        .product-card:hover { transform: translateY(-4px); }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased">

<!-- Barra de anuncio -->
<div class="bg-indigo-950 px-4 py-2.5 text-center text-xs font-medium text-white sm:text-sm">
    Envíos a todo Chile · Descubre nuestras novedades
</div>

<!-- Encabezado -->
<header class="sticky top-0 z-40 border-b border-slate-100 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">

        <a href="index.php" class="flex shrink-0 items-center gap-2.5" aria-label="Caytech Store, inicio">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-lg font-extrabold text-white">
                C
            </span>
            <span>
                <span class="block text-lg font-extrabold tracking-tight text-slate-950">caytech<span class="text-indigo-600">.</span></span>
                <span class="block text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-400">Store</span>
            </span>
        </a>

        <nav class="hidden items-center gap-7 text-sm font-medium text-slate-600 md:flex">
            <a href="#inicio" class="transition hover:text-indigo-600">Inicio</a>
            <a href="#categorias" class="transition hover:text-indigo-600">Categorías</a>
            <a href="#productos" class="transition hover:text-indigo-600">Productos</a>
            <a href="#nosotros" class="transition hover:text-indigo-600">Nosotros</a>
        </nav>

        <div class="flex items-center gap-2 sm:gap-3">
            <form action="#productos" method="get" class="hidden lg:block">
                <label for="busqueda" class="sr-only">Buscar productos</label>
                <div class="flex items-center rounded-full border border-slate-200 bg-slate-50 px-4 py-2">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke-width="2"/>
                        <path d="m16 16 4 4" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <input id="busqueda" name="q" type="search" placeholder="Buscar productos..."
                           value="<?= escapar((string) ($_GET['q'] ?? '')) ?>"
                           class="w-36 bg-transparent pl-2 text-sm outline-none placeholder:text-slate-400 xl:w-44">
                </div>
            </form>

            <button type="button" id="abrir-carrito"
                    class="relative flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 transition hover:bg-slate-50"
                    aria-label="Abrir carrito de compras">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 4h2l2.2 10.1a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 2-1.6L21 8H6"
                          stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="10" cy="20" r="1" fill="currentColor"/>
                    <circle cx="18" cy="20" r="1" fill="currentColor"/>
                </svg>
                <span id="contador-carrito" class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-indigo-600 px-1 text-[10px] font-bold text-white">0</span>
            </button>

            <button type="button" id="menu-movil"
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 md:hidden"
                    aria-label="Abrir menú" aria-expanded="false">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </div>

    <nav id="navegacion-movil" class="hidden border-t border-slate-100 bg-white px-5 py-4 md:hidden">
        <div class="flex flex-col gap-4 text-sm font-medium">
            <a href="#inicio">Inicio</a>
            <a href="#categorias">Categorías</a>
            <a href="#productos">Productos</a>
            <a href="#nosotros">Nosotros</a>
        </div>
    </nav>
</header>

<main>

    <!-- Hero -->
    <section id="inicio" class="overflow-hidden bg-slate-50">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-14 sm:px-6 sm:py-20 lg:grid-cols-2 lg:px-8 lg:py-24">

            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-3.5 py-2 text-xs font-semibold text-indigo-700 shadow-sm sm:text-sm">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Tu próxima compra comienza aquí
                </span>

                <h1 class="mt-7 max-w-xl text-4xl font-extrabold leading-[1.12] tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                    Productos que hacen tu día
                    <span class="text-indigo-600">más simple.</span>
                </h1>

                <p class="mt-6 max-w-lg text-base leading-7 text-slate-500 sm:text-lg">
                    Encuentra tecnología, accesorios y productos seleccionados para acompañarte todos los días.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#productos"
                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700">
                        Explorar productos
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#categorias"
                       class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-sm font-semibold text-slate-700 transition hover:border-indigo-200 hover:text-indigo-700">
                        Ver categorías
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-3 text-xs font-medium text-slate-500 sm:text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m5 12 4 4L19 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Compra sencilla
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 3 5 6v5c0 4.5 3 7.5 7 10 4-2.5 7-5.5 7-10V6l-7-3Z" stroke-width="1.7" stroke-linejoin="round"/>
                        </svg>
                        Pago seguro al integrar tu proveedor
                    </span>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-xl">
                <div class="absolute -right-6 -top-8 h-40 w-40 rounded-full bg-indigo-200/50 blur-3xl"></div>
                <div class="absolute -bottom-8 -left-8 h-40 w-40 rounded-full bg-purple-200/50 blur-3xl"></div>

                <div class="relative overflow-hidden rounded-3xl bg-white p-3 shadow-2xl shadow-slate-300/50">
                    <img
                        src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1100&q=90"
                        alt="Interior de una tienda con productos seleccionados"
                        class="h-72 w-full rounded-2xl object-cover sm:h-96"
                    >

                    <div class="absolute bottom-7 left-7 right-7 flex items-center justify-between gap-4 rounded-2xl border border-white/70 bg-white/95 p-4 shadow-xl backdrop-blur sm:bottom-8 sm:left-8 sm:right-8">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Descubre la selección</p>
                            <p class="mt-1 font-bold text-slate-900">Tus favoritos, en un solo lugar</p>
                        </div>
                        <a href="#productos" class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white transition hover:bg-indigo-700" aria-label="Ver productos">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios -->
    <section class="border-b border-slate-100 bg-white">
        <div class="mx-auto grid max-w-7xl grid-cols-1 divide-y divide-slate-100 px-4 sm:grid-cols-3 sm:divide-x sm:divide-y-0 sm:px-6 lg:px-8">

            <div class="flex items-center gap-4 py-6 sm:px-6 sm:py-8">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 7h11v10H3zM14 10h4l3 3v4h-7z" stroke-width="1.7" stroke-linejoin="round"/>
                        <circle cx="7" cy="19" r="2" stroke-width="1.7"/>
                        <circle cx="17" cy="19" r="2" stroke-width="1.7"/>
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Envíos a todo Chile</h2>
                    <p class="mt-1 text-xs text-slate-500">Condiciones según tu compra</p>
                </div>
            </div>

            <div class="flex items-center gap-4 py-6 sm:px-6 sm:py-8">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3 5 6v5c0 4.5 3 7.5 7 10 4-2.5 7-5.5 7-10V6l-7-3Z" stroke-width="1.7" stroke-linejoin="round"/>
                        <path d="m9 12 2 2 4-4" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Compra con confianza</h2>
                    <p class="mt-1 text-xs text-slate-500">Información clara de tus pedidos</p>
                </div>
            </div>

            <div class="flex items-center gap-4 py-6 sm:px-6 sm:py-8">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Atención cercana</h2>
                    <p class="mt-1 text-xs text-slate-500">Ayuda durante tu compra</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Categorías -->
    <section id="categorias" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">Explora la tienda</p>
                <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Compra por categoría</h2>
                <p class="mt-2 text-sm text-slate-500 sm:text-base">Encuentra rápidamente lo que necesitas.</p>
            </div>
            <a href="#productos" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">Ver todo →</a>
        </div>

        <div class="mt-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
            <?php foreach ($categorias as $categoria): ?>
                <a href="#productos"
                   data-categoria="<?= escapar($categoria['nombre']) ?>"
                   class="category-link group rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-indigo-200 hover:bg-indigo-50/50 sm:p-6">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 text-3xl transition group-hover:bg-white">
                        <?= escapar($categoria['icono']) ?>
                    </span>
                    <h3 class="mt-5 font-bold text-slate-900"><?= escapar($categoria['nombre']) ?></h3>
                    <p class="mt-1 text-xs leading-5 text-slate-500"><?= escapar($categoria['descripcion']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Productos -->
    <section id="productos" class="bg-slate-50 py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">Selección Caytech</p>
                    <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Productos destacados</h2>
                    <p class="mt-2 text-sm text-slate-500 sm:text-base">Descubre algunos de nuestros productos favoritos.</p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <label for="filtro-categoria" class="sr-only">Filtrar por categoría</label>
                    <select id="filtro-categoria" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="">Todas las categorías</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= escapar($categoria['nombre']) ?>"><?= escapar($categoria['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="orden-productos" class="sr-only">Ordenar productos</label>
                    <select id="orden-productos" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="original">Destacados</option>
                        <option value="menor">Menor precio</option>
                        <option value="mayor">Mayor precio</option>
                        <option value="nombre">Nombre A-Z</option>
                    </select>
                </div>
            </div>

            <div id="rejilla-productos" class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($productos as $producto): ?>
                    <article
                        class="product-card overflow-hidden rounded-2xl border border-slate-200/80 bg-white"
                        data-id="<?= $producto['id'] ?>"
                        data-nombre="<?= escapar($producto['nombre']) ?>"
                        data-categoria="<?= escapar($producto['categoria']) ?>"
                        data-precio="<?= $producto['precio'] ?>">

                        <div class="relative overflow-hidden bg-slate-100">
                            <img
                                src="<?= escapar($producto['imagen']) ?>"
                                alt="<?= escapar($producto['nombre']) ?>"
                                loading="lazy"
                                class="product-image h-56 w-full object-cover"
                            >

                            <?php if ($producto['etiqueta']): ?>
                                <span class="absolute left-3 top-3 rounded-full bg-white px-3 py-1.5 text-[10px] font-bold uppercase tracking-wide text-slate-800 shadow-sm">
                                    <?= escapar($producto['etiqueta']) ?>
                                </span>
                            <?php endif; ?>

                            <button
                                type="button"
                                class="agregar-carrito absolute bottom-3 right-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white text-slate-900 shadow-lg transition hover:bg-indigo-600 hover:text-white"
                                data-id="<?= $producto['id'] ?>"
                                aria-label="Agregar <?= escapar($producto['nombre']) ?> al carrito">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>

                        <div class="p-5">
                            <p class="text-xs font-medium text-slate-400"><?= escapar($producto['categoria']) ?></p>
                            <h3 class="mt-2 min-h-10 font-bold leading-5 text-slate-900">
                                <?= escapar($producto['nombre']) ?>
                            </h3>

                            <div class="mt-4 flex flex-wrap items-baseline gap-2">
                                <span class="text-lg font-extrabold text-slate-950">
                                    <?= escapar(pesos($producto['precio'])) ?>
                                </span>
                                <?php if ($producto['anterior'] !== null): ?>
                                    <span class="text-xs text-slate-400 line-through">
                                        <?= escapar(pesos($producto['anterior'])) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <button type="button"
                                    class="agregar-carrito mt-4 w-full rounded-xl border border-slate-200 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-indigo-600 hover:bg-indigo-600 hover:text-white"
                                    data-id="<?= $producto['id'] ?>">
                                Agregar al carrito
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <p id="sin-resultados" class="hidden py-12 text-center text-sm text-slate-500">
                No encontramos productos para los filtros seleccionados.
            </p>

            <p class="mt-5 text-xs text-slate-400">
                Productos, precios e imágenes de demostración. No representan una oferta comercial real.
            </p>
        </div>
    </section>

    <!-- Banner -->
    <section id="nosotros" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-indigo-950 px-6 py-12 sm:px-12 sm:py-16">
            <div class="absolute -right-10 -top-24 h-72 w-72 rounded-full bg-indigo-500/20 blur-3xl"></div>
            <div class="absolute -bottom-32 left-1/3 h-64 w-64 rounded-full bg-purple-500/20 blur-3xl"></div>

            <div class="relative flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
                <div class="max-w-2xl">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-300">Caytech Store</span>
                    <h2 class="mt-4 text-3xl font-extrabold leading-tight text-white sm:text-4xl">
                        Una mejor experiencia de compra empieza aquí.
                    </h2>
                    <p class="mt-4 max-w-xl text-sm leading-7 text-indigo-100/75 sm:text-base">
                        Un espacio para descubrir productos, comparar opciones y preparar tu próxima compra.
                    </p>
                </div>
                <a href="#productos" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-indigo-950 transition hover:bg-indigo-50">
                    Explorar catálogo
                    <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </section>

</main>

<!-- Pie de página -->
<footer class="border-t border-slate-100 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-center">
            <a href="#inicio" class="flex items-center gap-2.5">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 font-extrabold text-white">C</span>
                <span class="font-extrabold text-slate-950">caytech<span class="text-indigo-600">.</span></span>
            </a>

            <p class="text-sm text-slate-500">Una experiencia de comercio electrónico desarrollada con PHP y Tailwind CSS.</p>

            <p class="text-xs text-slate-400">© <?= date('Y') ?> Caytech Store</p>
        </div>
    </div>
</footer>

<!-- Carrito lateral de demostración -->
<div id="fondo-carrito" class="fixed inset-0 z-50 hidden bg-slate-950/40" aria-hidden="true"></div>

<aside id="panel-carrito"
       class="fixed bottom-0 right-0 top-0 z-[60] flex w-full max-w-md translate-x-full flex-col bg-white shadow-2xl transition-transform duration-300"
       role="dialog" aria-modal="true" aria-labelledby="titulo-carrito" aria-hidden="true">

    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
        <div>
            <h2 id="titulo-carrito" class="text-lg font-extrabold text-slate-950">Tu carrito</h2>
            <p id="resumen-carrito" class="mt-1 text-xs text-slate-500">0 productos</p>
        </div>
        <button id="cerrar-carrito" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200" aria-label="Cerrar carrito">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="m6 6 12 12M18 6 6 18" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    </div>

    <div id="contenido-carrito" class="flex-1 overflow-y-auto px-6 py-5">
        <div class="py-16 text-center">
            <span class="text-4xl">🛍️</span>
            <p class="mt-4 font-bold text-slate-900">Tu carrito está vacío</p>
            <p class="mt-2 text-sm text-slate-500">Agrega un producto para comenzar.</p>
        </div>
    </div>

    <div class="border-t border-slate-100 px-6 py-5">
        <div class="flex items-center justify-between">
            <span class="text-sm text-slate-500">Subtotal</span>
            <span id="total-carrito" class="text-xl font-extrabold text-slate-950">$0</span>
        </div>
        <p class="mt-2 text-xs leading-5 text-slate-400">Los costos de envío e impuestos, si corresponden, se calcularán al confirmar la compra.</p>
        <button id="finalizar-compra" type="button" class="mt-5 w-full rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-indigo-700">
            Continuar compra
        </button>
        <p class="mt-3 text-center text-xs text-slate-400">Carrito de demostración, sin pagos reales.</p>
    </div>
</aside>

<div id="notificacion" class="pointer-events-none fixed bottom-5 left-1/2 z-[70] -translate-x-1/2 translate-y-4 rounded-xl bg-slate-950 px-5 py-3 text-sm font-medium text-white opacity-0 shadow-xl transition-all duration-200" role="status" aria-live="polite"></div>

<script>
    // Catálogo recibido desde PHP. El servidor seguirá siendo responsable
    // de validar precios, stock y pedidos cuando se integre una base de datos.
    const productos = <?= json_encode(
        $productos,
        JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
    ) ?>;

    const mapaProductos = new Map(productos.map(producto => [producto.id, producto]));
    const carrito = new Map();

    const panelCarrito = document.getElementById('panel-carrito');
    const fondoCarrito = document.getElementById('fondo-carrito');
    const contenidoCarrito = document.getElementById('contenido-carrito');
    const contadorCarrito = document.getElementById('contador-carrito');
    const totalCarrito = document.getElementById('total-carrito');
    const resumenCarrito = document.getElementById('resumen-carrito');
    const notificacion = document.getElementById('notificacion');

    let temporizadorNotificacion;

    function formatoPesos(valor) {
        return new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP',
            maximumFractionDigits: 0
        }).format(valor);
    }

    function escaparHTML(texto) {
        return String(texto).replace(/[&<>"']/g, caracter => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[caracter]);
    }

    function notificar(mensaje) {
        notificacion.textContent = mensaje;
        notificacion.classList.remove('translate-y-4', 'opacity-0');
        notificacion.classList.add('translate-y-0', 'opacity-100');

        clearTimeout(temporizadorNotificacion);
        temporizadorNotificacion = setTimeout(() => {
            notificacion.classList.add('translate-y-4', 'opacity-0');
            notificacion.classList.remove('translate-y-0', 'opacity-100');
        }, 2200);
    }

    function agregarProducto(id) {
        const producto = mapaProductos.get(Number(id));

        if (!producto) {
            notificar('No se encontró el producto.');
            return;
        }

        const cantidadActual = carrito.get(producto.id) || 0;
        carrito.set(producto.id, cantidadActual + 1);

        renderizarCarrito();
        notificar(producto.nombre + ' agregado al carrito.');
    }

    function cambiarCantidad(id, cambio) {
        const cantidad = (carrito.get(id) || 0) + cambio;

        if (cantidad <= 0) {
            carrito.delete(id);
        } else {
            carrito.set(id, cantidad);
        }

        renderizarCarrito();
    }

    function renderizarCarrito() {
        let unidades = 0;
        let total = 0;

        carrito.forEach((cantidad, id) => {
            const producto = mapaProductos.get(id);
            if (!producto) return;

            unidades += cantidad;
            total += producto.precio * cantidad;
        });

        contadorCarrito.textContent = unidades > 99 ? '99+' : unidades;
        resumenCarrito.textContent = unidades + (unidades === 1 ? ' producto' : ' productos');
        totalCarrito.textContent = formatoPesos(total);

        if (carrito.size === 0) {
            contenidoCarrito.innerHTML = `
                <div class="py-16 text-center">
                    <span class="text-4xl">🛍️</span>
                    <p class="mt-4 font-bold text-slate-900">Tu carrito está vacío</p>
                    <p class="mt-2 text-sm text-slate-500">Agrega un producto para comenzar.</p>
                </div>`;
            return;
        }

        contenidoCarrito.innerHTML = Array.from(carrito.entries()).map(([id, cantidad]) => {
            const producto = mapaProductos.get(id);

            return `
                <article class="flex gap-4 border-b border-slate-100 py-4">
                    <img src="${escaparHTML(producto.imagen)}"
                         alt="${escaparHTML(producto.nombre)}"
                         class="h-24 w-24 rounded-xl bg-slate-100 object-cover">

                    <div class="min-w-0 flex-1">
                        <h3 class="font-bold text-slate-900">${escaparHTML(producto.nombre)}</h3>
                        <p class="mt-1 text-sm font-semibold text-indigo-600">${formatoPesos(producto.precio)}</p>

                        <div class="mt-3 flex items-center gap-3">
                            <button type="button" data-accion="restar" data-id="${id}"
                                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200"
                                    aria-label="Reducir cantidad">−</button>
                            <span class="text-sm font-semibold">${cantidad}</span>
                            <button type="button" data-accion="sumar" data-id="${id}"
                                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200"
                                    aria-label="Aumentar cantidad">+</button>
                            <button type="button" data-accion="eliminar" data-id="${id}"
                                    class="ml-auto text-xs font-medium text-rose-600 hover:text-rose-800">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </article>`;
        }).join('');
    }

    function abrirCarrito() {
        panelCarrito.classList.remove('translate-x-full');
        fondoCarrito.classList.remove('hidden');
        panelCarrito.setAttribute('aria-hidden', 'false');
        fondoCarrito.setAttribute('aria-hidden', 'false');
        document.getElementById('cerrar-carrito').focus();
    }

    function cerrarCarrito() {
        panelCarrito.classList.add('translate-x-full');
        fondoCarrito.classList.add('hidden');
        panelCarrito.setAttribute('aria-hidden', 'true');
        fondoCarrito.setAttribute('aria-hidden', 'true');
        document.getElementById('abrir-carrito').focus();
    }

    document.querySelectorAll('.agregar-carrito').forEach(boton => {
        boton.addEventListener('click', () => agregarProducto(boton.dataset.id));
    });

    document.getElementById('abrir-carrito').addEventListener('click', abrirCarrito);
    document.getElementById('cerrar-carrito').addEventListener('click', cerrarCarrito);
    fondoCarrito.addEventListener('click', cerrarCarrito);

    document.addEventListener('keydown', evento => {
        if (evento.key === 'Escape' && panelCarrito.getAttribute('aria-hidden') === 'false') {
            cerrarCarrito();
        }
    });

    contenidoCarrito.addEventListener('click', evento => {
        const boton = evento.target.closest('button[data-accion]');
        if (!boton) return;

        const id = Number(boton.dataset.id);
        const accion = boton.dataset.accion;

        if (accion === 'sumar') cambiarCantidad(id, 1);
        if (accion === 'restar') cambiarCantidad(id, -1);

        if (accion === 'eliminar') {
            carrito.delete(id);
            renderizarCarrito();
            notificar('Producto eliminado del carrito.');
        }
    });

    document.getElementById('finalizar-compra').addEventListener('click', () => {
        if (carrito.size === 0) {
            notificar('Agrega productos antes de continuar.');
            return;
        }

        notificar('El checkout se implementará en la siguiente etapa.');
    });

    // Filtros de categoría y orden de precios.
    const filtroCategoria = document.getElementById('filtro-categoria');
    const ordenProductos = document.getElementById('orden-productos');
    const rejillaProductos = document.getElementById('rejilla-productos');
    const tarjetas = Array.from(rejillaProductos.querySelectorAll('.product-card'));

    function actualizarCatalogo() {
        const categoria = filtroCategoria.value;
        const orden = ordenProductos.value;

        let visibles = tarjetas.filter(tarjeta => {
            return !categoria || tarjeta.dataset.categoria === categoria;
        });

        visibles.sort((a, b) => {
            const precioA = Number(a.dataset.precio);
            const precioB = Number(b.dataset.precio);

            if (orden === 'menor') return precioA - precioB;
            if (orden === 'mayor') return precioB - precioA;
            if (orden === 'nombre') {
                return a.dataset.nombre.localeCompare(b.dataset.nombre, 'es');
            }

            return Number(a.dataset.id) - Number(b.dataset.id);
        });

        tarjetas.forEach(tarjeta => {
            tarjeta.classList.add('hidden');
        });

        visibles.forEach(tarjeta => {
            tarjeta.classList.remove('hidden');
            rejillaProductos.appendChild(tarjeta);
        });

        document.getElementById('sin-resultados')
            .classList.toggle('hidden', visibles.length > 0);
    }

    filtroCategoria.addEventListener('change', actualizarCatalogo);
    ordenProductos.addEventListener('change', actualizarCatalogo);

    document.querySelectorAll('.category-link').forEach(enlace => {
        enlace.addEventListener('click', () => {
            filtroCategoria.value = enlace.dataset.categoria;
            actualizarCatalogo();
        });
    });

    // Búsqueda básica por nombre y categoría.
    const parametros = new URLSearchParams(window.location.search);
    const busquedaInicial = (parametros.get('q') || '').trim().toLocaleLowerCase('es');

    if (busquedaInicial) {
        tarjetas.forEach(tarjeta => {
            const coincide = (
                tarjeta.dataset.nombre + ' ' + tarjeta.dataset.categoria
            ).toLocaleLowerCase('es').includes(busquedaInicial);

            tarjeta.classList.toggle('hidden', !coincide);
        });

        document.getElementById('sin-resultados')
            .classList.toggle('hidden', tarjetas.some(tarjeta => !tarjeta.classList.contains('hidden')));

        document.getElementById('productos').scrollIntoView();
    }

    // Menú móvil.
    const botonMenu = document.getElementById('menu-movil');
    const navegacionMovil = document.getElementById('navegacion-movil');

    botonMenu.addEventListener('click', () => {
        const estaCerrado = navegacionMovil.classList.toggle('hidden');
        botonMenu.setAttribute('aria-expanded', String(!estaCerrado));
    });

    navegacionMovil.querySelectorAll('a').forEach(enlace => {
        enlace.addEventListener('click', () => {
            navegacionMovil.classList.add('hidden');
            botonMenu.setAttribute('aria-expanded', 'false');
        });
    });

    renderizarCarrito();
</script>

</body>
</html>
