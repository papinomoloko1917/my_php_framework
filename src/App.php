<?php

declare(strict_types=1);

namespace App;

use App\Dispatcher\Dispatcher;
use App\Routing\Router;
use Throwable;

class App {
    public function __construct(
        private readonly Router $router,
        private readonly Dispatcher $dispatcher
    ) {
    }
    public function run(): void {
        try {
            $targetRoute = $this->router->resolve();
            echo $this->dispatcher->dispatch($targetRoute);
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}
