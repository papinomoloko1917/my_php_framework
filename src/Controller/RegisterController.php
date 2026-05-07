<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\Database;
use App\Request\Request;
use App\Validation\RegisterValidator;
use App\View\View;

class RegisterController extends Controller {
    public function __construct(
        View $view,
        Request $request,
        Database $database,
        private readonly RegisterValidator $registerValidator,
    ) {
        parent::__construct($view, $request, $database);
    }
    public function showForm(): string {
        return $this->view('register');
    }
    public function register(): string {
        $rawEmail = $this->request->input('email') ?? '';
        $rawEmail = trim($rawEmail);
        $rawPassword = $this->request->input('password') ?? '';
        $passwordConfirmation = $this->request->input('password_confirmation') ?? '';

        $errors = $this->registerValidator->validate($rawEmail, $rawPassword, $passwordConfirmation);

        if ($errors) {
            return implode('<br>', $errors);
        }

        $email = $rawEmail;
        $password = password_hash($rawPassword, PASSWORD_DEFAULT);
        $pdo = $this->database->pdo();

        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
        ]);
        $user = $stmt->fetch();

        if (!$user) {
            $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':email' => $email,
                ':password' => $password,
            ]);
            $safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

            return "Привет пользователь {$safeEmail}!";
        }
        if ($user) {
            return 'Пользователь уже существует';
        }
    }
}
