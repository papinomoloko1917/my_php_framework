<?php

declare(strict_types=1);

use App\App;
use App\Request\Request;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/bootstrap/bootstrap.php';

$request = Request::createFromGlobals();

dd($request);

$app = new App();

$app->run();
