<?php

declare(strict_types=1);

namespace App\Controller;

class RegisterController extends Controller {
    public function showForm(): string {
        return $this->view->page('register');
    }
    public function register(): ?string {
        $rawEmail = $this->request->input('email') ?? '';
        $rawEmail = trim($rawEmail);
        $rawPassword = $this->request->input('password') ?? '';
        $passwordConfirmation = $this->request->input('password_confirmation') ?? '';
        $email = null;
        $password = null;
        $error = [];

        if (empty($rawEmail)) {
            $error[] = 'Email не может быть пустым';
        } elseif (!filter_var($rawEmail, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Некорректный формат Email';
        }

        if (empty($rawPassword)) {
            $error[] = 'Пароль не может быть пустым';
        } elseif (strlen($rawPassword) < 6) {
            $error[] = 'Количество символов в пароле должно быть больше 5';
        }
        if (empty($passwordConfirmation)) {
            $error[] = 'Подтверждение пароля не может быть пустым';
        } elseif ($rawPassword !== $passwordConfirmation) {
            $error[] = 'Пароли не совпадают';
        }

        if ($error) {
            return implode('<br>', $error);
        }
        $email = $rawEmail;
        $password = password_hash($rawPassword, PASSWORD_DEFAULT);
        return "Привет пользователь {$email}!";
    }
}
