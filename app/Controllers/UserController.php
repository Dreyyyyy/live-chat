<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function register()
    {
        $errorMessage = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profilePicture = $_FILES['profile_picture']['name'] ?? null;

            $user = new User();
            
            // Check if the email already exists
            if ($user->findByEmail($email)) {
                $errorMessage = "An account with this email already exists.";
            } else {
                // Validate inputs here
                if ($user->create($name, $email, $password, $profilePicture)) {
                    session_start();
                    $_SESSION['user_id'] = $user->findByEmail($email)['id'];
                    header('Location: /live-chat/public/index.php/chat');
                    exit();
                } else {
                    $errorMessage = "Registration failed.";
                }
            }
        }

        include __DIR__ . '/../Views/auth/register.php';
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
