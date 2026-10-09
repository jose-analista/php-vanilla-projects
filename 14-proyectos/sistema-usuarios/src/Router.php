<?php
declare(strict_types=1);

namespace App;

final class Router
{
    /** @var array<string, array<int, array{0: string, 1: array{0: class-string, 1: string}}>> */
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    private function add(string $method, string $path, array $handler): void
    {
        // /usuarios/{id}/editar  ->  #^/usuarios/(?P<id>[^/]+)/editar$#
        $pattern = '#^' . preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $path) . '$#';
        $this->routes[$method][] = [$pattern, $handler];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = $path === '/' ? '/' : rtrim($path, '/');

        foreach ($this->routes[$method] ?? [] as [$pattern, $handler]) {
            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                [$class, $action] = $handler;

                (new $class())->$action(...$params);
                return;
            }
        }

        Http::abort(404, 'La página que buscas no existe.');
    }
}
