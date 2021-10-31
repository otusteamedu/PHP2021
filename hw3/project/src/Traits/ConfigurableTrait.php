<?php

namespace App\Traits;

use App\Contracts\Config\ConfigReaderContract;

trait ConfigurableTrait
{
    private $config;

    /**
     * @param $config
     */
    public function __construct(ConfigReaderContract $config)
    {
        $this->config = $config;
    }
}
