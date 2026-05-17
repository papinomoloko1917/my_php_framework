<?php

declare(strict_types=1);

namespace App\Factory;

use App\Controller\Auth\LoginController;
use App\Controller\Auth\RegisterController;
use App\Controller\Controller;
use App\Database\Database;
use App\Request\Request;
use App\Validation\LoginValidator;
use App\Validation\RegisterValidator;
use App\View\View;

class ControllerFactory {
    public function __construct(
        private readonly View $view,
        private readonly Request $request,
        private readonly Database $database,
        private readonly RegisterValidator $registerValidator,
        private readonly LoginValidator $loginValidator,
    ) {
    }
    public function make(string $controllerClass): Controller {
        if ($controllerClass === RegisterController::class) {
            return new $controllerClass(
                $this->view,
                $this->request,
                $this->database,
                $this->registerValidator,
            );
        }
        if ($controllerClass === LoginController::class) {
            return new $controllerClass(
                $this->view,
                $this->request,
                $this->database,
                $this->loginValidator,
            );
        }
        return new $controllerClass(
            $this->view,
            $this->request,
            $this->database,
        );
    }
}
