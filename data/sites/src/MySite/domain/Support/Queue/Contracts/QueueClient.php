<?php


namespace MySite\domain\Support\Queue\Contracts;


use Bunny\Client;

/**
 * Interface QueueClient
 * @package MySite\app\Support\Queue\Contracts
 */
interface QueueClient
{
    /**
     * @return Client
     */
    public static function run(): Client;
}
