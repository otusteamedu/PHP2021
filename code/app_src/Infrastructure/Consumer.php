<?php

namespace App\Infrastructure;

use App\Application\Interfaces\BankServiceInterface;
use App\Application\Interfaces\ConsumerInterface;
use App\Application\Interfaces\StorageInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Closure;
use Exception;

class Consumer implements ConsumerInterface
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private BankServiceInterface $service;
    private StorageInterface $storage;

    public function __construct(
    	AMQPStreamConnection $connection,
    	BankServiceInterface $service,
    	StorageInterface $storage
    )
    {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->service = $service;
        $this->storage = $storage;
    }

    public function runFromQueue(string $queueName): void
    {
    	$this->channel->queue_declare(
            $queueName,
            false,
            true,
            false,
            false
        );
        
        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume(
            $queueName,
            '',
            false,
            false,
            false,
            false,
            $this->onConsume()
        );

        while(count($this->channel->callbacks)) {
            $this->channel->wait();
	    }
	    
	    $this->closeConnection();
    }

    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function onConsume(): Closure
    {
        return function (AMQPMessage $request): void {
            $request->ack();
			$this->service->setBankStatement($request->getBody());
			
            try {
            	$userData = $this->service->getUserData();
            	$correlation_id = $request->get('correlation_id');
            	
            	if (!empty($userData)) {
                	$this->storage->update($correlation_id, 'ended');
				}
            } catch (Exception $e) {
                throw new Exception('Error while consuming message from queue');
            }
        };
    }
}