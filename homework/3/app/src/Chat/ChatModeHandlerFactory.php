<?php

namespace App\Chat;

use Exception;
use Throwable;

class ChatModeHandlerFactory
{
    /** 
     * @return ChatModeHandlerInterface|Throwable
     */
    public static function getInstance(string $mode)
    {
        if (!in_array($mode, ['client', 'server'])) {
            throw new Exception('Expected mode client server');
        }

        $className = sprintf('App\\Chat\\%sModeHandler', ucfirst($mode));

        try {
            $instance = new $className();
        } catch (Throwable $e) {
            return $e;
        }

        return $instance;
    }
}
