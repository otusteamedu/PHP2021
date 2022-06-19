<?php

namespace App\Infrastructure;

use App\Infrastructure\BankService;
use App\Infrastructure\RequestValidator;
use App\Infrastructure\Response;
use App\Application\Interfaces\ConsumerInterface;
use App\Application\Interfaces\PublisherInterface;
use App\Application\Interfaces\StorageInterface;
use App\Application\Adapters\RabbitAdapter;
use App\Helpers\AppHelper;
use \Silex\Application;
use \Silex\ExceptionHandler;


class RequestHandler
{
		
	private array $request;
	private ConsumerInterface $consumer;
	private PublisherInterface $publisher;
	private \Silex\Application $httpHandler;
	private StorageInterface $storage;

	public function __construct(StorageInterface $storage)
	{
		try {
			$this->storage = $storage;
			$rabbitAdapter = new RabbitAdapter();
			$this->publisher = AppHelper::createPublisher($rabbitAdapter);
			$this->consumer = AppHelper::createConsumer($rabbitAdapter, $this->storage);
			$this->httpHandler = new Application();
			unset($this->httpHandler['exception_handler']);
			$this->setRoutes();
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	public function execute(): void
	{
		$this->httpHandler->run();
	}
	
	private function setRoutes(): void
	{
		$this->httpHandler->get('/api/v1/consume', function() {
			$this->consumer->runFromQueue('bank_queue');
			return json_encode([
				'status' => 'success',
				'info'   => 'All messages processed',
			]);
		});
		
		$this->httpHandler->get('/api/v1/message/{messageId}', function($messageId) {
			$status = $this->storage->searchById($messageId);
	    	if (is_null($status)) {
	    		return json_encode([
					'status' => 'error',
					'info'   => 'Message not found',
				]);
	    	} else {
	    		return json_encode([
					'status'     => 'success',
					'info'       => 'Message found',
					'msg_id'     => $messageId,
					'msg_status' => $status,
				]);
	    	}
		});
		
		$this->httpHandler->post('/api/v1/message', function() {
			if (RequestValidator::validatePostRequest($_POST)) {
				$messageId = $this->publisher->addToQueue($_POST, 'bank_queue');
				$this->publisher->closeConnection();
				
				if (is_null($messageId)) {
					return json_encode([
						'status' => 'error',
						'info'   => 'Request failed',
					]);
				} else {
					$this->storage->insert($messageId);
					
					return json_encode([
						'status'     => 'success',
						'info'       => 'Request accepted',
						'msg_id'     => $messageId,
						'msg_status' => 'running',
					]);
				}
			}
		});
	}
}