<?php

namespace App\Infrastructure;

use App\Application\Interfaces\ConsumerInterface;
use App\Application\Interfaces\PublisherInterface;
use App\Application\Interfaces\StorageInterface;
use App\Application\Adapters\RabbitAdapter;
use App\Helpers\AppHelper;
use Silex\Application;

class RequestHandler
{
    private ConsumerInterface $consumer;
    private PublisherInterface $publisher;
    private Application $httpHandler;
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
        $rabbitAdapter = new RabbitAdapter();
        $this->publisher = AppHelper::createPublisher($rabbitAdapter);
        $this->consumer = AppHelper::createConsumer($rabbitAdapter, $this->storage);
        $this->httpHandler = new Application();

        unset($this->httpHandler['exception_handler']);

        $this->setRoutes();
    }

    public function execute(): void
    {
        $this->httpHandler->run();
    }

    private function setRoutes(): void
    {
        $this->httpHandler->get('/api/v1/get-all-statements', function () {
            $allBankStatements = $this->consumer->runFromQueue('bank_queue');

            return json_encode($allBankStatements);
        });


        $this->httpHandler->get('/api/v1/statement/{statementId}', function ($statementId) {
            $status = $this->storage->searchById($statementId);

            if (is_null($status)) {
                return json_encode(['status' => 'error', 'info' => 'Statement not found']);
            } else {
                return json_encode([
                    'status' => 'success',
                    'info' => 'Statement found',
                    'stm_id' => $statementId,
                    'stm_status' => $status
                ]);
            }
        });

        $this->httpHandler->post('/api/v1/statement', function () {
            if ($_POST) {
                $statementId = $this->publisher->addToQueue($_POST, 'bank_queue');
                $this->publisher->closeConnection();

                if (is_null($statementId)) {
                    return json_encode(['status' => 'error', 'info' => 'Request failed']);
                } else {
                    $this->storage->insert($statementId);

                    return json_encode([
                        'status' => 'success',
                        'info' => 'Request accepted',
                        'stm_id' => $statementId,
                        'stm_status' => 'running'
                    ]);
                }
            }
        });
    }
}
