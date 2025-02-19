<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/config.php';

        try {
            $this->connection = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']}",
                $config['user'],
                $config['password']
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
