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
                ->dispatch($targetRoute);
            if ($content instanceof Response) {
                $response = $content;
            } else {
                $response = Response::html($content);
            }
        } catch (Throwable $e) {
            $response = $this->container
                ->exceptionHandler
                ->handle($e);
        }
        $response->send();
    }
}
