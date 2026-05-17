<?php

declare(strict_types=1);

namespace App\Controller\Authorized;

use App\Controller\Controller;

class ProfileController extends Controller {
    public function index(): string {
        return $this->view('authorized/profile');
    }
}
