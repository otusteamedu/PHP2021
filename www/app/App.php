<?php

namespace App;

class App
{
    public function checkData()
    {
        if (empty($_POST['string'])){
            throw new \Exception('Have not received any string');
        }

        $string = Filter::fire();
        $checker = new Checker($string);
        $checker->run();
    }
}