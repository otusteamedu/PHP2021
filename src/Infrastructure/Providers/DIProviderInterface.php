<?php

namespace App\Infrastructure\Providers;

interface DIProviderInterface
{
    public function boot();

    public function getDefinitions();
}