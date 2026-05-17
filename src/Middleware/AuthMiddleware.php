<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Response\Response;
use App\Session\Auth;
use App\Session\Flash;

class AuthMiddleware implements MiddlewareInterface {
    public function handle(): ?Response {
        if (Auth::check()) {
            return null;
        }
        Flash::set('error', 'Сначала войдите в аккаунт');
        return Response::redirect('/login');
    }
}
