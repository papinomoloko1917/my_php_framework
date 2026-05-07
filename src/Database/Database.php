<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class Database {
    private PDO $pdo;
    public function __construct() {
        $host = 'mysql';
        $dbname = getenv('MYSQL_DATABASE');
        $username = getenv('MYSQL_USER');
        $password = getenv('MYSQL_PASSWORD');
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $this->pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    public function pdo(): PDO {
        return $this->pdo;
    }
}
