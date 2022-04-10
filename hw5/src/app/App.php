<?php

namespace App;

use Services\EmailValidator;

class App
{
    public function run($argv)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $checkEmails = $_POST['email'];
        } elseif (PHP_SAPI === 'cli') {
            $filename = $argv[1] ?? '';
            try {
                $checkEmails = file($filename);
            } catch (\Exception $exception) {
                echo $exception;
            }
        }

        $validEmail = new EmailValidator($checkEmails);
        $validEmail->printValidEmails();
    }
}