<?php

namespace App;

use App\Infrastructure\RequestHandler;
use App\Helpers\AppHelper;
use App\Application\Interfaces\StorageInterface;
use Exception;

class Application
{
	private RequestHandler $handler;
	
	public function __construct()
	{
		try {
			$storage = AppHelper::getStorageClient();
			$this->handler = new RequestHandler($storage);			
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	public function run(): void
	{
		$this->handler->execute();
	}
}
