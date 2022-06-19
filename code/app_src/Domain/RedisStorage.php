<?php

namespace App\Domain;

use App\Application\Interfaces\StorageInterface;
use \Predis\Client as RedisClient;

class RedisStorage implements StorageInterface
{
  	private RedisClient $client;

	public function __construct()
	{
		$this->client = new RedisClient([
			'scheme' => 'tcp',
			'host'   => getenv('REDIS_HOST'),
			'port'   => getenv('REDIS_PORT'),
		]);
	}

	public function insert(string $eventId): string
	{
		$this->client->set("event:$eventId:status", 'running');

		return $eventId;
	}
	
	public function update(string $eventId, string $status): void
	{
		$this->client->set("event:$eventId:status", $status);
	}

	public function searchById(string $eventId): ?string
	{
		return $this->client->get("event:$eventId:status");
	}
}
