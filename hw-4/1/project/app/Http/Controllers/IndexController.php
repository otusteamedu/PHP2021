<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequest;

class IndexController
{
    private $formRequest;

    public function __construct()
    {
        $this->formRequest = new FormRequest();
    }

    public function index()
    {
        $this->formRequest->rules();
    }
}