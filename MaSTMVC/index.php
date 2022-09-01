<?php

require_once("core/Application.php");
require_once("controllers/SiteController.php");
require_once("controllers/AuthController.php");
require_once("controllers/ProfileController.php");
require_once("controllers/FunctionController.php");
require_once("models/User.php");

use app\controllers\AuthController;
use app\controllers\FunctionController;
use app\controllers\ProfileController;
use app\controllers\SiteController;
use app\core\Application;

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => 'mysql:host=localhost;port=3306;dbname=stampworld',
        'user' => 'root',
        'password' => '',
    ],
    'canLog' => true
];


$app = new Application(__DIR__, $config);

$app->on(Application::EVENT_BEFORE_REQUEST, function () {
    //    echo "Before request";
});

$app->router->get('/', [new SiteController(), 'home']);
$app->router->get('/contact', [new SiteController(), 'contact']);
$app->router->post('/contact', [new SiteController(), 'contact']);
$app->router->get('/catalogue', [new SiteController(), 'catalogue']);
$app->router->post('/catalogue', [new SiteController(), 'catalogue']);
$app->router->get('/profile', [new ProfileController(), 'profile']);
$app->router->post('/profile', [new ProfileController(), 'profile']);
$app->router->get('/profile/mystamps', [new ProfileController(),'mystamps']);
$app->router->post('/profile/mystamps', [new ProfileController(),'mystamps']);
$app->router->get('/profile/mycatalogues', [new ProfileController(),'mycatalogues']);
$app->router->post('/profile/mycatalogues', [new ProfileController(),'mycatalogues']);
$app->router->post('/likeStamp', [new FunctionController(),'likeStamp']);


$app->router->get('/login', [new AuthController(), 'login']);
$app->router->post('/login', [new AuthController(), 'login']);
$app->router->get('/register', [new AuthController(), 'register']);
$app->router->post('/register', [new AuthController(), 'register']);
$app->router->get('/logout', [new AuthController(), 'logout']);



$app->run();
