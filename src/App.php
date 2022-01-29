<?php

namespace App;

class App
{
    private const BRACES = 'braces';

    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $str = $_POST[self::BRACES] ?? null;
            if (empty($str) || !BraceValidator::isValid($str)) {
                header('Content-Type: text/html; charset=utf-8', false, 400);
                echo 'fail :(';
                return;
            }

            header('Content-Type: text/html; charset=utf-8', false, 200);
            echo 'well done :)';
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
