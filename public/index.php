<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\TestController;
use App\Controllers\UserController;
use App\Controllers\AuthController;
use App\Controllers\MessageController;

$router = new Router();

// Define routes
$router->get('/test', [new TestController(), 'testConnection']);
$router->get('/register', [new UserController(), 'register']);
$router->post('/register', [new UserController(), 'register']);
$router->get('/login', [new AuthController(), 'login']);
$router->post('/login', [new AuthController(), 'login']);
$router->get('/logout', [new AuthController(), 'logout']);
$router->get('/chat', [new MessageController(), 'index']);
$router->post('/chat/send', [new MessageController(), 'sendMessage']);
$router->get('/users', [new UserController(), 'listUsers']);
$router->post('/update-last-active', [new UserController(), 'updateLastActive']);
$router->get('/fetch-users', [new UserController(), 'fetchUsers']);
$router->get('/fetch-messages', [new MessageController(), 'fetchMessages']);
$router->get('/test-json', [new TestController(), 'testJson']);

// Dispatch the current request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/live-chat/public/index.php', '', $uri); // Adjust for index.php
$uri = str_replace('/live-chat/public', '', $uri); // Adjust for direct access
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);

