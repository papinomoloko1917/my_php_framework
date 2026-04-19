<?php

declare(strict_types=1);

namespace App\View;

final class View {
    public function page(string $name): void {
        $path = BASE_DIR . "/public/views/pages/{$name}.php";

        require $path;
    }
}
