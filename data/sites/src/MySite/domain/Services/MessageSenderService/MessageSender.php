<?php

declare(strict_types=1);

namespace MySite\domain\Services\MessageSenderService;


use MySite\domain\Services\MessageSenderService\Contracts\StrategyContract;
use MySite\domain\Support\Traits\SingletonTrait;

/**
 * Class MessageSender
 * @package MySite\domain\Services\MessageSenderService
 */
final class MessageSender implements StrategyContract
{
    use SingletonTrait;

    /**
     * @var StrategyContract
     */
    private static StrategyContract $strategy;

    /**
     * @inheritDoc
     */
    public function send(string $destination, string $message): bool
    {
        $strategy = self::getInstance();
        return $strategy->send($destination, $message);
    }

    /**
     * @return StrategyContract
     */
    public static function getInstance(): StrategyContract
    {
        $strategyName = getenv('DEFAULT_MESSENGER') . 'Strategy';

        if (!isset(self::$strategy)) {
            /** @var StrategyContract $strategyClass */
            $strategyClass = 'MySite\domain\Services\MessageSenderService\Strategies\\' . $strategyName;
            self::$strategy = $strategyClass::getInstance();
        }

        return self::$strategy;
    }
}
