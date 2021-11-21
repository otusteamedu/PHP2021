<?php

namespace App;

use App\EmailVerification\Verification;

class App
{
    const EMAIL_LIST_FILE = '/email-list.txt';

    public function run() : void
    {
        foreach ($this->readFileLineByLine() as $email) {
            Verification::run($email);
        }
    }

    private function readFileLineByLine() : iterable
    {
        $stream = fopen($_SERVER['DOCUMENT_ROOT'] . self::EMAIL_LIST_FILE, "r");
        while (($line = fgets($stream)) !== false) {
            yield trim($line);
        }
    }
}
