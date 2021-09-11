<?php

declare(strict_types=1);

namespace MySite\domain\Services\MessageSenderService\Strategies;


use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\Pure;
use MySite\app\Support\Http\UrlBuilder;
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
        $url = (new UrlBuilder(getenv('TELEGRAM_API_URL')))
            ->joinPart('bot' . getenv('TELEGRAM_API_KEY'))
            ->joinPart('sendMessage')
            ->joinParam('parse_mode', 'markdown')
            ->joinParam('chat_id', $destination)
            ->joinParam('text', urlencode($message))
            ->url();

        $response = Http::get($url);

        return $response->getStatusCode() === HttpConstants::OK;
    }
}
