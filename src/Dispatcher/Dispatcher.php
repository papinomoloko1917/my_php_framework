<?php

declare(strict_types=1);

namespace App\Dispatcher;

use App\Factory\ControllerFactory;
use App\Middleware\Resolver\MiddlewareResolver;
use App\Response\Response;
use App\Routing\Route;
use Closure;

class Dispatcher {
    public function __construct(
        private readonly ControllerFactory $controllerFactory,
        private readonly MiddlewareResolver $middlewareResolver,
    ) {
    }

    public function dispatch(Route $route): string|Response {
        if ($route->handler() instanceof Closure) {
            return $route->handler()();
        } else {
            [$handler, $method] = $route->handler();

            $response = $this->middlewareResolver->run($route->middlewareList());

            if ($response instanceof Response) {
                return $response;
            }

            $controller = $this->controllerFactory->make($handler);

            return $controller->$method();
        }
    }
}
