<?php

declare(strict_types=1);

namespace App\View;

final class View {
    public function page(string $name): string {
        ob_start();
        require BASE_DIR . "/public/views/pages/{$name}.php";
        $html = ob_get_clean();
        return $html;
    }
}
