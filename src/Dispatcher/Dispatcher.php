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
    public function dispatch(
        Route $route,
        View $view,
        Request $request,
        Database $database,
        RegisterValidator $registerValidator,
        LoginValidator $loginValidator,
    ): string|Response {
        if ($route->handler() instanceof Closure) {
            return $route->handler()();
        } else {
            [$handler, $method] = $route->handler();

            if ($handler === RegisterController::class) {
                $controller = new $handler(
                    $view,
                    $request,
                    $database,
                    $registerValidator,
                );
                return $controller->$method();
            }
            if ($handler === LoginController::class) {
                $controller = new $handler(
                    $view,
                    $request,
                    $database,
                    $loginValidator,
                );
                return $controller->$method();
            }
            $controller = new $handler(
                $view,
                $request,
                $database,
            );
            return $controller->$method();
        }
    }
}
