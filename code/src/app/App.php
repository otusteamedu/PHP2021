<?php

namespace App;

use App\Email\Email;
use Exception;

class App
{
    private Email $email;

    public function run($argv)
    {
        if (empty($argv[1]))
        {
            throw new Exception( 'Не указан файл в виде аргумента' );
        }

        $filename = $argv[1];
        $this->email = new Email();
        $this-> emails = $this->email->readEmails($filename);

        foreach ($this->emails as $email)
        {
            echo $email . ' = ' . (($this->email->checkEmail($email))
                    ? 'Валидный email'
                    : 'Невалидный email') . PHP_EOL;
        }
    }

}