<?php

use Controllers\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testAdd()
    {
        $_POST['false_string'] = '(()()()()))((((()()()))(()()()(((()))))))';
        $_POST['true_string'] = '(((())))';

        $value = $_POST['true_string'];

        $app = new App();
        $app->run($value);

    }
}