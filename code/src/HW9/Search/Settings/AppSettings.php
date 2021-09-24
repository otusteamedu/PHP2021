<?php

namespace HW9\Search\Settings;

class AppSettings implements Settings
{
    protected $host = null;

    public function __construct()
    {
        $this->setHost();
    }

    public function setHost(): void
    {
    }
    public function getHost(): string
    {
        return $this->host;
    }
}
