<?php


namespace Repetitor202;


use Shasoft\Console\Console;

class EchoMessage
{
    public function write(string $message, $color = 'green', $bgcolor = 'light_gray'): void
    {
        Console::color($color)
            ->bgcolor($bgcolor)
            ->write($message)
            ->enter();
    }

    public function writeError($message = 'Error!!!'): void
    {
        $this->write($message, 'red');
    }
}