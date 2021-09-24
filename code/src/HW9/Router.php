<?php

namespace HW9;

use Exception;
use HW9\Controllers\IndexController;
use HW9\Controllers\StatisticsController;

class Router
{
    public function switch(string $name) : void
    {
        switch ($name) {
            case 'index':
                $controller = new IndexController();
                $controller->index();
                break;
            case 'stats':
                $controller = new StatisticsController();
                $controller->showAll();
                break;
            case 'top':
                $controller = new StatisticsController();
                $controller->showTop();
                break;
            default:
                throw new Exception('Wrong app type.');
                break;
        }
    }
}
