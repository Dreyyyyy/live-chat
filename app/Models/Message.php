<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Message
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getAllMessages()
    {
        $stmt = $this->db->query("
            SELECT messages.*, users.name AS sender_name 
            FROM messages 
            JOIN users ON messages.sender_id = users.id 
            ORDER BY messages.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($senderId, $receiverId, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
        $stmt->bindParam(':sender_id', $senderId);
        $stmt->bindParam(':receiver_id', $receiverId);
        $stmt->bindParam(':message', $content);
        return $stmt->execute();
    }

    public function getMessagesBetween($senderId, $receiverId)
    {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id) ORDER BY created_at ASC");
        $stmt->bindParam(':sender_id', $senderId);
        $stmt->bindParam(':receiver_id', $receiverId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
