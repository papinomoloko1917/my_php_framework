<?php

declare(strict_types=1);

namespace App\Middleware\Resolver;

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\MiddlewareInterface;
use App\Response\Response;
use RuntimeException;

class MiddlewareResolver {
    private array $middlewareAliases = [
        'auth' => AuthMiddleware::class,
        'guest' => GuestMiddleware::class,
    ];
    public function run(array $middlewareList): ?Response {
        foreach ($middlewareList as $middleware) {
            $middlewareClass = $this->middlewareAliases[$middleware] ?? $middleware;
            $middlewareObject = new $middlewareClass();
            if (!$middlewareObject instanceof MiddlewareInterface) {
                throw new RuntimeException('Invalid middleware');
            }
            $response = $middlewareObject->handle();

            if ($response instanceof Response) {
                return $response;
            }
        }
        return null;
    }
}
