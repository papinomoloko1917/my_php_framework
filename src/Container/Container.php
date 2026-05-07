<?php

declare(strict_types=1);

namespace App\Container;

use App\Database\Database;
use App\Dispatcher\Dispatcher;
use App\Request\Request;
use App\Routing\Router;
use App\View\View;

class Container {
    public readonly Request $request;
    public readonly Router $router;
    public readonly Dispatcher $dispatcher;
    public readonly View $view;
    public readonly Database $database;

    public function __construct() {
        $this->registerServices();
    }
    private function registerServices(): void {
        $routes = require BASE_DIR . '/routes/web.php';

        $this->request = Request::createFromGlobals();

        $this->router = new Router(
            $this->request->path(),
            $this->request->method(),
            $routes,
        );
        $this->dispatcher = new Dispatcher();
        $this->view = new View();

        $this->database = new Database();
    }
}
