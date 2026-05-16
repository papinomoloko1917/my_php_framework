<?php

declare(strict_types=1);

namespace App\Controller\Authorized;

use App\Controller\Controller;
use App\Response\Response;
use App\Session\Auth;
use App\Session\Flash;

class ProfileController extends Controller {
    public function index(): string|Response {
        if (!Auth::check()) {
            Flash::set('error', 'Сначала войдите в аккаунт');
            return Response::redirect('/login');
        }
        return $this->view('authorized/profile');
    }
}
