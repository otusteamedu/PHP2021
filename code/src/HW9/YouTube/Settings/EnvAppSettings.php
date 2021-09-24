<?php

namespace HW9\YouTube\Settings;

class EnvAppSettings extends AppSettings implements Settings
{
    public function setApiKey(): void
    {
        $this->api_key = getenv('YOUTUBE_API_KEY', true) ?: getenv('YOUTUBE_API_KEY');
    }
    public function setAppName(): void
    {
        $this->app_name = getenv('APP_NAME', true) ?: getenv('APP_NAME');
    }
}
