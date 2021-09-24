<?php

namespace HW9\YouTube\Settings;

class AppSettings implements Settings
{
    protected $api_key = null;
    protected $app_name = null;

    public function __construct()
    {
        $this->setApiKey();
        $this->setAppName();
    }

    public function setApiKey(): void
    {
    }
    public function getApiKey(): string
    {
        return $this->api_key;
    }
    public function setAppName(): void
    {
    }
    public function getAppName(): string
    {
        return $this->app_name;
    }
}
