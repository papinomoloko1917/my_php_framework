<?php

declare(strict_types=1);

namespace App\View;

class View {
    public function page(string $name, array $data = []): string {

        extract($data);

        ob_start();
        require BASE_DIR . "/public/views/pages/$name.php";

        $content = ob_get_clean();

        ob_start();
        require BASE_DIR . "/public/views/layouts/app.php";
        $layout = ob_get_clean();

        return $layout;
    }
    public function error(int $statusCode): string {
        ob_start();
        require BASE_DIR . "/public/views/errors/$statusCode.php";
        $content = ob_get_clean();

        ob_start();
        require BASE_DIR . "/public/views/layouts/cleanTemplate.php";
        return ob_get_clean();
    }
}
