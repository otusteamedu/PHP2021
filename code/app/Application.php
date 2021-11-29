<?php

namespace App;

class Application
{
    private $request;

    public function __construct()
    {
        $this->request = $_POST;
    }

    public function run()
    {
        Validation::run($this->request['STRING']);

    }



}