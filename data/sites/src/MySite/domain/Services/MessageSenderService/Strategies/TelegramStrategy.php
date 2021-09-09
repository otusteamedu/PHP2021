<?php

declare(strict_types=1);

namespace MySite\domain\Services\MessageSenderService\Strategies;


use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\Pure;
use MySite\domain\Services\MessageSenderService\Contracts\StrategyContract;
use MySite\domain\Support\Constants\HttpConstants;
use MySite\domain\Support\Facades\Http;

/**
 * Class TelegramStrategy
 * @package MySite\domain\Services\MessageSenderService\Strategies
 */
final class TelegramStrategy implements StrategyContract
{
    /**
     * @return StrategyContract
     */
    public static function getInstance(): StrategyContract
    {
        return new self();
    }

    /**
     * @param mixed $destination
     * @param string $message
     * @return bool
     * @throws GuzzleException
     */
    public function send(string $destination, string $message): bool
    {
        $response = Http::get(
            $this->createUrl($destination, $message)
        );
        return $response->getStatusCode() === HttpConstants::OK;
    }

    /**
     * @param string $destination
     * @param string $message
     * @return string
     */
    #[Pure] private function createUrl(string $destination, string $message)
    {
        return getenv('TELEGRAM_API_URL')
            . 'bot'
            . getenv('TELEGRAM_API_KEY')
            . '/sendMessage?parse_mode=markdown&chat_id='
            . $destination
            . '&text='
            . urlencode(
                $message
            );
    }
}
