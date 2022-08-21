<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\Components\Router;

class App
{
    /**
     * @return void
     */
    public function run(): void
    {
        (new Router())->run();
    }
}