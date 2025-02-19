<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profilePicture = $_FILES['profile_picture']['name'] ?? null;

            // Validate inputs here
            $user = new User();
            if ($user->create($name, $email, $password, $profilePicture)) {
                session_start();
                $_SESSION['user_id'] = $user->findByEmail($email)['id'];
                header('Location: /live-chat/public/chat');
                exit();
            } else {
                echo "Registration failed.";
            }
        } else {
            // Load the registration view for GET requests
            include __DIR__ . '/../Views/auth/register.php';
        }
    }

    public function listUsers()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();

        include __DIR__ . '/../Views/user/list.php';
    }

    public function updateLastActive() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            $userModel = new User();
            $userModel->updateLastActive($_SESSION['user_id']);
        }
    }

    public function fetchUsers()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        echo json_encode($users);
    }
}
