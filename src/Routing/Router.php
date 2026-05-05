<?php

declare(strict_types=1);

namespace App\Routing;

use App\Routing\Route;
use RuntimeException;

class Router {
    public function __construct(
        public string $path,
        public string $method,
        public array $routes,
    ) {
    }

    public function resolve(): Route {
        $pathExists = false;
        foreach ($this->routes as $route) {
            if ($route->path() === $this->path) {
                $pathExists = true;
                if ($route->method() === $this->method) {
                    return $route;
                }
            }
        }
        if ($pathExists === true) {
            throw new RuntimeException('405 | Метод не действителен', 405);
        } else {
            throw new RuntimeException('404 | Страница не найдена', 404);
        }
    }
}
