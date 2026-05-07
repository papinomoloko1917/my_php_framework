<?php

declare(strict_types=1);

namespace App\Dispatcher;

use App\Database\Database;
use App\Request\Request;
use App\Routing\Route;
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
    ): string {
        if ($route->handler() instanceof Closure) {
            return $route->handler()();
        } else {
            [$handler, $method] = $route->handler();
            // TODO подумать в дальнейшем над тем как передать $registerValidator только в RegisterController
            $controller = new $handler(
                $view,
                $request,
                $database,
                $registerValidator,
            );
            return $controller->$method();
        }
    }
}
