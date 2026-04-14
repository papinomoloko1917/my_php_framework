<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/about', fn() => 'About page'),
];
