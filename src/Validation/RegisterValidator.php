<?php

declare(strict_types=1);

namespace App\Validation;

class RegisterValidator {
    public function validate(
        string $rawEmail,
        string $rawPassword,
        string $passwordConfirmation
    ): array {
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

        return $error;
    }
}
