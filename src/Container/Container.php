<?php

declare(strict_types=1);

namespace App\Container;

use App\Dispatcher\Dispatcher;
use App\Request\Request;
use App\Routing\Router;

final class Container {
    private readonly ?Router $router;
    private readonly ?Dispatcher $dispatcher;
    public function __construct(
        private readonly Request $request,
        private readonly array $routes
    ) {
    }
    public function dispatcher(): Dispatcher {
        $this->dispatcher = new Dispatcher();
        return $this->dispatcher;
    }
    public function router(): Router {
        $this->router = new Router($this->request, $this->routes);
        return $this->router;
    }
}
