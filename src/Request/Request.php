<?php

declare(strict_types=1);

namespace App\Request;

final class Request {
    public function __construct(
        private readonly string $uri,
        private readonly string $method,
        private readonly string $path,
    ) {
    }
    public static function createFromGlobals(): self {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $rawPath = rtrim(parse_url($uri, PHP_URL_PATH), '/');
        $path = $rawPath ?: '/';

        return new self(
            uri: $uri,
            method: $method,
            path: $path,
        );
    }
}
