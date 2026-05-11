<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\Database;
use App\Request\Request;
use App\Response\Response;
use App\Session\Flash;
use App\Validation\LoginValidator;
use App\View\View;

class LoginController extends Controller {
    public function __construct(
        View $view,
        Request $request,
        Database $database,
        private readonly LoginValidator $loginValidator,
    ) {
        parent::__construct($view, $request, $database);
    }
    public function showForm(): string {
        return $this->view('login');
    }
    public function login(): string|Response {
        $email = trim($this->request->input('email') ?? '');
        $password = $this->request->input('password') ?? '';
        $errors = $this->loginValidator->validate($email, $password);

        if ($errors) {
            return $this->view('login', [
                'errors' => $errors,
                'email' => $email,
            ]);
        }
        $sql = "SELECT id, email, password FROM users WHERE email = :email";

        $pdo = $this->database->pdo();

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
        ]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->view('login', [
                'errors' => ['Неверный email или пароль'],
                'email' => $email,
            ]);
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        Flash::set('success', 'Вы вошли в аккаунт');
        return Response::redirect('/');
    }
    public function logout(): Response {
        unset($_SESSION['user_id'], $_SESSION['user_email']);
        Flash::set('logout', 'Вы вышли из аккаунта');
        return Response::redirect('/');
    }
}
