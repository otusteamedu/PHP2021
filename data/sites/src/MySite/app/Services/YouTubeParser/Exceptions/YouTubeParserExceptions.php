<?php

namespace MySite\app\Services\YouTubeParser\Exceptions;

use Exception;

/**
 * Class YouTubeParserExceptions
 * @package MySite\app\Services\YouTubeParser\Exceptions
 */
class YouTubeParserExceptions extends Exception
{
    /**
     * @param string $message
     * @throws Exception
     */
    private static function throwException(string $message): void
    {
        throw (new parent($message . PHP_EOL));
    }

    /**
     * @throws Exception
     */
    public static function noChannel(): void
    {
        self::throwException('No channel');
    }


}
