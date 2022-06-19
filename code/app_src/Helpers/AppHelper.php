<?php

namespace App\Helpers;

use App\Infrastructure\BankService;
use App\Infrastructure\Consumer;
use App\Infrastructure\Publisher;
use App\Infrastructure\MailAgent;
use App\Application\Interfaces\QueueInterface;
use App\Application\Interfaces\StorageInterface;
use App\Domain\RedisStorage;
use PHPMailer\PHPMailer\PHPMailer;

class AppHelper
{
	public static function createPublisher(QueueInterface $adapter): Publisher
	{
		return new Publisher($adapter->connection);
	}
	
	public static function createConsumer(QueueInterface $adapter, StorageInterface $storageClient): Consumer
	{
		return new Consumer(
			$adapter->connection,
			new BankService(),
			$storageClient
		);
	}
	
	public static function getStorageClient(): StorageInterface
	{
		return new RedisStorage();
	}
}
