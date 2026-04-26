<?php

declare(strict_types=1);

namespace App\Response;

class Response {
    public function __construct(
        private readonly string $body,
        private readonly int $statusCode = 200
    ) {
    }
    public function send(): void {
        http_response_code($this->statusCode);
        echo $this->body;
    }
}
