<?php

use itstefone\Controllers\HomeController;
use itstefone\Controllers\LoginController;
use itstefone\Controllers\RegisterController;
use itstefone\Core\Application;



require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
  'db' => [
    'dns' => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD']
  ]
  ];

 

$app  = new Application(__DIR__, $config);


Application::$app->db->applyMigrations();
