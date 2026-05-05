<?php

declare(strict_types=1);

namespace App\Controller;

class RegisterController extends Controller {
    public function showForm(): string {
        return $this->view->page('register');
    }
    public function register() {
        dd($_POST);
    }
}
