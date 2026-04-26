<?php

declare(strict_types=1);

namespace App;

use App\Container\Container;
use App\Response\Response;
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
            $content = $this->container
                ->dispatcher
                ->dispatch(
                    $targetRoute,
                    $this->container->view
                );
            $response = new Response($content);
        } catch (Throwable $e) {
            if ($e->getCode() >= 100 && $e->getCode() <= 599) {
                $response = new Response($e->getMessage(), $e->getCode());
            } else {
                $response = new Response($e->getMessage(), 500);
            }
        }
        $response->send();
    }
}
