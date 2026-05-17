<?php

declare(strict_types=1);

namespace App\Routing;

use Closure;

class Route {
    public function __construct(
        private string $path,
        private string $method,
        private Closure|array $handler,
        private array $middleware = [],
    ) {
    }
    public static function get(string $path, Closure|array $handler): self {
        return new self($path, 'GET', $handler);
    }
    public static function post(string $path, Closure|array $handler): self {
        return new self($path, 'POST', $handler);
    }
    public function path(): string {
        return $this->path;
    }
    public function method(): string {
        return $this->method;
    }
    public function handler(): Closure|array {
        return $this->handler;
    }
    public function middleware(array $middleware): self {
        $this->middleware = $middleware;
        return $this;
    }
    public function middlewareList(): array {
        return $this->middleware;
    }
}
