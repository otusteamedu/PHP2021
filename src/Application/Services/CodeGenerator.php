<?php


namespace App\Application\Services;

use PhpAmqpLib\Message\AMQPMessage;

class CodeGenerator extends AbstractCodeAction
{
    public function generate()
    {
        $code = uniqid();
        $message = new AMQPMessage($code, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
        $this->channel->basic_publish($message, $this->exchange);
        $this->channel->close();
        $this->connection->close();
        return true;
    }
}