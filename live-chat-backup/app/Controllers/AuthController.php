<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $userData = $user->findByEmail($email);

            if ($userData && password_verify($password, $userData['password'])) {
                session_start();
                $_SESSION['user_id'] = $userData['id'];

                // Update last active time
                $user->updateLastActive($userData['id']);

                header('Location: /live-chat/public/chat');
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            // Load the login view for GET requests
            include __DIR__ . '/../Views/auth/login.php';
        }
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            $user = new User();
            $user->setInactive($_SESSION['user_id']);
        }
        session_unset();
        session_destroy();
        header('Location: /live-chat/public/login');
        exit();
    }
}
