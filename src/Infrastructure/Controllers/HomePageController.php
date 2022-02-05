<?php

namespace App\Infrastructure\Controllers;


use App\Application\Services\CodeGenerator;


class HomePageController
{
    public function index()
    {
        header('Location: /form');
        return true;
    }
}