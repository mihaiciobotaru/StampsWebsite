<?php

namespace app\core;

require_once("Router.php");
require_once("Request.php");
require_once("Response.php");
require_once("core/db/Database.php");
require_once("Controller.php");
require_once("Session.php");
require_once("core/db/DbModel.php");
require_once("View.php");
require_once("UserModel.php");

use app\core\db\Database;
use app\core\db\DbModel;
use app\models\User;


class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners = [];

    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public static Application $app;
    public ?Controller $controller = null;
    public Session $session;
    public ?UserModel $user;
    public View $view;
    public string $rootpath = "";
    public string $rssfeed = "";


    public function __construct(string $rootPath, array $config)
    {
        if (!$config['canLog']) {
            $_SESSION = [];
        }
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->rootpath = getcwd();
        $this->db = new Database($config['db']);

        $this->rssfeed .= '<?xml version="1.0" encoding="ISO-8859-1"?>';
        $this->rssfeed .= '<rss version="2.0">';
        $this->rssfeed .= '<title>Stamp Worldn`t</title>';
        $this->rssfeed .= '<link>http://www.mydomain.com</link>';
        $this->rssfeed .= '<channel>';


        if ($config['canLog']) {
            $primaryValue = $this->session->get('users');
            if ($primaryValue) {
                $primaryKey = $this->userClass::primaryKey();
                $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
            } else {
                $this->user = null;
            }
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('users', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('users');
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }
}
