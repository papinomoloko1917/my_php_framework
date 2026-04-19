<?php

declare(strict_types=1);

namespace App\Container;

use App\Dispatcher\Dispatcher;
use App\Request\Request;
use App\Routing\Router;
use App\View\View;

final class Container {
    public readonly Request $request;
    public readonly Router $router;
    public readonly Dispatcher $dispatcher;
    public readonly View $view;
    public function __construct() {
        $this->registerServices();
    }
    private function registerServices(): void {
        $this->request = Request::createFromGlobals();

        $routes = require BASE_DIR . '/routes/web.php';

        $this->router = new Router(
            $this->request->path(),
            $this->request->method(),
            $routes
        );

        $this->view = new View();

        $this->dispatcher = new Dispatcher($this->view);
    }
}
