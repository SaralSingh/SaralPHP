<?php

namespace App\Services;

use App\Middlewares\CsrfMiddleware;
use App\Middlewares\UserMiddleware;

class Route
{

    private static $routes = [];
    public static $controllerNamespace = "App\Controllers\\";

    // Show 404 page
    public static function notFound()
    {
        echo "<h1>404 - Not Found</h1>";
        exit;
    }

    // Register GET route
    public static function get($uri, $controller, $action, $middleware = null)
    {
        self::$routes[] = [
            'uri'        => $uri,          // /login
            'controller' => $controller,   // AccountController
            'action'     => $action,       // login
            'method'     => 'GET',
            'middleware' => $middleware
        ];
    }

    // Register POST route
    public static function post($uri, $controller, $action, $middleware = null)
    {
        self::$routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'action'     => $action,
            'method'     => 'POST',
            'middleware' => $middleware
        ];
    }

    // Handle the incoming request
    public static function handle()
    {
        $requestURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $cleanRequest = rtrim($requestURI, '/');

        // 🚨 INTERNAL PATHS → 403 (ONCE)
        if (preg_match('#^' . BASE_URL . '/(app|routes|vendor|storage|views)#', $cleanRequest)) {
            http_response_code(403);
            (new \App\Controllers\ErrorController())->forbidden();
            return;
        }

        foreach (self::$routes as $route) {

            $routeURI = BASE_URL . $route['uri'];
            $cleanRoute = rtrim($routeURI, '/');

            if ($cleanRoute === $cleanRequest && $route['method'] === $requestMethod) {

                CsrfMiddleware::validate();
                UserMiddleware::handle($route['middleware']);

                $controllerClass = self::$controllerNamespace . $route['controller'];
                $action = $route['action'];

                (new $controllerClass())->$action();
                return;
            }
        }

        self::notFound();
    }
}
