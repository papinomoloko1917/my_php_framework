<?php

declare(strict_types=1);

namespace App\Request;

class Request {
    public function __construct(
        private string $uri,
        private string $method,
        private string $path,
        private array $post,
    ) {
    }
    public static function createFromGlobals(): self {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $rawPath = parse_url($uri, PHP_URL_PATH) ?? '/';
        if (!$rawPath) {
            $rawPath = '/';
        }
        $rawPath = rtrim($rawPath, '/');
        $path = $rawPath ?: '/';

        $post = $_POST ?? [];

        return new self(
            uri: $uri,
            method: $method,
            path: $path,
            post: $post,
        );
    }
    public function uri(): string {
        return $this->uri;
    }
    public function method(): string {
        return $this->method;
    }
    public function path(): string {
        return $this->path;
    }
    public function input(string $name): ?string {
        if (isset($this->post[$name])) {
            return $this->post[$name];
        }
        return null;
    }
}
