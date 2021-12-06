<?php

namespace Vshepelev\App\Commands;

use Vshepelev\App\Config;

abstract class BaseCommand implements Command
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }
}
