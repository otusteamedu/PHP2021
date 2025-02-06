<?php

namespace App\Infrastructure;

use App\Application\Interfaces\ConsumerInterface;
use App\Application\Interfaces\PublisherInterface;
use App\Application\Adapters\RabbitAdapter;
use App\Helpers\AppHelper;

class RequestHandler
{
    private array $request;
    private ConsumerInterface $consumer;
    private PublisherInterface $publisher;

    public function __construct(array $request)
    {
        $this->request = $request;
        $rabbitAdapter = new RabbitAdapter();
        $this->publisher = AppHelper::createPublisher($rabbitAdapter);
        $this->consumer = AppHelper::createConsumer($rabbitAdapter);
    }

    public function execute(): void
    {
        switch ($this->request['request_type']) {
            case 'request':
                $requestResult = $this->publisher->addToQueue($this->request, 'bank_queue');

                if ($requestResult) {
                    $title = 'Запрос на выписку успешно создан!';

                    include_once 'pages/success.php';
                } else {
                    $title = 'Ошибка при создании запроса на банковскую выписку!';

                    include_once 'pages/error.php';
                }

                $this->publisher->closeConnection();

                break;

            case 'consume':
                $title = 'Ваши банковские выписки';
                $bankStatements = $this->consumer->runFromQueue('bank_queue');

                include_once 'pages/statement.php';

                break;

            default:
                throw new \Exception('Something went wrong, please reload and try again');
        }
    }
}
