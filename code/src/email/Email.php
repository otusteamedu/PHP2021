<?php

namespace Email;

use Exception;

class Email
{
    private $emails = [];

    public function readEmails($file)
    {
        $this->emails = file($file, FILE_IGNORE_NEW_LINES);

        if (empty($this->emails))
        {
            throw new Exception('Нету email адресов!' . "\r\n");
        }

        return $this->emails;
    }

    public function checkEmail($email) 
    {
        if (empty($email))
		{
			return false;
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			return false;
		}

		$host = explode('@', $email)[1];

		$getmxrr = getmxrr($host, $mx_records);

		if (!$getmxrr)
		{
			return false;
		}

		return true;
    }
}