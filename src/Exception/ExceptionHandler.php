<?php

declare(strict_types=1);

namespace App\Exception;

use App\Response\Response;
use App\View\View;
use Throwable;

final class ExceptionHandler {
    public function __construct(
        private readonly View $view
    ) {
    }
    public function handle(Throwable $e): Response {
        $statusCode = $e->getCode();
        if ($statusCode < 100 || $statusCode > 599) {
            $statusCode = 500;
        }
        if (!in_array($statusCode, [404, 405], true)) {
            $statusCode = 500;
        }
        $content = $this->view->error($statusCode);

        return Response::html($content, $statusCode);
    }
}
