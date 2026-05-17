<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Response\Response;

interface MiddlewareInterface {
    public function handle(): ?Response;
}
