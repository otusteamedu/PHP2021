<?php

declare(strict_types=1);

namespace Brackets;

use Brackets\Tools\Filters\InputFilter;

class App
{

    public function run()
    {
        $controller = InputFilter::getPostValue("controller") ?? "DefaultController";
        $controller = "Brackets\\Controllers\\" . $controller;
        $action = InputFilter::getPostValue("action") ?? "indexAction";

        try {
            $controllerObject = new $controller();
            $controllerObject->$action();
        } catch (\Exception $e) {

        }

    }

}