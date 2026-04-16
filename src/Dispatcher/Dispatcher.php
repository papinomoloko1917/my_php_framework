<?php

declare(strict_types=1);

namespace App\Dispatcher;

use App\Routing\Route;
use RuntimeException;

class Dispatcher {
    public function dispatch(Route $targetRoute): string {
        $handler = $targetRoute->handler();
        if (is_callable($handler)) {
            return (string) $handler();
        } else if (count($handler) == 2) {
            [$classController, $methodController] = $handler;
            if (!class_exists($classController)) {
                throw new RuntimeException("Данный класс контроллера - {$classController}, не найден");
            }
            if (!method_exists($classController, $methodController)) {
                throw new RuntimeException("Данный метод контроллера - {$methodController}, не найден");
            }
            $controller = new $classController();
            return (string) $controller->$methodController();
        }
    }
}
