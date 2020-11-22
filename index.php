<?php

use itstefone\Controllers\HomeController;
use itstefone\Controllers\LoginController;
use itstefone\Controllers\ProfileController;
use itstefone\Controllers\RegisterController;
use itstefone\Core\Application;
use itstefone\Models\User;

require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
  'userClass' => User::class,
  'db' => [
    'dns' => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD']
  ]
  ];

 

$app  = new Application(__DIR__, $config);


$app->get('/', [HomeController::class, 'index']);
$app->get('/login', [LoginController::class, 'index']);
$app->post('/login', [LoginController::class, 'store']);
$app->get('/register', [RegisterController::class, 'index']);
$app->post('/register', [RegisterController::class, 'store']);

$app->get('/logout', [LoginController::class, 'logout']);
$app->get('/profile', [ProfileController::class, 'index']);


$app->run();