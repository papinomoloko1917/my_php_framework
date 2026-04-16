<?php

declare(strict_types=1);

use App\App;
use App\Container\Container;
use App\Dispatcher\Dispatcher;
use App\Request\Request;
use App\Routing\Router;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/bootstrap/bootstrap.php';

$request = Request::createFromGlobals(); // Получаем реквесты
$routes = require BASE_DIR . '/routes/web.php'; // Получаем маршруты

$container = new Container($request, $routes);

$app = new App($container);

$app->run();
