<?php

namespace App\Application\Adapters;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Application\Interfaces\QueueInterface;

class RabbitAdapter implements QueueInterface
{
	public AMQPStreamConnection $connection;
	
	public function __construct()
    {
    	$this->connection = new AMQPStreamConnection(
    		getenv('RABBITMQ_DEFAULT_NAME'),
    		getenv('RABBITMQ_DEFAULT_PORT'),
    		getenv('RABBITMQ_DEFAULT_USER'),
    		getenv('RABBITMQ_DEFAULT_PASS')
    	);
	}
}
