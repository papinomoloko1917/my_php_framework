<?php

declare(strict_types=1);

namespace App;

use App\Container\Container;
use Throwable;

class App {
    private Container $container;
    public function __construct() {
        $this->container = new Container();
    }
    public function run(): void {
        try {
            $targetRoute = $this->container
                ->router
                ->resolve();
            echo $this->container
                ->dispatcher
                ->dispatch($targetRoute);
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}
