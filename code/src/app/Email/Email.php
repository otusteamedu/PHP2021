<?php

namespace App\Email;

use Exception;

class Email
{
    private $emails = [];

    public function readEmails($filename)
    {
//      https://www.php.net/manual/ru/function.file.php
        $this->emails = file($filename, FILE_IGNORE_NEW_LINES);

        if (!file_exists($filename))
        {
//          https://www.php.net/manual/ru/reserved.constants.php
            throw new Exception('Файл не существует' . PHP_EOL);
        }

        if (empty($this->emails))
        {
//          https://www.php.net/manual/ru/reserved.constants.php
            throw new Exception('Email отсутствует' . PHP_EOL);
        }

        return $this->emails;
    }

    public function checkEmail($email)
    {
        if (empty($email))
        {
            return false;
        }
//      https://www.php.net/manual/ru/filter.filters.validate.php
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }

        $host = explode('@', $email)[1];

//      https://www.php.net/manual/ru/function.getmxrr
        $getmxrr = getmxrr($host, $mx_records);

        if (!$getmxrr)
        {
            return false;
        }

        return true;
    }
}
