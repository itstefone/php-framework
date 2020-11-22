<?php

use itstefoneControllers\HomeController;
use itstefoneControllers\LoginController;
use itstefoneControllers\RegisterController;
use itstefoneCore\Application;



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
