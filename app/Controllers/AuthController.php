<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        $errorMessage = '';

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

                header('Location: /live-chat/public/index.php/chat');
                exit();
            } else {
                $errorMessage = "Invalid email or password.";
            }
        }

        include __DIR__ . '/../Views/auth/login.php';
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
        header('Location: /live-chat/public/index.php/login');
        exit();
    }
}
