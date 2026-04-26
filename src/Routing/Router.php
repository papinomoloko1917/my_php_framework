<?php

declare(strict_types=1);

namespace App\Routing;

use RuntimeException;

class Router {
    public function __construct(
        private readonly string $path,
        private readonly string $method,
        private readonly array $routes,
    ) {
    }
    public function resolve(): Route {
        foreach ($this->routes as $route) {
            if ($route->path() === $this->path) {
                if ($route->method() === $this->method) {
                    return $route;
                } else {
                    throw new RuntimeException('405 | Метод не действителен', 405);
                }
            }
        }
        throw new RuntimeException('404 | Страница не найдена', 404);
    }
}
