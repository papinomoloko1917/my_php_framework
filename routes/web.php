<?php

declare(strict_types=1);

use App\Controller\AboutController;
use App\Controller\HomeController;
use App\Controller\Auth\LoginController;
use App\Controller\Auth\RegisterController;
use App\Controller\Authorized\ProfileController;
use App\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/about', [AboutController::class, 'index']),

    Route::get('/register', [RegisterController::class, 'showForm']),
    Route::post('/register', [RegisterController::class, 'register']),

    Route::get('/login', [LoginController::class, 'showForm']),
    Route::post('/login', [LoginController::class, 'login']),

    Route::post('/logout', [LoginController::class, 'logout']),

    Route::get('/profile', [ProfileController::class, 'index'])
        ->middleware(['auth']),
];
