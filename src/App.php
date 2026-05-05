<?php

declare(strict_types=1);

namespace App;

use App\Container\Container;
use App\Response\Response;
use Throwable;

class App {
    private readonly Container $container;
    public function __construct() {
        $this->container = new Container();
    }
    public function run() {
        try {
            $targetRoute = $this->container
                ->router
                ->resolve();
            $content = $this->container
                ->dispatcher
                ->dispatch(
                    $targetRoute,
                    $this->container->view,
                    $this->container->request,
                );
            $response = Response::html($content);
        } catch (Throwable $e) {
            if ($e->getCode() >= 100 && $e->getCode() <= 599) {
                $response = Response::html($e->getMessage(), $e->getCode());
            } else {
                $response = Response::html($e->getMessage(), 500);
            }
        }
        $response->send();
    }
}
