<?php


namespace MySite\domain\Services\MessageSenderService\Contracts;

/**
 * Interface StrategyContract
 * @package MySite\domain\Services\MessageSenderService\Contracts
 */
interface StrategyContract
{
    /**
     * @return StrategyContract
     */
    public static function getInstance(): StrategyContract;

    /**
     * @param string $destination
     * @param string $message
     * @return bool
     */
    public function send(string $destination, string $message): bool;
}
