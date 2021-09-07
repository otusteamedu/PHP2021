<?php

namespace App;

use Services\CheckBrackets;

class App
{
    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['string'])) {
            $checkString = $_POST['string'];
            $result = new CheckBrackets($checkString);
            $result->check();
        }

    }
}