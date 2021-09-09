<?php

declare(strict_types=1);

namespace MySite\console\Services\QueueHandler;


use Bunny\Channel;
use Bunny\Client;
use Bunny\Message;
use Closure;
use MySite\domain\Services\MessageSenderService\MessageSender;
use MySite\domain\Services\ReportService\ReportHandler;
use MySite\domain\Support\Facades\Queue;

/**
 * Class QueueHandlerService
 * @package MySite\console\Services\QueueHandler
 */
final class QueueHandlerService
{

    /**
     * @var MessageSender
     */
    private MessageSender $messageSender;
    /**
     * @var ReportHandler
     */
    private ReportHandler $reportHandler;

    public function __construct()
    {
        $this->reportHandler = new ReportHandler();
        $this->messageSender = new MessageSender();
    }


    public function run()
    {
        $channel = Queue::getChannel();
        $channel->run(
            $this->handleQueue(),
            getenv('QUEUE_DEFAULT')
        );
    }

    private function handleQueue(): Closure
    {
        return function (Message $message, Channel $channel, Client $bunny) {
            $success = $this->handleMessage($message);

            if ($success) {
                $channel->ack($message);
                return;
            }

            $channel->nack($message);
        };
    }

    /**
     * @param Message $message
     * @return bool
     */
    private function handleMessage(Message $message): bool
    {
        $result = false;
        $content = json_decode($message->content);

        if (isset($content->id)) {
            $id = (string)$content->id;
            $report = $this->reportHandler->getReport();
            $result = $this->messageSender->send($id, $report);
        }

        return $result;
    }
}
