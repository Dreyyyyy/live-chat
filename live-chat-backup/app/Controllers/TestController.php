<?php

namespace App\Controllers;

use App\Core\Database;

class TestController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        //echo "Database connection successful!<br>";
    }

    public function testConnection()
    {
        echo "TestController is working!<br>";

        try {
            $stmt = $this->db->query("SELECT * FROM users");
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            echo "<pre>";
            print_r($users);
            echo "</pre>";
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function testJson()
    {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'This is a test']);
    }
}