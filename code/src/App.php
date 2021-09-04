<?php

namespace App;

use Exception;
use Email\Email;

class App
{
    private Email $email;
	private $emails = [];

	public function run($argv)
	{
        if (empty($argv))
        {
            throw new Exception( 'Не указан файл для чтения списка email!' );
        }

        $file = $argv[1];
        $this->email = new Email();
        $this-> emails = $this->email->readEmails($file);

		foreach ($this->emails as $email)
		{
			echo $email . ' = ' . (($this->email->checkEmail($email)) ? 'Действующий E-mail' : 'Не действующий email') . "\r\n\r\n";
		}
	}

}
