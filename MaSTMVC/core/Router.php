<?php

namespace app\core;

use app\core\exception\NotFoundException;

require_once("Request.php");
require_once("form/Form.php");
require_once("core/exception/NotFoundException.php");

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $path = "/" . basename(Application::$ROOT_DIR) . "/index.php" . $path;
        $this->routes['get'][$path] = $callback;
    }

    public function post($path,  $callback): void
    {
        $path = "/" . basename(Application::$ROOT_DIR) . "/index.php" . $path;
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {

        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            /**
             * @var Controller $controller
             */
            $controller = $callback[0];
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return $callback($this->request, $this->response);
    }
}
