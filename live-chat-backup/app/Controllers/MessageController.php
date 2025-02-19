<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\User;

session_start();

class MessageController
{
    public function index()
    {
        $messageModel = new Message();
        $messages = $messageModel->getAllMessages();

        $userModel = new User();
        $users = $userModel->getAllUsers();

        include __DIR__ . '/../Views/chat/chat.php';
    }

    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if ($data === null) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
                return;
            }

            $senderId = $_SESSION['user_id'];
            $receiverId = $data['receiver_id'] ?? null;
            $content = $data['content'] ?? null;

            if ($receiverId === null || $content === null) {
                echo json_encode(['status' => 'error', 'message' => 'Missing data']);
                return;
            }

            $messageModel = new Message();
            $messageModel->create($senderId, $receiverId, $content);

            header('Content-Type: application/json');
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }

    public function fetchMessages()
    {
        $messageModel = new Message();
        $messages = $messageModel->getAllMessages(); // Or use getMessagesBetween if you want specific messages

        header('Content-Type: application/json');
        echo json_encode($messages);
    }
}
