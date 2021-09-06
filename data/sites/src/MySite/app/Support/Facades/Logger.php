<?php


namespace MySite\app\Support\Facades;


class Logger
{

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function notice(string $message, array $context = []): void
    {
        //Log somewhere
        error_log($message);
    }
}
