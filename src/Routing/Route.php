<?php

declare(strict_types=1);

namespace App\Routing;

use Closure;

class Route {
    public function __construct(
        private readonly string $path,
        private readonly string $method,
        private readonly mixed $handler,
    ) {
    }
    public static function get(string $path, $handler): self {
        return new self($path, 'GET', $handler);
    }
    public static function post(string $path, $handler): self {
        return new self($path, 'POST', $handler);
    }
    public function path(): string {
        return $this->path;
    }
    public function method(): string {
        return $this->method;
    }
    public function handler(): array|Closure {
        return $this->handler;
    }
}
