<?php
declare(strict_types=1);

namespace APP;

class App
{
	private $status;

	public function run(string $arg = NULL)
	{
		$config = parse_ini_file('config/config.ini');
		
		$this->status = $arg;
		$this->checkStatusAppExit();
		$className = "APP\\".ucfirst($this->status);
		$workApp = new $className();
		$workApp->processing($config);
	}

	private function checkStatusAppExit()
	{
		if ($this->status !== 'server' and $this->status != 'client') {
			exit('Status not defined'.PHP_EOL);
		}
	}
}