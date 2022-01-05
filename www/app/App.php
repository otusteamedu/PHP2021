<?php

namespace App;

class App
{
    public function checkData()
    {
        if (empty($_POST['string'])){
            throw new \Exception('Have not received any string');
        }
        
        $checker = new Checker();
        $checker->run();
        Response::replyWithOk();
    }
}