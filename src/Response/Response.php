<?php

declare(strict_types=1);

namespace App\Response;

class Response {
    public function __construct(
        private readonly string $body = '',
        private readonly int $statusCode = 200,
        private readonly array $headers = [],
    ) {
    }
    public function send() {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }
        echo $this->body;
    }
    public static function html(string $body, int $statusCode = 200): self {
        return new self($body, $statusCode, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
    public static function redirect(string $path): self {
        return new self('', 302, ['Location' => $path,]);
    }
}
