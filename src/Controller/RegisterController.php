<?php

declare(strict_types=1);

namespace App\Controller;

class RegisterController extends Controller {
    public function showForm(): string {
        return $this->view->page('register');
    }
    public function register(): ?string {
        $rawEmail = $this->request->input('email');
        $rawPassword = $this->request->input('password');
        $email = htmlspecialchars(trim($rawEmail), ENT_QUOTES, 'UTF-8');
        $password = password_hash($rawPassword, PASSWORD_DEFAULT);
        $error = [];
        if (!empty($rawEmail)) {
            if (filter_var($rawEmail, FILTER_VALIDATE_EMAIL)) {
                return $email;
            } else {
                $error[] = 'Некорректный формат Email';
            }
        } else {
            $error[] = 'Email не может быть пустым';
        }

        if (!empty($rawPassword)) {
            if (!strlen($rawPassword) < 6) {
                return $password;
            } else {
                $error[] = 'Количество символов в пароле должно быть больше 6';
            }
        } else {
            $error[] = 'Пароль не может быть пустым';
        }
        return implode('<br>', $error);
    }
}
