<?php

declare(strict_types=1);

namespace App\Container;

use App\Dispatcher\Dispatcher;
use App\Request\Request;
use App\Routing\Router;

final class Container {
    public readonly Request $request;
    public readonly Router $router;
    public readonly Dispatcher $dispatcher;
    public function __construct() {
        $this->registerServices();
    }
    private function registerServices(): void {
        $this->request = Request::createFromGlobals();

        $routes = require BASE_DIR . '/routes/web.php';

        $this->router = new Router($this->request->path(), $this->request->method(), $routes);

        $this->dispatcher = new Dispatcher();
    }
}
