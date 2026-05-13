<?php

declare(strict_types=1);

namespace App\Session;

class Auth {
    public static function login(int $id, string $email): void {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_email'] = $email;
    }
    public static function logout(): void {
        unset($_SESSION['user_id'], $_SESSION['user_email']);
    }
    public static function check(): bool {
        return !empty($_SESSION['user_email']);
    }
    public static function id(): ?int {
        return $_SESSION['user_id'] ?? null;
    }
    public static function email(): ?string {
        return $_SESSION['user_email'] ?? null;
    }
}
