<?php

declare(strict_types=1);

namespace App\Dispatcher;

use App\Database\Database;
use App\Request\Request;
use App\Routing\Route;
use App\View\View;
use Closure;

class Dispatcher {
    public function dispatch(Route $route, View $view, Request $request, Database $database): string {
        if ($route->handler() instanceof Closure) {
            return $route->handler()();
        } else {
            [$handler, $method] = $route->handler();
            $controller = new $handler(
                $view,
                $request,
                $database,
            );
            return $controller->$method();
        }
    }
}
