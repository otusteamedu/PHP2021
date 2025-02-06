<?php

namespace App\Helpers;

use App\Infrastructure\ConsumerWeb;
use App\Infrastructure\Publisher;
use App\Infrastructure\MailAgent;
use PHPMailer\PHPMailer\PHPMailer;

class AppHelper
{
    public static function createPublisher($adapter): Publisher
    {
        return new Publisher($adapter->connection);
    }

    public static function createConsumer($adapter): ConsumerWeb
    {
        return new ConsumerWeb($adapter->connection, new MailAgent(new PHPMailer()));
    }
}
