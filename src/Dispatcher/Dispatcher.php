<?php

declare(strict_types=1);

namespace App\Dispatcher;

use App\Controller\Auth\LoginController;
use App\Controller\Auth\RegisterController;
use App\Database\Database;
use App\Request\Request;
use App\Response\Response;
use App\Routing\Route;
use App\Validation\LoginValidator;
use App\Validation\RegisterValidator;
use App\View\View;
use Closure;

class Dispatcher {
    public function __construct(
        private readonly View $view,
        private readonly Request $request,
        private readonly Database $database,
        private readonly RegisterValidator $registerValidator,
        private readonly LoginValidator $loginValidator,
    ) {
    }
    public function dispatch(Route $route): string|Response {
        if ($route->handler() instanceof Closure) {
            return $route->handler()();
        } else {
            [$handler, $method] = $route->handler();

            if ($handler === RegisterController::class) {
                $controller = new $handler(
                    $this->view,
                    $this->request,
                    $this->database,
                    $this->registerValidator,
                );
                return $controller->$method();
            }
            if ($handler === LoginController::class) {
                $controller = new $handler(
                    $this->view,
                    $this->request,
                    $this->database,
                    $this->loginValidator,
                );
                return $controller->$method();
            }
            $controller = new $handler(
                $this->view,
                $this->request,
                $this->database,
            );
            return $controller->$method();
        }
    }
}
