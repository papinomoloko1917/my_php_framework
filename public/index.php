<?php

declare(strict_types=1);

use App\App;
use App\Dispatcher\Dispatcher;
use App\Request\Request;
use App\Routing\Router;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/bootstrap/bootstrap.php';

$request = Request::createFromGlobals(); // Получаем реквесты
$routes = require BASE_DIR . '/routes/web.php'; // Получаем маршруты
$router = new Router($request, $routes); // Создаем экземпляр роутера и передаем реквест и маршруты
$dispatcher = new Dispatcher(); // Создаем экземпляр диспетчера

$app = new App($router, $dispatcher);

$app->run(); // Запускаем приложение
