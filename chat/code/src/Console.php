<?php

namespace Chat;

class Console
{
    public function read(): string
    {
        $message = fgets(STDIN);

        return $message;
    }

    public function write($message): void
    {
        fwrite(STDOUT, $message);
    }
}
