<?php

namespace App\Application\UseCases;

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\PublisherInterface;
use App\Application\Contracts\ServiceInterface;
use App\DTO\Request;
use App\DTO\Response;
use App\Utils\FormValidator;
use App\Utils\HttpOutput;
use Exception;

class Client implements ServiceInterface
{
    private PublisherInterface $publisher;

    /**
     * @throws Exception
     */
    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @throws Exception
     */
    public function execute(): void
    {
        $body = [
            'date_from' => $_POST['date_from'] ?? '',
            'date_to'   => $_POST['date_to'] ?? '',
            'email'     => $_POST['email'] ?? '',
        ];

        try {
            if (!FormValidator::isValid($body)) {
                throw new Exception('Form is not valid');
            }

            $request = new Request(json_encode($body));
            $response = $this->publisher->execute(
                ConsumerInterface::QUEUE_NAME,
                $request
            );
        } catch (Exception $e) {
            $response = new Response($e->getMessage());
        } finally {
            HttpOutput::send($response);
            $this->publisher->close();
        }
    }
}
