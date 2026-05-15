<?php

declare(strict_types=1);

namespace App\Container;

use App\Database\Database;
use App\Dispatcher\Dispatcher;
use App\Request\Request;
use App\Routing\Router;
use App\Validation\LoginValidator;
use App\Validation\RegisterValidator;
use App\View\View;

class Container {
    public readonly Request $request;
    public readonly Router $router;
    public readonly Dispatcher $dispatcher;
    public readonly View $view;
    public readonly Database $database;
    public readonly RegisterValidator $registerValidator;
    public readonly LoginValidator $loginValidator;

    public function __construct() {
        $this->registerServices();
    }
    private function registerServices(): void {
        $routes = require BASE_DIR . '/routes/web.php';

        $this->router = new Router(
            $this->request->path(),
            $this->request->method(),
            $routes,
        );

        $this->view = new View();

        $this->request = Request::createFromGlobals();

        $this->database = new Database();

        $this->registerValidator = new RegisterValidator();

        $this->loginValidator = new LoginValidator();

        $this->dispatcher = new Dispatcher(
            $this->view,
            $this->request,
            $this->database,
            $this->registerValidator,
            $this->loginValidator,
        );
    }
}
