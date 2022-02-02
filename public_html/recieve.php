<?php
require_once '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'user', 'password');

$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
$msg = new \PhpAmqpLib\Message\AMQPMessage('hello');
$channel->basic_publish($msg, '', 'hello world');

echo 'sent';

$channel->close();
$connection->close();