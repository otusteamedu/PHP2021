<?php

namespace App;

use App\Infrastructure\RequestValidator;
use App\Infrastructure\RequestHandler;
use Exception;

class Application
{
	private RequestHandler $handler;

	public function __construct()
	{
		try {
			$request = RequestValidator::validateRequest($_POST);
			$this->handler = new RequestHandler($request);			
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	public function run(): void
	{
		$this->handler->execute();
	}
}
