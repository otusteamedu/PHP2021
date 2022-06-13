<?php

namespace App\Infrastructure;

use App\Infrastructure\BankService;
use App\Infrastructure\RequestValidator;
use App\Infrastructure\Response;
use App\Application\Interfaces\ConsumerInterface;
use App\Application\Interfaces\PublisherInterface;
use App\Application\Adapters\RabbitAdapter;
use App\Helpers\AppHelper;

class RequestHandler
{
		
	private array $request;
	private ConsumerInterface $consumer;
	private PublisherInterface $publisher;

	public function __construct(array $request)
	{
		try {
			$this->request = $request;
			$rabbitAdapter = new RabbitAdapter();
			$this->publisher = AppHelper::createPublisher($rabbitAdapter);
			$this->consumer = AppHelper::createConsumer($rabbitAdapter);
			
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	public function execute(): void
	{
		switch($this->request['request_type']) {
			case 'request':
				Response::generateOkResponse($this->publisher->addToQueue($this->request, 'bank_queue'));
				$this->publisher->closeConnection();
				break;
			
			case 'consume':
				$this->consumer->runFromQueue('bank_queue');
				break;
				
			default:
				throw new \Exception('Something went wrong, please reload and try again');
		}	
	}
}