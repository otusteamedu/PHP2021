<?php

namespace App\Http\Controllers;

use App\Http\View;

class IndexController
{
    public function index()
    {
        return View::view('index');
    }
}