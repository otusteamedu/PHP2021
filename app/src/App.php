<?php

namespace Src;

use Src\Infrastructure\Result;

class App
{
    /**
     * @return void
     */
    public function run(): void
    {
        (new Result())->run();
    }
}