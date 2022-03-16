<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Components\DataValidation;
use App\Infrastructure\Services\ReceiverRabbitMQ;
use App\Infrastructure\Services\SendRabbitMQ;


class ResultController
{
    public function actionIndex():void
    {

        require_once(ROOT . '/src/Infrastructure/Views/result.php');

    }
}