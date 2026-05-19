<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Response\Response;
use App\Session\Auth;
use App\Session\Flash;

class GuestMiddleware implements MiddlewareInterface {
    public function handle(): ?Response {
        if (Auth::check()) {
            Flash::set('error', 'вы уже вошли в аккаунт');
            return Response::redirect('/profile');
        }
        return null;
    }
}
