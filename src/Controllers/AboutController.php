<?php

declare(strict_types=1);

namespace App\Controllers;

class AboutController extends Controller {
    public function index(): string {
        return $this->view('about');
    }
}
