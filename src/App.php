<?php

namespace App;

use App\Service\EmailVerifier;
use Exception;

class App
{
    private EmailVerifier $verifier;

    /**
     * App constructor.
     *
     */
    public function __construct()
    {
        $this->verifier = new EmailVerifier();
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $argv = $_SERVER['argv'];
        array_shift($argv);

        var_dump($this->verifier->verify($argv));
    }
}
