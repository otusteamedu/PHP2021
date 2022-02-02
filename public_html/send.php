<?php
require_once '../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'user', 'password');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$callback = function ($msg) {
    echo ' recieved: ' . $msg->body . '\n';
};
$channel->basic_consume('hello', 'consumer', true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}
$channel->close();
$connection->close();