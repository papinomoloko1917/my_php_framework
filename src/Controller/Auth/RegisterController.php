<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Controller\Controller;
use App\Database\Database;
use App\Request\Request;
use App\Response\Response;
use App\Session\Flash;
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
        return $this->view('auth/register');
    }
    public function register(): string|Response {
        $rawEmail = $this->request->input('email') ?? '';
        $rawEmail = trim($rawEmail);
        $rawPassword = $this->request->input('password') ?? '';
        $passwordConfirmation = $this->request->input('password_confirmation') ?? '';

        $errors = $this->registerValidator->validate($rawEmail, $rawPassword, $passwordConfirmation);

        if ($errors) {
            return $this->view('auth/register', ['errors' => $errors, 'email' => $rawEmail]);
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

            Flash::set('success', 'Регистрация прошла успешно');
            return Response::redirect('/');
        }
        $errors[] = 'Пользователь уже существует';
        return $this->view('auth/register', ['errors' => $errors, 'email' => $rawEmail]);
    }
}
