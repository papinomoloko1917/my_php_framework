<?php

declare(strict_types=1);

namespace App\Controller;

use RuntimeException;

class RegisterController extends Controller {
    public function showForm(): string {
        return $this->view->page('register');
    }
    public function register(): ?string {
        $email = $this->request->input('email');
        $error = [];
        if (!empty($email)) {
            return $email;
        }
        $error[] = 'Email не передан';
        return implode('<br>', $error);
    }
}
