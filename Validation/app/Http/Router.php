<?php

namespace App\Http;


use App\Exception\InvalidMethodException;
use App\Helpers\Contracts\FirstBuilderInterface;

class Router implements FirstBuilderInterface
{
    /**
     * @throws InvalidMethodException
     */
    public function init($routes)
    {
        $request_url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $request_method = $_SERVER['REQUEST_METHOD'];
        foreach ($routes as $route => $controller) {
            if ($request_url == $route) {
                $this->checkData($controller, $controller);
                $this->builder($request_method, $controller);
                return;
            }
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function checkData($class, $method = null)
    {
        if (!class_exists($class[0])) {
            throw new InvalidMethodException("Класс " . $class[0] . " не найден.");
        }
        if (!method_exists($class[0], $method[1])) {
            throw new InvalidMethodException("Метод " . $method[1] . " в " . $class[0] . " не найден.");
        }
    }


    public function builder($request, $controller)
    {
        $class = new $controller[0];
        $method = $controller[1];
        $request_data = [];
        if ($request == 'POST') {
            $request_data = $_POST;
        }
        if ($request == 'GET') {
            $request_data = $_GET;
        }
        return $class->$method(new Request($request_data));
    }
}