<?php

require_once("core/Application.php");
require_once("controllers/SiteController.php");
require_once("controllers/AuthController.php");

use app\core\Application;

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => 'mysql:host=localhost;port=3306;dbname=stampworld',
        'user' => 'root',
        'password' => '',
    ],
    'canLog' => false
];
unset($_SESSION['users']);
$app = new Application(__DIR__, $config);
$app->db->applyMigrations();
