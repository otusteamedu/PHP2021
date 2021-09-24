<?php

namespace HW5;

use Exception;

class App
{
    private $emails = [];

    public function run(array $argv) : void
    {
        if (empty($argv)) {
            throw new Exception('Please specify a file name to read email list from.');
        }

        $fn = $argv[1];
        $this->readEmailsFromFile($fn);

        foreach ($this->emails as $email) {
            echo $email . ' = ' . (($this->checkEmail($email)) ? 'valid' : 'invalid') . "\r\n\r\n";
        }
    }

    private function readEmailsFromFile($fn) : void
    {
        $this->emails = file($fn, FILE_IGNORE_NEW_LINES);

        if (empty($this->emails)) {
            throw new Exception('No emails');
        }
    }

    private function checkEmail(string $email) : bool
    {
        if (empty($email)) {
            return false;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        $host = explode('@', $email)[1];
        
        $getmxrr = getmxrr($host, $mx_records);
        
        if (!$getmxrr) {
            return false;
        }
        
        return true;
    }
}
