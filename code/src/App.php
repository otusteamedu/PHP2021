<?php

namespace App;

use \Exception;

class App
{
    private EmailValidator $emailValidator;

    public function __construct()
    {
        $this->emailValidator = new EmailValidator();
    }

    public function run(): bool
    {
        if (empty($email = $_GET['email'])) {
            throw new Exception('Email not found');
        }

        return $this->emailValidator->validate($email);
    }
}
