<?php

declare(strict_types=1);

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/bootstrap/bootstrap.php';

use App\App;

$app = new App;

$app->run();
