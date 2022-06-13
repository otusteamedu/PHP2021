<?php

namespace App\Application\Adapters;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Application\Interfaces\QueueInterface;

class RabbitAdapter implements QueueInterface
{
	public AMQPStreamConnection $connection;
	
	public function __construct()
    {
    	$this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'bender', 'bender');
	}
}
