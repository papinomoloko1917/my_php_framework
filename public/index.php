<?php

declare(strict_types=1);

use App\App;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/bootstrap/bootstrap.php';

$app = new App();

$app->run();
