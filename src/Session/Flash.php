<?php

declare(strict_types=1);

namespace App\Session;

class Flash {
    public static function set(string $key, string $message): void {
        $_SESSION['flash'][$key] = $message;
    }
    public static function get(string $key): ?string {
        if (!isset($_SESSION['flash'][$key])) {
            return null;
        }
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
}
