<?php

declare(strict_types=1);

namespace Sources;

use Sources\Services\FrontRouter;

final class App
{
    public function run(): void
    {
        $router = new FrontRouter();
        $router->forward();
    }
}