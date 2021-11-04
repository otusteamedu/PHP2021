<?php


namespace Src;


use Src\Request\Request;

class App
{
    private $request;

    public function run()
    {
        $request = new Request();
        $result = $request->post()
            ->validateBrackets();
        echo $result;
    }
}