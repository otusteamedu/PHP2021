<?php

declare(strict_types=1);

namespace App\Services\MessageSenderService\Strategies;


use App\Services\MessageSenderService\Contracts\StrategyContract;
use App\Services\UrlBuilder\UrlBuilder;
use Illuminate\Support\Facades\Http;


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

        return $response->successful();
    }
}
