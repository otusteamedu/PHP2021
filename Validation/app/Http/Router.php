<?php

namespace App\Http;


use App\Http\Controllers\IndexController;
use App\Http\Controllers\MessageController;


class Router
{
    private static $routes = [
        '/' => [IndexController::class, 'index', 'GET'],
        '/send-message' => [MessageController::class, 'test', 'POST'],
    ];

    static function init()
    {
        $request_url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $request_method = $_SERVER['REQUEST_METHOD'];
        foreach (self::$routes as $route => $controller) {
            if ($request_url == $route) {
                if (!class_exists($controller[0])) {
                    echo "Класс " . $controller[0] . " не найден.";
                    return [];
                }
                if (!method_exists($controller[0], $controller[1])) {
                    echo "Метод " . $controller[1] . " в " . $controller[0] . " не найден.";
                    return [];
                }
                if (strtoupper($request_method) == strtoupper($controller[2])) {
                    $class = new $controller[0];
                    $method = $controller[1];
                    $request_data = [];
                    if ($request_method == 'POST') {
                        $request_data = $_POST;
                    }
                    if ($request_method == 'GET') {
                        $request_data = $_GET;
                    }
                    return $class->$method(new Request($request_data, $_FILES));
                }
            }
        }
        header("HTTP/1.0 404 Not Found");
        return [];
    }
}