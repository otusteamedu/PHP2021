<?php
declare(strict_types=1);

namespace App\Infrastructure\Controllers;

use App\Infrastructure\Services\ReceiverRabbitMQ;


class ResultController
{
    public function actionIndex():void
    {
        (new ReceiverRabbitMQ())->execute();
    }
}