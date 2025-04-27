<?php

require_once(ROOT_PATH . '/config/ControllerGenerator.php');

class Routing
{
    private array $routesGET = [];
    private array $routesPOST = [];

    public function get($route, $callback)
    {
        $this->routesGET[$route] = $callback;
    }

    public function post($route, $callback)
    {
        $this->routesPOST[$route] = $callback;
    }

    public function IncomingRequest()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $segments = explode('/', $uri);
        $offset = array_search('app', $segments);

        $route = '';
        if ($offset !== false) {
            $realSegments = array_slice($segments, $offset + 1);
            $route = implode('/', $realSegments);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (array_key_exists($route, $this->routesGET)) {
                $callback = $this->routesGET[$route];
                list($controllerName, $method) = explode('::', $callback);

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $method)) {
                        call_user_func([$controller, $method]);
                    } else {
                        echo "Method $method not found in controller $controllerName.";
                    }
                } else {
                    echo "Controller $controllerName not found.";
                }
            } else {
                echo "<h1>404 Not Found</h1>";
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (array_key_exists($route, $this->routesPOST)) {
                $callback = $this->routesPOST[$route];
                list($controllerName, $method) = explode('::', $callback);

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $method)) {
                        call_user_func([$controller, $method]);
                    } else {
                        echo "Method $method not found in controller $controllerName.";
                    }
                } else {
                    echo "Controller $controllerName not found.";
                }
            } else {
                echo "<h1>404 Not Found</h1>";
            }
        }
    }
}

$routes = new Routing();