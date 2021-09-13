<?php

namespace App;

use Services\EmailValidator;

class App
{
    public function run($argv)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $checkEmail = $_POST['email'];
            if (EmailValidator::checkEmail($checkEmail)) {
                echo 'Email correct';
            } else {
                echo 'Email incorrect';
            };
        }

        if (PHP_SAPI === 'cli') {
            $filename = $argv[1] ?? '';

            try {
                $emails = file($filename);
                $validEmails = EmailValidator::checkEmails($emails);
                if (count($validEmails) > 0) {
                    echo "Correct emails:\n";
                    foreach ($validEmails as $email) {
                        echo $email . "\n";
                    }
                } else {
                    echo "All Emails not correct!\n";
                }

            } catch (\Exception $exception) {
                echo $exception;
            }
        }
    }
}