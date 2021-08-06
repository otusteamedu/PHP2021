<?php

declare(strict_types=1);


namespace Balance;


final class App
{

    public function run(): void
    {
        $controller = $_POST["controller"] ?? "DefaultController";
        $controller = "Balance\\Controllers\\" . $controller;
        $action = $_POST["action"] ?? "indexAction";

        try {
            $controllerObject = new $controller();
            $controllerObject->$action();
        } catch (\Exception $e) {

        }

    }

}