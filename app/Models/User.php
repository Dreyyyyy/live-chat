<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function create($name, $email, $password, $profilePicture = null)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, profile_picture) VALUES (:name, :email, :password, :profile_picture)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':profile_picture', $profilePicture);
        return $stmt->execute();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT id, name, email, last_active FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateLastActive($userId)
    {
        $stmt = $this->db->prepare("UPDATE users SET last_active = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    public function setInactive($userId)
    {
        $stmt = $this->db->prepare("UPDATE users SET last_active = DATE_SUB(NOW(), INTERVAL 1 HOUR) WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }
}
