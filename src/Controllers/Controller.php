<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View\View;

abstract class Controller {
    public function __construct(
        private readonly View $view
    ) {
    }
    public function view(string $name): void {
        $this->view->page($name);
    }
}
