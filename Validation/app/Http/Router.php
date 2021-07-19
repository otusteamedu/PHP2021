<?php

namespace App\Http;

use App\Exception\InvalidMethodException;


class Router
{
    static function init($routes)
    {
        $request_url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $request_method = $_SERVER['REQUEST_METHOD'];
        foreach ($routes as $route => $controller) {
            if ($request_url == $route) {
                if (!class_exists($controller[0])) {
                    throw new InvalidMethodException("Класс " . $controller[0] . " не найден.");
                }
                if (!method_exists($controller[0], $controller[1])) {
                    throw new InvalidMethodException("Метод " . $controller[1] . " в " . $controller[0] . " не найден.");
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
                    return $class->$method(new Request($request_data));
                }
            }
        }
        header("HTTP/1.0 404 Not Found");
        return [];
    }
}