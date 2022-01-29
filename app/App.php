<?php

namespace App;

class App
{
    public function run($container)
    {
        $checkString = $_POST['string'];
        $controller = $container->get('Src\controller\BracketsController');
        $controller->check($checkString);

    }

}