<?php

namespace App\Infrastructure\Controllers;


use App\Application\Services\CodeGenerator;


class FormCodeController
{
    public function index()
    {
        return getHTMLTemplate('index');
    }
}