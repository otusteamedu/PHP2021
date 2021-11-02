<?php

namespace App\Contracts\Config;


interface ConfigReaderContract
{
    /**
     * @param string $valuePath dot separated path to value
     */
    public function getValue(string $valuePath, $default = null);
}
