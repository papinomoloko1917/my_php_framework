<?php

declare(strict_types=1);

namespace App\Routing;

use App\Request\Request;
use RuntimeException;

class Router {
    public function __construct(
        private readonly Request $request,
        private readonly array $routes,
    ) {
    }
    public function resolve(): Route {
        foreach ($this->routes as $route) {
            if ($route->path() === $this->request->path()) {
                if ($route->method() === $this->request->method()) {
                    return $route;
                } else {
                    http_response_code(405);
                    throw new RuntimeException('405 | Метод не действителен');
                }
            }
        }
        http_response_code(404);
        throw new RuntimeException('404 | Страница не найдена');
    }
}
